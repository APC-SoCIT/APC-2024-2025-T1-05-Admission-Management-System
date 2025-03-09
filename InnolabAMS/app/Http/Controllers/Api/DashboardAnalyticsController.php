<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\ApplicantInfo;
use App\Models\LeadInfo;
use App\Models\ApplicantScholarship;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class DashboardAnalyticsController extends Controller
{
    public function index(Request $request): JsonResponse
    {
        try {
            // Get filter parameters
            $dateRange = $request->input('dateRange', 'all');
            $status = $request->input('status', 'all');
            $category = $request->input('category', 'all');

            // Start with base queries
            $applicantQuery = ApplicantInfo::query();
            $inquiryQuery = LeadInfo::query();
            $scholarshipQuery = ApplicantScholarship::query();

            // Apply date range filter
            if ($dateRange !== 'all') {
                $dateFilter = $this->getDateRangeFilter($dateRange);
                if ($dateFilter) {
                    $applicantQuery->whereBetween('created_at', $dateFilter);
                    $inquiryQuery->whereBetween('created_at', $dateFilter);
                    $scholarshipQuery->whereBetween('created_at', $dateFilter);
                }
            }

            // Apply status filter if not "all"
            if ($status !== 'all') {
                $applicantQuery->where('status', $status);
            }

            // Apply category filter
            // (Category filter logic is applied when collecting data below)

            // Get filtered data based on category
            $analytics = [
                // Always include admissions data unless category filter excludes it
                'admissions' => $category === 'all' || $category === 'admissions' ? [
                    'new' => clone $applicantQuery->where('status', 'new')->count(),
                    'accepted' => clone $applicantQuery->where('status', 'accepted')->count(),
                    'rejected' => clone $applicantQuery->where('status', 'rejected')->count(),
                ] : ['new' => 0, 'accepted' => 0, 'rejected' => 0],

                // Always include inquiries data unless category filter excludes it
                'inquiries' => $category === 'all' || $category === 'inquiries' ? [
                    'new' => clone $inquiryQuery->where('inquiry_status', 'New')->count(),
                    'resolved' => clone $inquiryQuery->where('inquiry_status', 'Resolved')->count(),
                ] : ['new' => 0, 'resolved' => 0],

                // Always include scholarships data unless category filter excludes it
                'scholarships' => $category === 'all' || $category === 'scholarships' ? [
                    'total' => clone $scholarshipQuery->count(),
                    'approved' => clone $scholarshipQuery->where('status', 'approved')->count(),
                ] : ['total' => 0, 'approved' => 0],

                // Get monthly trend based on filters
                'monthlyTrend' => $this->getMonthlyTrend($dateRange, $status, $category),

                // Last Updated Timestamp - Using Manila time with user-friendly format
                'lastUpdated' => now()->timezone('Asia/Manila')->format('F j, Y g:i A'),
            ];

            return response()->json($analytics);
        } catch (\Exception $e) {
            Log::error('Dashboard analytics error: ' . $e->getMessage());

            // Return empty data structure if there's an error
            return response()->json([
                'admissions' => ['new' => 0, 'accepted' => 0, 'rejected' => 0],
                'inquiries' => ['new' => 0, 'resolved' => 0],
                'scholarships' => ['total' => 0, 'approved' => 0],
                'monthlyTrend' => ['labels' => [], 'data' => []],
                'lastUpdated' => now()->timezone('Asia/Manila')->format('F j, Y g:i A'),
                'error' => 'Failed to load analytics data'
            ]);
        }
    }

    private function getDateRangeFilter(string $dateRange): ?array
    {
        switch ($dateRange) {
            case 'today':
                return [Carbon::today(), Carbon::today()->endOfDay()];
            case 'week':
                return [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()];
            case 'month':
                return [Carbon::now()->startOfMonth(), Carbon::now()->endOfMonth()];
            default:
                return null;
        }
    }

    private function getMonthlyTrend(string $dateRange, string $status, string $category): array
    {
        // Default to showing 6 months of data
        $months = 6;

        // Adjust the number of months based on date range
        if ($dateRange === 'today') {
            $months = 0; // Just today
        } elseif ($dateRange === 'week') {
            $months = 0; // Just this week
        } elseif ($dateRange === 'month') {
            $months = 1; // Just this month
        }

        // Select the appropriate query based on category
        $query = null;
        if ($category === 'inquiries') {
            $query = LeadInfo::query();
            // Apply status filter if applicable
            if ($status !== 'all') {
                $query->where('inquiry_status', $status === 'new' ? 'New' : 'Resolved');
            }
        } elseif ($category === 'scholarships') {
            $query = ApplicantScholarship::query();
            // Apply status filter if applicable
            if ($status !== 'all') {
                $query->where('status', $status);
            }
        } else {
            // Default to applicant info (admissions)
            $query = ApplicantInfo::query();
            // Apply status filter if applicable
            if ($status !== 'all') {
                $query->where('status', $status);
            }
        }

        // Apply date range filter
        $dateFilter = $this->getDateRangeFilter($dateRange);
        if ($dateFilter) {
            $query->whereBetween('created_at', $dateFilter);
        }

        // For different date ranges, adjust the grouping and format
        if ($dateRange === 'today') {
            // Group by hour for today
            $result = $query->select(DB::raw('HOUR(created_at) as hour'), DB::raw('COUNT(*) as count'))
                ->whereDate('created_at', Carbon::today())
                ->groupBy('hour')
                ->orderBy('hour')
                ->get();

            // Generate all hours
            $data = array_fill(0, 24, 0);
            foreach ($result as $row) {
                $data[$row->hour] = $row->count;
            }

            $labels = array_map(function($hour) {
                return $hour . ':00';
            }, array_keys($data));

            return [
                'labels' => $labels,
                'data' => array_values($data)
            ];
        } elseif ($dateRange === 'week') {
            // Group by day for this week
            $result = $query->select(DB::raw('DATE(created_at) as date'), DB::raw('COUNT(*) as count'))
                ->whereBetween('created_at', [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()])
                ->groupBy('date')
                ->orderBy('date')
                ->get();

            // Generate all days of the week
            $days = [];
            $counts = [];
            for ($i = 0; $i <= 6; $i++) {
                $date = Carbon::now()->startOfWeek()->addDays($i)->format('Y-m-d');
                $days[] = Carbon::now()->startOfWeek()->addDays($i)->format('D');
                $counts[$date] = 0;
            }

            foreach ($result as $row) {
                $counts[$row->date] = $row->count;
            }

            return [
                'labels' => $days,
                'data' => array_values($counts)
            ];
        } else {
            // Default: Group by month
            $startMonth = $months > 0 ? Carbon::now()->subMonths($months - 1)->startOfMonth() : Carbon::now()->startOfMonth();
            $endMonth = Carbon::now()->endOfMonth();

            $result = $query->select(DB::raw('YEAR(created_at) as year'), DB::raw('MONTH(created_at) as month'), DB::raw('COUNT(*) as count'))
                ->whereBetween('created_at', [$startMonth, $endMonth])
                ->groupBy('year', 'month')
                ->orderBy('year')
                ->orderBy('month')
                ->get();

            // Generate all months in range
            $monthLabels = [];
            $monthCounts = [];

            $current = clone $startMonth;
            while ($current <= $endMonth) {
                $key = $current->format('Y-m');
                $monthLabels[] = $current->format('M Y');
                $monthCounts[$key] = 0;
                $current->addMonth();
            }

            foreach ($result as $row) {
                $key = sprintf('%04d-%02d', $row->year, $row->month);
                if (isset($monthCounts[$key])) {
                    $monthCounts[$key] = $row->count;
                }
            }

            return [
                'labels' => $monthLabels,
                'data' => array_values($monthCounts)
            ];
        }
    }
}

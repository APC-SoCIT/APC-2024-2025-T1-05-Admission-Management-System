<?php

namespace App\Http\Controllers;

use App\Models\ApplicantInfo;
use App\Models\LeadInfo;
use App\Models\ApplicantScholarship;
use App\Exports\AnalyticsExport;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Barryvdh\DomPDF\Facade\Pdf;
use Symfony\Component\HttpFoundation\BinaryFileResponse;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Cache;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index()
    {
        if (auth()->user()->hasRole('Staff')) {
            return redirect('/app');
        }

        if (auth()->user()->hasRole('Applicant')) {
            return redirect('/portal');
        }

        // Get initial counts for the dashboard
        $data = [
            'newApplicationsCount' => ApplicantInfo::where('status', 'new')->count(),
            'acceptedApplicationsCount' => ApplicantInfo::where('status', 'accepted')->count(),
            'rejectedApplicationsCount' => ApplicantInfo::where('status', 'rejected')->count(),
            'newInquiriesCount' => LeadInfo::where('inquiry_status', 'New')->count(),
            'resolvedInquiriesCount' => LeadInfo::where('inquiry_status', 'Resolved')->count(),
            'scholarshipApplicationsCount' => ApplicantScholarship::count(),
            'approvedScholarshipsCount' => ApplicantScholarship::where('status', 'approved')->count(),
        ];

        return view('dashboard', $data);
    }

    public function getAnalytics(Request $request): JsonResponse
    {
        try {
            // Get filter parameters
            $dateRange = $request->input('dateRange', 'all');
            $status = $request->input('status', 'all');
            $category = $request->input('category', 'all');

            // Apply date filter
            $query = ApplicantInfo::query();
            $inquiryQuery = LeadInfo::query();
            $scholarshipQuery = DB::table('applicant_scholarships');

            // Apply date range filter
            switch ($dateRange) {
                case 'today':
                    $query->whereDate('created_at', Carbon::today());
                    $inquiryQuery->whereDate('created_at', Carbon::today());
                    $scholarshipQuery->whereDate('created_at', Carbon::today());
                    break;
                case 'week':
                    $query->whereBetween('created_at', [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()]);
                    $inquiryQuery->whereBetween('created_at', [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()]);
                    $scholarshipQuery->whereBetween('created_at', [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()]);
                    break;
                case 'month':
                    $query->whereMonth('created_at', Carbon::now()->month)
                         ->whereYear('created_at', Carbon::now()->year);
                    $inquiryQuery->whereMonth('created_at', Carbon::now()->month)
                         ->whereYear('created_at', Carbon::now()->year);
                    $scholarshipQuery->whereMonth('created_at', Carbon::now()->month)
                         ->whereYear('created_at', Carbon::now()->year);
                    break;
                case 'custom':
                    $startDate = $request->input('startDate');
                    $endDate = $request->input('endDate');
                    if ($startDate && $endDate) {
                        $query->whereBetween('created_at', [$startDate, $endDate]);
                        $inquiryQuery->whereBetween('created_at', [$startDate, $endDate]);
                        $scholarshipQuery->whereBetween('created_at', [$startDate, $endDate]);
                    }
                    break;
            }

            // Apply status filter (only if specific status is selected)
            if ($status !== 'all') {
                $query->where('status', $status);
            }

            // Get counts based on filtered queries
            $admissionCounts = [
                'new' => ($category === 'all' || $category === 'admissions') ?
                            $query->where('status', 'new')->count() : 0,
                'accepted' => ($category === 'all' || $category === 'admissions') ?
                            $query->where('status', 'accepted')->count() : 0,
                'rejected' => ($category === 'all' || $category === 'admissions') ?
                            $query->where('status', 'rejected')->count() : 0,
            ];

            $inquiryCounts = [
                'new' => ($category === 'all' || $category === 'inquiries') ?
                            $inquiryQuery->where('inquiry_status', 'New')->count() : 0,
                'resolved' => ($category === 'all' || $category === 'inquiries') ?
                            $inquiryQuery->where('inquiry_status', 'Responded')->count() : 0,
            ];

            $scholarshipCounts = [
                'total' => ($category === 'all' || $category === 'scholarships') ?
                            $scholarshipQuery->count() : 0,
                'approved' => ($category === 'all' || $category === 'scholarships') ?
                            $scholarshipQuery->where('status', 'approved')->count() : 0,
            ];

            // Get monthly trend data with filters applied
            $monthlyTrend = $this->getMonthlyTrend($dateRange, $status, $category);

            return response()->json([
                'admissions' => $admissionCounts,
                'inquiries' => $inquiryCounts,
                'scholarships' => $scholarshipCounts,
                'monthlyTrend' => $monthlyTrend,
                'lastUpdated' => now()->timezone('Asia/Manila')->format('F j, Y g:i A'),
            ]);
        } catch (\Exception $e) {
            Log::error('Analytics error: ' . $e->getMessage());
            return response()->json(['error' => 'Failed to load analytics'], 500);
        }
    }

    private function getMonthlyTrend($dateRange = 'all', $status = 'all', $category = 'all')
    {
        try {
            // Base query
            $query = ApplicantInfo::query();

            // Apply status filter if needed
            if ($status !== 'all') {
                $query->where('status', $status);
            }

            // Determine date range for the trend data
            $startDate = Carbon::now()->subMonths(5)->startOfMonth();
            $endDate = Carbon::now()->endOfMonth();

            if ($dateRange === 'month') {
                // For month filter, show daily trend within current month
                $startDate = Carbon::now()->startOfMonth();
                $endDate = Carbon::now()->endOfMonth();
                $groupBy = 'day';
                $format = 'j'; // Day of month without leading zeros
            } else if ($dateRange === 'week') {
                // For week filter, show daily trend within current week
                $startDate = Carbon::now()->startOfWeek();
                $endDate = Carbon::now()->endOfWeek();
                $groupBy = 'day';
                $format = 'D'; // Short day name (Mon, Tue)
            } else {
                // Default: show monthly trend
                $groupBy = 'month';
                $format = 'M Y'; // Short month name + year
            }

            // Get application counts by time period
            $trends = $query->whereBetween('created_at', [$startDate, $endDate])
                ->select(DB::raw("DATE_FORMAT(created_at, '%$format') as period"),
                         DB::raw('COUNT(*) as count'))
                ->groupBy('period')
                ->orderBy('created_at')
                ->get()
                ->pluck('count', 'period')
                ->toArray();

            // Generate all periods in range (fills in zeros for missing periods)
            $allPeriods = [];
            $currentDate = clone $startDate;
            while ($currentDate <= $endDate) {
                $periodKey = $currentDate->format($format);
                if (!isset($allPeriods[$periodKey])) {
                    $allPeriods[$periodKey] = 0;
                }

                if ($groupBy === 'day') {
                    $currentDate->addDay();
                } else {
                    $currentDate->addMonth();
                }
            }

            // Merge actual data with all periods
            foreach ($trends as $period => $count) {
                $allPeriods[$period] = $count;
            }

            return [
                'labels' => array_keys($allPeriods),
                'data' => array_values($allPeriods)
            ];
        } catch (\Exception $e) {
            Log::error('Monthly trend error: ' . $e->getMessage());
            return [
                'labels' => [],
                'data' => []
            ];
        }
    }

    public function exportAnalytics(Request $request)
    {
        // Get the filter parameters
        $filters = [
            'dateRange' => $request->input('dateRange', 'all'),
            'status' => $request->input('status', 'all'),
            'category' => $request->input('category', 'all')
        ];

        // Get the analytics data with filters applied
        $analyticsController = new \App\Http\Controllers\Api\DashboardAnalyticsController();
        $response = $analyticsController->index($request);
        $analytics = json_decode($response->content(), true);

        $format = $request->input('format', 'excel');

        if ($format === 'pdf') {
            // Generate PDF
            $pdf = PDF::loadView('exports.analytics-pdf', [
                'analytics' => $analytics
            ]);

            return $pdf->download('dashboard-analytics-report.pdf');
        } else {
            // Generate Excel file
            $tempFile = tempnam(sys_get_temp_dir(), 'analytics') . '.xlsx';
            $export = new AnalyticsExport($analytics);
            $export->export($tempFile);

            return response()->download($tempFile, 'dashboard-analytics-report.xlsx', [
                'Content-Type' => 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet',
            ])->deleteFileAfterSend(true);
        }
    }

    private function debugAnalytics(): void
    {
        // Debug Admissions
        \Log::info('Admission Statuses:', [
            'all_statuses' => ApplicantInfo::distinct()->pluck('status')->toArray(),
            'counts' => [
                'new' => ApplicantInfo::where('status', 'new')->count(),
                'accepted' => ApplicantInfo::where('status', 'accepted')->count(),
                'rejected' => ApplicantInfo::where('status', 'rejected')->count(),
            ]
        ]);

        // Debug Inquiries
        \Log::info('Inquiry Statuses:', [
            'all_statuses' => LeadInfo::distinct()->pluck('inquiry_status')->toArray(),
            'counts' => [
                'new' => LeadInfo::where('inquiry_status', 'New')->count(),
                'resolved' => LeadInfo::where('inquiry_status', 'Resolved')->count(),
            ]
        ]);

        // Debug Scholarships
        \Log::info('Scholarship Statuses:', [
            'all_statuses' => ApplicantScholarship::distinct()->pluck('status')->toArray(),
            'counts' => [
                'total' => ApplicantScholarship::count(),
                'approved' => ApplicantScholarship::where('status', 'approved')->count(),
            ]
        ]);
    }

    private function getAnalyticsData($filters)
    {
        // Add debug logging for raw database queries
        \DB::enableQueryLog();

        $admissionCounts = [
            'new' => \DB::table('applicant_infos')->where('status', 'new')->count(),
            'accepted' => \DB::table('applicant_infos')->where('status', 'accepted')->count(),
            'rejected' => \DB::table('applicant_infos')->where('status', 'rejected')->count(),
        ];

        $inquiryCounts = [
            'new' => \DB::table('lead_info')->where('inquiry_status', 'New')->count(),
            'resolved' => \DB::table('lead_info')->where('inquiry_status', 'Resolved')->count(),
        ];

        $scholarshipCounts = [
            'total' => \DB::table('applicant_scholarships')->count(),
            'approved' => \DB::table('applicant_scholarships')->where('status', 'approved')->count(),
        ];

        // Log the actual SQL queries being executed
        Log::info('SQL Queries:', \DB::getQueryLog());

        return [
            'admissions' => $admissionCounts,
            'inquiries' => $inquiryCounts,
            'scholarships' => $scholarshipCounts,
            'monthlyTrend' => $this->getMonthlyTrend(),
            'lastUpdated' => now()->timezone('Asia/Manila')->format('F j, Y g:i A'),
        ];
    }
}

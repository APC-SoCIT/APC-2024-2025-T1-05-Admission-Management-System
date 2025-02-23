<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\ApplicantInfo;
use App\Models\LeadInfo;
use App\Models\ApplicantScholarship;
use Illuminate\Http\JsonResponse;

class DashboardAnalyticsController extends Controller
{
    public function index(): JsonResponse
    {
        $analytics = [
            // Admissions Statistics
            'newApplications' => ApplicantInfo::where('status', 'new')->count(),
            'acceptedApplications' => ApplicantInfo::where('status', 'accepted')->count(),
            'rejectedApplications' => ApplicantInfo::where('status', 'rejected')->count(),

            // Inquiries Statistics
            'newInquiries' => LeadInfo::where('inquiry_status', 'New')->count(),
            'resolvedInquiries' => LeadInfo::where('inquiry_status', 'Resolved')->count(),

            // Scholarship Statistics
            'scholarshipApplications' => ApplicantScholarship::count(),
            'approvedScholarships' => ApplicantScholarship::where('status', 'approved')->count(),

            // Monthly Trend Data (last 6 months)
            'monthlyTrend' => $this->getMonthlyTrend(),

            // Last Updated Timestamp
            'lastUpdated' => now()->toIso8601String()
        ];

        return response()->json($analytics);
    }

    private function getMonthlyTrend(): array
    {
        $months = collect(range(5, 0))->map(function($month) {
            $date = now()->subMonths($month);
            return [
                'month' => $date->format('M'),
                'count' => ApplicantInfo::whereYear('created_at', $date->year)
                    ->whereMonth('created_at', $date->month)
                    ->count()
            ];
        });

        return [
            'labels' => $months->pluck('month')->toArray(),
            'data' => $months->pluck('count')->toArray()
        ];
    }
}

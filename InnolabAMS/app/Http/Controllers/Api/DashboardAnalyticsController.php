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
            'admissions' => [
                'new' => ApplicantInfo::where('status', 'new')->count(),
                'accepted' => ApplicantInfo::where('status', 'accepted')->count(),
                'rejected' => ApplicantInfo::where('status', 'rejected')->count(),
            ],

            // Inquiries Statistics
            'inquiries' => [
                'new' => LeadInfo::where('inquiry_status', 'New')->count(),
                'resolved' => LeadInfo::where('inquiry_status', 'Resolved')->count(),
            ],

            // Scholarship Statistics
            'scholarships' => [
                'total' => ApplicantScholarship::count(),
                'approved' => ApplicantScholarship::where('status', 'approved')->count(),
            ],

            // Monthly Trend Data (last 6 months)
            'monthlyTrend' => $this->getMonthlyTrend(),

            // Last Updated Timestamp - Using Manila time format that JS can parse correctly
            'lastUpdated' => now()->timezone('Asia/Manila')->format('Y-m-d H:i:s'),
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

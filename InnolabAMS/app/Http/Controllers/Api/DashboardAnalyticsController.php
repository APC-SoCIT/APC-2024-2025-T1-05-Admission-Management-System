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
        // Set timezone to Asia/Manila
        date_default_timezone_set('Asia/Manila');

        $currentTime = now()->timezone('Asia/Manila');

        $analytics = [
            'admissions' => [
                'new' => ApplicantInfo::where('status', 'new')->count(),
                'accepted' => ApplicantInfo::where('status', 'accepted')->count(),
                'rejected' => ApplicantInfo::where('status', 'rejected')->count(),
            ],
            'inquiries' => [
                'new' => LeadInfo::where('inquiry_status', 'New')->count(),
                'resolved' => LeadInfo::where('inquiry_status', 'Resolved')->count(),
            ],
            'scholarships' => [
                'total' => ApplicantScholarship::count(),
                'approved' => ApplicantScholarship::where('status', 'approved')->count(),
            ],
            'monthlyTrend' => $this->getMonthlyTrend(),
            'lastUpdated' => $currentTime->format('Y-m-d H:i:s'),
            'timezone' => 'Asia/Manila'
        ];

        // Log the response for debugging
        \Log::info('Analytics response:', $analytics);

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

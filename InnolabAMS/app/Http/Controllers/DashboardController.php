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

    public function getAnalytics(): JsonResponse
    {
        try {
            $data = $this->getAnalyticsData();

            // Debug log the actual data
            Log::info('Analytics Data:', $data);

            return response()->json($data);
        } catch (\Exception $e) {
            Log::error('Analytics Error: ' . $e->getMessage());
            return response()->json(['error' => 'Failed to fetch analytics'], 500);
        }
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

    public function exportAnalytics(Request $request): BinaryFileResponse|Response
    {
        try {
            $format = $request->input('format', 'excel');
            $analytics = $this->getAnalyticsData();

            if ($format === 'excel') {
                $tempFile = storage_path('app/temp/analytics-report.xlsx');

                // Ensure temp directory exists
                if (!file_exists(dirname($tempFile))) {
                    mkdir(dirname($tempFile), 0755, true);
                }

                $exporter = new AnalyticsExport($analytics);
                $exporter->export($tempFile);

                return response()->download($tempFile, 'analytics-report.xlsx', [
                    'Content-Type' => 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet',
                ])->deleteFileAfterSend();
            }

            if ($format === 'pdf') {
                $pdf = PDF::loadView('exports.analytics-pdf', ['analytics' => $analytics]);
                return $pdf->download('analytics-report.pdf');
            }

            return response()->json(['error' => 'Unsupported format'], 400);
        } catch (\Exception $e) {
            report($e); // Log the error
            return response()->json(['error' => 'Failed to generate report'], 500);
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

    private function getAnalyticsData(): array
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
        ];
    }
}

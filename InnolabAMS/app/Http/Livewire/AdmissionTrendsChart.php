<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Application;
use Carbon\Carbon;

class AdmissionTrendsChart extends Component
{
    public $chartData = [];

    public function mount()
    {
        $this->loadChartData();
    }

    public function loadChartData()
    {
        // Get data for the last 5 years
        $years = collect(range(2020, Carbon::now()->year));

        // Fake data with an increasing trend
        $fakeApplications = [950, 1100, 1250, 1600, 1800];
        $fakeExpected = [1000, 1200, 2000, 2000, 2500];

        $this->chartData = [
            'labels' => $years->toArray(),
            'applications' => $fakeApplications,
            'expected' => $fakeExpected,
            'colors' => [
                'applications' => [
                    'border' => '#4F46E5',
                    'background' => '#4F46E5'
                ],
                'expected' => [
                    'border' => '#9333EA',
                    'background' => '#9333EA'
                ]
            ]
        ];
    }

    public function render()
    {
        return view('livewire.admission-trends-chart', [
            'chartData' => $this->chartData
        ]);
    }
}

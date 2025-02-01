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

        $applications = $years->map(function($year) {
            return Application::whereYear('created_at', $year)->count() ?? 0;
        })->toArray();

        $this->chartData = [
            'labels' => $years->toArray(),
            'applications' => $applications,
            'expected' => [1000, 1200, 2000, 2000, 2500], // Example expected values
        ];
    }

    public function render()
    {
        return view('livewire.admission-trends-chart', [
            'chartData' => $this->chartData
        ]);
    }
}

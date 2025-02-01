<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Application;
use Carbon\Carbon;

class AcceptanceRateChart extends Component
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

        $accepted = $years->map(function($year) {
            return Application::whereYear('created_at', $year)
                ->where('status', 'accepted')
                ->count() ?? 0;
        })->toArray();

        $rejected = $years->map(function($year) {
            return Application::whereYear('created_at', $year)
                ->where('status', 'rejected')
                ->count() ?? 0;
        })->toArray();

        $this->chartData = [
            'labels' => $years->toArray(),
            'accepted' => $accepted,
            'rejected' => $rejected,
        ];
    }

    public function render()
    {
        return view('livewire.acceptance-rate-chart', [
            'chartData' => $this->chartData
        ]);
    }
}

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

        // Fake data showing acceptance and rejection trends
        $fakeAccepted = [120, 100, 130, 200, 300];
        $fakeRejected = [20, 15, 25, 30, 20];

        $this->chartData = [
            'labels' => $years->toArray(),
            'accepted' => $fakeAccepted,
            'rejected' => $fakeRejected,
        ];
    }

    public function render()
    {
        return view('livewire.acceptance-rate-chart', [
            'chartData' => $this->chartData
        ]);
    }
}

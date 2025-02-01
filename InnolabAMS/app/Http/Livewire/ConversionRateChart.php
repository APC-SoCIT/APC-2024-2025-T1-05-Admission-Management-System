<?php

namespace App\Http\Livewire;

use Livewire\Component;

class ConversionRateChart extends Component
{
    public $chartData = [];

    public function mount()
    {
        $this->loadChartData();
    }

    public function loadChartData()
    {
        // Fake conversion rate data
        $this->chartData = [
            'labels' => ['Converted', 'Not Converted'],
            'data' => [55.6, 44.4], // 55.6% converted, 44.4% not converted
            'colors' => ['#94A3B8', '#475569'], // Gray colors for the pie chart
        ];
    }

    public function render()
    {
        return view('livewire.conversion-rate-chart', [
            'chartData' => $this->chartData
        ]);
    }
}

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
            'colors' => ['#4F46E5', '#E5E7EB'], // Indigo for converted, Light gray for not converted
            'hoverColors' => ['#4338CA', '#D1D5DB'] // Darker shades for hover
        ];
    }

    public function render()
    {
        return view('livewire.conversion-rate-chart', [
            'chartData' => $this->chartData
        ]);
    }
}

<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Carbon\Carbon;

class AdmissionTrendsChart extends Component
{
    public $chartData;

    public function mount()
    {
        $years = collect(range(2020, Carbon::now()->year));

        $this->chartData = [
            'labels' => $years->toArray(),
            'applications' => [950, 1100, 1250, 1600, 1800],
            'expected' => [1000, 1200, 2000, 2000, 2500],
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

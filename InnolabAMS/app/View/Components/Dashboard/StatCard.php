<?php

namespace App\View\Components\Dashboard;

use Illuminate\View\Component;

class StatCard extends Component
{
    public $title;
    public $value;
    public $color;
    public $icon;

    public function __construct($title, $value, $color = 'gray', $icon = 'fa-chart-bar')
    {
        $this->title = $title;
        $this->value = $value;
        $this->color = $color;
        $this->icon = $icon;
    }

    public function render()
    {
        return view('components.dashboard.stat-card');
    }
}

<?php

namespace App\Livewire\Admission;

use Livewire\Component;

class CreateApplication extends Component
{
    public function render()
    {
        return view('livewire.admission.create-application')
            ->layout('layouts.app');
    }
}

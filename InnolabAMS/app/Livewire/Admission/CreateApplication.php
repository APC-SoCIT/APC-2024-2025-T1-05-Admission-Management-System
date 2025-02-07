<?php

namespace App\Livewire\Admission;

use Livewire\Component;

class CreateApplication extends Component
{
    public $currentStep = 1;
    public $totalSteps = 5;

    // Form Properties
    // Program Selection
    public $program = '';
    public $semester = '';
    public $academicYear = '';

    // Personal Information
    public $firstName = '';
    public $middleName = '';
    public $lastName = '';
    public $birthdate = '';
    public $gender = '';

    // Contact Information
    public $email = '';
    public $phone = '';
    public $address = '';
    public $city = '';
    public $province = '';

    // Previous School
    public $previousSchool = '';
    public $schoolAddress = '';
    public $lastYearAttended = '';
    public $averageGrade = '';

    // Documents
    public $requirements = [];

    public function mount()
    {
        $this->academicYear = '2024-2025'; // Set default academic year
    }

    public function nextStep()
    {
        $this->validateOnly($this->validationRules()[$this->currentStep] ?? []);
        $this->currentStep = min($this->currentStep + 1, $this->totalSteps);
    }

    public function previousStep()
    {
        $this->currentStep = max($this->currentStep - 1, 1);
    }

    public function submit()
    {
        $this->validate($this->validationRules()[$this->currentStep] ?? []);
        // Process form submission
        // Add your logic here
    }

    protected function validationRules()
    {
        return [
            1 => [
                'program' => 'required',
                'semester' => 'required',
                'academicYear' => 'required',
            ],
            2 => [
                'firstName' => 'required|min:2',
                'lastName' => 'required|min:2',
                'birthdate' => 'required|date',
                'gender' => 'required',
            ],
            // Add more validation rules for other steps
        ];
    }

    public function render()
    {
        return view('livewire.admission.create-application');
    }
}

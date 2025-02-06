<?php

namespace App\Http\Livewire\Admission;

use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Redirect;
use Livewire\Component;
use Livewire\WithFileUploads;
use Carbon\Carbon;
use Exception;

class CreateApplication extends Component
{
    use WithFileUploads;

    public $currentStep = 1;
    public $totalSteps = 5;

    // Program Selection (Step 1)
    public $program;
    public $gradeLevel;
    public $strand;

    // Personal Information (Step 2)
    public $firstName;
    public $middleName;
    public $lastName;
    public $noMiddleName = false;
    public $dateOfBirth;
    public $age;
    public $lrn;
    public $sex;
    public $religion;
    public $nationality;
    public $photo;

    // Contact Information (Step 3)
    public $contactNumber;
    public $email;
    public $streetAddress;
    public $province;
    public $city;
    public $emergencyContact = [
        'name' => '',
        'relationship' => '',
        'contact' => ''
    ];

    // Previous School (Step 4)
    public $schoolName;
    public $schoolAddress;
    public $previousGradeLevel;
    public $schoolYear;
    public $previousStrand;

    // Documents (Step 5)
    public $birthCertificate;
    public $form137;
    public $form138;
    public $goodMoral;
    public $grade10Card;
    public $completionCert;

    protected function rules()
    {
        return [
            // Step 1 Validation
            'program' => 'required|in:Elementary,Junior High School,Senior High School',
            'gradeLevel' => 'required',
            'strand' => 'required_if:program,Senior High School',

            // Step 2 Validation
            'firstName' => 'required|min:2',
            'middleName' => 'nullable|min:2',
            'lastName' => 'required|min:2',
            'dateOfBirth' => 'required|date|before:today',
            'lrn' => 'required|digits:12|unique:applicant_infos,lrn',
            'sex' => 'required|in:Male,Female',
            'nationality' => 'required',
            'religion' => 'nullable|string',
            'photo' => 'required|image|max:2048|dimensions:min_width=200,min_height=200',

            // Step 3 Validation
            'contactNumber' => 'required|regex:/^([0-9\s\-\+\(\)]*)$/|min:10',
            'email' => 'required|email',
            'streetAddress' => 'required|string',
            'province' => 'required|string',
            'city' => 'required|string',
            'emergencyContact.name' => 'required|string',
            'emergencyContact.relationship' => 'required|string',
            'emergencyContact.contact' => 'required|regex:/^([0-9\s\-\+\(\)]*)$/|min:10',

            // Step 4 Validation
            'schoolName' => 'required|string',
            'schoolAddress' => 'required|string',
            'previousGradeLevel' => 'required|numeric|min:1|max:12',
            'schoolYear' => 'required|regex:/^\d{4}-\d{4}$/',
            'previousStrand' => 'required_if:program,Senior High School',

            // Step 5 Validation
            'birthCertificate' => 'required|file|mimes:pdf,jpg,jpeg,png|max:2048',
            'form137' => 'required|file|mimes:pdf,jpg,jpeg,png|max:2048',
            'form138' => 'required|file|mimes:pdf,jpg,jpeg,png|max:2048',
            'goodMoral' => 'required|file|mimes:pdf,jpg,jpeg,png|max:2048',
            'grade10Card' => 'required_if:program,Senior High School|file|mimes:pdf,jpg,jpeg,png|max:2048',
            'completionCert' => 'required_if:program,Senior High School|file|mimes:pdf,jpg,jpeg,png|max:2048',
        ];
    }

    protected function messages()
    {
        return [
            'program.required' => 'Please select a program.',
            'gradeLevel.required' => 'Please select a grade level.',
            'strand.required_if' => 'Please select a strand for Senior High School.',
            'lrn.digits' => 'LRN must be exactly 12 digits.',
            'lrn.unique' => 'This LRN is already registered.',
            'photo.dimensions' => 'Photo must be at least 2x2 inches in size.',
            'emergencyContact.name.required' => 'Emergency contact name is required.',
            'emergencyContact.relationship.required' => 'Please specify the relationship with emergency contact.',
            'emergencyContact.contact.required' => 'Emergency contact number is required.',
            'schoolYear.regex' => 'School year must be in format YYYY-YYYY (e.g., 2023-2024).',
        ];
    }

    public function mount()
    {
        $this->initializeSteps();
    }

    public function initializeSteps()
    {
        // Initialize any default values or load saved progress
        $this->currentStep = 1;
    }

    public function render()
    {
        return view('livewire.admission.create-application');
    }

    public function nextStep()
    {
        $this->validateStep($this->currentStep);
        if ($this->currentStep < $this->totalSteps) {
            $this->currentStep++;
        }
    }

    public function previousStep()
    {
        if ($this->currentStep > 1) {
            $this->currentStep--;
        }
    }

    private function validateStep($step)
    {
        $validationRules = $this->getStepValidationRules($step);
        $this->validateOnly(array_keys($validationRules));
    }

    private function getStepValidationRules($step)
    {
        $stepFields = [
            1 => ['program', 'gradeLevel', 'strand'],
            2 => ['firstName', 'middleName', 'lastName', 'dateOfBirth', 'lrn', 'sex', 'nationality', 'religion', 'photo'],
            3 => ['contactNumber', 'email', 'streetAddress', 'province', 'city', 'emergencyContact.name', 'emergencyContact.relationship', 'emergencyContact.contact'],
            4 => ['schoolName', 'schoolAddress', 'previousGradeLevel', 'schoolYear', 'previousStrand'],
            5 => ['birthCertificate', 'form137', 'form138', 'goodMoral', 'grade10Card', 'completionCert'],
        ];

        return collect($this->rules())
            ->filter(function ($rule, $field) use ($stepFields, $step) {
                return in_array($field, $stepFields[$step]);
            })->toArray();
    }

    public function updatedDateOfBirth($value)
    {
        if ($value) {
            $this->age = Carbon::parse($value)->age;
        }
    }

    public function updatedNoMiddleName($value)
    {
        if ($value) {
            $this->middleName = null;
        }
    }

    public function submit()
    {
        $this->validate($this->rules());

        try {
            // Handle file uploads and save application
            $paths = $this->storeFiles();

            // Create application record
            // Add your database insertion logic here

            session()->flash('message', 'Application submitted successfully!');
            return redirect()->route('admission.index');
        } catch (Exception $e) {
            session()->flash('error', 'There was an error submitting your application. Please try again.');
            return null;
        }
    }

    private function storeFiles()
    {
        return [
            'photo' => $this->photo->store('applicant-photos', 'public'),
            'birthCertificate' => $this->birthCertificate->store('documents', 'public'),
            'form137' => $this->form137->store('documents', 'public'),
            'form138' => $this->form138->store('documents', 'public'),
            'goodMoral' => $this->goodMoral->store('documents', 'public'),
            'grade10Card' => $this->program === 'Senior High School' ? $this->grade10Card->store('documents', 'public') : null,
            'completionCert' => $this->program === 'Senior High School' ? $this->completionCert->store('documents', 'public') : null,
        ];
    }
}

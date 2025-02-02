@extends('dashboard')
@section('title', 'Add Applicant | InnolabAMS')

@section('content')
<div class="container mx-auto px-6 py-4" x-data="admissionForm()">
    <div class="flex justify-between items-center mb-4">
        <h1 class="text-2xl font-semibold">Add New Applicant</h1>
        <a href="{{ route('admission.new') }}" class="bg-gray-500 text-white px-4 py-2 rounded hover:bg-gray-600">
            <i class="fas fa-arrow-left mr-2"></i>Back
        </a>
    </div>

    <div class="bg-white rounded-lg shadow-lg p-6">
        <form action="{{ route('admission.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <!-- Program Selection -->
            <div class="mb-8">
                <h2 class="text-xl font-semibold mb-4 pb-2 border-b">Program Information</h2>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Program</label>
                        <select
                            name="program"
                            x-model="selectedProgram"
                            @change="updateGradeLevels"
                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"
                            required
                        >
                            <option disabled value="">Select Program</option>
                            <option value="Elementary">Elementary</option>
                            <option value="Junior High School">Junior High School</option>
                            <option value="Senior High School">Senior High School</option>
                        </select>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700">Grade Level</label>
                        <select
                            name="grade_level"
                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"
                            required
                        >
                            <option disabled value="">Select Grade Level</option>
                            <template x-for="grade in availableGrades" :key="grade">
                                <option :value="grade" x-text="'Grade ' + grade"></option>
                            </template>
                        </select>
                    </div>

                    <!-- Strand Selection for Senior High -->
                    <div x-show="selectedProgram === 'Senior High School'" class="md:col-span-2">
                        <label class="block text-sm font-medium text-gray-700">Strand</label>
                        <select
                            name="strand"
                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"
                            :required="selectedProgram === 'Senior High School'"
                        >
                            <option value="">Select Strand</option>
                            <option value="STEM">STEM (Science, Technology, Engineering, and Mathematics)</option>
                            <option value="ABM">ABM (Accountancy, Business, and Management)</option>
                            <option value="HUMSS">HUMSS (Humanities and Social Sciences)</option>
                            <option value="GAS">GAS (General Academic Strand)</option>
                            <option value="TVL">TVL (Technical-Vocational-Livelihood)</option>
                        </select>
                    </div>
                </div>
            </div>

            <!-- Personal Information -->
            <div class="mb-8">
                <h2 class="text-xl font-semibold mb-4 pb-2 border-b">Personal Information</h2>
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                    <x-forms.input-field
                        name="first_name"
                        label="First Name"
                        required="true"
                        placeholder="Enter first name"
                    />

                    <x-forms.input-field
                        name="middle_name"
                        label="Middle Name"
                        placeholder="Enter middle name"
                    />

                    <x-forms.input-field
                        name="last_name"
                        label="Last Name"
                        required="true"
                        placeholder="Enter last name"
                    />

                    <x-forms.input-field
                        type="date"
                        name="date_of_birth"
                        label="Date of Birth"
                        required="true"
                        x-model="dateOfBirth"
                        @change="calculateAge"
                    />

                    <x-forms.input-field
                        type="number"
                        name="age"
                        label="Age"
                        required="true"
                        x-model="age"
                        readonly
                    />

                    <div>
                        <label class="block text-sm font-medium text-gray-700">Sex</label>
                        <select
                            name="sex"
                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"
                            required
                        >
                            <option value="">Select Sex</option>
                            <option value="Male">Male</option>
                            <option value="Female">Female</option>
                        </select>
                    </div>
                </div>
            </div>

            <!-- Contact Information -->
            <div class="mb-8">
                <h2 class="text-xl font-semibold mb-4 pb-2 border-b">Contact Information</h2>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <x-forms.input-field
                        type="tel"
                        name="contact_number"
                        label="Contact Number"
                        required="true"
                        placeholder="Enter contact number"
                    />

                    <x-forms.input-field
                        type="email"
                        name="email"
                        label="Email Address"
                        required="true"
                        placeholder="Enter email address"
                    />

                    <div class="md:col-span-2">
                        <x-forms.input-field
                            name="address_street"
                            label="Street Address"
                            required="true"
                            placeholder="Enter street address"
                        />
                    </div>

                    <x-forms.input-field
                        name="address_city"
                        label="City"
                        required="true"
                        placeholder="Enter city"
                    />

                    <x-forms.input-field
                        name="address_province"
                        label="Province"
                        required="true"
                        placeholder="Enter province"
                    />
                </div>
            </div>

            <!-- Previous School Information -->
            <div class="mb-8">
                <h2 class="text-xl font-semibold mb-4 pb-2 border-b">Previous School Information</h2>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <x-forms.input-field
                        name="previous_school"
                        label="School Name"
                        required="true"
                        placeholder="Enter previous school name"
                    />

                    <x-forms.input-field
                        name="previous_school_address"
                        label="School Address"
                        required="true"
                        placeholder="Enter previous school address"
                    />
                </div>
            </div>

            <!-- Required Documents -->
            <div class="mb-8">
                <h2 class="text-xl font-semibold mb-4 pb-2 border-b">Required Documents</h2>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <!-- Elementary Requirements -->
                    <template x-if="selectedProgram === 'Elementary'">
                        <div class="md:col-span-2 grid grid-cols-1 md:grid-cols-2 gap-6">
                            <x-forms.file-upload
                                name="birth_certificate"
                                label="Birth Certificate"
                                required="true"
                            />
                            <x-forms.file-upload
                                name="report_card"
                                label="Report Card"
                                required="true"
                            />
                            <x-forms.file-upload
                                name="proof_of_residency"
                                label="Proof of Residency"
                                required="true"
                            />
                        </div>
                    </template>

                    <!-- Junior High School Requirements -->
                    <template x-if="selectedProgram === 'Junior High School'">
                        <div class="md:col-span-2 grid grid-cols-1 md:grid-cols-2 gap-6">
                            <x-forms.file-upload
                                name="form_137"
                                label="Form 137"
                                required="true"
                            />
                            <x-forms.file-upload
                                name="report_card"
                                label="Report Card"
                                required="true"
                            />
                            <x-forms.file-upload
                                name="good_moral"
                                label="Good Moral Certificate"
                                required="true"
                            />
                        </div>
                    </template>

                    <!-- Senior High School Requirements -->
                    <template x-if="selectedProgram === 'Senior High School'">
                        <div class="md:col-span-2 grid grid-cols-1 md:grid-cols-2 gap-6">
                            <x-forms.file-upload
                                name="form_137"
                                label="Form 137"
                                required="true"
                            />
                            <x-forms.file-upload
                                name="report_card"
                                label="Report Card"
                                required="true"
                            />
                            <x-forms.file-upload
                                name="good_moral"
                                label="Good Moral Certificate"
                                required="true"
                            />
                        </div>
                    </template>
                </div>
            </div>

            <!-- Submit Button -->
            <div class="flex justify-end">
                <button type="submit" class="bg-blue-500 text-white px-6 py-2 rounded hover:bg-blue-600">
                    Submit Application
                </button>
            </div>
        </form>
    </div>
</div>

<script>
    function admissionForm() {
        return {
            selectedProgram: '',
            availableGrades: [],
            dateOfBirth: '',
            age: '',

            updateGradeLevels() {
                switch(this.selectedProgram) {
                    case 'Elementary':
                        this.availableGrades = ['1', '2', '3', '4', '5', '6'];
                        break;
                    case 'Junior High School':
                        this.availableGrades = ['7', '8', '9', '10'];
                        break;
                    case 'Senior High School':
                        this.availableGrades = ['11', '12'];
                        break;
                    default:
                        this.availableGrades = [];
                }
                this.selectedGrade = '';
            },

            calculateAge() {
                if (this.dateOfBirth) {
                    const birthDate = new Date(this.dateOfBirth);
                    const today = new Date();
                    let age = today.getFullYear() - birthDate.getFullYear();
                    const monthDiff = today.getMonth() - birthDate.getMonth();

                    if (monthDiff < 0 || (monthDiff === 0 && today.getDate() < birthDate.getDate())) {
                        age--;
                    }

                    this.age = age;
                }
            }
        }
    }
</script>
@endsection

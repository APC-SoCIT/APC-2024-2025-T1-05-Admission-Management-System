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

            <!-- Program Information -->
            <div class="mb-8">
                <h2 class="text-xl font-semibold mb-4">Program Information</h2>
                <div class="grid grid-cols-2 gap-6">
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Program Level</label>
                        <select
                            name="program"
                            x-model="selectedProgram"
                            @change="updateGradeLevels"
                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"
                            required
                        >
                            <option value="">Select Program</option>
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
                            <option value="">Select Grade Level</option>
                            <template x-for="grade in availableGrades" :key="grade">
                                <option :value="grade" x-text="'Grade ' + grade"></option>
                            </template>
                        </select>
                    </div>
                </div>
            </div>

            <!-- Student Information -->
            <div class="mb-8">
                <h2 class="text-xl font-semibold mb-4">Student Information</h2>
                <div class="grid grid-cols-1 gap-6">
                    <div>
                        <label class="block text-sm font-medium text-gray-700">First Name*</label>
                        <input type="text" name="first_name" required
                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700">Middle Name</label>
                        <input type="text" name="middle_name"
                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700">Last Name*</label>
                        <input type="text" name="last_name" required
                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                    </div>

                    <div class="flex justify-center items-center border-2 border-dashed border-gray-300 rounded-lg p-6">
                        <div class="text-center">
                            <div class="text-gray-400 mb-2">
                                <i class="fas fa-camera text-4xl"></i>
                            </div>
                            <p class="text-gray-600">Upload 2x2 Photo</p>
                            <input type="file" name="photo" class="hidden" id="photo-upload">
                            <button type="button" onclick="document.getElementById('photo-upload').click()"
                                class="mt-2 px-4 py-2 bg-gray-200 text-gray-700 rounded-md hover:bg-gray-300">
                                Choose File
                            </button>
                        </div>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700">LRN*</label>
                        <input type="text" name="lrn" required
                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700">Nationality*</label>
                        <input type="text" name="nationality" required
                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700">Religion</label>
                        <input type="text" name="religion"
                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                    </div>
                </div>
            </div>

            <!-- Family Information -->
            <div class="mb-8">
                <h2 class="text-xl font-semibold mb-4">Family Information</h2>
                <div class="grid grid-cols-1 gap-6">
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Father's Information</label>
                        <input type="text" name="father_name" placeholder="Full Name"
                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                    </div>
                </div>
            </div>

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
            }
        }
    }
</script>
@endsection

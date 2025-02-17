@extends('dashboard')
@section('title', 'Add Applicant | InnolabAMS')

@section('content')
<div class="container mx-auto px-6 py-4">
    <div class="flex justify-between items-center mb-4">
        <h1 class="text-2xl font-semibold">Add New Applicant</h1>
        <a href="{{ route('admission.index') }}" class="bg-gray-500 text-white px-4 py-2 rounded hover:bg-gray-600">
            <i class="fas fa-arrow-left mr-2"></i>Back
        </a>
    </div>

    <div class="bg-white rounded-lg shadow-lg p-6">
        <form action="{{ route('admission.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <!-- Program Information -->
            <div class="mb-8">
                <h2 class="text-xl font-semibold mb-4 pb-2 border-b">Program Information</h2>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Program</label>
                        <select name="apply_program" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" required>
                            <option value="">Select Program</option>
                            <option value="Elementary">Elementary</option>
                            <option value="High School">High School</option>
                            <option value="Senior High School">Senior High School</option>
                        </select>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Grade Level</label>
                        <select name="apply_grade_level" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" required>
                            <option value="">Select Grade Level</option>
                        </select>
                    </div>
                    <div id="strandContainer" style="display: none;">
                        <label class="block text-sm font-medium text-gray-700">Strand</label>
                        <select name="apply_strand" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                            <option value="">Select Strand</option>
                            <option value="STEM">STEM</option>
                            <option value="ABM">ABM</option>
                            <option value="TECHVOC">TECHVOC</option>
                            <option value="HUMSS">HUMSS</option>
                            <option value="GAS">GAS</option>
                        </select>
                    </div>
                </div>
            </div>

            <div class="md:col-span-2">
                <label class="block text-sm font-medium text-gray-700">Student Type <span class="text-red-500">*</span></label>
                <div class="mt-2 space-y-2">
                    <label class="inline-flex items-center">
                        <input type="radio" name="student_type" value="Transferee" x-model="studentType" class="form-radio">
                        <span class="ml-2">Transferee</span>
                    </label>
                    <label class="inline-flex items-center ml-6">
                        <input type="radio" name="student_type" value="Existing Student" x-model="studentType" class="form-radio">
                        <span class="ml-2">Existing Student</span>
                    </label>
                    <label class="inline-flex items-center ml-6">
                        <input type="radio" name="student_type" value="Returning Student" x-model="studentType" class="form-radio">
                        <span class="ml-2">Returning Student</span>
                    </label>
                </div>
            </div>

            <!-- Personal Information -->
            <div class="mb-8">
                <h2 class="text-xl font-semibold mb-4 pb-2 border-b">Personal Information</h2>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Surname</label>
                        <input type="text" name="applicant_surname" required class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Given Name</label>
                        <input type="text" name="applicant_given_name" required class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Middle Name</label>
                        <input type="text" name="applicant_middle_name" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Extension Name</label>
                        <input type="text" name="applicant_extension" placeholder="Jr., II, III, etc." class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Sex</label>
                        <select name="gender" required class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                            <option value="">Select Sex</option>
                            <option value="Male">Male</option>
                            <option value="Female">Female</option>
                        </select>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Age</label>
                        <input type="number" name="age" id="age" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" readonly>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Date of Birth</label>
                        <input type="date" name="applicant_date_birth" id="applicant_date_birth" required class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Place of Birth</label>
                        <input type="text" name="applicant_place_birth" required class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Nationality</label>
                        <input type="text" name="applicant_nationality" required class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Religion</label>
                        <input type="text" name="applicant_religion" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Tel. No.</label>
                        <input type="text" name="applicant_tel_no" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Mobile Number</label>
                        <input type="tel" name="applicant_mobile_number" required class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                    </div>
                </div>
            </div>

            <!-- Contact Information -->
            <div class="mb-8">
                <h2 class="text-xl font-semibold mb-4 pb-2 border-b">Contact Information</h2>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Province</label>
                        <input type="text" name="applicant_address_province" value="Metro Manila" readonly class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700">City</label>
                        <select name="applicant_address_city" required class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                            <option value="">Select City</option>
                            <option value="Caloocan">Caloocan</option>
                            <option value="Las Piñas">Las Piñas</option>
                            <option value="Makati">Makati</option>
                            <option value="Malabon">Malabon</option>
                            <option value="Mandaluyong">Mandaluyong</option>
                            <option value="Manila">Manila</option>
                            <option value="Marikina">Marikina</option>
                            <option value="Muntinlupa">Muntinlupa</option>
                            <option value="Navotas">Navotas</option>
                            <option value="Parañaque">Parañaque</option>
                            <option value="Pasay">Pasay</option>
                            <option value="Pasig">Pasig</option>
                            <option value="Quezon City">Quezon City</option>
                            <option value="San Juan">San Juan</option>
                            <option value="Taguig">Taguig</option>
                            <option value="Valenzuela">Valenzuela</option>
                            <option value="Pateros">Pateros</option>
                        </select>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Barangay</label>
                        <input type="text" name="applicant_barangay" required class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                    </div>
                    <div class="md:col-span-2">
                        <label class="block text-sm font-medium text-gray-700">Street Address</label>
                        <input type="text" name="applicant_address_street" required class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                    </div>
                </div>
            </div>

            <!-- Educational Background -->
            <div class="mb-8">
                <h2 class="text-xl font-semibold mb-4 pb-2 border-b">Educational Background</h2>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label class="block text-sm font-medium text-gray-700">LRN</label>
                        <input type="text"
                               name="lrn"
                               maxlength="12"
                               class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700">School Name</label>
                        <input type="text" name="school_name" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                    </div>
                    <div class="md:col-span-2">
                        <label class="block text-sm font-medium text-gray-700">School Address</label>
                        <input type="text" name="school_address" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Previous Program</label>
                        <input type="text" name="previous_program" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Year of Graduation</label>
                        <input type="text"
                               name="year_of_graduation"
                               maxlength="4"
                               class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Awards/Honors</label>
                        <input type="text" name="awards_honors" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700">GWA</label>
                        <input type="number" step="0.01" name="gwa" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                    </div>
                </div>
            </div>

            <!-- Family Information -->
            <div class="mb-8">
                <h2 class="text-xl font-semibold mb-4 pb-2 border-b">Family Information</h2>

                <!-- Father's Information -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Father's First Name</label>
                        <input type="text" name="father_given_name" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Father's Middle Name</label>
                        <input type="text" name="father_middle_name" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Father's Last Name</label>
                        <input type="text" name="father_surname" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                    </div>
                    <div class="md:col-span-2">
                        <label class="block text-sm font-medium text-gray-700">Father's Contact Number</label>
                        <input type="text"
                               name="father_contact"
                               maxlength="11"
                               class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                    </div>
                </div>

                <!-- Mother's Information -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Mother's First Name</label>
                        <input type="text" name="mother_given_name" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Mother's Middle Name</label>
                        <input type="text" name="mother_middle_name" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700">Mother's Last Name</label>
                        <input type="text" name="mother_last_name" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                    </div>
                    <div class="md:col-span-2">
                        <label class="block text-sm font-medium text-gray-700">Mother's Contact Number</label>
                        <input type="text"
                               name="mother_contact"
                               maxlength="11"
                               class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                    </div>
                </div>

                <!-- Guardian's Information -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Guardian's First Name</label>
                        <input type="text" name="guardian_given_name" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Guardian's Middle Name</label>
                        <input type="text" name="guardian_middle_name" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Guardian's Last Name</label>
                        <input type="text" name="guardian_surname" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Guardian's Contact Number</label>
                        <input type="text"
                               name="guardian_contact_num"
                               maxlength="11"
                               class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                    </div>
                </div>

                <!-- Siblings Information -->
                <div class="mb-6">
                    <label class="block text-sm font-medium text-gray-700 mb-2">Siblings</label>
                    <div id="siblings-container">
                        <div class="sibling-entry grid grid-cols-5 gap-4 mb-4">
                            <input type="text" name="siblings[0][full_name]" placeholder="Full Name" class="rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                            <input type="date" name="siblings[0][date_of_birth]" onchange="calculateSiblingAge(this)" class="rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                            <input type="number" name="siblings[0][age]" placeholder="Age" readonly class="rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                            <select name="siblings[0][grade_level]" class="rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                                <option value="">Select Grade Level</option>
                                @for ($i = 1; $i <= 12; $i++)
                                    <option value="Grade {{ $i }}">Grade {{ $i }}</option>
                                @endfor
                            </select>
                            <input type="text" name="siblings[0][school_attended]" placeholder="School Attended" class="rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                        </div>
                    </div>
                    <button type="button" id="add-sibling" class="mt-2 px-4 py-2 bg-blue-500 text-white rounded-md hover:bg-blue-600">
                        Add Sibling
                    </button>
                </div>
            </div>

            <!-- Emergency Contact -->
            <div class="mb-8">
                <h2 class="text-xl font-semibold mb-4 pb-2 border-b">Emergency Contact</h2>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div class="md:col-span-2">
                        <label class="block text-sm font-medium text-gray-700">Complete Name</label>
                        <input type="text" name="emergency_contact_name" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                    </div>
                    <div class="md:col-span-2">
                        <label class="block text-sm font-medium text-gray-700">Complete Address</label>
                        <input type="text" name="emergency_contact_address" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Tel. No.</label>
                        <input type="text"
                               name="emergency_contact_tel"
                               maxlength="11"
                               class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Mobile No.</label>
                        <input type="text"
                               name="emergency_contact_mobile"
                               maxlength="11"
                               class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                    </div>
                    <div class="md:col-span-2">
                        <label class="block text-sm font-medium text-gray-700">Email</label>
                        <input type="email" name="emergency_contact_email" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                    </div>
                </div>
            </div>

            <!-- Submit Button -->
            <div class="flex justify-end">
                <button type="submit" class="bg-blue-500 text-white px-6 py-2 rounded hover:bg-blue-600">
                    Create Application
                </button>
            </div>
        </form>
    </div>
</div>

@push('scripts')
<script>
    // Function to validate input and show error message
    function validateInput(event) {
        const input = event.target;
        const value = input.value;

        // Skip validation for sibling fields
        if (input.name.startsWith('siblings[')) {
            // Clear any existing error messages for sibling fields
            if (input.nextElementSibling && input.nextElementSibling.classList.contains('error-message')) {
                input.nextElementSibling.remove();
            }
            input.classList.remove('border-red-500');
            return;
        }

        // Skip validation for fields that allow special characters and numbers
        if (input.name === 'applicant_barangay' ||
            input.name === 'applicant_address_street' ||
            input.name === 'school_address' ||
            input.name === 'emergency_contact_address' ||
            input.name === 'awards_honors' ||
            input.name === 'previous_program' ||
            input.name === 'school_name' ||
            input.name === 'applicant_extension') {
            return;
        }

        const isValid = /^[a-zA-Z\s]*$/.test(value);

        if (!isValid) {
            input.classList.add('border-red-500');
            // Only add error message if it doesn't exist
            if (!input.nextElementSibling || !input.nextElementSibling.classList.contains('error-message')) {
                const errorMessage = document.createElement('span');
                errorMessage.className = 'error-message text-red-500 text-sm';
                errorMessage.textContent = 'Please enter a valid input';
                input.parentNode.appendChild(errorMessage);
            }
        } else {
            input.classList.remove('border-red-500');
            // Remove error message if it exists
            if (input.nextElementSibling && input.nextElementSibling.classList.contains('error-message')) {
                input.nextElementSibling.remove();
            }
        }
    }

    // Add event listeners to fields that should only accept letters
    document.querySelectorAll('input[type="text"]').forEach(input => {
        // Skip validation for sibling fields and other excluded fields
        if (!input.name.startsWith('siblings[') && ![
            'applicant_tel_no',
            'applicant_mobile_number',
            'father_contact',
            'mother_contact',
            'emergency_contact_tel',
            'emergency_contact_mobile',
            'emergency_contact_email',
            'applicant_barangay',
            'applicant_address_street',
            'school_address',
            'emergency_contact_address',
            'awards_honors',
            'previous_program',
            'school_name'
        ].includes(input.name)) {
            input.addEventListener('input', validateInput);
        }
    });

    // Show/hide strand selection based on program selection
    document.querySelector('select[name="apply_program"]').addEventListener('change', function() {
        const strandContainer = document.getElementById('strandContainer');
        const gradeLevelSelect = document.querySelector('select[name="apply_grade_level"]');
        const program = this.value;

        // Update grade level options based on selected program
        gradeLevelSelect.innerHTML = ''; // Clear existing options
        let gradeOptions = '';

        if (program === 'Elementary') {
            gradeOptions = generateGradeOptions(1, 6);
            strandContainer.style.display = 'none';
        } else if (program === 'High School') {
            gradeOptions = generateGradeOptions(7, 10);
            strandContainer.style.display = 'none';
        } else if (program === 'Senior High School') {
            gradeOptions = generateGradeOptions(11, 12);
            strandContainer.style.display = 'block';
        }

        gradeLevelSelect.innerHTML = gradeOptions;
    });

    // Function to generate grade options
    function generateGradeOptions(start, end) {
        let options = '<option value="">Select Grade Level</option>';
        for (let i = start; i <= end; i++) {
            options += `<option value="${i}">Grade ${i}</option>`;
        }
        return options;
    }

    // Function to calculate age based on birthdate
    function calculateAge(birthDate) {
        const today = new Date();
        const birth = new Date(birthDate);
        let age = today.getFullYear() - birth.getFullYear();
        const monthDiff = today.getMonth() - birth.getMonth();

        if (monthDiff < 0 || (monthDiff === 0 && today.getDate() < birth.getDate())) {
            age--;
        }

        return age;
    }

    // Event listener for birthdate change
    document.getElementById('applicant_date_birth').addEventListener('change', function() {
        const ageInput = document.getElementById('age');
        const birthDate = this.value;
        if (birthDate) {
            const age = calculateAge(birthDate);
            ageInput.value = age;
        } else {
            ageInput.value = '';
        }
    });

    // Sibling entries handling
    let siblingCount = 1;
    document.getElementById('add-sibling').addEventListener('click', function() {
        const container = document.getElementById('siblings-container');
        const newEntry = document.createElement('div');
        newEntry.className = 'sibling-entry grid grid-cols-5 gap-4 mb-4';
        newEntry.innerHTML = `
            <input type="text" name="siblings[${siblingCount}][full_name]" placeholder="Full Name" class="rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
            <input type="date" name="siblings[${siblingCount}][date_of_birth]" onchange="calculateSiblingAge(this)" class="rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
            <input type="number" name="siblings[${siblingCount}][age]" placeholder="Age" readonly class="rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
            <select name="siblings[${siblingCount}][grade_level]" class="rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                <option value="">Select Grade Level</option>
                ${generateGradeOptions(1, 12)}
            </select>
            <input type="text" name="siblings[${siblingCount}][school_attended]" placeholder="School Attended" class="rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
        `;
        container.appendChild(newEntry);
        siblingCount++;
    });

    // Function to calculate sibling age
    function calculateSiblingAge(dateInput) {
        const ageInput = dateInput.parentNode.querySelector('input[name$="[age]"]');
        const birthDate = dateInput.value;

        if (birthDate) {
            const today = new Date();
            const birth = new Date(birthDate);
            let age = today.getFullYear() - birth.getFullYear();
            const monthDiff = today.getMonth() - birth.getMonth();

            if (monthDiff < 0 || (monthDiff === 0 && today.getDate() < birth.getDate())) {
                age--;
            }

            ageInput.value = age;
        } else {
            ageInput.value = '';
        }
    }

    // Add event listener to initial sibling's date of birth field
    document.querySelector('input[name="siblings[0][date_of_birth]"]').addEventListener('change', function() {
        calculateSiblingAge(this);
    });

    // Make initial sibling's age field readonly
    document.querySelector('input[name="siblings[0][age]"]').readOnly = true;

    // LRN field validation
    document.querySelector('input[name="lrn"]').addEventListener('input', function(e) {
        const isValid = /^[0-9]*$/.test(this.value);

        if (!isValid) {
            this.classList.add('border-red-500');
            if (!this.nextElementSibling || !this.nextElementSibling.classList.contains('error-message')) {
                const errorMessage = document.createElement('span');
                errorMessage.className = 'error-message text-red-500 text-sm';
                errorMessage.textContent = 'Please enter a valid input (numbers only)';
                this.parentNode.appendChild(errorMessage);
            }
        } else {
            this.classList.remove('border-red-500');
            if (this.nextElementSibling && this.nextElementSibling.classList.contains('error-message')) {
                this.nextElementSibling.remove();
            }
        }

        // Limit to 12 digits
        if (this.value.length > 12) {
            this.value = this.value.slice(0, 12);
        }
    });

    // Year of Graduation field validation
    document.querySelector('input[name="year_of_graduation"]').addEventListener('input', function(e) {
        const isValid = /^[0-9]*$/.test(this.value);

        if (!isValid) {
            this.classList.add('border-red-500');
            if (!this.nextElementSibling || !this.nextElementSibling.classList.contains('error-message')) {
                const errorMessage = document.createElement('span');
                errorMessage.className = 'error-message text-red-500 text-sm';
                errorMessage.textContent = 'Please enter a valid year (numbers only)';
                this.parentNode.appendChild(errorMessage);
            }
        } else {
            this.classList.remove('border-red-500');
            if (this.nextElementSibling && this.nextElementSibling.classList.contains('error-message')) {
                this.nextElementSibling.remove();
            }
        }

        // Limit to 4 digits
        if (this.value.length > 4) {
            this.value = this.value.slice(0, 4);
        }
    });

    // Father's contact number validation
    document.querySelector('input[name="father_contact"]').addEventListener('input', function(e) {
        const isValid = /^[0-9]*$/.test(this.value);

        if (!isValid) {
            this.classList.add('border-red-500');
            if (!this.nextElementSibling || !this.nextElementSibling.classList.contains('error-message')) {
                const errorMessage = document.createElement('span');
                errorMessage.className = 'error-message text-red-500 text-sm';
                errorMessage.textContent = 'Please enter a valid contact number (numbers only)';
                this.parentNode.appendChild(errorMessage);
            }
        } else {
            this.classList.remove('border-red-500');
            if (this.nextElementSibling && this.nextElementSibling.classList.contains('error-message')) {
                this.nextElementSibling.remove();
            }
        }

        // Limit to 11 digits
        if (this.value.length > 11) {
            this.value = this.value.slice(0, 11);
        }
    });

    // Mother's contact number validation
    document.querySelector('input[name="mother_contact"]').addEventListener('input', function(e) {
        const isValid = /^[0-9]*$/.test(this.value);

        if (!isValid) {
            this.classList.add('border-red-500');
            if (!this.nextElementSibling || !this.nextElementSibling.classList.contains('error-message')) {
                const errorMessage = document.createElement('span');
                errorMessage.className = 'error-message text-red-500 text-sm';
                errorMessage.textContent = 'Please enter a valid contact number (numbers only)';
                this.parentNode.appendChild(errorMessage);
            }
        } else {
            this.classList.remove('border-red-500');
            if (this.nextElementSibling && this.nextElementSibling.classList.contains('error-message')) {
                this.nextElementSibling.remove();
            }
        }

        // Limit to 11 digits
        if (this.value.length > 11) {
            this.value = this.value.slice(0, 11);
        }
    });

    // Emergency contact telephone validation
    document.querySelector('input[name="emergency_contact_tel"]').addEventListener('input', function(e) {
        const isValid = /^[0-9]*$/.test(this.value);

        if (!isValid) {
            this.classList.add('border-red-500');
            if (!this.nextElementSibling || !this.nextElementSibling.classList.contains('error-message')) {
                const errorMessage = document.createElement('span');
                errorMessage.className = 'error-message text-red-500 text-sm';
                errorMessage.textContent = 'Please enter a valid telephone number (numbers only)';
                this.parentNode.appendChild(errorMessage);
            }
        } else {
            this.classList.remove('border-red-500');
            if (this.nextElementSibling && this.nextElementSibling.classList.contains('error-message')) {
                this.nextElementSibling.remove();
            }
        }

        // Limit to 11 digits
        if (this.value.length > 11) {
            this.value = this.value.slice(0, 11);
        }
    });

    // Emergency contact mobile validation
    document.querySelector('input[name="emergency_contact_mobile"]').addEventListener('input', function(e) {
        const isValid = /^[0-9]*$/.test(this.value);

        if (!isValid) {
            this.classList.add('border-red-500');
            if (!this.nextElementSibling || !this.nextElementSibling.classList.contains('error-message')) {
                const errorMessage = document.createElement('span');
                errorMessage.className = 'error-message text-red-500 text-sm';
                errorMessage.textContent = 'Please enter a valid mobile number (numbers only)';
                this.parentNode.appendChild(errorMessage);
            }
        } else {
            this.classList.remove('border-red-500');
            if (this.nextElementSibling && this.nextElementSibling.classList.contains('error-message')) {
                this.nextElementSibling.remove();
            }
        }

        // Limit to 11 digits
        if (this.value.length > 11) {
            this.value = this.value.slice(0, 11);
        }
    });

    // Function to validate numeric input
    function validateNumericInput(event) {
        const input = event.target;
        const value = input.value;
        const isValid = /^[0-9]*$/.test(value);

        if (!isValid) {
            input.classList.add('border-red-500');
            // Only add error message if it doesn't exist
            if (!input.nextElementSibling || !input.nextElementSibling.classList.contains('error-message')) {
                const errorMessage = document.createElement('span');
                errorMessage.className = 'error-message text-red-500 text-sm';
                errorMessage.textContent = 'Please enter numbers only';
                input.parentNode.appendChild(errorMessage);
            }
        } else {
            input.classList.remove('border-red-500');
            // Remove error message if it exists
            if (input.nextElementSibling && input.nextElementSibling.classList.contains('error-message')) {
                input.nextElementSibling.remove();
            }
        }

        // Enforce maximum length of 11 digits
        if (value.replace(/[^0-9]/g, '').length > 11) {
            input.value = value.slice(0, value.length - 1);
        }
    }

    // Add event listeners for contact number fields
    const numericInputFields = [
        'guardian_contact_num',
        'emergency_contact_tel',
        'emergency_contact_mobile'
    ];

    numericInputFields.forEach(fieldName => {
        const input = document.querySelector(`input[name="${fieldName}"]`);
        if (input) {
            input.addEventListener('input', validateNumericInput);
        }
    });
</script>
@endpush
@endsection

@section('title', 'Portal | InnolabAMS')
@extends('portal') <!-- Use the portal layout -->

@section('content') <!-- Define the content section -->
<div class="container mx-auto px-6 py-4">
    <div class="flex justify-between items-center mb-4">
        <h1 class="text-2xl font-semibold">Applicantion Form</h1>
        <a href="{{ url()->previous() }}" class="bg-gray-500 text-white px-4 py-2 rounded hover:bg-gray-600">
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
                        <label class="block text-sm font-medium text-gray-700">Program <span class="text-red-500">*</span></label>
                        <select name="apply_program" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" required>
                            <option value="">Select Program</option>
                            <option value="Elementary">Elementary</option>
                            <option value="High School">High School</option>
                            <option value="Senior High School">Senior High School</option>
                        </select>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Grade Level <span class="text-red-500">*</span></label>
                        <select name="apply_grade_level" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" required>
                            <option value="">Select Grade Level</option>
                        </select>
                    </div>
                    <div id="strandContainer" style="display: none;">
                        <label class="block text-sm font-medium text-gray-700">Strand <span class="text-red-500">*</span></label>
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

            <!-- Student Type -->
            <div class="md:col-span-2">
                <label class="block text-sm font-medium text-gray-700">Student Type <span class="text-red-500">*</span></label>
                <div class="mt-2 space-y-2">
                    <label class="inline-flex items-center">
                        <input type="radio" name="student_type" value="Transferee" class="form-radio" required>
                        <span class="ml-2">Transferee</span>
                    </label>
                    <label class="inline-flex items-center ml-6">
                        <input type="radio" name="student_type" value="Existing Student" class="form-radio" required>
                        <span class="ml-2">Existing Student</span>
                    </label>
                    <label class="inline-flex items-center ml-6">
                        <input type="radio" name="student_type" value="Returning Student" class="form-radio" required>
                        <span class="ml-2">Returning Student</span>
                    </label>
                </div>
            </div>

            <!-- Personal Information -->
            <div class="mb-8">
                <h2 class="text-xl font-semibold mb-4 pb-2 border-b">Personal Information</h2>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Surname <span class="text-red-500">*</span></label>
                        <input type="text" name="applicant_surname" required class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Given Name <span class="text-red-500">*</span></label>
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
                        <label class="block text-sm font-medium text-gray-700">Sex <span class="text-red-500">*</span></label>
                        <select name="gender" required class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                            <option value="">Select Sex</option>
                            <option value="Male">Male</option>
                            <option value="Female">Female</option>
                        </select>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Date of Birth <span class="text-red-500">*</span></label>
                        <input type="date" name="applicant_date_birth" id="applicant_date_birth" required class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Age <span class="text-red-500">*</span></label>
                        <input type="number" name="age" id="age" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" readonly>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Place of Birth <span class="text-red-500">*</span></label>
                        <input type="text" name="applicant_place_birth" required class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Nationality <span class="text-red-500">*</span></label>
                        <input type="text" name="applicant_nationality" required class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Religion <span class="text-red-500">*</span></label>
                        <input type="text" name="applicant_religion" required class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                    </div>
                </div>
            </div>

            <!-- Contact Information -->
            <div class="mb-8">
                <h2 class="text-xl font-semibold mb-4 pb-2 border-b">Contact Information</h2>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Tel. No.</label>
                        <input type="text"
                               name="applicant_tel_no"
                               pattern="[0-9]{7,8}"
                               maxlength="8"
                               title="Please enter a valid telephone number (7-8 digits)"
                               placeholder="8xxxxxxx"
                               oninput="this.value = this.value.replace(/[^0-9]/g, '')"
                               class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Mobile Number <span class="text-red-500">*</span></label>
                        <input type="tel"
                               name="applicant_mobile_number"
                               pattern="[0-9]{11}"
                               maxlength="11"
                               title="Please enter a valid mobile number (11 digits)"
                               placeholder="09xxxxxxxxx"
                               oninput="this.value = this.value.replace(/[^0-9]/g, '')"
                               required
                               class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                    </div>
                    <div class="md:col-span-2">
                        <label class="block text-sm font-medium text-gray-700">Email Address <span class="text-red-500">*</span></label>
                        <input type="email"
                               name="applicant_email"
                               pattern="[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}"
                               title="Please enter a valid email address"
                               required
                               class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                    </div>
                </div>
            </div>

            <!-- Current Address -->
            <div class="mb-8">
                <h2 class="text-xl font-semibold mb-4 pb-2 border-b">Current Address</h2>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Province</label>
                        <input type="text" name="applicant_address_province" value="Metro Manila" readonly class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700">City <span class="text-red-500">*</span></label>
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
                        <label class="block text-sm font-medium text-gray-700">Barangay <span class="text-red-500">*</span></label>
                        <input type="text" name="applicant_barangay" required class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                    </div>
                    <div class="md:col-span-2">
                        <label class="block text-sm font-medium text-gray-700">Street Address <span class="text-red-500">*</span></label>
                        <input type="text" name="applicant_address_street" required class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                    </div>
                </div>
            </div>

            <!-- Educational Background -->
            <div class="mb-8">
                <h2 class="text-xl font-semibold mb-4 pb-2 border-b">Educational Background</h2>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label class="block text-sm font-medium text-gray-700">LRN <span class="text-red-500">*</span></label>
                        <input type="text"
                               name="lrn"
                               maxlength="12"
                               class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700">School Name <span class="text-red-500">*</span></label>
                        <input type="text" name="school_name" required class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                    </div>
                    <div class="md:col-span-2">
                        <label class="block text-sm font-medium text-gray-700">School Address <span class="text-red-500">*</span></label>
                        <input type="text" name="school_address" required class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Previous Program <span class="text-red-500">*</span></label>
                        <input type="text" name="previous_program" required class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Year of Graduation <span class="text-red-500">*</span></label>
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
                        <label class="block text-sm font-medium text-gray-700">General Weighted Average (GWA)</label>
                        <input type="text" name="gwa" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                    </div>
                </div>
            </div>

            <!-- Family Information -->
            <div class="mb-8">
                <h2 class="text-xl font-semibold mb-4 pb-2 border-b">Family Information</h2>
                <p class="text-sm text-gray-600 mb-4">Please provide at least one guardian's information (Father, Mother, or Guardian) <span class="text-red-500">*</span></p>

                <!-- Father's Information -->
                <div class="border-b pb-4 mb-4">
                    <h3 class="font-medium mb-2">Father's Information</h3>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Given Name</label>
                            <input type="text" name="father_given_name" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Middle Name</label>
                            <input type="text" name="father_middle_name" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Last Name</label>
                            <input type="text" name="father_surname" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                        </div>
                        <div class="md:col-span-2">
                            <label class="block text-sm font-medium text-gray-700">Contact Number</label>
                            <input type="text"
                                   name="father_contact"
                                   maxlength="11"
                                   class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                        </div>
                    </div>
                </div>

                <!-- Mother's Information -->
                <div class="border-b pb-4 mb-4">
                    <h3 class="font-medium mb-2">Mother's Information</h3>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Given Name</label>
                            <input type="text" name="mother_given_name" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Middle Name</label>
                            <input type="text" name="mother_middle_name" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Last Name</label>
                            <input type="text" name="mother_surname" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                        </div>
                        <div class="md:col-span-2">
                            <label class="block text-sm font-medium text-gray-700">Contact Number</label>
                            <input type="text"
                                   name="mother_contact"
                                   maxlength="11"
                                   class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                        </div>
                    </div>
                </div>

                <!-- Guardian's Information -->
                <div class="mb-4">
                    <h3 class="font-medium mb-2">Guardian's Information</h3>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Given Name</label>
                            <input type="text" name="guardian_given_name" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Middle Name</label>
                            <input type="text" name="guardian_middle_name" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Last Name</label>
                            <input type="text" name="guardian_surname" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Contact Number</label>
                            <input type="text"
                                   name="guardian_contact_num"
                                   maxlength="11"
                                   class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                        </div>
                    </div>
                </div>

                <!-- Siblings Information -->
                <div class="mb-6" id="siblings-section">
                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700 mb-2">Siblings</label>
                        <div class="flex items-center">
                            <input type="checkbox"
                                   id="only-child"
                                   name="is_only_child"
                                   class="rounded border-gray-300 text-indigo-600 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                            <label for="only-child" class="ml-2 text-sm text-gray-600">Only Child</label>
                        </div>
                    </div>

                    <div id="siblings-container" class="mt-4">
                        <div class="sibling-entry grid grid-cols-5 gap-4 mb-4 relative">
                            <input type="text" name="siblings[0][full_name]" placeholder="Full Name" class="rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                            <input type="date" name="siblings[0][date_of_birth]" onchange="calculateSiblingAge(this)" class="rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                            <input type="number" name="siblings[0][age]" placeholder="Age" readonly class="rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                            <select name="siblings[0][grade_level]" class="rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                                <option value="">Select Grade Level</option>
                                @for ($i = 1; $i <= 12; $i++)
                                    <option value="Grade {{ $i }}">Grade {{ $i }}</option>
                                @endfor
                            </select>
                            <div class="flex items-center">
                                <input type="text" name="siblings[0][school_attended]" placeholder="School Attended" class="rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                                <button type="button" onclick="removeSibling(this)" class="ml-2 text-red-500 hover:text-red-700" style="display: none;">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                                        <path fill-rule="evenodd" d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z" clip-rule="evenodd" />
                                    </svg>
                                </button>
                            </div>
                        </div>
                    </div>

                    <button type="button" id="add-sibling" class="mt-4 px-4 py-2 bg-blue-500 text-white rounded-md hover:bg-blue-600">
                        Add Sibling
                    </button>
                </div>
            </div>

                        <!-- Additional Information -->
                        <div class="mb-8">
                <h2 class="text-xl font-semibold mb-4 pb-2 border-b">Additional Information</h2>

                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-700">Hobbies</label>
                    <textarea
                        name="hobbies"
                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"
                        placeholder="Please list your hobbies (e.g., reading, playing sports, music)"
                        data-validate="letters-only"
                    ></textarea>
                    <p class="validation-error text-red-500 text-sm mt-1 hidden">Please enter only letters and spaces</p>
                </div>

                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-700">Skills</label>
                    <textarea
                        name="skills"
                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"
                        placeholder="Please list your skills (e.g., computer programming, public speaking, leadership)"
                        data-validate="letters-only"
                    ></textarea>
                    <p class="validation-error text-red-500 text-sm mt-1 hidden">Please enter only letters and spaces</p>
                </div>

                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-700">Extracurricular Interests</label>
                    <textarea
                        name="extracurricular_interest"
                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"
                        placeholder="Please list your extracurricular interests (e.g., student council, sports teams, clubs)"
                        data-validate="letters-only"
                    ></textarea>
                    <p class="validation-error text-red-500 text-sm mt-1 hidden">Please enter only letters and spaces</p>
                </div>
            </div>

            <!-- Emergency Contact -->
            <div class="mb-8">
                <h2 class="text-xl font-semibold mb-4 pb-2 border-b">Emergency Contact</h2>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div class="md:col-span-2">
                        <label class="block text-sm font-medium text-gray-700">Complete Name <span class="text-red-500">*</span></label>
                        <input type="text" name="emergency_contact_name" required class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                    </div>
                    <div class="md:col-span-2">
                        <label class="block text-sm font-medium text-gray-700">Complete Address <span class="text-red-500">*</span></label>
                        <input type="text" name="emergency_contact_address" required class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                        <div class="mt-2">
                            <input type="checkbox" id="same-as-applicant-address" class="rounded border-gray-300 text-indigo-600 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                            <label for="same-as-applicant-address" class="ml-2 text-sm text-gray-600">Same as Applicant's Address</label>
                        </div>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Tel. No.</label>
                        <input type="text"
                               name="emergency_contact_tel"
                               maxlength="11"
                               class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Mobile No. <span class="text-red-500">*</span></label>
                        <input type="text"
                               name="emergency_contact_mobile"
                               maxlength="11"
                               class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                    </div>
                    <div class="md:col-span-2">
                        <label class="block text-sm font-medium text-gray-700">Email <span class="text-red-500">*</span></label>
                        <input type="email" name="emergency_contact_email" required class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                    </div>
                </div>
            </div>

            <!-- Required Documents -->
            <div class="mb-8">
                <h2 class="text-xl font-semibold mb-4 pb-2 border-b">Required Documents</h2>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <!-- Birth Certificate -->
                    <div class="document-requirement" data-required-for="Transferee,Returning Student">
                        <label class="block text-sm font-medium text-gray-700">Birth Certificate (PSA/NSO) <span class="text-red-500">*</span></label>
                        <input type="file"
                               name="birth_certificate"
                               accept=".pdf,.jpg,.jpeg,.png"
                               class="mt-1 block w-full text-sm text-gray-500
                                      file:mr-4 file:py-2 file:px-4
                                      file:rounded-md file:border-0
                                      file:text-sm file:font-semibold
                                      file:bg-blue-50 file:text-blue-700
                                      hover:file:bg-blue-100">
                        <p class="mt-1 text-sm text-gray-500">Accepted formats: PDF, JPG, JPEG, PNG (Max: 2MB)</p>
                    </div>

                    <!-- Form 137 -->
                    <div class="document-requirement" data-required-for="Transferee">
                        <label class="block text-sm font-medium text-gray-700">Form 137 <span class="text-red-500">*</span></label>
                        <input type="file"
                               name="form_137"
                               accept=".pdf,.jpg,.jpeg,.png"
                               class="mt-1 block w-full text-sm text-gray-500
                                      file:mr-4 file:py-2 file:px-4
                                      file:rounded-md file:border-0
                                      file:text-sm file:font-semibold
                                      file:bg-blue-50 file:text-blue-700
                                      hover:file:bg-blue-100">
                        <p class="mt-1 text-sm text-gray-500">Accepted formats: PDF, JPG, JPEG, PNG (Max: 2MB)</p>
                    </div>

                    <!-- Form 138 -->
                    <div class="document-requirement" data-required-for="Transferee,Existing Student,Returning Student">
                        <label class="block text-sm font-medium text-gray-700">Form 138 (Report Card) <span class="text-red-500">*</span></label>
                        <input type="file"
                               name="form_138"
                               accept=".pdf,.jpg,.jpeg,.png"
                               class="mt-1 block w-full text-sm text-gray-500
                                      file:mr-4 file:py-2 file:px-4
                                      file:rounded-md file:border-0
                                      file:text-sm file:font-semibold
                                      file:bg-blue-50 file:text-blue-700
                                      hover:file:bg-blue-100">
                        <p class="mt-1 text-sm text-gray-500">Accepted formats: PDF, JPG, JPEG, PNG (Max: 2MB)</p>
                    </div>

                    <!-- ID Picture -->
                    <div class="document-requirement" data-required-for="Transferee,Existing Student,Returning Student">
                        <label class="block text-sm font-medium text-gray-700">2x2 ID Picture <span class="text-red-500">*</span></label>
                        <input type="file"
                               name="id_picture"
                               accept=".jpg,.jpeg,.png"
                               class="mt-1 block w-full text-sm text-gray-500
                                      file:mr-4 file:py-2 file:px-4
                                      file:rounded-md file:border-0
                                      file:text-sm file:font-semibold
                                      file:bg-blue-50 file:text-blue-700
                                      hover:file:bg-blue-100">
                        <p class="mt-1 text-sm text-gray-500">Accepted formats: JPG, JPEG, PNG (Max: 1MB)</p>
                    </div>

                    <!-- Good Moral Certificate -->
                    <div class="document-requirement" data-required-for="Transferee,Returning Student">
                        <label class="block text-sm font-medium text-gray-700">Good Moral Certificate <span class="text-red-500">*</span></label>
                        <input type="file"
                               name="good_moral"
                               accept=".pdf,.jpg,.jpeg,.png"
                               class="mt-1 block w-full text-sm text-gray-500
                                      file:mr-4 file:py-2 file:px-4
                                      file:rounded-md file:border-0
                                      file:text-sm file:font-semibold
                                      file:bg-blue-50 file:text-blue-700
                                      hover:file:bg-blue-100">
                        <p class="mt-1 text-sm text-gray-500">Accepted formats: PDF, JPG, JPEG, PNG (Max: 2MB)</p>
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
    document.addEventListener('DOMContentLoaded', function() {
        const onlyChildCheckbox = document.getElementById('only-child');
        const siblingsContainer = document.getElementById('siblings-container');
        const addSiblingButton = document.getElementById('add-sibling');

        // Create a hidden input for is_only_child
        const hiddenInput = document.createElement('input');
        hiddenInput.type = 'hidden';
        hiddenInput.name = 'is_only_child';
        hiddenInput.value = '0';
        onlyChildCheckbox.parentNode.appendChild(hiddenInput);

        onlyChildCheckbox.addEventListener('change', function() {
            // Update hidden input value
            hiddenInput.value = this.checked ? '1' : '0';

            if (this.checked) {
                siblingsContainer.style.display = 'none';
                addSiblingButton.style.display = 'none';

                // Clear all sibling inputs
                document.querySelectorAll('#siblings-container input, #siblings-container select').forEach(input => {
                    input.value = '';
                });
            } else {
                siblingsContainer.style.display = 'block';
                addSiblingButton.style.display = 'block';
            }
        });

        // Handle same as applicant address checkbox
        const sameAsApplicantCheckbox = document.getElementById('same-as-applicant-address');
        const emergencyContactAddressInput = document.querySelector('input[name="emergency_contact_address"]');
        
        sameAsApplicantCheckbox.addEventListener('change', function() {
            if (this.checked) {
                const applicantAddressFields = {
                    province: document.querySelector('input[name="applicant_address_province"]').value,
                    city: document.querySelector('select[name="applicant_address_city"]').value,
                    barangay: document.querySelector('input[name="applicant_barangay"]').value,
                    street: document.querySelector('input[name="applicant_address_street"]').value
                };

                emergencyContactAddressInput.value = `${applicantAddressFields.street}, ${applicantAddressFields.barangay}, ${applicantAddressFields.city}, ${applicantAddressFields.province}`;
            } else {
                emergencyContactAddressInput.value = '';
            }
        });
    });

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
            input.name === 'applicant_extension' ||
            input.name.includes('school_attended')) {
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
        newEntry.className = 'sibling-entry grid grid-cols-5 gap-4 mb-4 relative';
        newEntry.innerHTML = `
            <input type="text" name="siblings[${siblingCount}][full_name]" placeholder="Full Name" class="rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
            <input type="date" name="siblings[${siblingCount}][date_of_birth]" onchange="calculateSiblingAge(this)" class="rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
            <input type="number" name="siblings[${siblingCount}][age]" placeholder="Age" readonly class="rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
            <select name="siblings[${siblingCount}][grade_level]" class="rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                <option value="">Select Grade Level</option>
                ${generateGradeOptions(1, 12)}
            </select>
            <div class="flex items-center">
                <input type="text" name="siblings[${siblingCount}][school_attended]" placeholder="School Attended" class="rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                <button type="button" onclick="removeSibling(this)" class="ml-2 text-red-500 hover:text-red-700">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z" clip-rule="evenodd" />
                    </svg>
                </button>
            </div>
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

    // Add the removeSibling function
    function removeSibling(button) {
        const siblingEntry = button.closest('.sibling-entry');
        siblingEntry.remove();

        // Reindex remaining sibling entries
        const siblingEntries = document.querySelectorAll('.sibling-entry');
        siblingEntries.forEach((entry, index) => {
            entry.querySelectorAll('input, select').forEach(input => {
                const fieldName = input.name.split('[')[2]?.split(']')[0];
                if (fieldName) {
                    input.name = `siblings[${index}][${fieldName}]`;
                }
            });
        });

        siblingCount = siblingEntries.length;
    }

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

    // File input validation
    const fileInputs = document.querySelectorAll('input[type="file"]');

    fileInputs.forEach(input => {
        input.addEventListener('change', function(e) {
            const file = e.target.files[0];
            const maxSize = input.name === 'id_picture' ? 1024 * 1024 : 2048 * 1024; // 1MB or 2MB
            const allowedTypes = input.accept.split(',');

            // Remove any existing error messages
            const existingError = input.parentElement.querySelector('.error-message');
            if (existingError) {
                existingError.remove();
            }

            if (file) {
                // Check file size
                if (file.size > maxSize) {
                    const error = document.createElement('p');
                    error.className = 'error-message text-red-500 text-sm mt-1';
                    error.textContent = `File size must be less than ${maxSize/1024/1024}MB`;
                    input.parentElement.appendChild(error);
                    input.value = ''; // Clear the input
                    return;
                }

                // Check file type
                const fileType = '.' + file.name.split('.').pop().toLowerCase();
                if (!allowedTypes.includes(fileType)) {
                    const error = document.createElement('p');
                    error.className = 'error-message text-red-500 text-sm mt-1';
                    error.textContent = 'Invalid file type';
                    input.parentElement.appendChild(error);
                    input.value = ''; // Clear the input
                    return;
                }
            }
        });
    });

    // Add this to your existing scripts
    document.addEventListener('DOMContentLoaded', function() {
        const studentTypeInputs = document.querySelectorAll('input[name="student_type"]');
        const documentRequirements = document.querySelectorAll('.document-requirement');

        function updateDocumentRequirements(selectedType) {
            documentRequirements.forEach(requirement => {
                const requiredFor = requirement.dataset.requiredFor.split(',');
                const input = requirement.querySelector('input[type="file"]');

                if (requiredFor.includes(selectedType)) {
                    requirement.style.display = 'block';
                    input.required = true;
                } else {
                    requirement.style.display = 'none';
                    input.required = false;
                    input.value = ''; // Clear the input when hidden
                }
            });
        }

        // Initially hide all document requirements
        documentRequirements.forEach(requirement => {
            requirement.style.display = 'none';
            requirement.querySelector('input[type="file"]').required = false;
        });

        // Add change event listener to student type radio buttons
        studentTypeInputs.forEach(input => {
            input.addEventListener('change', function() {
                updateDocumentRequirements(this.value);
            });
        });
    });

    // GWA field validation
    document.querySelector('input[name="gwa"]').addEventListener('input', function(e) {
        // If there's a decimal point, limit decimal places to 2 without rounding
        if (this.value.includes('.')) {
            const parts = this.value.split('.');
            const whole = parts[0].slice(0, 2); // Limit whole number to 2 digits
            const decimal = parts[1] ? parts[1].slice(0, 2) : ''; // Limit decimal to 2 digits
            this.value = decimal ? `${whole}.${decimal}` : `${whole}.`;
        } else if (this.value.length > 2) {
            this.value = this.value.slice(0, 2);
        }

        // Check format: XX.XX (numbers between 0-9, exactly 2 digits before and after decimal)
        const isValid = /^(\d{0,2})(\.)?(\d{0,2})$/.test(this.value);

        // Additional validation to ensure the value is between 0 and 100
        const numValue = parseFloat(this.value);
        const isValidRange = isNaN(numValue) || (numValue >= 0 && numValue <= 100);

        if (!isValid || !isValidRange) {
            this.classList.add('border-red-500');
            if (!this.nextElementSibling || !this.nextElementSibling.classList.contains('error-message')) {
                const errorMessage = document.createElement('span');
                errorMessage.className = 'error-message text-red-500 text-sm';
                errorMessage.textContent = 'Please enter a valid GWA (e.g., 90.78)';
                this.parentNode.appendChild(errorMessage);
            }
        } else {
            this.classList.remove('border-red-500');
            if (this.nextElementSibling && this.nextElementSibling.classList.contains('error-message')) {
                this.nextElementSibling.remove();
            }
        }
    });
</script>
@endpush
@endsection

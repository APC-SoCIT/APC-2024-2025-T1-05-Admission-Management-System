@extends('application') <!-- Use the application layout -->
@section('title', 'Add Applicant | InnolabAMS')

@section('content') <!-- Define the content section -->
<div class="container mx-auto px-6 py-4">
    <div class="flex justify-between items-center mb-4">
        <h1 class="text-2xl font-semibold">Application Form</h1>
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
                        <div class="flex items-center">
                            <select id="apply_program" name="apply_program" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" required>
                                <option value="">Select Program</option>
                                <option value="High School">High School</option>
                                <option value="Senior High School">Senior High School</option>
                            </select>
                            <x-form-tooltip text="Choose the educational program you wish to enroll in" />
                        </div>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Grade Level <span class="text-red-500">*</span></label>
                        <div class="flex items-center">
                            <!-- Replace select with input for read-only display -->
                            <input type="text" id="grade_level_display" class="mt-1 block w-full rounded-md border-gray-300 bg-gray-50 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" readonly>

                            <!-- Hidden select field that will still contain the actual value for form submission -->
                            <select id="apply_grade_level" name="apply_grade_level" class="hidden" required>
                                <option value="">Select Grade Level</option>
                            </select>
                            <x-form-tooltip text="Grade level is automatically set based on your program selection" />
                        </div>
                    </div>
                    <div id="strandContainer" class="hidden">
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
                <div class="flex items-center mb-2">
                    <div class="mt-2 space-y-2">
                        <label class="inline-flex items-center">
                            <input type="radio" name="student_type" value="Transferee" class="form-radio" required>
                            <span class="ml-2">Transferee</span>
                        </label>
                        <label class="inline-flex items-center ml-6">
                            <input type="radio" name="student_type" value="Returning Student" class="form-radio" required>
                            <span class="ml-2">Returning Student</span>
                        </label>
                    </div>
                    <x-form-tooltip text="Select your current student status" />
                </div>
            </div>

            <!-- Personal Information -->
            <div class="mb-8">
                <h2 class="text-xl font-semibold mb-4 pb-2 border-b">Personal Information</h2>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div class="form-group">
                        <label class="block text-sm font-medium text-gray-700">Surname <span class="text-red-500">*</span></label>
                        <span class="block text-sm font-medium text-gray-700">Example: Dela Cruz</span>
                        <div class="flex items-center">
                            <input type="text"
                                   name="applicant_surname"
                                   required
                                   class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                            <x-form-tooltip text="Enter your legal last name exactly as it appears on official documents" />
                        </div>
                        <div class="error-container mt-1"></div>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Given Name <span class="text-red-500">*</span></label> <span class="block text-sm font-medium text-gray-700">Example: Juan</span>
                        <div class="flex items-center">
                            <input type="text" name="applicant_given_name" required class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                            <x-form-tooltip text="Enter your first name exactly as it appears on official documents" />
                        </div>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Middle Name</label> <span class="block text-sm font-medium text-gray-700">Example: Santos</span>
                        <div class="flex items-center">
                            <input type="text" name="applicant_middle_name" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                            <x-form-tooltip text="Enter your middle name if applicable. Leave blank if none" />
                        </div>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Extension Name</label> <span class="block text-sm font-medium text-gray-700">Example: Jr., II, III, etc.</span>
                        <div class="flex items-center">
                            <input type="text" name="applicant_extension" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                            <x-form-tooltip text="Add name extensions like Jr., Sr., III if applicable" />
                        </div>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Sex <span class="text-red-500">*</span></label> <span class="block text-sm font-medium text-gray-700">Choose your biological sex</span>
                        <div class="flex items-center">
                            <select name="gender" required class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                                <option value="">Select Sex</option>
                                <option value="Male">Male</option>
                                <option value="Female">Female</option>
                            </select>
                            <x-form-tooltip text="Select your biological sex as it appears on official documents" />
                        </div>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Date of Birth <span class="text-red-500">*</span></label> <span class="block text-sm font-medium text-gray-700">Day/Month/Year</span>
                        <div class="flex items-center">
                            <input type="date" name="applicant_date_birth" id="applicant_date_birth" required class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                            <x-form-tooltip text="Enter your birth date as shown on your birth certificate" />
                        </div>
                        <div class="date-error text-red-500 text-sm mt-1 hidden"></div>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Age <span class="text-red-500">*</span></label> <span class="block text-sm font-medium text-gray-700">Age is automatically calculated based on the date of birth</span>
                        <input type="number" name="age" id="age" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" readonly>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Place of Birth <span class="text-red-500">*</span></label> <span class="block text-sm font-medium text-gray-700">Example: Manila</span>
                        <div class="flex items-center">
                            <input type="text" name="applicant_place_birth" required class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                            <x-form-tooltip text="Enter the city or municipality where you were born" />
                        </div>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Nationality <span class="text-red-500">*</span></label> <span class="block text-sm font-medium text-gray-700">Example: Filipino</span>
                        <div class="flex items-center">
                            <input type="text" name="applicant_nationality" required class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                            <x-form-tooltip text="Enter your nationality as it appears on your passport or government-issued ID" />
                        </div>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Religion <span class="text-red-500">*</span></label> <span class="block text-sm font-medium text-gray-700">Example: Catholic</span>
                        <div class="flex items-center">
                            <input type="text" name="applicant_religion" required class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                            <x-form-tooltip text="Enter your religious affiliation" />
                        </div>
                    </div>
                </div>
            </div>

            <!-- Contact Information -->
            <div class="mb-8">
                <h2 class="text-xl font-semibold mb-4 pb-2 border-b">Contact Information</h2>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Telephone Number</label>
                        <span class="block text-sm font-medium text-gray-700">Choose your area code and it will automatically format the number</span>
                        <div class="flex items-center gap-2">
                            <select name="area_code" id="tel_area_code" class="mt-1 w-20 rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                                <option value="02">02</option>
                                <option value="078">78</option>
                                <option value="074">74</option>
                                <option value="044">44</option>
                                <option value="045">45</option>
                                <option value="043">43</option>
                                <option value="046">46</option>
                                <option value="049">49</option>
                                <option value="048">48</option>
                                <option value="052">52</option>
                                <option value="054">54</option>
                                <option value="032">32</option>
                                <option value="033">33</option>
                                <option value="034">34</option>
                                <option value="035">35</option>
                                <option value="053">53</option>
                                <option value="055">55</option>
                                <option value="062">62</option>
                                <option value="065">65</option>
                                <option value="088">88</option>
                                <option value="082">82</option>
                                <option value="084">84</option>
                                <option value="087">87</option>
                                <option value="064">64</option>
                                <option value="085">85</option>
                                <option value="086">86</option>
                                <option value="068">68</option>
                            </select>
                            <input type="tel"
                                   name="applicant_tel_no"
                                   id="applicant_tel_no"
                                   maxlength="15"
                                   class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                        </div>
                        <!-- Add checkbox for no telephone number -->
                        <div class="mt-2">
                            <input type="checkbox" id="no-telephone" name="no_telephone" class="rounded border-gray-300 text-indigo-600 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                            <label for="no-telephone" class="ml-2 text-sm text-gray-600">Check if you don't have a telephone number</label>
                        </div>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Mobile Number <span class="text-red-500">*</span></label> <span class="block text-sm font-medium text-gray-700">Format: XXX XXX XXXX (Philippine number only)</span>
                        <div class="flex items-center space-x-2">
                            <input type="tel"
                                   name="applicant_mobile_number"
                                   id="applicant_mobile_number"
                                   required
                                   maxlength="12"
                                   class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                        </div>
                    </div>
                    <div class="md:col-span-2">
                        <label class="block text-sm font-medium text-gray-700">Email Address <span class="text-red-500">*</span></label> <span class="block text-sm font-medium text-gray-700">Example: juan.santos@example.com</span>
                        <div class="flex items-center">
                            <input type="email"
                                   name="applicant_email"
                                   pattern="[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}"
                                   title="Please enter a valid email address"
                                   required
                                   class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                        </div>
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
                        <label class="block text-sm font-medium text-gray-700">Barangay <span class="text-red-500">*</span></label> <span class="block text-sm font-medium text-gray-700">Example: Poblacion</span>
                        <div class="flex items-center">
                            <input type="text" name="applicant_barangay" required class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                            <x-form-tooltip text="Enter your barangay or subdivision" />
                        </div>
                    </div>
                    <div class="md:col-span-2">
                        <label class="block text-sm font-medium text-gray-700">Street Address <span class="text-red-500">*</span></label> <span class="block text-sm font-medium text-gray-700">Example: 123 Main St.</span>
                        <div class="flex items-center">
                            <input type="text" name="applicant_address_street" required class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                            <x-form-tooltip text="Enter your street address" />
                        </div>
                    </div>
                </div>
            </div>

            <!-- Educational Background -->
            <div class="mb-8">
                <h2 class="text-xl font-semibold mb-4 pb-2 border-b">Educational Background</h2>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Learner Reference Number <span class="text-red-500">*</span></label>
                        <span class="block text-sm font-medium text-gray-700">Example: 123456789012</span>
                        <div class="flex items-center">
                            <input type="text"
                                   name="lrn"
                                   maxlength="12"
                                   class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                            <x-form-tooltip text="Enter your 12-digit Learner Reference Number assigned by the Department of Education (DepEd). This unique identifier is required for all K-12 students." />
                        </div>
                        <div class="error-container mt-1"></div>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700">School Name <span class="text-red-500">*</span></label> <span class="block text-sm font-medium text-gray-700">Example: Manila National High School</span>
                        <div class="flex items-center">
                            <input type="text" name="school_name" required class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                            <x-form-tooltip text="Enter the name of the school you attended" />
                        </div>
                    </div>
                    <div class="md:col-span-2">
                        <label class="block text-sm font-medium text-gray-700">School Address <span class="text-red-500">*</span></label> <span class="block text-sm font-medium text-gray-700">Example: 123 Main St., Manila</span>
                        <div class="flex items-center">
                            <input type="text" name="school_address" required class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                            <x-form-tooltip text="Enter the complete address of the school" />
                        </div>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Previous Program <span class="text-red-500">*</span></label> <span class="block text-sm font-medium text-gray-700">Example: Elementary</span>
                        <div class="flex items-center">
                            <input type="text" name="previous_program" required class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                            <x-form-tooltip text="Enter the program you previously studied" />
                        </div>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Year Graduated <span class="text-red-500">*</span></label> <span class="block text-sm font-medium text-gray-700">Example: 2024</span>
                        <div class="flex items-center">
                            <input type="text"
                                   name="year_of_graduation"
                                   maxlength="4"
                                   class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                            <x-form-tooltip text="Enter the year you graduated from your previous program" />
                        </div>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Awards/Honors</label> <span class="block text-sm font-medium text-gray-700">Example: Best in Mathematics, Best in Science, etc.</span>
                        <div class="flex items-center">
                            <input type="text" name="awards_honors" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                            <x-form-tooltip text="Enter any awards or honors you received" />
                        </div>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700">General Weighted Average (GWA)</label> <span class="block text-sm font-medium text-gray-700">Example: 90.50</span>
                        <div class="flex items-center">
                            <input type="text" name="gwa" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                            <x-form-tooltip text="Enter your General Weighted Average (GWA) if applicable" />
                        </div>
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
                            <label class="block text-sm font-medium text-gray-700">Given Name</label> <span class="block text-sm font-medium text-gray-700">Example: Juan</span>
                            <div class="flex items-center">
                                <input type="text" name="father_given_name" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                                <x-form-tooltip text="Enter your father's first name" />
                            </div>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Middle Name</label> <span class="block text-sm font-medium text-gray-700">Example: Santos</span>
                            <div class="flex items-center">
                                <input type="text" name="father_middle_name" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                                <x-form-tooltip text="Enter your father's middle name" />
                            </div>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Last Name</label> <span class="block text-sm font-medium text-gray-700">Example: Dela Cruz</span>
                            <div class="flex items-center">
                                <input type="text" name="father_surname" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                                <x-form-tooltip text="Enter your father's last name" />
                            </div>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Mobile Number <span class="text-red-500">*</span></label> <span class="block text-sm font-medium text-gray-700">Format: XXX XXX XXXX (Philippine number only)</span>
                            <div class="flex items-center space-x-2">
                                <input type="tel"
                                       name="father_contact"
                                       id="father_contact"
                                       maxlength="12"
                                       class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Mother's Information -->
                <div class="border-b pb-4 mb-4">
                    <h3 class="font-medium mb-2">Mother's Information</h3>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Given Name</label> <span class="block text-sm font-medium text-gray-700">Example: Maria</span>
                            <div class="flex items-center">
                                <input type="text" name="mother_given_name" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                                <x-form-tooltip text="Enter your mother's first name" />
                            </div>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Middle Name</label> <span class="block text-sm font-medium text-gray-700">Example: Santos</span>
                            <div class="flex items-center">
                                <input type="text" name="mother_middle_name" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                                <x-form-tooltip text="Enter your mother's middle name" />
                            </div>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Last Name</label> <span class="block text-sm font-medium text-gray-700">Example: Dela Cruz</span>
                            <div class="flex items-center">
                                <input type="text" name="mother_surname" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                                <x-form-tooltip text="Enter your mother's last name" />
                            </div>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Mobile Number <span class="text-red-500">*</span></label> <span class="block text-sm font-medium text-gray-700">Format: XXX XXX XXXX (Philippine number only)</span>
                            <div class="flex items-center space-x-2">
                                <input type="tel"
                                       name="mother_contact"
                                       id="mother_contact"
                                       maxlength="12"
                                       class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Guardian's Information -->
                <div class="mb-4">
                    <h3 class="font-medium mb-2">Guardian's Information</h3>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Given Name</label> <span class="block text-sm font-medium text-gray-700">Example: Juan</span>
                            <div class="flex items-center">
                                <input type="text" name="guardian_given_name" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                                <x-form-tooltip text="Enter your guardian's first name" />
                            </div>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Middle Name</label> <span class="block text-sm font-medium text-gray-700">Example: Santos</span>
                            <div class="flex items-center">
                                <input type="text" name="guardian_middle_name" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                                <x-form-tooltip text="Enter your guardian's middle name" />
                            </div>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Last Name</label> <span class="block text-sm font-medium text-gray-700">Example: Dela Cruz</span>
                            <div class="flex items-center">
                                <input type="text" name="guardian_surname" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                                <x-form-tooltip text="Enter your guardian's last name" />
                            </div>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Mobile Number <span class="text-red-500">*</span></label> <span class="block text-sm font-medium text-gray-700">Format: XXX XXX XXXX (Philippine number only)</span>
                            <div class="flex items-center space-x-2">
                                <input type="tel"
                                       name="guardian_contact_num"
                                       id="guardian_contact_num"
                                       maxlength="12"
                                       class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                            </div>
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
                            <input type="text" name="siblings[0][given_name]" placeholder="Given Name" class="rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                            <input type="text" name="siblings[0][middle_name]" placeholder="Middle Name" class="rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                            <input type="text" name="siblings[0][last_name]" placeholder="Last Name" class="rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">

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
                        <label class="block text-sm font-medium text-gray-700">First Name <span class="text-red-500">*</span></label> <span class="block text-sm font-medium text-gray-700">Example: Juan Dela Cruz</span>
                        <div class="flex items-center mb-4">
                            <input type="text" name="emergency_contact_first_name" required class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                            <x-form-tooltip text="Enter the first name of the emergency contact" />
                        </div>
                        <label class="block text-sm font-medium text-gray-700">Middle Name <span class="text-red-500">*</span></label> <span class="block text-sm font-medium text-gray-700">Example: Juan Dela Cruz</span>
                        <div class="flex items-center mb-4">
                            <input type="text" name="emergency_contact_middle_name" required class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                            <x-form-tooltip text="Enter the middle name of the emergency contact" />
                        </div>
                        <label class="block text-sm font-medium text-gray-700">Last Name <span class="text-red-500">*</span></label> <span class="block text-sm font-medium text-gray-700">Example: Dela Cruz</span>
                        <div class="flex items-center mb-4">
                            <input type="text" name="emergency_contact_last_name" required class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                            <x-form-tooltip text="Enter the last name of the emergency contact" />
                        </div>
                    </div>
                    <div class="md:col-span-2">
                        <label class="block text-sm font-medium text-gray-700">Complete Address <span class="text-red-500">*</span></label> <span class="block text-sm font-medium text-gray-700">Example: 123 Main St., Manila</span>
                        <div class="flex items-center">
                            <input type="text" name="emergency_contact_address" required class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                            <x-form-tooltip text="Enter the complete address of the emergency contact" />
                        </div>
                        <div class="mt-2">
                            <input type="checkbox" id="same-as-applicant-address" class="rounded border-gray-300 text-indigo-600 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                            <label for="same-as-applicant-address" class="ml-2 text-sm text-gray-600">Same as Applicant's Address</label>
                        </div>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Telephone Number</label>
                        <span class="block text-sm font-medium text-gray-700">Choose your area code and it will automatically format the number</span>
                        <div class="flex items-center gap-2">
                            <select name="area_code" id="emergency_tel_area_code" class="mt-1 w-20 rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                                <option value="02">02</option>
                                <option value="078">78</option>
                                <option value="074">74</option>
                                <option value="044">44</option>
                                <option value="045">45</option>
                                <option value="043">43</option>
                                <option value="046">46</option>
                                <option value="049">49</option>
                                <option value="048">48</option>
                                <option value="052">52</option>
                                <option value="054">54</option>
                                <option value="032">32</option>
                                <option value="033">33</option>
                                <option value="034">34</option>
                                <option value="035">35</option>
                                <option value="053">53</option>
                                <option value="055">55</option>
                                <option value="062">62</option>
                                <option value="065">65</option>
                                <option value="088">88</option>
                                <option value="082">82</option>
                                <option value="084">84</option>
                                <option value="087">87</option>
                                <option value="064">64</option>
                                <option value="085">85</option>
                                <option value="086">86</option>
                                <option value="068">68</option>
                            </select>
                            <input type="tel"
                                   name="emergency_contact_tel"
                                   id="emergency_contact_tel"
                                   maxlength="15"
                                   class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                        </div>
                        <!-- Add checkbox for no emergency telephone number -->
                        <div class="mt-2">
                            <input type="checkbox" id="no-emergency-telephone" name="no_emergency_telephone" class="rounded border-gray-300 text-indigo-600 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                            <label for="no-emergency-telephone" class="ml-2 text-sm text-gray-600">Check if you don't have an emergency telephone number</label>
                        </div>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Mobile Number <span class="text-red-500">*</span></label>
                        <span class="block text-sm font-medium text-gray-700">Format: XXX XXX XXXX (Philippine number only)</span>
                        <div class="flex items-center mb-4">
                            <input type="tel"
                                   name="emergency_contact_mobile"
                                   id="emergency_contact_mobile"
                                   maxlength="12"
                                   class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                        </div>
                    </div>
                    <div class="md:col-span-2">
                        <label class="block text-sm font-medium text-gray-700">Email <span class="text-red-500">*</span></label> <span class="block text-sm font-medium text-gray-700">Example: juan@example.com</span>
                        <div class="flex items-center">
                            <input type="email" name="emergency_contact_email" required class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                            <x-form-tooltip text="Enter the email address of the emergency contact" />
                        </div>
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

        // Handle no-telephone checkbox
        const noTelephoneCheckbox = document.getElementById('no-telephone');
        const telAreaCodeSelect = document.getElementById('tel_area_code');
        const telNumberInput = document.getElementById('applicant_tel_no');

        noTelephoneCheckbox.addEventListener('change', function() {
            if (this.checked) {
                telAreaCodeSelect.disabled = true;
                telNumberInput.disabled = true;
                telNumberInput.value = 'N/A';
            } else {
                telAreaCodeSelect.disabled = false;
                telNumberInput.disabled = false;
                telNumberInput.value = '';
            }
        });

        // Handle no-emergency-telephone checkbox
        const noEmergencyTelephoneCheckbox = document.getElementById('no-emergency-telephone');
        const emergencyTelAreaCodeSelect = document.getElementById('emergency_tel_area_code');
        const emergencyTelNumberInput = document.getElementById('emergency_contact_tel');

        noEmergencyTelephoneCheckbox.addEventListener('change', function() {
            if (this.checked) {
                emergencyTelAreaCodeSelect.disabled = true;
                emergencyTelNumberInput.disabled = true;
                emergencyTelNumberInput.value = 'N/A';
            } else {
                emergencyTelAreaCodeSelect.disabled = false;
                emergencyTelNumberInput.disabled = false;
                emergencyTelNumberInput.value = '';
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
            const existingError = input.parentElement.querySelector('.error-message');
            if (existingError) {
                existingError.remove();
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
            input.name === 'year_of_graduation' ||
            input.name === 'gwa' ||
            input.name.includes('school_attended')) {
            return;
        }

        const isValid = /^[a-zA-Z\s]*$/.test(value);

        // Find or create error container
        let errorContainer = input.parentElement.parentElement.querySelector('.error-container');
        if (!errorContainer) {
            errorContainer = document.createElement('div');
            errorContainer.className = 'error-container mt-1';
            input.parentElement.parentElement.appendChild(errorContainer);
        }

        // Clear existing error messages
        errorContainer.innerHTML = '';

        if (!isValid && value !== '') {
            input.classList.add('border-red-500');
            const errorMessage = document.createElement('p');
            errorMessage.className = 'error-message text-red-500 text-sm mt-1';
            errorMessage.textContent = 'Please enter a valid input';
            errorContainer.appendChild(errorMessage);
        } else {
            input.classList.remove('border-red-500');
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

    // Function to get server time
    async function getServerTime() {
        try {
            const response = await fetch('/server-time');
            const data = await response.json();
            return new Date(data.current_time);
        } catch (error) {
            console.error("Error fetching server time:", error);
            return new Date(); // Fallback to local time if server request fails
        }
    }

    // Function to validate age based on Philippine educational system requirements
    async function validateAge(birthDate, ageInput, errorContainer, isApplicant = false) {
        const today = await getServerTime();
        const birth = new Date(birthDate);

        // Clear existing error messages
        if (errorContainer) {
            errorContainer.innerHTML = '';
            errorContainer.classList.add('hidden');
        }

        // Validate birth date is not in the future
        if (birth > today) {
            if (errorContainer) {
                errorContainer.innerHTML = 'Date of birth cannot be in the future';
                errorContainer.classList.remove('hidden');
            }
            ageInput.value = 'Invalid';
            ageInput.classList.add('border-red-500');
            return false;
        }

        // Calculate age
        let age = today.getFullYear() - birth.getFullYear();
        const monthDiff = today.getMonth() - birth.getMonth();

        if (monthDiff < 0 || (monthDiff === 0 && today.getDate() < birth.getDate())) {
            age--;
        }

        // Different validation rules for applicant vs siblings
        if (isApplicant) {
            // Validate minimum age for applicant (12 years for Grade 7)
            if (age < 12) {
                if (errorContainer) {
                    errorContainer.innerHTML = 'Applicant must be at least 12 years old for junior high school admission';
                    errorContainer.classList.remove('hidden');
                }
                ageInput.value = age;
                ageInput.classList.add('border-red-500');
                return false;
            }
        } else {
            // For siblings, use more lenient validation (minimum 3 years old)
            if (age < 3) {
                if (errorContainer) {
                    errorContainer.innerHTML = 'Sibling must be at least 3 years old';
                    errorContainer.classList.remove('hidden');
                }
                ageInput.value = age;
                ageInput.classList.add('border-red-500');
                return false;
            }
        }

        // Maximum age validation (30 years is reasonable for school)
        if (age > 30) {
            if (errorContainer) {
                errorContainer.innerHTML = 'Age cannot exceed 30 years';
                errorContainer.classList.remove('hidden');
            }
            ageInput.value = age;
            ageInput.classList.add('border-red-500');
            return false;
        }

        // Valid age
        ageInput.value = age;
        ageInput.classList.remove('border-red-500');
        return true;
    }

    // Updated function to calculate age based on birthdate using server time
    async function calculateAge(birthDate) {
        const today = await getServerTime();
        const birth = new Date(birthDate);

        // Check if date is valid
        if (isNaN(birth.getTime())) {
            return 'Invalid';
        }

        // Check if birth date is in the future
        if (birth > today) {
            return 'Invalid';
        }

        let age = today.getFullYear() - birth.getFullYear();
        const monthDiff = today.getMonth() - birth.getMonth();

        if (monthDiff < 0 || (monthDiff === 0 && today.getDate() < birth.getDate())) {
            age--;
        }

        return age;
    }

    // Updated event listener for birthdate change
    document.getElementById('applicant_date_birth').addEventListener('change', async function() {
        const ageInput = document.getElementById('age');
        const birthDate = this.value;

        // Find or create error container
        let errorContainer = this.parentElement.querySelector('.date-error');
        if (!errorContainer) {
            errorContainer = document.createElement('p');
            errorContainer.className = 'date-error text-red-500 text-sm mt-1 hidden';
            this.parentElement.appendChild(errorContainer);
        }

        if (birthDate) {
            // Pass isApplicant=true to apply stricter age validation for applicants
            await validateAge(birthDate, ageInput, errorContainer, true);
        } else {
            ageInput.value = '';
            ageInput.classList.remove('border-red-500');
            errorContainer.classList.add('hidden');
        }
    });

    // Sibling entries handling
    let siblingCount = 1;
    document.getElementById('add-sibling').addEventListener('click', function() {
        const container = document.getElementById('siblings-container');
        const newEntry = document.createElement('div');
        newEntry.className = 'sibling-entry grid grid-cols-5 gap-4 mb-4 relative';
        newEntry.innerHTML = `
            <input type="text" name="siblings[${siblingCount}][given_name]" placeholder="Given Name" class="rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
            <input type="text" name="siblings[${siblingCount}][middle_name]" placeholder="Middle Name" class="rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
            <input type="text" name="siblings[${siblingCount}][last_name]" placeholder="Last Name" class="rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
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

    // Updated function to calculate and validate sibling age
    async function calculateSiblingAge(dateInput) {
        const siblingEntry = dateInput.closest('.sibling-entry');
        const ageInput = siblingEntry.querySelector('input[name$="[age]"]');
        const birthDate = dateInput.value;

        // Find or create error container
        let errorContainer = siblingEntry.querySelector('.sibling-date-error');
        if (!errorContainer) {
            errorContainer = document.createElement('p');
            errorContainer.className = 'sibling-date-error text-red-500 text-sm mt-1 hidden';
            dateInput.parentElement.appendChild(errorContainer);
        }

        if (birthDate) {
            // Pass isApplicant=false to apply standard age validation for siblings
            await validateAge(birthDate, ageInput, errorContainer, false);
        } else {
            ageInput.value = '';
            ageInput.classList.remove('border-red-500');
            errorContainer.classList.add('hidden');
        }
    }

    // Function to validate date of birth on form submission
    async function validateDatesBeforeSubmit() {
        const applicantBirthDate = document.getElementById('applicant_date_birth').value;
        const ageInput = document.getElementById('age');

        // Find or create error container for applicant
        let errorContainer = document.getElementById('applicant_date_birth').parentElement.querySelector('.date-error');
        if (!errorContainer) {
            errorContainer = document.createElement('p');
            errorContainer.className = 'date-error text-red-500 text-sm mt-1 hidden';
            document.getElementById('applicant_date_birth').parentElement.appendChild(errorContainer);
        }

        // Validate applicant's date of birth (passing isApplicant=true)
        const isApplicantAgeValid = await validateAge(applicantBirthDate, ageInput, errorContainer, true);

        // Validate siblings' dates of birth if not marked as only child
        const onlyChildCheckbox = document.getElementById('only-child');
        let areSiblingAgesValid = true;

        if (!onlyChildCheckbox.checked) {
            const siblingDateInputs = document.querySelectorAll('input[name$="[date_of_birth]"]');

            for (const dateInput of siblingDateInputs) {
                const siblingEntry = dateInput.closest('.sibling-entry');
                const siblingAgeInput = siblingEntry.querySelector('input[name$="[age]"]');

                // Skip if no date entered
                if (!dateInput.value) continue;

                // Find or create error container for sibling
                let siblingErrorContainer = siblingEntry.querySelector('.sibling-date-error');
                if (!siblingErrorContainer) {
                    siblingErrorContainer = document.createElement('p');
                    siblingErrorContainer.className = 'sibling-date-error text-red-500 text-sm mt-1 hidden';
                    dateInput.parentElement.appendChild(siblingErrorContainer);
                }

                // Validate sibling's date of birth (passing isApplicant=false)
                const isSiblingAgeValid = await validateAge(dateInput.value, siblingAgeInput, siblingErrorContainer, false);
                if (!isSiblingAgeValid) {
                    areSiblingAgesValid = false;
                }
            }
        }

        return isApplicantAgeValid && areSiblingAgesValid;
    }

    // Add form submission validation for date of birth
    document.addEventListener('DOMContentLoaded', function() {
        const form = document.querySelector('form');

        if (form) {
            const originalSubmit = form.onsubmit;

            form.onsubmit = async function(event) {
                // Prevent default form submission
                event.preventDefault();

                // Validate dates of birth
                const areDatesValid = await validateDatesBeforeSubmit();

                if (!areDatesValid) {
                    // Scroll to the first error message
                    const firstError = document.querySelector('.date-error:not(.hidden), .sibling-date-error:not(.hidden)');
                    if (firstError) {
                        firstError.scrollIntoView({ behavior: 'smooth', block: 'center' });
                    }
                    return false;
                }

                // If dates are valid, proceed with original submit handler or submit the form
                if (originalSubmit) {
                    return originalSubmit.call(form);
                } else {
                    form.submit();
                }
            };
        }
    });

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

    // Year of Graduation field validation
    document.querySelector('input[name="year_of_graduation"]').addEventListener('input', function(e) {
        const currentYear = new Date().getFullYear();
        const value = this.value;
        const isValid = /^\d{0,4}$/.test(value); // Allow up to 4 digits
        const year = parseInt(value);

        // Find or create error container
        let errorContainer = this.parentElement.parentElement.querySelector('.error-container');
        if (!errorContainer) {
            errorContainer = document.createElement('div');
            errorContainer.className = 'error-container mt-1';
            this.parentElement.parentElement.appendChild(errorContainer);
        }

        // Clear existing error messages
        errorContainer.innerHTML = '';
        this.classList.remove('border-red-500');

        // Only validate if there's a value
        if (value) {
            if (!isValid) {
                this.classList.add('border-red-500');
                const errorMessage = document.createElement('p');
                errorMessage.className = 'error-message text-red-500 text-sm mt-1';
                errorMessage.textContent = 'Please enter numbers only';
                errorContainer.appendChild(errorMessage);
            } else if (value.length === 4) {
                // Only validate year range when 4 digits are entered
                if (year < 1900 || year > currentYear + 10) {
                    this.classList.add('border-red-500');
                    const errorMessage = document.createElement('p');
                    errorMessage.className = 'error-message text-red-500 text-sm mt-1';
                    errorMessage.textContent = `Please enter a valid year between 1900 and ${currentYear + 10}`;
                    errorContainer.appendChild(errorMessage);
                }
            }
        }

        // Limit to 4 digits
        if (value.length > 4) {
            this.value = value.slice(0, 4);
        }
    });

    // Simplified LRN field validation
    document.querySelector('input[name="lrn"]').addEventListener('input', function(e) {
        const isValid = /^\d*$/.test(this.value);
        const errorContainer = this.parentElement.nextElementSibling;

        // Clear existing error messages
        errorContainer.innerHTML = '';
        this.classList.remove('border-red-500');

        if (!isValid) {
            this.classList.add('border-red-500');
            const errorMessage = document.createElement('p');
            errorMessage.className = 'text-red-500 text-sm';
            errorMessage.textContent = 'Please enter numbers only';
            errorContainer.appendChild(errorMessage);
        } else if (this.value.length > 0 && this.value.length !== 12) {
            this.classList.add('border-red-500');
            const errorMessage = document.createElement('p');
            errorMessage.className = 'text-red-500 text-sm';
            errorMessage.textContent = 'LRN must be exactly 12 digits';
            errorContainer.appendChild(errorMessage);
        }

        // Limit to 12 digits
        if (this.value.length > 12) {
            this.value = this.value.slice(0, 12);
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
        // Find or create error container
        let errorContainer = this.parentElement.parentElement.querySelector('.error-container');
        if (!errorContainer) {
            errorContainer = document.createElement('div');
            errorContainer.className = 'error-container mt-1';
            this.parentElement.parentElement.appendChild(errorContainer);
        }

        // Clear existing error messages
        errorContainer.innerHTML = '';
        this.classList.remove('border-red-500');

        // If there's a decimal point, limit decimal places to 2 without rounding
        if (this.value.includes('.')) {
            const parts = this.value.split('.');
            const whole = parts[0].slice(0, 2); // Limit whole number to 2 digits
            const decimal = parts[1] ? parts[1].slice(0, 2) : ''; // Limit decimal to 2 digits
            this.value = decimal ? `${whole}.${decimal}` : `${whole}.`;
        } else if (this.value.length > 2) {
            this.value = this.value.slice(0, 2);
        }

        // Check if input contains any non-numeric characters (except decimal point)
        const hasInvalidChars = /[^\d.]/.test(this.value);

        // Check format: XX.XX (numbers between 0-9, exactly 2 digits before and after decimal)
        const isValid = /^(\d{0,2})(\.)?(\d{0,2})$/.test(this.value);

        // Additional validation to ensure the value is between 0 and 100
        const numValue = parseFloat(this.value);
        const isValidRange = isNaN(numValue) || (numValue >= 0 && numValue <= 100);

        if (hasInvalidChars || !isValid || (!isValidRange && !isNaN(numValue))) {
            this.classList.add('border-red-500');
            const errorMessage = document.createElement('p');
            errorMessage.className = 'text-red-500 text-sm';
            errorMessage.textContent = 'Please enter a valid GWA (e.g., 90.78)';
            errorContainer.appendChild(errorMessage);
        }
    });

    document.addEventListener('DOMContentLoaded', function() {
        // Array of input field IDs
        const mobileFieldIds = [
            'applicant_mobile_number',
            'father_contact',
            'mother_contact',
            'guardian_contact_num',
            'emergency_contact_mobile'
        ];

        // Function to format mobile number
        function formatMobileNumber(value) {
            // Remove any non-digit characters
            let cleaned = value.replace(/\D/g, '');

            // Remove leading zero if present
            if (cleaned.startsWith('0')) {
                cleaned = cleaned.substring(1);
            }

            // Limit to 10 digits
            cleaned = cleaned.slice(0, 10);

            // Format with spaces
            if (cleaned.length > 0) {
                let formattedNumber = '';
                for (let i = 0; i < cleaned.length; i++) {
                    if (i === 3 || i === 6) {
                        formattedNumber += ' ';
                    }
                    formattedNumber += cleaned[i];
                }
                return cleaned.length === 10 ? '+63 ' + formattedNumber : formattedNumber;
            }
            return '';
        }

        // Apply formatting to each mobile input field
        mobileFieldIds.forEach(fieldId => {
            const inputField = document.getElementById(fieldId);
            if (inputField) {
                // Handle input event
                inputField.addEventListener('input', function(e) {
                    this.value = formatMobileNumber(this.value);
                });

                // Handle blur event
                inputField.addEventListener('blur', function() {
                    let value = this.value.replace(/\D/g, '');
                    if (value.length === 10) {
                        this.value = '+63 ' + value.replace(/(\d{3})(\d{3})(\d{4})/, '$1 $2 $3');
                    }
                });
            }
        });
    });

    //telephone number formatting
    document.addEventListener('DOMContentLoaded', function() {
        const telInputs = [
            { input: document.getElementById('applicant_tel_no'), select: document.getElementById('tel_area_code') },
            { input: document.getElementById('emergency_contact_tel'), select: document.getElementById('emergency_tel_area_code') }
        ];

        function formatPhoneNumber(value, areaCode) {
            // Remove all non-digit characters
            let cleaned = value.replace(/\D/g, '');

            // If value starts with area code, remove it to avoid duplication
            if (cleaned.startsWith(areaCode)) {
                cleaned = cleaned.substring(areaCode.length);
            }

            // Metro Manila (02) area code needs 8 digits
            if (areaCode === '02') {
                // Don't limit digits during input, only when formatting
                if (cleaned.length > 4) {
                    return areaCode + ' ' + cleaned.slice(0, 4) + ' ' + cleaned.slice(4);
                }
                return areaCode + ' ' + cleaned;
            } else {
                // Other area codes - 7 digits
                if (cleaned.length > 3) {
                    return areaCode + ' ' + cleaned.slice(0, 3) + ' ' + cleaned.slice(3);
                }
                return areaCode + ' ' + cleaned;
            }
        }

        telInputs.forEach(({ input, select }) => {
            if (input && select) {
                // Set appropriate maxlength based on area code
                function updateMaxLength() {
                    const areaCode = select.value;
                    // For 02 (Metro Manila): 2 + 1 + 4 + 1 + 4 = 12 chars
                    // For others: length of area code + 1 + 3 + 1 + 4 = area code length + 9
                    const maxLength = (areaCode === '02') ? 12 : (areaCode.length + 9);
                    input.setAttribute('maxlength', maxLength);
                }

                // Update maxlength immediately
                updateMaxLength();

                // Update when area code changes
                select.addEventListener('change', function() {
                    input.value = this.value + ' ';
                    updateMaxLength();
                });

                input.addEventListener('input', function() {
                    const areaCode = select.value;
                    this.value = formatPhoneNumber(this.value, areaCode);
                });

                input.addEventListener('focus', function() {
                    if (!this.value) {
                        const areaCode = select.value;
                        this.value = areaCode + ' ';
                    }
                });

                // Clear error messages
                input.addEventListener('input', function() {
                    const errorMessage = this.parentNode.querySelector('.error-message');
                    if (errorMessage) {
                        errorMessage.remove();
                    }
                    this.classList.remove('border-red-500');
                });
            }
        });
    });

    // Function to handle program selection and grade level updates
    function handleProgramSelection() {
        const programSelect = document.getElementById('apply_program');
        const gradeLevelSelect = document.getElementById('apply_grade_level');
        const gradeLevelDisplay = document.getElementById('grade_level_display');
        const strandContainer = document.getElementById('strandContainer');

        if (!programSelect || !gradeLevelSelect || !gradeLevelDisplay) return;

        // Clear the hidden select
        while (gradeLevelSelect.options.length > 0) {
            gradeLevelSelect.remove(0);
        }

        // Set appropriate grade level based on program
        if (programSelect.value === 'High School') {
            // For High School, only Grade 7 is available
            const option = document.createElement('option');
            option.value = '7';
            option.textContent = 'Grade 7';
            gradeLevelSelect.appendChild(option);

            // Set the value for the hidden select and display in the text input
            gradeLevelSelect.value = '7';
            gradeLevelDisplay.value = 'Grade 7';

            // Hide strand selection (only for Senior High)
            if (strandContainer) strandContainer.classList.add('hidden');
        }
        else if (programSelect.value === 'Senior High School') {
            // For Senior High School, only Grade 11 is available
            const option = document.createElement('option');
            option.value = '11';
            option.textContent = 'Grade 11';
            gradeLevelSelect.appendChild(option);

            // Set the value for the hidden select and display in the text input
            gradeLevelSelect.value = '11';
            gradeLevelDisplay.value = 'Grade 11';

            // Show strand selection
            if (strandContainer) strandContainer.classList.remove('hidden');
        }
        else {
            // If no program selected, add a placeholder option
            const defaultOption = document.createElement('option');
            defaultOption.value = '';
            defaultOption.textContent = 'Select Grade Level';
            gradeLevelSelect.appendChild(defaultOption);

            // Clear the display
            gradeLevelDisplay.value = '';

            // Hide strand selection
            if (strandContainer) strandContainer.classList.add('hidden');
        }
    }

    // Initialize student type options
    function initializeStudentTypeOptions() {
        const studentTypeSelect = document.getElementById('student_type');
        if (!studentTypeSelect) return;

        // Remove "Existing Student" option if it exists
        for (let i = 0; i < studentTypeSelect.options.length; i++) {
            if (studentTypeSelect.options[i].value === 'Existing Student') {
                studentTypeSelect.remove(i);
                break;
            }
        }
    }

    // Replace the program dropdown options
    function replaceProgramOptions() {
        const programSelect = document.getElementById('apply_program');
        if (!programSelect) return;

        // Clear all existing options
        while (programSelect.options.length > 0) {
            programSelect.remove(0);
        }

        // Add default option
        const defaultOption = document.createElement('option');
        defaultOption.value = '';
        defaultOption.textContent = 'Select Program';
        programSelect.appendChild(defaultOption);

        // Add only High School and Senior High School options
        const hsOption = document.createElement('option');
        hsOption.value = 'High School';
        hsOption.textContent = 'High School';
        programSelect.appendChild(hsOption);

        const shsOption = document.createElement('option');
        shsOption.value = 'Senior High School';
        shsOption.textContent = 'Senior High School';
        programSelect.appendChild(shsOption);
    }

    // Add initialization to the document ready event
    document.addEventListener('DOMContentLoaded', function() {
        // Replace program options with only High School and Senior High School
        replaceProgramOptions();

        // Set up event listener for program change
        const programSelect = document.getElementById('apply_program');
        if (programSelect) {
            programSelect.addEventListener('change', handleProgramSelection);
        }

        // Initialize student type options
        initializeStudentTypeOptions();

        // Initial setup based on current program value
        handleProgramSelection();
    });

    // Also check the maxlength attribute of the emergency_contact_tel field
    document.addEventListener('DOMContentLoaded', function() {
        // ... existing code ...

        // Update maxlength attribute based on area code selection
        const emergencyTelAreaCode = document.getElementById('emergency_tel_area_code');
        const emergencyContactTel = document.getElementById('emergency_contact_tel');

        function updateMaxLength() {
            if (emergencyTelAreaCode && emergencyContactTel) {
                // Set maxlength to 15 to accommodate full formatted number
                emergencyContactTel.maxlength = 15;
            }
        }

        if (emergencyTelAreaCode) {
            emergencyTelAreaCode.addEventListener('change', updateMaxLength);
        }

        // Set initial maxlength
        updateMaxLength();

        // Remove error message when input changes
        if (emergencyContactTel) {
            emergencyContactTel.addEventListener('input', function() {
                const errorMessage = this.parentNode.querySelector('.error-message');
                if (errorMessage) {
                    errorMessage.remove();
                }
                this.classList.remove('border-red-500');
            });
        }
    });
</script>
@endpush
@endsection

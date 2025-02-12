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
        <form action="{{ route('admission.store') }}" method="POST" enctype="multipart/form-data" x-data="admissionForm()">
            @csrf
            
            <!-- Program Information -->
            <div class="mb-8" x-data="{ isOpen: true }" >
                <h2 class="text-xl font-semibold mb-4 pb-2 border-b flex justify-between items-center cursor-pointer"
                    @click="isOpen = !isOpen">
                    <span>Program Information</span>
                    <i class="fas" :class="isOpen ? 'fa-chevron-up' : 'fa-chevron-down'"></i>
                </h2>
                
                <div x-show="isOpen" x-transition>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Program Type <span class="text-red-500">*</span></label>
                            <select name="program_type" x-model="programType" 
                                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" required>
                                <option value="">Select Program Type</option>
                                <option value="Elementary">Elementary</option>
                                <option value="Junior High School">Junior High School</option>
                                <option value="Senior High School">Senior High School</option>
                            </select>
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700">Grade Level <span class="text-red-500">*</span></label>
                            <select name="grade_level" x-model="gradeLevel"
                                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" required>
                                <option value="">Select Grade Level</option>
                                <template x-if="programType === 'Elementary'">
                                    <template x-for="grade in [1,2,3,4,5,6]" :key="grade">
                                        <option :value="grade" x-text="`Grade ${grade}`"></option>
                                    </template>
                                </template>
                                <template x-if="programType === 'Junior High School'">
                                    <template x-for="grade in [7,8,9,10]" :key="grade">
                                        <option :value="grade" x-text="`Grade ${grade}`"></option>
                                    </template>
                                </template>
                                <template x-if="programType === 'Senior High School'">
                                    <template x-for="grade in [11,12]" :key="grade">
                                        <option :value="grade" x-text="`Grade ${grade}`"></option>
                                    </template>
                                </template>
                            </select>
                        </div>

                        <div x-show="programType === 'Senior High School'">
                            <label class="block text-sm font-medium text-gray-700">Strand <span class="text-red-500">*</span></label>
                            <select name="strand" 
                                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"
                                    x-bind:required="programType === 'Senior High School'">
                                <option value="">Select Strand</option>
                                <option value="STEM">STEM (Science, Technology, Engineering, and Mathematics)</option>
                                <option value="ABM">ABM (Accountancy, Business, and Management)</option>
                                <option value="HUMSS">HUMSS (Humanities and Social Sciences)</option>
                                <option value="GAS">GAS (General Academic Strand)</option>
                                <option value="TVL">TVL (Technical-Vocational-Livelihood)</option>
                            </select>
                        </div>

                        <div class="md:col-span-2">
                            <label class="block text-sm font-medium text-gray-700">Student Type <span class="text-red-500">*</span></label>
                            <div class="mt-2 space-y-2">
                                <label class="inline-flex items-center">
                                    <input type="radio" name="student_type" value="transferee_new" x-model="studentType" class="form-radio">
                                    <span class="ml-2">Transferee</span>
                                </label>
                                <label class="inline-flex items-center ml-6">
                                    <input type="radio" name="student_type" value="existing" x-model="studentType" class="form-radio">
                                    <span class="ml-2">Existing Student</span>
                                </label>
                                <label class="inline-flex items-center ml-6">
                                    <input type="radio" name="student_type" value="returning" x-model="studentType" class="form-radio">
                                    <span class="ml-2">Returning Student</span>
                                </label>
                            </div>
                        </div>

                        <!-- Student Type Specific Fields -->
                        <template x-if="studentType === 'existing' || studentType === 'returning'">
                            <div class="md:col-span-2">
                                <div class="bg-gray-50 p-4 rounded-lg">
                                    <h3 class="font-medium mb-4">Student Lookup</h3>
                                    <div class="flex gap-4">
                                        <input type="text" name="student_id" placeholder="Enter Student ID" 
                                               class="flex-1 rounded-md border-gray-300">
                                        <button type="button" class="bg-blue-500 text-white px-4 py-2 rounded-md">
                                            Search
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </template>

                        <!-- Transferee Fields -->
                        <template x-if="studentType === 'transferee_new'">
                            <div class="md:col-span-2 grid grid-cols-1 md:grid-cols-2 gap-6">
                                <div>
                                    <label class="block text-sm font-medium text-gray-700">Previous School <span class="text-red-500">*</span></label>
                                    <input type="text" name="previous_school" 
                                           class="mt-1 block w-full rounded-md border-gray-300"
                                           x-bind:required="studentType === 'transferee_new'">
                                    <p class="mt-1 text-sm text-gray-500">Only letters, spaces, and hyphens are allowed</p>
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-gray-700">Transfer Reason <span class="text-red-500">*</span></label>
                                    <textarea name="transfer_reason" 
                                              class="mt-1 block w-full rounded-md border-gray-300"
                                              x-bind:required="studentType === 'transferee_new'"></textarea>
                                </div>
                            </div>
                        </template>

                        <!-- Returning Student Fields -->
                        <template x-if="studentType === 'returning'">
                            <div class="md:col-span-2 grid grid-cols-1 md:grid-cols-2 gap-6">
                                <div>
                                    <label class="block text-sm font-medium text-gray-700">Previous Enrollment Period <span class="text-red-500">*</span></label>
                                    <input type="text" name="previous_enrollment_period" 
                                           class="mt-1 block w-full rounded-md border-gray-300"
                                           x-bind:required="studentType === 'returning'">
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-gray-700">Gap Period (in years) <span class="text-red-500">*</span></label>
                                    <input type="number" name="gap_period" min="1" 
                                           class="mt-1 block w-full rounded-md border-gray-300"
                                           x-bind:required="studentType === 'returning'">
                                </div>
                                <div class="md:col-span-2">
                                    <label class="block text-sm font-medium text-gray-700">Reason for Return <span class="text-red-500">*</span></label>
                                    <textarea name="return_reason" 
                                              class="mt-1 block w-full rounded-md border-gray-300"
                                              x-bind:required="studentType === 'returning'"></textarea>
                                </div>
                            </div>
                        </template>

                        <!-- Existing Student Fields -->
                        <template x-if="studentType === 'existing'">
                            <div class="md:col-span-2 grid grid-cols-1 md:grid-cols-2 gap-6">
                                <div>
                                    <label class="block text-sm font-medium text-gray-700">Current Grade Level <span class="text-red-500">*</span></label>
                                    <input type="text" name="current_grade_level" 
                                           class="mt-1 block w-full rounded-md border-gray-300"
                                           x-bind:required="studentType === 'existing'">
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-gray-700">Academic Status <span class="text-red-500">*</span></label>
                                    <select name="academic_status" 
                                            class="mt-1 block w-full rounded-md border-gray-300"
                                            x-bind:required="studentType === 'existing'">
                                        <option value="">Select Status</option>
                                        <option value="regular">Regular</option>
                                        <option value="irregular">Irregular</option>
                                        <option value="probation">Probation</option>
                                    </select>
                                </div>
                            </div>
                        </template>
                    </div>
                </div>
            </div>

            <!-- Personal Information -->
            <div class="mb-8" x-data="{ isOpen: true }">
                <h2 class="text-xl font-semibold mb-4 pb-2 border-b flex justify-between items-center cursor-pointer"
                    @click="isOpen = !isOpen">
                    <span>Personal Information</span>
                    <i class="fas" :class="isOpen ? 'fa-chevron-up' : 'fa-chevron-down'"></i>
                </h2>
                
                <div x-show="isOpen" x-transition>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Given Name <span class="text-red-500">*</span></label>
                            <input type="text" name="applicant_given_name" required 
                                   x-model="formData.givenName"
                                   @input="validateName($event, 'givenName')"
                                   class="mt-1 block w-full rounded-md border-gray-300">
                            <p class="mt-1 text-sm" :class="errors.givenName ? 'text-red-500' : 'text-gray-500'">
                                Only letters, spaces, and hyphens are allowed
                            </p>
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700">Surname <span class="text-red-500">*</span></label>
                            <input type="text" name="applicant_surname" required 
                                   x-model="formData.surname"
                                   @input="validateName($event, 'surname')"
                                   class="mt-1 block w-full rounded-md border-gray-300">
                            <p class="mt-1 text-sm" :class="errors.surname ? 'text-red-500' : 'text-gray-500'">
                                Only letters, spaces, and hyphens are allowed
                            </p>
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700">Middle Name</label>
                            <input type="text" name="applicant_middle_name" 
                                   x-model="formData.middleName"
                                   @input="validateName($event, 'middleName')"
                                   class="mt-1 block w-full rounded-md border-gray-300">
                            <p class="mt-1 text-sm" :class="errors.middleName ? 'text-red-500' : 'text-gray-500'">
                                Only letters, spaces, and hyphens are allowed
                            </p>
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700">Extension Name <span class="text-red-500">*</span></label>
                            <input type="text" name="applicant_extension" 
                                   placeholder="Jr., II, III, etc."
                                   x-model="formData.extension"
                                   @input="validateName($event, 'extension')"
                                   class="mt-1 block w-full rounded-md border-gray-300">
                            <p class="mt-1 text-sm" :class="errors.extension ? 'text-red-500' : 'text-gray-500'">
                                Only letters, spaces, and periods are allowed
                            </p>
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700">Sex <span class="text-red-500">*</span></label>
                            <select name="gender" required x-model="formData.gender"
                                    class="mt-1 block w-full rounded-md border-gray-300">
                                <option value="">Select Sex</option>
                                <option value="Male">Male</option>
                                <option value="Female">Female</option>
                            </select>
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700">Date of Birth <span class="text-red-500">*</span></label>
                            <input type="date" name="applicant_date_birth" required 
                                   x-model="formData.dateOfBirth"
                                   @change="calculateAge"
                                   class="mt-1 block w-full rounded-md border-gray-300">
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700">Age</label>
                            <input type="number" name="age" readonly
                                   x-model="formData.age"
                                   class="mt-1 block w-full rounded-md border-gray-300 bg-gray-50">
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700">Contact Number <span class="text-red-500">*</span></label>
                            <input type="tel" name="applicant_mobile_number" required 
                                   x-model="formData.contactNumber"
                                   @input="validatePhoneNumber($event, 'contactNumber')"
                                   placeholder="09xx-xxx-xxxx"
                                   class="mt-1 block w-full rounded-md border-gray-300">
                            <p class="mt-1 text-sm" :class="errors.contactNumber ? 'text-red-500' : 'text-gray-500'">
                                Format: 09XX-XXX-XXXX
                            </p>
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700">Telephone Number</label>
                            <input type="tel" name="applicant_tel_no"
                                   x-model="formData.telephoneNumber"
                                   @input="validateTelNumber($event, 'telephoneNumber')"
                                   placeholder="(02) XXXX-XXXX"
                                   class="mt-1 block w-full rounded-md border-gray-300">
                            <p class="mt-1 text-sm" :class="errors.telephoneNumber ? 'text-red-500' : 'text-gray-500'">
                                Format: (02) XXXX-XXXX
                            </p>
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700">Nationality <span class="text-red-500">*</span></label>
                            <input type="text" name="applicant_nationality" required
                                   x-model="formData.nationality"
                                   @input="validateName($event, 'nationality')"
                                   class="mt-1 block w-full rounded-md border-gray-300">
                            <p class="mt-1 text-sm" :class="errors.nationality ? 'text-red-500' : 'text-gray-500'">
                                Only letters, spaces, and hyphens are allowed
                            </p>
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700">Religion <span class="text-red-500">*</span></label>
                            <input type="text" name="applicant_religion" required
                                   x-model="formData.religion"
                                   @input="validateName($event, 'religion')"
                                   class="mt-1 block w-full rounded-md border-gray-300">
                            <p class="mt-1 text-sm" :class="errors.religion ? 'text-red-500' : 'text-gray-500'">
                                Only letters, spaces, and hyphens are allowed
                            </p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Contact Information -->
            <div class="mb-8">
                <h2 class="text-xl font-semibold mb-4 pb-2 border-b">Contact Information</h2>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div class="md:col-span-2">
                        <label class="block text-sm font-medium text-gray-700">Street Address</label>
                        <input type="text" name="applicant_address_street" required class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700">City</label>
                        <input type="text" name="applicant_address_city" required class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Province</label>
                        <input type="text" name="applicant_address_province" required class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Mobile Number</label>
                        <input type="tel" name="applicant_mobile_number" required class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                    </div>
                </div>
            </div>

            <!-- Educational Background -->
            <div class="mb-8">
                <h2 class="text-xl font-semibold mb-4 pb-2 border-b">Educational Background</h2>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label class="block text-sm font-medium text-gray-700">LRN</label>
                        <input type="text" name="lrn" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
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
                        <input type="text" name="year_of_graduation" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
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
            <div class="mb-8" x-data="{ isOpen: true }">
                <h2 class="text-xl font-semibold mb-4 pb-2 border-b flex justify-between items-center cursor-pointer"
                    @click="isOpen = !isOpen">
                    <span>Family Information</span>
                    <i class="fas" :class="isOpen ? 'fa-chevron-up' : 'fa-chevron-down'"></i>
                </h2>
                
                <div x-show="isOpen" x-transition>
                    <p class="text-sm text-gray-600 mb-4">Please provide information for at least one guardian (Father, Mother, or Guardian)</p>
                    
                    <!-- Father's Information -->
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Father's Name</label>
                            <input type="text" name="father_name" 
                                   x-model="formData.fatherName"
                                   @input="validateName($event, 'fatherName')"
                                   class="mt-1 block w-full rounded-md border-gray-300">
                            <p class="mt-1 text-sm" :class="errors.fatherName ? 'text-red-500' : 'text-gray-500'">
                                Only letters, spaces, and hyphens are allowed
                            </p>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Father's Contact Number</label>
                            <input type="tel" name="father_contact" 
                                   x-model="formData.fatherContact"
                                   @input="validatePhoneNumber($event, 'fatherContact')"
                                   placeholder="09xx-xxx-xxxx"
                                   class="mt-1 block w-full rounded-md border-gray-300">
                            <p class="mt-1 text-sm" :class="errors.fatherContact ? 'text-red-500' : 'text-gray-500'">
                                Format: 09XX-XXX-XXXX
                            </p>
                        </div>
                    </div>

                    <!-- Mother's Information -->
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Mother's Name</label>
                            <input type="text" name="mother_name" 
                                   x-model="formData.motherName"
                                   @input="validateName($event, 'motherName')"
                                   class="mt-1 block w-full rounded-md border-gray-300">
                            <p class="mt-1 text-sm" :class="errors.motherName ? 'text-red-500' : 'text-gray-500'">
                                Only letters, spaces, and hyphens are allowed
                            </p>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Mother's Contact Number</label>
                            <input type="tel" name="mother_contact" 
                                   x-model="formData.motherContact"
                                   @input="validatePhoneNumber($event, 'motherContact')"
                                   placeholder="09xx-xxx-xxxx"
                                   class="mt-1 block w-full rounded-md border-gray-300">
                            <p class="mt-1 text-sm" :class="errors.motherContact ? 'text-red-500' : 'text-gray-500'">
                                Format: 09XX-XXX-XXXX
                            </p>
                        </div>
                    </div>

                    <!-- Legal Guardian's Information -->
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Legal Guardian's Name</label>
                            <input type="text" name="guardian_name" 
                                   x-model="formData.guardianName"
                                   @input="validateName($event, 'guardianName')"
                                   class="mt-1 block w-full rounded-md border-gray-300">
                            <p class="mt-1 text-sm" :class="errors.guardianName ? 'text-red-500' : 'text-gray-500'">
                                Only letters, spaces, and hyphens are allowed
                            </p>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Guardian's Contact Number</label>
                            <input type="tel" name="guardian_contact" 
                                   x-model="formData.guardianContact"
                                   @input="validatePhoneNumber($event, 'guardianContact')"
                                   placeholder="09xx-xxx-xxxx"
                                   class="mt-1 block w-full rounded-md border-gray-300">
                            <p class="mt-1 text-sm" :class="errors.guardianContact ? 'text-red-500' : 'text-gray-500'">
                                Format: 09XX-XXX-XXXX
                            </p>
                        </div>
                    </div>
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
                        <input type="text" name="emergency_contact_tel" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Mobile No.</label>
                        <input type="text" name="emergency_contact_mobile" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                    </div>
                    <div class="md:col-span-2">
                        <label class="block text-sm font-medium text-gray-700">Email</label>
                        <input type="email" name="emergency_contact_email" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                    </div>
                </div>
            </div>

            <!-- Required Documents -->
            <div class="mb-8" x-data="{ isOpen: true }">
                <h2 class="text-xl font-semibold mb-4 pb-2 border-b flex justify-between items-center cursor-pointer"
                    @click="isOpen = !isOpen">
                    <span>Required Documents</span>
                    <i class="fas" :class="isOpen ? 'fa-chevron-up' : 'fa-chevron-down'"></i>
                </h2>
                
                <div x-show="isOpen" x-transition>
                    <p class="text-sm text-gray-600 mb-4">Please upload the following documents. All files must be in PDF, JPG, or PNG format and must not exceed 10MB.</p>

                    <!-- Common Documents for All -->
                    <div class="space-y-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-700">PSA Birth Certificate <span class="text-red-500">*</span></label>
                            <input type="file" name="birth_certificate" 
                                   accept=".pdf,.jpg,.jpeg,.png"
                                   class="mt-1 block w-full"
                                   @change="validateFile($event, 'birthCertificate')">
                            <p class="mt-1 text-sm text-gray-500">Upload PDF/JPG/PNG files only (max: 10MB)</p>
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700">2x2 Photo <span class="text-red-500">*</span></label>
                            <input type="file" name="photo" 
                                   accept=".jpg,.jpeg,.png"
                                   class="mt-1 block w-full"
                                   @change="validateFile($event, 'photo')">
                            <p class="mt-1 text-sm text-gray-500">Upload JPG/PNG files only (max: 10MB)</p>
                        </div>
                    </div>

                    <!-- Conditional Documents based on Student Type -->
                    <template x-if="studentType === 'transferee_new'">
                        <div class="space-y-4 mt-4">
                            <div>
                                <label class="block text-sm font-medium text-gray-700">Form 137 <span class="text-red-500">*</span></label>
                                <input type="file" name="form_137" 
                                       accept=".pdf,.jpg,.jpeg,.png"
                                       class="mt-1 block w-full"
                                       @change="validateFile($event, 'form137')">
                                <p class="mt-1 text-sm text-gray-500">Upload PDF/JPG/PNG files only (max: 10MB)</p>
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700">Latest Form 138 <span class="text-red-500">*</span></label>
                                <input type="file" name="form_138" 
                                       accept=".pdf,.jpg,.jpeg,.png"
                                       class="mt-1 block w-full"
                                       @change="validateFile($event, 'form138')">
                                <p class="mt-1 text-sm text-gray-500">Upload PDF/JPG/PNG files only (max: 10MB)</p>
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700">Good Moral Certificate <span class="text-red-500">*</span></label>
                                <input type="file" name="good_moral" 
                                       accept=".pdf,.jpg,.jpeg,.png"
                                       class="mt-1 block w-full"
                                       @change="validateFile($event, 'goodMoral')">
                                <p class="mt-1 text-sm text-gray-500">Upload PDF/JPG/PNG files only (max: 10MB)</p>
                            </div>
                        </div>
                    </template>

                    <!-- Existing Student Documents -->
                    <template x-if="studentType === 'existing'">
                        <div class="space-y-4 mt-4">
                            <div>
                                <label class="block text-sm font-medium text-gray-700">Form 138 (Report Card) <span class="text-red-500">*</span></label>
                                <input type="file" name="form_138" 
                                       accept=".pdf,.jpg,.jpeg,.png"
                                       class="mt-1 block w-full"
                                       @change="validateFile($event, 'form138')">
                                <p class="mt-1 text-sm text-gray-500">Upload PDF/JPG/PNG files only (max: 10MB)</p>
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700">Good Moral Certificate <span class="text-red-500">*</span></label>
                                <input type="file" name="good_moral" 
                                       accept=".pdf,.jpg,.jpeg,.png"
                                       class="mt-1 block w-full"
                                       @change="validateFile($event, 'goodMoral')">
                                <p class="mt-1 text-sm text-gray-500">Upload PDF/JPG/PNG files only (max: 10MB)</p>
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700">Parent's/Guardian's Valid ID <span class="text-red-500">*</span></label>
                                <input type="file" name="guardian_id" 
                                       accept=".pdf,.jpg,.jpeg,.png"
                                       class="mt-1 block w-full"
                                       @change="validateFile($event, 'guardianId')">
                                <p class="mt-1 text-sm text-gray-500">Upload PDF/JPG/PNG files only (max: 10MB)</p>
                            </div>
                        </div>
                    </template>

                    <!-- Returning Student Documents -->
                    <template x-if="studentType === 'returning'">
                        <div class="space-y-4 mt-4">
                            <div>
                                <label class="block text-sm font-medium text-gray-700">Updated Parent's/Guardian's Valid ID <span class="text-red-500">*</span></label>
                                <input type="file" name="updated_guardian_id" 
                                       accept=".pdf,.jpg,.jpeg,.png"
                                       class="mt-1 block w-full"
                                       @change="validateFile($event, 'updatedGuardianId')">
                                <p class="mt-1 text-sm text-gray-500">Upload PDF/JPG/PNG files only (max: 10MB)</p>
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700">Updated Medical Records <span class="text-red-500">*</span></label>
                                <input type="file" name="medical_records" 
                                       accept=".pdf,.jpg,.jpeg,.png"
                                       class="mt-1 block w-full"
                                       @change="validateFile($event, 'medicalRecords')">
                                <p class="mt-1 text-sm text-gray-500">Upload PDF/JPG/PNG files only (max: 10MB)</p>
                            </div>
                        </div>
                    </template>
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
    function admissionForm() {
        return {
            programType: '',
            gradeLevel: '',
            studentType: '',
            formData: {
                givenName: '',
                surname: '',
                middleName: '',
                extension: '',
                gender: '',
                dateOfBirth: '',
                age: '',
                contactNumber: '',
                telephoneNumber: '',
                nationality: '',
                religion: '',
                // Family Information
                fatherName: '',
                fatherContact: '',
                motherName: '',
                motherContact: '',
                guardianName: '',
                guardianContact: ''
            },
            errors: {},
            files: {},

            init() {
                this.watchDateOfBirth();
            },

            watchDateOfBirth() {
                this.$watch('formData.dateOfBirth', value => {
                    if (value) {
                        this.calculateAge(value);
                    }
                });
            },

            calculateAge() {
                if (this.formData.dateOfBirth) {
                    const today = new Date();
                    const birthDate = new Date(this.formData.dateOfBirth);
                    let age = today.getFullYear() - birthDate.getFullYear();
                    const monthDiff = today.getMonth() - birthDate.getMonth();
                    
                    if (monthDiff < 0 || (monthDiff === 0 && today.getDate() < birthDate.getDate())) {
                        age--;
                    }
                    
                    this.formData.age = age;
                }
            },

            validateName(event, field) {
                const value = event.target.value;
                const regex = /^[\p{L}\s\-\.]+$/u;
                this.errors[field] = !regex.test(value);
            },

            validatePhoneNumber(event, field) {
                const value = event.target.value;
                const regex = /^09\d{2}-\d{3}-\d{4}$/;
                this.errors[field] = !regex.test(value);
            },

            validateTelNumber(event, field) {
                const value = event.target.value;
                const regex = /^\(02\) \d{4}-\d{4}$/;
                this.errors[field] = !regex.test(value);
            },

            validateFile(event, field) {
                const file = event.target.files[0];
                if (!file) return;

                const maxSize = 10 * 1024 * 1024; // 10MB
                const allowedTypes = ['application/pdf', 'image/jpeg', 'image/png'];
                
                this.errors[field] = [];

                if (file.size > maxSize) {
                    this.errors[field].push('File size must not exceed 10MB');
                }

                if (!allowedTypes.includes(file.type)) {
                    this.errors[field].push('File must be PDF, JPG, or PNG');
                }

                this.files[field] = file;
            },

            formatPhoneNumber(event, field) {
                let value = event.target.value.replace(/\D/g, '');
                if (value.length >= 11) {
                    value = value.substring(0, 11);
                    value = value.replace(/(\d{4})(\d{3})(\d{4})/, '$1-$2-$3');
                }
                this.formData[field] = value;
            },

            formatTelNumber(event, field) {
                let value = event.target.value.replace(/\D/g, '');
                if (value.length >= 8) {
                    value = value.substring(0, 8);
                    value = value.replace(/(\d{4})(\d{4})/, '(02) $1-$2');
                }
                this.formData[field] = value;
            }
        }
    }

    // Sibling entries handling
    let siblingCount = 1;
    document.getElementById('add-sibling').addEventListener('click', function() {
        const container = document.getElementById('siblings-container');
        const newEntry = document.createElement('div');
        newEntry.className = 'sibling-entry grid grid-cols-5 gap-4 mb-4';
        newEntry.innerHTML = `
            <input type="text" name="siblings[${siblingCount}][full_name]" placeholder="Full Name" class="rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
            <input type="date" name="siblings[${siblingCount}][date_of_birth]" class="rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
            <input type="number" name="siblings[${siblingCount}][age]" placeholder="Age" class="rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
            <input type="text" name="siblings[${siblingCount}][grade_level]" placeholder="Grade Level" class="rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
            <input type="text" name="siblings[${siblingCount}][school_attended]" placeholder="School Attended" class="rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
        `;
        container.appendChild(newEntry);
        siblingCount++;
    });
</script>
@endpush
@endsection
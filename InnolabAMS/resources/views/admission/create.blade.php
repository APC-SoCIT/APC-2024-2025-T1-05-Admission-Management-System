@extends('dashboard')
@section('title', 'Add Applicant | InnolabAMS')

@section('content')
<div class="container mx-auto px-6 py-4">
    <!-- Existing back button and title -->
    <div class="flex justify-between items-center mb-4">
        <h1 class="text-2xl font-semibold">Add New Applicant</h1>
        <a href="{{ route('admission.index') }}" class="bg-gray-500 text-white px-4 py-2 rounded hover:bg-gray-600">
            <i class="fas fa-arrow-left mr-2"></i>Back
        </a>
    </div>

    <div class="bg-white rounded-lg shadow-lg p-6"
        x-data="{
            showStudentType: false,
            studentType: '',
            programType: '',
            isDocumentsOpen: true,
            shouldShowDocument(docType) {
                if (!this.programType || !this.studentType) return false;

                const requirements = {
                    transferee: {
                        all: ['psa_birth', 'form_138', 'good_moral', 'parent_id', 'photo'],
                    },
                    existing: {
                        all: ['parent_id', 'medical_records'],
                    },
                    returning: {
                        all: ['psa_birth', 'form_138', 'good_moral', 'photo'],
                    }
                };

                return requirements[this.studentType]?.all.includes(docType);
            },
            studentId: '',
            isSearching: false,
            searchError: '',
            studentData: null,
            isReturningStudent: false,
            previousSchool: '',
            transferReason: '',
            previousEnrollment: '',
            gapPeriod: '',
            returnReason: '',
            errors: {},
            resetStudentTypeFields() {
                this.previousSchool = '';
                this.transferReason = '';
                this.previousEnrollment = '';
                this.gapPeriod = '';
                this.returnReason = '';
                this.isReturningStudent = false;
                this.studentData = null;
                this.studentId = '';
                this.searchError = '';
            },
            validateSchoolName(value) {
                if (/\d/.test(value)) {
                    this.errors.previousSchool = 'School name cannot contain numbers';
                    return false;
                }
                delete this.errors.previousSchool;
                return true;
            },
            validateName(field, value) {
                // Allow only letters, spaces, and hyphens
                if (!/^[a-zA-Z\s-]*$/.test(value)) {
                    this.errors[field] = 'Only letters, spaces, and hyphens are allowed';
                    return false;
                }
                delete this.errors[field];
                return true;
            },
            validateContact(field, value) {
                if (!value) {
                    delete this.errors[field];
                    return true;
                }
                const pattern = /^[0-9-\s]+$/;
                if (!pattern.test(value)) {
                    this.errors[field] = 'Only numbers, spaces, and hyphens are allowed';
                    return false;
                }
                delete this.errors[field];
                return true;
            },
            validateAddress(field, value) {
                if (!value) {
                    delete this.errors[field];
                    return true;
                }
                const pattern = /^[a-zA-Z0-9\s.-]+$/;
                if (!pattern.test(value)) {
                    this.errors[field] = 'Only letters, numbers, spaces, periods, and hyphens are allowed';
                    return false;
                }
                if (value.length > 100) {
                    this.errors[field] = 'Maximum length is 100 characters';
                    return false;
                }
                delete this.errors[field];
                return true;
            }
        }"
        @student-type-changed.window="resetStudentTypeFields"
    >
        <form action="{{ route('admission.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <!-- Program Information -->
            <div class="mb-8" x-data="{
                isOpen: true,
                gradeLevel: '',
                strand: '',
                showGradeLevel: false,
                showStrand: false,
                showTransfereeFields: false,
                showExistingFields: false,
                showReturningFields: false,
                previousSchool: '',
                transferReason: '',
                gapPeriod: '',
                errors: {},

                // Initialize student type specific fields
                initStudentTypeFields() {
                    this.showTransfereeFields = this.studentType === 'transferee_new';
                    this.showExistingFields = this.studentType === 'existing';
                    this.showReturningFields = this.studentType === 'returning';
                },

                // Reset fields when student type changes
                resetTypeFields() {
                    this.previousSchool = '';
                    this.transferReason = '';
                    this.gapPeriod = '';
                },

                init() {
                    this.$watch('gradeLevel', (value) => {
                        if (this.programType === 'Senior High School' && value) {
                            this.showStrand = true;
                            this.showStudentType = false;
                        } else if (value) {
                            this.showStudentType = true;
                        } else {
                            this.showStrand = false;
                            this.showStudentType = false;
                            this.strand = '';
                        }
                    });

                    this.$watch('strand', (value) => {
                        if (this.programType === 'Senior High School' && value) {
                            this.showStudentType = true;
                        }
                    });

                    this.$watch('programType', () => {
                        this.gradeLevel = '';
                        this.strand = '';
                        this.showStrand = false;
                        this.studentType = '';
                        this.showStudentType = false;
                        this.resetTypeFields();
                    });

                    this.$watch('studentType', () => {
                        this.resetTypeFields();
                        this.initStudentTypeFields();
                    });
                },

                updateGradeLevels() {
                    this.gradeLevel = '';
                    this.strand = '';
                    this.studentType = '';
                    this.showStrand = false;
                    this.showStudentStatus = false;

                    if (this.programType === 'Elementary') {
                        this.gradeLevels = Array.from({length: 6}, (_, i) => i + 1);
                        this.showGradeLevel = true;
                    } else if (this.programType === 'Junior High School') {
                        this.gradeLevels = Array.from({length: 4}, (_, i) => i + 7);
                        this.showGradeLevel = true;
                    } else if (this.programType === 'Senior High School') {
                        this.gradeLevels = Array.from({length: 2}, (_, i) => i + 11);
                        this.showGradeLevel = true;
                    } else {
                        this.showGradeLevel = false;
                        this.gradeLevels = [];
                    }
                },
                dateOfBirth: '',
                age: '',
                computeAge() {
                    if (this.dateOfBirth) {
                        const dob = new Date(this.dateOfBirth);
                        const today = new Date();
                        let calculatedAge = today.getFullYear() - dob.getFullYear();
                        const monthDiff = today.getMonth() - dob.getMonth();

                        if (monthDiff < 0 || (monthDiff === 0 && today.getDate() < dob.getDate())) {
                            calculatedAge--;
                        }

                        this.age = calculatedAge;
                    } else {
                        this.age = '';
                    }
                },
                validateExtensionName(value) {
                    if (/[0-9]/.test(value)) {
                        this.errors.extensionName = 'Invalid Format';
                        return false;
                    }
                    delete this.errors.extensionName;
                    return true;
                },
                validatePhoneNumber(field, value) {
                    if (/[a-zA-Z]/.test(value)) {
                        this.errors[field] = 'Invalid Format';
                        return false;
                    }
                    delete this.errors[field];
                    return true;
                },
                validateLRN(value) {
                    if (/[a-zA-Z]/.test(value)) {
                        this.errors.lrn = 'Invalid Format';
                        return false;
                    }
                    delete this.errors.lrn;
                    return true;
                },
                validateYearGraduation(value) {
                    if (/[a-zA-Z]/.test(value)) {
                        this.errors.yearGraduation = 'Invalid Format';
                        return false;
                    }
                    delete this.errors.yearGraduation;
                    return true;
                },
                validateGWA(value) {
                    if (/[a-zA-Z]/.test(value)) {
                        this.errors.gwa = 'Invalid Format';
                        return false;
                    }
                    delete this.errors.gwa;
                    return true;
                }
            }">
                <div class="flex justify-between items-center cursor-pointer mb-4" @click="isOpen = !isOpen">
                    <h2 class="text-xl font-semibold">Program Information</h2>
                    <svg class="w-6 h-6 transition-transform" :class="{'rotate-180': !isOpen}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                    </svg>
                </div>
                <div x-show="isOpen" x-transition>
                    <!-- Program Type -->
                    <div class="mb-6">
                        <label class="block text-sm font-medium text-gray-700">Program Type <span class="text-red-500">*</span></label>
                        <select
                            name="program_type"
                            x-model="programType"
                            @change="updateGradeLevels()"
                            @blur="validateField('programType')"
                            :class="{'border-red-500': errors.programType}"
                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"
                            required
                        >
                            <option value="">Select Program</option>
                            <option value="Elementary">Elementary</option>
                            <option value="Junior High School">Junior High School</option>
                            <option value="Senior High School">Senior High School</option>
                        </select>
                        <p x-show="errors.programType" x-text="errors.programType" class="mt-1 text-sm text-red-500"></p>
                    </div>

                    <!-- Grade Level -->
                    <div class="mb-6" x-show="showGradeLevel" x-transition>
                        <label class="block text-sm font-medium text-gray-700">Grade Level <span class="text-red-500">*</span></label>
                        <select
                            name="grade_level"
                            x-model="gradeLevel"
                            @blur="validateField('gradeLevel')"
                            :class="{'border-red-500': errors.gradeLevel}"
                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"
                            required
                        >
                            <option value="">Select Grade Level</option>
                            <template x-for="level in gradeLevels" :key="level">
                                <option :value="level" x-text="'Grade ' + level"></option>
                            </template>
                        </select>
                        <p x-show="errors.gradeLevel" x-text="errors.gradeLevel" class="mt-1 text-sm text-red-500"></p>
                    </div>

                    <!-- Strand -->
                    <div class="mb-6" x-show="showStrand" x-transition>
                        <label class="block text-sm font-medium text-gray-700">Strand <span class="text-red-500">*</span></label>
                        <select
                            name="strand"
                            x-model="strand"
                            @blur="validateField('strand')"
                            :class="{'border-red-500': errors.strand}"
                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"
                            :required="showStrand"
                        >
                            <option value="">Select Strand</option>
                            <option value="STEM">STEM (Science, Technology, Engineering, and Mathematics)</option>
                            <option value="ABM">ABM (Accountancy, Business, and Management)</option>
                            <option value="HUMSS">HUMSS (Humanities and Social Sciences)</option>
                            <option value="GAS">GAS (General Academic Strand)</option>
                            <option value="TVL">TVL (Technical-Vocational-Livelihood)</option>
                        </select>
                        <p x-show="errors.strand" x-text="errors.strand" class="mt-1 text-sm text-red-500"></p>
                    </div>

                    <!-- Student Type -->
                    <div class="mb-6" x-show="showStudentType" x-transition>
                        <label class="block text-sm font-medium text-gray-700 mb-3">
                            Student Type <span class="text-red-500">*</span>
                        </label>

                        <!-- Main Student Type Selection -->
                        <div class="space-y-2">
                            <div class="flex items-center p-2 rounded hover:bg-gray-50">
                                <input type="radio"
                                    name="student_type"
                                    value="transferee_new"
                                    x-model="studentType"
                                    class="h-4 w-4 border-gray-300 text-blue-600 focus:ring-blue-500">
                                <label class="ml-3 block text-sm font-medium text-gray-700">Transferee / New Student</label>
                            </div>
                            <div class="flex items-center p-2 rounded hover:bg-gray-50">
                                <input type="radio"
                                    name="student_type"
                                    value="existing"
                                    x-model="studentType"
                                    class="h-4 w-4 border-gray-300 text-blue-600 focus:ring-blue-500">
                                <label class="ml-3 block text-sm font-medium text-gray-700">Existing / Returning Student</label>
                            </div>
                        </div>

                        <!-- Transferee/New Student Fields -->
                        <div x-show="studentType === 'transferee_new'"
                             x-transition
                             class="mt-4 space-y-4">
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                <div>
                                    <label class="block text-sm font-medium text-gray-700">Previous School <span class="text-red-500">*</span></label>
                                    <input type="text"
                                        name="previous_school"
                                        x-model="previousSchool"
                                        @input="validateSchoolName($event.target.value)"
                                        :class="{'border-red-500': errors.previousSchool}"
                                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"
                                        required>
                                    <p x-show="errors.previousSchool" x-text="errors.previousSchool" class="mt-1 text-sm text-red-500"></p>
                                </div>

                                <div>
                                    <label class="block text-sm font-medium text-gray-700">Transfer Reason <span class="text-red-500">*</span></label>
                                    <textarea name="transfer_reason"
                                        x-model="transferReason"
                                        rows="3"
                                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"
                                        required></textarea>
                                </div>
                            </div>
                        </div>

                        <!-- Existing/Returning Student Fields -->
                        <div x-show="studentType === 'existing'"
                             x-transition
                             class="mt-4">
                            <div class="mb-4">
                                <label class="inline-flex items-center">
                                    <input type="checkbox"
                                           x-model="isReturningStudent"
                                           name="is_returning"
                                           class="rounded border-gray-300 text-blue-600 focus:ring-blue-500">
                                    <span class="ml-2 text-sm text-gray-700">Returning Student</span>
                                </label>
                            </div>

                            <!-- Student Lookup for Both Existing and Returning -->
                            <div class="bg-gray-50 p-4 rounded-lg">
                                <h3 class="text-lg font-medium mb-4">Student Lookup</h3>
                                <div class="flex space-x-4">
                                    <div class="flex-1">
                                        <label class="block text-sm font-medium text-gray-700">Student ID</label>
                                        <input type="text"
                                            x-model="studentId"
                                            placeholder="Enter Student ID"
                                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                                    </div>
                                    <div class="flex items-end space-x-2">
                                        <button type="button"
                                            @click="searchStudent"
                                            :disabled="isSearching || !studentId"
                                            class="px-4 py-2 bg-blue-500 text-white rounded hover:bg-blue-600 disabled:opacity-50">
                                            <span x-show="!isSearching">Search</span>
                                            <span x-show="isSearching">
                                                <svg class="animate-spin h-5 w-5" viewBox="0 0 24 24">
                                                    <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                                    <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                                                </svg>
                                            </span>
                                        </button>
                                        <button type="button"
                                            x-show="studentData"
                                            @click="resetStudentTypeFields"
                                            class="px-4 py-2 bg-gray-500 text-white rounded hover:bg-gray-600">
                                            Reset
                                        </button>
                                    </div>
                                </div>

                                <div x-show="searchError" class="mt-2 text-sm text-red-600" x-text="searchError"></div>
                                <div x-show="studentData" class="mt-2 text-sm text-green-600">Student information found and auto-filled.</div>
                            </div>

                            <!-- Additional Fields for Returning Students -->
                            <div x-show="isReturningStudent" x-transition>
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                    <div>
                                        <label class="block text-sm font-medium text-gray-700">Previous Enrollment Period <span class="text-red-500">*</span></label>
                                        <input type="text"
                                            name="previous_enrollment"
                                            x-model="previousEnrollment"
                                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"
                                            required>
                                    </div>

                                    <div>
                                        <label class="block text-sm font-medium text-gray-700">Gap Period (in years) <span class="text-red-500">*</span></label>
                                        <input type="number"
                                            name="gap_period"
                                            x-model="gapPeriod"
                                            min="0"
                                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"
                                            required>
                                    </div>

                                    <div class="md:col-span-2">
                                        <label class="block text-sm font-medium text-gray-700">Reason for Return <span class="text-red-500">*</span></label>
                                        <textarea name="return_reason"
                                            x-model="returnReason"
                                            rows="3"
                                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"
                                            required></textarea>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Personal Information -->
            <div class="mb-8" x-data="{ isOpen: true, dateOfBirth: '', age: '', surname: '', givenName: '', middleName: '', placeOfBirth: '', nationality: '', religion: '', contactNo: '', extensionName: '', errors: {}, validateTextInput(field, value) {
                if (/\d/.test(value)) {
                    this.errors[field] = 'Invalid Format';
                    return false;
                }
                delete this.errors[field];
                return true;
            }, computeAge() {
                if (this.dateOfBirth) {
                    const dob = new Date(this.dateOfBirth);
                    const today = new Date();
                    let calculatedAge = today.getFullYear() - dob.getFullYear();
                    const monthDiff = today.getMonth() - dob.getMonth();

                    if (monthDiff < 0 || (monthDiff === 0 && today.getDate() < dob.getDate())) {
                        calculatedAge--;
                    }

                    this.age = calculatedAge;
                } else {
                    this.age = '';
                }
            }, validateExtensionName(value) {
                if (/\d/.test(value)) {
                    this.errors.extensionName = 'Invalid Format';
                    return false;
                }
                delete this.errors.extensionName;
                return true;
            }, validateContactNumber(value) {
                if (/[a-zA-Z]/.test(value)) {
                    this.errors.contactNo = 'Invalid Format';
                    return false;
                }
                delete this.errors.contactNo;
                return true;
            } }">
                <div class="flex justify-between items-center cursor-pointer mb-4" @click="isOpen = !isOpen">
                    <h2 class="text-xl font-semibold">Personal Information</h2>
                    <svg class="w-6 h-6 transition-transform" :class="{'rotate-180': !isOpen}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                    </svg>
                </div>
                <div x-show="isOpen" x-transition>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-6">
                        <!-- Given Name -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700">
                                Given Name <span class="text-red-500">*</span>
                            </label>
                            <input type="text"
                                name="applicant_given_name"
                                x-model="givenName"
                                @input="validateName('givenName', $event.target.value)"
                                :disabled="studentData !== null"
                                :class="{
                                    'bg-gray-100': studentData !== null,
                                    'border-red-500': errors.givenName
                                }"
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"
                                required>
                            <p x-show="errors.givenName" x-text="errors.givenName" class="mt-1 text-sm text-red-500"></p>
                        </div>

                        <!-- Surname -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700">
                                Surname <span class="text-red-500">*</span>
                            </label>
                            <input type="text"
                                name="applicant_surname"
                                x-model="surname"
                                @input="validateName('surname', $event.target.value)"
                                :disabled="studentData !== null"
                                :class="{
                                    'bg-gray-100': studentData !== null,
                                    'border-red-500': errors.surname
                                }"
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"
                                required>
                            <p x-show="errors.surname" x-text="errors.surname" class="mt-1 text-sm text-red-500"></p>
                        </div>

                        <!-- Middle Name -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Middle Name</label>
                            <input type="text"
                                x-ref="middleName"
                                name="applicant_middle_name"
                                x-model="middleName"
                                @input="validateName('middleName', $event.target.value)"
                                :disabled="studentData !== null"
                                :class="{
                                    'bg-gray-100': studentData !== null,
                                    'border-red-500': errors.middleName
                                }"
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                            <p x-show="errors.middleName" x-text="errors.middleName" class="mt-1 text-sm text-red-500"></p>
                        </div>

                        <!-- Extension Name -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700">
                                Extension Name <span class="text-red-500">*</span>
                            </label>
                            <input type="text"
                                name="applicant_extension"
                                x-model="extensionName"
                                @input="validateName('extensionName', $event.target.value)"
                                :class="{'border-red-500': errors.extensionName}"
                                placeholder="Jr., II, III, etc."
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                            <p x-show="errors.extensionName" x-text="errors.extensionName" class="mt-1 text-sm text-red-500"></p>
                        </div>

                        <!-- Sex -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700">
                                Sex <span class="text-red-500">*</span>
                            </label>
                            <select name="gender" required class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                                <option value="">Select Sex</option>
                                <option value="Male">Male</option>
                                <option value="Female">Female</option>
                            </select>
                        </div>

                        <!-- Date of Birth -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700">
                                Date of Birth <span class="text-red-500">*</span>
                            </label>
                            <input
                                type="date"
                                name="applicant_date_birth"
                                x-model="dateOfBirth"
                                @input="computeAge()"
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"
                                required
                            >
                        </div>

                        <!-- Age -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Age</label>
                            <input
                                type="number"
                                name="age"
                                x-model="age"
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 bg-gray-50"
                                readonly
                            >
                        </div>

                        <!-- Contact Number -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700">
                                Contact Number <span class="text-red-500">*</span>
                            </label>
                            <input type="tel"
                                name="applicant_mobile_number"
                                x-model="contactNo"
                                @input="validateContact('contactNo', $event.target.value)"
                                @focus="$el.placeholder = ''"
                                @blur="$el.placeholder = '08xx-xxxx / 09xx-xxx-xxxx'"
                                placeholder="08xx-xxxx / 09xx-xxx-xxxx"
                                :class="{'border-red-500': errors.contactNo}"
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"
                                required>
                            <p x-show="errors.contactNo" x-text="errors.contactNo" class="mt-1 text-sm text-red-500"></p>
                        </div>

                        <!-- Nationality -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700">
                                Nationality <span class="text-red-500">*</span>
                            </label>
                            <input type="text"
                                name="applicant_nationality"
                                x-model="nationality"
                                @input="validateName('nationality', $event.target.value)"
                                :class="{'border-red-500': errors.nationality}"
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                            <p x-show="errors.nationality" x-text="errors.nationality" class="mt-1 text-sm text-red-500"></p>
                        </div>

                        <!-- Religion -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700">
                                Religion <span class="text-red-500">*</span>
                            </label>
                            <input type="text"
                                name="applicant_religion"
                                x-model="religion"
                                @input="validateName('religion', $event.target.value)"
                                :class="{'border-red-500': errors.religion}"
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                            <p x-show="errors.religion" x-text="errors.religion" class="mt-1 text-sm text-red-500"></p>
                        </div>
                    </div>

                    <!-- Address Information - Keep all existing functionality -->
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mt-6"
                        x-data="{
                            province: 'Metro Manila',
                            city: '',
                            barangay: '',
                            street: '',
                            houseNumber: '',
                            showBarangay: false,
                            showStreet: false,
                            errors: {},
                            validateAddress(field, value) {
                                if (!value) {
                                    delete this.errors[field];
                                    return true;
                                }
                                const pattern = /^[a-zA-Z0-9\s.-]+$/;
                                if (!pattern.test(value)) {
                                    this.errors[field] = 'Only letters, numbers, spaces, periods, and hyphens allowed';
                                    return false;
                                }
                                if (value.length > 100) {
                                    this.errors[field] = 'Maximum length is 100 characters';
                                    return false;
                                }
                                delete this.errors[field];
                                return true;
                            }
                        }"
                        x-init="$watch('city', value => {
                            showBarangay = value !== '';
                            barangay = '';
                            street = '';
                            houseNumber = '';
                        });
                        $watch('barangay', value => {
                            showStreet = value !== '';
                            street = '';
                            houseNumber = '';
                        })">

                        <!-- Province/Region -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700">
                                Province/Region <span class="text-red-500">*</span>
                            </label>
                            <input type="text"
                                name="applicant_address_province"
                                x-model="province"
                                class="mt-1 block w-full rounded-md border-gray-300 bg-gray-100 cursor-not-allowed"
                                readonly>
                        </div>

                        <!-- City -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700">
                                City <span class="text-red-500">*</span>
                            </label>
                            <select name="applicant_address_city"
                                x-model="city"
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"
                                required>
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
                                <option value="Pateros">Pateros</option>
                                <option value="Quezon City">Quezon City</option>
                                <option value="San Juan">San Juan</option>
                                <option value="Taguig">Taguig</option>
                                <option value="Valenzuela">Valenzuela</option>
                            </select>
                        </div>

                        <!-- Barangay Input -->
                        <div class="relative" x-show="showBarangay" x-transition>
                            <label class="block text-sm font-medium text-gray-700">
                                Barangay <span class="text-red-500">*</span>
                            </label>
                            <input type="text"
                                name="applicant_address_barangay"
                                x-model="barangay"
                                @input="validateAddress('barangay', $event.target.value)"
                                :class="{'border-red-500': errors.barangay}"
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"
                                placeholder="Enter barangay name"
                                required>
                            <p x-show="errors.barangay" x-text="errors.barangay" class="mt-1 text-sm text-red-500"></p>
                        </div>

                        <!-- House Number and Street Input -->
                        <div class="relative md:col-span-2" x-show="showStreet" x-transition>
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                <div>
                                    <label class="block text-sm font-medium text-gray-700">
                                        House/Unit Number <span class="text-red-500">*</span>
                                    </label>
                                    <input type="text"
                                        name="applicant_house_number"
                                        x-model="houseNumber"
                                        @input="validateAddress('houseNumber', $event.target.value)"
                                        :class="{'border-red-500': errors.houseNumber}"
                                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"
                                        placeholder="Enter house/unit number"
                                        required>
                                    <p x-show="errors.houseNumber" x-text="errors.houseNumber" class="mt-1 text-sm text-red-500"></p>
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-gray-700">
                                        Street Name <span class="text-red-500">*</span>
                                    </label>
                                    <input type="text"
                                        name="applicant_address_street"
                                        x-model="street"
                                        @input="validateAddress('street', $event.target.value)"
                                        :class="{'border-red-500': errors.street}"
                                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"
                                        placeholder="Enter street name"
                                        required>
                                    <p x-show="errors.street" x-text="errors.street" class="mt-1 text-sm text-red-500"></p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Family Information -->
            <div class="mb-8" x-data="{
                isOpen: true,
                fatherName: '',
                fatherContact: '',
                motherName: '',
                motherContact: '',
                guardianName: '',
                guardianContact: '',
                errors: {},
                validateName(field, value) {
                    if (!value) {
                        delete this.errors[field];
                        return true;
                    }
                    const pattern = /^[a-zA-Z\s-]+$/;
                    if (!pattern.test(value)) {
                        this.errors[field] = 'Only letters, spaces, and hyphens are allowed';
                        return false;
                    }
                    delete this.errors[field];
                    return true;
                },
                validateContact(field, value) {
                    if (!value) {
                        delete this.errors[field];
                        return true;
                    }
                    const pattern = /^[0-9\s-]+$/;
                    if (!pattern.test(value)) {
                        this.errors[field] = 'Only numbers, spaces, and hyphens are allowed';
                        return false;
                    }
                    delete this.errors[field];
                    return true;
                }
            }">
                <div class="flex justify-between items-center cursor-pointer mb-4" @click="isOpen = !isOpen">
                    <h2 class="text-xl font-semibold">Family Information</h2>
                    <svg class="w-6 h-6 transition-transform" :class="{'rotate-180': !isOpen}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                    </svg>
                </div>
                <div x-show="isOpen" x-transition>
                    <p class="text-sm text-gray-600 mb-4">Please provide information for at least one guardian (Father, Mother, or Guardian)</p>

                    <!-- Father's Information -->
                    <div class="mb-6">
                        <h3 class="text-lg font-medium mb-4">Father</h3>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <label class="block text-sm font-medium text-gray-700">Name</label>
                                <input type="text"
                                    name="father_name"
                                    x-model="fatherName"
                                    @input="validateName('fatherName', $event.target.value)"
                                    :class="{'border-red-500': errors.fatherName}"
                                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                                <p x-show="errors.fatherName" x-text="errors.fatherName" class="mt-1 text-sm text-red-500"></p>
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700">Contact Number</label>
                                <input type="text"
                                    name="father_contact"
                                    x-model="fatherContact"
                                    @input="validateContact('fatherContact', $event.target.value)"
                                    @focus="$el.placeholder = ''"
                                    @blur="$el.placeholder = '08xx-xxxx / 09xx-xxx-xxxx'"
                                    placeholder="08xx-xxxx / 09xx-xxx-xxxx"
                                    :class="{'border-red-500': errors.fatherContact}"
                                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                                <p x-show="errors.fatherContact" x-text="errors.fatherContact" class="mt-1 text-sm text-red-500"></p>
                            </div>
                        </div>
                    </div>

                    <!-- Mother's Information -->
                    <div class="mb-6">
                        <h3 class="text-lg font-medium mb-4">Mother</h3>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <label class="block text-sm font-medium text-gray-700">Name</label>
                                <input type="text"
                                    name="mother_name"
                                    x-model="motherName"
                                    @input="validateName('motherName', $event.target.value)"
                                    :class="{'border-red-500': errors.motherName}"
                                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                                <p x-show="errors.motherName" x-text="errors.motherName" class="mt-1 text-sm text-red-500"></p>
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700">Contact Number</label>
                                <input type="text"
                                    name="mother_contact"
                                    x-model="motherContact"
                                    @input="validateContact('motherContact', $event.target.value)"
                                    @focus="$el.placeholder = ''"
                                    @blur="$el.placeholder = '08xx-xxxx / 09xx-xxx-xxxx'"
                                    placeholder="08xx-xxxx / 09xx-xxx-xxxx"
                                    :class="{'border-red-500': errors.motherContact}"
                                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                                <p x-show="errors.motherContact" x-text="errors.motherContact" class="mt-1 text-sm text-red-500"></p>
                            </div>
                        </div>
                    </div>

                    <!-- Legal Guardian's Information -->
                    <div class="mb-6">
                        <h3 class="text-lg font-medium mb-4">Legal Guardian</h3>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <label class="block text-sm font-medium text-gray-700">Name</label>
                                <input type="text"
                                    name="guardian_name"
                                    x-model="guardianName"
                                    @input="validateName('guardianName', $event.target.value)"
                                    :class="{'border-red-500': errors.guardianName}"
                                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                                <p x-show="errors.guardianName" x-text="errors.guardianName" class="mt-1 text-sm text-red-500"></p>
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700">Contact Number</label>
                                <input type="text"
                                    name="guardian_contact"
                                    x-model="guardianContact"
                                    @input="validateContact('guardianContact', $event.target.value)"
                                    @focus="$el.placeholder = ''"
                                    @blur="$el.placeholder = '08xx-xxxx / 09xx-xxx-xxxx'"
                                    placeholder="08xx-xxxx / 09xx-xxx-xxxx"
                                    :class="{'border-red-500': errors.guardianContact}"
                                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                                <p x-show="errors.guardianContact" x-text="errors.guardianContact" class="mt-1 text-sm text-red-500"></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Emergency Contact -->
            <div class="mb-8" x-data="{
                isOpen: true,
                emergencyName: '',
                emergencyContact: '',
                emergencyEmail: '',
                emergencyAddress: '',
                errors: {},
                validateName(field, value) {
                    if (!value) {
                        delete this.errors[field];
                        return true;
                    }
                    const pattern = /^[a-zA-Z\s-]+$/;
                    if (!pattern.test(value)) {
                        this.errors[field] = 'Only letters, spaces, and hyphens are allowed';
                        return false;
                    }
                    delete this.errors[field];
                    return true;
                },
                validateContact(field, value) {
                    if (!value) {
                        delete this.errors[field];
                        return true;
                    }
                    const pattern = /^[0-9\s-]+$/;
                    if (!pattern.test(value)) {
                        this.errors[field] = 'Only numbers, spaces, and hyphens are allowed';
                        return false;
                    }
                    delete this.errors[field];
                    return true;
                },
                validateAddress(value) {
                    if (!value) {
                        delete this.errors.address;
                        return true;
                    }
                    const pattern = /^[a-zA-Z0-9\s,.-]+$/;
                    if (!pattern.test(value)) {
                        this.errors.address = 'Only letters, numbers, spaces, commas, periods, and hyphens are allowed';
                        return false;
                    }
                    if (value.length > 200) {
                        this.errors.address = 'Maximum length is 200 characters';
                        return false;
                    }
                    delete this.errors.address;
                    return true;
                },
                validateEmail(value) {
                    if (!value) {
                        delete this.errors.email;
                        return true;
                    }
                    if (value.length > 100) {
                        this.errors.email = 'Maximum length is 100 characters';
                        return false;
                    }
                    delete this.errors.email;
                    return true;
                }
            }">
                <div class="flex justify-between items-center cursor-pointer mb-4" @click="isOpen = !isOpen">
                    <h2 class="text-xl font-semibold">Emergency Contact</h2>
                    <svg class="w-6 h-6 transition-transform" :class="{'rotate-180': !isOpen}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                    </svg>
                </div>
                <div x-show="isOpen" x-transition>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div class="md:col-span-2">
                            <label class="block text-sm font-medium text-gray-700">
                                Complete Name <span class="text-red-500">*</span>
                            </label>
                            <input type="text"
                                name="emergency_contact_name"
                                x-model="emergencyName"
                                @input="validateName('emergencyName', $event.target.value)"
                                :class="{'border-red-500': errors.emergencyName}"
                                required
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                            <p x-show="errors.emergencyName" x-text="errors.emergencyName" class="mt-1 text-sm text-red-500"></p>
                        </div>

                        <div class="md:col-span-2">
                            <label class="block text-sm font-medium text-gray-700">
                                Complete Address <span class="text-red-500">*</span>
                            </label>
                            <input type="text"
                                name="emergency_contact_address"
                                x-model="emergencyAddress"
                                @input="validateAddress($event.target.value)"
                                :class="{'border-red-500': errors.address}"
                                required
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                            <p x-show="errors.address" x-text="errors.address" class="mt-1 text-sm text-red-500"></p>
                        </div>

                        <div class="md:col-span-2">
                            <label class="block text-sm font-medium text-gray-700">
                                Contact Number <span class="text-red-500">*</span>
                            </label>
                            <input type="text"
                                name="emergency_contact_number"
                                x-model="emergencyContact"
                                @input="validateContact('emergencyContact', $event.target.value)"
                                @focus="$el.placeholder = ''"
                                @blur="$el.placeholder = '08xx-xxxx / 09xx-xxx-xxxx'"
                                placeholder="08xx-xxxx / 09xx-xxx-xxxx"
                                :class="{'border-red-500': errors.emergencyContact}"
                                required
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                            <p x-show="errors.emergencyContact" x-text="errors.emergencyContact" class="mt-1 text-sm text-red-500"></p>
                        </div>

                        <div class="md:col-span-2">
                            <label class="block text-sm font-medium text-gray-700">Email</label>
                            <input type="email"
                                name="emergency_contact_email"
                                x-model="emergencyEmail"
                                @input="validateEmail($event.target.value)"
                                :class="{'border-red-500': errors.email}"
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                            <p x-show="errors.email" x-text="errors.email" class="mt-1 text-sm text-red-500"></p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Required Documents Section -->
            <div class="mb-8">
                <div class="flex justify-between items-center cursor-pointer mb-4" @click="isDocumentsOpen = !isDocumentsOpen">
                    <h2 class="text-xl font-semibold">Required Documents</h2>
                    <svg class="w-6 h-6 transition-transform" :class="{'rotate-180': !isDocumentsOpen}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                    </svg>
                </div>

                <div x-show="isDocumentsOpen" x-transition>
                    <div x-show="studentType" x-transition>
                        <p class="text-sm text-gray-500 mb-4">Please upload the following documents. All files must be in PDF, JPG, or PNG format and must not exceed 10MB.</p>

                        <!-- Transferee Documents -->
                        <div x-show="studentType === 'transferee_new'" class="space-y-4">
                            <div class="mb-6">
                                <label class="block text-sm font-medium text-gray-700 mb-1">
                                    PSA Birth Certificate <span class="text-red-500">*</span>
                                </label>
                                <input type="file"
                                    name="birth_certificate"
                                    accept=".pdf,.jpg,.jpeg,.png"
                                    x-on:change="
                                        if ($event.target.files[0]?.size > 10 * 1024 * 1024) {
                                            $event.target.value = '';
                                            alert('File size must not exceed 10MB');
                                        }
                                    "
                                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                                <p class="mt-1 text-sm text-gray-500">Upload PDF/JPG/PNG files only (max: 10MB)</p>
                            </div>

                            <div class="mb-6">
                                <label class="block text-sm font-medium text-gray-700 mb-1">
                                    Form 138 (Report Card) <span class="text-red-500">*</span>
                                </label>
                                <input type="file"
                                    name="form_138"
                                    accept=".pdf,.jpg,.jpeg,.png"
                                    x-on:change="
                                        if ($event.target.files[0]?.size > 10 * 1024 * 1024) {
                                            $event.target.value = '';
                                            alert('File size must not exceed 10MB');
                                        }
                                    "
                                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                                <p class="mt-1 text-sm text-gray-500">Upload PDF/JPG/PNG files only (max: 10MB)</p>
                            </div>

                            <div class="mb-6">
                                <label class="block text-sm font-medium text-gray-700 mb-1">
                                    Good Moral Certificate <span class="text-red-500">*</span>
                                </label>
                                <input type="file"
                                    name="good_moral"
                                    accept=".pdf,.jpg,.jpeg,.png"
                                    x-on:change="
                                        if ($event.target.files[0]?.size > 10 * 1024 * 1024) {
                                            $event.target.value = '';
                                            alert('File size must not exceed 10MB');
                                        }
                                    "
                                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                                <p class="mt-1 text-sm text-gray-500">Upload PDF/JPG/PNG files only (max: 10MB)</p>
                            </div>

                            <div class="mb-6">
                                <label class="block text-sm font-medium text-gray-700 mb-1">
                                    Parent's/Guardian's Valid ID <span class="text-red-500">*</span>
                                </label>
                                <input type="file"
                                    name="parent_id"
                                    accept=".pdf,.jpg,.jpeg,.png"
                                    x-on:change="
                                        if ($event.target.files[0]?.size > 10 * 1024 * 1024) {
                                            $event.target.value = '';
                                            alert('File size must not exceed 10MB');
                                        }
                                    "
                                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                                <p class="mt-1 text-sm text-gray-500">Upload PDF/JPG/PNG files only (max: 10MB)</p>
                            </div>

                            <div class="mb-6">
                                <label class="block text-sm font-medium text-gray-700 mb-1">
                                    2x2 Photo <span class="text-red-500">*</span>
                                </label>
                                <input type="file"
                                    name="photo_2x2"
                                    accept=".jpg,.jpeg,.png"
                                    x-on:change="
                                        if ($event.target.files[0]?.size > 10 * 1024 * 1024) {
                                            $event.target.value = '';
                                            alert('File size must not exceed 10MB');
                                        }
                                    "
                                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                                <p class="mt-1 text-sm text-gray-500">Upload JPG/PNG files only (max: 10MB)</p>
                            </div>
                        </div>

                        <!-- Existing Student Documents -->
                        <div x-show="studentType === 'existing'" class="space-y-4">
                            <div class="mb-6">
                                <label class="block text-sm font-medium text-gray-700 mb-1">
                                    Updated Parent's/Guardian's Valid ID <span class="text-red-500">*</span>
                                </label>
                                <input type="file"
                                    name="updated_parent_id"
                                    accept=".pdf,.jpg,.jpeg,.png"
                                    x-on:change="
                                        if ($event.target.files[0]?.size > 10 * 1024 * 1024) {
                                            $event.target.value = '';
                                            alert('File size must not exceed 10MB');
                                        }
                                    "
                                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                                <p class="mt-1 text-sm text-gray-500">Upload PDF/JPG/PNG files only (max: 10MB)</p>
                            </div>

                            <div class="mb-6">
                                <label class="block text-sm font-medium text-gray-700 mb-1">
                                    Updated Medical Records
                                </label>
                                <input type="file"
                                    name="medical_records"
                                    accept=".pdf,.jpg,.jpeg,.png"
                                    x-on:change="
                                        if ($event.target.files[0]?.size > 10 * 1024 * 1024) {
                                            $event.target.value = '';
                                            alert('File size must not exceed 10MB');
                                        }
                                    "
                                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                                <p class="mt-1 text-sm text-gray-500">Upload PDF/JPG/PNG files only (max: 10MB)</p>
                            </div>
                        </div>

                        <!-- Returning Student Documents -->
                        <div x-show="studentType === 'returning'" class="space-y-4">
                            <div class="mb-6">
                                <label class="block text-sm font-medium text-gray-700 mb-1">
                                    PSA Birth Certificate <span class="text-red-500">*</span>
                                </label>
                                <input type="file"
                                    name="returning_birth_certificate"
                                    accept=".pdf,.jpg,.jpeg,.png"
                                    x-on:change="
                                        if ($event.target.files[0]?.size > 10 * 1024 * 1024) {
                                            $event.target.value = '';
                                            alert('File size must not exceed 10MB');
                                        }
                                    "
                                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                                <p class="mt-1 text-sm text-gray-500">Upload PDF/JPG/PNG files only (max: 10MB)</p>
                            </div>

                            <div class="mb-6">
                                <label class="block text-sm font-medium text-gray-700 mb-1">
                                    Latest Form 138 <span class="text-red-500">*</span>
                                </label>
                                <input type="file"
                                    name="returning_form_138"
                                    accept=".pdf,.jpg,.jpeg,.png"
                                    x-on:change="
                                        if ($event.target.files[0]?.size > 10 * 1024 * 1024) {
                                            $event.target.value = '';
                                            alert('File size must not exceed 10MB');
                                        }
                                    "
                                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                                <p class="mt-1 text-sm text-gray-500">Upload PDF/JPG/PNG files only (max: 10MB)</p>
                            </div>

                            <div class="mb-6">
                                <label class="block text-sm font-medium text-gray-700 mb-1">
                                    Good Moral Certificate <span class="text-red-500">*</span>
                                </label>
                                <input type="file"
                                    name="returning_good_moral"
                                    accept=".pdf,.jpg,.jpeg,.png"
                                    x-on:change="
                                        if ($event.target.files[0]?.size > 10 * 1024 * 1024) {
                                            $event.target.value = '';
                                            alert('File size must not exceed 10MB');
                                        }
                                    "
                                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                                <p class="mt-1 text-sm text-gray-500">Upload PDF/JPG/PNG files only (max: 10MB)</p>
                            </div>

                            <div class="mb-6">
                                <label class="block text-sm font-medium text-gray-700 mb-1">
                                    2x2 Photo <span class="text-red-500">*</span>
                                </label>
                                <input type="file"
                                    name="returning_photo_2x2"
                                    accept=".jpg,.jpeg,.png"
                                    x-on:change="
                                        if ($event.target.files[0]?.size > 10 * 1024 * 1024) {
                                            $event.target.value = '';
                                            alert('File size must not exceed 10MB');
                                        }
                                    "
                                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                                <p class="mt-1 text-sm text-gray-500">Upload JPG/PNG files only (max: 10MB)</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Submit button -->
            <div class="flex justify-end">
                <button type="submit" class="px-4 py-2 bg-blue-500 text-white rounded hover:bg-blue-600">
                    Submit Application
                </button>
            </div>
        </form>
    </div>
</div>

@push('scripts')
<script>
    // Show/hide strand selection based on program selection
    document.querySelector('select[name="apply_program"]').addEventListener('change', function() {
        const strandContainer = document.getElementById('strandContainer');
        if (this.value === 'Senior High School') {
            strandContainer.style.display = 'block';
        } else {
            strandContainer.style.display = 'none';
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

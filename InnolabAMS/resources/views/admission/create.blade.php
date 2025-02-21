@extends('application')
@section('title', 'Add Applicant | InnolabAMS')

@section('content')
<div class="container mx-auto px-6 py-4">
    <!-- Existing back button and title -->
    <div class="flex justify-between items-center mb-4">
        <h1 class="text-2xl font-semibold">Add Applicant</h1>
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
            },
            // Updated mobile number masking
            maskMobile(value) {
                if (!value) return '';
                // Remove all non-digits
                value = value.replace(/\D/g, '');

                // Ensure it starts with 09
                if (value.length >= 2) {
                    if (value.substring(0, 2) !== '09') {
                        value = '09' + value.substring(Math.max(0, value.length - 9));
                    }
                }

                // Format as 09XX-XXX-XXXX
                if (value.length > 11) {
                    value = value.substring(0, 11);
                }

                if (value.length >= 4) {
                    value = value.substring(0, 4) + '-' + value.substring(4);
                }
                if (value.length >= 8) {
                    value = value.substring(0, 8) + '-' + value.substring(8);
                }

                return value;
            },
            // Updated telephone number masking
            maskTelephone(value) {
                if (!value) return '';

                // Remove all non-digits
                value = value.replace(/\D/g, '');

                // Format as (02) XXXX-XXXX
                if (value.length > 10) {
                    value = value.substring(0, 10);
                }

                let formattedValue = '';
                if (value.length > 0) {
                    // Always start with (02)
                    formattedValue = '(02) ';

                    if (value.length > 2) {
                        // Add the next 4 digits after (02)
                        formattedValue += value.substring(2, 6);

                        if (value.length > 6) {
                            // Add hyphen and the last 4 digits
                            formattedValue += '-' + value.substring(6, 10);
                        }
                    }
                }

                return formattedValue;
            },
            // Updated phone format validation
            validatePhoneFormat(type, value) {
                if (!value) return true;

                if (type === 'mobile') {
                    // Keep existing mobile validation
                    const mobilePattern = /^09\d{2}-\d{3}-\d{4}$/;
                    const isValid = mobilePattern.test(value);
                    if (!isValid) {
                        this.errors[type === 'mobile' ? 'contactNo' : 'contactTel'] = 'Please enter a valid mobile number (09XX-XXX-XXXX)';
                        return false;
                    }
                    return true;
                } else {
                    // Updated telephone validation to allow 4 digits before hyphen
                    const telephonePattern = /^\(02\) \d{4}-\d{4}$/;
                    const isValid = telephonePattern.test(value);
                    if (!isValid) {
                        const fieldName = value.includes('contactTel') ? 'contactTel' :
                                        value.includes('fatherTel') ? 'fatherTel' :
                                        value.includes('motherTel') ? 'motherTel' :
                                        value.includes('guardianTel') ? 'guardianTel' : 'emergencyTel';
                        this.errors[fieldName] = 'Please enter a valid telephone number ((02) XXXX-XXXX)';
                        return false;
                    }
                    return true;
                }
            },
            contactTel: '',
            fatherTel: '',
            motherTel: '',
            guardianTel: '',
        }"
        @student-type-changed.window="resetStudentTypeFields"
    >
        <form @submit.prevent="handleSubmit" action="{{ route('admission.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <!-- Program Information -->
<<<<<<< HEAD
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
                    if (!value) {
                        delete this.errors.extensionName;
                        return true;
                    }
                    // Only allow letters, dots, and spaces
                    const pattern = /^[a-zA-Z\s.]+$/;
                    if (!pattern.test(value)) {
                        this.errors.extensionName = 'Only letters, spaces, and dots are allowed';
                        return false;
                    }
                    delete this.errors.extensionName;
                    return true;
                },
                validateReligion(value) {
                    if (!value) {
                        delete this.errors.religion;
                        return true;
                    }
                    // Only allow letters and spaces
                    const pattern = /^[a-zA-Z\s]+$/;
                    if (!pattern.test(value)) {
                        this.errors.religion = 'Only letters and spaces are allowed';
                        return false;
                    }
                    delete this.errors.religion;
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
=======
            <div class="mb-8">
                <h2 class="text-xl font-semibold mb-4 pb-2 border-b">Program Information</h2>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Program <span class="text-red-500">*</span></label>
                        <select name="apply_program" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" required>
>>>>>>> 8b624a3 (<<test3>>)
                            <option value="">Select Program</option>
                            <option value="Elementary">Elementary</option>
                            <option value="Junior High School">Junior High School</option>
                            <option value="Senior High School">Senior High School</option>
                        </select>
                        <p x-show="errors.programType" x-text="errors.programType" class="mt-1 text-sm text-red-500"></p>
                    </div>
<<<<<<< HEAD

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
=======
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Grade Level <span class="text-red-500">*</span></label>
                        <select name="apply_grade_level" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" required>
>>>>>>> 6016cb7 (Feat: Add required field indicators and improve form validation for admission application)
                            <option value="">Select Grade Level</option>
<<<<<<< HEAD
                            <template x-for="level in gradeLevels" :key="level">
                                <option :value="level" x-text="'Grade ' + level"></option>
                            </template>
=======
>>>>>>> 7fcafea (Enhance grade level selection for admission form)
                        </select>
                        <p x-show="errors.gradeLevel" x-text="errors.gradeLevel" class="mt-1 text-sm text-red-500"></p>
                    </div>
<<<<<<< HEAD

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
=======
                    <div id="strandContainer" style="display: none;">
                        <label class="block text-sm font-medium text-gray-700">Strand <span class="text-red-500">*</span></label>
                        <select name="apply_strand" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
>>>>>>> 6016cb7 (Feat: Add required field indicators and improve form validation for admission application)
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
                                <div class="mt-2 space-y-2">
                                    <div class="flex items-center">
                                        <input type="checkbox" name="is_returning" x-model="isReturningStudent">
                                        <span class="ml-3 font-medium">Returning Student</span>
                                    </div>
                                </div>
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
<<<<<<< HEAD
                        <label class="block text-sm font-medium text-gray-700">Age</label>
                        <input type="number" name="age" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Date of Birth</label>
                        <input type="date" name="applicant_date_birth" required class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
=======
                        <label class="block text-sm font-medium text-gray-700">Age <span class="text-red-500">*</span></label>
                        <input type="number" name="age" id="age" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" readonly>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Date of Birth <span class="text-red-500">*</span></label>
                        <input type="date" name="applicant_date_birth" id="applicant_date_birth" required class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
>>>>>>> 6016cb7 (Feat: Add required field indicators and improve form validation for admission application)
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
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Tel. No.</label>
                        <input type="text" name="applicant_tel_no" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Mobile Number <span class="text-red-500">*</span></label>
                        <input type="tel" name="applicant_mobile_number" required class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                    </div>
                </div>
            </div>

            <!-- Contact Information -->
            <div class="mb-8">
                <h2 class="text-xl font-semibold mb-4 pb-2 border-b">Contact Information</h2>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
<<<<<<< HEAD
                    <div class="md:col-span-2">
                        <label class="block text-sm font-medium text-gray-700">Street Address</label>
                        <input type="text" name="applicant_address_street" required class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
=======
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Province</label>
                        <input type="text" name="applicant_address_province" value="Metro Manila" readonly class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
>>>>>>> 81ef476 (Update province and city fields in admission form)
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
<<<<<<< HEAD
<<<<<<< HEAD
                        <label class="block text-sm font-medium text-gray-700">Province</label>
                        <input type="text" name="applicant_address_province" required class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
=======
                        <label class="block text-sm font-medium text-gray-700">Barangay</label>
=======
                        <label class="block text-sm font-medium text-gray-700">Barangay <span class="text-red-500">*</span></label>
>>>>>>> 6016cb7 (Feat: Add required field indicators and improve form validation for admission application)
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
>>>>>>> ca8e607 (Feat: Add LRN input validation with numeric and length constraints)
                    </div>
                    <div>
<<<<<<< HEAD
<<<<<<< HEAD
                        <label class="block text-sm font-medium text-gray-700">Mobile Number</label>
                        <input type="tel" name="applicant_mobile_number" required class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
=======
                        <label class="block text-sm font-medium text-gray-700">School Name</label>
                        <input type="text" name="school_name" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
=======
                        <label class="block text-sm font-medium text-gray-700">School Name <span class="text-red-500">*</span></label>
                        <input type="text" name="school_name" required class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
>>>>>>> 6016cb7 (Feat: Add required field indicators and improve form validation for admission application)
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
<<<<<<< HEAD
<<<<<<< HEAD
<<<<<<< HEAD
                        <label class="block text-sm font-medium text-gray-700">GWA</label>
                        <input type="number" step="0.01" name="gwa" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
>>>>>>> 078493a (Feat: Add input validation for year of graduation field)
=======
                        <label class="block text-sm font-medium text-gray-700">GWA <span class="text-red-500">*</span></label>
                        <input type="number" step="0.01" name="gwa" required class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
>>>>>>> 6016cb7 (Feat: Add required field indicators and improve form validation for admission application)
=======
                        <label class="block text-sm font-medium text-gray-700">General Weighted Average (GWA)</label>
                        <input type="text" name="gwa" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
>>>>>>> 4c7019d (refactor: improve GWA input validation and display formatting)
=======
                        <label class="block text-sm font-medium text-gray-700">GWA <span class="text-red-500">*</span></label>
                        <input type="number" step="0.01" name="gwa" required class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
>>>>>>> 3421222 (Revert "Merge branch 'admission_v3' of https://github.com/APC-SoCIT/APC-2024-2025-T1-05-Admission-Management-System into admission_v3")
                    </div>
                </div>
            </div>

            <!-- Family Information -->
<<<<<<< HEAD
            <div class="mb-8" x-data="{
                isOpen: true,
                fatherFirstName: '',
                fatherMiddleName: '',
                fatherLastName: '',
                fatherContact: '',
                motherFirstName: '',
                motherMiddleName: '',
                motherLastName: '',
                motherContact: '',
                guardianFirstName: '',
                guardianMiddleName: '',
                guardianLastName: '',
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
=======
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
>>>>>>> 43c1001 (<test>)
                </div>
                <div x-show="isOpen" x-transition>
                    <p class="text-sm text-gray-600 mb-4">Please provide information for at least one guardian (Father, Mother, or Guardian)</p>

<<<<<<< HEAD
                    <!-- Father's Information -->
                    <div class="mb-6">
                        <h3 class="text-lg font-medium mb-4">Father</h3>
                        <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-4">
                            <div>
                                <label class="block text-sm font-medium text-gray-700">
                                    First Name <span class="text-red-500">*</span>
                                </label>
                                <input type="text"
                                    name="father_first_name"
                                    x-model="fatherFirstName"
                                    @input="validateName('fatherFirstName', $event.target.value)"
                                    :class="{'border-red-500': errors.fatherFirstName}"
                                    placeholder="Enter first name"
                                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                                <p x-show="errors.fatherFirstName" x-text="errors.fatherFirstName" class="mt-1 text-sm text-red-500"></p>
                            </div>
=======
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
>>>>>>> 3ba92e1 (Feat: Add input validation for mother's contact number in admission form)

<<<<<<< HEAD
<<<<<<< HEAD
                            <div>
                                <label class="block text-sm font-medium text-gray-700">
                                    Middle Name
                                </label>
                                <input type="text"
                                    name="father_middle_name"
                                    x-model="fatherMiddleName"
                                    @input="validateName('fatherMiddleName', $event.target.value)"
                                    :class="{'border-red-500': errors.fatherMiddleName}"
                                    placeholder="Enter middle name"
                                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                                <p x-show="errors.fatherMiddleName" x-text="errors.fatherMiddleName" class="mt-1 text-sm text-red-500"></p>
                            </div>

                            <div>
                                <label class="block text-sm font-medium text-gray-700">
                                    Last Name <span class="text-red-500">*</span>
                                </label>
                                <input type="text"
                                    name="father_last_name"
                                    x-model="fatherLastName"
                                    @input="validateName('fatherLastName', $event.target.value)"
                                    :class="{'border-red-500': errors.fatherLastName}"
                                    placeholder="Enter last name"
                                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                                <p x-show="errors.fatherLastName" x-text="errors.fatherLastName" class="mt-1 text-sm text-red-500"></p>
                            </div>
                        </div>

                        <!-- Keep existing contact fields -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Mobile Number</label>
                            <input type="tel"
                                name="father_contact"
                                x-model="fatherContact"
                                @input="fatherContact = maskMobile($event.target.value)"
                                @blur="validatePhoneFormat('mobile', fatherContact) ? delete errors.fatherContact : errors.fatherContact = 'Please enter a valid mobile number (09XX-XXX-XXXX)'"
                                placeholder="09XX-XXX-XXXX"
                                :class="{'border-red-500': errors.fatherContact}"
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                            <p x-show="errors.fatherContact" x-text="errors.fatherContact" class="mt-1 text-sm text-red-500"></p>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Telephone Number</label>
                            <input type="tel"
                                name="father_tel"
                                x-model="fatherTel"
                                @input="fatherTel = maskTelephone($event.target.value)"
                                @blur="validatePhoneFormat('telephone', fatherTel) ? delete errors.fatherTel : errors.fatherTel = 'Please enter a valid telephone number ((02) XXXX-XXXX)'"
                                placeholder="(02) XXXX-XXXX"
                                :class="{'border-red-500': errors.fatherTel}"
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                            <p x-show="errors.fatherTel" x-text="errors.fatherTel" class="mt-1 text-sm text-red-500"></p>
                        </div>
                    </div>

                    <!-- Mother's Information -->
                    <div class="mb-6">
                        <h3 class="text-lg font-medium mb-4">Mother</h3>
                        <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-4">
                            <!-- Similar structure for mother's name fields -->
                            <div>
                                <label class="block text-sm font-medium text-gray-700">
                                    First Name <span class="text-red-500">*</span>
                                </label>
                                <input type="text"
                                    name="mother_first_name"
                                    x-model="motherFirstName"
                                    @input="validateName('motherFirstName', $event.target.value)"
                                    :class="{'border-red-500': errors.motherFirstName}"
                                    placeholder="Enter first name"
                                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                                <p x-show="errors.motherFirstName" x-text="errors.motherFirstName" class="mt-1 text-sm text-red-500"></p>
                            </div>

                            <div>
                                <label class="block text-sm font-medium text-gray-700">
                                    Middle Name
                                </label>
                                <input type="text"
                                    name="mother_middle_name"
                                    x-model="motherMiddleName"
                                    @input="validateName('motherMiddleName', $event.target.value)"
                                    :class="{'border-red-500': errors.motherMiddleName}"
                                    placeholder="Enter middle name"
                                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                                <p x-show="errors.motherMiddleName" x-text="errors.motherMiddleName" class="mt-1 text-sm text-red-500"></p>
                            </div>

                            <div>
                                <label class="block text-sm font-medium text-gray-700">
                                    Last Name <span class="text-red-500">*</span>
                                </label>
                                <input type="text"
                                    name="mother_last_name"
                                    x-model="motherLastName"
                                    @input="validateName('motherLastName', $event.target.value)"
                                    :class="{'border-red-500': errors.motherLastName}"
                                    placeholder="Enter last name"
                                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                                <p x-show="errors.motherLastName" x-text="errors.motherLastName" class="mt-1 text-sm text-red-500"></p>
                            </div>
                        </div>

                        <!-- Keep existing contact fields -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Mobile Number</label>
                            <input type="tel"
                                name="mother_contact"
                                x-model="motherContact"
                                @input="motherContact = maskMobile($event.target.value)"
                                @blur="validatePhoneFormat('mobile', motherContact) ? delete errors.motherContact : errors.motherContact = 'Please enter a valid mobile number (09XX-XXX-XXXX)'"
                                placeholder="09XX-XXX-XXXX"
                                :class="{'border-red-500': errors.motherContact}"
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                            <p x-show="errors.motherContact" x-text="errors.motherContact" class="mt-1 text-sm text-red-500"></p>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Telephone Number</label>
                            <input type="tel"
                                name="mother_tel"
                                x-model="motherTel"
                                @input="motherTel = maskTelephone($event.target.value)"
                                @blur="validatePhoneFormat('telephone', motherTel) ? delete errors.motherTel : errors.motherTel = 'Please enter a valid telephone number ((02) XXXX-XXXX)'"
                                placeholder="(02) XXXX-XXXX"
                                :class="{'border-red-500': errors.motherTel}"
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                            <p x-show="errors.motherTel" x-text="errors.motherTel" class="mt-1 text-sm text-red-500"></p>
                        </div>
                    </div>

                    <!-- Guardian's Information -->
                    <div class="mb-6">
                        <h3 class="text-lg font-medium mb-4">Legal Guardian</h3>
                        <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-4">
                            <!-- Similar structure for guardian's name fields -->
                            <div>
                                <label class="block text-sm font-medium text-gray-700">
                                    First Name <span class="text-red-500">*</span>
                                </label>
                                <input type="text"
                                    name="guardian_first_name"
                                    x-model="guardianFirstName"
                                    @input="validateName('guardianFirstName', $event.target.value)"
                                    :class="{'border-red-500': errors.guardianFirstName}"
                                    placeholder="Enter first name"
                                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                                <p x-show="errors.guardianFirstName" x-text="errors.guardianFirstName" class="mt-1 text-sm text-red-500"></p>
                            </div>

                            <div>
                                <label class="block text-sm font-medium text-gray-700">
                                    Middle Name
                                </label>
                                <input type="text"
                                    name="guardian_middle_name"
                                    x-model="guardianMiddleName"
                                    @input="validateName('guardianMiddleName', $event.target.value)"
                                    :class="{'border-red-500': errors.guardianMiddleName}"
                                    placeholder="Enter middle name"
                                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                                <p x-show="errors.guardianMiddleName" x-text="errors.guardianMiddleName" class="mt-1 text-sm text-red-500"></p>
                            </div>

                            <div>
                                <label class="block text-sm font-medium text-gray-700">
                                    Last Name <span class="text-red-500">*</span>
                                </label>
                                <input type="text"
                                    name="guardian_last_name"
                                    x-model="guardianLastName"
                                    @input="validateName('guardianLastName', $event.target.value)"
                                    :class="{'border-red-500': errors.guardianLastName}"
                                    placeholder="Enter last name"
                                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                                <p x-show="errors.guardianLastName" x-text="errors.guardianLastName" class="mt-1 text-sm text-red-500"></p>
                            </div>
                        </div>

                        <!-- Keep existing contact fields -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Mobile Number</label>
                            <input type="tel"
                                name="guardian_contact"
                                x-model="guardianContact"
                                @input="guardianContact = maskMobile($event.target.value)"
                                @blur="validatePhoneFormat('mobile', guardianContact) ? delete errors.guardianContact : errors.guardianContact = 'Please enter a valid mobile number (09XX-XXX-XXXX)'"
                                placeholder="09XX-XXX-XXXX"
                                :class="{'border-red-500': errors.guardianContact}"
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                            <p x-show="errors.guardianContact" x-text="errors.guardianContact" class="mt-1 text-sm text-red-500"></p>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Telephone Number</label>
                            <input type="tel"
                                name="guardian_tel"
                                x-model="guardianTel"
                                @input="guardianTel = maskTelephone($event.target.value)"
                                @blur="validatePhoneFormat('telephone', guardianTel) ? delete errors.guardianTel : errors.guardianTel = 'Please enter a valid telephone number ((02) XXXX-XXXX)'"
                                placeholder="(02) XXXX-XXXX"
                                :class="{'border-red-500': errors.guardianTel}"
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                            <p x-show="errors.guardianTel" x-text="errors.guardianTel" class="mt-1 text-sm text-red-500"></p>
=======
=======
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

>>>>>>> 68a95b6 (Feat: Add guardian information fields and input validation)
                <!-- Siblings Information -->
<<<<<<< HEAD
                <div class="mb-6">
<<<<<<< HEAD
<<<<<<< HEAD
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
>>>>>>> b739594 (Feat: Enhance sibling information input and form validation in admission form)
                        </div>
                    </div>
=======
                    <div class="flex items-center mb-4">
                        <label class="block text-sm font-medium text-gray-700 mr-8">Siblings</label>
                        <div class="flex items-center ml-4">
=======
=======
                <div class="mb-6" id="siblings-section">
>>>>>>> 4186360 (Feature: Enhance siblings section with dynamic input and only child option)
                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700 mb-2">Siblings</label>
<<<<<<< HEAD
<<<<<<< HEAD
                        <div class="flex items-center">
>>>>>>> 0db0309 (Refactor: Improve siblings section layout in admission form)
=======
                        <div class="flex items-center mb-4">
>>>>>>> a7fdec3 (Refactor: Enhance siblings section spacing in admission form)
=======
                        <div class="flex items-center">
>>>>>>> 1d03c4b (Refactor: Simplify siblings section structure in admission form)
                            <input type="checkbox"
                                   id="only-child"
                                   name="is_only_child"
                                   class="rounded border-gray-300 text-indigo-600 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                            <label for="only-child" class="ml-2 text-sm text-gray-600">Only Child</label>
                        </div>
                    </div>

                    <div id="siblings-container" class="mt-4">
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
<<<<<<< HEAD
<<<<<<< HEAD
>>>>>>> e2a63ae (Feat: Add "Only Child" option to siblings section with dynamic visibility)
=======
=======

>>>>>>> 4186360 (Feature: Enhance siblings section with dynamic input and only child option)
                    <button type="button" id="add-sibling" class="mt-4 px-4 py-2 bg-blue-500 text-white rounded-md hover:bg-blue-600">
                        Add Sibling
                    </button>
>>>>>>> 1d03c4b (Refactor: Simplify siblings section structure in admission form)
                </div>
            </div>

            <!-- Emergency Contact -->
<<<<<<< HEAD
            <div class="mb-8" x-data="{
                isOpen: true,
                emergencyFirstName: '',
                emergencyMiddleName: '',
                emergencyLastName: '',
                emergencyContact: '',
                emergencyTel: '',
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
                },
                sameAsPersonal: false,
                personalAddress: {
                    houseNumber: document.querySelector('[name=applicant_house_number]')?.value || '',
                    street: document.querySelector('[name=applicant_address_street]')?.value || '',
                    barangay: document.querySelector('[name=applicant_address_barangay]')?.value || '',
                    city: document.querySelector('[name=applicant_address_city]')?.value || '',
                    province: 'Metro Manila'
                },
                emergencyAddress: '',
                originalAddress: '',

                init() {
                    this.$watch('sameAsPersonal', (value) => {
                        if (value) {
                            this.originalAddress = this.emergencyAddress;

                            // Updated address construction with proper field binding
                            const addressParts = [];

                            // Add house number and street
                            if (this.personalAddress.houseNumber && this.personalAddress.street) {
                                addressParts.push(`${this.personalAddress.houseNumber} ${this.personalAddress.street} street`);
                            }

                            // Add barangay
                            if (this.personalAddress.barangay) {
                                addressParts.push(`Barangay ${this.personalAddress.barangay}`);
                            }

                            // Add city and province
                            if (this.personalAddress.city) {
                                addressParts.push(this.personalAddress.city);
                            }
                            if (this.personalAddress.province) {
                                addressParts.push(this.personalAddress.province);
                            }

                            this.emergencyAddress = addressParts.join(', ');
                        } else {
                            this.emergencyAddress = this.originalAddress;
                        }
                    });

                    // Same for the personalAddress watcher
                    this.$watch('personalAddress', (value) => {
                        if (this.sameAsPersonal) {
                            const addressParts = [];

                            if (value.houseNumber && value.street) {
                                addressParts.push(`${value.houseNumber} ${value.street} street`);
                            }
                            if (value.barangay) {
                                addressParts.push(`Barangay ${value.barangay}`);
                            }
                            if (value.city) {
                                addressParts.push(value.city);
                            }
                            if (value.province) {
                                addressParts.push(value.province);
                            }

                            this.emergencyAddress = addressParts.join(', ');
                        }
                    }, { deep: true });
                }
            }">
                <div class="flex justify-between items-center cursor-pointer mb-4" @click="isOpen = !isOpen">
                    <h2 class="text-xl font-semibold">Emergency Contact</h2>
                    <svg class="w-6 h-6 transition-transform" :class="{'rotate-180': !isOpen}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                    </svg>
                </div>
                <div x-show="isOpen" x-transition>
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-700">
                                First Name <span class="text-red-500">*</span>
                            </label>
                            <input type="text"
                                name="emergency_first_name"
                                x-model="emergencyFirstName"
                                @input="validateName('emergencyFirstName', $event.target.value)"
                                :class="{'border-red-500': errors.emergencyFirstName}"
                                placeholder="Enter first name"
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"
                                required>
                            <p x-show="errors.emergencyFirstName" x-text="errors.emergencyFirstName" class="mt-1 text-sm text-red-500"></p>
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700">
                                Middle Name
                            </label>
                            <input type="text"
                                name="emergency_middle_name"
                                x-model="emergencyMiddleName"
                                @input="validateName('emergencyMiddleName', $event.target.value)"
                                :class="{'border-red-500': errors.emergencyMiddleName}"
                                placeholder="Enter middle name"
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                            <p x-show="errors.emergencyMiddleName" x-text="errors.emergencyMiddleName" class="mt-1 text-sm text-red-500"></p>
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700">
                                Last Name <span class="text-red-500">*</span>
                            </label>
                            <input type="text"
                                name="emergency_last_name"
                                x-model="emergencyLastName"
                                @input="validateName('emergencyLastName', $event.target.value)"
                                :class="{'border-red-500': errors.emergencyLastName}"
                                placeholder="Enter last name"
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"
                                required>
                            <p x-show="errors.emergencyLastName" x-text="errors.emergencyLastName" class="mt-1 text-sm text-red-500"></p>
                        </div>
=======
            <div class="mb-8">
                <h2 class="text-xl font-semibold mb-4 pb-2 border-b">Emergency Contact</h2>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div class="md:col-span-2">
                        <label class="block text-sm font-medium text-gray-700">Complete Name <span class="text-red-500">*</span></label>
                        <input type="text" name="emergency_contact_name" required class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
>>>>>>> 6016cb7 (Feat: Add required field indicators and improve form validation for admission application)
                    </div>

                    <!-- Address Auto-fill Checkbox -->
                    <div class="mb-4">
                        <label class="inline-flex items-center">
                            <input type="checkbox"
                                x-model="sameAsPersonal"
                                @change="handleAddressAutoFill()"
                                class="rounded border-gray-300 text-blue-600 shadow-sm focus:border-blue-300 focus:ring focus:ring-blue-200 focus:ring-opacity-50">
                            <span class="ml-3 text-sm text-gray-600">Same as Personal Address</span>
                        </label>
                    </div>

                    <!-- Emergency Contact Address -->
                    <div class="md:col-span-2">
<<<<<<< HEAD
                        <label class="block text-sm font-medium text-gray-700">
                            Complete Address <span class="text-red-500">*</span>
                        </label>
                        <input type="text"
                            name="emergency_contact_address"
                            x-model="emergencyAddress"
                            @input="validateAddress($event.target.value)"
                            :class="{'border-red-500': errors.address}"
                            :disabled="sameAsPersonal"
                            :required="!sameAsPersonal"
                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"
                            :class="{'bg-gray-100': sameAsPersonal}">
                        <p x-show="errors.address" x-text="errors.address" class="mt-1 text-sm text-red-500"></p>
                    </div>

                    <div class="md:col-span-2">
<<<<<<< HEAD
                        <label class="block text-sm font-medium text-gray-700">
                            Mobile Number <span class="text-red-500">*</span>
                        </label>
                        <input type="tel"
                            name="emergency_contact_number"
                            x-model="emergencyContact"
                            @input="emergencyContact = maskMobile($event.target.value)"
                            @blur="validatePhoneFormat('mobile', emergencyContact) ? delete errors.emergencyContact : errors.emergencyContact = 'Please enter a valid mobile number (09XX-XXX-XXXX)'"
                            placeholder="09XX-XXX-XXXX"
                            :class="{'border-red-500': errors.emergencyContact}"
                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"
                            required>
                        <p x-show="errors.emergencyContact" x-text="errors.emergencyContact" class="mt-1 text-sm text-red-500"></p>
=======
                        <label class="block text-sm font-medium text-gray-700">Complete Address</label>
                        <input type="text" name="emergency_contact_address" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
=======
                        <label class="block text-sm font-medium text-gray-700">Complete Address <span class="text-red-500">*</span></label>
                        <input type="text" name="emergency_contact_address" required class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
>>>>>>> 6016cb7 (Feat: Add required field indicators and improve form validation for admission application)
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
>>>>>>> 68a95b6 (Feat: Add guardian information fields and input validation)
                    </div>

                    <div class="md:col-span-2">
<<<<<<< HEAD
                        <label class="block text-sm font-medium text-gray-700">Telephone Number</label>
                        <input type="tel"
                            name="emergency_contact_tel"
                            x-model="emergencyTel"
                            @input="emergencyTel = maskTelephone($event.target.value)"
                            @blur="validatePhoneFormat('telephone', emergencyTel) ? delete errors.emergencyTel : errors.emergencyTel = 'Please enter a valid telephone number ((02) XXXX-XXXX)'"
                            placeholder="(02) XXXX-XXXX"
                            :class="{'border-red-500': errors.emergencyTel}"
                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                        <p x-show="errors.emergencyTel" x-text="errors.emergencyTel" class="mt-1 text-sm text-red-500"></p>
=======
                        <label class="block text-sm font-medium text-gray-700">Email <span class="text-red-500">*</span></label>
                        <input type="email" name="emergency_contact_email" required class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
>>>>>>> 6016cb7 (Feat: Add required field indicators and improve form validation for admission application)
                    </div>
                </div>
            </div>

<<<<<<< HEAD
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
=======
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
>>>>>>> 67343d6 (Feat: Implement comprehensive file upload and document management for applicant submissions)
                    </div>
                </div>
            </div>

<<<<<<< HEAD
            <!-- Submit button -->
=======
            <!-- Submit Button -->
>>>>>>> 67343d6 (Feat: Implement comprehensive file upload and document management for applicant submissions)
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

<<<<<<< HEAD
<<<<<<< HEAD
    function handleSubmit() {
        // Check if at least one guardian is filled out
        const hasFather = this.fatherFirstName || this.fatherLastName;
        const hasMother = this.motherFirstName || this.motherLastName;
        const hasGuardian = this.guardianFirstName || this.guardianLastName;

        if (!hasFather && !hasMother && !hasGuardian) {
            alert('Please fill out information for at least one guardian (Father, Mother, or Legal Guardian)');
            return false;
        }

        // If validation passes, submit the form
        this.$el.submit();
    }
=======
=======
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


    document.querySelector('input[name="siblings[0][date_of_birth]"]').addEventListener('change', function() {
        calculateSiblingAge(this);
    });

    // Make initial sibling's age field readonly
    document.querySelector('input[name="siblings[0][age]"]').readOnly = true;

>>>>>>> a977eb2 (Feat: Implement automatic age calculation for sibling entries in admission form)
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
<<<<<<< HEAD
>>>>>>> ca8e607 (Feat: Add LRN input validation with numeric and length constraints)
=======

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
<<<<<<< HEAD
>>>>>>> 078493a (Feat: Add input validation for year of graduation field)
=======

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
<<<<<<< HEAD
>>>>>>> 7ff8908 (Feat: Add input validation for father's contact number in admission form)
=======

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
<<<<<<< HEAD
>>>>>>> 3ba92e1 (Feat: Add input validation for mother's contact number in admission form)
=======

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
<<<<<<< HEAD
>>>>>>> 68a95b6 (Feat: Add guardian information fields and input validation)
=======

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

<<<<<<< HEAD
    // Add event listener for guardian's contact number
    document.querySelector('input[name="guardian_contact_num"]').addEventListener('input', validateNumericInput);
>>>>>>> ff81f34 (Feat: Add input validation for guardian's contact number)
=======
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
<<<<<<< HEAD
>>>>>>> 1cf8ba4 (Feat: Enhance numeric input validation for multiple contact fields)
=======

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
<<<<<<< HEAD
>>>>>>> 67343d6 (Feat: Implement comprehensive file upload and document management for applicant submissions)
=======

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
<<<<<<< HEAD
<<<<<<< HEAD
>>>>>>> f775f69 (Feat: Implement dynamic document requirements based on student type)
=======

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
>>>>>>> 4c7019d (refactor: improve GWA input validation and display formatting)
=======
>>>>>>> 3421222 (Revert "Merge branch 'admission_v3' of https://github.com/APC-SoCIT/APC-2024-2025-T1-05-Admission-Management-System into admission_v3")
</script>
@endpush
@endsection

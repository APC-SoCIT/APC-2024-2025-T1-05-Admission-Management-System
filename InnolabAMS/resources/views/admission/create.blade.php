@extends('dashboard')
@section('title', 'Add Applicant | InnolabAMS')

@section('content')
<div class="container mx-auto px-6 py-4">
    <!-- Progress Indicator -->
    <div class="mb-8">
        <div class="flex justify-between items-center mb-6">
            <div class="flex items-center w-full">
                <div class="flex flex-col items-center flex-1">
                    <div class="w-8 h-8 rounded-full flex items-center justify-center"
                        :class="currentSection === 'program' ? 'bg-blue-500 text-white' : 'bg-gray-200'">
                        1
                    </div>
                    <span class="text-sm mt-1">Program</span>
                </div>
                <div class="h-1 flex-1" :class="currentSection !== 'program' ? 'bg-blue-500' : 'bg-gray-200'"></div>

                <div class="flex flex-col items-center flex-1">
                    <div class="w-8 h-8 rounded-full flex items-center justify-center"
                        :class="currentSection === 'personal' ? 'bg-blue-500 text-white' : 'bg-gray-200'">
                        2
                    </div>
                    <span class="text-sm mt-1">Personal</span>
                </div>
                <div class="h-1 flex-1" :class="currentSection === 'family' || currentSection === 'emergency' ? 'bg-blue-500' : 'bg-gray-200'"></div>

                <div class="flex flex-col items-center flex-1">
                    <div class="w-8 h-8 rounded-full flex items-center justify-center"
                        :class="currentSection === 'family' ? 'bg-blue-500 text-white' : 'bg-gray-200'">
                        3
                    </div>
                    <span class="text-sm mt-1">Family</span>
                </div>
                <div class="h-1 flex-1" :class="currentSection === 'emergency' ? 'bg-blue-500' : 'bg-gray-200'"></div>

                <div class="flex flex-col items-center flex-1">
                    <div class="w-8 h-8 rounded-full flex items-center justify-center"
                        :class="currentSection === 'emergency' ? 'bg-blue-500 text-white' : 'bg-gray-200'">
                        4
                    </div>
                    <span class="text-sm mt-1">Emergency</span>
                </div>
            </div>
        </div>
    </div>

    <!-- Existing back button and title -->
    <div class="flex justify-between items-center mb-4">
        <h1 class="text-2xl font-semibold">Add New Applicant</h1>
        <a href="{{ route('admission.index') }}" class="bg-gray-500 text-white px-4 py-2 rounded hover:bg-gray-600">
            <i class="fas fa-arrow-left mr-2"></i>Back
        </a>
    </div>

    <div class="bg-white rounded-lg shadow-lg p-6"
        x-data="{
            currentSection: 'program',
            showStudentType: false,
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
            }
        }"
    >
        <form action="{{ route('admission.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <!-- Program Information -->
            <div class="mb-8" x-data="{
                isOpen: true,
                programType: '',
                gradeLevel: '',
                strand: '',
                studentType: '',
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
                    this.showTransfereeFields = this.studentType === 'transferee';
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
                validateSchoolName(value) {
                    if (/\d/.test(value)) {
                        this.errors.schoolName = 'Invalid Format';
                        return false;
                    }
                    delete this.errors.schoolName;
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
                        <div class="space-y-2">
                            <div class="flex items-center p-2 rounded hover:bg-gray-50">
                                <input type="radio"
                                    name="student_type"
                                    value="transferee"
                                    x-model="studentType"
                                    class="h-4 w-4 border-gray-300 text-blue-600 focus:ring-blue-500">
                                <label class="ml-3 block text-sm font-medium text-gray-700">Transferee</label>
                            </div>
                            <div class="flex items-center p-2 rounded hover:bg-gray-50">
                                <input type="radio"
                                    name="student_type"
                                    value="existing"
                                    x-model="studentType"
                                    class="h-4 w-4 border-gray-300 text-blue-600 focus:ring-blue-500">
                                <label class="ml-3 block text-sm font-medium text-gray-700">Existing Student</label>
                            </div>
                            <div class="flex items-center p-2 rounded hover:bg-gray-50">
                                <input type="radio"
                                    name="student_type"
                                    value="returning"
                                    x-model="studentType"
                                    class="h-4 w-4 border-gray-300 text-blue-600 focus:ring-blue-500">
                                <label class="ml-3 block text-sm font-medium text-gray-700">Returning Student</label>
                            </div>
                        </div>
                    </div>

                    <!-- Transferee Fields -->
                    <div x-show="showTransfereeFields" x-transition>
                        <div class="mb-6">
                            <label class="block text-sm font-medium text-gray-700">Previous School</label>
                            <input type="text"
                                name="previous_school"
                                x-model="previousSchool"
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                        </div>
                        <div class="mb-6">
                            <label class="block text-sm font-medium text-gray-700">Transfer Reason</label>
                            <textarea
                                name="transfer_reason"
                                x-model="transferReason"
                                rows="3"
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"></textarea>
                        </div>
                        <div class="mb-6">
                            <label class="block text-sm font-medium text-gray-700 mb-1">Form 137</label>
                            <input type="file"
                                name="form_137"
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

                    <!-- Existing Student Fields -->
                    <div x-show="showExistingFields" x-transition>
                        <div class="mb-6">
                            <label class="block text-sm font-medium text-gray-700">Current Grade Level</label>
                            <input type="text"
                                name="current_grade"
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                        </div>
                        <div class="mb-6">
                            <label class="block text-sm font-medium text-gray-700">Academic Status</label>
                            <select name="academic_status"
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                                <option value="">Select Status</option>
                                <option value="regular">Regular</option>
                                <option value="irregular">Irregular</option>
                            </select>
                        </div>
                    </div>

                    <!-- Returning Student Fields -->
                    <div x-show="showReturningFields" x-transition>
                        <div class="mb-6">
                            <label class="block text-sm font-medium text-gray-700">Previous Enrollment Period</label>
                            <input type="text"
                                name="previous_enrollment"
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                        </div>
                        <div class="mb-6">
                            <label class="block text-sm font-medium text-gray-700">Gap Period (in years)</label>
                            <input type="number"
                                name="gap_period"
                                x-model="gapPeriod"
                                min="0"
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                        </div>
                        <div class="mb-6">
                            <label class="block text-sm font-medium text-gray-700">Reason for Return</label>
                            <textarea
                                name="return_reason"
                                rows="3"
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"></textarea>
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
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label class="block text-sm font-medium text-gray-700">
                                Surname <span class="text-red-500">*</span>
                            </label>
                            <input type="text"
                                name="applicant_surname"
                                x-model="surname"
                                @input="validateTextInput('surname', $event.target.value)"
                                :class="{
                                    'border-red-500 bg-red-50': errors.surname
                                }"
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"
                                required
                            >
                            <p x-show="errors.surname"
                               x-text="errors.surname"
                               class="mt-1 text-sm text-red-500"></p>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700">
                                Given Name <span class="text-red-500">*</span>
                            </label>
                            <input type="text"
                                name="applicant_given_name"
                                x-model="givenName"
                                @input="validateTextInput('givenName', $event.target.value)"
                                :class="{
                                    'border-red-500 bg-red-50': errors.givenName
                                }"
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"
                                required
                            >
                            <p x-show="errors.givenName"
                               x-text="errors.givenName"
                               class="mt-1 text-sm text-red-500"></p>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Middle Name</label>
                            <input type="text"
                                name="applicant_middle_name"
                                x-model="middleName"
                                @input="validateTextInput('middleName', $event.target.value)"
                                :class="{
                                    'border-red-500 bg-red-50': errors.middleName
                                }"
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"
                            >
                            <p x-show="errors.middleName"
                               x-text="errors.middleName"
                               class="mt-1 text-sm text-red-500"></p>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Extension Name</label>
                            <input type="text"
                                name="applicant_extension"
                                x-model="extensionName"
                                @input="validateExtensionName($event.target.value)"
                                :class="{'border-red-500 bg-red-50': errors.extensionName}"
                                placeholder="Jr., II, III, etc."
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                            <p x-show="errors.extensionName"
                               x-text="errors.extensionName"
                               class="mt-1 text-sm text-red-500"></p>
                        </div>
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
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Nationality</label>
                            <input type="text"
                                name="applicant_nationality"
                                x-model="nationality"
                                @input="validateTextInput('nationality', $event.target.value)"
                                :class="{
                                    'border-red-500 bg-red-50': errors.nationality
                                }"
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"
                            >
                            <p x-show="errors.nationality"
                               x-text="errors.nationality"
                               class="mt-1 text-sm text-red-500"></p>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Religion</label>
                            <input type="text"
                                name="applicant_religion"
                                x-model="religion"
                                @input="validateTextInput('religion', $event.target.value)"
                                :class="{
                                    'border-red-500 bg-red-50': errors.religion
                                }"
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"
                            >
                            <p x-show="errors.religion"
                               x-text="errors.religion"
                               class="mt-1 text-sm text-red-500"></p>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Contact Number</label>
                            <input type="text"
                                name="applicant_contact"
                                x-model="contactNo"
                                @input="validateContactNumber($event.target.value)"
                                placeholder="08xx-xxxx / 09xx-xxx-xxxx"
                                :class="{'border-red-500 bg-red-50': errors.contactNo}"
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                            <p x-show="errors.contactNo"
                               x-text="errors.contactNo"
                               class="mt-1 text-sm text-red-500"></p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Family Information -->
            <div class="mb-8" x-data="{ isOpen: true, fatherName: '', fatherContact: '', motherName: '', motherContact: '', guardianName: '', guardianContact: '', errors: {}, validateTextInput(field, value) {
                if (/\d/.test(value)) {
                    this.errors[field] = 'Invalid Format';
                    return false;
                }
                delete this.errors[field];
                return true;
            }, validatePhoneNumber(field, value) {
                if (/[a-zA-Z]/.test(value)) {
                    this.errors[field] = 'Invalid Format';
                    return false;
                }
                delete this.errors[field];
                return true;
            } }">
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
                                    @input="validateTextInput('fatherName', $event.target.value)"
                                    :class="{'border-red-500': errors.fatherName}"
                                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                                <p x-show="errors.fatherName" x-text="errors.fatherName" class="mt-1 text-sm text-red-500"></p>
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700">Contact Number</label>
                                <input type="text"
                                    name="father_contact"
                                    x-model="fatherContact"
                                    @input="validatePhoneNumber('fatherContact', $event.target.value)"
                                    placeholder="08xx-xxxx / 09xx-xxx-xxxx"
                                    :class="{'border-red-500 bg-red-50': errors.fatherContact}"
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
                                    @input="validateTextInput('motherName', $event.target.value)"
                                    :class="{'border-red-500': errors.motherName}"
                                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                                <p x-show="errors.motherName" x-text="errors.motherName" class="mt-1 text-sm text-red-500"></p>
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700">Contact Number</label>
                                <input type="text"
                                    name="mother_contact"
                                    x-model="motherContact"
                                    @input="validatePhoneNumber('motherContact', $event.target.value)"
                                    placeholder="08xx-xxxx / 09xx-xxx-xxxx"
                                    :class="{'border-red-500 bg-red-50': errors.motherContact}"
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
                                    @input="validateTextInput('guardianName', $event.target.value)"
                                    :class="{'border-red-500': errors.guardianName}"
                                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                                <p x-show="errors.guardianName" x-text="errors.guardianName" class="mt-1 text-sm text-red-500"></p>
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700">Contact Number</label>
                                <input type="text"
                                    name="guardian_contact"
                                    x-model="guardianContact"
                                    @input="validatePhoneNumber('guardianContact', $event.target.value)"
                                    placeholder="08xx-xxxx / 09xx-xxx-xxxx"
                                    :class="{'border-red-500 bg-red-50': errors.guardianContact}"
                                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                                <p x-show="errors.guardianContact" x-text="errors.guardianContact" class="mt-1 text-sm text-red-500"></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Emergency Contact -->
            <div class="mb-8" x-data="{ isOpen: true, emergencyName: '', emergencyContact: '', errors: {}, validateEmergencyName(value) {
                if (/\d/.test(value)) {
                    this.errors.emergencyName = 'Invalid Format';
                    return false;
                }
                delete this.errors.emergencyName;
                return true;
            }, validateEmergencyContact(value) {
                if (/[a-zA-Z]/.test(value)) {
                    this.errors.emergencyContact = 'Invalid Format';
                    return false;
                }
                delete this.errors.emergencyContact;
                return true;
            } }">
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
                                @input="validateEmergencyName($event.target.value)"
                                :class="{'border-red-500': errors.emergencyName}"
                                required
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                            <p x-show="errors.emergencyName"
                               x-text="errors.emergencyName"
                               class="mt-1 text-sm text-red-500"></p>
                        </div>
                        <div class="md:col-span-2">
                            <label class="block text-sm font-medium text-gray-700">
                                Complete Address <span class="text-red-500">*</span>
                            </label>
                            <input type="text"
                                name="emergency_contact_address"
                                required
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                        </div>
                        <div class="md:col-span-2">
                            <label class="block text-sm font-medium text-gray-700">
                                Contact Number <span class="text-red-500">*</span>
                            </label>
                            <input type="text"
                                name="emergency_contact_number"
                                x-model="emergencyContact"
                                @input="validateEmergencyContact($event.target.value)"
                                placeholder="8xxx-xxxx / 09xx-xxx-xxxx"
                                :class="{'border-red-500 bg-red-50': errors.emergencyContact}"
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                            <p x-show="errors.emergencyContact"
                               x-text="errors.emergencyContact"
                               class="mt-1 text-sm text-red-500"></p>
                        </div>
                        <div class="md:col-span-2">
                            <label class="block text-sm font-medium text-gray-700">Email</label>
                            <input type="email"
                                name="emergency_contact_email"
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                        </div>
                    </div>
                </div>
            </div>

            <!-- After Emergency Contact section and before Submit button -->
            <div class="mb-8" x-data="{
                isOpen: true,
                title: 'Required Documents',
                expanded: true
            }">
                <div class="flex justify-between items-center cursor-pointer mb-4" @click="expanded = !expanded">
                    <h2 class="text-xl font-semibold" x-text="title"></h2>
                    <svg class="w-6 h-6 transition-transform" :class="{'rotate-180': !expanded}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                    </svg>
                </div>

                <div x-show="expanded" x-transition>
                    <!-- Document Requirements Section -->
                    <div x-show="studentType" x-transition class="mb-8">
                        <p class="text-sm text-gray-500 mb-4">Please upload the following documents. All files must be in PDF, JPG, or PNG format and must not exceed 10MB.</p>

                        <!-- Transferee Documents -->
                        <div x-show="studentType === 'transferee'" class="space-y-4">
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

            <!-- Submit button section -->
            <div class="flex justify-end">
                <button type="submit"
                    class="px-4 py-2 bg-blue-500 text-white rounded hover:bg-blue-600">
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

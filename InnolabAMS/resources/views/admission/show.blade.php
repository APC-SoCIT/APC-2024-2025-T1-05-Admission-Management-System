@extends('dashboard')
@section('title', 'Application Details | InnolabAMS')

@section('content')
<div class="container mx-auto p-4">
    <!-- Top Navigation -->
    <div class="border-b mb-4">
        <div class="flex justify-between items-center">
            <ul class="flex space-x-4">
                <li><a href="#" class="text-blue-600 underline">Application</a></li>
                <li><a href="#" class="text-gray-600">Attachments</a></li>
                <li><a href="#" class="text-gray-600">Additional Information</a></li>
            </ul>
            <a href="{{ route('admission.index') }}" 
               class="bg-gray-500 text-white px-4 py-2 rounded hover:bg-gray-600">
                <i class="fas fa-arrow-left mr-2"></i>Back
            </a>
        </div>
    </div>

    <!-- Application Info Header -->
    <div class="mb-6">
        <div class="grid grid-cols-3 gap-4">
            <div>
                <span class="text-gray-600">Application ID:</span>
                <span>{{ $applicant->id }}</span>
            </div>
            <div>
                <span class="text-gray-600">Date Submitted:</span>
                <span>{{ $applicant->created_at->format('F d, Y') }}</span>
            </div>
            <div class="flex justify-end space-x-2">
                <button class="bg-green-500 text-white px-3 py-1 rounded">Accept (0)</button>
                <button class="bg-red-500 text-white px-3 py-1 rounded">Reject (0)</button>
                <button class="bg-gray-500 text-white px-3 py-1 rounded">Pending (0)</button>
            </div>
        </div>
    </div>

    <!-- Main Form -->
    <div class="border rounded">
        <!-- Applying For Section -->
        <div class="border-b">
            <div class="bg-gray-200 px-4 py-2 font-semibold">Applying For</div>
            <table class="w-full">
                <tr class="border-b">
                    <td class="w-1/4 px-4 py-2 border-r">Classification:</td>
                    <td class="px-4 py-2">{{ $applicant->classification ?? '' }}</td>
                </tr>
                <tr class="border-b">
                    <td class="w-1/4 px-4 py-2 border-r">Grade/Level:</td>
                    <td class="px-4 py-2">{{ $applicant->apply_grade_level }}</td>
                </tr>
                <tr class="border-b">
                    <td class="w-1/4 px-4 py-2 border-r">Academic Program:</td>
                    <td class="px-4 py-2">{{ $applicant->apply_program }}</td>
                </tr>
            </table>
        </div>

        <!-- Student Information Section -->
        <div class="border-b">
            <div class="bg-gray-200 px-4 py-2 font-semibold">Student Information</div>
            <table class="w-full">
                <tr class="border-b">
                    <td class="w-1/4 px-4 py-2 border-r">Student Name:</td>
                    <td class="px-4 py-2">{{ $applicant->full_name }}</td>
                </tr>
                <tr class="border-b">
                    <td class="w-1/4 px-4 py-2 border-r">Sex:</td>
                    <td class="w-1/4 px-4 py-2">{{ $applicant->gender }}</td>
                    <td class="w-1/4 px-4 py-2 border-r">Age:</td>
                    <td class="px-4 py-2">{{ $applicant->age ?? '' }}</td>
                </tr>
                <tr class="border-b">
                    <td class="w-1/4 px-4 py-2 border-r">Date of Birth:</td>
                    <td class="w-1/4 px-4 py-2">{{ $applicant->applicant_date_birth->format('F d, Y') }}</td>
                    <td class="w-1/4 px-4 py-2 border-r">Place of Birth:</td>
                    <td class="px-4 py-2">{{ $applicant->applicant_place_birth }}</td>
                </tr>
                <tr class="border-b">
                    <td class="w-1/4 px-4 py-2 border-r">Nationality:</td>
                    <td class="w-1/4 px-4 py-2">{{ $applicant->applicant_nationality }}</td>
                    <td class="w-1/4 px-4 py-2 border-r">Religion:</td>
                    <td class="px-4 py-2">{{ $applicant->applicant_religion }}</td>
                </tr>
                <tr class="border-b">
                    <td class="w-1/4 px-4 py-2 border-r">Tel. No:</td>
                    <td class="w-1/4 px-4 py-2">{{ $applicant->telephone_number ?? '' }}</td>
                    <td class="w-1/4 px-4 py-2 border-r">Mobile No:</td>
                    <td class="px-4 py-2">{{ $applicant->applicant_mobile_number }}</td>
                </tr>
                <tr class="border-b">
                    <td class="w-1/4 px-4 py-2 border-r">Email:</td>
                    <td class="px-4 py-2" colspan="3">{{ $applicant->user->email }}</td>
                </tr>
            </table>
        </div>

        <!-- Educational Background Section -->
        <div class="border-b">
            <div class="bg-gray-200 px-4 py-2 font-semibold">Educational Background</div>
            <table class="w-full">
                <tr class="border-b">
                    <td class="w-1/4 px-4 py-2 border-r">LRN:</td>
                    <td class="px-4 py-2" colspan="3">{{ $applicant->lrn ?? '' }}</td>
                </tr>
                <tr class="border-b">
                    <td class="w-1/4 px-4 py-2 border-r">School Name:</td>
                    <td class="px-4 py-2" colspan="3">{{ $applicant->school_name ?? '' }}</td>
                </tr>
                <tr class="border-b">
                    <td class="w-1/4 px-4 py-2 border-r">School Address:</td>
                    <td class="px-4 py-2" colspan="3">{{ $applicant->school_address ?? '' }}</td>
                </tr>
                <tr class="border-b">
                    <td class="w-1/4 px-4 py-2 border-r">Academic Program:</td>
                    <td class="w-1/4 px-4 py-2">{{ $applicant->previous_program ?? '' }}</td>
                    <td class="w-1/4 px-4 py-2 border-r">Year of Graduation:</td>
                    <td class="px-4 py-2">{{ $applicant->year_of_graduation ?? '' }}</td>
                </tr>
                <tr class="border-b">
                    <td class="w-1/4 px-4 py-2 border-r">Awards/Honors:</td>
                    <td class="w-1/4 px-4 py-2">{{ $applicant->awards ?? '' }}</td>
                    <td class="w-1/4 px-4 py-2 border-r">GWA:</td>
                    <td class="px-4 py-2">{{ $applicant->gwa ?? '' }}</td>
                </tr>
            </table>
        </div>

        <!-- Family Information Section -->
        <div class="border-b">
            <div class="bg-gray-200 px-4 py-2 font-semibold">Family Information</div>
            <table class="w-full">
                <tr class="border-b">
                    <td class="w-1/4 px-4 py-2 border-r">Father's Name:</td>
                    <td class="w-1/4 px-4 py-2">{{ $applicant->father_name ?? '' }}</td>
                    <td class="w-1/4 px-4 py-2 border-r">Occupation:</td>
                    <td class="px-4 py-2">{{ $applicant->father_occupation ?? '' }}</td>
                </tr>
                <tr class="border-b">
                    <td class="w-1/4 px-4 py-2 border-r">Contact No:</td>
                    <td class="px-4 py-2" colspan="3">{{ $applicant->father_contact ?? '' }}</td>
                </tr>
                <tr class="border-b">
                    <td class="w-1/4 px-4 py-2 border-r">Mother's Name:</td>
                    <td class="w-1/4 px-4 py-2">{{ $applicant->mother_name ?? '' }}</td>
                    <td class="w-1/4 px-4 py-2 border-r">Occupation:</td>
                    <td class="px-4 py-2">{{ $applicant->mother_occupation ?? '' }}</td>
                </tr>
                <tr class="border-b">
                    <td class="w-1/4 px-4 py-2 border-r">Contact No:</td>
                    <td class="px-4 py-2" colspan="3">{{ $applicant->mother_contact ?? '' }}</td>
                </tr>
                <tr class="border-b">
                    <td class="w-1/4 px-4 py-2 border-r">Siblings:</td>
                    <td class="px-4 py-2" colspan="3">
                        <table class="w-full">
                            <tr class="border-b">
                                <th class="px-2 py-1 border-r">Full Name</th>
                                <th class="px-2 py-1 border-r">Date of Birth</th>
                                <th class="px-2 py-1 border-r">Age</th>
                                <th class="px-2 py-1 border-r">Grade Level</th>
                                <th class="px-2 py-1">School Attended</th>
                            </tr>
                            <!-- Siblings data would go here -->
                        </table>
                    </td>
                </tr>
            </table>
        </div>

        <!-- Emergency Contacts Section -->
        <div>
            <div class="bg-gray-200 px-4 py-2 font-semibold">Emergency Contacts</div>
            <table class="w-full">
                <tr class="border-b">
                    <td class="w-1/4 px-4 py-2 border-r">Complete Name:</td>
                    <td class="px-4 py-2">{{ $applicant->emergency_contact_name ?? '' }}</td>
                </tr>
                <tr class="border-b">
                    <td class="w-1/4 px-4 py-2 border-r">Complete Address:</td>
                    <td class="px-4 py-2">{{ $applicant->emergency_contact_address ?? '' }}</td>
                </tr>
                <tr class="border-b">
                    <td class="w-1/4 px-4 py-2 border-r">Tel. No:</td>
                    <td class="w-1/4 px-4 py-2">{{ $applicant->emergency_contact_tel ?? '' }}</td>
                    <td class="w-1/4 px-4 py-2 border-r">Mobile No:</td>
                    <td class="px-4 py-2">{{ $applicant->emergency_contact_mobile ?? '' }}</td>
                </tr>
                <tr class="border-b">
                    <td class="w-1/4 px-4 py-2 border-r">Email:</td>
                    <td class="px-4 py-2" colspan="3">{{ $applicant->emergency_contact_email ?? '' }}</td>
                </tr>
            </table>
        </div>
    </div>
</div>
@endsection
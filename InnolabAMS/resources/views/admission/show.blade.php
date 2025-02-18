@extends('dashboard')
@section('title', 'Application Details | InnolabAMS')

@section('content')
<div class="container mx-auto px-6">
    <!-- Back Button -->
    <div class="mb-6">
        <a href="{{ route('admission.index') }}"
           class="inline-flex items-center px-4 py-2 bg-gray-500 text-white px-4 py-1 rounded-lg hover:bg-gray-700">
            <i class="fas fa-arrow-left mr-2"></i>Back
        </a>
    </div>

    <!-- Application Info Header -->
    <div class="flex justify-between items-center mb-6">
        <div>
            <span class="text-gray-600">Application ID: {{ $applicant->id }}</span>
            <span class="text-gray-600 ml-6">Date Submitted: {{ $applicant->created_at->format('F d, Y') }}</span>
        </div>
        <div class="flex space-x-4">
            <form method="POST" action="{{ route('admission.update-status', $applicant->id) }}" class="flex space-x-3">
                @csrf
                @method('PATCH')
                <button type="submit" name="status" value="accepted"
                    style="background-color: #4CAF50;"
                    class="inline-flex items-center px-4 py-2 text-white font-bold rounded-lg hover:opacity-90">
                    Accept
                </button>
                <button type="submit" name="status" value="rejected"
                    class="inline-flex items-center px-4 py-2 bg-red-600 hover:bg-red-700 text-white font-bold rounded-lg">
                    Reject
                </button>
            </form>
        </div>
    </div>

    <!-- Main Form -->
    <div class="border rounded">
        <!-- Applying For Section -->
        <div class="border-b">
            <div class="bg-gray-200 px-4 py-2 font-semibold">Applying For</div>
            <table class="w-full">
                <tr class="border-b">
                    <td class="w-1/6 px-4 py-2 text-gray-600 border-r">Grade/Level:</td>
                    <td class="px-4 py-2">{{ $applicant->apply_grade_level }}</td>
                </tr>
                <tr class="border-b">
                    <td class="w-1/6 px-4 py-2 text-gray-600 border-r">Academic Program:</td>
                    <td class="px-4 py-2">{{ $applicant->apply_program }}</td>
                </tr>
                <tr class="border-b">
                    <td class="w-1/6 px-4 py-2 text-gray-600 border-r">Student Type:</td>
                    <td class="px-4 py-2" colspan="3">{{ $applicant->full_name }}</td>
                </tr>
                                <tr class="border-b">
                    <td class="w-1/6 px-4 py-2 text-gray-600 border-r">Student Type:</td>
                    <td class="px-4 py-2" colspan="3">{{ $applicant->student_type }}</td>
                </tr>
            </table>
        </div>

        <!-- Student Information Section -->
        <div class="border-b">
            <div class="bg-gray-200 px-4 py-2 font-semibold">Student Information</div>
            <table class="w-full">
                <tr class="border-b">
                    <td class="w-1/6 px-4 py-2 text-gray-600 border-r">Student Name:</td>
                    <td class="px-4 py-2" colspan="3">{{ $applicant->full_name }}</td>
                </tr>
                <tr class="border-b">
                    <td class="w-1/6 px-4 py-2 text-gray-600 border-r">Sex:</td>
                    <td class="w-1/3 px-4 py-2">{{ $applicant->gender }}</td>
                    <td class="w-1/6 px-4 py-2 text-gray-600 border-x">Age:</td>
                    <td class="px-4 py-2">{{ $applicant->age }}</td>
                </tr>
                <tr class="border-b">
                    <td class="w-1/6 px-4 py-2 text-gray-600 border-r">Date of Birth:</td>
                    <td class="w-1/3 px-4 py-2">{{ $applicant->applicant_date_birth->format('F d, Y') }}</td>
                    <td class="w-1/6 px-4 py-2 text-gray-600 border-x">Place of Birth:</td>
                    <td class="px-4 py-2">{{ $applicant->applicant_place_birth }}</td>
                </tr>
                <tr class="border-b">
                    <td class="w-1/6 px-4 py-2 text-gray-600 border-r">Nationality:</td>
                    <td class="w-1/3 px-4 py-2">{{ $applicant->applicant_nationality }}</td>
                    <td class="w-1/6 px-4 py-2 text-gray-600 border-x">Religion:</td>
                    <td class="px-4 py-2">{{ $applicant->applicant_religion }}</td>
                </tr>
                <tr class="border-b">
                    <td class="w-1/6 px-4 py-2 text-gray-600 border-r">Address:</td>
                    <td class="px-4 py-2" colspan="3">{{ implode(', ', array_filter([$applicant->applicant_address_street, $applicant->applicant_address_city, $applicant->applicant_address_province, $applicant->applicant_barangay])) }}</td>
                </tr>
                <tr class="border-b">
                    <td class="w-1/6 px-4 py-2 text-gray-600 border-r">Tel. No:</td>
                    <td class="w-1/4 px-4 py-2">{{ $applicant->applicant_tel_no }}</td>
                    <td class="w-1/6 px-4 py-2 text-gray-600 border-x">Mobile No:</td>
                    <td class="w-1/4 px-4 py-2">{{ $applicant->applicant_mobile_number }}</td>
                    <td class="w-1/6 px-4 py-2 text-gray-600 border-x">Email:</td>
                    <td class="px-4 py-2">{{ $applicant->user->email }}</td>
                </tr>
            </table>
        </div>

        <!-- Educational Background Section -->
        <div class="border-b">
            <div class="bg-gray-200 px-4 py-2 font-semibold">Educational Background</div>
            <table class="w-full">
                <tr class="border-b">
                    <td class="w-1/6 px-4 py-2 text-gray-600 border-r">LRN:</td>
                    <td class="px-4 py-2" colspan="3">{{ $applicant->lrn }}</td>
                </tr>
                <tr class="border-b">
                    <td class="w-1/6 px-4 py-2 text-gray-600 border-r">School Name:</td>
                    <td class="px-4 py-2" colspan="3">{{ $applicant->school_name }}</td>
                </tr>
                <tr class="border-b">
                    <td class="w-1/6 px-4 py-2 text-gray-600 border-r">School Address:</td>
                    <td class="px-4 py-2" colspan="3">{{ $applicant->school_address }}</td>
                </tr>
                <tr class="border-b">
                    <td class="w-1/6 px-4 py-2 text-gray-600 border-r">Academic Program:</td>
                    <td class="w-1/3 px-4 py-2">{{ $applicant->previous_program }}</td>
                    <td class="w-1/6 px-4 py-2 text-gray-600 border-x">Year of Graduation:</td>
                    <td class="px-4 py-2">{{ $applicant->year_of_graduation }}</td>
                </tr>
                <tr class="border-b">
                    <td class="w-1/6 px-4 py-2 text-gray-600 border-r">Awards/Honors:</td>
                    <td class="w-1/3 px-4 py-2">{{ $applicant->awards_honors }}</td>
                    <td class="w-1/6 px-4 py-2 text-gray-600 border-x">GWA:</td>
                    <td class="px-4 py-2">{{ $applicant->gwa }}</td>
                </tr>
            </table>
        </div>

        <!-- Family Information Section -->
        <div class="border-b">
            <div class="bg-gray-200 px-4 py-2 font-semibold">Family Information</div>
            <table class="w-full">
                <tr class="border-b">
                    <td class="w-1/6 px-4 py-2 text-gray-600 border-r">Father's Name:</td>
                    <td class="px-4 py-2" colspan="3">{{ implode(', ', array_filter([$applicant->father_given_name, $applicant->father_middle_name, $applicant->father_surname])) }}</td>
                </tr>
                <tr class="border-b">
                    <td class="w-1/6 px-4 py-2 text-gray-600 border-r">Contact No:</td>
                    <td class="px-4 py-2" colspan="3">{{ $applicant->father_contact }}</td>
                </tr>
                <tr class="border-b">
                    <td class="w-1/6 px-4 py-2 text-gray-600 border-r">Mother's Name:</td>
                    <td class="w-1/3 px-4 py-2">{{ implode(', ', array_filter([$applicant->mother_given_name, $applicant->mother_middle_name, $applicant->mother_surname])) }}</td>
                </tr>
                <tr class="border-b">
                    <td class="w-1/6 px-4 py-2 text-gray-600 border-r">Contact No:</td>
                    <td class="px-4 py-2" colspan="3">{{ $applicant->mother_contact }}</td>
                </tr>
                <tr class="border-b">
                    <td class="w-1/6 px-4 py-2 text-gray-600 border-r">Guardian's Name:</td>
                    <td class="px-4 py-2" colspan="3">{{ implode(', ', array_filter([$applicant->guardian_given_name, $applicant->guardian_middle_name, $applicant->guardian_surname])) }}</td>
                </tr>
                <tr class="border-b">
                    <td class="w-1/6 px-4 py-2 text-gray-600 border-r">Contact No:</td>
                    <td class="px-4 py-2" colspan="3">{{ $applicant->guardian_contact_num }}</td>
                </tr>
                <tr class="border-b">
                    <td class="w-1/6 px-4 py-2 text-gray-600 border-r">Siblings:</td>
                    <td class="px-4 py-2" colspan="3">
                        <table class="w-full border, text-center">
                            <tr class="bg-gray-50 border-b">
                                <th class="px-4 py-2 text-sm font-medium text-gray-600 border-r">Full Name</th>
                                <th class="px-4 py-2 text-sm font-medium text-gray-600 border-r">Date of Birth</th>
                                <th class="px-4 py-2 text-sm font-medium text-gray-600 border-r">Age</th>
                                <th class="px-4 py-2 text-sm font-medium text-gray-600 border-r">Grade Level</th>
                                <th class="px-4 py-2 text-sm font-medium text-gray-600">School Attended</th>
                            </tr>
                            @if(isset($applicant->siblings))
                                @foreach(json_decode($applicant->siblings) as $sibling)
                                    <tr class="border-b">
                                        <td class="px-4 py-2 border-r">{{ $sibling->full_name }}</td>
                                        <td class="px-4 py-2 border-r">{{ $sibling->date_of_birth }}</td>
                                        <td class="px-4 py-2 border-r">{{ $sibling->age }}</td>
                                        <td class="px-4 py-2 border-r">{{ $sibling->grade_level }}</td>
                                        <td class="px-4 py-2">{{ $sibling->school_attended }}</td>
                                    </tr>
                                @endforeach
                            @endif
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
                    <td class="w-1/6 px-4 py-2 text-gray-600 border-r">Complete Name:</td>
                    <td class="px-4 py-2">{{ $applicant->emergency_contact_name }}</td>
                </tr>
                <tr class="border-b">
                    <td class="w-1/6 px-4 py-2 text-gray-600 border-r">Complete Address:</td>
                    <td class="px-4 py-2">{{ $applicant->emergency_contact_address }}</td>
                </tr>
                <tr class="border-b">
                    <td class="w-1/6 px-4 py-2 text-gray-600 border-r">Tel. No:</td>
                    <td class="w-1/4 px-4 py-2">{{ $applicant->emergency_contact_tel }}</td>
                    <td class="w-1/6 px-4 py-2 text-gray-600 border-x">Mobile No:</td>
                    <td class="w-1/4 px-4 py-2">{{ $applicant->emergency_contact_mobile }}</td>
                    <td class="w-1/6 px-4 py-2 text-gray-600 border-x">Email:</td>
                    <td class="px-4 py-2">{{ $applicant->emergency_contact_email }}</td>
                </tr>
            </table>
        </div>
    </div>
</div>
@endsection

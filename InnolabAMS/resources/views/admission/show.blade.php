@extends('dashboard')
@section('title', 'Application Details | InnolabAMS')

@section('content')
<div class="container mx-auto px-6 py-4">
    <div class="flex justify-between items-center mb-4">
        <h1 class="text-2xl font-semibold">Application Details</h1>
        <div class="flex space-x-4">
            <a href="{{ route('admission.index') }}" class="bg-gray-500 text-white px-4 py-2 rounded hover:bg-gray-600">
                <i class="fas fa-arrow-left mr-2"></i>Back
            </a>
        </div>
    </div>

    <div class="bg-white rounded-lg shadow-lg p-6">
        <!-- Status and Application Info -->
        <div class="mb-6">
            <div class="flex justify-between items-center">
                <div>
                    <span class="text-gray-600">Application ID:</span>
                    <span>{{ $applicant->id }}</span>
                </div>
                <div>
                    <span class="text-gray-600">Date Submitted:</span>
                    <span>{{ $applicant->created_at->format('F d, Y') }}</span>
                </div>
                <div class="flex space-x-4">
                    <button class="bg-gray-500 text-white px-4 py-2 rounded">
                        Accept (0)
                    </button>
                    <button class="bg-gray-500 text-white px-4 py-2 rounded">
                        Reject (0)
                    </button>
                    <button class="bg-gray-500 text-white px-4 py-2 rounded">
                        Pending (0)
                    </button>
                </div>
            </div>
        </div>

        <!-- Program Information -->
        <div class="mb-8">
            <h2 class="text-lg font-semibold mb-4 bg-gray-200 p-2">Applying For</h2>
            <div class="grid grid-cols-2 gap-4">
                <div>
                    <label class="text-gray-600">Classification:</label>
                    <p>{{ $applicant->classification }}</p>
                </div>
                <div>
                    <label class="text-gray-600">Grade/Level:</label>
                    <p>{{ $applicant->apply_grade_level }}</p>
                </div>
                <div>
                    <label class="text-gray-600">Academic Program:</label>
                    <p>{{ $applicant->apply_program }}</p>
                </div>
                @if($applicant->apply_strand)
                <div>
                    <label class="text-gray-600">Strand:</label>
                    <p>{{ $applicant->apply_strand }}</p>
                </div>
                @endif
            </div>
        </div>

        <!-- Student Information -->
        <div class="mb-8">
            <h2 class="text-lg font-semibold mb-4 bg-gray-200 p-2">Student Information</h2>
            <div class="grid grid-cols-2 gap-4">
                <div class="col-span-2">
                    <label class="text-gray-600">Student Name:</label>
                    <p>{{ $applicant->full_name }}</p>
                </div>
                <div>
                    <label class="text-gray-600">Sex:</label>
                    <p>{{ $applicant->gender }}</p>
                </div>
                <div>
                    <label class="text-gray-600">Age:</label>
                    <p>{{ $applicant->age }}</p>
                </div>
                <div>
                    <label class="text-gray-600">Date of Birth:</label>
                    <p>{{ $applicant->applicant_date_birth->format('F d, Y') }}</p>
                </div>
                <div>
                    <label class="text-gray-600">Place of Birth:</label>
                    <p>{{ $applicant->applicant_place_birth }}</p>
                </div>
                <div>
                    <label class="text-gray-600">Nationality:</label>
                    <p>{{ $applicant->applicant_nationality }}</p>
                </div>
                <div>
                    <label class="text-gray-600">Religion:</label>
                    <p>{{ $applicant->applicant_religion }}</p>
                </div>
                <div class="col-span-2">
                    <label class="text-gray-600">Address:</label>
                    <p>{{ $applicant->applicant_address_street }}, {{ $applicant->applicant_address_city }}, {{ $applicant->applicant_address_province }}</p>
                </div>
                <div>
                    <label class="text-gray-600">Tel. No:</label>
                    <p>{{ $applicant->applicant_tel_no }}</p>
                </div>
                <div>
                    <label class="text-gray-600">Mobile No:</label>
                    <p>{{ $applicant->applicant_mobile_number }}</p>
                </div>
                <div>
                    <label class="text-gray-600">Email:</label>
                    <p>{{ $applicant->user->email }}</p>
                </div>
            </div>
        </div>

        <!-- Educational Background -->
        <div class="mb-8">
            <h2 class="text-lg font-semibold mb-4 bg-gray-200 p-2">Educational Background</h2>
            <div class="grid grid-cols-2 gap-4">
                <div>
                    <label class="text-gray-600">LRN:</label>
                    <p>{{ $applicant->lrn }}</p>
                </div>
                <div>
                    <label class="text-gray-600">School Name:</label>
                    <p>{{ $applicant->school_name }}</p>
                </div>
                <div class="col-span-2">
                    <label class="text-gray-600">School Address:</label>
                    <p>{{ $applicant->school_address }}</p>
                </div>
                <div>
                    <label class="text-gray-600">Academic Program:</label>
                    <p>{{ $applicant->previous_program }}</p>
                </div>
                <div>
                    <label class="text-gray-600">Year of Graduation:</label>
                    <p>{{ $applicant->year_of_graduation }}</p>
                </div>
                <div>
                    <label class="text-gray-600">Awards/Honors:</label>
                    <p>{{ $applicant->awards_honors }}</p>
                </div>
                <div>
                    <label class="text-gray-600">GWA:</label>
                    <p>{{ $applicant->gwa }}</p>
                </div>
            </div>
        </div>

        <!-- Family Information -->
        <div class="mb-8">
            <h2 class="text-lg font-semibold mb-4 bg-gray-200 p-2">Family Information</h2>
            
            <!-- Father's Information -->
            <div class="grid grid-cols-2 gap-4 mb-4">
                <div>
                    <label class="text-gray-600">Father's Name:</label>
                    <p>{{ $applicant->father_name }}</p>
                </div>
                <div>
                    <label class="text-gray-600">Occupation:</label>
                    <p>{{ $applicant->father_occupation }}</p>
                </div>
                <div class="col-span-2">
                    <label class="text-gray-600">Contact No:</label>
                    <p>{{ $applicant->father_contact }}</p>
                </div>
            </div>

            <!-- Mother's Information -->
            <div class="grid grid-cols-2 gap-4 mb-4">
                <div>
                    <label class="text-gray-600">Mother's Name:</label>
                    <p>{{ $applicant->mother_name }}</p>
                </div>
                <div>
                    <label class="text-gray-600">Occupation:</label>
                    <p>{{ $applicant->mother_occupation }}</p>
                </div>
                <div class="col-span-2">
                    <label class="text-gray-600">Contact No:</label>
                    <p>{{ $applicant->mother_contact }}</p>
                </div>
            </div>

            <!-- Siblings Information -->
            <div class="mt-4">
                <label class="text-gray-600">Siblings:</label>
                @if($applicant->siblings)
                    <div class="mt-2 overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Full Name</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Date of Birth</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Age</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Grade Level</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">School Attended</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                @foreach(json_decode($applicant->siblings) as $sibling)
                                    <tr>
                                        <td class="px-6 py-4">{{ $sibling->full_name }}</td>
                                        <td class="px-6 py-4">{{ $sibling->date_of_birth }}</td>
                                        <td class="px-6 py-4">{{ $sibling->age }}</td>
                                        <td class="px-6 py-4">{{ $sibling->grade_level }}</td>
                                        <td class="px-6 py-4">{{ $sibling->school_attended }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @else
                    <p class="mt-2 text-gray-500">No siblings information provided</p>
                @endif
            </div>
        </div>

        <!-- Emergency Contacts -->
        <div class="mb-8">
            <h2 class="text-lg font-semibold mb-4 bg-gray-200 p-2">Emergency Contacts</h2>
            <div class="grid grid-cols-2 gap-4">
                <div class="col-span-2">
                    <label class="text-gray-600">Complete Name:</label>
                    <p>{{ $applicant->emergency_contact_name }}</p>
                </div>
                <div class="col-span-2">
                    <label class="text-gray-600">Complete Address:</label>
                    <p>{{ $applicant->emergency_contact_address }}</p>
                </div>
                <div>
                    <label class="text-gray-600">Tel. No:</label>
                    <p>{{ $applicant->emergency_contact_tel }}</p>
                </div>
                <div>
                    <label class="text-gray-600">Mobile No:</label>
                    <p>{{ $applicant->emergency_contact_mobile }}</p>
                </div>
                <div>
                    <label class="text-gray-600">Email:</label>
                    <p>{{ $applicant->emergency_contact_email }}</p>
                </div>
            </div>
        </div>

        <!-- Action Buttons -->
        @if($applicant->status === 'new')
        <div class="flex justify-end space-x-4">
            <form action="{{ route('admission.update-status', $applicant->id) }}" method="POST" class="inline">
                @csrf
                @method('PATCH')
                <input type="hidden" name="status" value="rejected">
                <button type="submit" class="bg-red-500 text-white px-4 py-2 rounded hover:bg-red-600">
                    Reject
                </button>
            </form>
            <form action="{{ route('admission.update-status', $applicant->id) }}" method="POST" class="inline">
                @csrf
                @method('PATCH')
                <input type="hidden" name="status" value="accepted">
                <button type="submit" class="bg-green-500 text-white px-4 py-2 rounded hover:bg-green-600">
                    Accept
                </button>
            </form>
        </div>
        @endif
    </div>
</div>
@endsection
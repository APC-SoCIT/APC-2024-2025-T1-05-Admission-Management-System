@extends('dashboard')
@section('title', 'View Application | InnolabAMS')

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

    <div class="bg-white rounded-lg shadow-lg p-6 mb-6">
        <!-- Status Section -->
        <div class="mb-6 flex justify-end">
            <div class="inline-flex items-center px-4 py-2 bg-{{ $applicant->status === 'new' ? 'blue' : ($applicant->status === 'accepted' ? 'green' : 'red') }}-500 rounded-full text-white">
                {{ ucfirst($applicant->status) }}
            </div>
        </div>

        <!-- Personal Information -->
        <div class="mb-8">
            <h2 class="text-xl font-semibold mb-4 pb-2 border-b">Personal Information</h2>
            <div class="grid grid-cols-2 md:grid-cols-3 gap-6">
                <div>
                    <label class="block text-sm font-medium text-gray-700">Full Name</label>
                    <p class="mt-1">{{ $applicant->full_name }}</p>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700">Gender</label>
                    <p class="mt-1">{{ $applicant->gender }}</p>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700">Date of Birth</label>
                    <p class="mt-1">{{ $applicant->applicant_date_birth->format('F d, Y') }}</p>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700">Place of Birth</label>
                    <p class="mt-1">{{ $applicant->applicant_place_birth }}</p>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700">Nationality</label>
                    <p class="mt-1">{{ $applicant->applicant_nationality }}</p>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700">Religion</label>
                    <p class="mt-1">{{ $applicant->applicant_religion ?? 'Not specified' }}</p>
                </div>
            </div>
        </div>

        <!-- Contact Information -->
        <div class="mb-8">
            <h2 class="text-xl font-semibold mb-4 pb-2 border-b">Contact Information</h2>
            <div class="grid grid-cols-2 md:grid-cols-3 gap-6">
                <div>
                    <label class="block text-sm font-medium text-gray-700">Mobile Number</label>
                    <p class="mt-1">{{ $applicant->applicant_mobile_number }}</p>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700">Email</label>
                    <p class="mt-1">{{ $applicant->user->email }}</p>
                </div>
                <div class="col-span-2">
                    <label class="block text-sm font-medium text-gray-700">Complete Address</label>
                    <p class="mt-1">
                        {{ $applicant->applicant_address_street }}, 
                        {{ $applicant->applicant_address_city }}, 
                        {{ $applicant->applicant_address_province }}
                    </p>
                </div>
            </div>
        </div>

        <!-- Educational Information -->
        <div class="mb-8">
            <h2 class="text-xl font-semibold mb-4 pb-2 border-b">Educational Information</h2>
            <div class="grid grid-cols-2 md:grid-cols-3 gap-6">
                <div>
                    <label class="block text-sm font-medium text-gray-700">Program Applied</label>
                    <p class="mt-1">{{ $applicant->apply_program }}</p>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700">Grade Level</label>
                    <p class="mt-1">{{ $applicant->apply_grade_level }}</p>
                </div>
                @if($applicant->apply_strand)
                <div>
                    <label class="block text-sm font-medium text-gray-700">Strand</label>
                    <p class="mt-1">{{ $applicant->apply_strand }}</p>
                </div>
                @endif
            </div>
        </div>

        <!-- Action Buttons -->
        @if($applicant->status === 'new')
        <div class="flex justify-end space-x-4 mt-6">
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
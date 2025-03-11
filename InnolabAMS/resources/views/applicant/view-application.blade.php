@extends('portal')

@section('content')
<div class="container mx-auto px-6 py-4">
    <div class="flex justify-between items-center mb-4">
        <h1 class="text-2xl font-semibold">My Application</h1>
        <a href="{{ route('portal') }}" class="bg-gray-500 text-white px-4 py-2 rounded hover:bg-gray-600">
            <i class="fas fa-arrow-left mr-2"></i>Back
        </a>
    </div>

    <div class="bg-white rounded-lg shadow-lg p-6">
        @if(session('success'))
            <div class="bg-green-50 text-green-700 p-4 rounded mb-6">
                {{ session('success') }}
            </div>
        @endif

        <!-- Application Status Banner -->
        <div class="mb-6 p-4 rounded-lg {{ $applicant->status === 'new' ? 'bg-blue-50 text-blue-700' : ($applicant->status === 'accepted' ? 'bg-green-50 text-green-700' : 'bg-red-50 text-red-700') }}">
            <div class="flex items-center">
                <span class="mr-2">
                    @if($applicant->status === 'new')
                        <i class="fas fa-clock"></i>
                    @elseif($applicant->status === 'accepted')
                        <i class="fas fa-check-circle"></i>
                    @else
                        <i class="fas fa-times-circle"></i>
                    @endif
                </span>
                <div>
                    <h3 class="font-bold">
                        Status: {{ ucfirst($applicant->status) }}
                    </h3>
                    <p>
                        @if($applicant->status === 'new')
                            Your application is being reviewed.
                        @elseif($applicant->status === 'accepted')
                            Congratulations! Your application has been accepted.
                            @if($applicant->acceptance_message)
                                <br>{{ $applicant->acceptance_message }}
                            @endif
                        @else
                            Your application was not approved.
                            @if($applicant->rejection_reason)
                                <br>Reason: {{ $applicant->rejection_reason }}
                            @endif
                        @endif
                    </p>
                </div>
            </div>
        </div>

        <!-- Application Details -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <!-- Left Column -->
            <div>
                <h2 class="text-xl font-semibold mb-4 pb-2 border-b">Program Information</h2>
                <dl class="mb-6">
                    <div class="grid grid-cols-3 py-2 border-b">
                        <dt class="font-medium">Program:</dt>
                        <dd class="col-span-2">{{ $applicant->apply_program }}</dd>
                    </div>
                    <div class="grid grid-cols-3 py-2 border-b">
                        <dt class="font-medium">Grade Level:</dt>
                        <dd class="col-span-2">{{ $applicant->apply_grade_level }}</dd>
                    </div>
                    @if($applicant->apply_strand)
                    <div class="grid grid-cols-3 py-2 border-b">
                        <dt class="font-medium">Strand:</dt>
                        <dd class="col-span-2">{{ $applicant->apply_strand }}</dd>
                    </div>
                    @endif
                    <div class="grid grid-cols-3 py-2 border-b">
                        <dt class="font-medium">Student Type:</dt>
                        <dd class="col-span-2">{{ $applicant->student_type }}</dd>
                    </div>
                </dl>

                <h2 class="text-xl font-semibold mb-4 pb-2 border-b">Personal Information</h2>
                <dl class="mb-6">
                    <div class="grid grid-cols-3 py-2 border-b">
                        <dt class="font-medium">Name:</dt>
                        <dd class="col-span-2">{{ $applicant->full_name }}</dd>
                    </div>
                    <!-- Add other personal details -->
                </dl>

                <!-- Additional sections as needed -->
            </div>

            <!-- Right Column -->
            <div>
                <h2 class="text-xl font-semibold mb-4 pb-2 border-b">Submitted Documents</h2>
                <div class="space-y-4">
                    @php
                        $documents = [
                            'birth_certificate' => 'Birth Certificate',
                            'form_137' => 'Form 137',
                            'form_138' => 'Form 138 (Report Card)',
                            'id_picture' => '2x2 ID Picture',
                            'good_moral' => 'Good Moral Character'
                        ];
                    @endphp

                    @foreach($documents as $key => $label)
                        @php
                            $path = $key . '_path';
                        @endphp
                        <div class="flex justify-between items-center">
                            <span>{{ $label }}:</span>
                            @if($applicant->$path)
                                <a href="{{ route('admission.download-file', ['id' => $applicant->id, 'documentType' => $key]) }}"
                                   class="text-blue-600 hover:text-blue-800 flex items-center">
                                    <i class="fas fa-download mr-2"></i> Download
                                </a>
                            @else
                                <span class="text-gray-500">Not uploaded</span>
                            @endif
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
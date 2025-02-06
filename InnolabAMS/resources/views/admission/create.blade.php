@extends('dashboard')
@section('title', 'Add Applicant | InnolabAMS')

@section('content')
    <div class="container mx-auto px-6 py-4">
        <div class="flex justify-between items-center mb-4">
            <h1 class="text-2xl font-semibold">Add New Applicant</h1>
            <a href="{{ route('admission.new') }}" class="bg-gray-500 text-white px-4 py-2 rounded hover:bg-gray-600">
                <i class="fas fa-arrow-left mr-2"></i>Back
            </a>
        </div>

        @livewire('admission.create-application')
    </div>
@endsection

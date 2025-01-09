@extends('layouts.app')

@section('header')
    <div class="flex items-center justify-between">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('New Applications') }}
        </h2>
    </div>
@endsection

@section('content')
<div class="py-6">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <div id="react-applicants-list"></div>
        </div>
    </div>
</div>

@push('scripts')
<script>
    // This will be where we mount our React component
    const applicantsListContainer = document.getElementById('react-applicants-list');
    if (applicantsListContainer) {
        // React mounting code will go here
    }
</script>
@endpush
@endsection
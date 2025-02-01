@extends('layouts.app')

@section('title', 'Applicants | InnolabAMS')

@section('content')
    <div class="container mx-auto px-4 py-6">
        <livewire:applicants-table />
    </div>
@endsection

@push('scripts')
    @livewireScripts
@endpush

@push('styles')
    @livewireStyles
@endpush

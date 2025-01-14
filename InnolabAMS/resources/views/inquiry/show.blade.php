@extends('dashboard') <!-- Use the dashboard layout -->

@section('content') <!-- Define the content section -->
<div class="flex justify-between items-center mb-4">
    <h1 class="text-2xl font-semibold mx-4 my-4">Inquiry details</h1>
    <p>Name: {{ $leadInfo->lead_surname }}, {{ $leadInfo->lead_given_name }}</p>
    <p>Email: {{ $leadInfo->lead_email }}</p>
    <p>Message: {{ $leadInfo->lead_message }}</p>

</div>

@endsection
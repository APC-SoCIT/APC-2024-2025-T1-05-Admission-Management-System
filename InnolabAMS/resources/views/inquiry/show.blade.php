@extends('dashboard') <!-- Use the dashboard layout -->

@section('content') <!-- Define the content section -->
<div class="container mt-5">
    <h1>Inquiry Details</h1>
    <table class="table table-bordered">
        <tr>
            <th>ID</th>
            <td>{{ $inquiry->id }}</td>
        </tr>
        <tr>
            <th>Lead ID</th>
            <td>{{ $inquiry->lead_id }}</td>
        </tr>
        <tr>
            <th>Admission Officer ID</th>
            <td>{{ $inquiry->admission_officer_id }}</td>
        </tr>
        <tr>
            <th>Submitted At</th>
            <td>{{ $inquiry->inquiry_submitted }}</td>
        </tr>
        <tr>
            <th>Email Address</th>
            <td>{{ $inquiry->details_sent }}</td>
        </tr>
        <tr>
            <th>Response Date</th>

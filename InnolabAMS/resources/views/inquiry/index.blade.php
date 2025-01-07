@extends('dashboard') <!-- Use the dashboard layout -->

@section('content') <!-- Define the content section -->
<div class="flex justify-between items-center mb-4">
    <h1 class="text-2xl font-semibold mx-4 my-4">Inquiries</h1>
</div>

<div class="container mt-5">
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Email Address</th>
                <th>Contact No.</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($inquiries as $inquiry)
                <tr>
                    <td>{{ $inquiry->id }}</td>
                    <td>{{ $inquiry->lead_id }}</td> <!-- Replace with actual name if applicable -->
                    <td>{{ $inquiry->details_sent }}</td> <!-- Replace with actual email -->
                    <td>{{ $inquiry->response_date }}</td> <!-- Replace with actual contact number -->
                    <td><a href="{{ route('inquiries.show', $inquiry->id) }}" class="btn btn-primary">View</a></td>
                </tr>
            @empty
                <tr>
                    <td colspan="5">No inquiries found.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
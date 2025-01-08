@extends('dashboard') <!-- Use the dashboard layout -->

@section('content') <!-- Define the content section -->
<div class="flex justify-between items-center mb-4">
    <h1 class="text-2xl font-semibold mx-4 my-4">Scholarship</h1>

    <div class="flex items-center space-x-4">
        <!-- Search Icon and Bar -->
        <div class="relative flex items-center">
            <button
                id="searchIcon"
                class="bg-gray-200 hover:bg-gray-300 text-gray-700 p-2 rounded-full focus:outline-none">
                <i class="fa-solid fa-magnifying-glass"></i>
            </button>
            <input
                type="text"
                id="searchBar"
                placeholder="Search..."
                class="absolute top-0 right-12 hidden bg-gray-100 text-gray-700 px-4 py-2 rounded-lg shadow-md w-64 focus:outline-none">
        </div>

        <!-- Sort Icon and Dropdown -->
        <div class="relative">
            <button
                id="sortIcon"
                class="bg-gray-200 hover:bg-gray-300 text-gray-700 p-2 rounded-full focus:outline-none">
                <i class="fa-solid fa-bars"></i>
            </button>
            <div
                id="sortDropdown"
                class="absolute right-0 mt-2 hidden bg-white border border-gray-300 rounded-lg shadow-lg w-40">
                <button
                    id="sortOldNew"
                    class="block w-full text-left px-4 py-2 hover:bg-gray-100">
                    Old - New
                </button>
                <button
                    id="sortNewOld"
                    class="block w-full text-left px-4 py-2 hover:bg-gray-100">
                    New - Old
                </button>
            </div>
        </div>
    </div>
</div>

<table class="min-w-full bg-white border border-gray-300">
    <thead>
        <tr>
            <th class="py-2 px-4 border-b text-left">ID</th>
            <th class="py-2 px-4 border-b text-left">Name</th>
            <th class="py-2 px-4 border-b text-left">Scholarship Type</th>
            <th class="py-2 px-4 border-b text-left">Discount</th>
            <th class="py-2 px-4 border-b text-left">Action</th>

        </tr>
    </thead>

    <tbody id="userTable">
        @forelse ($scholarships as $scholarship)
        <tr>
            <td class="py-2 px-4 border-b">{{ $scholarship->applicant_info_id }}</td>
            <td class="py-2 px-4 border-b">{{ $user->name }}</td>
            <td class="py-2 px-4 border-b">{{ $scholarship->scholarship_type }}</td>
            <td class="py-2 px-4 border-b">{{ $scholarship->discount_awarded }}</td>
        </tr>
        @empty
        <tr>
            <td colspan="5">No inquiries found.</td>
        </tr>
        @endforelse
    </tbody>

    @endsection
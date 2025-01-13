@section('title', 'Portal | InnolabAMS')
@extends('portal') <!-- Use the portal layout -->

@section('content') <!-- Define the content section -->
<div class="container mx-auto px-4 py-6">
    <!-- Header Section -->
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-2xl font-semibold">Scholarship</h1>
        
    </div>

    <!-- Informational Text -->
    <div class="mb-6">
        <p class="text-gray-600">
            Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut ac odio ut nunc varius dictum. Donec non lacus id mauris tincidunt pharetra vel eu augue.
        </p>
    </div>

    <!-- Form Section -->
    <div class="bg-white shadow rounded-lg p-6">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <!-- Current Scholarship -->
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Current Scholarship</label>
                <input type="text" class="w-full border-gray-300 rounded-lg shadow-sm" placeholder="Enter scholarship details">
            </div>

            <!-- Annual Household Income -->
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Annual Household Income</label>
                <select class="w-full border-gray-300 rounded-lg shadow-sm">
                    <option value="">Select income range</option>
                    <option value="below_poverty">Less than PHP 144,360 (Below poverty threshold)</option>
                    <option value="low_income">PHP 144,360 to PHP 250,000 (Entry-level workers)</option>
                    <option value="middle_income">PHP 250,001 to PHP 700,000 (Mid-level professionals)</option>
                    <option value="high_income">More Than   PHP 700,001 (High-level professionals)</option>
                </select>
            </div>
        </div>

        <!-- Signatures Section -->
        <div class="grid grid-cols-2 gap-6 mt-6">
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Applicant Signature</label>
                <div class="border border-gray-300 rounded-lg p-4 text-center">
                    <p class="text-gray-500">Signature Placeholder</p>
                </div>
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Parent Signature</label>
                <div class="border border-gray-300 rounded-lg p-4 text-center">
                    <p class="text-gray-500">Signature Placeholder</p>
                </div>
            </div>
        </div>

        <!-- Submit Button -->
        <div class="mt-6 flex justify-end">
            <button class="px-4 py-2 bg-blue-600 text-white font-semibold rounded-lg shadow hover:bg-blue-700">
                Submit
            </button>
        </div>
    </div>
</div>
@endsection

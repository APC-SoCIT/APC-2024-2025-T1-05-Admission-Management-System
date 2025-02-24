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
                <label class="block text-sm font-medium text-gray-700">Current Scholarship <span class="text-red-500">*</span></label>
                <input type="text"
                       name="current_scholarship"
                       class="w-full border-gray-300 rounded-lg shadow-sm"
                       placeholder="Enter scholarship details"
                       required>
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
                <label class="block text-sm font-medium text-gray-700">Applicant Signature <span class="text-red-500">*</span></label>
                <input type="file"
                       name="applicant_signature"
                       accept=".pdf,.jpg,.jpeg,.png"
                       required
                       class="mt-1 block w-full text-sm text-gray-500
                              file:mr-4 file:py-2 file:px-4
                              file:rounded-md file:border-0
                              file:text-sm file:font-semibold
                              file:bg-blue-50 file:text-blue-700
                              hover:file:bg-blue-100">
                <p class="mt-1 text-sm text-gray-500">Accepted formats: PDF, JPG, JPEG, PNG (Max: 2MB)</p>
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700">Parent Signature <span class="text-red-500">*</span></label>
                <input type="file"
                       name="parent_signature"
                       accept=".pdf,.jpg,.jpeg,.png"
                       required
                       class="mt-1 block w-full text-sm text-gray-500
                              file:mr-4 file:py-2 file:px-4
                              file:rounded-md file:border-0
                              file:text-sm file:font-semibold
                              file:bg-blue-50 file:text-blue-700
                              hover:file:bg-blue-100">
                <p class="mt-1 text-sm text-gray-500">Accepted formats: PDF, JPG, JPEG, PNG (Max: 2MB)</p>
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

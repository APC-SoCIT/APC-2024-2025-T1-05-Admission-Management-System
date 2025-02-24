@section('title', 'Portal | InnolabAMS')
@extends('portal')

@section('content')
<div class="container mx-auto px-4 py-6">
    <!-- Header Section -->
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-2xl font-semibold">Scholarship</h1>
    </div>

    <!-- Success/Error Messages at the top level only -->
    @if(session('success'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4" role="alert">
            <span class="block sm:inline">{{ session('success') }}</span>
            <span class="absolute top-0 bottom-0 right-0 px-4 py-3">
                <button type="button" class="text-green-700" onclick="this.parentElement.parentElement.style.display='none'">
                    <span class="text-2xl">&times;</span>
                </button>
            </span>
        </div>
    @endif

    @if(session('error'))
        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4" role="alert">
            <span class="block sm:inline">{{ session('error') }}</span>
            <span class="absolute top-0 bottom-0 right-0 px-4 py-3">
                <button type="button" class="text-red-700" onclick="this.parentElement.parentElement.style.display='none'">
                    <span class="text-2xl">&times;</span>
                </button>
            </span>
        </div>
    @endif

    <!-- Form Description -->
    <p class="text-gray-600 mb-6">
        Please complete this scholarship application form accurately. Your current scholarship status and household income information will help us evaluate your eligibility for financial assistance. Required documents must be submitted in PDF, JPG, JPEG, or PNG format.
    </p>

    <!-- Form Section -->
    <div class="bg-white shadow rounded-lg p-6">
        <form action="{{ route('scholarship.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
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
                    <select name="annual_household_income" class="w-full border-gray-300 rounded-lg shadow-sm" required>
                        <option value="">Select income range</option>
                        <option value="Below 150,000">Less than PHP 144,360 (Below poverty threshold)</option>
                        <option value="150,000 - 300,000">PHP 144,360 to PHP 250,000 (Entry-level workers)</option>
                        <option value="300,001 - 500,000">PHP 250,001 to PHP 700,000 (Mid-level professionals)</option>
                        <option value="Above 500,000">More Than PHP 700,001 (High-level professionals)</option>
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
                <button type="submit" class="px-4 py-2 bg-blue-600 text-white font-semibold rounded-lg shadow hover:bg-blue-700">
                    Submit
                </button>
            </div>
        </form>
    </div>
</div>
@endsection

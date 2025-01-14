@extends('layouts.inquiry_form')

@section('content')
<!-- Inquiry Form -->
<div class="container mx-auto p-4 bg-white shadow-md rounded">
    <h1 class="text-2xl font-bold mb-4">Inquiry Form</h1>

    <!-- Flash Messages -->
    @if(session('success'))
        <div class="bg-green-100 text-green-800 px-4 py-2 rounded mb-4">
            {{ session('success') }}
        </div>
    @endif

    @if($errors->any())
        <div class="bg-red-100 text-red-800 px-4 py-2 rounded mb-4">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <!-- Form -->
    <form action="{{ route('lead_info.store') }}" method="POST">
        @csrf

        <!-- First Name -->
        <div class="mb-4">
            <label for="lead_given_name" class="block font-medium">First Name</label>
            <input type="text" id="lead_given_name" name="lead_given_name" required class="w-full p-2 border rounded">
        </div>

        <!-- Last Name -->
        <div class="mb-4">
            <label for="lead_surname" class="block font-medium">Last Name</label>
            <input type="text" id="lead_surname" name="lead_surname" required class="w-full p-2 border rounded">
        </div>

        <!-- Middle Name -->
        <div class="mb-4">
            <label for="lead_middle_name" class="block font-medium">Middle Name</label>
            <input type="text" id="lead_middle_name" name="lead_middle_name" class="w-full p-2 border rounded">
        </div>

        <!-- Email -->
        <div class="mb-4">
            <label for="lead_email" class="block font-medium">Email</label>
            <input type="email" id="lead_email" name="lead_email" required class="w-full p-2 border rounded">
        </div>

        <!-- Contact Number -->
        <div class="mb-4">
            <label for="lead_mobile_number" class="block font-medium">Mobile Number</label>
            <input type="text" id="lead_mobile_number" name="lead_mobile_number" maxlength="13" required
                class="w-full p-2 border rounded">
        </div>

        <!-- City -->
        <div class="mb-4">
            <label for="lead_address_city" class="block font-medium">City</label>
            <input type="text" id="lead_address_city" name="lead_address_city" class="w-full p-2 border rounded">
        </div>

        <!-- Inquiry Details -->
        <div class="mb-4">
            <label for="inquired_details" class="block font-medium">What details would you like to know?</label>
            <select id="inquired_details" name="inquired_details" required class="w-full p-2 border rounded">
                <option value="OPTION_1">OPTION 1</option>
                <option value="OPTION_2">OPTION 2</option>
                <option value="OPTION_3">OPTION 3</option>
            </select>

        </div>

        <!-- Message -->
        <div class="mb-4">
            <label for="lead_message" class="block font-medium">Message</label>
            <textarea id="lead_message" name="lead_message" rows="4" class="w-full p-2 border rounded"></textarea>
        </div>

        <!-- How Did You Learn About Us -->
        <div class="mb-4">
            <label class="block font-medium">How did you learn about us?</label>
            <div class="flex items-center space-x-4">
                <div>
                    <input type="checkbox" id="source_social_media" name="source[]" value="Social Media" class="mr-2">
                    <label for="source_social_media">Social Media</label>
                </div>
                <div>
                    <input type="checkbox" id="source_website" name="source[]" value="Website" class="mr-2">
                    <label for="source_website">Website</label>
                </div>
                <div>
                    <input type="checkbox" id="source_referral" name="source[]" value="Referral" class="mr-2">
                    <label for="source_referral">Referral</label>
                </div>
            </div>
        </div>

        <div class="mb-4">
            <div class="flex items-center">
                <input type="checkbox" id="data_privacy" name="data_privacy" class="mr-2">
                <label for="data_privacy" class="font-medium">I agree to the <a href="#" target="_blank" class="text-blue-500 underline">Data Privacy Act</a>.</label>
            </div>
        </div>

        <!-- Submit Button -->
        <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-700">
            Submit
        </button>
    </form>
</div>
@endsection
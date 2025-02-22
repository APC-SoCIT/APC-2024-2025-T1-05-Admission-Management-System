@extends('layouts.inquiry_form')

@section('content')
<!-- Inquiry Form -->
<div class="container mx-auto p-4 bg-white shadow-md rounded">
    <h1 class="text-2xl font-bold mb-4">Inquiry Form</h1>

<<<<<<< HEAD
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
=======
    <div class="container">
        <h1 class="text-2xl font-bold">Inquiry Form</h1>

        <form action="{{ route('lead_info.store') }}" method="POST">
            @csrf

            <div class="form-group">
                <label>First Name <span class="required">*</span></label>
                <input type="text" name="lead_given_name">
            </div>

            <div class="form-group">
                <label>Last Name <span class="required">*</span></label>
                <input type="text" name="lead_surname">
            </div>

            <div class="form-group">
                <label>Middle Name</label>
                <input type="text" name="lead_middle_name">
            </div>

            <div class="form-group">
                <label>Email <span class="required">*</span></label>
                <input type="email" name="lead_email" required placeholder="example@email.com">
            </div>

            <div class="form-group">
                <label>Mobile Number <span class="required">*</span></label>
                <input type="text" name="lead_mobile_number" maxlength="13" required placeholder="09XX-XXX-XXXX">
            </div>

            <div class="form-group">
                <label>City <span class="required">*</span></label>
                <input type="text" name="lead_address_city">
            </div>

            <!-- Updated Inquiry Details -->
            <div class="form-group">
                <label>What details would you like to know? <span class="required">*</span></label>
                <select name="inquired_details" required>
                    <option value="">Select an option</option>
                    <option value="Application Requirements">Application Requirements</option>
                    <option value="Application Process">Application Process</option>
                    <option value="Tuition Fees">Tuition Fees</option>
                    <option value="Scholarship Opportunities">Scholarship Opportunities</option>
                    <option value="Program Offerings">Program Offerings</option>
                    <option value="Admission Deadlines">Admission Deadlines</option>
                    <option value="Others">Others</option>
                </select>
            </div>

            <div class="form-group">
                <label>Message</label>
                <textarea name="lead_message" rows="4" placeholder="Write your message here..."></textarea>
            </div>

            <!-- Updated Extracurricular Interests (Changed to VARCHAR 255) -->
            <div class="form-group">
                <label>Extracurricular Interest</label>
                <input type="text" name="extracurricular_interest_lead" placeholder="Enter your interest">
            </div>

            <!-- Updated Skills Dropdown -->
            <div class="form-group">
                <label>Skills</label>
                <select name="skills_lead" id="skills_lead">
                    <option value="">Select a Skill</option>
                    <option value="Communication">Communication</option>
                    <option value="Teamwork">Teamwork</option>
                    <option value="Leadership">Leadership</option>
                    <option value="Problem-Solving">Problem-Solving</option>
                    <option value="Time Management">Time Management</option>
                    <option value="Creativity">Creativity</option>
                    <option value="Adaptability">Adaptability</option>
                    <option value="Technology-related">Technology-related</option>
                    <option value="Others">Others</option>
                </select>
            </div>

            <!-- The field to input other skills; hidden by default -->
            <div class="form-group" id="other_skills_container" style="display: none;">
                <label for="other_skills_lead">Please specify your other skills</label>
                <input type="text" name="other_skills_lead" id="other_skills_lead" class="form-control"
                    placeholder="Enter your skills">
            </div>

            <div class="form-group">
                <label>Desired Career</label>
                <input type="text" name="desired_career" placeholder="Enter your career interest">
            </div>

            <!-- How Did You Learn About Us -->
            <div class="form-group mt-4">
                <label>How did you learn about us?</label>
                <div class="flex flex-col mt-2">
                    <label class="inline-flex items-center">
                        <input type="checkbox" name="source[]" value="Social Media"
                            class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500">
                        <span class="ms-2 text-gray-700">Social Media</span>
                    </label>
                    <label class="inline-flex items-center">
                        <input type="checkbox" name="source[]" value="Website"
                            class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500">
                        <span class="ms-2 text-gray-700">Website</span>
                    </label>
                    <label class="inline-flex items-center">
                        <input type="checkbox" name="source[]" value="Referral"
                            class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500">
                        <span class="ms-2 text-gray-700">Referral</span>
                    </label>
                </div>
            </div>


            <!-- Data Privacy Agreement -->
            <div class="mt-6 form-group">
                <label for="data_privacy" class="inline-flex items-center">
                    <input id="data_privacy" type="checkbox" required
                        class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500">
                    <span class="ms-2 text-m text-gray">
                        I agree to the
                        <a href="#" onclick="openPrivacyPolicy()" class="text-blue-500 underline">
                            Data Privacy Policy
                        </a>.
                    </span>
                </label>
>>>>>>> app_rc_jd_mp
            </div>

<<<<<<< HEAD
        <!-- Submit Button -->
        <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-700">
            Submit
        </button>
    </form>
</div>
=======
            <div class="flex justify-end mt-4">
                <x-primary-button class="ms-3">
                    {{ __('Submit') }}
                </x-primary-button>
            </div>
        </form>
    </div>

    <!-- SweetAlert2 notification -->
    @if(session('success'))
        <script>
            Swal.fire({
                icon: 'success',
                title: 'Success!',
                text: '{{ session("success") }}',
                showConfirmButton: true,
                confirmButtonText: 'OK',
                customClass: {
                    confirmButton: 'swal2-confirm-blue'
                },
                buttonsStyling: false
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location.href = "{{ route('login') }}";
                }
            });
        </script>
    @endif


>>>>>>> app_rc_jd_mp
@endsection
@extends('layouts.inquiry_form')

@section('content')

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
                <input type="email" name="lead_email" require placeholder="example@email.com">
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
                <label>Message <span class="required">*</span></label>
                <textarea name="lead_message" rows="4" required placeholder="Write your message here..."></textarea>
            </div>

            <!-- Updated Extracurricular Interests (Changed to VARCHAR 255) -->
            <div class="form-group">
                <label>Extracurricular Interest <span class="required">*</span></label>
                <input type="text" name="extracurricular_interest_lead" required placeholder="Enter your interest">
            </div>

            <!-- Updated Skills Dropdown -->
            <div class="form-group">
                <label>Skills <span class="required">*</span></label>
                <select name="skills_lead" required>
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

            <div class="form-group">
                <label>Desired Career</label>
                <input type="text" name="desired_career" placeholder="Enter your career interest">
            </div>

            <!-- How Did You Learn About Us -->
            <div class="form-group">
                <label>How did you learn about us? <span class="required">*</span></label>
                <div class="checkbox-group">
                    <input type="checkbox" name="source[]" value="Social Media">
                    <label>Social Media</label>
                </div>
                <div class="checkbox-group">
                    <input type="checkbox" name="source[]" value="Website">
                    <label>Website</label>
                </div>
                <div class="checkbox-group">
                    <input type="checkbox" name="source[]" value="Referral">
                    <label>Referral</label>
                </div>
            </div>

            <!-- Data Privacy Agreement -->
            <div class="form-group">
                <div class="checkbox-group">
                    <input type="checkbox" id="data_privacy" name="data_privacy" required>
                    <label for="data_privacy">
                        I agree to the <a href="#" onclick="openPrivacyPolicy()" class="text-blue-500 underline">Data
                            Privacy Act</a>.
                    </label>
                </div>
            </div>

            <div class="flex justify-end mt-4">
                <x-primary-button class="ms-3">
                    {{ __('Submit') }}
                </x-primary-button>
            </div>
        </form>
    </div>

@endsection
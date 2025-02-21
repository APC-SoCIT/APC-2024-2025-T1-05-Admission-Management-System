@extends('layouts.inquiry_form')

@section('content')

<<<<<<< HEAD
<<<<<<< HEAD
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
=======
    <!-- Flash Messages -->
    @if(session('success'))
        <div class="bg-green-100 text-green-800 px-4 py-2 rounded mb-4">
            {{ session('success') }}
        </div>
    @endif
=======
<div class="container">
    <h1>Inquiry Form</h1>
>>>>>>> 3421222 (Revert "Merge branch 'admission_v3' of https://github.com/APC-SoCIT/APC-2024-2025-T1-05-Admission-Management-System into admission_v3")

    <form action="{{ route('lead_info.store') }}" method="POST">
        @csrf

        <div class="form-group">
            <label>First Name <span class="required">*</span></label>
            <input type="text" name="lead_given_name" required placeholder="Enter you first name">
        </div>

        <div class="form-group">
            <label>Last Name <span class="required">*</span></label>
            <input type="text" name="lead_surname" required placeholder="Enter you last name">
        </div>

        <div class="form-group">
            <label>Middle Name</label>
            <input type="text" name="lead_middle_name" placeholder="Enter you middle name">
        </div>

        <div class="form-group">
            <label>Email <span class="required">*</span></label>
            <input type="email" name="lead_email" require placeholder="example@email.com">
        </div>

        <div class="form-group">
            <label>Mobile Number <span class="required">*</span></label>
            <input type="text" name="lead_mobile_number" maxlength="13" required placeholder="(09XX-XXX-XXXX)">
        </div>

        <div class="form-group">
            <label>City <span class="required">*</span></label>
            <input type="text" name="lead_address_city" required placeholder="Where do you live?">
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

<<<<<<< HEAD
        <div class="mb-4">
            <div class="flex items-center">
                <input type="checkbox" id="data_privacy" name="data_privacy" class="mr-2">
                <label for="data_privacy" class="font-medium">I agree to the <a href="#" target="_blank" class="text-blue-500 underline">Data Privacy Act</a>.</label>
>>>>>>> 851876b (Revert "Merge branch 'feature/77_implement_admin_admission_management' of https://github.com/APC-SoCIT/APC-2024-2025-T1-05-Admission-Management-System into feature/77_implement_admin_admission_management")
=======
        <!-- Data Privacy Agreement -->
        <div class="form-group">
            <div class="checkbox-group">
                <input type="checkbox" id="data_privacy" name="data_privacy" required>
                <label for="data_privacy">
                    I agree to the <a href="#" onclick="openPrivacyPolicy()" class="text-blue-500 underline">Data Privacy Act</a>.
                </label>
>>>>>>> 3421222 (Revert "Merge branch 'admission_v3' of https://github.com/APC-SoCIT/APC-2024-2025-T1-05-Admission-Management-System into admission_v3")
            </div>

<<<<<<< HEAD
<<<<<<< HEAD
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


=======
        <!-- Submit Button -->
        <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-700">
            Submit
        </button>
    </form>
</div>
>>>>>>> 851876b (Revert "Merge branch 'feature/77_implement_admin_admission_management' of https://github.com/APC-SoCIT/APC-2024-2025-T1-05-Admission-Management-System into feature/77_implement_admin_admission_management")
=======
        <button type="submit">Submit</button>
    </form>
</div>

>>>>>>> 3421222 (Revert "Merge branch 'admission_v3' of https://github.com/APC-SoCIT/APC-2024-2025-T1-05-Admission-Management-System into admission_v3")
@endsection
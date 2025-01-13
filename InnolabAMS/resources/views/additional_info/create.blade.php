@section('title', 'Portal | InnolabAMS')
@extends('portal')

@section('content')
<!-- Previous button -->
<div class="mb-4">
    <a href="{{ route('form.personal_info') }}" 
       class="bg-gray-500 text-white px-6 py-2 rounded hover:bg-gray-600">
        Previous
    </a>
</div>

<div class="bg-white rounded-lg shadow-lg p-6">
    <form id="additionalInfoForm">
        <!-- Additional Information Section -->
        <div class="mb-6">
            <h2 class="text-lg font-semibold mb-4">Additional Information</h2>

            <!-- Hobbies Section -->
            <div class="mb-4">
                <label for="hobbies" class="block text-sm font-medium text-gray-700">Hobbies</label>
                <input type="text" name="hobbies" id="hobbies" 
                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"
                    value="{{ $additionalInfo->hobbies ?? '' }}">
            </div>

            <!-- Skills Section -->
            <div class="mb-4">
                <label for="skills" class="block text-sm font-medium text-gray-700">Skills</label>
                <input type="text" name="skills" id="skills" 
                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"
                    value="{{ $additionalInfo->skills ?? '' }}">
            </div>

            <!-- Extracurricular Interests -->
            <div class="mb-4">
                <label for="extracurricular_interest" class="block text-sm font-medium text-gray-700">Extracurricular Interests</label>
                <input type="text" name="extracurricular_interest" id="extracurricular_interest" 
                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"
                    value="{{ $additionalInfo->extracurricular_interest ?? '' }}">
            </div>
        </div>

        <!-- Emergency Contact Section -->
        <div class="mb-6">
            <h2 class="text-lg font-semibold mb-4">Emergency Contact Information</h2>
            
            <div class="space-y-4">
                <!-- Name -->
                <div>
                    <label for="emergency_contact_name" class="block text-sm font-medium text-gray-700">Name</label>
                    <input type="text" name="emergency_contact_name" id="emergency_contact_name" 
                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"
                        value="{{ $additionalInfo->emergency_contact_name ?? '' }}">
                </div>

                <!-- Address -->
                <div>
                    <label for="emergency_contact_address" class="block text-sm font-medium text-gray-700">Address</label>
                    <input type="text" name="emergency_contact_address" id="emergency_contact_address" 
                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"
                        value="{{ $additionalInfo->emergency_contact_address ?? '' }}">
                </div>

                <!-- Telephone -->
                <div>
                    <label for="emergency_contact_tel" class="block text-sm font-medium text-gray-700">Telephone</label>
                    <input type="text" name="emergency_contact_tel" id="emergency_contact_tel" 
                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"
                        value="{{ $additionalInfo->emergency_contact_tel ?? '' }}">
                </div>

                <!-- Mobile -->
                <div>
                    <label for="emergency_contact_mobile" class="block text-sm font-medium text-gray-700">Mobile</label>
                    <input type="text" name="emergency_contact_mobile" id="emergency_contact_mobile" 
                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"
                        value="{{ $additionalInfo->emergency_contact_mobile ?? '' }}">
                </div>

                <!-- Email -->
                <div>
                    <label for="emergency_contact_email" class="block text-sm font-medium text-gray-700">Email</label>
                    <input type="email" name="emergency_contact_email" id="emergency_contact_email" 
                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"
                        value="{{ $additionalInfo->emergency_contact_email ?? '' }}">
                </div>
            </div>
        </div>

        <!-- Save Button -->
        <div class="flex justify-end">
            <button type="submit" 
                class="bg-blue-500 text-white px-6 py-2 rounded hover:bg-blue-600">
                Submit
            </button>
        </div>
    </form>
</div>

@push('scripts')
<script>
document.getElementById('additionalInfoForm').addEventListener('submit', function(e) {
    e.preventDefault();
    
    const formData = new FormData(this);
    
    fetch('{{ route("additional_info.store") }}', {
        method: 'POST',
        body: formData,
        headers: {
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
        }
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            // Redirect to the next step
            window.location.href = data.redirect;
        } else {
            // Handle errors
            console.error('Save failed:', data.message);
        }
    })
    .catch(error => console.error('Error:', error));
});
</script>
@endpush

@endsection

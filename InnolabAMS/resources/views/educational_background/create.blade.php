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
    <form id="educationalBackgroundForm">
        <!-- LRN Section -->
        <div class="mb-6">
            <h2 class="text-lg font-semibold mb-6">Educational Background</h2>
        <div class="mb-6">
            <label for="lrn" class="block text-sm font-medium text-gray-700">LRN</label>
            <input type="text" name="lrn" id="lrn" 
                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"
                value="{{ $educationalBackground->lrn ?? '' }}">
        </div>

        <!-- Last School Attended Section -->
        <div class="mb-6">
            <h2 class="text-lg font-semibold mb-4">Last School Attended</h2>
            
            <div class="space-y-4">
                <div>
                    <label for="applicant_school_name" class="block text-sm font-medium text-gray-700">School Name</label>
                    <input type="text" name="applicant_school_name" id="applicant_school_name"
                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"
                        value="{{ $educationalBackground->applicant_school_name ?? '' }}">
                </div>

                <div>
                    <label for="applicant_school_address" class="block text-sm font-medium text-gray-700">School Address</label>
                    <input type="text" name="applicant_school_address" id="applicant_school_address"
                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"
                        value="{{ $educationalBackground->applicant_school_address ?? '' }}">
                </div>

                <div>
                    <label for="applicant_last_grade_level" class="block text-sm font-medium text-gray-700">Academic Program</label>
                    <select name="applicant_last_grade_level" id="applicant_last_grade_level"
                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                        <option value="">Select Grade Level</option>
                        @foreach(range(1, 12) as $grade)
                            <option value="{{ $grade }}" {{ ($educationalBackground->applicant_last_grade_level ?? '') == $grade ? 'selected' : '' }}>
                                Grade {{ $grade }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div>
                    <label for="applicant_year_graduation" class="block text-sm font-medium text-gray-700">Year of Graduation</label>
                    <input type="date" name="applicant_year_graduation" id="applicant_year_graduation"
                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"
                        value="{{ $educationalBackground->applicant_year_graduation ?? '' }}">
                </div>
            </div>
        </div>

        <!-- Academic Information Section -->
        <div class="mb-6">
            <h2 class="text-lg font-semibold mb-4">Academic Information</h2>
            
            <div class="space-y-4">
                <div>
                    <label for="applicant_gwa" class="block text-sm font-medium text-gray-700">GWA</label>
                    <input type="number" step="0.01" name="applicant_gwa" id="applicant_gwa"
                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"
                        value="{{ $educationalBackground->applicant_gwa ?? '' }}">
                </div>

                <div>
                    <label for="applicant_achievements" class="block text-sm font-medium text-gray-700">Awards/Honors</label>
                    <input type="text" name="applicant_achievements" id="applicant_achievements"
                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"
                        value="{{ $educationalBackground->applicant_achievements ?? '' }}">
                </div>

                <div>
                    <label for="applicant_last_grade_level" class="block text-sm font-medium text-gray-700">Last Grade/Level Attended</label>
                    <input type="text" name="applicant_last_grade_level" id="applicant_last_grade_level"
                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"
                        value="{{ $educationalBackground->applicant_last_grade_level ?? '' }}">
                </div>
            </div>
        </div>

        <!-- Save Button -->
        <div class="flex justify-end">
            <button type="submit" 
                class="bg-blue-500 text-white px-6 py-2 rounded hover:bg-blue-600">
                Save
            </button>
        </div>
    </form>
</div>

@push('scripts')
<script>
document.getElementById('educationalBackgroundForm').addEventListener('submit', function(e) {
    e.preventDefault();
    
    const formData = new FormData(this);
    
    fetch('{{ route("educational-background.store") }}', {
        method: 'POST',
        body: formData,
        headers: {
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
        }
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            // Redirect to next step
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
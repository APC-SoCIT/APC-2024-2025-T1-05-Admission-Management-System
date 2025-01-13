@section('title', 'Portal | InnolabAMS')
@extends('portal')

@section('content')
<div class="flex justify-between items-center mb-4">
    <h1 class="text-2xl font-semibold mx-4 my-4">Family Information</h1>
</div>

<!-- Previous button outside the form -->
<div class="mb-4">
    <a href="{{ route('form.personal_info') }}" 
       class="bg-gray-500 text-white px-6 py-2 rounded hover:bg-gray-600">
        Previous
    </a>
</div>

<div class="bg-white rounded-lg shadow-lg p-6">
    <!-- Parent Information Form -->
    <form id="parentForm" class="mb-8">
        <!-- Father's Section -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8">
            <div class="md:col-span-2">
                <label class="block text-sm font-medium text-gray-700">Father's Name</label>
                <input type="text" name="father_name" 
                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700">Contact Number</label>
                <input type="text" name="father_contact_num"
                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700">Occupation</label>
                <input type="text" name="father_occupation"
                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
            </div>
        </div>

        <!-- Mother's Section -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div class="md:col-span-2">
                <label class="block text-sm font-medium text-gray-700">Mother's Name</label>
                <input type="text" name="mother_name" 
                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700">Contact Number</label>
                <input type="text" name="mother_contact_num"
                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700">Occupation</label>
                <input type="text" name="mother_occupation"
                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
            </div>
        </div>
    </form>

<!-- Guardian Information Form -->
<form id="guardianForm" class="mt-8 mb-8">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div class="md:col-span-2">
                <label class="block text-sm font-medium text-gray-700">Guardian's Name</label>
                <input type="text" name="guardian_name" 
                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
            </div>
            
            <div>
                <label class="block text-sm font-medium text-gray-700">Street Number</label>
                <input type="text" name="guardian_street_number"
                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700">Barangay</label>
                <input type="text" name="guardian_barangay"
                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700">City</label>
                <input type="text" name="guardian_city"
                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700">Telephone Number</label>
                <input type="text" name="guardian_telephone"
                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700">Mobile Number</label>
                <input type="text" name="guardian_mobile"
                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700">Email</label>
                <input type="email" name="guardian_email"
                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
            </div>
        </div>
    </form>

    <!-- Siblings Information Form -->
    <form id="siblingsForm" class="mt-8">
        <h2 class="text-xl font-semibold mb-4">Sibling Information</h2>
        
        <button type="button" id="add-sibling" 
            class="mb-4 px-4 py-2 bg-blue-500 text-white rounded-md hover:bg-blue-600">
            + Add Sibling
        </button>

        <div id="siblings-container">
            <div class="grid grid-cols-5 gap-4 mb-2 font-medium text-sm text-gray-700">
                <div>Full Name</div>
                <div>Date of Birth</div>
                <div>Age</div>
                <div>Grade Level</div>
                <div>School Attended</div>
            </div>
            <!-- Siblings will be dynamically added here -->
        </div>
    </form>
</div>

<!-- Save Button Outside Forms -->
<div class="flex justify-end mt-6">
    <button type="button" onclick="saveAllForms()" 
            class="bg-blue-500 text-white px-6 py-2 rounded hover:bg-blue-600">
        Save
    </button>
</div>

@push('scripts')
<script>
    let siblingCount = 0;
    
    document.getElementById('add-sibling').addEventListener('click', function() {
        const container = document.getElementById('siblings-container');
        const newEntry = document.createElement('div');
        newEntry.className = 'grid grid-cols-5 gap-4 mb-4';
        newEntry.innerHTML = `
            <input type="text" name="siblings[${siblingCount}][full_name]" 
                placeholder="Full Name" 
                class="rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
            <input type="date" name="siblings[${siblingCount}][date_of_birth]" 
                class="rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
            <input type="number" name="siblings[${siblingCount}][age]" 
                placeholder="Age" 
                class="rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
            <input type="text" name="siblings[${siblingCount}][grade_level]" 
                placeholder="Grade Level" 
                class="rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
            <input type="text" name="siblings[${siblingCount}][school_attended]" 
                placeholder="School Attended" 
                class="rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
        `;
        container.appendChild(newEntry);
        siblingCount++;
    });

    function saveAllForms() {
        // Combine all form data and submit
        const parentFormData = new FormData(document.getElementById('parentForm'));
        const guardianFormData = new FormData(document.getElementById('guardianForm'));
        const siblingsFormData = new FormData(document.getElementById('siblingsForm'));
        
        // Create a single FormData object
        const allData = new FormData();
        for (const [key, value] of parentFormData.entries()) allData.append(key, value);
        for (const [key, value] of guardianFormData.entries()) allData.append(key, value);
        for (const [key, value] of siblingsFormData.entries()) allData.append(key, value);

        // Submit the data
        fetch('{{ route("family-information.store") }}', {
            method: 'POST',
            body: allData,
            headers: {
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
            }
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                // Handle success (e.g., show message, redirect)
                window.location.href = data.redirect;
            } else {
                // Handle errors
                console.error('Save failed:', data.message);
            }
        })
        .catch(error => console.error('Error:', error));
    }
</script>
@endpush

@endsection
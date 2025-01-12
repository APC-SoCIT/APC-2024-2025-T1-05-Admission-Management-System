@section('title', 'Portal | InnolabAMS')
@extends('portal')

@section('content')
<div class="flex justify-between items-center mb-4">
    <h1 class="text-2xl font-semibold mx-4 my-4">Family Information</h1>
</div>

<div class="bg-white rounded-lg shadow-lg p-6">
    <form action="#" method="POST"> <!-- We'll update the action later when backend is ready -->
        @csrf
        
        <!-- Father's Information -->
        <div class="mb-8">
            <h2 class="text-xl font-semibold mb-4 pb-2 border-b">Father's Information</h2>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label class="block text-sm font-medium text-gray-700">Father's Name</label>
                    <input type="text" name="father_name" 
                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700">Occupation</label>
                    <input type="text" name="father_occupation"
                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                </div>
                <div class="md:col-span-2">
                    <label class="block text-sm font-medium text-gray-700">Contact Number</label>
                    <input type="text" name="father_contact"
                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                </div>
            </div>
        </div>

        <!-- Mother's Information -->
        <div class="mb-8">
            <h2 class="text-xl font-semibold mb-4 pb-2 border-b">Mother's Information</h2>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label class="block text-sm font-medium text-gray-700">Mother's Name</label>
                    <input type="text" name="mother_name"
                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700">Occupation</label>
                    <input type="text" name="mother_occupation"
                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                </div>
                <div class="md:col-span-2">
                    <label class="block text-sm font-medium text-gray-700">Contact Number</label>
                    <input type="text" name="mother_contact"
                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                </div>
            </div>
        </div>

        <!-- Guardian's Information -->
        <div class="mb-8">
            <h2 class="text-xl font-semibold mb-4 pb-2 border-b">Guardian's Information</h2>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div class="md:col-span-2">
                    <label class="block text-sm font-medium text-gray-700">Guardian's Name</label>
                    <input type="text" name="guardian_name"
                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700">Street Number</label>
                    <input type="text" name="guardian_street"
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
        </div>

        <!-- Sibling Information -->
        <div class="mb-8">
            <h2 class="text-xl font-semibold mb-4 pb-2 border-b">Sibling Information</h2>
            <div id="siblings-container">
                <div class="sibling-entry grid grid-cols-5 gap-4 mb-4">
                    <input type="text" name="siblings[0][full_name]" placeholder="Full Name" 
                        class="rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                    <input type="date" name="siblings[0][date_of_birth]" 
                        class="rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                    <input type="number" name="siblings[0][age]" placeholder="Age" 
                        class="rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                    <input type="text" name="siblings[0][grade_level]" placeholder="Grade Level" 
                        class="rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                    <input type="text" name="siblings[0][school_attended]" placeholder="School Attended" 
                        class="rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                </div>
            </div>
            <button type="button" id="add-sibling" 
                class="mt-2 px-4 py-2 bg-blue-500 text-white rounded-md hover:bg-blue-600">
                Add Sibling
            </button>
        </div>

        <!-- Navigation Buttons -->
        <div class="flex justify-between">
            <a href="{{ route('educational-background.create') }}" 
               class="bg-gray-500 text-white px-6 py-2 rounded hover:bg-gray-600">
                Previous
            </a>
            <button type="submit" class="bg-blue-500 text-white px-6 py-2 rounded hover:bg-blue-600">
                Save
            </button>
        </div>
    </form>
</div>

@push('scripts')
<script>
    let siblingCount = 1;
    document.getElementById('add-sibling').addEventListener('click', function() {
        const container = document.getElementById('siblings-container');
        const newEntry = document.createElement('div');
        newEntry.className = 'sibling-entry grid grid-cols-5 gap-4 mb-4';
        newEntry.innerHTML = `
            <input type="text" name="siblings[${siblingCount}][full_name]" placeholder="Full Name" class="rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
            <input type="date" name="siblings[${siblingCount}][date_of_birth]" class="rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
            <input type="number" name="siblings[${siblingCount}][age]" placeholder="Age" class="rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
            <input type="text" name="siblings[${siblingCount}][grade_level]" placeholder="Grade Level" class="rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
            <input type="text" name="siblings[${siblingCount}][school_attended]" placeholder="School Attended" class="rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
        `;
        container.appendChild(newEntry);
        siblingCount++;
    });
</script>
@endpush

@endsection
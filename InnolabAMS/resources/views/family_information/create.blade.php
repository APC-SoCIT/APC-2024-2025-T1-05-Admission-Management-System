@section('title', 'Portal | InnolabAMS')
@extends('portal')

@section('content')
<div class="flex justify-between items-center mb-4">
    <h1 class="text-2xl font-semibold mx-4 my-4">Family Information</h1>
</div>

<div class="bg-white rounded-lg shadow-lg p-6">
    <form action="{{ route('family-information.store') }}" method="POST">
        @csrf
        
        <!-- Father's Information -->
        <div class="mb-8">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label class="block text-sm font-medium text-gray-700">Father's Surname</label>
                    <input type="text" name="father_surname" value="{{ old('father_surname') }}"
                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                    @error('father_surname')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700">Father's Given Name</label>
                    <input type="text" name="father_given_name" value="{{ old('father_given_name') }}"
                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                    @error('father_given_name')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700">Father's Middle Name</label>
                    <input type="text" name="father_middle_name" value="{{ old('father_middle_name') }}"
                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                    @error('father_middle_name')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700">Occupation</label>
                    <input type="text" name="father_occupation" value="{{ old('father_occupation') }}"
                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                    @error('father_occupation')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div class="md:col-span-2">
                    <label class="block text-sm font-medium text-gray-700">Contact Number</label>
                    <input type="text" name="father_contact_num" value="{{ old('father_contact_num') }}"
                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                    @error('father_contact_num')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>
            </div>
        </div>

        <!-- Mother's Information -->
        <div class="mb-8">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label class="block text-sm font-medium text-gray-700">Mother's Surname</label>
                    <input type="text" name="mother_surname" value="{{ old('mother_surname') }}"
                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                    @error('mother_surname')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700">Mother's Given Name</label>
                    <input type="text" name="mother_given_name" value="{{ old('mother_given_name') }}"
                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                    @error('mother_given_name')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700">Mother's Middle Name</label>
                    <input type="text" name="mother_middle_name" value="{{ old('mother_middle_name') }}"
                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                    @error('mother_middle_name')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700">Occupation</label>
                    <input type="text" name="mother_occupation" value="{{ old('mother_occupation') }}"
                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                    @error('mother_occupation')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div class="md:col-span-2">
                    <label class="block text-sm font-medium text-gray-700">Contact Number</label>
                    <input type="text" name="mother_contact_num" value="{{ old('mother_contact_num') }}"
                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                    @error('mother_contact_num')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>
            </div>
        </div>

        <!-- Guardian's Information -->
        <div class="mb-8">
            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700">Guardian is:</label>
                <select name="guardian_info" 
                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"
                        id="guardianSelect">
                    <option value="">Select Guardian</option>
                    <option value="Same as Father" {{ old('guardian_info') == 'Same as Father' ? 'selected' : '' }}>Same as Father</option>
                    <option value="Same as Mother" {{ old('guardian_info') == 'Same as Mother' ? 'selected' : '' }}>Same as Mother</option>
                    <option value="Other" {{ old('guardian_info') == 'Other' ? 'selected' : '' }}>Other</option>
                </select>
                @error('guardian_info')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div id="guardianFields" class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label class="block text-sm font-medium text-gray-700">Guardian's Surname</label>
                    <input type="text" name="guardian_surname" value="{{ old('guardian_surname') }}"
                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                    @error('guardian_surname')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700">Guardian's Given Name</label>
                    <input type="text" name="guardian_given_name" value="{{ old('guardian_given_name') }}"
                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                    @error('guardian_given_name')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700">Guardian's Middle Name</label>
                    <input type="text" name="guardian_middle_name" value="{{ old('guardian_middle_name') }}"
                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                    @error('guardian_middle_name')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700">Street Address</label>
                    <input type="text" name="guardian_address_street" value="{{ old('guardian_address_street') }}"
                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                    @error('guardian_address_street')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700">City</label>
                    <input type="text" name="guardian_address_city" value="{{ old('guardian_address_city') }}"
                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                    @error('guardian_address_city')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700">Contact Number</label>
                    <input type="text" name="guardian_contact_num" value="{{ old('guardian_contact_num') }}"
                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                    @error('guardian_contact_num')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700">Email</label>
                    <input type="email" name="guardian_email" value="{{ old('guardian_email') }}"
                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                    @error('guardian_email')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>
            </div>
        </div>

        <!-- Siblings Information -->
        <div class="mb-8">
            <h2 class="text-xl font-semibold mb-4 pb-2 border-b">Sibling Information</h2>
            <div id="siblings-container">
                <div class="sibling-entry grid grid-cols-6 gap-4 mb-4">
                    <div class="col-span-2">
                        <input type="text" name="siblings[0][sibling_surname]" placeholder="Surname" 
                            class="w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                    </div>
                    <div class="col-span-2">
                        <input type="text" name="siblings[0][sibling_given_name]" placeholder="Given Name" 
                            class="w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                    </div>
                    <div>
                        <input type="number" name="siblings[0][sibling_age]" placeholder="Age" 
                            class="w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                    </div>
                    <div>
                        <input type="text" name="siblings[0][sibling_grade_level]" placeholder="Grade Level" 
                            class="w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                    </div>
                </div>
            </div>
            <button type="button" id="add-sibling" 
                class="mt-2 px-4 py-2 bg-blue-500 text-white rounded-md hover:bg-blue-600">
                Add Sibling
            </button>
        </div>

        <!-- Navigation Buttons -->
        <div class="flex justify-between mt-6">
            <a href="{{ route('form.personal_info') }}" 
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
    // Guardian Information Handling
    const guardianSelect = document.getElementById('guardianSelect');
    const guardianFields = document.getElementById('guardianFields').getElementsByTagName('input');

    guardianSelect.addEventListener('change', function() {
        const selectedValue = this.value;
        if (selectedValue === 'Same as Father') {
            fillGuardianFields('father');
        } else if (selectedValue === 'Same as Mother') {
            fillGuardianFields('mother');
        } else {
            clearGuardianFields();
        }
    });

    function fillGuardianFields(parent) {
        const surname = document.querySelector(`[name="${parent}_surname"]`).value;
        const givenName = document.querySelector(`[name="${parent}_given_name"]`).value;
        const middleName = document.querySelector(`[name="${parent}_middle_name"]`).value;
        const contact = document.querySelector(`[name="${parent}_contact_num"]`).value;

        document.querySelector('[name="guardian_surname"]').value = surname;
        document.querySelector('[name="guardian_given_name"]').value = givenName;
        document.querySelector('[name="guardian_middle_name"]').value = middleName;
        document.querySelector('[name="guardian_contact_num"]').value = contact;
    }

    function clearGuardianFields() {
        Array.from(guardianFields).forEach(field => {
            field.value = '';
        });
    }

    // Siblings Information Handling
    let siblingCount = 1;
    document.getElementById('add-sibling').addEventListener('click', function() {
        const container = document.getElementById('siblings-container');
        const newEntry = document.createElement('div');
        newEntry.className = 'sibling-entry grid grid-cols-6 gap-4 mb-4';
        newEntry.innerHTML = `
            <div class="col-span-2">
                <input type="text" name="siblings[${siblingCount}][sibling_surname]" placeholder="Surname" 
                    class="w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
            </div>
            <div class="col-span-2">
                <input type="text" name="siblings[${siblingCount}][sibling_given_name]" placeholder="Given Name" 
                    class="w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
            </div>
            <div>
                <input type="number" name="siblings[${siblingCount}][sibling_age]" placeholder="Age" 
                    class="w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
            </div>
            <div>
                <input type="text" name="siblings[${siblingCount}][sibling_grade_level]" placeholder="Grade Level" 
                    class="w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
            </div>
        `;
        container.appendChild(newEntry);
        siblingCount++;
    });
</script>
@endpush

@endsection
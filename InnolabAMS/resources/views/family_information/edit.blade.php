@section('title', 'Portal | InnolabAMS')
@extends('portal')

@section('content')
<div class="flex justify-between items-center mb-4">
    <h1 class="text-2xl font-semibold mx-4 my-4">Edit Family Information</h1>
</div>

<div class="bg-white rounded-lg shadow-lg p-6">
    <form action="{{ route('family-information.update', $familyInfo->id) }}" method="POST">
        @csrf
        @method('PATCH')
        
        <!-- Father's Information -->
        <div class="mb-8">
            <h2 class="text-xl font-semibold mb-4 pb-2 border-b">Father's Information</h2>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label class="block text-sm font-medium text-gray-700">Father's Surname</label>
                    <input type="text" name="father_surname" 
                           value="{{ old('father_surname', $familyInfo->father_surname) }}"
                           class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                    @error('father_surname')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700">Father's Given Name</label>
                    <input type="text" name="father_given_name" 
                           value="{{ old('father_given_name', $familyInfo->father_given_name) }}"
                           class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                    @error('father_given_name')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700">Father's Middle Name</label>
                    <input type="text" name="father_middle_name" 
                           value="{{ old('father_middle_name', $familyInfo->father_middle_name) }}"
                           class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                    @error('father_middle_name')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700">Occupation</label>
                    <input type="text" name="father_occupation" 
                           value="{{ old('father_occupation', $familyInfo->father_occupation) }}"
                           class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                    @error('father_occupation')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div class="md:col-span-2">
                    <label class="block text-sm font-medium text-gray-700">Contact Number</label>
                    <input type="text" name="father_contact_num" 
                           value="{{ old('father_contact_num', $familyInfo->father_contact_num) }}"
                           class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                    @error('father_contact_num')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>
            </div>
        </div>

        <!-- Mother's Information -->
        <div class="mb-8">
            <h2 class="text-xl font-semibold mb-4 pb-2 border-b">Mother's Information</h2>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label class="block text-sm font-medium text-gray-700">Mother's Surname</label>
                    <input type="text" name="mother_surname" 
                           value="{{ old('mother_surname', $familyInfo->mother_surname) }}"
                           class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                    @error('mother_surname')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700">Mother's Given Name</label>
                    <input type="text" name="mother_given_name" 
                           value="{{ old('mother_given_name', $familyInfo->mother_given_name) }}"
                           class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                    @error('mother_given_name')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700">Mother's Middle Name</label>
                    <input type="text" name="mother_middle_name" 
                           value="{{ old('mother_middle_name', $familyInfo->mother_middle_name) }}"
                           class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                    @error('mother_middle_name')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700">Occupation</label>
                    <input type="text" name="mother_occupation" 
                           value="{{ old('mother_occupation', $familyInfo->mother_occupation) }}"
                           class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                    @error('mother_occupation')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div class="md:col-span-2">
                    <label class="block text-sm font-medium text-gray-700">Contact Number</label>
                    <input type="text" name="mother_contact_num" 
                           value="{{ old('mother_contact_num', $familyInfo->mother_contact_num) }}"
                           class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                    @error('mother_contact_num')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>
            </div>
        </div>

<!-- Guardian's Information -->
<div class="mb-8">
            <h2 class="text-xl font-semibold mb-4 pb-2 border-b">Guardian's Information</h2>
            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700">Guardian is:</label>
                <select name="guardian_info" 
                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"
                        id="guardianSelect">
                    <option value="">Select Guardian</option>
                    <option value="Same as Father" {{ old('guardian_info', $familyInfo->guardian_info) == 'Same as Father' ? 'selected' : '' }}>Same as Father</option>
                    <option value="Same as Mother" {{ old('guardian_info', $familyInfo->guardian_info) == 'Same as Mother' ? 'selected' : '' }}>Same as Mother</option>
                    <option value="Other" {{ old('guardian_info', $familyInfo->guardian_info) == 'Other' ? 'selected' : '' }}>Other</option>
                </select>
                @error('guardian_info')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div id="guardianFields" class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label class="block text-sm font-medium text-gray-700">Guardian's Surname</label>
                    <input type="text" name="guardian_surname" 
                           value="{{ old('guardian_surname', $familyInfo->guardian_surname) }}"
                           class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                    @error('guardian_surname')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700">Guardian's Given Name</label>
                    <input type="text" name="guardian_given_name" 
                           value="{{ old('guardian_given_name', $familyInfo->guardian_given_name) }}"
                           class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                    @error('guardian_given_name')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700">Guardian's Middle Name</label>
                    <input type="text" name="guardian_middle_name" 
                           value="{{ old('guardian_middle_name', $familyInfo->guardian_middle_name) }}"
                           class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                    @error('guardian_middle_name')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700">Street Address</label>
                    <input type="text" name="guardian_address_street" 
                           value="{{ old('guardian_address_street', $familyInfo->guardian_address_street) }}"
                           class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                    @error('guardian_address_street')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700">City</label>
                    <input type="text" name="guardian_address_city" 
                           value="{{ old('guardian_address_city', $familyInfo->guardian_address_city) }}"
                           class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                    @error('guardian_address_city')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700">Contact Number</label>
                    <input type="text" name="guardian_contact_num" 
                           value="{{ old('guardian_contact_num', $familyInfo->guardian_contact_num) }}"
                           class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                    @error('guardian_contact_num')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700">Email</label>
                    <input type="email" name="guardian_email" 
                           value="{{ old('guardian_email', $familyInfo->guardian_email) }}"
                           class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                    @error('guardian_email')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>
            </div>
        </div>

        <!-- Siblings Information -->
        <div class="mb-8">
            <h2 class="text-xl font-semibold mb-4 pb-2 border-b">Siblings Information</h2>
            <div id="siblings-container">
                @forelse($familyInfo->siblings as $index => $sibling)
                    <div class="sibling-entry grid grid-cols-6 gap-4 mb-4">
                        <div class="col-span-2">
                            <input type="text" name="siblings[{{ $index }}][sibling_surname]" 
                                   value="{{ old("siblings.$index.sibling_surname", $sibling->sibling_surname) }}"
                                   placeholder="Surname" 
                                   class="w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                        </div>
                        <div class="col-span-2">
                            <input type="text" name="siblings[{{ $index }}][sibling_given_name]" 
                                   value="{{ old("siblings.$index.sibling_given_name", $sibling->sibling_given_name) }}"
                                   placeholder="Given Name" 
                                   class="w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                        </div>
                        <div>
                            <input type="number" name="siblings[{{ $index }}][sibling_age]" 
                                   value="{{ old("siblings.$index.sibling_age", $sibling->sibling_age) }}"
                                   placeholder="Age" 
                                   class="w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                        </div>
                        <div>
                            <input type="text" name="siblings[{{ $index }}][sibling_grade_level]" 
                                   value="{{ old("siblings.$index.sibling_grade_level", $sibling->sibling_grade_level) }}"
                                   placeholder="Grade Level" 
                                   class="w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                        </div>
                    </div>
                @empty
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
                @endforelse
            </div>
            <button type="button" id="add-sibling" 
                class="mt-2 px-4 py-2 bg
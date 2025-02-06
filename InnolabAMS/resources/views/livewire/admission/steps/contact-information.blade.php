<div>
    <h3 class="text-lg font-medium text-gray-900 mb-6">Contact Information</h3>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
        <!-- Contact Number -->
        <div>
            <label for="contactNumber" class="block text-sm font-medium text-gray-700">Contact Number*</label>
            <input type="tel" id="contactNumber" wire:model="contactNumber"
                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
            @error('contactNumber') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
        </div>

        <!-- Email Address -->
        <div>
            <label for="email" class="block text-sm font-medium text-gray-700">Email Address*</label>
            <input type="email" id="email" wire:model="email"
                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
            @error('email') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
        </div>

        <!-- Current Address -->
        <div class="md:col-span-2">
            <label for="streetAddress" class="block text-sm font-medium text-gray-700">Street Address*</label>
            <input type="text" id="streetAddress" wire:model="streetAddress"
                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
            @error('streetAddress') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
        </div>

        <div>
            <label for="province" class="block text-sm font-medium text-gray-700">Province*</label>
            <input type="text" id="province" wire:model="province"
                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
            @error('province') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
        </div>

        <div>
            <label for="city" class="block text-sm font-medium text-gray-700">City*</label>
            <input type="text" id="city" wire:model="city"
                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
            @error('city') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
        </div>

        <!-- Emergency Contact -->
        <div class="md:col-span-2">
            <h4 class="text-md font-medium text-gray-900 mb-4">Emergency Contact</h4>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <label for="emergencyContactName" class="block text-sm font-medium text-gray-700">Full Name*</label>
                    <input type="text" id="emergencyContactName" wire:model="emergencyContact.name"
                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                    @error('emergencyContact.name') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                </div>

                <div>
                    <label for="emergencyContactRelationship" class="block text-sm font-medium text-gray-700">Relationship*</label>
                    <input type="text" id="emergencyContactRelationship" wire:model="emergencyContact.relationship"
                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                    @error('emergencyContact.relationship') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                </div>

                <div class="md:col-span-2">
                    <label for="emergencyContactNumber" class="block text-sm font-medium text-gray-700">Contact Number*</label>
                    <input type="tel" id="emergencyContactNumber" wire:model="emergencyContact.contact"
                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                    @error('emergencyContact.contact') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                </div>
            </div>
        </div>
    </div>
</div>

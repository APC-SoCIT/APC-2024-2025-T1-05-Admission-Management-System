<div>
    <h3 class="text-lg font-medium text-gray-900 mb-6">Personal Information</h3>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
        <!-- Last Name -->
        <div>
            <label for="lastName" class="block text-sm font-medium text-gray-700">Last Name*</label>
            <input type="text" id="lastName" wire:model="lastName"
                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
            @error('lastName') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
        </div>

        <!-- First Name -->
        <div>
            <label for="firstName" class="block text-sm font-medium text-gray-700">First Name*</label>
            <input type="text" id="firstName" wire:model="firstName"
                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
            @error('firstName') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
        </div>

        <!-- Middle Name with No Middle Name Option -->
        <div>
            <label for="middleName" class="block text-sm font-medium text-gray-700">Middle Name</label>
            <div class="mt-1">
                <input type="text" id="middleName" wire:model="middleName"
                    @if($noMiddleName) disabled @endif
                    class="block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                <div class="mt-2">
                    <label class="inline-flex items-center">
                        <input type="checkbox" wire:model="noMiddleName" class="rounded border-gray-300 text-indigo-600 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                        <span class="ml-2 text-sm text-gray-600">No Middle Name</span>
                    </label>
                </div>
            </div>
            @error('middleName') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
        </div>

        <!-- Date of Birth with Age Calculation -->
        <div>
            <label for="dateOfBirth" class="block text-sm font-medium text-gray-700">Date of Birth*</label>
            <input type="date" id="dateOfBirth" wire:model="dateOfBirth"
                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
            @if($age)
                <span class="text-sm text-gray-600">Age: {{ $age }} years old</span>
            @endif
            @error('dateOfBirth') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
        </div>

        <!-- LRN -->
        <div>
            <label for="lrn" class="block text-sm font-medium text-gray-700">LRN (Learner Reference Number)*</label>
            <input type="text" id="lrn" wire:model="lrn" maxlength="12"
                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
            @error('lrn') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
        </div>

        <!-- Sex -->
        <div>
            <label for="sex" class="block text-sm font-medium text-gray-700">Sex*</label>
            <select id="sex" wire:model="sex"
                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                <option value="">Select Sex</option>
                <option value="Male">Male</option>
                <option value="Female">Female</option>
            </select>
            @error('sex') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
        </div>

        <!-- Religion -->
        <div>
            <label for="religion" class="block text-sm font-medium text-gray-700">Religion</label>
            <input type="text" id="religion" wire:model="religion"
                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
            @error('religion') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
        </div>

        <!-- Nationality -->
        <div>
            <label for="nationality" class="block text-sm font-medium text-gray-700">Nationality*</label>
            <input type="text" id="nationality" wire:model="nationality"
                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
            @error('nationality') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
        </div>

        <!-- 2x2 Photo Upload -->
        <div class="md:col-span-2">
            <label class="block text-sm font-medium text-gray-700">2x2 ID Photo*</label>
            <div class="mt-1 flex justify-center px-6 pt-5 pb-6 border-2 border-gray-300 border-dashed rounded-md">
                <div class="space-y-1 text-center">
                    @if ($photo)
                        @if ($photo->temporaryUrl())
                            <img src="{{ $photo->temporaryUrl() }}" class="mx-auto h-32 w-32 object-cover">
                        @endif
                    @else
                        <svg class="mx-auto h-12 w-12 text-gray-400" stroke="currentColor" fill="none" viewBox="0 0 48 48">
                            <path d="M28 8H12a4 4 0 00-4 4v20m32-12v8m0 0v8a4 4 0 01-4 4H12a4 4 0 01-4-4v-4m32-4l-3.172-3.172a4 4 0 00-5.656 0L28 28M8 32l9.172-9.172a4 4 0 015.656 0L28 28m0 0l4 4m4-24h8m-4-4v8m-12 4h.02" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                        </svg>
                    @endif
                    <div class="flex text-sm text-gray-600">
                        <label for="photo" class="relative cursor-pointer bg-white rounded-md font-medium text-indigo-600 hover:text-indigo-500 focus-within:outline-none focus-within:ring-2 focus-within:ring-offset-2 focus-within:ring-indigo-500">
                            <span>Upload a photo</span>
                            <input id="photo" wire:model="photo" type="file" class="sr-only" accept="image/*">
                        </label>
                    </div>
                    <p class="text-xs text-gray-500">PNG, JPG up to 2MB</p>
                    @error('photo') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                </div>
            </div>
        </div>
    </div>
</div>

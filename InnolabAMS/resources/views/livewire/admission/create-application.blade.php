<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 bg-white border-b border-gray-200">
                <!-- Progress Bar -->
                <div class="mb-8">
                    <div class="flex justify-between mb-2">
                        @for ($i = 1; $i <= $totalSteps; $i++)
                            <div class="flex items-center">
                                <div class="@if($currentStep >= $i) bg-blue-500 @else bg-gray-300 @endif rounded-full h-8 w-8 flex items-center justify-center text-white font-semibold">
                                    {{ $i }}
                                </div>
                                @if ($i < $totalSteps)
                                    <div class="h-1 w-16 @if($currentStep > $i) bg-blue-500 @else bg-gray-300 @endif mx-2"></div>
                                @endif
                            </div>
                        @endfor
                    </div>
                    <div class="flex justify-between text-xs text-gray-600">
                        <span>Program</span>
                        <span>Personal</span>
                        <span>Contact</span>
                        <span>School</span>
                        <span>Documents</span>
                    </div>
                </div>

                <form wire:submit.prevent="submit">
                    <!-- Step 1: Program Selection -->
                    @if ($currentStep === 1)
                        <div class="space-y-4">
                            <div>
                                <label class="block text-sm font-medium text-gray-700">Program</label>
                                <select wire:model="program" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
                                    <option value="">Select Program</option>
                                    <option value="bsit">BS Information Technology</option>
                                    <option value="bscs">BS Computer Science</option>
                                </select>
                                @error('program') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                            </div>

                            <div>
                                <label class="block text-sm font-medium text-gray-700">Semester</label>
                                <select wire:model="semester" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
                                    <option value="">Select Semester</option>
                                    <option value="first">First Semester</option>
                                    <option value="second">Second Semester</option>
                                </select>
                                @error('semester') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                            </div>

                            <div>
                                <label class="block text-sm font-medium text-gray-700">Academic Year</label>
                                <input type="text" wire:model="academicYear" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm" placeholder="2024-2025">
                                @error('academicYear') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                            </div>
                        </div>
                    @endif

                    <!-- Step 2: Personal Information -->
                    @if ($currentStep === 2)
                        <div class="space-y-4">
                            <div class="grid grid-cols-3 gap-4">
                                <div>
                                    <label class="block text-sm font-medium text-gray-700">First Name</label>
                                    <input type="text" wire:model="firstName" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
                                    @error('firstName') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                                </div>

                                <div>
                                    <label class="block text-sm font-medium text-gray-700">Middle Name</label>
                                    <input type="text" wire:model="middleName" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
                                </div>

                                <div>
                                    <label class="block text-sm font-medium text-gray-700">Last Name</label>
                                    <input type="text" wire:model="lastName" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
                                    @error('lastName') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                                </div>
                            </div>

                            <div class="grid grid-cols-2 gap-4">
                                <div>
                                    <label class="block text-sm font-medium text-gray-700">Birthdate</label>
                                    <input type="date" wire:model="birthdate" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
                                    @error('birthdate') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                                </div>

                                <div>
                                    <label class="block text-sm font-medium text-gray-700">Gender</label>
                                    <select wire:model="gender" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
                                        <option value="">Select Gender</option>
                                        <option value="male">Male</option>
                                        <option value="female">Female</option>
                                        <option value="other">Other</option>
                                    </select>
                                    @error('gender') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                                </div>
                            </div>
                        </div>
                    @endif

                    <!-- Add more steps here -->

                    <!-- Navigation Buttons -->
                    <div class="flex justify-between mt-8">
                        @if ($currentStep > 1)
                            <button type="button" wire:click="previousStep" class="bg-gray-500 text-white px-4 py-2 rounded hover:bg-gray-600">
                                Previous
                            </button>
                        @else
                            <div></div>
                        @endif

                        @if ($currentStep < $totalSteps)
                            <button type="button" wire:click="nextStep" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">
                                Next
                            </button>
                        @else
                            <button type="submit" class="bg-green-500 text-white px-4 py-2 rounded hover:bg-green-600">
                                Submit Application
                            </button>
                        @endif
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

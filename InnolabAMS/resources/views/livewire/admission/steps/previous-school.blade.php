<div>
    <h3 class="text-lg font-medium text-gray-900 mb-6">Previous School Information</h3>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
        <!-- School Name -->
        <div class="md:col-span-2">
            <label for="schoolName" class="block text-sm font-medium text-gray-700">School Name*</label>
            <input type="text" id="schoolName" wire:model="schoolName"
                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
            @error('schoolName') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
        </div>

        <!-- School Address -->
        <div class="md:col-span-2">
            <label for="schoolAddress" class="block text-sm font-medium text-gray-700">School Address*</label>
            <input type="text" id="schoolAddress" wire:model="schoolAddress"
                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
            @error('schoolAddress') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
        </div>

        <!-- Previous Grade Level -->
        <div>
            <label for="previousGradeLevel" class="block text-sm font-medium text-gray-700">Previous Grade Level*</label>
            <select id="previousGradeLevel" wire:model="previousGradeLevel"
                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                <option value="">Select Grade Level</option>
                @foreach(range(1, 12) as $grade)
                    <option value="{{ $grade }}">Grade {{ $grade }}</option>
                @endforeach
            </select>
            @error('previousGradeLevel') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
        </div>

        <!-- School Year -->
        <div>
            <label for="schoolYear" class="block text-sm font-medium text-gray-700">School Year*</label>
            <input type="text" id="schoolYear" wire:model="schoolYear" placeholder="2023-2024"
                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
            @error('schoolYear') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
        </div>

        <!-- Previous Strand (Only for SHS) -->
        @if($program === 'Senior High School')
        <div class="md:col-span-2">
            <label for="previousStrand" class="block text-sm font-medium text-gray-700">Previous Strand</label>
            <select id="previousStrand" wire:model="previousStrand"
                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                <option value="">Select Previous Strand</option>
                <option value="STEM">Science, Technology, Engineering, and Mathematics (STEM)</option>
                <option value="ABM">Accountancy, Business and Management (ABM)</option>
                <option value="HUMSS">Humanities and Social Sciences (HUMSS)</option>
                <option value="GAS">General Academic Strand (GAS)</option>
                <option value="TVL">Technical-Vocational-Livelihood (TVL)</option>
            </select>
            @error('previousStrand') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
        </div>
        @endif
    </div>
</div>

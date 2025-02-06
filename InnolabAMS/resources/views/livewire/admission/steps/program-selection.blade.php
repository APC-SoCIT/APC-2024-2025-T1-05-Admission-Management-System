<div>
    <h3 class="text-lg font-medium text-gray-900 mb-6">Program Selection</h3>

    <div class="grid grid-cols-1 gap-6">
        <!-- Program Type -->
        <div>
            <label for="program" class="block text-sm font-medium text-gray-700">Program Type*</label>
            <select id="program" wire:model="program"
                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                <option value="">Select Program</option>
                <option value="Elementary">Elementary</option>
                <option value="Junior High School">Junior High School</option>
                <option value="Senior High School">Senior High School</option>
            </select>
            @error('program') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
        </div>

        <!-- Grade Level (Dynamic based on program) -->
        @if($program)
        <div>
            <label for="gradeLevel" class="block text-sm font-medium text-gray-700">Grade Level*</label>
            <select id="gradeLevel" wire:model="gradeLevel"
                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                <option value="">Select Grade Level</option>
                @if($program === 'Elementary')
                    @foreach(range(1, 6) as $grade)
                        <option value="{{ $grade }}">Grade {{ $grade }}</option>
                    @endforeach
                @elseif($program === 'Junior High School')
                    @foreach(range(7, 10) as $grade)
                        <option value="{{ $grade }}">Grade {{ $grade }}</option>
                    @endforeach
                @elseif($program === 'Senior High School')
                    @foreach(range(11, 12) as $grade)
                        <option value="{{ $grade }}">Grade {{ $grade }}</option>
                    @endforeach
                @endif
            </select>
            @error('gradeLevel') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
        </div>
        @endif

        <!-- Strand Selection (Only for Senior High School) -->
        @if($program === 'Senior High School')
        <div>
            <label for="strand" class="block text-sm font-medium text-gray-700">Strand*</label>
            <select id="strand" wire:model="strand"
                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                <option value="">Select Strand</option>
                <option value="STEM">Science, Technology, Engineering, and Mathematics (STEM)</option>
                <option value="ABM">Accountancy, Business and Management (ABM)</option>
                <option value="HUMSS">Humanities and Social Sciences (HUMSS)</option>
                <option value="GAS">General Academic Strand (GAS)</option>
                <option value="TVL">Technical-Vocational-Livelihood (TVL)</option>
            </select>
            @error('strand') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
        </div>
        @endif
    </div>
</div>

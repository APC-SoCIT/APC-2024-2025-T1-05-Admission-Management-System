<div class="max-w-7xl mx-auto py-6 sm:px-6 lg:px-8">
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
                    @include('livewire.admission.steps.program-selection')
                @endif

                <!-- Step 2: Personal Information -->
                @if ($currentStep === 2)
                    @include('livewire.admission.steps.personal-information')
                @endif

                <!-- Step 3: Contact Information -->
                @if ($currentStep === 3)
                    @include('livewire.admission.steps.contact-information')
                @endif

                <!-- Step 4: Previous School -->
                @if ($currentStep === 4)
                    @include('livewire.admission.steps.previous-school')
                @endif

                <!-- Step 5: Documents -->
                @if ($currentStep === 5)
                    @include('livewire.admission.steps.documents')
                @endif

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

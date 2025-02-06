<div>
    <h3 class="text-lg font-medium text-gray-900 mb-6">Required Documents</h3>

    <div class="grid grid-cols-2 gap-6">
        <!-- Birth Certificate -->
        <div class="border-2 border-dashed border-gray-300 rounded-lg p-6">
            <div class="text-center">
                <div class="text-gray-400 mb-2">
                    <i class="fas fa-file-upload text-4xl"></i>
                </div>
                <p class="font-medium text-gray-700">Birth Certificate*</p>
                <p class="text-sm text-gray-500 mb-4">Click to upload</p>
                <input type="file" wire:model="birthCertificate" class="hidden" id="birth-certificate-upload" accept=".pdf,.jpg,.jpeg,.png">
                <label for="birth-certificate-upload" class="cursor-pointer inline-flex items-center px-4 py-2 bg-gray-200 text-gray-700 rounded hover:bg-gray-300">
                    Choose File
                </label>
                @if($birthCertificate)
                    <p class="mt-2 text-sm text-green-600">File selected</p>
                @endif
                @error('birthCertificate') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
            </div>
        </div>

        <!-- Good Moral Certificate -->
        <div class="border-2 border-dashed border-gray-300 rounded-lg p-6">
            <div class="text-center">
                <div class="text-gray-400 mb-2">
                    <i class="fas fa-file-upload text-4xl"></i>
                </div>
                <p class="font-medium text-gray-700">Good Moral Certificate*</p>
                <p class="text-sm text-gray-500 mb-4">Click to upload</p>
                <input type="file" wire:model="goodMoral" class="hidden" id="good-moral-upload" accept=".pdf,.jpg,.jpeg,.png">
                <label for="good-moral-upload" class="cursor-pointer inline-flex items-center px-4 py-2 bg-gray-200 text-gray-700 rounded hover:bg-gray-300">
                    Choose File
                </label>
                @if($goodMoral)
                    <p class="mt-2 text-sm text-green-600">File selected</p>
                @endif
                @error('goodMoral') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
            </div>
        </div>

        <!-- Form 137 -->
        <div class="border-2 border-dashed border-gray-300 rounded-lg p-6">
            <div class="text-center">
                <div class="text-gray-400 mb-2">
                    <i class="fas fa-file-upload text-4xl"></i>
                </div>
                <p class="font-medium text-gray-700">Form 137*</p>
                <p class="text-sm text-gray-500 mb-4">Click to upload</p>
                <input type="file" wire:model="form137" class="hidden" id="form-137-upload" accept=".pdf,.jpg,.jpeg,.png">
                <label for="form-137-upload" class="cursor-pointer inline-flex items-center px-4 py-2 bg-gray-200 text-gray-700 rounded hover:bg-gray-300">
                    Choose File
                </label>
                @if($form137)
                    <p class="mt-2 text-sm text-green-600">File selected</p>
                @endif
                @error('form137') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
            </div>
        </div>

        <!-- Form 138 -->
        <div class="border-2 border-dashed border-gray-300 rounded-lg p-6">
            <div class="text-center">
                <div class="text-gray-400 mb-2">
                    <i class="fas fa-file-upload text-4xl"></i>
                </div>
                <p class="font-medium text-gray-700">Form 138*</p>
                <p class="text-sm text-gray-500 mb-4">Click to upload</p>
                <input type="file" wire:model="form138" class="hidden" id="form-138-upload" accept=".pdf,.jpg,.jpeg,.png">
                <label for="form-138-upload" class="cursor-pointer inline-flex items-center px-4 py-2 bg-gray-200 text-gray-700 rounded hover:bg-gray-300">
                    Choose File
                </label>
                @if($form138)
                    <p class="mt-2 text-sm text-green-600">File selected</p>
                @endif
                @error('form138') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
            </div>
        </div>

        <!-- Additional SHS Documents -->
        @if($program === 'Senior High School')
        <div class="border-2 border-dashed border-gray-300 rounded-lg p-6">
            <div class="text-center">
                <div class="text-gray-400 mb-2">
                    <i class="fas fa-file-upload text-4xl"></i>
                </div>
                <p class="font-medium text-gray-700">Grade 10 Report Card*</p>
                <p class="text-sm text-gray-500 mb-4">Click to upload</p>
                <input type="file" wire:model="grade10Card" class="hidden" id="grade-10-card-upload" accept=".pdf,.jpg,.jpeg,.png">
                <label for="grade-10-card-upload" class="cursor-pointer inline-flex items-center px-4 py-2 bg-gray-200 text-gray-700 rounded hover:bg-gray-300">
                    Choose File
                </label>
                @if($grade10Card)
                    <p class="mt-2 text-sm text-green-600">File selected</p>
                @endif
                @error('grade10Card') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
            </div>
        </div>

        <div class="border-2 border-dashed border-gray-300 rounded-lg p-6">
            <div class="text-center">
                <div class="text-gray-400 mb-2">
                    <i class="fas fa-file-upload text-4xl"></i>
                </div>
                <p class="font-medium text-gray-700">Certificate of Completion*</p>
                <p class="text-sm text-gray-500 mb-4">Click to upload</p>
                <input type="file" wire:model="completionCert" class="hidden" id="completion-cert-upload" accept=".pdf,.jpg,.jpeg,.png">
                <label for="completion-cert-upload" class="cursor-pointer inline-flex items-center px-4 py-2 bg-gray-200 text-gray-700 rounded hover:bg-gray-300">
                    Choose File
                </label>
                @if($completionCert)
                    <p class="mt-2 text-sm text-green-600">File selected</p>
                @endif
                @error('completionCert') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
            </div>
        </div>
        @endif
    </div>
</div>

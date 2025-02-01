@props([
    'name',
    'label',
    'required' => false,
    'accept' => '.pdf,.jpg,.jpeg,.png',
    'class' => '',
])

<div class="mb-4">
    <label for="{{ $name }}" class="block text-sm font-medium text-gray-700">
        {{ $label }}
        @if($required)
            <span class="text-red-500">*</span>
        @endif
    </label>

    <div class="mt-1 flex items-center">
        <label class="w-full flex flex-col items-center px-4 py-6 bg-white rounded-md shadow-sm border border-gray-300 cursor-pointer hover:bg-gray-50">
            <svg class="w-8 h-8 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
            </svg>
            <span class="mt-2 text-sm text-gray-600">Click to upload or drag and drop</span>
            <span class="mt-1 text-xs text-gray-500">PDF, JPG, JPEG, PNG up to 2MB</span>
            <input
                type="file"
                name="{{ $name }}"
                id="{{ $name }}"
                accept="{{ $accept }}"
                @if($required) required @endif
                class="hidden"
                {{ $attributes }}
            >
        </label>
    </div>

    <!-- Preview container -->
    <div id="{{ $name }}_preview" class="mt-2 hidden">
        <div class="flex items-center space-x-2">
            <span class="text-sm text-gray-500" id="{{ $name }}_filename"></span>
            <button type="button" onclick="clearFile('{{ $name }}')" class="text-red-500 hover:text-red-700">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                </svg>
            </button>
        </div>
    </div>

    @error($name)
        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
    @enderror
</div>

@once
@push('scripts')
<script>
    function clearFile(inputName) {
        const input = document.getElementById(inputName);
        const preview = document.getElementById(inputName + '_preview');
        input.value = '';
        preview.classList.add('hidden');
    }

    // Add event listeners for file inputs
    document.addEventListener('DOMContentLoaded', function() {
        const fileInputs = document.querySelectorAll('input[type="file"]');
        fileInputs.forEach(input => {
            input.addEventListener('change', function() {
                const preview = document.getElementById(this.id + '_preview');
                const filename = document.getElementById(this.id + '_filename');

                if (this.files && this.files[0]) {
                    preview.classList.remove('hidden');
                    filename.textContent = this.files[0].name;
                } else {
                    preview.classList.add('hidden');
                }
            });
        });
    });
</script>
@endpush
@endonce

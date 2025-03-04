@props(['text'])

<div class="ml-2 relative">
    <div x-data="{ isVisible: false }"
         @mouseenter="isVisible = true"
         @mouseleave="isVisible = false"
         class="cursor-help">
        <svg xmlns="http://www.w3.org/2000/svg"
             class="h-5 w-5 text-blue-500 hover:text-blue-600"
             fill="none"
             viewBox="0 0 24 24"
             stroke="currentColor">
            <path stroke-linecap="round"
                  stroke-linejoin="round"
                  stroke-width="2"
                  d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
        </svg>
        <div x-show="isVisible"
             x-cloak
             x-transition:enter="transition ease-out duration-200"
             x-transition:enter-start="opacity-0 translate-y-1"
             x-transition:enter-end="opacity-100 translate-y-0"
             x-transition:leave="transition ease-in duration-150"
             x-transition:leave-start="opacity-100 translate-y-0"
             x-transition:leave-end="opacity-0 translate-y-1"
             class="absolute bottom-full left-1/2 transform -translate-x-1/2 mb-2 w-48 px-4 py-2 bg-blue-600 text-white rounded-lg text-sm shadow-lg z-50">
            {{ $text }}
            <div class="absolute bottom-0 left-1/2 transform -translate-x-1/2 translate-y-1/2 rotate-45 w-2 h-2 bg-blue-600"></div>
        </div>
    </div>
</div>

<style>
    [x-cloak] { display: none !important; }
</style>

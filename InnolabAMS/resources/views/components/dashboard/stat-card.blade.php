<div class="bg-white rounded-lg shadow p-6">
    <div class="flex items-center">
        <div class="p-3 rounded-full
            @if($color === 'gray') bg-gray-100 text-gray-800
            @elseif($color === 'green') bg-green-100 text-green-800
            @elseif($color === 'red') bg-red-100 text-red-800
            @endif">
            <i class="fas {{ $icon }} fa-2x"></i>
        </div>
        <div class="ml-4">
            <h3 class="text-gray-500 text-sm font-medium">{{ $title }}</h3>
            <p class="text-3xl font-bold
                @if($color === 'gray') text-gray-900
                @elseif($color === 'green') text-green-600
                @elseif($color === 'red') text-red-600
                @endif">
                {{ number_format($value) }}
            </p>
        </div>
    </div>
</div>

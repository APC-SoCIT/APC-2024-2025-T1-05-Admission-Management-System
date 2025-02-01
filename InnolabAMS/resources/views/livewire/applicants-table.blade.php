<div>
    <div class="flex justify-between items-center mb-4">
        <h1 class="text-2xl font-semibold">Applicants</h1>

        <div class="flex items-center space-x-4">
            <!-- Search Bar -->
            <div class="relative">
                <input type="text" wire:model.debounce.300ms="search"
                    class="bg-gray-100 text-gray-700 px-4 py-2 rounded-lg shadow-sm w-64 focus:outline-none focus:ring-2 focus:ring-blue-500"
                    placeholder="Search applicants...">
                <div class="absolute right-3 top-2.5 text-gray-400">
                    <i class="fas fa-search"></i>
                </div>
            </div>

            <!-- New Applicant Button -->
            <a href="{{ route('admission.create') }}"
                class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg transition duration-200 flex items-center">
                <i class="fas fa-plus mr-2"></i>
                New Applicant
            </a>
        </div>
    </div>

    <!-- Table -->
    <div class="bg-white rounded-lg shadow-sm overflow-hidden">
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th scope="col" class="px-6 py-3 text-left">
                            <div class="flex items-center cursor-pointer" wire:click="sortBy('full_name')">
                                <span class="text-xs font-semibold text-gray-600 uppercase">Name</span>
                                @if($sortField === 'full_name')
                                    <i class="fas fa-sort-{{ $sortDirection === 'asc' ? 'up' : 'down' }} ml-1"></i>
                                @endif
                            </div>
                        </th>
                        <th scope="col" class="px-6 py-3 text-left">
                            <div class="flex items-center cursor-pointer" wire:click="sortBy('id')">
                                <span class="text-xs font-semibold text-gray-600 uppercase">ID</span>
                                @if($sortField === 'id')
                                    <i class="fas fa-sort-{{ $sortDirection === 'asc' ? 'up' : 'down' }} ml-1"></i>
                                @endif
                            </div>
                        </th>
                        <th scope="col" class="px-6 py-3 text-left">
                            <div class="flex items-center cursor-pointer" wire:click="sortBy('created_at')">
                                <span class="text-xs font-semibold text-gray-600 uppercase">Date</span>
                                @if($sortField === 'created_at')
                                    <i class="fas fa-sort-{{ $sortDirection === 'asc' ? 'up' : 'down' }} ml-1"></i>
                                @endif
                            </div>
                        </th>
                        <th scope="col" class="px-6 py-3 text-left">
                            <div class="flex items-center cursor-pointer" wire:click="sortBy('parent_name')">
                                <span class="text-xs font-semibold text-gray-600 uppercase">Parent Name</span>
                                @if($sortField === 'parent_name')
                                    <i class="fas fa-sort-{{ $sortDirection === 'asc' ? 'up' : 'down' }} ml-1"></i>
                                @endif
                            </div>
                        </th>
                        <th scope="col" class="px-6 py-3 text-left">
                            <div class="flex items-center cursor-pointer" wire:click="sortBy('city')">
                                <span class="text-xs font-semibold text-gray-600 uppercase">City</span>
                                @if($sortField === 'city')
                                    <i class="fas fa-sort-{{ $sortDirection === 'asc' ? 'up' : 'down' }} ml-1"></i>
                                @endif
                            </div>
                        </th>
                        <th scope="col" class="px-6 py-3 text-left">
                            <span class="text-xs font-semibold text-gray-600 uppercase">Contact</span>
                        </th>
                        <th scope="col" class="px-6 py-3 text-left">
                            <div class="flex items-center cursor-pointer" wire:click="sortBy('grade')">
                                <span class="text-xs font-semibold text-gray-600 uppercase">Grade</span>
                                @if($sortField === 'grade')
                                    <i class="fas fa-sort-{{ $sortDirection === 'asc' ? 'up' : 'down' }} ml-1"></i>
                                @endif
                            </div>
                        </th>
                        <th scope="col" class="px-6 py-3 text-left">
                            <span class="text-xs font-semibold text-gray-600 uppercase">Action</span>
                        </th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @forelse($applicants as $applicant)
                        <tr class="hover:bg-gray-50">
                            <td class="px-6 py-4">
                                <div class="flex items-center">
                                    <div class="h-8 w-8 rounded-full bg-gray-200 flex items-center justify-center">
                                        <span class="text-sm font-medium">{{ substr($applicant->full_name, 0, 1) }}</span>
                                    </div>
                                    <span class="ml-3">{{ $applicant->full_name }}</span>
                                </div>
                            </td>
                            <td class="px-6 py-4">#{{ $applicant->id }}</td>
                            <td class="px-6 py-4">{{ $applicant->created_at->format('F d, Y') }}</td>
                            <td class="px-6 py-4">{{ $applicant->parent_name }}</td>
                            <td class="px-6 py-4">{{ $applicant->city }}</td>
                            <td class="px-6 py-4">
                                <div class="flex space-x-2">
                                    <a href="tel:{{ $applicant->applicant_mobile_number }}" class="text-gray-600 hover:text-gray-900">
                                        <i class="fas fa-phone"></i>
                                    </a>
                                    <a href="mailto:{{ $applicant->user->email }}" class="text-gray-600 hover:text-gray-900">
                                        <i class="fas fa-envelope"></i>
                                    </a>
                                </div>
                            </td>
                            <td class="px-6 py-4">
                                <span class="px-2 py-1 text-xs rounded-full
                                    @if(strtolower($applicant->grade) === 'vii a') bg-red-100 text-red-800
                                    @elseif(strtolower($applicant->grade) === 'vii b') bg-yellow-100 text-yellow-800
                                    @else bg-blue-100 text-blue-800
                                    @endif">
                                    {{ $applicant->grade }}
                                </span>
                            </td>
                            <td class="px-6 py-4">
                                <div class="flex items-center space-x-4">
                                    <a href="{{ route('admission.show', $applicant->id) }}"
                                        class="text-gray-600 hover:text-gray-900">
                                        <i class="fas fa-ellipsis-h"></i>
                                    </a>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="8" class="px-6 py-4 text-center text-gray-500">
                                No applicants found.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <!-- Pagination -->
    <div class="mt-4">
        {{ $applicants->links() }}
    </div>
</div>

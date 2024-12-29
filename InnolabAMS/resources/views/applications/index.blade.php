<x-app-layout>
    <x-slot name="header">
        {{ __('Applicants') }}
    </x-slot>

    @section('header_buttons')
        <div class="flex items-center space-x-4">
            <button type="button" class="px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700">
                + Add Applicant
            </button>
            <button type="button" class="text-gray-500 hover:text-gray-700">
                <i class="fas fa-search text-xl"></i>
            </button>
            <button type="button" class="text-gray-500 hover:text-gray-700">
                <i class="fas fa-ellipsis-v text-xl"></i>
            </button>
        </div>
    @endsection

    <div class="bg-white rounded-lg shadow">
        <!-- Table Header -->
        <div class="p-4 border-b flex justify-between items-center">
            <div class="flex space-x-4">
                <span class="text-blue-600 border-b-2 border-blue-600">All</span>
                <span class="text-gray-500">Sort by</span>
            </div>
        </div>

        <!-- Table -->
        <div class="overflow-x-auto">
            <table class="w-full">
                <thead>
                    <tr class="bg-gray-50 text-left">
                        <th class="px-6 py-3 text-sm font-medium text-gray-500">ID</th>
                        <th class="px-6 py-3 text-sm font-medium text-gray-500">Name</th>
                        <th class="px-6 py-3 text-sm font-medium text-gray-500">Sex</th>
                        <th class="px-6 py-3 text-sm font-medium text-gray-500">Program</th>
                        <th class="px-6 py-3 text-sm font-medium text-gray-500">Email Address</th>
                        <th class="px-6 py-3 text-sm font-medium text-gray-500">Contact No.</th>
                        <th class="px-6 py-3 text-sm font-medium text-gray-500">Action</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200">
                    @forelse ($applications as $application)
                        <tr class="hover:bg-gray-50">
                            <td class="px-6 py-4 text-sm">{{ $application->id }}</td>
                            <td class="px-6 py-4 text-sm">{{ $application->applicant_name }}</td>
                            <td class="px-6 py-4 text-sm">{{ $application->gender }}</td>
                            <td class="px-6 py-4 text-sm">{{ $application->program }}</td>
                            <td class="px-6 py-4 text-sm">{{ $application->email }}</td>
                            <td class="px-6 py-4 text-sm">{{ $application->contact_number }}</td>
                            <td class="px-6 py-4 text-sm">
                                <a href="{{ route('applications.show', $application) }}"
                                   class="text-blue-600 hover:text-blue-900">View</a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="px-6 py-4 text-center text-gray-500">
                                No applications found
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <!-- Pagination -->
        @if($applications->hasPages())
            <div class="px-4 py-3 border-t">
                {{ $applications->links() }}
            </div>
        @endif
    </div>
</x-app-layout>

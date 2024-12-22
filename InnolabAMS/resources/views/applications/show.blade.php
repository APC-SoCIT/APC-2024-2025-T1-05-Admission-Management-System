<!-- resources/views/applications/show.blade.php -->
<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Application Details') }}
            </h2>
            <a href="{{ route('applications.index') }}"
               class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded">
                Back to List
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <!-- Application Information -->
                    <div class="mb-6">
                        <h3 class="text-lg font-medium text-gray-900 mb-4">Applicant Information</h3>
                        <div class="grid grid-cols-2 gap-4">
                            <div>
                                <p class="text-sm font-medium text-gray-500">Name</p>
                                <p class="mt-1">{{ $application->applicant_name }}</p>
                            </div>
                            <div>
                                <p class="text-sm font-medium text-gray-500">Program</p>
                                <p class="mt-1">{{ $application->program }}</p>
                            </div>
                            <div>
                                <p class="text-sm font-medium text-gray-500">Grade Level</p>
                                <p class="mt-1">{{ $application->grade_level }}</p>
                            </div>
                            <div>
                                <p class="text-sm font-medium text-gray-500">Status</p>
                                <p class="mt-1">
                                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full
                                        {{ $application->status === 'approved' ? 'bg-green-100 text-green-800' : '' }}
                                        {{ $application->status === 'pending' ? 'bg-yellow-100 text-yellow-800' : '' }}
                                        {{ $application->status === 'rejected' ? 'bg-red-100 text-red-800' : '' }}">
                                        {{ ucfirst($application->status) }}
                                    </span>
                                </p>
                            </div>
                        </div>
                    </div>

                    <!-- Documents Section -->
                    <div class="mt-8">
                        <h3 class="text-lg font-medium text-gray-900 mb-4">Documents</h3>
                        <div class="bg-gray-50 rounded-lg p-4">
                            @if($application->documents->count() > 0)
                                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                                    @foreach($application->documents as $document)
                                        <div class="bg-white p-4 rounded-lg shadow">
                                            <p class="font-medium">{{ $document->document_type }}</p>
                                            <p class="text-sm text-gray-500">{{ $document->file_name }}</p>
                                            <div class="mt-2">
                                                <a href="#" class="text-indigo-600 hover:text-indigo-900 text-sm">
                                                    View Document
                                                </a>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            @else
                                <p class="text-gray-500 text-center">No documents uploaded.</p>
                            @endif
                        </div>
                    </div>

                    <!-- Status Update Form -->
                    <div class="mt-8">
                        <h3 class="text-lg font-medium text-gray-900 mb-4">Update Status</h3>
                        <form action="{{ route('applications.status', $application) }}" method="POST" class="space-y-4">
                            @csrf
                            @method('PATCH')

                            <div>
                                <label for="status" class="block text-sm font-medium text-gray-700">Status</label>
                                <select name="status" id="status" class="mt-1 block w-full pl-3 pr-10 py-2 text-base border-gray-300 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm rounded-md">
                                    <option value="pending" {{ $application->status === 'pending' ? 'selected' : '' }}>Pending</option>
                                    <option value="approved" {{ $application->status === 'approved' ? 'selected' : '' }}>Approved</option>
                                    <option value="rejected" {{ $application->status === 'rejected' ? 'selected' : '' }}>Rejected</option>
                                </select>
                            </div>

                            <div>
                                <label for="remarks" class="block text-sm font-medium text-gray-700">Remarks</label>
                                <textarea name="remarks" id="remarks" rows="3" class="shadow-sm focus:ring-indigo-500 focus:border-indigo-500 mt-1 block w-full sm:text-sm border-gray-300 rounded-md">{{ $application->remarks }}</textarea>
                            </div>

                            <div class="flex justify-end">
                                <button type="submit" class="bg-indigo-600 hover:bg-indigo-700 text-white font-bold py-2 px-4 rounded">
                                    Update Status
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

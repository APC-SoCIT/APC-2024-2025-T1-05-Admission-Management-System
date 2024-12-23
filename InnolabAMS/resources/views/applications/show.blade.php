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

    @if (session('success'))
        <div class="py-4">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="rounded-md bg-green-50 p-4">
                    <div class="flex">
                        <div class="flex-shrink-0">
                            <svg class="h-5 w-5 text-green-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                            </svg>
                        </div>
                        <div class="ml-3">
                            <p class="text-sm font-medium text-green-800">
                                {{ session('success') }}
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endif

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

    <div class="mt-8 bg-white overflow-hidden shadow-sm sm:rounded-lg">
                        <div class="p-6">
                            <h3 class="text-lg font-medium text-gray-900 mb-4">Upload New Document</h3>
                            <form action="{{ route('applications.upload-document', $application) }}"
                                  method="POST"
                                  enctype="multipart/form-data"
                                  class="space-y-4">
                                @csrf

                                <div>
                                    <label for="document_type" class="block text-sm font-medium text-gray-700">Document Type</label>
                                    <select name="document_type"
                                            id="document_type"
                                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                                        <option value="">Select a document type</option>
                                        <option value="Form 137">Form 137</option>
                                        <option value="Birth Certificate">Birth Certificate</option>
                                        <option value="Report Card">Report Card</option>
                                        <option value="Good Moral">Good Moral Certificate</option>
                                        <option value="Medical Certificate">Medical Certificate</option>
                                    </select>
                                    @error('document_type')
                                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>

                                <div>
                                    <label for="document" class="block text-sm font-medium text-gray-700">Document File (PDF only)</label>
                                    <div class="mt-1 flex items-center">
                                        <input type="file"
                                               id="document"
                                               name="document"
                                               accept=".pdf"
                                               class="block w-full text-sm text-gray-500
                                                      file:mr-4 file:py-2 file:px-4
                                                      file:rounded-md file:border-0
                                                      file:text-sm file:font-semibold
                                                      file:bg-indigo-50 file:text-indigo-700
                                                      hover:file:bg-indigo-100"/>
                                    </div>
                                    @error('document')
                                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>

                                <div class="flex justify-end">
                                    <button type="submit"
                                            class="inline-flex items-center px-4 py-2 bg-indigo-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-indigo-700 focus:bg-indigo-700 active:bg-indigo-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150">
                                        Upload Document
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>

                    <!-- In resources/views/applications/show.blade.php -->

<!-- Only show Upload Document section for admission officers -->
@if(Auth::check() && Auth::user()->role === 'admission_officer')
<div class="mt-8 bg-white overflow-hidden shadow-sm sm:rounded-lg">
    <div class="p-6">
        <h3 class="text-lg font-medium text-gray-900 mb-4">Upload New Document</h3>
        <!-- Upload form content -->
    </div>
</div>
@endif

<!-- Only show Status Update form for admission officers -->
@if(Auth::check() && Auth::user()->role === 'admission_officer')
<div class="mt-8">
    <h3 class="text-lg font-medium text-gray-900 mb-4">Update Status</h3>
    <!-- Status update form content -->
</div>
@endif

                    <!-- Documents Section -->
                    <div class="mt-8">
                        <h3 class="text-lg font-medium text-gray-900 mb-4">Documents</h3>
                        <div class="bg-gray-50 rounded-lg p-6">
                            @if($application->documents->count() > 0)
                                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                                    @foreach($application->documents as $document)
                                        <div class="bg-white p-6 rounded-lg shadow-sm border border-gray-100 hover:shadow-md transition-shadow">
                                            <div class="flex flex-col h-full">
                                                <div class="flex items-center gap-3 mb-3">
                                                    <div class="p-2 bg-indigo-50 rounded-lg">
                                                        <FileText class="h-5 w-5 text-indigo-600" />
                                                    </div>
                                                    <div>
                                                        <h4 class="font-medium text-gray-900">{{ $document->document_type }}</h4>
                                                        <p class="text-sm text-gray-500">{{ $document->file_name }}</p>
                                                        <p class="text-xs text-gray-500 mt-1">Uploaded{{ $document->created_at->diffForHumans() }}</p>
                                                    </div>
                                                </div>
                                                <div class="flex-grow"></div>
                                                <div class="mt-4" id="document-viewer-{{ $document->id }}"></div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            @else
                                <div class="text-center py-12">
                                    <div class="mx-auto h-12 w-12 text-gray-400">
                                        <FileX class="h-12 w-12" />
                                    </div>
                                    <h3 class="mt-2 text-sm font-medium text-gray-900">No documents</h3>
                                    <p class="mt-1 text-sm text-gray-500">No documents have been uploaded yet.</p>
                                </div>
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

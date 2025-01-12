@section('title', 'Portal | InnolabAMS')
@extends('portal')

@section('content')
<div class="flex justify-between items-center mb-4">
    <h1 class="text-2xl font-semibold mx-4 my-4">Educational Background</h1>
</div>

<div class="bg-white rounded-lg shadow-lg p-6">
    <form action="#" method="POST"> <!-- We'll update the action later when backend is ready -->
        @csrf
        
        <!-- Educational Background -->
        <div class="mb-8">
            <h2 class="text-xl font-semibold mb-4 pb-2 border-b">Basic Information</h2>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label class="block text-sm font-medium text-gray-700">LRN</label>
                    <input type="text" name="lrn" maxlength="12" 
                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                </div>
            </div>
        </div>

        <!-- Last School Information -->
        <div class="mb-8">
            <h2 class="text-xl font-semibold mb-4 pb-2 border-b">Last School Attended</h2>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div class="md:col-span-2">
                    <label class="block text-sm font-medium text-gray-700">School Name</label>
                    <input type="text" name="school_name" 
                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                </div>
                <div class="md:col-span-2">
                    <label class="block text-sm font-medium text-gray-700">School Address</label>
                    <input type="text" name="school_address" 
                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700">Previous Program</label>
                    <input type="text" name="previous_program" 
                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700">Year of Graduation</label>
                    <input type="text" name="year_of_graduation" maxlength="4"
                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                </div>
            </div>
        </div>

        <!-- Academic Information -->
        <div class="mb-8">
            <h2 class="text-xl font-semibold mb-4 pb-2 border-b">Academic Information</h2>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label class="block text-sm font-medium text-gray-700">GWA</label>
                    <input type="number" step="0.01" name="gwa" 
                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700">Awards/Honors</label>
                    <input type="text" name="awards_honors" 
                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                </div>
            </div>
        </div>

        <!-- Navigation Buttons -->
        <div class="flex justify-between">
            <a href="{{ route('personal-information.create') }}" 
               class="bg-gray-500 text-white px-6 py-2 rounded hover:bg-gray-600">
                Previous
            </a>
            <button type="submit" class="bg-blue-500 text-white px-6 py-2 rounded hover:bg-blue-600">
                Save
            </button>
        </div>
    </form>
</div>
@endsection
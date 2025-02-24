<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Applicant Panel') }}
            </h2>
        </div>
    </x-slot>

    <div class="flex">
        <!-- Sidebar -->
        <div class="w-70 h-screen bg-gray-100 text-gray-800 border-r border-gray-300 flex-shrink-0">
            <ul class="space-y-6 p-6">
                <li>
                    <a href="{{ route('portal') }}" class="flex items-center py-4 px-6 hover:bg-gray-300 rounded transition duration-200 ease-in-out
                    {{ request()->routeIs('personal_information.create') ? 'bg-gray-200' : '' }}">
                        <i class="fa-solid fa-user w-6 text-center"></i>
                        <span class="font-semibold ml-6">{{ __('Home') }}</span>
                    </a>
                </li>
                {{-- If an applicant record exists, go to the admission.show route; otherwise, go to the form.personal_info route --}}
                    @php
                        $applicant = auth()->user()->applicantInfo;
                    @endphp

                    <a href="{{ $applicant ? route('admission.show', $applicant->id) : route('form.personal_info') }}"
                    class="flex items-center py-4 px-6 hover:bg-gray-300 rounded transition duration-200 ease-in-out">
                        <i class="fa-solid fa-graduation-cap w-6 text-center"></i>
                        <span class="font-semibold ml-6">{{ __('Application Form') }}</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('additional_info.create') }}" 
                    class="flex items-center py-2 px-6 hover:bg-gray-300 rounded transition duration-200 ease-in-out
                            {{ request()->routeIs('additional_info.*') ? 'bg-gray-200' : '' }}">
                        <i class="fa-solid fa-graduation-cap w-6 text-center"></i>
                        <span class="font-semibold ml-6">{{ __('Additional Information') }}</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('scholarship.create') }}"
                       class="flex items-center py-4 px-6 hover:bg-gray-300 rounded transition duration-200 ease-in-out
                              {{ request()->routeIs('scholarship.create') ? 'bg-gray-200' : '' }}">
                        <i class="fa-solid fa-graduation-cap w-6 text-center"></i>
                        <span class="font-semibold ml-6">{{ __('Scholarship Form') }}</span>
                    </a>
                </li>
            </ul>
        </div>


        <!-- Content Area -->

        <div class="flex-grow p-6">
            @if (Request::is('portal'))
                <div class="flex justify-between items-center mb-2">
                    <h1 class="text-2xl font-semibold mx-4 my-4">{{ __('Welcome, ') . Auth::user()->name }}</h1>
                </div>
                <div class="flex justify-between items-center mb-2">
                    <h2 class="mx-4 my-4">Please complete your application by answering all the items on the side.
                        Thank you!</h2>
                </div>
            @endif

            <div>
                @yield('content')
            </div>

        </div>
</x-app-layout>
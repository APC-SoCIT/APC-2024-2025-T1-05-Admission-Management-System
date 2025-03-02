<x-guest-layout>
    <form method="POST" action="{{ route('register') }}" class="bg-white p-6 rounded-lg shadow-md">
        @csrf

        <!-- Name -->
        <div>
            <x-input-label for="name" class="!text-black">
                {{ __('Name') }} <span class="text-red-500">*</span>
            </x-input-label>
            <x-text-input id="name" class="block mt-1 w-full !bg-white !text-black border border-gray-300 rounded"
                type="text" name="name" :value="old('name')" required autofocus autocomplete="name" />
            <x-input-error :messages="$errors->get('name')" class="mt-2" />
        </div>

        <!-- Email Address -->
        <div class="mt-4">
            <x-input-label for="email" class="!text-black">
                {{ __('Email') }} <span class="text-red-500">*</span>
            </x-input-label>
            <x-text-input id="email" class="block mt-1 w-full !bg-white !text-black border border-gray-300 rounded"
                type="email" name="email" :value="old('email')" required autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="mt-4">
            <x-input-label for="password" class="!text-black">
                {{ __('Password') }} <span class="text-red-500">*</span>
            </x-input-label>
            <x-text-input id="password" class="block mt-1 w-full !bg-white !text-black border border-gray-300 rounded"
                type="password" name="password" required autocomplete="new-password" />
            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Confirm Password -->
        <div class="mt-4">
            <x-input-label for="password_confirmation" class="!text-black">
                {{ __('Confirm Password') }} <span class="text-red-500">*</span>
            </x-input-label>
            <x-text-input id="password_confirmation"
                class="block mt-1 w-full !bg-white !text-black border border-gray-300 rounded" type="password"
                name="password_confirmation" required autocomplete="new-password" />
            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
        </div>

        <!-- Data Privacy Agreement -->
        <div class="mt-6 form-group">
            <label for="data_privacy" class="inline-flex items-center">
                <input id="data_privacy" type="checkbox" required
                    class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500">
                <span class="ms-2 text-sm text-gray">
                    I agree to the
                    <a href="#" onclick="openPrivacyPolicy()" class="text-blue-500 underline">
                        Data Privacy Policy
                    </a>.
                </span>
            </label>
        </div>

        <div class="flex items-center justify-between mt-4">
            <a class="flex items-center text-sm text-gray-600 hover:text-blue-600 transition-colors duration-200"
                href="{{ route('login') }}">
                <i class="fas fa-arrow-left mr-2"></i>
                {{ __('Already registered?') }}
            </a>

            <x-primary-button
                class="ms-4 px-6 py-2.5 bg-blue-600 hover:bg-blue-700 focus:bg-blue-700 active:bg-blue-800
                       transition-all duration-200 ease-in-out transform hover:scale-105"
                x-data=""
                @click="$el.classList.add('opacity-75'); $el.innerHTML='Processing...'">
                <i class="fas fa-user-plus mr-2"></i>
                {{ __('Register') }}
            </x-primary-button>
        </div>
    </form>
</x-guest-layout>

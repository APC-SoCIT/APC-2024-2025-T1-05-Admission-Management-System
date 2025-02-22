<x-guest-layout>
    <h1 class="text-2xl font-bold text-black mb-4 text-center">Register</h1>
    <form method="POST" action="{{ route('register') }}">
        @csrf

        <!-- Name -->
        <div>
            <x-input-label for="name" :value="__('Name')" class="!text-black" />
            <x-text-input id="name" class="block mt-1 w-full !bg-white !text-black border border-gray-300 rounded"
                type="text" name="name" :value="old('name')" required autofocus autocomplete="name" />
            <x-input-error :messages="$errors->get('name')" class="mt-2" />
        </div>

        <!-- Email Address -->
        <div class="mt-4">
            <x-input-label for="email" :value="__('Email')" class="!text-black" />
            <x-text-input id="email" class="block mt-1 w-full !bg-white !text-black border border-gray-300 rounded"
                type="email" name="email" :value="old('email')" required autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="mt-4">
            <x-input-label for="password" :value="__('Password')" class="!text-black" />
            <x-text-input id="password" class="block mt-1 w-full !bg-white !text-black border border-gray-300 rounded"
                type="password" name="password" required autocomplete="new-password" />
            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Confirm Password -->
        <div class="mt-4">
            <x-input-label for="password_confirmation" :value="__('Confirm Password')" class="!text-black" />
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
        <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"
            href="{{ route('login') }}">
            {{ __('Already registered?') }}
        </a>

        <x-primary-button class="ms-4">
            {{ __('Register') }}
        </x-primary-button>
        </div>
    </form>
</x-guest-layout>
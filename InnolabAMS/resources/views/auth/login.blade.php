<x-guest-layout>
    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />
    <h1 class="text-2xl font-bold text-black mb-4 text-center">Sign In</h1>
    <form method="POST" action="{{ route('login') }}">
        @csrf

        <!-- Email Address -->
        <div>
            <x-input-label for="email" :value="__('Email')" class="!text-black" />
            <x-text-input id="email" class="block mt-1 w-full !bg-white !text-black border border-gray-100 rounded" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="mt-4">
            <x-input-label for="password" :value="__('Password')" class="!text-black" />
            <x-text-input id="password" class="block mt-1 w-full !bg-white !text-black border border-gray-100 rounded" type="password" name="password" required autocomplete="current-password" />
            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <div class="block mt-4 flex justify-between items-center">
            <!-- Remember Me -->
            <label for="remember_me" class="inline-flex items-center">
                <input id="remember_me" type="checkbox" class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500">
                <span class="ms-2 text-sm text-black">{{ __('Remember me') }}</span>
            </label>

            <!-- Forgot your password? -->
            @if (Route::has('password.request'))
            <a class="underline text-sm text-black hover:text-indigo-600 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" href="{{ route('password.request') }}">
                {{ __('Forgot your password?') }}
            </a>
            @endif
        </div>

        <!-- Register and Sign in -->
        <div class="flex items-center justify-between mt-4">
            <!-- Register Link -->
            @if (Route::has('register'))
            <a href="{{ route('register') }}" class="underline text-sm text-black hover:text-indigo-600 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                {{ __('Register') }}
            </a>
            @endif

            <!-- Sign in Button -->
            <x-primary-button class="ms-3">
                {{ __('Sign in') }}
            </x-primary-button>
        </div>
    </form>
</x-guest-layout>

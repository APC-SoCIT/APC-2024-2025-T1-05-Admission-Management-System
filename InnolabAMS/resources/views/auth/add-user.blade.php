<form method="POST" action="{{ route('user.store') }}">
    @csrf

    <!-- Name -->
    <div>
        <x-input-label for="name" :value="__('Name')" class="!text-black" />
        <x-text-input id="name" class="block mt-1 w-full !bg-white !text-black border border-gray-300 rounded" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" />
        <x-input-error :messages="$errors->get('name')" class="mt-2" />
    </div>

    <!-- Email Address -->
    <div class="mt-4">
        <x-input-label for="email" :value="__('Email')" class="!text-black" />
        <x-text-input id="email" class="block mt-1 w-full !bg-white !text-black border border-gray-300 rounded" type="email" name="email" :value="old('email')" required autocomplete="username" />
        <x-input-error :messages="$errors->get('email')" class="mt-2" />
    </div>

    <!-- Password -->
    <div class="mt-4">
        <x-input-label for="password" :value="__('Password')" class="!text-black" />
        <x-text-input id="password" class="block mt-1 w-full !bg-white !text-black border border-gray-300 rounded" type="password" name="password" required autocomplete="new-password" />
        <x-input-error :messages="$errors->get('password')" class="mt-2" />
    </div>

    <!-- Confirm Password -->
    <div class="mt-4">
        <x-input-label for="password_confirmation" :value="__('Confirm Password')" class="!text-black" />
        <x-text-input id="password_confirmation" class="block mt-1 w-full !bg-white !text-black border border-gray-300 rounded" type="password" name="password_confirmation" required autocomplete="new-password" />
        <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
    </div>

    <!-- Role -->
    <div class="mt-4">
        <x-input-label for="role" :value="__('Role')" class="!text-black" />
        <select id="role" name="role" class="block mt-1 w-full !bg-white !text-black border border-gray-300 rounded" required>
            <option value="Admin">Admin</option>
            <option value="Staff">Staff</option>
            <option value="Applicant">Applicant</option>
        </select>
        <x-input-error :messages="$errors->get('role')" class="mt-2" />
    </div>

    <div class="flex items-center justify-end mt-4">
        <x-primary-button class="ms-4">
            {{ __('Add') }}
        </x-primary-button>
    </div>
</form>
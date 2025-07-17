<x-app-layout>
    <x-slot:title>Register User</x-slot>

    <div class="flex justify-center items-center h-screen">
        <div class="rounded-lg shadow-md p-8 w-[60%]">
            <h1 class="text-3xl font-semibold mb-4">User Registration</h1>
            <h2 class="text-gray-600 mb-6">Register to access our website</h2>
            <form method="POST" action="{{ route('user.register') }}">
                @csrf
                <div>
                    <x-input-label for="firstName" :value="__('First Name')" />
                    <x-text-input id="firstName" class="" type="text" name="firstName" :value="old('firstName')" required autofocus autocomplete="firstName" />
                    <x-input-error :messages="$errors->get('firstName')" class="mt-2" />
                </div>
                <div class='mt-4'>
                    <x-input-label for="lastName" :value="__('Last Name')" />
                    <x-text-input id="lastName" class="" type="text" name="lastName" :value="old('lastName')" required autofocus autocomplete="lastName" />
                    <x-input-error :messages="$errors->get('lastName')" class="mt-2" />
                </div>
                <div class='mt-4'>
                    <x-input-label for="username" :value="__('Username')" />
                    <x-text-input id="username" class="" type="text" name="username" :value="old('username')" required autofocus autocomplete="username" />
                    <x-input-error :messages="$errors->get('username')" class="mt-2" />
                </div>
                <div class="mt-4">
                    <x-input-label for="email" :value="__('Email')" />
                    <x-text-input id="email" class="" type="email" name="email" :value="old('email')" required autocomplete="email" />
                    <x-input-error :messages="$errors->get('email')" class="mt-2" />
                </div>
                <div class="mt-4">
                    <x-input-label for="password" :value="__('Password')" />
                    <x-text-input id="password" class="" type="password" name="password" required autocomplete="new-password" />
                    <x-input-error :messages="$errors->get('password')" class="mt-2" />
                </div>
                <div class="mt-4">
                    <x-input-label for="password_confirmation" :value="__('Confirm Password')" />
                    <x-text-input id="password_confirmation" class="" type="password" name="password_confirmation" required autocomplete="new-password" />
                    <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
                </div>
                <div class="flex items-center justify-between mt-4">
                    <a class="underline text-lg block" href="{{ route('user.login') }}">
                        {{ __('Already have an account? login') }}
                    </a>
                    <x-primary-button class="ms-4 max-w-fit">
                        {{ __('Register') }}
                    </x-primary-button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>
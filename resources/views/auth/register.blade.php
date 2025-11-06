<x-app-layout>
    <x-slot:title>Register User</x-slot>

    <div class="flex justify-center items-center h-screen">
        <div class="rounded-lg shadow-md p-8 shadow-black w-[60%] dark:shadow-gray-300">
            <h1 class="text-3xl font-semibold mb-4">User Registration</h1>
            <h2 class="text-gray-600 mb-6 dark:text-white">Register to access our website</h2>
            <form method="POST" action="{{ route('register') }}">
                @csrf
                <div>
                    <x-input-label for="first_name" :value="__('First Name')" />
                    <x-text-input id="first_name" class="" type="text" name="first_name" :value="old('first_name')" required autofocus autocomplete="first_name" />
                    <x-input-error :messages="$errors->get('first_name')" class="mt-2" />
                </div>
                <div class='mt-4'>
                    <x-input-label for="last_name" :value="__('Last Name')" />
                    <x-text-input id="last_name" class="" type="text" name="last_name" :value="old('last_name')" required autofocus autocomplete="last_name" />
                    <x-input-error :messages="$errors->get('last_name')" class="mt-2" />
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
                    <a class="underline text-lg block" href="{{ route('login') }}">
                        {{ __('Already have an account? login') }}
                    </a>
                    <x-primary-button>{{ __('Register') }}</x-primary-button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>
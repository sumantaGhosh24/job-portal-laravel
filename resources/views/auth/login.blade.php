<x-app-layout>
    <x-slot:title>Login User</x-slot>

    <div class="flex justify-center items-center h-screen">
        <div class="rounded-lg shadow-md p-8 shadow-black w-[60%] dark:shadow-gray-300">
            <h1 class="text-3xl font-semibold mb-4">User Login</h1>
            <h2 class="text-gray-600 mb-6 dark:text-white">Login to access our website</h2>
            <x-auth-session-status class="mb-4" :status="session('status')" />
            <form method="POST" action="{{ route('login') }}">
                @csrf
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
                <div class="flex items-center justify-between mt-4">
                    <a class="underline text-lg block" href="{{ route('register') }}">
                        {{ __('Don\'t have an account? register') }}
                    </a>
                    <x-primary-button>{{ __('Login') }}</x-primary-button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>
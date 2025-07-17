<x-app-layout>
    <x-slot:title>Login Admin</x-slot>

    <div class="flex justify-center items-center h-screen">
        <div class="rounded-lg shadow-md p-8 w-[60%]">
            <h1 class="text-3xl font-semibold mb-4">Admin Login</h1>
            <h2 class="text-gray-600 mb-6">Login to access our website</h2>
            <x-auth-session-status class="mb-4" :status="session('status')" />
            <form method="POST" action="{{ route('admin.login') }}">
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
                <x-primary-button class="mt-4 max-w-fit">{{ __('Login') }}</x-primary-button>
            </form>
        </div>
    </div>
</x-app-layout>
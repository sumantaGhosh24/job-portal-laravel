<div>
    <div class="flex justify-center items-center h-screen">
        <div class="rounded-lg shadow-md p-8 shadow-black w-[80%] dark:shadow-gray-300">
            <h1 class="text-3xl font-semibold mb-4">User Login</h1>
            <h2 class="text-gray-600 mb-6 dark:text-white">Login to access our website</h2>
            <x-auth-session-status class="mb-4" :status="session('status')" />
            <form wire:submit="save">
                <div class="mt-4">
                    <x-input-label for="email" :value="__('Email')" />
                    <x-text-input id="email" type="email" wire:model="email" required />
                    @error('email') <span class="text-lg text-red-600 mt-2">{{ $message }}</span> @enderror
                </div>
                <div class="mt-4">
                    <x-input-label for="password" :value="__('Password')" />
                    <x-text-input id="password" type="password" wire:model="password" required />
                    @error('password') <span class="text-lg text-red-600 mt-2">{{ $message }}</span> @enderror
                </div>
                <div class="flex items-center justify-between mt-4">
                    <a class="underline text-lg block" href="{{ route('register') }}" wire:navigate>
                        {{ __('Don\'t have an account? register') }}
                    </a>
                    <x-primary-button>
                        <span wire:loading.remove>Login</span>
                        <span wire:loading>Processing...</span>
                    </x-primary-button>
                </div>
            </form>
        </div>
    </div>
</div>
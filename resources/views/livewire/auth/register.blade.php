<div>
    <div class="flex justify-center items-center h-screen">
        <div class="rounded-lg shadow-md p-8 shadow-black w-[80%] dark:shadow-gray-300">
            <h1 class="text-3xl font-semibold mb-4">User Registration</h1>
            <h2 class="text-gray-600 mb-6 dark:text-white">Register to access our website</h2>
            <form wire:submit="save">
                <div>
                    <x-input-label for="first_name" :value="__('First Name')" />
                    <x-text-input id="first_name" type="text" wire:model="first_name" required />
                    <x-input-error :messages="$errors->get('first_name')" class="mt-2" />
                    @error('first_name') <span class="text-lg text-red-600 mt-2">{{ $message }}</span> @enderror
                </div>
                <div class='mt-4'>
                    <x-input-label for="last_name" :value="__('Last Name')" />
                    <x-text-input id="last_name" type="text" wire:model="last_name" required />
                    @error('last_name') <span class="text-lg text-red-600 mt-2">{{ $message }}</span> @enderror
                </div>
                <div class='mt-4'>
                    <x-input-label for="username" :value="__('Username')" />
                    <x-text-input id="username" type="text" wire:model="username" required />
                    @error('username') <span class="text-lg text-red-600 mt-2">{{ $message }}</span> @enderror
                </div>
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
                <div class="mt-4">
                    <x-input-label for="password_confirmation" :value="__('Confirm Password')" />
                    <x-text-input id="password_confirmation" type="password" wire:model="password_confirmation"
                        required />
                    @error('password_confirmation') <span class="text-lg text-red-600 mt-2">{{ $message }}</span>
                    @enderror
                </div>
                <div class="flex items-center justify-between mt-4">
                    <a class="underline text-lg block" href="{{ route('login') }}" wire:navigate>
                        {{ __('Already have an account? login') }}
                    </a>
                    <x-primary-button>
                        <span wire:loading.remove>Register</span>
                        <span wire:loading>Processing...</span>
                    </x-primary-button>
                </div>
            </form>
        </div>
    </div>
</div>
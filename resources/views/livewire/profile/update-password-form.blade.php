<section>
    <div>
        <h2 class="text-2xl font-semibold mb-4">{{ __('Update Password') }}</h2>
        <p class="mt-1 text-lg text-gray-800 dark:text-white">
            {{ __('Ensure your account is using a long, random password to stay secure.') }}
        </p>
    </div>

    @if (session('message'))
        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="overflow-hidden shadow-sm sm:rounded-lg dark:shadow-gray-300">
                    <p class="p-6">{{ session('message') }}</p>
                </div>
            </div>
        </div>
    @endif

    <form wire:submit="update" class="mt-6 space-y-6">
        <div>
            <x-input-label for="current_password" :value="__('Current Password')" />
            <x-text-input id="current_password" wire:model="current_password" type="password" class="mt-1 block w-full"
                required />
            @error('current_password') <span class="text-lg text-red-600 mt-2">{{ $message }}</span> @enderror
        </div>
        <div>
            <x-input-label for="password" :value="__('New Password')" />
            <x-text-input id="password" wire:model="password" type="password" class="mt-1 block w-full" required />
            @error('password') <span class="text-lg text-red-600 mt-2">{{ $message }}</span> @enderror
            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>
        <div>
            <x-input-label for="password_confirmation" :value="__('Confirm Password')" />
            <x-text-input id="password_confirmation" wire:model="password_confirmation" type="password"
                class="mt-1 block w-full" required />
            @error('password_confirmation') <span class="text-lg text-red-600 mt-2">{{ $message }}</span> @enderror
        </div>
        <x-primary-button>
            <span wire:loading.remove>Update Password</span>
            <span wire:loading>Processing...</span>
        </x-primary-button>
    </form>
</section>
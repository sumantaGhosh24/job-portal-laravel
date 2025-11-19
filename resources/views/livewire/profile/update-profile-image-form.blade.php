<section>
    <div>
        <h2 class="text-2xl font-semibold mb-4">{{ __('Update Profile Image') }}</h2>
        <p class="mt-1 text-lg text-gray-800 dark:text-white">{{ __("Update your profile image") }}</p>
    </div>

    <div class="mt-6">
        @if($user->profile_image)
            <img src="{{ asset('storage/' . $user->profile_image) }}" alt="Profile Image"
                class="w-full h-auto rounded-md" />
        @endif
    </div>
    <form wire:submit="update" class="mt-6 space-y-6">
        <div>
            <x-input-label for="image" :value="__('Profile Image')" />
            <x-text-input id="image" name="image" type="file" wire:model="image"
                class="mt-1 w-full px-4 py-2 rounded-md border border-gray-300 cursor-pointer" required />
            @error('image') <span class="text-lg text-red-600 mt-2">{{ $message }}</span> @enderror
        </div>
        <x-primary-button>
            <span wire:loading.remove>Update Profile Image</span>
            <span wire:loading>Processing...</span>
        </x-primary-button>
    </form>
</section>
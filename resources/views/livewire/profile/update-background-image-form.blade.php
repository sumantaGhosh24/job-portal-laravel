<section>
    <div>
        <h2 class="text-2xl font-semibold mb-4">{{ __('Update Background Image') }}</h2>
        <p class="mt-1 text-lg text-gray-800 dark:text-white">{{ __("Update your profile background image") }}</p>
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

    <div class="mt-6">
        @if($user->background_image)
            <img src="{{ asset('storage/' . $user->background_image) }}" alt="Background Image"
                class="w-full h-auto rounded-md" />
        @endif
    </div>
    <form wire:submit="update" class="mt-6 space-y-6">
        <div>
            <x-input-label for="image" :value="__('Background Image')" />
            <x-text-input id="image" wire:model="image" type="file"
                class="mt-1 w-full px-4 py-2 rounded-md border border-gray-300 cursor-pointer" required />
            @error('image') <span class="text-lg text-red-600 mt-2">{{ $message }}</span> @enderror
        </div>
        <x-primary-button>
            <span wire:loading.remove>Update Background Image</span>
            <span wire:loading>Processing...</span>
        </x-primary-button>
    </form>
</section>
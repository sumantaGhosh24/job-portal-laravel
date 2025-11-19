<section>
    <div>
        <h2 class="text-2xl font-semibold mb-4">{{ __('Update Company Description') }}</h2>
        <p class="mt-1 text-lg text-gray-800 dark:text-white">{{ __("Update company description") }}</p>
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
            <x-input-label for="description" :value="__('Company Description')" />
            <textarea id="description" wire:model="description"
                class="mt-1 block w-full px-4 py-2 rounded-md border border-gray-300" required></textarea>
            @error('description') <span class="text-lg text-red-600 mt-2">{{ $message }}</span> @enderror
        </div>
        <div>
            <x-input-label for="slogan" :value="__('Company Slogan')" />
            <textarea id="slogan" wire:model="slogan"
                class="mt-1 block w-full px-4 py-2 rounded-md border border-gray-300" required></textarea>
            @error('slogan') <span class="text-lg text-red-600 mt-2">{{ $message }}</span> @enderror
        </div>
        <x-primary-button>
            <span wire:loading.remove>Update Company Description</span>
            <span wire:loading>Processing...</span>
        </x-primary-button>
    </form>
</section>
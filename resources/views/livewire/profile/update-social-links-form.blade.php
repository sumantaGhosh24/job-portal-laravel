<section>
    <div>
        <h2 class="text-2xl font-semibold mb-4">{{ __('Update Social Links') }}</h2>
        <p class="mt-1 text-lg text-gray-800 dark:text-white">{{ __("Update your social links") }}</p>
    </div>

    @if (session('message'))
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 mt-4">
            <div class="overflow-hidden shadow-sm sm:rounded-lg dark:shadow-gray-300">
                <p class="p-6">{{ session('message') }}</p>
            </div>
        </div>
    @endif

    <form wire:submit="update" class="mt-6 space-y-6">
        <div>
            <x-input-label for="linkedin_url" :value="__('LinkedIn Profile URL')" />
            <x-text-input id="linkedin_url" wire:model="linkedin_url" type="url" class="mt-1 block w-full" required />
            @error('linkedin_url') <span class="text-lg text-red-600 mt-2">{{ $message }}</span> @enderror
        </div>
        <div>
            <x-input-label for="github_url" :value="__('Github Profile URL')" />
            <x-text-input id="github_url" wire:model="github_url" type="url" class="mt-1 block w-full" required />
            @error('github_url') <span class="text-lg text-red-600 mt-2">{{ $message }}</span> @enderror
        </div>
        <div>
            <x-input-label for="website_url" :value="__('Personal Website URL')" />
            <x-text-input id="website_url" wire:model="website_url" type="url" class="mt-1 block w-full" required />
            @error('website_url') <span class="text-lg text-red-600 mt-2">{{ $message }}</span> @enderror
        </div>
        <x-primary-button>
            <span wire:loading.remove>Update Social Links</span>
            <span wire:loading>Processing...</span>
        </x-primary-button>
    </form>
</section>
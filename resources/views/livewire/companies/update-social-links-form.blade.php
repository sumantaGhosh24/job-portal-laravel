<section>
    <div>
        <h2 class="text-2xl font-semibold mb-4">{{ __('Update Social Links') }}</h2>
        <p class="mt-1 text-lg text-gray-800 dark:text-white">{{ __("Update company social links") }}</p>
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
            <x-input-label for="linkedin_url" :value="__('LinkedIn Profile URL')" />
            <x-text-input id="linkedin_url" wire:model="linkedin_url" type="url" class="mt-1 block w-full" />
            @error('linkedin_url') <span class="text-lg text-red-600 mt-2">{{ $message }}</span> @enderror
        </div>
        <div>
            <x-input-label for="twitter_url" :value="__('Twitter URL')" />
            <x-text-input id="twitter_url" wire:model="twitter_url" type="url" class="mt-1 block w-full" />
            @error('twitter_url') <span class="text-lg text-red-600 mt-2">{{ $message }}</span> @enderror
        </div>
        <div>
            <x-input-label for="facebook_url" :value="__('Facebook URL')" />
            <x-text-input id="facebook_url" wire:model="facebook_url" type="url" class="mt-1 block w-full" />
            @error('facebook_url') <span class="text-lg text-red-600 mt-2">{{ $message }}</span> @enderror
        </div>
        <div>
            <x-input-label for="youtube_url" :value="__('Youtube URL')" />
            <x-text-input id="youtube_url" wire:model="youtube_url" type="url" class="mt-1 block w-full" />
            @error('youtube_url') <span class="text-lg text-red-600 mt-2">{{ $message }}</span> @enderror
        </div>
        <div>
            <x-input-label for="instagram_url" :value="__('Instagram URL')" />
            <x-text-input id="instagram_url" wire:model="instagram_url" type="url" class="mt-1 block w-full" />
            @error('instagram_url') <span class="text-lg text-red-600 mt-2">{{ $message }}</span> @enderror
        </div>
        <div>
            <x-input-label for="website_url" :value="__('Personal Website URL')" />
            <x-text-input id="website_url" wire:model="website_url" type="url" class="mt-1 block w-full" />
            @error('website_url') <span class="text-lg text-red-600 mt-2">{{ $message }}</span> @enderror
        </div>
        <x-primary-button>
            <span wire:loading.remove>Update Social Links</span>
            <span wire:loading>Processing...</span>
        </x-primary-button>
    </form>
</section>
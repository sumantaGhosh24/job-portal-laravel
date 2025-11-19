<section>
    <div>
        <h2 class="text-2xl font-semibold mb-4">{{ __('Update Professional Summary') }}</h2>
        <p class="mt-1 text-lg text-gray-800 dark:text-white">{{ __("Update your professional summary") }}</p>
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
            <x-input-label for="headline" :value="__('Headline')" />
            <x-text-input id="headline" wire:model="headline" type="text" class="mt-1 block w-full" required />
            @error('headline') <span class="text-lg text-red-600 mt-2">{{ $message }}</span> @enderror
        </div>
        <div>
            <x-input-label for="professional_summary" :value="__('Professional Summary')" />
            <textarea id="professional_summary" wire:model="professional_summary"
                class="mt-1 block w-full px-4 py-2 rounded-md border border-gray-300" required></textarea>
            @error('professional_summary') <span class="text-lg text-red-600 mt-2">{{ $message }}</span> @enderror
        </div>
        <x-primary-button>
            <span wire:loading.remove>Update Professional Summary</span>
            <span wire:loading>Processing...</span>
        </x-primary-button>
    </form>
</section>
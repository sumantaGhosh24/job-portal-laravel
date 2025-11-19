<section>
    <div>
        <h2 class="text-2xl font-semibold mb-4">{{ __('Update Resume') }}</h2>
        <p class="mt-1 text-lg text-gray-800 dark:text-white">{{ __("Update your resume") }}</p>
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
        @if($user->resume)
            <div class="border border-blue-600 rounded-md px-2 py-1.5">
                <p class="font-medium">{{ asset('storage/' . $user->resume) }}</p>
                <div class="mt-4">
                    <x-primary-button wire:click="download">Download</x-primary-button>
                    <x-primary-button>
                        <a href={{ asset('storage/' . $user->resume) }} target="_blank">View</a>
                    </x-primary-button>
                </div>
            </div>
        @endif
    </div>
    <form wire:submit="update" class="mt-6 space-y-6">
        <div>
            <x-input-label for="resume" :value="__('Resume')" />
            <x-text-input id="resume" type="file" wire:model="resume"
                class="mt-1 w-full px-4 py-2 rounded-md border border-gray-300 cursor-pointer" required />
            @error('resume') <span class="text-lg text-red-600 mt-2">{{ $message }}</span> @enderror
        </div>
        <x-primary-button>
            <span wire:loading.remove>Update Resume</span>
            <span wire:loading>Processing...</span>
        </x-primary-button>
    </form>
</section>
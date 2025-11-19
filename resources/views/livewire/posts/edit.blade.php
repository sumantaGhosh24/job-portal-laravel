<div>
    @if (session('message'))
        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="overflow-hidden shadow-sm sm:rounded-lg dark:shadow-gray-300">
                    <p class="p-6">{{ session('message') }}</p>
                </div>
            </div>
        </div>
    @endif

    @if(auth()->id() === $post->user_id)
        <div class="flex justify-center items-center h-screen">
            <div class="rounded-lg shadow-md p-8 shadow-black w-[75%] dark:shadow-gray-300">
                <h1 class="text-3xl font-semibold mb-4">Update Post</h1>
                <form wire:submit="update">
                    <div class="mt-4">
                        <x-input-label for="title" :value="__('Post Title')" />
                        <x-text-input id="title" type="text" wire:model="title" required />
                        @error('title') <span class="text-lg text-red-600 mt-2">{{ $message }}</span> @enderror
                    </div>
                    <div>
                        <x-input-label for="description" :value="__('Post Description')" />
                        <textarea id="description" class="mt-1 block w-full px-4 py-2 rounded-md border border-gray-300"
                            wire:model="description" required></textarea>
                        @error('description') <span class="text-lg text-red-600 mt-2">{{ $message }}</span> @enderror
                    </div>
                    <x-primary-button class="mt-4">
                        <span wire:loading.remove>Update Post</span>
                        <span wire:loading>Processing...</span>
                    </x-primary-button>
                </form>
            </div>
        </div>
    @endif
</div>
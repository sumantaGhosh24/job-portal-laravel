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

    @if(auth()->id() === $company->owner_id)
        <div class="flex justify-center items-center h-full">
            <div class="rounded-lg shadow-md p-8 shadow-black w-[75%] my-10 dark:shadow-gray-300">
                <h1 class="text-3xl font-semibold mb-4">Create Post</h1>
                <form wire:submit="save">
                    <div class="mt-4">
                        <x-input-label for="title" :value="__('Post Title')" />
                        <x-text-input id="title" type="text" wire:model="title" required />
                        @error('title') <span class="text-lg text-red-600 mt-2">{{ $message }}</span> @enderror
                    </div>
                    <div>
                        <x-input-label for="description" :value="__('Post Description')" />
                        <textarea id="description" wire:model="description"
                            class="mt-1 block w-full px-4 py-2 rounded-md border border-gray-300" required></textarea>
                        @error('description') <span class="text-lg text-red-600 mt-2">{{ $message }}</span> @enderror
                    </div>
                    <div>
                        <x-input-label for="post_content" :value="__('Post Content')" />
                        <textarea id="post_content" wire:model="post_content"
                            class="mt-1 block w-full px-4 py-2 rounded-md border border-gray-300" required></textarea>
                        @error('post_content') <span class="text-lg text-red-600 mt-2">{{ $message }}</span> @enderror
                    </div>
                    <x-primary-button class="mt-4">
                        <span wire:loading.remove>Create Company Post</span>
                        <span wire:loading>Processing...</span>
                    </x-primary-button>
                </form>
            </div>
        </div>
    @else
        <div class="flex justify-center items-center h-full">
            <div class="rounded-lg shadow-md p-8 shadow-black w-[75%] my-10 dark:shadow-gray-300">
                <h1 class="text-3xl font-semibold mb-4">Create Post</h1>
                <p class="text-gray-500 dark:text-white">You are not the owner of this company.</p>
            </div>
        </div>
    @endif
</div>
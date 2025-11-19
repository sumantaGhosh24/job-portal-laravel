<div>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/simplemde/latest/simplemde.min.css">
    <script src="https://cdn.jsdelivr.net/simplemde/latest/simplemde.min.js"></script>

    @if (session('message'))
        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="overflow-hidden shadow-sm sm:rounded-lg dark:shadow-gray-300">
                    <p class="p-6">{{ session('message') }}</p>
                </div>
            </div>
        </div>
    @endif

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
                <div wire:ignore>
                    <x-input-label for='markdown-editor' :value="__('Post Content')" />
                    <textarea id="markdown-editor"></textarea>
                    @error('post_content') <span class="text-lg text-red-600 mt-2">{{ $message }}</span> @enderror
                </div>
                <x-primary-button>
                    <span wire:loading.remove>Create Post</span>
                    <span wire:loading>Processing...</span>
                </x-primary-button>
            </form>
        </div>
    </div>

    <script>
        (function () {
            function init() {
                var el = document.getElementById('markdown-editor');
                if (!el || el.dataset.initialized === '1') return;
                el.dataset.initialized = '1';
                var simplemde = new SimpleMDE({ element: el });
                simplemde.codemirror.on('change', function () {
                    @this.set('post_content', simplemde.value());
                });
            }

            if (document.readyState !== 'loading') {
                init();
            } else {
                document.addEventListener('DOMContentLoaded', init, { once: true });
            }
            document.addEventListener('livewire:init', init);
            document.addEventListener('livewire:navigated', init);
        })();
    </script>
</div>
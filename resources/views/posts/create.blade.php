<x-app-layout>
    <x-slot:title>Create Post</x-slot>

        <link rel="stylesheet" href="https://cdn.jsdelivr.net/simplemde/latest/simplemde.min.css">
        <script src="https://cdn.jsdelivr.net/simplemde/latest/simplemde.min.js"></script>

        @if (session('message'))
            <div class="py-12">
                <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                        <div class="p-6 text-gray-900">
                            {{ session('message') }}
                        </div>
                    </div>
                </div>
            </div>
        @endif

        <div class="flex justify-center items-center h-full">
            <div class="rounded-lg shadow-md p-8 shadow-black w-[75%] my-10">
                <h1 class="text-3xl font-semibold mb-4">Create Post</h1>
                <form method="POST" action="{{ route('posts.store') }}">
                    @csrf

                    <div class="mt-4">
                        <x-input-label for="title" :value="__('Post Title')" />
                        <x-text-input id="title" type="text" name="title" :value="old('title')" required
                            autocomplete="title" />
                        <x-input-error :messages="$errors->get('title')" class="mt-2" />
                    </div>

                    <div>
                        <x-input-label for="description" :value="__('Post Description')" />
                        <textarea id="description" name="description"
                            class="mt-1 block w-full px-4 py-2 rounded-md border border-gray-300" required autofocus
                            autocomplete="description">{{ old('description') }}</textarea>
                        <x-input-error class="mt-2" :messages="$errors->get('description')" />
                    </div>

                    <div>
                        <x-input-label for='markdown-editor' :value="__('Post Content')" />
                        <textarea name="post_content" id="markdown-editor"></textarea>
                        <x-input-error class="mt-2" :messages="$errors->get('post_content')" />
                    </div>

                    <x-primary-button class="ms-4 max-w-fit">
                        {{ __('Create Post') }}
                    </x-primary-button>
                </form>
            </div>
        </div>

        <script>
            var simplemde = new SimpleMDE({ element: document.getElementById("markdown-editor") });
        </script>
</x-app-layout>
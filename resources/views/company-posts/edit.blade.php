<x-app-layout>
    <x-slot:title>Update Post</x-slot>

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

    @if(auth()->id() === $post->company->owner_id)
        <div class="flex justify-center items-center h-screen">
            <div class="rounded-lg shadow-md p-8 shadow-black w-[60%] dark:shadow-gray-300">
                <h1 class="text-3xl font-semibold mb-4">Update Post</h1>
                <form method="POST" action="{{ route('company.posts.update', ['id' => $post->id]) }}">
                    @csrf
                    @method('patch')
                    <div class="mt-4">
                        <x-input-label for="title" :value="__('Post Title')" />
                        <x-text-input id="title" type="text" name="title" :value="old('title', $post->title)" required autocomplete="title" />
                        <x-input-error :messages="$errors->get('title')" class="mt-2" />
                    </div>
                    <div>
                        <x-input-label for="description" :value="__('Post Description')" />
                        <textarea id="description" name="description" class="mt-1 block w-full px-4 py-2 rounded-md border border-gray-300" required autofocus autocomplete="description">{{ old('description', $post->description) }}</textarea>
                        <x-input-error class="mt-2" :messages="$errors->get('description')" />
                    </div>
                    <div>
                        <x-input-label for='markdown-editor' :value="__('Post Content')" />
                        <textarea name="post_content" id="markdown-editor"></textarea>
                        <x-input-error class="mt-2" :messages="$errors->get('post_content')" />
                    </div>
                    <x-primary-button>{{ __('Update Post') }}</x-primary-button>
                </form>
            </div>
        </div>
    @else
        <div class="flex justify-center items-center h-full">
            <div class="rounded-lg shadow-md p-8 shadow-black w-[75%] my-10 dark:shadow-gray-300">
                <h1 class="text-3xl font-semibold mb-4">Update Post</h1>
                <p class="text-gray-500 dark:text-white">You are not the owner of this company.</p>
            </div>
        </div>
    @endif

    <script>
        var simplemde = new SimpleMDE({ element: document.getElementById("markdown-editor") });

        simplemde.value("{{ $post->content }}");
    </script>
</x-app-layout>
<x-app-layout>
    <x-slot:title>Post</x-slot>

    <div class="container mx-auto mt-10 rounded-lg shadow-md p-6 dark:shadow-gray-300">
        <div class="flex items-center justify-between border-b pb-4">
            <div>
                <h2 class="font-bold text-xl text-gray-800 dark:text-white">
                    <h2>{{ $post->user->first_name }} {{ $post->user->last_name }}</h2>
                </h2>
                <p class="text-sm text-gray-500 dark:text-white">{{ $post->created_at->format('M d, Y h:i A') }}</p>
            </div>
        </div>
        <div class="mt-6 border-b pb-4">
            <p class="text-gray-800 text-lg font-bold leading-relaxed capitalize dark:text-white">
                {{ $post->title }}
            </p>
            <p class="text-gray-800 text-lg font-medium leading-relaxed capitalize my-3 dark:text-white">
                {{ $post->description }}
            </p>
            <div class='prose max-w-none'>{!! $post->html_content !!}</div>
        </div>
        <form action="{{ route('posts.like', $post) }}" method="POST" class="my-5">
            @csrf
            <button type="submit" class="flex items-center space-x-2 text-gray-700 cursor-pointer dark:text-white">
                @if($post->isLikedBy(auth()->user()))
                    <span>❤️ Unlike</span>
                @else
                    <span>🤍 Like</span>
                @endif
                <span class="text-sm text-gray-500 dark:text-white">({{ $post->likes->count() }})</span>
            </button>
        </form>
        <div>
            <h3 class="font-semibold text-lg mb-4">Comments ({{ $post->comments->count() }})</h3>
            <form action="{{ route('comments.store', $post) }}" method="POST" class="mb-6">
                @csrf
                <div>
                    <x-input-label for="comment" :value="__('Comment')" />
                    <textarea rows="3" id="comment" name="comment" class="mt-1 block w-full px-4 py-2 rounded-md border border-gray-300" required autofocus autocomplete="comment">{{ old('comment') }}</textarea>
                    <x-input-error class="mt-2" :messages="$errors->get('comment')" />
                </div>
                <x-primary-button class='mt-3'>{{ __('Post Comment') }}</x-primary-button>
            </form>
            <div class="space-y-4">
                @foreach($post->comments()->latest()->get() as $comment)
                    <div class="border rounded-md p-3">
                        <div class="flex justify-between items-center mb-2">
                            <span class="font-semibold text-gray-800 dark:text-white">
                                {{ $comment->user->first_name }} {{ $comment->user->last_name }}
                            </span>
                            <span class="text-sm text-gray-500 dark:text-white">{{ $comment->created_at->diffForHumans() }}</span>
                        </div>
                        <div class="text-gray-800 dark:text-white">{{ $comment->content }}</div>
                        @if($comment->user_id === auth()->id())
                            <form action="{{ route('comments.destroy', $comment) }}" method="POST" class="mt-2 text-right">
                                @csrf
                                @method('delete')
                                <x-danger-button>{{ __('Delete') }}</x-danger-button>
                            </form>
                        @endif
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</x-app-layout>
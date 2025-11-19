<div>
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
        <form wire:submit="toggleLike" class="my-5">
            <button type="submit"
                class="flex items-center space-x-2 text-gray-700 cursor-pointer dark:text-white disabled:opacity-15">
                @auth
                    @if($post->isLikedBy(auth()->user()))
                        <span>❤️ Unlike</span>
                    @else
                        <span>🤍 Like</span>
                    @endif
                @endauth
                <span class="text-sm text-gray-500 dark:text-white">({{ $post->likes->count() }})</span>
            </button>
        </form>
        <div>
            <h3 class="font-semibold text-lg mb-4">Comments ({{ $post->comments->count() }})</h3>
            <form wire:submit="saveComment" class="mb-6">
                <div>
                    <x-input-label for="comment" :value="__('Comment')" />
                    <textarea rows="3" id="comment"
                        class="mt-1 block w-full px-4 py-2 rounded-md border border-gray-300" required
                        wire:model="comment"></textarea>
                    @error('comment') <span class="text-lg text-red-600 mt-2">{{ $message }}</span> @enderror
                </div>
                <x-primary-button class='mt-3'>
                    <span wire:loading.remove>Post Comment</span>
                    <span wire:loading>Processing...</span>
                </x-primary-button>
            </form>
            <div class="space-y-4">
                @foreach($post->comments()->latest()->get() as $comment)
                    <div class="border rounded-md p-3" wire:key="{{ $comment->id }}">
                        <div class="flex justify-between items-center mb-2">
                            <span class="font-semibold text-gray-800 dark:text-white">
                                {{ $comment->user->first_name }} {{ $comment->user->last_name }}
                            </span>
                            <span
                                class="text-sm text-gray-500 dark:text-white">{{ $comment->created_at->diffForHumans() }}</span>
                        </div>
                        <div class="flex justify-between items-center">
                            <div class="text-gray-800 dark:text-white">{{ $comment->content }}</div>
                            @if($comment->user_id === auth()->id())
                                <x-danger-button wire:click="deleteComment({{ $comment->id }})">
                                    <span wire:loading.remove>Delete</span>
                                    <span wire:loading>Processing...</span>
                                </x-danger-button>
                            @endif
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</div>
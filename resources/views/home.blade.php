<x-app-layout>
    <x-slot:title>Home</x-slot>

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

        <div class="container mx-auto mt-10 bg-white rounded-lg shadow-md p-6">
            <h2 class="text-2xl font-bold mb-4">Suggested Users to Follow</h2>
            <div class="space-y-4">
                @forelse ($suggested as $user)
                    <div class="flex items-center justify-between p-3 bg-gray-50 rounded-lg">
                        <div>
                            <h3 class="font-semibold text-gray-800">{{ $user->first_name }} {{ $user->last_name }}</h3>
                            <p class="text-sm text-gray-500">{{ '@' . Str::slug($user->username) }}</p>
                        </div>

                        <form action="{{ route('users.follow', $user) }}" method="POST">
                            @csrf

                            <x-primary-button>{{ __('Follow') }}</x-primary-button>
                        </form>
                    </div>
                @empty
                    <p class="text-gray-500">No new users to follow right now.</p>
                @endforelse
            </div>
        </div>

        <div class="container mx-auto mt-10 space-y-8">
            <div class="bg-white p-5 rounded-lg shadow mb-3 flex items-center justify-between">
                <h2 class='text-2xl font-bold mb-4'>Posts</h2>
                <a href={{ route('posts.create') }}>
                    <x-primary-button class="ms-4 max-w-fit">
                        {{ __('Create Post') }}
                    </x-primary-button>
                </a>
            </div>
            <div class="space-y-6">
                @forelse($posts as $post)
                    <div class="bg-white p-5 rounded-lg shadow">
                        <div class="flex justify-between items-center mb-3">
                            <div>
                                <h3 class="font-bold text-gray-800 capitalize">{{ $post->user->first_name }}
                                    {{ $post->user->last_name }}
                                </h3>
                                <p class="text-sm text-gray-500">{{ $post->created_at->diffForHumans() }}</p>
                            </div>
                            <div class="flex gap-2 items-center">
                                <a href="{{ route('posts.show', ['id' => $post->id]) }}">
                                    <x-primary-button class="ms-4 max-w-fit">
                                        {{ __('View') }}
                                    </x-primary-button>
                                </a>
                                @if (auth()->id() === $post->user_id)
                                    <a href="{{ route('posts.edit', ['id' => $post->id]) }}">
                                        <x-primary-button class="ms-4 max-w-fit">
                                            {{ __('Update') }}
                                        </x-primary-button>
                                    </a>
                                    <form action="{{ route('posts.destroy', ['id' => $post->id]) }}" method="POST">
                                        @csrf
                                        @method('delete')

                                        <x-danger-button class="ms-4 max-w-fit">
                                            {{ __('Delete') }}
                                        </x-danger-button>
                                    </form>
                                @endif
                            </div>
                        </div>
                        <p class="mt-3 text-xl font-bold capitalize">{{ $post->title }}</p>
                        <p class="mt-3 text-base text-gray-700 capitalize">{{ $post->description }}</p>
                    </div>
                @empty
                    <p class="text-gray-500">No posts yet. Follow users or create your first post!</p>
                @endforelse
            </div>
            <div>
                {{ $posts->links() }}
            </div>
        </div>
</x-app-layout>
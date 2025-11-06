<x-app-layout>
    <x-slot:title>Home</x-slot>

    @if (session('message'))
        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="overflow-hidden shadow-sm sm:rounded-lg dark:shadow-gray-300">
                    <p class="p-6">{{ session('message') }}</p>
                </div>
            </div>
        </div>
    @endif

    <div class="container mx-auto mt-10 rounded-lg shadow-md p-6 dark:shadow-gray-300">
        <h2 class="text-2xl font-bold mb-4">Suggested Users to Follow</h2>
        <div class="space-y-4">
            @forelse ($suggested as $user)
                <div class="flex items-center justify-between p-3 bg-gray-50 rounded-lg dark:bg-gray-700">
                    <div>
                        <h3 class="font-semibold text-gray-800 dark:text-white">{{ $user->first_name }} {{ $user->last_name }}</h3>
                        <p class="text-sm text-gray-500 dark:text-white">{{ '@' . Str::slug($user->username) }}</p>
                    </div>
                    <form action="{{ route('users.follow', $user) }}" method="POST">
                        @csrf
                        <x-primary-button>{{ __('Follow') }}</x-primary-button>
                    </form>
                </div>
            @empty
                <p class="text-gray-500 dark:bg-white">No new users to follow right now.</p>
            @endforelse
        </div>
    </div>

    <div class="container mx-auto mt-10 rounded-lg shadow-md p-6 dark:shadow-gray-300">
        <h2 class="text-2xl font-bold mb-4">Suggested Companies to Follow</h2>
        <div class="space-y-4">
            @forelse ($suggestedCompanies as $company)
                <div class="flex items-center justify-between p-3 bg-gray-50 rounded-lg dark:bg-gray-700">
                    <div>
                        <h3 class="font-semibold text-gray-800 dark:text-white">{{ $company->name }}</h3>
                        <p class="text-sm text-gray-500 dark:text-white">{{ $company->sector }}</p>
                    </div>
                    <div class="flex items-center gap-2">
                        <a href="{{ route('companies.show', $company->id) }}">
                            <x-primary-button>{{ __('View') }}</x-primary-button>
                        </a>
                        <form action="{{ route('companies.follow', $company) }}" method="POST">
                            @csrf
                            <x-primary-button>{{ __('Follow') }}</x-primary-button>
                        </form>
                    </div>
                </div>
            @empty
                <p class="text-gray-500 dark:text-white">No new companies to follow right now.</p>
            @endforelse
        </div>
    </div>

    <div class="container mx-auto mt-10 space-y-8">
        <div class="p-5 rounded-lg shadow mb-3 flex items-center justify-between dark:shadow-gray-300">
            <h2 class='text-2xl font-bold mb-4'>Posts</h2>
            <a href={{ route('posts.create') }}>
                <x-primary-button>{{ __('Create Post') }}</x-primary-button>
            </a>
        </div>
        <div class="space-y-6">
            @forelse($posts as $post)
                <div class="p-5 rounded-lg shadow dark:shadow-gray-300">
                    <div class="flex justify-between items-center mb-3">
                        <div>
                            <h3 class="font-bold text-gray-800 capitalize dark:text-white">
                                {{ $post->user->first_name }} {{ $post->user->last_name }}
                            </h3>
                            <p class="text-sm text-gray-500 dark:text-white">{{ $post->created_at->diffForHumans() }}</p>
                        </div>
                        <div class="flex gap-2 items-center">
                            <a href="{{ route('posts.show', ['id' => $post->id]) }}">
                                <x-primary-button>{{ __('View') }}</x-primary-button>
                            </a>
                            @if (auth()->id() === $post->user_id)
                                <a href="{{ route('posts.edit', ['id' => $post->id]) }}">
                                    <x-primary-button>{{ __('Update') }}</x-primary-button>
                                </a>
                                <form action="{{ route('posts.destroy', ['id' => $post->id]) }}" method="POST">
                                    @csrf
                                    @method('delete')
                                    <x-danger-button>{{ __('Delete') }}</x-danger-button>
                                </form>
                            @endif
                        </div>
                    </div>
                    <p class="mt-3 text-xl font-bold capitalize">{{ $post->title }}</p>
                    <p class="mt-3 text-base text-gray-700 capitalize dark:text-white">{{ $post->description }}</p>
                    <p class="mt-3 text-base">Comments ({{ $post->comments->count() }})</p>
                    <p class="mt-3 text-base">Likes ({{ $post->likes->count() }})</p>
                </div>
            @empty
                <p class="text-gray-500 dark:text-white">No posts yet. Follow users or create your first post!</p>
            @endforelse
        </div>
        <div>
            {{ $posts->links() }}
        </div>
    </div>

    <div class="container mx-auto mt-10 space-y-8">
        <div class="p-5 rounded-lg shadow mb-3 dark:shadow-gray-300">
            <h2 class='text-2xl font-bold mb-4'>Company Posts</h2>
        </div>
        <div class="space-y-6">
            @forelse($companyPosts as $post)
                <div class="p-5 rounded-lg shadow dark:shadow-gray-300">
                    <div class="flex justify-between items-center mb-3">
                        <div>
                            <h3 class="font-bold text-gray-800 capitalize dark:text-white">{{ $post->company->name }}</h3>
                            <p class="text-sm text-gray-500 dark:text-white">{{ $post->created_at->diffForHumans() }}</p>
                        </div>
                        <div class="flex gap-2 items-center">
                            <a href="{{ route('company.posts.show', ['id' => $post->id]) }}">
                                <x-primary-button>{{ __('View') }}</x-primary-button>
                            </a>
                        </div>
                    </div>
                    <p class="mt-3 text-xl font-bold capitalize">{{ $post->title }}</p>
                    <p class="mt-3 text-base text-gray-700 capitalize dark:text-white">{{ $post->description }}</p>
                    <p class="mt-3 text-base">Comments ({{ $post->comments->count() }})</p>
                    <p class="mt-3 text-base">Likes ({{ $post->likes->count() }})</p>
                </div>
            @empty
                <p class="text-gray-500 dark:text-white">No posts yet. Follow users or create your first post!</p>
            @endforelse
        </div>
        <div>
            {{ $companyPosts->links() }}
        </div>
    </div>
</x-app-layout>
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

        <div class="max-w-2xl mx-auto mt-10 bg-white rounded-lg shadow-md p-6">
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
</x-app-layout>
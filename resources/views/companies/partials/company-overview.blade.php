<section class="max-w-4xl mx-auto">
    <div class="relative">
        <div class="h-40 bg-gray-200">
            @isset($company->banner)
                <img src="{{ asset('storage/' . $company->banner) }}" alt="banner" class="w-full h-full object-cover" />
            @else
                <div class="w-full h-full bg-gradient-to-r from-indigo-500 to-indigo-700"></div>
            @endisset
        </div>

        <div class="absolute left-1/2 sm:left-12 -bottom-14 transform -translate-x-1/2 sm:translate-x-0">
            @isset($company->logo)
                <img src="{{ asset('storage/' . $company->logo) }}" alt="logo"
                    class="w-28 h-28 sm:w-32 sm:h-32 rounded-full border-4 border-white shadow-lg object-cover bg-white" />
            @else
                <div
                    class="w-28 h-28 sm:w-32 sm:h-32 rounded-full border-4 border-white shadow-lg flex items-center justify-center bg-indigo-600 text-white text-3xl font-bold uppercase">
                    {{ substr($company->name ?? 'U', 0, 2) }}
                </div>
            @endisset
        </div>
    </div>

    <div class="pt-20 px-6 text-center sm:text-left">
        <h1 class="text-2xl sm:text-3xl font-bold text-gray-900 capitalize">
            {{ $company->name }}
        </h1>
    </div>

    <hr class="my-6 border-gray-200">

    <div class="px-6 text-center sm:text-left">
        <h2 class='text-lg font-bold'>Your status</h2>
        @if($member->role)
            <p class="text-base">
                {{ $member->position ?? 'N/A' }} - {{ $member->department ?? 'N/A' }} - {{ $member->status }} -
                {{ $member->role }} - {{ $member->joining_date }} - {{ $member->leaving_date ?? 'Present' }}
            </p>
        @else
            <p>You are not a member of this company.</p>
        @endif
    </div>

    <hr class="my-6 border-gray-200">

    {{-- @if (auth()->id() !== $company->id)
    @if (auth()->user()->isFollowing($company))
    <form action="{{ route('users.unfollow', $company) }}" method="POST">
        @csrf
        @method('delete')

        <x-danger-button>{{ __('Unfollow') }}</x-danger-button>
    </form>
    @else
    <form action="{{ route('users.follow', $company) }}" method="POST">
        @csrf

        <x-primary-button>{{ __('Follow') }}</x-primary-button>
    </form>
    @endif
    <hr class="my-6 border-gray-200">
    @endif --}}

    {{-- <div class="mt-6 grid grid-cols-2 text-center pt-4">
        <div>
            <p class="text-lg font-bold">{{ $company->followings->count() }}</p>
            <p class="text-gray-600">Followings</p>
        </div>
    </div> --}}

    {{--
    <hr class="my-6 border-gray-200"> --}}

    {{-- <div class="mt-8">
        <h3 class="text-xl font-semibold mt-8 mb-4">Following</h3>
        <div class="space-y-3">
            @forelse($company->following as $followed)
            <div class="flex items-center justify-between bg-gray-50 p-3 rounded-lg">
                <span>{{ $followed->first_name }} {{ $followed->last_name }}</span>
                <a href="{{ route('profile', ['id' => $followed->id]) }}" class="text-blue-500 hover:underline">View</a>
            </div>
            @empty
            <p class="text-gray-500">Not following anyone yet.</p>
            @endforelse
        </div>
    </div>

    <hr class="my-6 border-gray-200"> --}}

    <div class="grid grid-cols-1 md:grid-cols-2 gap-x-10 gap-y-6 px-6 pb-6 text-gray-700">
        <div>
            <p class="text-sm text-gray-500 font-medium">Email Address</p>
            <h2 class="text-lg font-semibold truncate">{{ $company->email }}</h2>
        </div>
        <div>
            <p class="text-sm text-gray-500 font-medium">Created Since</p>
            <h2 class="text-lg font-semibold">
                {{ \Carbon\Carbon::parse($company->created_at)->format('M d, Y') }}
            </h2>
        </div>
        <div>
            <p class="text-sm text-gray-500 font-medium">Phone Number</p>
            <h2 class="text-lg font-semibold">{{ $company->phone_number }}</h2>
        </div>
        <div>
            <p class="text-sm text-gray-500 font-medium">Company ID</p>
            <h2 class="text-lg font-semibold">{{ $company->id }}</h2>
        </div>
        <div>
            <p class="text-sm text-gray-500 font-medium">Location</p>
            <h2 class="text-lg font-semibold">{{ $company->location }}</h2>
        </div>
        <div>
            <p class="text-sm text-gray-500 font-medium">Size</p>
            <h2 class="text-lg font-semibold">{{ $company->size }}</h2>
        </div>
        <div>
            <p class="text-sm text-gray-500 font-medium">Sector</p>
            <h2 class="text-lg font-semibold">{{ $company->sector }}</h2>
        </div>
    </div>

    @if($company->description)
        <div class="px-6 py-4 border-t border-gray-100 bg-gray-50">
            <h3 class="text-lg font-semibold text-gray-800 mb-1">Description</h3>
            <p class="text-gray-700 mb-3">{{ $company->description }}</p>

            <h3 class="text-lg font-semibold text-gray-800 mb-1">Slogan</h3>
            <p class="text-gray-700">{{ $company->slogan }}</p>
        </div>
    @endif

    @if ($company->linkedin_url)
        <div class="px-6 py-4 border-t border-gray-100 bg-gray-50">
            <h3 class="text-lg font-semibold text-gray-800 mb-3">Social Profiles</h3>
            <div class="flex items-center gap-3 flex-wrap">
                @if ($company->linkedin_url)
                    <a href="{{ $company->linkedin_url }}" target="_blank" class="text-indigo-600 hover:underline">LinkedIn</a>
                @endif
                @if ($company->twitter_url)
                    <a href="{{ $company->twitter_url }}" target="_blank" class="text-indigo-600 hover:underline">Twitter</a>
                @endif
                @if ($company->facebook_url)
                    <a href="{{ $company->facebook_url }}" target="_blank" class="text-indigo-600 hover:underline">Facebook</a>
                @endif
                @if ($company->youtube_url)
                    <a href="{{ $company->youtube_url }}" target="_blank" class="text-indigo-600 hover:underline">Youtube</a>
                @endif
                @if ($company->instagram_url)
                    <a href="{{ $company->instagram_url }}" target="_blank"
                        class="text-indigo-600 hover:underline">Instagram</a>
                @endif
                @if ($company->website_url)
                    <a href="{{ $company->website_url }}" target="_blank" class="text-indigo-600 hover:underline">Personal
                        Website</a>
                @endif
            </div>
        </div>
    @endif

    <div class="px-6 py-4 border-t border-gray-100">
        <h3 class="text-lg font-semibold text-gray-800 mb-3">Members</h3>
        <div class="grid gap-3">
            @forelse ($company->members as $member)
                <div class="p-3 border rounded-lg hover:shadow-sm transition-all">
                    <h4 class="text-lg font-semibold text-gray-900">{{ $member->user->first_name }}
                        {{ $member->user->last_name }}
                    </h4>
                    <p class="text-gray-700">{{ $member->position ?? 'N/A' }} - {{ $member->department ?? 'N/A' }} -
                        {{ $member->status }} - {{ $member->role }} - {{ $member->joining_date }} -
                        {{ $member->leaving_date ?? 'Present' }}
                    </p>
                </div>
            @empty
                <p class="text-gray-500 italic">No members</p>
            @endforelse
        </div>
    </div>

    {{-- <div class="mt-10 border-t pt-6">
        <h3 class="text-xl font-semibold mb-4">Posts by {{ $company->name }}</h3>

        @forelse($company->posts()->paginate(5) as $post)
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
            <p class="mt-3 text-base">Comments ({{ $post->comments->count() }})</p>
            <p class="mt-3 text-base">Likes ({{ $post->likes->count() }})</p>
        </div>
        @empty
        <p class="text-gray-500">No posts yet.</p>
        @endforelse
        <div class="mt-4">
            {{ $company->posts()->paginate(5)->links() }}
        </div>
    </div> --}}
</section>
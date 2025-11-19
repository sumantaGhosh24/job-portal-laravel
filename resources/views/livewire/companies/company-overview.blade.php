<section class="max-w-4xl mx-auto">
    <div class="relative">
        <div class="h-40">
            @if($company->banner)
                <img src="{{ asset('storage/' . $company->banner) }}" alt="banner" class="w-full h-full object-cover" />
            @else
                <div class="w-full h-full bg-gradient-to-r from-blue-500 to-blue-700"></div>
            @endif
        </div>
        <div class="absolute left-1/2 sm:left-12 -bottom-14 transform -translate-x-1/2 sm:translate-x-0">
            @if($company->logo)
                <img src="{{ asset('storage/' . $company->logo) }}" alt="logo"
                    class="w-28 h-28 sm:w-32 sm:h-32 rounded-full border-4 border-white shadow-lg object-cover bg-white dark:shadow-gray-300" />
            @else
                <div
                    class="w-28 h-28 sm:w-32 sm:h-32 rounded-full border-4 border-white shadow-lg flex items-center justify-center bg-blue-600 text-white text-3xl font-bold uppercase dark:shadow-gray-300">
                    {{ substr($company->name ?? 'U', 0, 2) }}
                </div>
            @endif
        </div>
    </div>

    <div class="pt-20 px-6 text-center sm:text-left">
        <h1 class="text-2xl sm:text-3xl font-bold text-gray-900 capitalize dark:text-white">
            {{ $company->name }}
        </h1>
    </div>

    <hr class="my-6 border-gray-200">

    <div class="px-6 text-center sm:text-left">
        <h2 class='text-lg font-bold'>Your status</h2>
        @if($member)
            <p class="text-base">
                {{ $member->position ?? 'N/A' }} - {{ $member->department ?? 'N/A' }} - {{ $member->status }} -
                {{ $member->role }} - {{ $member->joining_date }} - {{ $member->leaving_date ?? 'Present' }}
            </p>
        @else
            <p>You are not a member of this company.</p>
        @endif
    </div>

    <hr class="my-6 border-gray-200">

    @if (auth()->user()->isFollowingCompany($company))
        <x-danger-button wire:click="unfollow" wire:loading.attr="disabled">
            <span wire:loading.remove>Unfollow</span>
            <span wire:loading>Unfollowing...</span>
        </x-danger-button>
    @else
        <x-primary-button wire:click="follow" wire:loading.attr="disabled">
            <span wire:loading.remove>Follow</span>
            <span wire:loading>Following</span>
        </x-primary-button>
    @endif

    <hr class="my-6 border-gray-200">

    <div class="mt-6 grid grid-cols-1 text-center pt-4">
        <div>
            <p class="text-lg font-bold">{{ $company->followers->count() }}</p>
            <p class="text-gray-600 dark:text-white">Followers</p>
        </div>
    </div>

    <hr class="my-6 border-gray-200">

    <div class="mt-8">
        <h3 class="text-xl font-semibold mt-8 mb-4">Followers</h3>
        <div class="space-y-3">
            @forelse($company->followers as $followers)
                <div class="flex items-center justify-between bg-gray-50 p-3 rounded-lg dark:bg-gray-700"
                    wire:key="{{ $followers->id }}">
                    <span>{{ $followers->first_name }} {{ $followers->last_name }}</span>
                    <a href="{{ route('profile', ['id' => $followers->id]) }}" class="text-blue-500 hover:underline"
                        wire:navigate>View</a>
                </div>
            @empty
                <p class="text-gray-500 dark:text-white">Not followers anyone yet.</p>
            @endforelse
        </div>
    </div>

    <hr class="my-6 border-gray-200">

    <div class="grid grid-cols-1 md:grid-cols-2 gap-x-10 gap-y-6 px-6 pb-6">
        <div>
            <p class="text-sm text-gray-500 font-medium dark:text-white">Email Address</p>
            <h2 class="text-lg font-semibold truncate">{{ $company->email }}</h2>
        </div>
        <div>
            <p class="text-sm text-gray-500 font-medium dark:text-white">Created Since</p>
            <h2 class="text-lg font-semibold">
                {{ \Carbon\Carbon::parse($company->created_at)->format('M d, Y') }}
            </h2>
        </div>
        <div>
            <p class="text-sm text-gray-500 font-medium dark:text-white">Phone Number</p>
            <h2 class="text-lg font-semibold">{{ $company->phone_number }}</h2>
        </div>
        <div>
            <p class="text-sm text-gray-500 font-medium dark:text-white">Company ID</p>
            <h2 class="text-lg font-semibold">{{ $company->id }}</h2>
        </div>
        <div>
            <p class="text-sm text-gray-500 font-medium dark:text-white">Location</p>
            <h2 class="text-lg font-semibold">{{ $company->location }}</h2>
        </div>
        <div>
            <p class="text-sm text-gray-500 font-medium dark:text-white">Size</p>
            <h2 class="text-lg font-semibold">{{ $company->size }}</h2>
        </div>
        <div>
            <p class="text-sm text-gray-500 font-medium dark:text-white">Sector</p>
            <h2 class="text-lg font-semibold">{{ $company->sector }}</h2>
        </div>
    </div>

    @if($company->description)
        <div class="px-6 py-4 border-t border-gray-100 bg-gray-50 dark:bg-gray-700">
            <h3 class="text-lg font-semibold text-gray-800 mb-1 dark:text-white">Description</h3>
            <p class="text-gray-700 mb-3 dark:text-white">{{ $company->description }}</p>
            <h3 class="text-lg font-semibold text-gray-800 mb-1 dark:text-white">Slogan</h3>
            <p class="text-gray-700 dark:text-white">{{ $company->slogan }}</p>
        </div>
    @endif

    @if ($company->linkedin_url)
        <div class="px-6 py-4 border-t border-gray-100 bg-gray-50 dark:bg-gray-700">
            <h3 class="text-lg font-semibold text-gray-800 mb-3 dark:text-white">Social Profiles</h3>
            <div class="flex items-center gap-3 flex-wrap">
                @if ($company->linkedin_url)
                    <a href="{{ $company->linkedin_url }}" target="_blank" class="text-blue-600 hover:underline">LinkedIn</a>
                @endif
                @if ($company->twitter_url)
                    <a href="{{ $company->twitter_url }}" target="_blank" class="text-blue-600 hover:underline">Twitter</a>
                @endif
                @if ($company->facebook_url)
                    <a href="{{ $company->facebook_url }}" target="_blank" class="text-blue-600 hover:underline">Facebook</a>
                @endif
                @if ($company->youtube_url)
                    <a href="{{ $company->youtube_url }}" target="_blank" class="text-blue-600 hover:underline">Youtube</a>
                @endif
                @if ($company->instagram_url)
                    <a href="{{ $company->instagram_url }}" target="_blank" class="text-blue-600 hover:underline">Instagram</a>
                @endif
                @if ($company->website_url)
                    <a href="{{ $company->website_url }}" target="_blank" class="text-blue-600 hover:underline">Personal
                        Website</a>
                @endif
            </div>
        </div>
    @endif

    <div class="px-6 py-4 border-t border-gray-100">
        <h3 class="text-lg font-semibold text-gray-800 mb-3 dark:text-white">Members</h3>
        <div class="grid gap-3">
            @forelse ($company->members as $member)
                <div class="p-3 border rounded-lg" wire:key="{{ $member->id }}">
                    <h4 class="text-lg font-semibold text-gray-900 dark:text-white">
                        {{ $member->user->first_name }} {{ $member->user->last_name }}
                    </h4>
                    <p class="text-gray-700 dark:text-white">
                        {{ $member->position ?? 'N/A' }} - {{ $member->department ?? 'N/A' }} - {{ $member->status }} -
                        {{ $member->role }} - {{ $member->joining_date }} - {{ $member->leaving_date ?? 'Present' }}
                    </p>
                </div>
            @empty
                <p class="text-gray-500 italic dark:text-white">No members</p>
            @endforelse
        </div>
    </div>

    <div class="mt-10 border-t pt-6">
        <div class="flex items-center justify-between">
            <h3 class="text-xl font-semibold mb-4">Posts by - {{ $company->name }}</h3>
            <a href={{ route('company.posts.create', ['id' => $company->id]) }} wire:navigate>
                <x-primary-button>Create Post</x-primary-button>
            </a>
        </div>
        @php($posts = $company->posts()->paginate(5))
        @forelse($posts as $post)
            <div class="p-5 rounded-lg shadow dark:shadow-gray-300" wire:key="{{ $post->id }}">
                <div class="flex justify-between items-center mb-3">
                    <div>
                        <h3 class="font-bold text-gray-800 capitalize dark:text-white">{{ $post->company->name }}</h3>
                        <p class="text-sm text-gray-500 dark:text-white">{{ $post->created_at->diffForHumans() }}</p>
                    </div>
                    <div class="flex gap-2 items-center">
                        <a href="{{ route('company.posts.show', ['id' => $post->id]) }}" wire:navigate>
                            <x-primary-button>{{ __('View') }}</x-primary-button>
                        </a>
                        @if (auth()->id() === $post->company->owner_id)
                            <a href="{{ route('company.posts.edit', ['id' => $post->id]) }}" wire:navigate>
                                <x-primary-button>{{ __('Update') }}</x-primary-button>
                            </a>
                            <x-danger-button wire:click="deletePost({{ $post->id }})" wire:loading.attr="disabled">
                                <span wire:loading.remove>Delete</span>
                                <span wire:loading>Deleting...</span>
                            </x-danger-button>
                        @endif
                    </div>
                </div>
                <p class="mt-3 text-xl font-bold capitalize">{{ $post->title }}</p>
                <p class="mt-3 text-base text-gray-700 capitalize dark:text-white">{{ $post->description }}</p>
                <p class="mt-3 text-base">Comments ({{ $post->comments->count() }})</p>
                <p class="mt-3 text-base">Likes ({{ $post->likes->count() }})</p>
            </div>
        @empty
            <p class="text-gray-500 dark:text-white">No posts yet.</p>
        @endforelse
        <div class="mt-4">
            {{ $posts->links() }}
        </div>
    </div>

    <div class="mt-10 border-t pt-6">
        <div class="flex items-center justify-between">
            <h3 class="text-xl font-semibold mb-4">Job Posted by - {{ $company->name }}</h3>
            <a href={{ route('jobs.create', ['id' => $company->id]) }} wire:navigate>
                <x-primary-button>Create Job Post</x-primary-button>
            </a>
        </div>
        @php($jobs = $company->jobs()->paginate(5))
        @forelse($jobs as $job)
            <div class="p-5 rounded-lg shadow dark:shadow-gray-300" wire:key="{{ $job->id }}">
                <div class="flex justify-between items-center mb-3">
                    <div>
                        <h3 class="font-bold text-gray-800 capitalize dark:text-white">{{ $job->company->name }}</h3>
                        <p class="text-sm text-gray-500 dark:text-white">{{ $job->created_at->diffForHumans() }}</p>
                    </div>
                    <div class="flex gap-2 items-center">
                        <a href="{{ route('jobs.show', ['id' => $job->id]) }}" wire:navigate>
                            <x-primary-button>{{ __('View') }}</x-primary-button>
                        </a>
                        @if (auth()->id() === $job->company->owner_id)
                            <a href="{{ route('jobs.edit', ['id' => $job->id]) }}" wire:navigate>
                                <x-primary-button>{{ __('Update') }}</x-primary-button>
                            </a>
                            <x-danger-button wire:click="deleteJob({{ $job->id }})" wire:loading.attr="disabled">
                                <span wire:loading.remove>Delete</span>
                                <span wire:loading>Deleting...</span>
                            </x-danger-button>
                        @endif
                    </div>
                </div>
                <p class="mt-3 text-xl font-bold capitalize">{{ $job->title }}</p>
                <p class="mt-3 text-base text-gray-700 capitalize dark:text-white">{{ $job->description }}</p>
                <p class="mt-3 text-base">Type: {{ $job->type }}</p>
                <p class="mt-3 text-base">Salary: ₹ {{ $job->salary }}</p>
            </div>
        @empty
            <p class="text-gray-500 dark:text-white">No job posts yet.</p>
        @endforelse
        <div class="mt-4">
            {{ $jobs->links() }}
        </div>
    </div>
</section>
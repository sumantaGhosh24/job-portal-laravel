<section class="max-w-4xl mx-auto">
    <div class="relative">
        <div class="h-40 bg-gray-200">
            @isset($user->background_image)
                <img src="{{ asset('storage/' . $user->background_image) }}" alt="background_image"
                    class="w-full h-full object-cover" />
            @else
                <div class="w-full h-full bg-gradient-to-r from-indigo-500 to-indigo-700"></div>
            @endisset
        </div>

        <div class="absolute left-1/2 sm:left-12 -bottom-14 transform -translate-x-1/2 sm:translate-x-0">
            @isset($user->profile_image)
                <img src="{{ asset('storage/' . $user->profile_image) }}" alt="profile_image"
                    class="w-28 h-28 sm:w-32 sm:h-32 rounded-full border-4 border-white shadow-lg object-cover bg-white" />
            @else
                <div
                    class="w-28 h-28 sm:w-32 sm:h-32 rounded-full border-4 border-white shadow-lg flex items-center justify-center bg-indigo-600 text-white text-3xl font-bold uppercase">
                    {{ substr($user->first_name ?? 'U', 0, 1) }}{{ substr($user->last_name ?? 'N', 0, 1) }}
                </div>
            @endisset
        </div>
    </div>

    <div class="pt-20 px-6 text-center sm:text-left">
        <h1 class="text-2xl sm:text-3xl font-bold text-gray-900">
            {{ $user->first_name }} {{ $user->last_name }}
        </h1>
        <p class="text-indigo-600 font-medium">@ {{ $user->username }}</p>

        @isset($user->desired_job_title)
            <div class="mt-2">
                <p class="text-lg font-semibold text-gray-800">{{ $user->desired_job_title }}</p>
                <span class="inline-block px-3 py-1 mt-1 text-sm font-semibold bg-indigo-100 text-indigo-700 rounded-full">
                    {{ $user->desired_job_type }}
                </span>
            </div>
        @endisset
    </div>

    <hr class="my-6 border-gray-200">

    @if (auth()->id() !== $user->id)
        @if (auth()->user()->isFollowing($user))
            <form action="{{ route('users.unfollow', $user) }}" method="POST">
                @csrf
                @method('delete')

                <x-danger-button>{{ __('Unfollow') }}</x-danger-button>
            </form>
        @else
            <form action="{{ route('users.follow', $user) }}" method="POST">
                @csrf

                <x-primary-button>{{ __('Follow') }}</x-primary-button>
            </form>
        @endif
        <hr class="my-6 border-gray-200">
    @endif

    <div class="mt-6 grid grid-cols-2 text-center pt-4">
        <div>
            <p class="text-lg font-bold">{{ $user->followers->count() }}</p>
            <p class="text-gray-600">Followers</p>
        </div>
        <div>
            <p class="text-lg font-bold">{{ $user->following->count() }}</p>
            <p class="text-gray-600">Following</p>
        </div>
    </div>

    <hr class="my-6 border-gray-200">

    <div class="mt-8">
        <h3 class="text-xl font-semibold mb-4">Followers</h3>
        <div class="space-y-3">
            @forelse($user->followers as $follower)
                <div class="flex items-center justify-between bg-gray-50 p-3 rounded-lg">
                    <span>{{ $follower->first_name }} {{ $follower->last_name }}</span>
                    <a href="{{ route('profile', ['id' => $follower->id]) }}" class="text-blue-500 hover:underline">View</a>
                </div>
            @empty
                <p class="text-gray-500">No followers yet.</p>
            @endforelse
        </div>

        <h3 class="text-xl font-semibold mt-8 mb-4">Following</h3>
        <div class="space-y-3">
            @forelse($user->following as $followed)
                <div class="flex items-center justify-between bg-gray-50 p-3 rounded-lg">
                    <span>{{ $followed->first_name }} {{ $followed->last_name }}</span>
                    <a href="{{ route('profile', ['id' => $followed->id]) }}" class="text-blue-500 hover:underline">View</a>
                </div>
            @empty
                <p class="text-gray-500">Not following anyone yet.</p>
            @endforelse
        </div>
    </div>

    <hr class="my-6 border-gray-200">

    <div class="grid grid-cols-1 md:grid-cols-2 gap-x-10 gap-y-6 px-6 pb-6 text-gray-700">
        <div>
            <p class="text-sm text-gray-500 font-medium">Email Address</p>
            <h2 class="text-lg font-semibold truncate">{{ $user->email }}</h2>
        </div>
        <div>
            <p class="text-sm text-gray-500 font-medium">Member Since</p>
            <h2 class="text-lg font-semibold">
                {{ \Carbon\Carbon::parse($user->created_at)->format('M d, Y') }}
            </h2>
        </div>

        @isset($user->mobile_number)
            <div>
                <p class="text-sm text-gray-500 font-medium">Mobile Number</p>
                <h2 class="text-lg font-semibold">{{ $user->mobile_number }}</h2>
            </div>
            <div>
                <p class="text-sm text-gray-500 font-medium">User ID</p>
                <h2 class="text-lg font-semibold">{{ $user->id }}</h2>
            </div>

            <div class="md:col-span-2">
                <p class="text-sm text-gray-500 font-medium">Address</p>
                <div class="mt-1 space-y-1">
                    <p class="text-lg font-semibold">{{ $user->addressline ?? 'N/A' }}</p>
                    <p class="text-lg font-semibold text-gray-600">
                        {{ $user->city ?? '' }}{{ $user->city && $user->state ? ', ' : '' }}{{ $user->state ?? '' }}
                        {{ ($user->city || $user->state) && $user->zip ? ' ' : '' }}{{ $user->zip ?? '' }}
                    </p>
                    <p class="text-lg font-semibold text-gray-500">{{ $user->country ?? 'N/A' }}</p>
                </div>
            </div>
        @endisset
    </div>

    @if($user->headline)
        <div class="px-6 py-4 border-t border-gray-100 bg-gray-50">
            <h3 class="text-lg font-semibold text-gray-800 mb-1">Headline</h3>
            <p class="text-gray-700 mb-3">{{ $user->headline }}</p>

            <h3 class="text-lg font-semibold text-gray-800 mb-1">Professional Summary</h3>
            <p class="text-gray-700">{{ $user->professional_summary }}</p>
        </div>
    @endif

    @if ($user->resume)
        <div class="px-6 py-4 border-t border-gray-100">
            <h3 class="text-lg font-semibold text-gray-800 mb-2">Resume</h3>
            <a href="{{ asset('storage/' . $user->resume) }}" target="_blank"
                class="inline-flex items-center px-4 py-2 bg-indigo-600 text-white rounded-md shadow hover:bg-indigo-700 transition-all">
                Download Resume
            </a>
        </div>
    @endif

    @if ($user->linkedin_url || $user->github_url || $user->website_url)
        <div class="px-6 py-4 border-t border-gray-100 bg-gray-50">
            <h3 class="text-lg font-semibold text-gray-800 mb-3">Social Profiles</h3>
            <div class="flex flex-col space-y-2">
                @if ($user->linkedin_url)
                    <a href="{{ $user->linkedin_url }}" target="_blank" class="text-indigo-600 hover:underline">LinkedIn</a>
                @endif
                @if ($user->github_url)
                    <a href="{{ $user->github_url }}" target="_blank" class="text-indigo-600 hover:underline">GitHub</a>
                @endif
                @if ($user->website_url)
                    <a href="{{ $user->website_url }}" target="_blank" class="text-indigo-600 hover:underline">Personal
                        Website</a>
                @endif
            </div>
        </div>
    @endif

    <div class="px-6 py-4 border-t border-gray-100">
        <h3 class="text-lg font-semibold text-gray-800 mb-3">Languages</h3>
        <ul class="list-disc pl-5 space-y-1 text-gray-700">
            @forelse ($user->languages as $language)
                <li>{{ $language->name }} - {{ $language->proficiency }}</li>
            @empty
                <p class="text-gray-500 italic">No languages listed</p>
            @endforelse
        </ul>
    </div>

    <div class="px-6 py-4 border-t border-gray-100 bg-gray-50">
        <h3 class="text-lg font-semibold text-gray-800 mb-3">Certificates</h3>
        <ul class="list-disc pl-5 space-y-1 text-gray-700">
            @forelse ($user->certificates as $certificate)
                <li>
                    {{ $certificate->name }} — {{ $certificate->issuing_organization }}
                    ({{ $certificate->issue_date }})
                </li>
            @empty
                <p class="text-gray-500 italic">No certificates</p>
            @endforelse
        </ul>
    </div>

    <div class="px-6 py-4 border-t border-gray-100">
        <h3 class="text-lg font-semibold text-gray-800 mb-3">Projects</h3>
        <div class="grid gap-3">
            @forelse ($user->projects as $project)
                <div class="p-3 border rounded-lg hover:shadow-sm transition-all">
                    <h4 class="text-lg font-semibold text-gray-900">{{ $project->title }}</h4>
                    <p class="text-gray-700">{{ $project->description }}</p>
                    @if ($project->github_url)
                        <a href="{{ $project->github_url }}" target="_blank" class="text-indigo-600 hover:underline text-sm">
                            View on GitHub
                        </a>
                    @endif
                </div>
            @empty
                <p class="text-gray-500 italic">No projects</p>
            @endforelse
        </div>
    </div>

    <div class="px-6 py-4 border-t border-gray-100 bg-gray-50">
        <h3 class="text-lg font-semibold text-gray-800 mb-3">Skills</h3>
        <div class="flex flex-wrap gap-2">
            @forelse ($user->skills as $skill)
                <span class="px-3 py-1 bg-indigo-100 text-indigo-700 rounded-full text-sm font-medium">
                    {{ $skill->name }} - {{ $skill->proficiency }}
                </span>
            @empty
                <p class="text-gray-500 italic">No skills</p>
            @endforelse
        </div>
    </div>

    <div class="px-6 py-4 border-t border-gray-100">
        <h3 class="text-lg font-semibold text-gray-800 mb-3">Education</h3>
        <ul class="list-disc pl-5 space-y-1 text-gray-700">
            @forelse ($user->educations as $education)
                <li>
                    {{ $education->degree }} in {{ $education->field_of_study }} —
                    {{ $education->institution_name }} ({{ $education->location }}, {{ $education->graduation_date }})
                </li>
            @empty
                <p class="text-gray-500 italic">No education details</p>
            @endforelse
        </ul>
    </div>

    <div class="px-6 py-4 border-t border-gray-100 bg-gray-50 rounded-b-xl">
        <h3 class="text-lg font-semibold text-gray-800 mb-3">Experience</h3>
        <ul class="list-disc pl-5 space-y-1 text-gray-700">
            @forelse ($user->experiences as $experience)
                <li>
                    {{ $experience->job_title }} — {{ $experience->company_name }} ({{ $experience->location }})
                    [{{ $experience->start_date }} - {{ $experience->end_date ?? 'Present' }}]
                </li>
            @empty
                <p class="text-gray-500 italic">No experiences</p>
            @endforelse
        </ul>
    </div>

    <div class="mt-10 border-t pt-6">
        <h3 class="text-xl font-semibold mb-4">Posts by {{ $user->name }}</h3>

        @forelse($user->posts()->paginate(5) as $post)
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
            {{ $user->posts()->paginate(5)->links() }}
        </div>
    </div>
</section>
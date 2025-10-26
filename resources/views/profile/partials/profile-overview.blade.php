<section class="max-w-4xl mx-auto">
    <div class="relative">
        <div class="h-32 bg-gray-200 rounded-t-xl overflow-hidden">
            @isset($user->background_image)
                <img src="{{ asset('storage/' . $user->background_image) }}" alt="background_image"
                    class="w-full h-full object-cover" />
            @else
                <div class="w-full h-full bg-indigo-500/70"></div>
            @endisset
        </div>
        <div class="flex flex-col items-center sm:items-start -mt-16 px-6 pb-4">
            @isset($user->profile_image)
                <img src="{{ asset('storage/' . $user->profile_image) }}" alt="profile_image"
                    class="w-24 h-24 sm:w-32 sm:h-32 rounded-full border-4 border-white shadow-lg object-cover bg-white" />
            @else
                <div
                    class="w-24 h-24 sm:w-32 sm:h-32 rounded-full border-4 border-white shadow-lg flex items-center justify-center bg-indigo-500 text-white text-3xl font-bold">
                    {{ substr($user->first_name ?? 'U', 0, 1) }}{{ substr($user->last_name ?? 'N', 0, 1) }}
                </div>
            @endisset
            <h1 class="text-3xl font-bold mt-4 text-gray-900">
                {{ $user->first_name }} {{ $user->last_name }}
            </h1>
            <p class="text-lg text-indigo-600">
                @<span class="font-medium">{{ $user->username }}</span>
            </p>
            @isset($user->desired_job_title)
                <div class="mt-2 text-center sm:text-left">
                    <p class="text-xl font-semibold text-gray-800">
                        {{ $user->desired_job_title }}
                    </p>
                    <span class="inline-block px-3 py-1 text-sm font-semibold bg-indigo-100 text-indigo-800 rounded-full">
                        {{ $user->desired_job_type }}
                    </span>
                </div>
            @endisset
        </div>
    </div>
    <hr class="my-6 border-gray-200">
    <div class="grid grid-cols-1 md:grid-cols-2 gap-x-10 gap-y-4 px-6 text-gray-700">
        <div class="flex flex-col">
            <span class="text-sm font-medium text-gray-500">Email Address</span>
            <h2 class="text-lg font-semibold truncate">{{ $user->email }}</h2>
        </div>
        <div class="flex flex-col">
            <span class="text-sm font-medium text-gray-500">Member Since</span>
            <h2 class="text-lg font-semibold">
                {{ \Carbon\Carbon::parse($user->created_at)->format('M d, Y') }}
            </h2>
        </div>
        @isset($user->mobile_number)
            <div class="flex flex-col">
                <span class="text-sm font-medium text-gray-500">Mobile Number</span>
                <h2 class="text-lg font-semibold">{{ $user->mobile_number }}</h2>
            </div>
            <div class="flex flex-col">
                <span class="text-sm font-medium text-gray-500">User ID</span>
                <h2 class="text-lg font-semibold">{{ $user->id }}</h2>
            </div>
            <div class="md:col-span-2 flex flex-col pt-2">
                <span class="text-sm font-medium text-gray-500">Address</span>
                <h2 class="text-lg font-semibold">
                    {{ $user->addressline ?? 'N/A' }}
                </h2>
                <h2 class="text-lg font-semibold mt-1">
                    {{ $user->city ?? '' }}{{ $user->city && $user->state ? ', ' : '' }}{{ $user->state ?? '' }}{{ ($user->city || $user->state) && $user->zip ? ' ' : '' }}{{ $user->zip ?? '' }}
                </h2>
                <h2 class="text-lg font-semibold mt-1 text-gray-600">
                    {{ $user->country ?? 'N/A' }}
                </h2>
            </div>
        @endisset
    </div>
</section>
<x-app-layout>
    <x-slot:title>Jobs</x-slot:title>

    @if (session('message'))
        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="overflow-hidden shadow-sm sm:rounded-lg dark:shadow-gray-300">
                    <p class="p-6">{{ session('message') }}</p>
                </div>
            </div>
        </div>
    @endif

    <div class="container mx-auto mt-10 space-y-8">
        <div class="p-5 rounded-lg shadow mb-3 dark:shadow-gray-300">
            <h2 class="text-2xl font-bold mb-4">Available Jobs</h2>
        </div>
        <div class="space-y-6">
            @forelse($jobs as $job)
                <div class="p-5 rounded-lg shadow dark:shadow-gray-300">
                    <div class="flex justify-between items-center mb-3">
                        <div>
                            <h3 class="font-bold text-gray-800 capitalize dark:text-white">{{ $job->company->name }}</h3>
                            <p class="text-sm text-gray-500 dark:text-white">{{ $job->created_at->diffForHumans() }}</p>
                        </div>
                        <div class="flex gap-2 items-center">
                            <a href="{{ route('jobs.show', $job->id) }}">
                                <x-primary-button>{{ __('View') }}</x-primary-button>
                            </a>
                        </div>
                    </div>
                    <p class="mt-3 text-xl font-bold capitalize">{{ $job->title }}</p>
                    <p class="mt-3 text-base text-gray-700 capitalize dark:text-white">Location: {{ $job->location }}</p>
                    <p class="mt-3 text-base">Type: {{ $job->type }}</p>
                    <p class="mt-3 text-base">Salary: ₹ {{ $job->salary }}</p>
                    <p class="mt-3 text-base">
                        Deadline: {{ $job->deadline ? $job->deadline->format('M d, Y') : 'Open until filled' }}
                    </p>
                </div>
            @empty
                <p class="text-gray-500 dark:text-white">No job postings available at the moment.</p>
            @endforelse
        </div>
        <div>
            {{ $jobs->links() }}
        </div>
    </div>
</x-app-layout>
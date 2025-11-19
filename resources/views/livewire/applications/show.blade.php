<div>
    @if (session('message'))
        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="overflow-hidden shadow-sm sm:rounded-lg dark:shadow-gray-300">
                    <p class="p-6">{{ session('message') }}</p>
                </div>
            </div>
        </div>
    @endif

    <div class="container mx-auto p-5 rounded-md shadow-md my-5 dark:shadow-gray-300">
        <h3 class="text-2xl font-semibold mb-5">Application Details</h3>
        @if(auth()->id() === $application->user_id || auth()->id() === $application->job->company->owner_id)
            <div>
                <h3 class="text-xl capitalize font-bold">{{ $application->job->title }}</h3>
                <h4 class="text-lg font-semibold capitalize my-4">{{ $application->job->company->name }}</h4>
                <p>
                    <strong>Application Status:</strong>
                    @if($application->status == 'pending')
                        <span class="px-1 py-1 rounded bg-yellow-600 text-white">Pending</span>
                    @elseif($application->status == 'reviewing')
                        <span class="px-1 py-1 rounded bg-orange-600 text-white">Reviewing</span>
                    @elseif($application->status == 'interviewed')
                        <span class="px-1 py-1 rounded bg-blue-600 text-white">Interviewed</span>
                    @elseif($application->status == 'accepted')
                        <span class="px-1 py-1 rounded bg-green-600 text-white">Accepted</span>
                    @elseif($application->status == 'rejected')
                        <span class="px-1 py-1 rounded bg-red-600 text-white">Rejected</span>
                    @endif
                </p>
                @if(auth()->id() == $application->job->company->owner_id)
                    <form wire:submit="updateStatus" class="my-5">
                        <div class="mt-4">
                            <x-input-label for="status" :value="__('Application Status')" />
                            <select id="status" wire:model="status"
                                class="mt-2 w-full px-4 py-2 rounded-md border border-gray-300">
                                <option value="pending">Pending</option>
                                <option value="reviewing">Reviewing</option>
                                <option value="interviewed">Interviewed</option>
                                <option value="accepted">Accepted</option>
                                <option value="rejected">Rejected</option>
                            </select>
                            @error('status') <span class="text-lg text-red-600 mt-2">{{ $message }}</span> @enderror
                        </div>
                        <div class="mt-4">
                            <x-input-label for="feedback" :value="__('Application Feedback')" />
                            <textarea id="feedback" wire:model="feedback"
                                class="mt-1 block w-full px-4 py-2 rounded-md border border-gray-300" required></textarea>
                            @error('feedback') <span class="text-lg text-red-600 mt-2">{{ $message }}</span> @enderror
                        </div>
                        <x-primary-button class="mt-5">
                            <span wire:loading.remove>Update Application</span>
                            <span wire:loading>Processing...</span>
                        </x-primary-button>
                    </form>
                @endif
                <h3 class="mt-5 text-xl font-bold">Cover Letter: </h3>
                <p class="text-lg">{{ $application->cover_letter }}</p>
                <div class="mt-5">
                    <h3 class="text-lg font-semibold text-gray-800 mb-2 dark:text-white">Resume</h3>
                    <a href="{{ asset('storage/' . $application->resume_path) }}" target="_blank">
                        <x-primary-button>{{ __("Download Resume") }}</x-primary-button>
                    </a>
                </div>
                @if ($application->feedback)
                    <h3 class="mt-5 text-xl font-bold">Feedback: </h3>
                    <p class="text-lg">{{ $application->feedback }}</p>
                @endif
            </div>
        @else
            <p class="text-gray-500 dark:text-white">You are not authorized to view this application.</p>
        @endif
    </div>
</div>
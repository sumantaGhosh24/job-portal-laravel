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

    <div class="container mx-auto mt-10 rounded-lg shadow-md p-6 dark:shadow-gray-300">
        @if($job->is_active)
            <div class="space-y-5">
                <h2 class="text-2xl font-bold capitalize">{{ $job->title }}</h2>
                <p class="text-lg font-medium">{{ $job->description }}</p>
                <h5 class="text-base"><strong>Company:</strong> {{ $job->company->name }}</h5>
                <h5 class="text-base"><strong>Location:</strong> {{ $job->location }}</h5>
                <h5 class="text-base"><strong>Job Type:</strong> {{ $job->type }}</h5>
                <h5 class="text-base"><strong>Salary:</strong> ₹ {{ $job->salary }}</h5>
                <h5 class="text-base">
                    <strong>Application Deadline:</strong>
                    {{ $job->deadline ? $job->deadline->format('M d, Y') : 'Open until filled' }}
                </h5>
                <div>
                    <h2 class="text-xl font-bold">Submit Application</h2>
                    <form wire:submit="save">
                        <div>
                            <x-input-label for="resume" :value="__('Resume')" />
                            <x-text-input id="resume" type="file" wire:model="resume"
                                class="mt-1 w-full px-4 py-2 rounded-md border border-gray-300 cursor-pointer" required />
                            @error('resume') <span class="text-lg text-red-600 mt-2">{{ $message }}</span> @enderror
                        </div>
                        <div>
                            <x-input-label for="cover_letter" :value="__('Cover Letter')" />
                            <textarea id="cover_letter" wire:model="cover_letter"
                                class="mt-1 block w-full px-4 py-2 rounded-md border border-gray-300" required></textarea>
                            @error('cover_letter') <span class="text-lg text-red-600 mt-2">{{ $message }}</span> @enderror
                        </div>
                        <x-primary-button class="mt-5">
                            <span wire:loading.remove>Submit Application</span>
                            <span wire:loading>Processing...</span>
                        </x-primary-button>
                    </form>
                </div>
            </div>
        @else
            <p class="text-gray-500 dark:text-white">This job posting is not active anymore.</p>
        @endif
    </div>
</div>
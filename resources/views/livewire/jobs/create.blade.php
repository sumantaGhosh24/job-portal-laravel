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

    @if(auth()->id() === $company->owner_id)
        <div class="flex justify-center items-center h-full">
            <div class="rounded-lg shadow-md p-8 shadow-black w-[75%] my-10 dark:shadow-gray-300">
                <h1 class="text-3xl font-semibold mb-4">Create Job Post</h1>
                <form wire:submit="save">
                    <div class="mt-4">
                        <x-input-label for="title" :value="__('Job Title')" />
                        <x-text-input id="title" type="text" wire:model="title" required />
                        @error('title') <span class="text-lg text-red-600 mt-2">{{ $message }}</span> @enderror
                    </div>
                    <div class="mt-4">
                        <x-input-label for="description" :value="__('Job Description')" />
                        <textarea id="description" wire:model="description"
                            class="mt-1 block w-full px-4 py-2 rounded-md border border-gray-300" required></textarea>
                        @error('description') <span class="text-lg text-red-600 mt-2">{{ $message }}</span> @enderror
                    </div>
                    <div class="mt-4">
                        <x-input-label for="location" :value="__('Job Location')" />
                        <x-text-input id="location" type="text" wire:model="location" required />
                        @error('location') <span class="text-lg text-red-600 mt-2">{{ $message }}</span> @enderror
                    </div>
                    <div class="mt-4">
                        <x-input-label for="type" :value="__('Job Type')" />
                        <select id='type' wire:model="type" class="mt-2 w-full px-4 py-2 rounded-md border border-gray-300"
                            required>
                            <option value="">Select Job Type</option>
                            <option value="full-time">Full-time</option>
                            <option value="part-time">Part-time</option>
                            <option value="contract">Contract</option>
                            <option value="internship">Internship</option>
                            <option value="temporary">Temporary</option>
                        </select>
                        @error('type') <span class="text-lg text-red-600 mt-2">{{ $message }}</span> @enderror
                    </div>
                    <div class="mt-4">
                        <x-input-label for="salary" :value="__('Job Salary')" />
                        <x-text-input id="salary" type="number" step="0.01" min="0" wire:model="salary" required />
                        @error('salary') <span class="text-lg text-red-600 mt-2">{{ $message }}</span> @enderror
                    </div>
                    <div class="mt-4">
                        <x-input-label for="deadline" :value="__('Job Deadline')" />
                        <x-text-input id="deadline" type="date" wire:model="deadline" required />
                        @error('deadline') <span class="text-lg text-red-600 mt-2">{{ $message }}</span> @enderror
                    </div>
                    <x-primary-button class="mt-5">
                        <span wire:loading.remove>Create Job Post</span>
                        <span wire:loading>Processing...</span>
                    </x-primary-button>
                </form>
            </div>
        </div>
    @else
        <div class="flex justify-center items-center h-full">
            <div class="rounded-lg shadow-md p-8 shadow-black w-[75%] my-10 dark:shadow-gray-300">
                <h1 class="text-3xl font-semibold mb-4">Create Job Post</h1>
                <p class="text-gray-500 dark:text-white">You are not the owner of this company.</p>
            </div>
        </div>
    @endif
</div>
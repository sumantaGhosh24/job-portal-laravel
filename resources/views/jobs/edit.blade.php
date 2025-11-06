<x-app-layout>
    <x-slot:title>Update Job</x-slot>

    @if (session('message'))
        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="overflow-hidden shadow-sm sm:rounded-lg dark:shadow-gray-300">
                    <p class="p-6">{{ session('message') }}</p>
                </div>
            </div>
        </div>
    @endif

    @if(auth()->id() === $job->company->owner_id)
        <div class="flex justify-center items-center h-full">
            <div class="rounded-lg shadow-md p-8 shadow-black w-[75%] my-10 dark:shadow-gray-300">
                <h1 class="text-3xl font-semibold mb-4">Update Job Post</h1>
                <form method="POST" action="{{ route('jobs.update', ['id' => $job->id]) }}">
                    @csrf
                    @method('patch')
                    <div class="mt-4">
                        <x-input-label for="title" :value="__('Job Title')" />
                        <x-text-input id="title" type="text" name="title" :value="old('title', $job->title)" required autocomplete="title" />
                        <x-input-error :messages="$errors->get('title')" class="mt-2" />
                    </div>
                    <div class="mt-4">
                        <x-input-label for="description" :value="__('Job Description')" />
                        <textarea id="description" name="description" class="mt-1 block w-full px-4 py-2 rounded-md border border-gray-300" required autofocus autocomplete="description">{{ old('description', $job->description) }}</textarea>
                        <x-input-error class="mt-2" :messages="$errors->get('description')" />
                    </div>
                    <div class="mt-4">
                        <x-input-label for="location" :value="__('Job Location')" />
                        <x-text-input id="location" type="text" name="location" :value="old('location', $job->location)" required autocomplete="location" />
                        <x-input-error :messages="$errors->get('location')" class="mt-2" />
                    </div>
                    <div class="mt-4">
                        <x-input-label for="type" :value="__('Job Type')" />
                        <select id='type' name='type' class="mt-2 w-full px-4 py-2 rounded-md border border-gray-300" value="{{ old('type') }}" required autofocus autocomplete="type">
                            <option value="">Select Job Type</option>
                            <option value="full-time" {{ $job->type == 'full-time' ? 'selected' : '' }}>Full-time</option>
                            <option value="part-time" {{ $job->type == 'part-time' ? 'selected' : '' }}>Part-time</option>
                            <option value="contract" {{ $job->type == 'contract' ? 'selected' : '' }}>Contract</option>
                            <option value="internship" {{ $job->type == 'internship' ? 'selected' : '' }}>Internship</option>
                            <option value="temporary" {{ $job->type == 'temporary' ? 'selected' : '' }}>Temporary</option>
                        </select>
                        <x-input-error class="mt-2" :messages="$errors->get('type')" />
                    </div>
                    <div class="mt-4">
                        <x-input-label for="salary" :value="__('Job Salary')" />
                        <x-text-input id="salary" type="text" name="salary" :value="old('salary', $job->salary)" required autocomplete="salary" />
                        <x-input-error :messages="$errors->get('salary')" class="mt-2" />
                    </div>
                    <div class="mt-4">
                        <x-input-label for="deadline" :value="__('Job Deadline')" />
                        <x-text-input id="deadline" type="date" name="deadline" :value="old('deadline', $job->deadline)" required autocomplete="deadline" />
                        <x-input-error :messages="$errors->get('deadline')" class="mt-2" />
                    </div>
                    <div>
                        <x-input-label for="is_active" :value="__('Is Active')" />
                        <select id='is_active' name='is_active' class="mt-2 w-full px-4 py-2 rounded-md border border-gray-300" value="{{ old('is_active', $job->is_active) }}" required autofocus autocomplete="is_active">
                            <option value="">Select Job Is Active</option>
                            <option value="1" {{ $job->is_active == '1' ? 'selected' : '' }}>Active</option>
                            <option value="0" {{ $job->is_active == '0' ? 'selected' : '' }}>Not Active</option>
                        </select>
                        <x-input-error class="mt-2" :messages="$errors->get('is_active')" />
                    </div>
                    <x-primary-button class="mt-5">{{ __('Update Job Post') }}</x-primary-button>
                </form>
            </div>
        </div>
    @else
        <div class="flex justify-center items-center h-full">
            <div class="rounded-lg shadow-md p-8 shadow-black w-[75%] my-10 dark:shadow-gray-300">
                <h1 class="text-3xl font-semibold mb-4">Update Job Post</h1>
                <p class="text-gray-500 dark:text-white">You are not the owner of this company.</p>
            </div>
        </div>
    @endif
</x-app-layout>
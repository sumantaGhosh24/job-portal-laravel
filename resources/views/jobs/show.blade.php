<x-app-layout>
    <x-slot:title>Job Details</x-slot>

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

        <div class="container mx-auto mt-10 bg-white rounded-lg shadow-md p-6">
            @if($job->is_active)
                <div class="space-y-5">
                    <h2 class="text-2xl font-bold capitalize">{{ $job->title }}</h2>
                    <p class="text-lg font-medium">{{ $job->description }}</p>
                    <h5 class="text-base"><strong>Company:</strong> {{ $job->company->name }}</h5>
                    <h5 class="text-base"><strong>Location:</strong> {{ $job->location }}</h5>
                    <h5 class="text-base"><strong>Job Type:</strong> {{ $job->type }}</h5>
                    <h5 class="text-base"><strong>Salary:</strong> ₹ {{ $job->salary }}</h5>
                    <h5 class="text-base"><strong>Application Deadline:</strong>
                        {{ $job->deadline ? $job->deadline->format('M d, Y') : 'Open until filled' }}
                    </h5>

                    <div>
                        <h2 class="text-xl font-bold">Submit Application</h2>

                        <form method="post" action="{{ route('applications.store', ['id' => $job->id]) }}"
                            enctype="multipart/form-data">
                            @csrf

                            <div>
                                <x-input-label for="resume" :value="__('Resume')" />
                                <x-text-input id="resume" name="resume" type="file"
                                    class="mt-1 w-full px-4 py-2 rounded-md border border-gray-300 cursor-pointer"
                                    :value="old('resume')" required autofocus autocomplete="resume" />
                                <x-input-error class="mt-2" :messages="$errors->get('resume')" />
                            </div>

                            <div>
                                <x-input-label for="cover_letter" :value="__('Cover Letter')" />
                                <textarea id="cover_letter" name="cover_letter"
                                    class="mt-1 block w-full px-4 py-2 rounded-md border border-gray-300" required autofocus
                                    autocomplete="cover_letter">{{ old('cover_letter') }}</textarea>
                                <x-input-error class="mt-2" :messages="$errors->get('cover_letter')" />
                            </div>

                            <x-primary-button class="mt-5 max-w-fit">{{ __('Submit Application') }}</x-primary-button>
                        </form>
                    </div>
                </div>
            @else
                <p class="text-gray-500">This job posting is not active anymore.</p>
            @endif
        </div>
</x-app-layout>
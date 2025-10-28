<section>
    <div class="mt-6">
        <form method="post" action="{{ route('profile.experience.add') }}" class="space-y-6">
            @csrf

            <h2 class="text-2xl font-semibold mb-4">{{ __('Create Experience') }}</h2>

            <div>
                <x-input-label for="job_title" :value="__('Job Title')" />
                <x-text-input id="job_title" name="job_title" type="text" class="mt-1 block w-full"
                    :value="old('job_title')" required autofocus autocomplete="job_title" />
                <x-input-error class="mt-2" :messages="$errors->get('job_title')" />
            </div>

            <div>
                <x-input-label for="company_name" :value="__('Company Name')" />
                <x-text-input id="company_name" name="company_name" type="text" class="mt-1 block w-full"
                    :value="old('company_name')" required autofocus autocomplete="company_name" />
                <x-input-error class="mt-2" :messages="$errors->get('company_name')" />
            </div>

            <div>
                <x-input-label for="location" :value="__('Company Location')" />
                <x-text-input id="location" name="location" type="text" class="mt-1 block w-full"
                    :value="old('location')" required autofocus autocomplete="location" />
                <x-input-error class="mt-2" :messages="$errors->get('location')" />
            </div>

            <div>
                <x-input-label for="start_date" :value="__('Start Date')" />
                <x-text-input id="start_date" name="start_date" type="date" class="mt-1 block w-full"
                    :value="old('start_date')" required autofocus autocomplete="start_date" />
                <x-input-error class="mt-2" :messages="$errors->get('start_date')" />
            </div>

            <div>
                <x-input-label for="end_date" :value="__('End Date')" />
                <x-text-input id="end_date" name="end_date" type="date" class="mt-1 block w-full"
                    :value="old('end_date')" required autofocus autocomplete="end_date" />
                <x-input-error class="mt-2" :messages="$errors->get('end_date')" />
            </div>

            <x-primary-button>{{ __('Add Experience') }}</x-primary-button>
        </form>
    </div>
    <div class="mt-6">
        <h2 class="text-2xl font-semibold mb-4">{{ __('Update Experiences') }}</h2>
        <div class="flex justify-between gap-3 flex-wrap">
            @forelse ($user->experiences as $experience)
                <form method="post" action="{{ route('profile.experience.update', ['id' => $experience->id]) }}"
                    class="space-y-6">
                    @csrf
                    @method('patch')

                    <div>
                        <x-input-label for="job_title" :value="__('Job Title')" />
                        <x-text-input id="job_title" name="job_title" type="text" class="mt-1 block w-full"
                            :value="old('job_title', $experience->job_title)" required autofocus autocomplete="job_title" />
                        <x-input-error class="mt-2" :messages="$errors->get('job_title')" />
                    </div>

                    <div>
                        <x-input-label for="company_name" :value="__('Company Name')" />
                        <x-text-input id="company_name" name="company_name" type="text" class="mt-1 block w-full"
                            :value="old('company_name', $experience->company_name)" required autofocus
                            autocomplete="company_name" />
                        <x-input-error class="mt-2" :messages="$errors->get('company_name')" />
                    </div>

                    <div>
                        <x-input-label for="location" :value="__('Company Location')" />
                        <x-text-input id="location" name="location" type="text" class="mt-1 block w-full"
                            :value="old('location', $experience->location)" required autofocus autocomplete="location" />
                        <x-input-error class="mt-2" :messages="$errors->get('location')" />
                    </div>

                    <div>
                        <x-input-label for="start_date" :value="__('Start Date')" />
                        <x-text-input id="start_date" name="start_date" type="date" class="mt-1 block w-full"
                            :value="old('start_date', $experience->start_date)" required autofocus
                            autocomplete="start_date" />
                        <x-input-error class="mt-2" :messages="$errors->get('start_date')" />
                    </div>

                    <div>
                        <x-input-label for="end_date" :value="__('End Date')" />
                        <x-text-input id="end_date" name="end_date" type="date" class="mt-1 block w-full"
                            :value="old('end_date', $experience->end_date)" required autofocus autocomplete="end_date" />
                        <x-input-error class="mt-2" :messages="$errors->get('end_date')" />
                    </div>

                    <x-primary-button>{{ __('Update Experience') }}</x-primary-button>
                </form>
            @empty
                <p class='text-lg font-bold'>No experiences</p>
            @endforelse
        </div>
    </div>
    <div class="mt-6">
        <h2 class="text-2xl font-semibold mb-4">{{ __('Delete Experiences') }}</h2>
        @forelse ($user->experiences as $experience)
            <form method="post" action="{{ route('profile.experience.remove', ['id' => $experience->id]) }}"
                class='flex items-center justify-between gap-3 border border-blue-500 px-1 py-1.5 rounded-md mb-3'>
                @csrf
                @method('delete')

                <h3 class="text-lg font-bold capitalize">{{ $experience->job_title }}</h3>

                <x-danger-button class="max-w-fit">{{ __('Delete Experience') }}</x-danger-button>
            </form>
        @empty
            <p class='text-lg font-bold'>No experiences</p>
        @endforelse
    </div>
</section>
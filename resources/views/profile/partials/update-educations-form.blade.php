<section>
    <div class="mt-6">
        <form method="post" action="{{ route('profile.education.add') }}" class="space-y-6">
            @csrf
    
            <h2 class="text-2xl font-semibold mb-4">{{ __('Create Education') }}</h2>

            <div>
                <x-input-label for="degree" :value="__('Degree')" />
                <x-text-input id="degree" name="degree" type="text" class="mt-1 block w-full"
                    :value="old('degree')" required autofocus autocomplete="degree" />
                <x-input-error class="mt-2" :messages="$errors->get('degree')" />
            </div>

            <div>
                <x-input-label for="field_of_study" :value="__('Field of Study')" />
                <x-text-input id="field_of_study" name="field_of_study" type="text" class="mt-1 block w-full"
                    :value="old('field_of_study')" required autofocus autocomplete="field_of_study" />
                <x-input-error class="mt-2" :messages="$errors->get('field_of_study')" />
            </div>

            <div>
                <x-input-label for="institution_name" :value="__('Institution Name')" />
                <x-text-input id="institution_name" name="institution_name" type="text" class="mt-1 block w-full"
                    :value="old('institution_name')" required autofocus autocomplete="institution_name" />
                <x-input-error class="mt-2" :messages="$errors->get('institution_name')" />
            </div>

            <div>
                <x-input-label for="location" :value="__('Location')" />
                <x-text-input id="location" name="location" type="text" class="mt-1 block w-full"
                    :value="old('location')" required autofocus autocomplete="location" />
                <x-input-error class="mt-2" :messages="$errors->get('location')" />
            </div>

            <div>
                <x-input-label for="graduation_date" :value="__('Graduation Date')" />
                <x-text-input id="graduation_date" name="graduation_date" type="date" class="mt-1 block w-full"
                    :value="old('graduation_date')" required autofocus autocomplete="graduation_date" />
                <x-input-error class="mt-2" :messages="$errors->get('graduation_date')" />
            </div>
    
            <x-primary-button>{{ __('Add Education') }}</x-primary-button>
        </form>
    </div>
    <div class="mt-6">
        <h2 class="text-2xl font-semibold mb-4">{{ __('Update Educations') }}</h2>
        <div class="flex justify-between gap-3 flex-wrap">
            @forelse ($user->educations as $education)
                <form method="post" action="{{ route('profile.education.update', ['id' => $education->id]) }}" class="space-y-6">
                    @csrf
                    @method('patch')
    
                    <div>
                        <x-input-label for="degree" :value="__('Degree')" />
                        <x-text-input id="degree" name="degree" type="text" class="mt-1 block w-full"
                            :value="old('degree', $education->degree)" required autofocus autocomplete="degree" />
                        <x-input-error class="mt-2" :messages="$errors->get('degree')" />
                    </div>

                    <div>
                        <x-input-label for="field_of_study" :value="__('Field of Study')" />
                        <x-text-input id="field_of_study" name="field_of_study" type="text" class="mt-1 block w-full"
                            :value="old('field_of_study', $education->field_of_study)" required autofocus autocomplete="field_of_study" />
                        <x-input-error class="mt-2" :messages="$errors->get('field_of_study')" />
                    </div>

                    <div>
                        <x-input-label for="institution_name" :value="__('Institution Name')" />
                        <x-text-input id="institution_name" name="institution_name" type="text" class="mt-1 block w-full"
                            :value="old('institution_name', $education->institution_name)" required autofocus autocomplete="institution_name" />
                        <x-input-error class="mt-2" :messages="$errors->get('institution_name')" />
                    </div>

                    <div>
                        <x-input-label for="location" :value="__('Location')" />
                        <x-text-input id="location" name="location" type="text" class="mt-1 block w-full"
                            :value="old('location', $education->location)" required autofocus autocomplete="location" />
                        <x-input-error class="mt-2" :messages="$errors->get('location')" />
                    </div>

                    <div>
                        <x-input-label for="graduation_date" :value="__('Graduation Date')" />
                        <x-text-input id="graduation_date" name="graduation_date" type="date" class="mt-1 block w-full"
                            :value="old('graduation_date', $education->graduation_date)" required autofocus autocomplete="graduation_date" />
                        <x-input-error class="mt-2" :messages="$errors->get('graduation_date')" />
                    </div>
            
                    <x-primary-button>{{ __('Update Education') }}</x-primary-button>
                </form>
            @empty
                <p class='text-lg font-bold'>No educations</p>
            @endforelse
        </div>
    </div>
    <div class="mt-6">
        <h2 class="text-2xl font-semibold mb-4">{{ __('Delete Educations') }}</h2>
        @forelse ($user->educations as $education)
            <form method="post" action="{{ route('profile.education.remove', ['id' => $education->id]) }}" class='flex items-center justify-between gap-3 border border-blue-500 px-1 py-1.5 rounded-md mb-3'>
                @csrf
                @method('delete')
                
                <h3 class="text-lg font-bold capitalize">{{ $education->degree }} - {{ $education->field_of_study }}</h3>
        
                <x-danger-button class="max-w-fit">{{ __('Delete Education') }}</x-danger-button>
            </form>
        @empty
            <p class='text-lg font-bold'>No educations</p>
        @endforelse
    </div>
</section>
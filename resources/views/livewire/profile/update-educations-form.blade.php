<section>
    @if (session('message'))
        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="overflow-hidden shadow-sm sm:rounded-lg dark:shadow-gray-300">
                    <p class="p-6">{{ session('message') }}</p>
                </div>
            </div>
        </div>
    @endif

    <div class="mt-6">
        <form wire:submit="save" class="space-y-6">
            <h2 class="text-2xl font-semibold mb-4">{{ __('Create Education') }}</h2>
            <div>
                <x-input-label for="degree" :value="__('Degree')" />
                <x-text-input id="degree" wire:model="degree" type="text" class="mt-1 block w-full" required />
                @error('degree') <span class="text-lg text-red-600 mt-2">{{ $message }}</span> @enderror
            </div>
            <div>
                <x-input-label for="field_of_study" :value="__('Field of Study')" />
                <x-text-input id="field_of_study" wire:model="field_of_study" type="text" class="mt-1 block w-full"
                    required />
                @error('field_of_study') <span class="text-lg text-red-600 mt-2">{{ $message }}</span> @enderror
            </div>
            <div>
                <x-input-label for="institution_name" :value="__('Institution Name')" />
                <x-text-input id="institution_name" wire:model="institution_name" type="text" class="mt-1 block w-full"
                    required />
                @error('institution_name') <span class="text-lg text-red-600 mt-2">{{ $message }}</span> @enderror
            </div>
            <div>
                <x-input-label for="location" :value="__('Location')" />
                <x-text-input id="location" wire:model="location" type="text" class="mt-1 block w-full" required />
                @error('location') <span class="text-lg text-red-600 mt-2">{{ $message }}</span> @enderror
            </div>
            <div>
                <x-input-label for="graduation_date" :value="__('Graduation Date')" />
                <x-text-input id="graduation_date" wire:model="graduation_date" type="date" class="mt-1 block w-full"
                    required />
                @error('graduation_date') <span class="text-lg text-red-600 mt-2">{{ $message }}</span> @enderror
            </div>
            <x-primary-button>
                <span wire:loading.remove>Add Education</span>
                <span wire:loading>Processing...</span>
            </x-primary-button>
        </form>
    </div>
    @isset($education)
        <div class="mt-6">
            <h2 class="text-2xl font-semibold mb-4">{{ __('Update Educations') }}</h2>
            <form wire:submit="update" class="space-y-6">
                <div>
                    <x-input-label for="education_degree" :value="__('Degree')" />
                    <x-text-input id="education_degree" wire:model="education_degree" type="text" class="mt-1 block w-full"
                        required />
                    @error('education_degree') <span class="text-lg text-red-600 mt-2">{{ $message }}</span> @enderror
                </div>
                <div>
                    <x-input-label for="education_field_of_study" :value="__('Field of Study')" />
                    <x-text-input id="education_field_of_study" wire:model="education_field_of_study" type="text"
                        class="mt-1 block w-full" required />
                    @error('education_field_of_study') <span class="text-lg text-red-600 mt-2">{{ $message }}</span>
                    @enderror
                </div>
                <div>
                    <x-input-label for="education_institution_name" :value="__('Institution Name')" />
                    <x-text-input id="education_institution_name" wire:model="education_institution_name" type="text"
                        class="mt-1 block w-full" required />
                    @error('education_institution_name') <span class="text-lg text-red-600 mt-2">{{ $message }}</span>
                    @enderror
                </div>
                <div>
                    <x-input-label for="education_location" :value="__('Location')" />
                    <x-text-input id="education_location" wire:model="education_location" type="text"
                        class="mt-1 block w-full" required />
                    @error('education_location') <span class="text-lg text-red-600 mt-2">{{ $message }}</span> @enderror
                </div>
                <div>
                    <x-input-label for="education_graduation_date" :value="__('Graduation Date')" />
                    <x-text-input id="education_graduation_date" wire:model="education_graduation_date" type="date"
                        class="mt-1 block w-full" required />
                    @error('education_graduation_date') <span class="text-lg text-red-600 mt-2">{{ $message }}</span>
                    @enderror
                </div>
                <x-primary-button>
                    <span wire:loading.remove>Update Education</span>
                    <span wire:loading>Processing...</span>
                </x-primary-button>
            </form>
        </div>
    @endisset
    <div class="mt-6">
        <h2 class="text-2xl font-semibold mb-4">{{ __('Manage Educations') }}</h2>
        @forelse ($user->educations as $education)
            <div class='flex items-center justify-between gap-3 border border-blue-500 px-1 py-1.5 rounded-md mb-3'
                wire:key="{{ $education->id }}">
                <h3 class="text-lg font-bold capitalize">{{ $education->degree }} - {{ $education->field_of_study }}</h3>
                <div>
                    <x-primary-button wire:click="edit({{ $education->id }})">{{ __('Edit Education') }}</x-primary-button>
                    <x-danger-button
                        wire:click="destroy({{ $education->id }})">{{ __('Delete Education') }}</x-danger-button>
                </div>
            </div>
        @empty
            <p class='text-lg font-bold'>No educations</p>
        @endforelse
    </div>
</section>
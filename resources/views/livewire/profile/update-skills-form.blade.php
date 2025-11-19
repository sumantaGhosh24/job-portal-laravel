<section>
    @if (session('message'))
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 mt-4">
            <div class="overflow-hidden shadow-sm sm:rounded-lg dark:shadow-gray-300">
                <p class="p-6">{{ session('message') }}</p>
            </div>
        </div>
    @endif

    <div class="mt-6">
        <form wire:submit="save" class="space-y-6">
            <h2 class="text-2xl font-semibold mb-4">{{ __('Create Skill') }}</h2>
            <div>
                <x-input-label for="name" :value="__('Skill Name')" />
                <x-text-input id="name" wire:model="name" type="text" class="mt-1 block w-full" required />
                @error('name') <span class="text-lg text-red-600 mt-2">{{ $message }}</span> @enderror
            </div>
            <div>
                <x-input-label for="proficiency" :value="__('Skill Proficiency')" />
                <select id='proficiency' wire:model='proficiency'
                    class="mt-2 w-full px-4 py-2 rounded-md border border-gray-300" required>
                    <option value="">Select Skill Proficiency</option>
                    <option value='beginner'>Beginner</option>
                    <option value='intermediate'>Intermediate</option>
                    <option value='advanced'>Advanced</option>
                    <option value='expert'>Expert</option>
                </select>
                @error('proficiency') <span class="text-lg text-red-600 mt-2">{{ $message }}</span> @enderror
            </div>
            <x-primary-button>
                <span wire:loading.remove>Add Skill</span>
                <span wire:loading>Processing...</span>
            </x-primary-button>
        </form>
    </div>
    @isset($skill)
        <div class="mt-6">
            <h2 class="text-2xl font-semibold mb-4">{{ __('Update Skills') }}</h2>
            <form wire:submit="update" class="space-y-6">
                <div>
                    <x-input-label for="skill_name" :value="__('Skill Name')" />
                    <x-text-input id="skill_name" wire:model="skill_name" type="text" class="mt-1 block w-full" required />
                    @error('skill_name') <span class="text-lg text-red-600 mt-2">{{ $message }}</span> @enderror
                </div>
                <div>
                    <x-input-label for="skill_proficiency" :value="__('Skill Proficiency')" />
                    <select id='skill_proficiency' wire:model='skill_proficiency'
                        class="mt-2 w-full px-4 py-2 rounded-md border border-gray-300" required>
                        <option value="">Select Skill Proficiency</option>
                        <option value='beginner'>Beginner</option>
                        <option value='intermediate'>Intermediate</option>
                        <option value='advanced'>Advanced</option>
                        <option value='expert'>Expert</option>
                    </select>
                    @error('skill_proficiency') <span class="text-lg text-red-600 mt-2">{{ $message }}</span> @enderror
                </div>
                <x-primary-button>
                    <span wire:loading.remove>Update Skill</span>
                    <span wire:loading>Processing...</span>
                </x-primary-button>
            </form>
        </div>
    @endisset
    <div class="mt-6">
        <h2 class="text-2xl font-semibold mb-4">{{ __('Manage Skills') }}</h2>
        @forelse ($user->skills as $skill)
            <div class='flex items-center justify-between gap-3 border border-blue-500 px-1 py-1.5 rounded-md mb-3'
                wire:key="{{ $skill->id }}">
                <h3 class="text-lg font-bold capitalize">{{ $skill->name }} - {{ $skill->proficiency }}</h3>
                <div>
                    <x-primary-button wire:click="edit({{ $skill->id }})">{{ __('Edit Skill') }}</x-primary-button>
                    <x-danger-button wire:click="destroy({{ $skill->id }})">{{ __('Delete Skill') }}</x-danger-button>
                </div>
            </div>
        @empty
            <p class='text-lg font-bold'>No skills</p>
        @endforelse
    </div>
</section>
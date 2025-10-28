<section>
    <div class="mt-6">
        <form method="post" action="{{ route('profile.skill.add') }}" class="space-y-6">
            @csrf
    
            <h2 class="text-2xl font-semibold mb-4">{{ __('Create Skill') }}</h2>

            <div>
                <x-input-label for="name" :value="__('Skill Name')" />
                <x-text-input id="name" name="name" type="text" class="mt-1 block w-full"
                    :value="old('name')" required autofocus autocomplete="name" />
                <x-input-error class="mt-2" :messages="$errors->get('name')" />
            </div>

            <div>
                <x-input-label for="proficiency" :value="__('Skill Proficiency')" />
                <select id='proficiency' name='proficiency'
                    class="mt-2 w-full px-4 py-2 rounded-md border border-gray-300" value="{{ old('proficiency') }}"
                    required autofocus autocomplete="proficiency">
                    <option value="">Select Skill Proficiency</option>
                    <option value='beginner'>Beginner</option>
                    <option value='intermediate'>Intermediate</option>
                    <option value='advanced'>Advanced</option>
                    <option value='expert'>Expert</option>
                </select>
                <x-input-error class="mt-2" :messages="$errors->get('proficiency')" />
            </div>
    
            <x-primary-button>{{ __('Add Skill') }}</x-primary-button>
        </form>
    </div>
    <div class="mt-6">
        <h2 class="text-2xl font-semibold mb-4">{{ __('Update Skills') }}</h2>
        <div class="flex justify-between gap-3 flex-wrap">
            @forelse ($user->skills as $skill)
                <form method="post" action="{{ route('profile.skill.update', ['id' => $skill->id]) }}" class="space-y-6">
                    @csrf
                    @method('patch')
    
                    <div>
                        <x-input-label for="name" :value="__('Skill Name')" />
                        <x-text-input id="name" name="name" type="text" class="mt-1 block w-full"
                            :value="old('name', $skill->name)" required autofocus autocomplete="name" />
                        <x-input-error class="mt-2" :messages="$errors->get('name')" />
                    </div>

                    <div>
                        <x-input-label for="proficiency" :value="__('Skill Proficiency')" />
                        <select id='proficiency' name='proficiency'
                            class="mt-2 w-full px-4 py-2 rounded-md border border-gray-300" value="{{ old('proficiency') }}"
                            required autofocus autocomplete="proficiency">
                            <option value="">Select Skill Proficiency</option>
                            <option value='beginner'>Beginner</option>
                            <option value='intermediate'>Intermediate</option>
                            <option value='advanced'>Advanced</option>
                            <option value='expert'>Expert</option>
                        </select>
                        <x-input-error class="mt-2" :messages="$errors->get('proficiency')" />
                    </div>
            
                    <x-primary-button>{{ __('Update Skill') }}</x-primary-button>
                </form>
            @empty
                <p class='text-lg font-bold'>No skills</p>
            @endforelse
        </div>
    </div>
    <div class="mt-6">
        <h2 class="text-2xl font-semibold mb-4">{{ __('Delete Skills') }}</h2>
        @forelse ($user->skills as $skill)
            <form method="post" action="{{ route('profile.skill.destroy', ['id' => $skill->id]) }}" class='flex items-center justify-between gap-3 border border-blue-500 px-1 py-1.5 rounded-md mb-3'>
                @csrf
                @method('delete')
                
                <h3 class="text-lg font-bold capitalize">{{ $skill->name }} - {{ $skill->proficiency }}</h3>
        
                <x-danger-button class="max-w-fit">{{ __('Delete Skill') }}</x-danger-button>
            </form>
        @empty
            <p class='text-lg font-bold'>No skills</p>
        @endforelse
    </div>
</section>
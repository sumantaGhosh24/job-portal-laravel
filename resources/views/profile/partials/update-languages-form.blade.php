<section>
    <div class="mt-6">
        <form method="post" action="{{ route('profile.language.add') }}" class="space-y-6">
            @csrf
    
            <h2 class="text-2xl font-semibold mb-4">{{ __('Create Language') }}</h2>

            <div>
                <x-input-label for="name" :value="__('Language Name')" />
                <x-text-input id="name" name="name" type="text" class="mt-1 block w-full"
                    :value="old('name')" required autofocus autocomplete="name" />
                <x-input-error class="mt-2" :messages="$errors->get('name')" />
            </div>
    
            <div>
                <x-input-label for="proficiency" :value="__('Language Proficiency')" />
                <select id='proficiency' name='proficiency'
                    class="mt-2 w-full px-4 py-2 rounded-md border border-gray-300" value="{{ old('proficiency') }}"
                    required autofocus autocomplete="proficiency">
                    <option value="">Select Language Proficiency</option>
                    <option value='elementary'>Elementary</option>
                    <option value='limited-working'>Limited Working</option>
                    <option value='professional-working'>Professional Working</option>
                    <option value='full-professional'>Full Professional</option>
                    <option value='native-or-bilingual'>Native or Bilingual</option>
                </select>
                <x-input-error class="mt-2" :messages="$errors->get('proficiency')" />
            </div>
    
            <x-primary-button>{{ __('Add Language') }}</x-primary-button>
        </form>
    </div>
    <div class="mt-6">
        <h2 class="text-2xl font-semibold mb-4">{{ __('Update Languages') }}</h2>
        <div class="flex justify-between gap-3 flex-wrap">
            @forelse ($user->languages as $language)
                <form method="post" action="{{ route('profile.language.update', ['id' => $language->id]) }}" class="space-y-6">
                    @csrf
                    @method('patch')
    
                    <div>
                        <x-input-label for="name" :value="__('Language Name')" />
                        <x-text-input id="name" name="name" type="text" class="mt-1 block w-full"
                            :value="old('name', $language->name)" required autofocus autocomplete="name" />
                        <x-input-error class="mt-2" :messages="$errors->get('name')" />
                    </div>
            
                    <div>
                        <x-input-label for="proficiency" :value="__('Language Proficiency')" />
                        <select id='proficiency' name='proficiency'
                            class="mt-2 w-full px-4 py-2 rounded-md border border-gray-300" value="{{ old('proficiency') }}"
                            required autofocus autocomplete="proficiency">
                            <option value="">Select Language Proficiency</option>
                            <option value='elementary'>Elementary</option>
                            <option value='limited-working'>Limited Working</option>
                            <option value='professional-working'>Professional Working</option>
                            <option value='full-professional'>Full Professional</option>
                            <option value='native-or-bilingual'>Native or Bilingual</option>
                        </select>
                        <x-input-error class="mt-2" :messages="$errors->get('proficiency')" />
                    </div>
            
                    <x-primary-button>{{ __('Update Language') }}</x-primary-button>
                </form>
            @empty
                <p class='text-lg font-bold'>No languages</p>
            @endforelse
        </div>
    </div>
    <div class="mt-6">
        <h2 class="text-2xl font-semibold mb-4">{{ __('Delete Languages') }}</h2>
        @forelse ($user->languages as $language)
            <form method="post" action="{{ route('profile.language.remove', ['id' => $language->id]) }}" class='flex items-center justify-between gap-3 border border-blue-500 px-1 py-1.5 rounded-md mb-3'>
                @csrf
                @method('delete')
                
                <h3 class="text-lg font-bold capitalize">{{ $language->name }} - {{ $language->proficiency }}</h3>
        
                <x-danger-button class="max-w-fit">{{ __('Delete Language') }}</x-danger-button>
            </form>
        @empty
            <p class='text-lg font-bold'>No languages</p>
        @endforelse
    </div>
</section>
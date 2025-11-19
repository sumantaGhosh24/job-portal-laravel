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
            <h2 class="text-2xl font-semibold mb-4">{{ __('Create Language') }}</h2>
            <div>
                <x-input-label for="name" :value="__('Language Name')" />
                <x-text-input id="name" wire:model="name" type="text" class="mt-1 block w-full" required />
                @error('name') <span class="text-lg text-red-600 mt-2">{{ $message }}</span> @enderror
            </div>
            <div>
                <x-input-label for="proficiency" :value="__('Language Proficiency')" />
                <select id='proficiency' wire:model='proficiency'
                    class="mt-2 w-full px-4 py-2 rounded-md border border-gray-300" required>
                    <option value="">Select Language Proficiency</option>
                    <option value='elementary'>Elementary</option>
                    <option value='limited-working'>Limited Working</option>
                    <option value='professional-working'>Professional Working</option>
                    <option value='full-professional'>Full Professional</option>
                    <option value='native-or-bilingual'>Native or Bilingual</option>
                </select>
                @error('proficiency') <span class="text-lg text-red-600 mt-2">{{ $message }}</span> @enderror
            </div>
            <x-primary-button>
                <span wire:loading.remove>Add Language</span>
                <span wire:loading>Processing...</span>
            </x-primary-button>
        </form>
    </div>
    @isset($language)
        <div class="mt-6">
            <h2 class="text-2xl font-semibold mb-4">{{ __('Update Languages') }}</h2>
            <form wire:submit="update" class="space-y-6">
                <div>
                    <x-input-label for="language_name" :value="__('Language Name')" />
                    <x-text-input id="language_name" wire:model="language_name" type="text" class="mt-1 block w-full"
                        required />
                    @error('language_name') <span class="text-lg text-red-600 mt-2">{{ $message }}</span> @enderror
                </div>
                <div>
                    <x-input-label for="language_proficiency" :value="__('Language Proficiency')" />
                    <select id='language_proficiency' wire:model='language_proficiency'
                        class="mt-2 w-full px-4 py-2 rounded-md border border-gray-300" required>
                        <option value="">Select Language Proficiency</option>
                        <option value='elementary'>Elementary</option>
                        <option value='limited-working'>Limited Working</option>
                        <option value='professional-working'>Professional Working</option>
                        <option value='full-professional'>Full Professional</option>
                        <option value='native-or-bilingual'>Native or Bilingual</option>
                    </select>
                    @error('language_proficiency') <span class="text-lg text-red-600 mt-2">{{ $message }}</span> @enderror
                </div>
                <x-primary-button>
                    <span wire:loading.remove>Update Language</span>
                    <span wire:loading>Processing...</span>
                </x-primary-button>
            </form>
        </div>
    @endisset
    <div class="mt-6">
        <h2 class="text-2xl font-semibold mb-4">{{ __('Manage Languages') }}</h2>
        @forelse ($user->languages as $language)
            <div class='flex items-center justify-between gap-3 border border-blue-500 px-1 py-1.5 rounded-md mb-3'
                wire:key="{{ $language->id }}">
                <h3 class="text-lg font-bold capitalize">{{ $language->name }} - {{ $language->proficiency }}</h3>
                <div>
                    <x-primary-button wire:click="edit({{ $language->id }})">{{ __('Edit Language') }}</x-primary-button>
                    <x-danger-button wire:click="destroy({{ $language->id }})">{{ __('Delete Language') }}</x-danger-button>
                </div>
            </div>
        @empty
            <p class='text-lg font-bold'>No languages</p>
        @endforelse
    </div>
</section>
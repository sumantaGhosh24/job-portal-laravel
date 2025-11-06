<section>
    <div>
        <h2 class="text-2xl font-semibold mb-4">{{ __('Update Professional Summary') }}</h2>
        <p class="mt-1 text-lg text-gray-800 dark:text-white">{{ __("Update your professional summary") }}</p>
    </div>

    <form method="post" action="{{ route('profile.update.professional') }}" class="mt-6 space-y-6">
        @csrf
        @method('patch')
        <div>
            <x-input-label for="headline" :value="__('Headline')" />
            <x-text-input id="headline" name="headline" type="text" class="mt-1 block w-full" :value="old('headline', $user->headline)" required autofocus autocomplete="headline" />
            <x-input-error class="mt-2" :messages="$errors->get('headline')" />
        </div>
        <div>
            <x-input-label for="professional_summary" :value="__('Professional Summary')" />
            <textarea id="professional_summary" name="professional_summary" class="mt-1 block w-full px-4 py-2 rounded-md border border-gray-300" required autofocus autocomplete="professional_summary">{{ old('professional_summary', $user->professional_summary) }}</textarea>
            <x-input-error class="mt-2" :messages="$errors->get('professional_summary')" />
        </div>
        <x-primary-button>{{ __('Update Professional Summary') }}</x-primary-button>
    </form>
</section>
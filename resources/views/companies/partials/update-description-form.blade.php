<section>
    <div>
        <h2 class="text-2xl font-semibold mb-4">{{ __('Update Company Description') }}</h2>
        <p class="mt-1 text-lg text-gray-800 dark:text-white">{{ __("Update company description") }}</p>
    </div>

    <form method="post" action="{{ route('companies.description', ['id' => $company->id]) }}" class="mt-6 space-y-6">
        @csrf
        @method('patch')
        <div>
            <x-input-label for="description" :value="__('Company Description')" />
            <textarea id="description" name="description" class="mt-1 block w-full px-4 py-2 rounded-md border border-gray-300" required autofocus autocomplete="description">{{ old('description', $company->description) }}</textarea>
            <x-input-error class="mt-2" :messages="$errors->get('description')" />
        </div>
        <div>
            <x-input-label for="slogan" :value="__('Company Slogan')" />
            <textarea id="slogan" name="slogan" class="mt-1 block w-full px-4 py-2 rounded-md border border-gray-300" required autofocus autocomplete="slogan">{{ old('slogan', $company->slogan) }}</textarea>
            <x-input-error class="mt-2" :messages="$errors->get('slogan')" />
        </div>
        <x-primary-button>{{ __('Update Company Description') }}</x-primary-button>
    </form>
</section>
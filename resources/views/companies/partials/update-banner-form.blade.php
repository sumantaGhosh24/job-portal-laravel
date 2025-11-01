<section>
    <div>
        <h2 class="text-2xl font-semibold mb-4">{{ __('Update Company Banner') }}</h2>
        <p class="mt-1 text-lg text-gray-800">{{ __("Update company banner image") }}</p>
    </div>

    <form method="post" action="{{ route('companies.banner', ['id' => $company->id]) }}" class="mt-6 space-y-6"
        enctype="multipart/form-data">
        @csrf
        @method('patch')

        <div>
            @if($company->banner)
                <img src="{{ asset('storage/' . $company->banner) }}" alt="Company Banner"
                    class="w-full h-auto rounded-md" />
            @endif
        </div>

        <div>
            <x-input-label for="image" :value="__('Company Banner')" />
            <x-text-input id="image" name="image" type="file"
                class="mt-1 w-full px-4 py-2 rounded-md border border-gray-300 cursor-pointer" :value="old('image', $company->banner)" required autofocus autocomplete="image" />
            <x-input-error class="mt-2" :messages="$errors->get('image')" />
        </div>

        <x-primary-button>{{ __('Update Company Banner') }}</x-primary-button>
    </form>
</section>
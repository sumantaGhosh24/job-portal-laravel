<section>
    <div>
        <h2 class="text-2xl font-semibold mb-4">{{ __('Update Company Information') }}</h2>
        <p class="mt-1 text-lg text-gray-800 dark:text-white">{{ __("Update company information") }}</p>
    </div>

    <form method="post" action="{{ route('companies.information', ['id' => $company->id]) }}" class="mt-6 space-y-6">
        @csrf
        @method('patch')
        <div>
            <x-input-label for="name" :value="__('Company Name')" />
            <x-text-input id="name" type="text" name="name" :value="old('name', $company->name)" required autofocus autocomplete="name" />
            <x-input-error :messages="$errors->get('name')" class="mt-2" />
        </div>
        <div>
            <x-input-label for="sector" :value="__('Company Sector')" />
            <select id='sector' name='sector' class="mt-2 w-full px-4 py-2 rounded-md border border-gray-300" value="{{ old('sector') }}" required autofocus autocomplete="sector">
                <option value="">Select Company Sector</option>
                <option value="technology" {{ $company->sector == 'technology' ? 'selected' : ''}}>Technology</option>
                <option value="healthcare" {{ $company->sector == 'healthcare' ? 'selected' : ''}}>Healthcare</option>
                <option value="finance" {{ $company->sector == 'finance' ? 'selected' : ''}}>Finance</option>
                <option value="manufacturing" {{ $company->sector == 'manufacturing' ? 'selected' : ''}}>Manufacturing</option>
            </select>
            <x-input-error class="mt-2" :messages="$errors->get('sector')" />
        </div>
        <div>
            <x-input-label for="size" :value="__('Company Size')" />
            <select id='size' name='size' class="mt-2 w-full px-4 py-2 rounded-md border border-gray-300" value="{{ old('size') }}" required autofocus autocomplete="size">
                <option value="">Select Company Size</option>
                <option value="1-10" {{ $company->size == '1-10' ? 'selected' : ''}}>1-10</option>
                <option value="11-50" {{ $company->size == '11-50' ? 'selected' : ''}}>11-50</option>
                <option value="51-200" {{ $company->size == '51-200' ? 'selected' : ''}}>51-200</option>
                <option value="201-500" {{ $company->size == '201-500' ? 'selected' : ''}}>201-500</option>
                <option value="500+" {{ $company->size == '500+' ? 'selected' : ''}}>500+</option>
            </select>
            <x-input-error class="mt-2" :messages="$errors->get('size')" />
        </div>
        <div>
            <x-input-label for="phone_number" :value="__('Company Phone Number')" />
            <x-text-input id="phone_number" type="text" name="phone_number" :value="old('phone_number', $company->phone_number)" required autofocus autocomplete="phone_number" />
            <x-input-error :messages="$errors->get('phone_number')" class="mt-2" />
        </div>
        <div>
            <x-input-label for="email" :value="__('Company Email')" />
            <x-text-input id="email" type="email" name="email" :value="old('email', $company->email)" required autofocus autocomplete="email" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>
        <div>
            <x-input-label for="location" :value="__('Company Location')" />
            <x-text-input id="location" type="text" name="location" :value="old('location', $company->location)" required autofocus autocomplete="location" />
            <x-input-error :messages="$errors->get('location')" class="mt-2" />
        </div>
        <x-primary-button>{{ __('Update Company Information') }}</x-primary-button>
    </form>
</section>
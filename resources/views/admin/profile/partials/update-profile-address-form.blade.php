<section>
    <div>
        <h2 class="text-2xl font-semibold mb-4">{{ __('Profile Address') }}</h2>
        <p class="mt-1 text-lg text-gray-800">{{ __("Update your account's profile address.") }}</p>
    </div>

    <form method="post" action="{{ route('admin.profile.address') }}" class="mt-6 space-y-6">
        @csrf
        @method('patch')

        <div>
            <x-input-label for="city" :value="__('City')" />
            <x-text-input id="city" name="city" type="text" class="mt-1 block w-full" :value="old('city', $user->city)" required autofocus autocomplete="city" />
            <x-input-error class="mt-2" :messages="$errors->get('city')" />
        </div>

        <div>
            <x-input-label for="state" :value="__('State')" />
            <x-text-input id="state" name="state" type="text" class="mt-1 block w-full" :value="old('state', $user->state)" required autofocus autocomplete="state" />
            <x-input-error class="mt-2" :messages="$errors->get('state')" />
        </div>

        <div>
            <x-input-label for="country" :value="__('Country')" />
            <x-text-input id="country" name="country" type="text" class="mt-1 block w-full" :value="old('country', $user->country)" required autofocus autocomplete="country" />
            <x-input-error class="mt-2" :messages="$errors->get('country')" />
        </div>

        <div>
            <x-input-label for="zip" :value="__('Zip')" />
            <x-text-input id="zip" name="zip" type="text" class="mt-1 block w-full" :value="old('zip', $user->zip)" required autofocus autocomplete="zip" />
            <x-input-error class="mt-2" :messages="$errors->get('zip')" />
        </div>

        <div>
            <x-input-label for="addressline" :value="__('Addressline')" />
            <x-text-input id="addressline" name="addressline" type="text" class="mt-1 block w-full" :value="old('addressline', $user->addressline)" required autofocus autocomplete="addressline" />
            <x-input-error class="mt-2" :messages="$errors->get('addressline')" />
        </div>

        <x-primary-button>{{ __('Save') }}</x-primary-button>
    </form>
</section>
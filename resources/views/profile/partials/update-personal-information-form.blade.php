<section>
    <div>
        <h2 class="text-2xl font-semibold mb-4">{{ __('Update Personal Information') }}</h2>
        <p class="mt-1 text-lg text-gray-800">{{ __("Update your personal information") }}</p>
    </div>

    <form method="post" action="{{ route('profile.update.personal') }}" class="mt-6 space-y-6">
        @csrf
        @method('patch')

        <div>
            <x-input-label for="first_name" :value="__('First Name')" />
            <x-text-input id="first_name" name="first_name" type="text" class="mt-1 block w-full"
                :value="old('first_name', $user->first_name)" required autofocus autocomplete="first_name" />
            <x-input-error class="mt-2" :messages="$errors->get('first_name')" />
        </div>

        <div>
            <x-input-label for="last_name" :value="__('Last Name')" />
            <x-text-input id="last_name" name="last_name" type="text" class="mt-1 block w-full" :value="old('last_name', $user->last_name)" required autofocus autocomplete="last_name" />
            <x-input-error class="mt-2" :messages="$errors->get('last_name')" />
        </div>

        <div>
            <x-input-label for="mobile_number" :value="__('Mobile Number')" />
            <x-text-input id="mobile_number" name="mobile_number" type="text" class="mt-1 block w-full"
                :value="old('mobile_number', $user->mobile_number)" required autofocus autocomplete="mobile_number" />
            <x-input-error class="mt-2" :messages="$errors->get('mobile_number')" />
        </div>

        <div>
            <x-input-label for="desired_job_title" :value="__('Desired Job Title')" />
            <x-text-input id="desired_job_title" name="desired_job_title" type="text" class="mt-1 block w-full"
                :value="old('desired_job_title', $user->desired_job_title)" required autofocus
                autocomplete="desired_job_title" />
            <x-input-error class="mt-2" :messages="$errors->get('desired_job_title')" />
        </div>

        <div>
            <x-input-label for="desired_job_type" :value="__('Desired Job Type')" />
            <select id='desired_job_type' name='desired_job_type'
                class="mt-2 w-full px-4 py-2 rounded-md border border-gray-300" value="{{ old('desired_job_type') }}"
                required autofocus autocomplete="desired_job_type">
                <option value="">Select Desired Job Type</option>
                <option value="full-time">Full-time</option>
                <option value="part-time">Part-time</option>
                <option value="contract">Contract</option>
                <option value="internship">Internship</option>
                <option value="temporary">Temporary</option>
            </select>
            <x-input-error class="mt-2" :messages="$errors->get('desired_job_type')" />
        </div>

        <div>
            <x-input-label for="city" :value="__('City')" />
            <x-text-input id="city" name="city" type="text" class="mt-1 block w-full" :value="old('city', $user->city)"
                required autofocus autocomplete="city" />
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
            <x-text-input id="zip" name="zip" type="text" class="mt-1 block w-full" :value="old('zip', $user->zip)"
                required autofocus autocomplete="zip" />
            <x-input-error class="mt-2" :messages="$errors->get('zip')" />
        </div>

        <div>
            <x-input-label for="addressline" :value="__('Addressline')" />
            <x-text-input id="addressline" name="addressline" type="text" class="mt-1 block w-full"
                :value="old('addressline', $user->addressline)" required autofocus autocomplete="addressline" />
            <x-input-error class="mt-2" :messages="$errors->get('addressline')" />
        </div>

        <x-primary-button>{{ __('Update Personal Information') }}</x-primary-button>
    </form>
</section>
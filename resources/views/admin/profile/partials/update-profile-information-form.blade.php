<section>
    <div>
        <h2 class="text-2xl font-semibold mb-4">{{ __('Profile Information') }}</h2>
        <p class="mt-1 text-lg text-gray-800">{{ __("Update your account's profile information.") }}</p>
    </div>

    <form method="post" action="{{ route('admin.profile.update') }}" class="mt-6 space-y-6">
        @csrf
        @method('patch')

        <div class='flex gap-5 items-center'>
            <h2 class='text-xl font-bold'>Email Address</h2>
            <h3 class='text-lg'>{{ $user->email }}</h3>
        </div>

        <div>
            <x-input-label for="firstName" :value="__('First Name')" />
            <x-text-input id="firstName" name="firstName" type="text" class="mt-1 block w-full" :value="old('firstName', $user->firstName)" required autofocus autocomplete="firstName" />
            <x-input-error class="mt-2" :messages="$errors->get('firstName')" />
        </div>

        <div>
            <x-input-label for="lastName" :value="__('Last Name')" />
            <x-text-input id="lastName" name="lastName" type="text" class="mt-1 block w-full" :value="old('lastName', $user->lastName)" required autofocus autocomplete="lastName" />
            <x-input-error class="mt-2" :messages="$errors->get('lastName')" />
        </div>

        <div>
            <x-input-label for="username" :value="__('Username')" />
            <x-text-input id="username" name="username" type="text" class="mt-1 block w-full" :value="old('username', $user->username)" required autofocus autocomplete="username" />
            <x-input-error class="mt-2" :messages="$errors->get('username')" />
        </div>

        <div>
            <x-input-label for="mobileNumber" :value="__('Mobile Number')" />
            <x-text-input id="mobileNumber" name="mobileNumber" type="text" class="mt-1 block w-full" :value="old('mobileNumber', $user->mobileNumber)" required autofocus autocomplete="mobileNumber" />
            <x-input-error class="mt-2" :messages="$errors->get('mobileNumber')" />
        </div>

        <div>
            <x-input-label for="dob" :value="__('Date of Birth')" />
            <x-text-input id="dob" name="dob" type="date" class="mt-1 block w-full" :value="old('dob', $user->dob)" required autofocus autocomplete="dob" />
            <x-input-error class="mt-2" :messages="$errors->get('dob')" />
        </div>

        <div>
            <x-input-label for="gender" :value="__('Gender')" />
            <x-text-input id="gender" name="gender" type="text" class="mt-1 block w-full" :value="old('gender', $user->gender)" required autofocus autocomplete="gender" />
            <x-input-error class="mt-2" :messages="$errors->get('gender')" />
        </div>

        <x-primary-button>{{ __('Save') }}</x-primary-button>
    </form>
</section>
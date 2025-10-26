<section>
    <div>
        <h2 class="text-2xl font-semibold mb-4">{{ __('Update Profile Image') }}</h2>
        <p class="mt-1 text-lg text-gray-800">{{ __("Update your profile image") }}</p>
    </div>

    <form method="post" action="{{ route('profile.update.profile_image') }}" class="mt-6 space-y-6"
        enctype="multipart/form-data">
        @csrf
        @method('patch')

        <div>
            @if($user->profile_image)
                <img src="{{ asset('storage/' . $user->profile_image) }}" alt="Profile Image"
                    class="w-full h-auto rounded-md" />
            @endif
        </div>

        <div>
            <x-input-label for="image" :value="__('Profile Image')" />
            <x-text-input id="image" name="image" type="file"
                class="mt-1 w-full px-4 py-2 rounded-md border border-gray-300 cursor-pointer" :value="old('image', $user->image)"
                required autofocus autocomplete="image" />
            <x-input-error class="mt-2" :messages="$errors->get('image')" />
        </div>

        <x-primary-button>{{ __('Update Profile Image') }}</x-primary-button>
    </form>
</section>
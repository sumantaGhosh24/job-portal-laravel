<section>
    <div>
        <h2 class="text-2xl font-semibold mb-4">{{ __('Update User Image') }}</h2>
        <p class="mt-1 text-lg text-gray-800">{{ __("Update your account's profile image.") }}</p>
    </div>

    <form method="post" action="{{ route('admin.profile.image') }}" class="mt-6 space-y-6" enctype="multipart/form-data">
        @csrf
        @method('patch')

        <div>
            @if($user->image)
                <img src="{{ asset('storage/' . $user->image) }}" alt="Profile Image" class="w-full h-auto rounded-md" />
            @endif
        </div>

        <div>
            <x-input-label for="image" :value="__('Profile Image')" />
            <x-text-input id="image" name="image" type="file" class="mt-1 w-full px-4 py-2 rounded-md border border-gray-300" :value="old('image', $user->image)" required autofocus autocomplete="image" />
            <x-input-error class="mt-2" :messages="$errors->get('image')" />
        </div>

        <x-primary-button>{{ __('Save') }}</x-primary-button>
    </form>
</section>
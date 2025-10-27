<section>
    <div>
        <h2 class="text-2xl font-semibold mb-4">{{ __('Update Resume') }}</h2>
        <p class="mt-1 text-lg text-gray-800">{{ __("Update your resume") }}</p>
    </div>

    <form method="post" action="{{ route('profile.update.resume') }}" class="mt-6 space-y-6"
        enctype="multipart/form-data">
        @csrf
        @method('patch')

        <div>
            @if($user->resume)
                <a href="{{ asset('storage/' . $user->resume) }}" class="text-blue-600 hover:text-blue-500 border border-blue-600 rounded-md px-2 py-1.5" target="_blank">{{ asset('storage/' . $user->resume) }}</a>
            @endif
        </div>

        <div>
            <x-input-label for="resume" :value="__('Resume')" />
            <x-text-input id="resume" name="resume" type="file"
                class="mt-1 w-full px-4 py-2 rounded-md border border-gray-300 cursor-pointer" :value="old('resume', $user->resume)"
                required autofocus autocomplete="resume" />
            <x-input-error class="mt-2" :messages="$errors->get('resume')" />
        </div>

        <x-primary-button>{{ __('Update Resume') }}</x-primary-button>
    </form>
</section>
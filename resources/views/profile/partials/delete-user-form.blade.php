<section class="space-y-6">
    <div>
        <h2 class="text-2xl font-semibold mb-4">{{ __('Delete Account') }}</h2>
        <p class="mt-1 text-lg text-gray-800 dark:text-white">
            {{ __('Once your account is deleted, all of its resources and data will be permanently deleted. Before deleting your account, please download any data or information that you wish to retain.') }}
        </p>
    </div>

    <div>
        <form method="post" action="{{ route('profile.destroy') }}">
            @csrf
            @method('delete')
            <h2 class="text-lg font-medium text-gray-900 dark:text-white">{{ __('Are you sure you want to delete your account?') }}</h2>
            <p class="mt-1 text-sm text-gray-600 dark:text-white">
                {{ __('Once your account is deleted, all of its resources and data will be permanently deleted. Please enter your password to confirm you would like to permanently delete your account.') }}
            </p>
            <div class="mt-6">
                <x-input-label for="password" value="{{ __('Password') }}" class="sr-only" />
                <x-text-input id="password" name="password" type="password" class="mt-1 block w-3/4" required />
                <x-input-error :messages="$errors->userDeletion->get('password')" class="mt-2" />
            </div>
            <div class="mt-6 flex justify-end">
                <x-secondary-button x-on:click="$dispatch('close')">{{ __('Cancel') }}</x-secondary-button>
                <x-danger-button class="ms-3">{{ __('Delete Account') }}</x-danger-button>
            </div>
        </form>
    </div>
</section>
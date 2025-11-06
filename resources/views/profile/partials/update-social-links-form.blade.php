<section>
    <div>
        <h2 class="text-2xl font-semibold mb-4">{{ __('Update Social Links') }}</h2>
        <p class="mt-1 text-lg text-gray-800 dark:text-white">{{ __("Update your social links") }}</p>
    </div>

    <form method="post" action="{{ route('profile.update.social') }}" class="mt-6 space-y-6">
        @csrf
        @method('patch')
        <div>
            <x-input-label for="linkedin_url" :value="__('LinkedIn Profile URL')" />
            <x-text-input id="linkedin_url" name="linkedin_url" type="url" class="mt-1 block w-full" :value="old('linkedin_url', $user->linkedin_url)" required autofocus autocomplete="linkedin_url" />
            <x-input-error class="mt-2" :messages="$errors->get('linkedin_url')" />
        </div>
        <div>
            <x-input-label for="github_url" :value="__('Github Profile URL')" />
            <x-text-input id="github_url" name="github_url" type="url" class="mt-1 block w-full" :value="old('github_url', $user->github_url)" required autofocus autocomplete="github_url" />
            <x-input-error class="mt-2" :messages="$errors->get('github_url')" />
        </div>
        <div>
            <x-input-label for="website_url" :value="__('Personal Website URL')" />
            <x-text-input id="website_url" name="website_url" type="url" class="mt-1 block w-full" :value="old('website_url', $user->website_url)" required autofocus autocomplete="website_url" />
            <x-input-error class="mt-2" :messages="$errors->get('website_url')" />
        </div>
        <x-primary-button>{{ __('Update Social Links') }}</x-primary-button>
    </form>
</section>
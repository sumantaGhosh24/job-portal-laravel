<section>
    <div>
        <h2 class="text-2xl font-semibold mb-4">{{ __('Update Social Links') }}</h2>
        <p class="mt-1 text-lg text-gray-800">{{ __("Update company social links") }}</p>
    </div>

    <form method="post" action="{{ route('companies.social', ['id' => $company->id]) }}" class="mt-6 space-y-6">
        @csrf
        @method('patch')

        <div>
            <x-input-label for="linkedin_url" :value="__('LinkedIn Profile URL')" />
            <x-text-input id="linkedin_url" name="linkedin_url" type="url" class="mt-1 block w-full"
                :value="old('linkedin_url', $company->linkedin_url)" required autofocus autocomplete="linkedin_url" />
            <x-input-error class="mt-2" :messages="$errors->get('linkedin_url')" />
        </div>

        <div>
            <x-input-label for="twitter_url" :value="__('Twitter URL')" />
            <x-text-input id="twitter_url" name="twitter_url" type="url" class="mt-1 block w-full"
                :value="old('twitter_url', $company->twitter_url)" required autofocus autocomplete="twitter_url" />
            <x-input-error class="mt-2" :messages="$errors->get('twitter_url')" />
        </div>

        <div>
            <x-input-label for="facebook_url" :value="__('Facebook URL')" />
            <x-text-input id="facebook_url" name="facebook_url" type="url" class="mt-1 block w-full"
                :value="old('facebook_url', $company->facebook_url)" required autofocus autocomplete="facebook_url" />
            <x-input-error class="mt-2" :messages="$errors->get('facebook_url')" />
        </div>

        <div>
            <x-input-label for="youtube_url" :value="__('Youtube URL')" />
            <x-text-input id="youtube_url" name="youtube_url" type="url" class="mt-1 block w-full"
                :value="old('youtube_url', $company->youtube_url)" required autofocus autocomplete="youtube_url" />
            <x-input-error class="mt-2" :messages="$errors->get('youtube_url')" />
        </div>

        <div>
            <x-input-label for="instagram_url" :value="__('Instagram URL')" />
            <x-text-input id="instagram_url" name="instagram_url" type="url" class="mt-1 block w-full"
                :value="old('instagram_url', $company->instagram_url)" required autofocus
                autocomplete="instagram_url" />
            <x-input-error class="mt-2" :messages="$errors->get('instagram_url')" />
        </div>

        <div>
            <x-input-label for="website_url" :value="__('Personal Website URL')" />
            <x-text-input id="website_url" name="website_url" type="url" class="mt-1 block w-full"
                :value="old('website_url', $company->website_url)" required autofocus autocomplete="website_url" />
            <x-input-error class="mt-2" :messages="$errors->get('website_url')" />
        </div>

        <x-primary-button>{{ __('Update Social Links') }}</x-primary-button>
    </form>
</section>
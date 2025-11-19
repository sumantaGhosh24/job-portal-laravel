<div>
    @if (session('message'))
        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="overflow-hidden shadow-sm sm:rounded-lg dark:shadow-gray-300">
                    <p class="p-6">{{ session('message') }}</p>
                </div>
            </div>
        </div>
    @endif

    @isset($user)
        @if ($user->id === $user_id)
            <div x-data="{ tab: 'overview' }" class="shadow-md rounded-lg p-6 mx-5 my-5 dark:shadow-gray-300">
                <x-tabs.nav :active-tab="'overview'" />
                <div class="mt-6 space-y-6">
                    <x-tabs.content tab="overview">
                        <livewire:profile.profile-overview :id="$user->id" />
                    </x-tabs.content>
                    <x-tabs.content tab="personal">
                        <livewire:profile.update-personal-information-form :id="$user->id" />
                    </x-tabs.content>
                    <x-tabs.content tab="image">
                        <livewire:profile.update-profile-image-form :id="$user->id" />
                    </x-tabs.content>
                    <x-tabs.content tab="background">
                        <livewire:profile.update-background-image-form :id="$user->id" />
                    </x-tabs.content>
                    <x-tabs.content tab="professional">
                        <livewire:profile.update-professional-summary-form :id="$user->id" />
                    </x-tabs.content>
                    <x-tabs.content tab="resume">
                        <livewire:profile.update-resume-form :id="$user->id" />
                    </x-tabs.content>
                    <x-tabs.content tab="education">
                        <livewire:profile.update-educations-form :id="$user->id" />
                    </x-tabs.content>
                    <x-tabs.content tab="skills">
                        <livewire:profile.update-skills-form :id="$user->id" />
                    </x-tabs.content>
                    <x-tabs.content tab="projects">
                        <livewire:profile.update-projects-form :id="$user->id" />
                    </x-tabs.content>
                    <x-tabs.content tab="certifications">
                        <livewire:profile.update-certificates-form :id="$user->id" />
                    </x-tabs.content>
                    <x-tabs.content tab="languages">
                        <livewire:profile.update-languages-form :id="$user->id" />
                    </x-tabs.content>
                    <x-tabs.content tab="links">
                        <livewire:profile.update-social-links-form :id="$user->id" />
                    </x-tabs.content>
                    <x-tabs.content tab="password">
                        <livewire:profile.update-password-form :id="$user->id" />
                    </x-tabs.content>
                    <x-tabs.content tab="delete">
                        <livewire:profile.delete-user-form />
                    </x-tabs.content>
                </div>
            </div>
        @else
            <div class="shadow-md rounded-lg p-6 mx-5 my-5 dark:shadow-gray-300">
                <livewire:profile.profile-overview :id="$user->id" />
            </div>
        @endif
    @endisset

    @empty($user)
        <div class='flex items-center justify-center h-screen'>
            <div
                class='h-[500px] w-[60%] gap-5 shadow-md rounded-md shadow-black flex flex-col items-center justify-center dark:shadow-gray-300'>
                <h1 class='text-4xl font-bold capitalize'>Invalid user ID</h1>
                <a href={{ route('home') }} wire:navigate>
                    <x-primary-button>{{ __('Go Back Home') }}</x-primary-button>
                </a>
            </div>
        </div>
    @endempty
</div>
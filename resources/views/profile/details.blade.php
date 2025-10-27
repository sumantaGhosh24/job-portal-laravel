<x-app-layout>
    <x-slot:title>Profile</x-slot>

        @if (session('message'))
            <div class="py-12">
                <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                        <div class="p-6 text-gray-900">
                            {{ session('message') }}
                        </div>
                    </div>
                </div>
            </div>
        @endif

        @isset($user)
            @if ($user->id === $user_id)
                <div x-data="{ tab: 'overview' }" class="bg-white shadow-md rounded-lg p-6 mx-5 my-5">
                    <x-tabs.nav :active-tab="'overview'" />
                    <div class="mt-6 space-y-6">
                        <x-tabs.content tab="overview">
                            @include('profile.partials.profile-overview')
                        </x-tabs.content>
                        <x-tabs.content tab="personal">
                            @include('profile.partials.update-personal-information-form')
                        </x-tabs.content>
                        <x-tabs.content tab="image">
                            @include('profile.partials.update-profile-image-form')
                        </x-tabs.content>
                        <x-tabs.content tab="background">
                            @include('profile.partials.update-background-image-form')
                        </x-tabs.content>
                        <x-tabs.content tab="professional">
                            @include('profile.partials.update-professional-summary-form')
                        </x-tabs.content>
                        <x-tabs.content tab="resume">
                            @include('profile.partials.update-resume-form')
                        </x-tabs.content>
                        <x-tabs.content tab="experience">
                            <h2 class="text-xl font-semibold text-gray-800">Experience</h2>
                        </x-tabs.content>
                        <x-tabs.content tab="education">
                            <h2 class="text-xl font-semibold text-gray-800">Education</h2>
                        </x-tabs.content>
                        <x-tabs.content tab="skills">
                            @include('profile.partials.update-skills-form')
                        </x-tabs.content>
                        <x-tabs.content tab="projects">
                            @include('profile.partials.update-projects-form')
                        </x-tabs.content>
                        <x-tabs.content tab="certifications">
                            @include('profile.partials.update-certificates-form')
                        </x-tabs.content>
                        <x-tabs.content tab="languages">
                            @include('profile.partials.update-languages-form')
                        </x-tabs.content>
                        <x-tabs.content tab="links">
                            @include('profile.partials.update-social-links-form')
                        </x-tabs.content>
                        <x-tabs.content tab="password">
                            @include('profile.partials.update-password-form')
                        </x-tabs.content>
                        <x-tabs.content tab="delete">
                            @include('profile.partials.delete-user-form')
                        </x-tabs.content>
                    </div>
                </div>
            @else
                <div class="bg-white shadow-md rounded-lg p-6 mx-5 my-5">
                    @include('profile.partials.profile-overview')
                </div>
            @endif
        @endisset

        @empty($user)
            <div class='flex items-center justify-center h-screen'>
                <div
                    class='h-[500px] w-[60%] gap-5 shadow-md rounded-md shadow-black flex flex-col items-center justify-center'>
                    <h1 class='text-4xl font-bold capitalize'>Invalid user ID</h1>
                    <a href={{ route('home') }}>
                        <x-primary-button class='mx-4 max-w-fit'>
                            {{ __('Go Back Home') }}
                        </x-primary-button>
                    </a>
                </div>
            </div>
        @endempty
</x-app-layout>
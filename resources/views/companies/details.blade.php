<x-app-layout>
    <x-slot:title>Company Profile</x-slot>

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

        @isset($company)
            @if (auth()->id() === $company->owner_id)
                <div x-data="{ tab: 'overview' }" class="bg-white shadow-md rounded-lg p-6 mx-5 my-5">
                    <x-tabs.company-nav :active-tab="'overview'" />
                    <div class="mt-6 space-y-6">
                        <x-tabs.content tab="overview">
                            @include('companies.partials.company-overview')
                        </x-tabs.content>
                        <x-tabs.content tab="update">
                            @include('companies.partials.update-company-form')
                        </x-tabs.content>
                        <x-tabs.content tab="description">
                            @include('companies.partials.update-description-form')
                        </x-tabs.content>
                        <x-tabs.content tab="logo">
                            @include('companies.partials.update-logo-form')
                        </x-tabs.content>
                        <x-tabs.content tab="banner">
                            @include('companies.partials.update-banner-form')
                        </x-tabs.content>
                        <x-tabs.content tab="social">
                            @include('companies.partials.update-social-links-form')
                        </x-tabs.content>
                        <x-tabs.content tab="members">
                            @include('companies.partials.manage-members-form')
                        </x-tabs.content>
                    </div>
                </div>
            @else
                <div class="bg-white shadow-md rounded-lg p-6 mx-5 my-5">
                    @include('companies.partials.company-overview')
                </div>
            @endif
        @endisset

        @empty($company)
            <div class='flex items-center justify-center h-screen'>
                <div
                    class='h-[500px] w-[60%] gap-5 shadow-md rounded-md shadow-black flex flex-col items-center justify-center'>
                    <h1 class='text-4xl font-bold capitalize'>Invalid company ID</h1>
                    <a href={{ route('home') }}>
                        <x-primary-button class='mx-4 max-w-fit'>
                            {{ __('Go Back Home') }}
                        </x-primary-button>
                    </a>
                </div>
            </div>
        @endempty
</x-app-layout>
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

    @isset($company)
        @if (auth()->id() === $company->owner_id)
            <div x-data="{ tab: 'overview' }" class="shadow-md rounded-lg p-6 mx-5 my-5 dark:shadow-gray-300">
                <x-tabs.company-nav :active-tab="'overview'" />
                <div class="mt-6 space-y-6">
                    <x-tabs.content tab="overview">
                        <livewire:companies.company-overview :id="$company->id" />
                    </x-tabs.content>
                    <x-tabs.content tab="update">
                        <livewire:companies.update-company-form :id="$company->id" />
                    </x-tabs.content>
                    <x-tabs.content tab="description">
                        <livewire:companies.update-description-form :id="$company->id" />
                    </x-tabs.content>
                    <x-tabs.content tab="logo">
                        <livewire:companies.update-logo-form :id="$company->id" />
                    </x-tabs.content>
                    <x-tabs.content tab="banner">
                        <livewire:companies.update-banner-form :id="$company->id" />
                    </x-tabs.content>
                    <x-tabs.content tab="social">
                        <livewire:companies.update-social-links-form :id="$company->id" />
                    </x-tabs.content>
                    <x-tabs.content tab="members">
                        <livewire:companies.manage-members-form :id="$company->id" />
                    </x-tabs.content>
                </div>
            </div>
        @else
            <div class="shadow-md rounded-lg p-6 mx-5 my-5 dark:shadow-gray-300">
                <livewire:companies.company-overview :id="$company->id" />
            </div>
        @endif
    @endisset

    @empty($company)
        <div class='flex items-center justify-center h-screen'>
            <div
                class='h-[500px] w-[60%] gap-5 shadow-md rounded-md shadow-black flex flex-col items-center justify-center dark:shadow-gray-300'>
                <h1 class='text-4xl font-bold capitalize'>Invalid company ID</h1>
                <a href={{ route('home') }} wire:navigate>
                    <x-primary-button>{{ __('Go Back Home') }}</x-primary-button>
                </a>
            </div>
        </div>
    @endempty
</div>
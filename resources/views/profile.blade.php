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

        <div x-data="{ tab: 'overview' }" class="bg-white shadow-md rounded-lg p-6 mx-5 mt-5">
            <x-tabs.nav :active-tab="'overview'" />
            <div class="mt-6 space-y-6">
                <x-tabs.content tab="overview">
                    <h2 class="text-xl font-semibold text-gray-800">Profile Overview</h2>
                    <p class="text-gray-600">
                        Welcome to your profile dashboard. Here you can view your personal information.
                    </p>
                </x-tabs.content>
                <x-tabs.content tab="settings">
                    <h2 class="text-xl font-semibold text-gray-800">Profile Settings</h2>
                </x-tabs.content>
                <x-tabs.content tab="security">
                    <h2 class="text-xl font-semibold text-gray-800">Security</h2>
                    <p class="text-gray-600">Change your password or manage login sessions.</p>
                </x-tabs.content>
            </div>
        </div>
</x-app-layout>
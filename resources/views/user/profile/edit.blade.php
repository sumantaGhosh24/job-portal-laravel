<x-app-layout>
    <x-slot:title>User Profile</x-slot>

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

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="p-4 sm:p-8 shadow-md rounded-md">
                <div class="max-w-xl">
                    @include('user.profile.partials.update-profile-image-form')
                </div>
            </div>

            <div class="p-4 sm:p-8 shadow-md rounded-md">
                <div class="max-w-xl">
                    @include('user.profile.partials.update-profile-information-form')
                </div>
            </div>

            <div class="p-4 sm:p-8 shadow-md rounded-md">
                <div class="max-w-xl">
                    @include('user.profile.partials.update-profile-address-form')
                </div>
            </div>

            <div class="p-4 sm:p-8 shadow-md rounded-md">
                <div class="max-w-xl">
                    @include('user.profile.partials.update-password-form')
                </div>
            </div>

            <div class="p-4 sm:p-8 shadow-md rounded-md">
                <div class="max-w-xl">
                    @include('user.profile.partials.delete-user-form')
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
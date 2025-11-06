<x-app-layout>
    <x-slot:title>Create a Company</x-slot:title>

    @if (session('message'))
        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="overflow-hidden shadow-sm sm:rounded-lg dark:shadow-gray-300">
                    <p class="p-6">{{ session('message') }}</p>
                </div>
            </div>
        </div>
    @endif

    @if ($user->memberships)
        <div class="flex justify-center h-full">
            <div class="rounded-lg shadow-md p-8 shadow-black w-[60%] my-20 dark:shadow-gray-300">
                <h1 class="text-3xl font-semibold mb-4">You have already member of an company</h1>
                <a href="{{ route('companies.show', ['id' => $user->company->id]) }}">
                    <x-primary-button>{{ __('Go to Company') }}</x-primary-button>
                </a>
            </div>
        </div>
    @else
        <div class="flex justify-center h-full">
            <div class="rounded-lg shadow-md p-8 shadow-black w-[60%] my-20 dark:shadow-gray-300">
                <h1 class="text-3xl font-semibold mb-4">Create a Company</h1>
                <form method="POST" action="{{ route('companies.store') }}" class='space-y-4'>
                    @csrf
                    <div>
                        <x-input-label for="name" :value="__('Company Name')" />
                        <x-text-input id="name" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" />
                        <x-input-error :messages="$errors->get('name')" class="mt-2" />
                    </div>
                    <div>
                        <x-input-label for="sector" :value="__('Company Sector')" />
                        <select id='sector' name='sector' class="mt-2 w-full px-4 py-2 rounded-md border border-gray-300" value="{{ old('sector') }}" required autofocus autocomplete="sector">
                            <option value="">Select Company Sector</option>
                            <option value="technology">Technology</option>
                            <option value="healthcare">Healthcare</option>
                            <option value="finance">Finance</option>
                            <option value="manufacturing">Manufacturing</option>
                        </select>
                        <x-input-error class="mt-2" :messages="$errors->get('sector')" />
                    </div>
                    <div>
                        <x-input-label for="size" :value="__('Company Size')" />
                        <select id='size' name='size' class="mt-2 w-full px-4 py-2 rounded-md border border-gray-300" value="{{ old('size') }}" required autofocus autocomplete="size">
                            <option value="">Select Company Size</option>
                            <option value="1-10">1-10</option>
                            <option value="11-50">11-50</option>
                            <option value="51-200">51-200</option>
                            <option value="201-500">201-500</option>
                            <option value="500">500</option>
                        </select>
                        <x-input-error class="mt-2" :messages="$errors->get('size')" />
                    </div>
                    <div>
                        <x-input-label for="phone_number" :value="__('Company Phone Number')" />
                        <x-text-input id="phone_number" type="text" name="phone_number" :value="old('phone_number')" required autofocus autocomplete="phone_number" />
                        <x-input-error :messages="$errors->get('phone_number')" class="mt-2" />
                    </div>
                    <div>
                        <x-input-label for="email" :value="__('Company Email')" />
                        <x-text-input id="email" type="email" name="email" :value="old('email')" required autofocus autocomplete="email" />
                        <x-input-error :messages="$errors->get('email')" class="mt-2" />
                    </div>
                    <div>
                        <x-input-label for="location" :value="__('Company Location')" />
                        <x-text-input id="location" type="text" name="location" :value="old('location')" required autofocus autocomplete="location" />
                        <x-input-error :messages="$errors->get('location')" class="mt-2" />
                    </div>
                    <x-primary-button>{{ __('Create Company') }}</x-primary-button>
                </form>
            </div>
        </div>
    @endif
</x-app-layout>
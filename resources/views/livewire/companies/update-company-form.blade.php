<section>
    <div>
        <h2 class="text-2xl font-semibold mb-4">{{ __('Update Company Information') }}</h2>
        <p class="mt-1 text-lg text-gray-800 dark:text-white">{{ __("Update company information") }}</p>
    </div>

    @if (session('message'))
        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="overflow-hidden shadow-sm sm:rounded-lg dark:shadow-gray-300">
                    <p class="p-6">{{ session('message') }}</p>
                </div>
            </div>
        </div>
    @endif

    <form wire:submit="update" class="mt-6 space-y-6">
        <div>
            <x-input-label for="name" :value="__('Company Name')" />
            <x-text-input id="name" type="text" wire:model="name" required />
            @error('name') <span class="text-lg text-red-600 mt-2">{{ $message }}</span> @enderror
        </div>
        <div>
            <x-input-label for="sector" :value="__('Company Sector')" />
            <select id='sector' wire:model='sector' class="mt-2 w-full px-4 py-2 rounded-md border border-gray-300"
                required>
                <option value="">Select Company Sector</option>
                <option value="technology">Technology</option>
                <option value="healthcare">Healthcare</option>
                <option value="finance">Finance</option>
                <option value="manufacturing">Manufacturing</option>
            </select>
            @error('sector') <span class="text-lg text-red-600 mt-2">{{ $message }}</span> @enderror
        </div>
        <div>
            <x-input-label for="size" :value="__('Company Size')" />
            <select id='size' wire:model='size' class="mt-2 w-full px-4 py-2 rounded-md border border-gray-300"
                required>
                <option value="">Select Company Size</option>
                <option value="1-10">1-10</option>
                <option value="11-50">11-50</option>
                <option value="51-200">51-200</option>
                <option value="201-500">201-500</option>
                <option value="500+">500+</option>
            </select>
            @error('size') <span class="text-lg text-red-600 mt-2">{{ $message }}</span> @enderror
        </div>
        <div>
            <x-input-label for="phone_number" :value="__('Company Phone Number')" />
            <x-text-input id="phone_number" type="text" wire:model="phone_number" required />
            @error('phone_number') <span class="text-lg text-red-600 mt-2">{{ $message }}</span> @enderror
        </div>
        <div>
            <x-input-label for="email" :value="__('Company Email')" />
            <x-text-input id="email" type="email" wire:model="email" required />
            @error('email') <span class="text-lg text-red-600 mt-2">{{ $message }}</span> @enderror
        </div>
        <div>
            <x-input-label for="location" :value="__('Company Location')" />
            <x-text-input id="location" type="text" wire:model="location" required />
            @error('location') <span class="text-lg text-red-600 mt-2">{{ $message }}</span> @enderror
        </div>
        <x-primary-button>
            <span wire:loading.remove>Update Company Information</span>
            <span wire:loading>Processing...</span>
        </x-primary-button>
    </form>
</section>
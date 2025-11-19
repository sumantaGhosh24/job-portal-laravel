<section>
    <div>
        <h2 class="text-2xl font-semibold mb-4">{{ __('Update Personal Information') }}</h2>
        <p class="mt-1 text-lg text-gray-800 dark:text-white">{{ __("Update your personal information") }}</p>
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
            <x-input-label for="first_name" :value="__('First Name')" />
            <x-text-input id="first_name" wire:model="first_name" type="text" class="mt-1 block w-full" required />
            @error('first_name') <span class="text-lg text-red-600 mt-2">{{ $message }}</span> @enderror
        </div>
        <div>
            <x-input-label for="last_name" :value="__('Last Name')" />
            <x-text-input id="last_name" wire:model="last_name" type="text" class="mt-1 block w-full" required />
            @error('last_name') <span class="text-lg text-red-600 mt-2">{{ $message }}</span> @enderror
        </div>
        <div>
            <x-input-label for="mobile_number" :value="__('Mobile Number')" />
            <x-text-input id="mobile_number" wire:model="mobile_number" type="text" class="mt-1 block w-full"
                required />
            @error('mobile_number') <span class="text-lg text-red-600 mt-2">{{ $message }}</span> @enderror
        </div>
        <div>
            <x-input-label for="desired_job_title" :value="__('Desired Job Title')" />
            <x-text-input id="desired_job_title" wire:model="desired_job_title" type="text" class="mt-1 block w-full"
                required />
            @error('desired_job_title') <span class="text-lg text-red-600 mt-2">{{ $message }}</span> @enderror
        </div>
        <div>
            <x-input-label for="desired_job_type" :value="__('Desired Job Type')" />
            <select id='desired_job_type' wire:model='desired_job_type'
                class="mt-2 w-full px-4 py-2 rounded-md border border-gray-300" required>
                <option value="">Select Desired Job Type</option>
                <option value="full-time">Full-time</option>
                <option value="part-time">Part-time</option>
                <option value="contract">Contract</option>
                <option value="internship">Internship</option>
                <option value="temporary">Temporary</option>
            </select>
            @error('desired_job_type') <span class="text-lg text-red-600 mt-2">{{ $message }}</span> @enderror
        </div>
        <div>
            <x-input-label for="city" :value="__('City')" />
            <x-text-input id="city" wire:model="city" type="text" class="mt-1 block w-full" required />
            @error('city') <span class="text-lg text-red-600 mt-2">{{ $message }}</span> @enderror
        </div>
        <div>
            <x-input-label for="state" :value="__('State')" />
            <x-text-input id="state" wire:model="state" type="text" class="mt-1 block w-full" required />
            @error('state') <span class="text-lg text-red-600 mt-2">{{ $message }}</span> @enderror
        </div>
        <div>
            <x-input-label for="country" :value="__('Country')" />
            <x-text-input id="country" wire:model="country" type="text" class="mt-1 block w-full" required />
            @error('country') <span class="text-lg text-red-600 mt-2">{{ $message }}</span> @enderror
        </div>
        <div>
            <x-input-label for="zip" :value="__('Zip')" />
            <x-text-input id="zip" wire:model="zip" type="text" class="mt-1 block w-full" required />
            @error('zip') <span class="text-lg text-red-600 mt-2">{{ $message }}</span> @enderror
        </div>
        <div>
            <x-input-label for="addressline" :value="__('Addressline')" />
            <x-text-input id="addressline" wire:model="addressline" type="text" class="mt-1 block w-full" required />
            @error('addressline') <span class="text-lg text-red-600 mt-2">{{ $message }}</span> @enderror
            <x-input-error class="mt-2" :messages="$errors->get('addressline')" />
        </div>
        <x-primary-button>
            <span wire:loading.remove>Update Personal Information</span>
            <span wire:loading>Processing...</span>
        </x-primary-button>
    </form>
</section>
<section>
    @if (session('message'))
        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="overflow-hidden shadow-sm sm:rounded-lg dark:shadow-gray-300">
                    <p class="p-6">{{ session('message') }}</p>
                </div>
            </div>
        </div>
    @endif

    <div class="mt-6">
        <form wire:submit="save" class="space-y-6">
            <h2 class="text-2xl font-semibold mb-4">{{ __('Create Certificate') }}</h2>
            <div>
                <x-input-label for="name" :value="__('Certificate Name')" />
                <x-text-input id="name" wire:model="name" type="text" class="mt-1 block w-full" required />
                @error('name') <span class="text-lg text-red-600 mt-2">{{ $message }}</span> @enderror
            </div>
            <div>
                <x-input-label for="issuing_organization" :value="__('Certificate Issuing Organization')" />
                <x-text-input id="issuing_organization" wire:model="issuing_organization" type="text"
                    class="mt-1 block w-full" required />
                @error('issuing_organization') <span class="text-lg text-red-600 mt-2">{{ $message }}</span> @enderror
            </div>
            <div>
                <x-input-label for="issue_date" :value="__('Certificate Issue Date')" />
                <x-text-input id="issue_date" wire:model="issue_date" type="date" class="mt-1 block w-full" required />
                @error('issue_date') <span class="text-lg text-red-600 mt-2">{{ $message }}</span> @enderror
            </div>
            <x-primary-button>
                <span wire:loading.remove>Add Certificate</span>
                <span wire:loading>Processing...</span>
            </x-primary-button>
        </form>
    </div>
    @isset($certificate)
        <div class="mt-6">
            <h2 class="text-2xl font-semibold mb-4">{{ __('Update Certificates') }}</h2>
            <form wire:submit="update" class="space-y-6">
                <div>
                    <x-input-label for="certificate_name" :value="__('Certificate Name')" />
                    <x-text-input id="certificate_name" wire:model="certificate_name" type="text" class="mt-1 block w-full"
                        required />
                    @error('certificate_name') <span class="text-lg text-red-600 mt-2">{{ $message }}</span> @enderror
                </div>
                <div>
                    <x-input-label for="certificate_issuing_organization" :value="__('Certificate Issuing Organization')" />
                    <x-text-input id="certificate_issuing_organization" wire:model="certificate_issuing_organization"
                        type="text" class="mt-1 block w-full" required />
                    @error('certificate_issuing_organization') <span class="text-lg text-red-600 mt-2">{{ $message }}</span>
                    @enderror
                </div>
                <div>
                    <x-input-label for="certificate_issue_date" :value="__('Certificate Issue Date')" />
                    <x-text-input id="certificate_issue_date" wire:model="certificate_issue_date" type="date"
                        class="mt-1 block w-full" required />
                    @error('certificate_issue_date') <span class="text-lg text-red-600 mt-2">{{ $message }}</span> @enderror
                </div>
                <x-primary-button>
                    <span wire:loading.remove>Update Certificate</span>
                    <span wire:loading>Processing...</span>
                </x-primary-button>
            </form>
        </div>
    @endisset
    <div class="mt-6">
        <h2 class="text-2xl font-semibold mb-4">{{ __('Manage Certificates') }}</h2>
        @forelse ($user->certificates as $certificate)
            <div class='flex items-center justify-between gap-3 border border-blue-500 px-1 py-1.5 rounded-md mb-3'
                wire:key="{{ $certificate->id }}">
                <h3 class="text-lg font-bold capitalize">{{ $certificate->name }}</h3>
                <div>
                    <x-primary-button
                        wire:click="edit({{ $certificate->id }})">{{ __('Edit Certificate') }}</x-primary-button>
                    <x-danger-button
                        wire:click="destroy({{ $certificate->id }})">{{ __('Delete Certificate') }}</x-danger-button>
                </div>
            </div>
        @empty
            <p class='text-lg font-bold'>No certificates</p>
        @endforelse
    </div>
</section>
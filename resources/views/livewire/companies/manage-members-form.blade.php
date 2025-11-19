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
            <h2 class="text-2xl font-semibold mb-4">{{ __('Add Member') }}</h2>
            <div>
                <x-input-label for="user_id" :value="__('Member ID')" />
                <x-text-input id="user_id" wire:model="user_id" type="text" class="mt-1 block w-full" required />
                @error('user_id') <span class="text-lg text-red-600 mt-2">{{ $message }}</span> @enderror
            </div>
            <div>
                <x-input-label for="position" :value="__('Member Position')" />
                <x-text-input id="position" wire:model="position" type="text" class="mt-1 block w-full" required />
                @error('position') <span class="text-lg text-red-600 mt-2">{{ $message }}</span> @enderror
            </div>
            <div>
                <x-input-label for="department" :value="__('Member Department')" />
                <x-text-input id="department" wire:model="department" type="text" class="mt-1 block w-full" required />
                @error('department') <span class="text-lg text-red-600 mt-2">{{ $message }}</span> @enderror
            </div>
            <x-primary-button>
                <span wire:loading.remove>Add Member</span>
                <span wire:loading>Processing...</span>
            </x-primary-button>
        </form>
    </div>
    @isset($member)
        <div class="mt-6">
            <h2 class="text-2xl font-semibold mb-4">{{ __('Update Members') }}</h2>
            <form wire:submit="update" class="space-y-6">
                <div>
                    <x-input-label for="user" :value="__('User')" />
                    <p class="text-lg font-semibold">{{ $member->user->first_name }} {{ $member->user->last_name }}</p>
                </div>
                <div>
                    <x-input-label for="member_position" :value="__('Member Position')" />
                    <x-text-input id="member_position" wire:model="member_position" type="text" class="mt-1 block w-full"
                        required />
                    @error('member_position') <span class="text-lg text-red-600 mt-2">{{ $message }}</span> @enderror
                </div>
                <div>
                    <x-input-label for="member_department" :value="__('Member Department')" />
                    <x-text-input id="member_department" wire:model="member_department" type="text"
                        class="mt-1 block w-full" required />
                    @error('member_department') <span class="text-lg text-red-600 mt-2">{{ $message }}</span> @enderror
                </div>
                <x-primary-button>
                    <span wire:loading.remove>Update</span>
                    <span wire:loading>Processing...</span>
                </x-primary-button>
            </form>
        </div>
    @endisset
    <div class="mt-6">
        <h2 class="text-2xl font-semibold mb-4">{{ __('Manage Members') }}</h2>
        @forelse ($company->members as $member)
            @if($member->role === 'admin' || $member->role === 'ex-employee')
                <div class='flex items-center justify-between gap-3 border border-blue-500 px-1 py-1.5 rounded-md mb-3'
                    wire:key="{{ $member->id }}">
                    <h3 class='text-lg font-bold capitalize'>{{ substr($member->user->first_name ?? 'U', 0, 1) }}.
                        {{ $member->user->last_name }} - {{ $member->position ?? 'N/A' }} - {{ $member->department ?? 'N/A' }} -
                        {{ $member->status }} - {{ $member->role }} - {{ $member->joining_date }} -
                        {{ $member->leaving_date ?? 'Present' }}
                    </h3>
                    <x-primary-button wire:click="edit({{ $member->id }})">{{ __('Edit Member') }}</x-primary-button>
                </div>
            @else
                <div class='flex items-center justify-between gap-3 border border-blue-500 px-1 py-1.5 rounded-md mb-3'
                    wire:key="{{ $member->id }}">
                    <h3 class='text-lg font-bold capitalize'>{{ substr($member->user->first_name ?? 'U', 0, 1) }}.
                        {{ $member->user->last_name }} - {{ $member->position ?? 'N/A' }} - {{ $member->department ?? 'N/A' }} -
                        {{ $member->status }} - {{ $member->role }} - {{ $member->joining_date }} -
                        {{ $member->leaving_date ?? 'Present' }}
                    </h3>
                    <div>
                        <x-primary-button wire:click="edit({{ $member->id }})">{{ __('Edit Member') }}</x-primary-button>
                        <x-danger-button wire:click="remove({{ $member->id }})">{{ __('Delete Member') }}</x-danger-button>
                    </div>
                </div>
            @endif
        @empty
            <p class='text-lg font-bold'>No members</p>
        @endforelse
    </div>
</section>
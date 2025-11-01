<section>
    <div class="mt-6">
        <form method="post" action="{{ route('members.store', ['id' => $company->id]) }}" class="space-y-6">
            @csrf

            <h2 class="text-2xl font-semibold mb-4">{{ __('Add Member') }}</h2>

            <div>
                <x-input-label for="user_id" :value="__('Member ID')" />
                <x-text-input id="user_id" name="user_id" type="text" class="mt-1 block w-full" :value="old('user_id')"
                    required autofocus autocomplete="user_id" />
                <x-input-error class="mt-2" :messages="$errors->get('user_id')" />
            </div>

            <div>
                <x-input-label for="position" :value="__('Member Position')" />
                <x-text-input id="position" name="position" type="text" class="mt-1 block w-full"
                    :value="old('position')" required autofocus autocomplete="position" />
                <x-input-error class="mt-2" :messages="$errors->get('position')" />
            </div>

            <div>
                <x-input-label for="department" :value="__('Member Department')" />
                <x-text-input id="department" name="department" type="text" class="mt-1 block w-full"
                    :value="old('department')" required autofocus autocomplete="department" />
                <x-input-error class="mt-2" :messages="$errors->get('department')" />
            </div>

            <x-primary-button>{{ __('Add Member') }}</x-primary-button>
        </form>
    </div>
    <div class="mt-6">
        <h2 class="text-2xl font-semibold mb-4">{{ __('Update Members') }}</h2>
        <div class="">
            @forelse ($company->members as $member)
                <form method="post"
                    action="{{ route('members.update', ['id' => $company->id, 'memberId' => $member->id]) }}"
                    class="flex items-center justify-between gap-3">
                    @csrf
                    @method('patch')

                    <div>
                        <x-input-label for="user" :value="__('User')" />
                        <p class="text-lg font-semibold">{{ $member->user->first_name }} {{ $member->user->last_name }}</p>
                    </div>

                    <div>
                        <x-input-label for="position" :value="__('Member Position')" />
                        <x-text-input id="position" name="position" type="text" class="mt-1 block w-full"
                            :value="old('position', $member->position)" required autofocus autocomplete="position" />
                        <x-input-error class="mt-2" :messages="$errors->get('position')" />
                    </div>

                    <div>
                        <x-input-label for="department" :value="__('Member Department')" />
                        <x-text-input id="department" name="department" type="text" class="mt-1 block w-full"
                            :value="old('department', $member->department)" required autofocus autocomplete="department" />
                        <x-input-error class="mt-2" :messages="$errors->get('department')" />
                    </div>

                    <x-primary-button class="max-w-fit">{{ __('Update') }}</x-primary-button>
                </form>
            @empty
                <p class='text-lg font-bold'>No members</p>
            @endforelse
        </div>
    </div>
    <div class="mt-6">
        <h2 class="text-2xl font-semibold mb-4">{{ __('Delete Members') }}</h2>
        @forelse ($company->members as $member)
            @if($member->role === 'admin' || $member->role === 'ex-employee')
                <div class='flex items-center justify-between gap-3 border border-blue-500 px-1 py-1.5 rounded-md mb-3'>
                    <h3 class='text-lg font-bold capitalize'>{{ substr($member->user->first_name ?? 'U', 0, 1) }}.
                        {{ $member->user->last_name }} - {{ $member->position ?? 'N/A' }} - {{ $member->department ?? 'N/A' }} -
                        {{ $member->status }} - {{ $member->role }} - {{ $member->joining_date }} -
                        {{ $member->leaving_date ?? 'Present' }}
                    </h3>
                </div>
            @else
                <form method="post" action="{{ route('members.remove', ['id' => $member->id]) }}"
                    class='flex items-center justify-between gap-3 border border-blue-500 px-1 py-1.5 rounded-md mb-3'>
                    @csrf
                    @method('delete')

                    <h3 class='text-lg font-bold capitalize'>{{ substr($member->user->first_name ?? 'U', 0, 1) }}.
                        {{ $member->user->last_name }} - {{ $member->position ?? 'N/A' }} - {{ $member->department ?? 'N/A' }} -
                        {{ $member->status }} - {{ $member->role }} - {{ $member->joining_date }} -
                        {{ $member->leaving_date ?? 'Present' }}
                    </h3>

                    <x-danger-button class="max-w-fit">{{ __('Remove') }}</x-danger-button>
                </form>
            @endif
        @empty
            <p class='text-lg font-bold'>No members</p>
        @endforelse
    </div>
</section>
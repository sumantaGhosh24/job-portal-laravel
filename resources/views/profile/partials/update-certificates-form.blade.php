<section>
    <div class="mt-6">
        <form method="post" action="{{ route('profile.certificate.add') }}" class="space-y-6">
            @csrf
    
            <h2 class="text-2xl font-semibold mb-4">{{ __('Create Certificate') }}</h2>

            <div>
                <x-input-label for="name" :value="__('Certificate Name')" />
                <x-text-input id="name" name="name" type="text" class="mt-1 block w-full"
                    :value="old('name')" required autofocus autocomplete="name" />
                <x-input-error class="mt-2" :messages="$errors->get('name')" />
            </div>

            <div>
                <x-input-label for="issuing_organization" :value="__('Certificate Issuing Organization')" />
                <x-text-input id="issuing_organization" name="issuing_organization" type="text" class="mt-1 block w-full"
                    :value="old('issuing_organization')" required autofocus autocomplete="issuing_organization" />
                <x-input-error class="mt-2" :messages="$errors->get('issuing_organization')" />
            </div>

            <div>
                <x-input-label for="issue_date" :value="__('Certificate Issue Date')" />
                <x-text-input id="issue_date" name="issue_date" type="date" class="mt-1 block w-full"
                    :value="old('issue_date')" required autofocus autocomplete="issue_date" />
                <x-input-error class="mt-2" :messages="$errors->get('issue_date')" />
            </div>
    
            <x-primary-button>{{ __('Add Certificate') }}</x-primary-button>
        </form>
    </div>
    <div class="mt-6">
        <h2 class="text-2xl font-semibold mb-4">{{ __('Update Certificates') }}</h2>
        <div class="flex justify-between gap-3 flex-wrap">
            @forelse ($user->certificates as $certificate)
                <form method="post" action="{{ route('profile.certificate.update', ['id' => $certificate->id]) }}" class="space-y-6">
                    @csrf
                    @method('patch')
    
                    <div>
                        <x-input-label for="name" :value="__('Certificate Name')" />
                        <x-text-input id="name" name="name" type="text" class="mt-1 block w-full"
                            :value="old('name', $certificate->name)" required autofocus autocomplete="name" />
                        <x-input-error class="mt-2" :messages="$errors->get('name')" />
                    </div>

                    <div>
                        <x-input-label for="issuing_organization" :value="__('Certificate Issuing Organization')" />
                        <x-text-input id="issuing_organization" name="issuing_organization" type="text" class="mt-1 block w-full"
                            :value="old('issuing_organization', $certificate->issuing_organization)" required autofocus autocomplete="issuing_organization" />
                        <x-input-error class="mt-2" :messages="$errors->get('issuing_organization')" />
                    </div>

                    <div>
                        <x-input-label for="issue_date" :value="__('Certificate Issue Date')" />
                        <x-text-input id="issue_date" name="issue_date" type="date" class="mt-1 block w-full"
                            :value="old('issue_date', $certificate->issue_date)" required autofocus autocomplete="issue_date" />
                        <x-input-error class="mt-2" :messages="$errors->get('issue_date')" />
                    </div>
            
                    <x-primary-button>{{ __('Update Certificate') }}</x-primary-button>
                </form>
            @empty
                <p class='text-lg font-bold'>No certificates</p>
            @endforelse
        </div>
    </div>
    <div class="mt-6">
        <h2 class="text-2xl font-semibold mb-4">{{ __('Delete Certificates') }}</h2>
        @forelse ($user->certificates as $certificate)
            <form method="post" action="{{ route('profile.certificate.remove', ['id' => $certificate->id]) }}" class='flex items-center justify-between gap-3 border border-blue-500 px-1 py-1.5 rounded-md mb-3'>
                @csrf
                @method('delete')
                
                <h3 class="text-lg font-bold capitalize">{{ $certificate->name }} - {{ $certificate->issuing_organization }} - {{ $certificate->issue_date }}</h3>
        
                <x-danger-button class="max-w-fit">{{ __('Delete Certificate') }}</x-danger-button>
            </form>
        @empty
            <p class='text-lg font-bold'>No certificates</p>
        @endforelse
    </div>
</section>
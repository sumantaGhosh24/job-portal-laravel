<section>
    <div class="mt-6">
        <form method="post" action="{{ route('profile.project.add') }}" class="space-y-6">
            @csrf
    
            <h2 class="text-2xl font-semibold mb-4">{{ __('Create Project') }}</h2>

            <div>
                <x-input-label for="title" :value="__('Project Title')" />
                <x-text-input id="title" name="title" type="text" class="mt-1 block w-full"
                    :value="old('title')" required autofocus autocomplete="title" />
                <x-input-error class="mt-2" :messages="$errors->get('title')" />
            </div>

            <div>
                <x-input-label for="description" :value="__('Project Description')" />
                <textarea id="description" name="description"
                class="mt-1 block w-full px-4 py-2 rounded-md border border-gray-300" required autofocus
                autocomplete="description">{{ old('description') }}</textarea>
                <x-input-error class="mt-2" :messages="$errors->get('description')" />
            </div>

            <div>
                <x-input-label for="github_url" :value="__('Project Github URL')" />
                <x-text-input id="github_url" name="github_url" type="url" class="mt-1 block w-full"
                    :value="old('github_url')" required autofocus autocomplete="github_url" />
                <x-input-error class="mt-2" :messages="$errors->get('github_url')" />
            </div>
    
            <x-primary-button>{{ __('Add Project') }}</x-primary-button>
        </form>
    </div>
    <div class="mt-6">
        <h2 class="text-2xl font-semibold mb-4">{{ __('Update Projects') }}</h2>
        <div class="flex justify-between gap-3 flex-wrap">
            @forelse ($user->projects as $project)
                <form method="post" action="{{ route('profile.project.update', ['id' => $project->id]) }}" class="space-y-6">
                    @csrf
                    @method('patch')
    
                    <div>
                        <x-input-label for="title" :value="__('Project Title')" />
                        <x-text-input id="title" name="title" type="text" class="mt-1 block w-full"
                            :value="old('title', $project->title)" required autofocus autocomplete="title" />
                        <x-input-error class="mt-2" :messages="$errors->get('title')" />
                    </div>

                    <div>
                        <x-input-label for="description" :value="__('Project Description')" />
                        <textarea id="description" name="description"
                        class="mt-1 block w-full px-4 py-2 rounded-md border border-gray-300" required autofocus
                        autocomplete="description">{{ old('description', $project->description) }}</textarea>
                        <x-input-error class="mt-2" :messages="$errors->get('description')" />
                    </div>

                    <div>
                        <x-input-label for="github_url" :value="__('Project Github URL')" />
                        <x-text-input id="github_url" name="github_url" type="url" class="mt-1 block w-full"
                            :value="old('github_url', $project->github_url)" required autofocus autocomplete="github_url" />
                        <x-input-error class="mt-2" :messages="$errors->get('github_url')" />
                    </div>
            
                    <x-primary-button>{{ __('Update Project') }}</x-primary-button>
                </form>
            @empty
                <p class='text-lg font-bold'>No projects</p>
            @endforelse
        </div>
    </div>
    <div class="mt-6">
        <h2 class="text-2xl font-semibold mb-4">{{ __('Delete Projects') }}</h2>
        @forelse ($user->projects as $project)
            <form method="post" action="{{ route('profile.project.remove', ['id' => $project->id]) }}" class='flex items-center justify-between gap-3 border border-blue-500 px-1 py-1.5 rounded-md mb-3'>
                @csrf
                @method('delete')
                
                <h3 class="text-lg font-bold capitalize">{{ $project->title }}</h3>
        
                <x-danger-button class="max-w-fit">{{ __('Delete Project') }}</x-danger-button>
            </form>
        @empty
            <p class='text-lg font-bold'>No projects</p>
        @endforelse
    </div>
</section>
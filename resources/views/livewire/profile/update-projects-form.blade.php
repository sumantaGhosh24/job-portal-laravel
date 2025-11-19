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
            <h2 class="text-2xl font-semibold mb-4">{{ __('Create Project') }}</h2>
            <div>
                <x-input-label for="title" :value="__('Project Title')" />
                <x-text-input id="title" wire:model="title" type="text" class="mt-1 block w-full" required />
                @error('title') <span class="text-lg text-red-600 mt-2">{{ $message }}</span> @enderror
            </div>
            <div>
                <x-input-label for="description" :value="__('Project Description')" />
                <textarea id="description" wire:model="description"
                    class="mt-1 block w-full px-4 py-2 rounded-md border border-gray-300" required></textarea>
                @error('description') <span class="text-lg text-red-600 mt-2">{{ $message }}</span> @enderror
            </div>
            <div>
                <x-input-label for="github_url" :value="__('Project Github URL')" />
                <x-text-input id="github_url" wire:model="github_url" type="url" class="mt-1 block w-full" required />
                @error('github_url') <span class="text-lg text-red-600 mt-2">{{ $message }}</span> @enderror
            </div>
            <x-primary-button>
                <span wire:loading.remove>Add Project</span>
                <span wire:loading>Processing...</span>
            </x-primary-button>
        </form>
    </div>
    @isset($project)
        <div class="mt-6">
            <h2 class="text-2xl font-semibold mb-4">{{ __('Update Projects') }}</h2>
            <form wire:submit="update" class="space-y-6">
                <div>
                    <x-input-label for="project_title" :value="__('Project Title')" />
                    <x-text-input id="project_title" wire:model="project_title" type="text" class="mt-1 block w-full"
                        required />
                    @error('project_title') <span class="text-lg text-red-600 mt-2">{{ $message }}</span> @enderror
                </div>
                <div>
                    <x-input-label for="project_description" :value="__('Project Description')" />
                    <textarea id="project_description" wire:model="project_description"
                        class="mt-1 block w-full px-4 py-2 rounded-md border border-gray-300" required></textarea>
                    @error('project_description') <span class="text-lg text-red-600 mt-2">{{ $message }}</span> @enderror
                </div>
                <div>
                    <x-input-label for="project_github_url" :value="__('Project Github URL')" />
                    <x-text-input id="project_github_url" wire:model="project_github_url" type="url"
                        class="mt-1 block w-full" required />
                    @error('project_github_url') <span class="text-lg text-red-600 mt-2">{{ $message }}</span> @enderror
                </div>
                <x-primary-button>
                    <span wire:loading.remove>Update Project</span>
                    <span wire:loading>Processing...</span>
                </x-primary-button>
            </form>
        </div>
    @endisset
    <div class="mt-6">
        <h2 class="text-2xl font-semibold mb-4">{{ __('Manage Projects') }}</h2>
        @forelse ($user->projects as $project)
            <div class='flex items-center justify-between gap-3 border border-blue-500 px-1 py-1.5 rounded-md mb-3'
                wire:key="{{ $project->id }}">
                <h3 class="text-lg font-bold capitalize">{{ $project->title }}</h3>
                <div>
                    <x-primary-button wire:click="edit({{ $project->id }})">{{ __('Edit Project') }}</x-primary-button>
                    <x-danger-button wire:click="destroy({{ $project->id }})">{{ __('Delete Project') }}</x-danger-button>
                </div>
            </div>
        @empty
            <p class='text-lg font-bold'>No projects</p>
        @endforelse
    </div>
</section>
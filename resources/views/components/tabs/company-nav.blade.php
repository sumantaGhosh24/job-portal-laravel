@props(['activeTab'])

<nav class="border-b border-gray-200 mb-6 flex space-x-6 flex-wrap dark:bg-black">
    @foreach (['overview' => 'Overview', 'update' => 'Update Company', 'description' => 'Update Description', 'logo' => 'Update Logo', 'banner' => 'Update Banner', 'social' => 'Update Social Links', 'members' => 'Manage Members'] as $key => $label)
        <button type='button' class="py-2 text-sm font-semibold border-b-2 transition hover:cursor-pointer"
            :class="tab === '{{ $key }}' ? 'border-blue-500 text-blue-600' : 'border-transparent text-gray-500 hover:text-blue-500 dark:text-white'"
            @click="tab = '{{ $key }}'">
            {{ $label }}
        </button>
    @endforeach
</nav>
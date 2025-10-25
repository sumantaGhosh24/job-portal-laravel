@props(['activeTab'])

<nav class="border-b border-gray-200 mb-6 flex space-x-6">
    @foreach (['overview' => 'Overview', 'settings' => 'Settings', 'security' => 'Security'] as $key => $label)
        <button type='button' class="py-2 text-sm font-semibold border-b-2 transition"
            :class="tab === '{{ $key }}' ? 'border-indigo-500 text-indigo-600' : 'border-transparent text-gray-500 hover:text-indigo-500'"
            @click="tab = '{{ $key }}'">
            {{ $label }}
        </button>
    @endforeach
</nav>
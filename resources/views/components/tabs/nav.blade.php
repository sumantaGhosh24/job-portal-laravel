@props(['activeTab'])

<nav class="border-b border-gray-200 mb-6 flex space-x-6 flex-wrap dark:bg-black">
    @foreach (['overview' => 'Overview', 'personal' => 'Personal Information', 'image' => 'Profile Image', 'background' => 'Background Image', 'professional' => 'Professional Summary', 'resume' => 'Resume / CV', 'education' => 'Education', 'skills' => 'Skills', 'projects' => 'Projects', 'certifications' => 'Licenses & Certifications', 'languages' => 'Languages', 'links' => 'Social Links', 'password' => 'Update Password', 'delete' => 'Delete Account'] as $key => $label)
        <button type='button' class="py-2 text-sm font-semibold border-b-2 transition hover:cursor-pointer"
            :class="tab === '{{ $key }}' ? 'border-indigo-500 text-indigo-600' : 'border-transparent text-gray-500 hover:text-indigo-500 dark:text-white'"
            @click="tab = '{{ $key }}'">
            {{ $label }}
        </button>
    @endforeach
</nav>
@props(['tab'])

<div x-cloak x-show="tab === '{{ $tab }}'" x-transition.opacity>
    {{ $slot }}
</div>
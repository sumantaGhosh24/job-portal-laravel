@props(['value'])

<label {{ $attributes->merge(['class' => 'block font-medium text-lg text-gray-700 mb-1 dark:text-white']) }}>
    {{ $value ?? $slot }}
</label>
@props(['disabled' => false])

<input @disabled($disabled) {{ $attributes->merge(['class' => 'mb-2 w-full px-4 py-2 rounded-md border border-gray-300']) }}>

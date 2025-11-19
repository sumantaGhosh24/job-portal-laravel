<button {{ $attributes->merge(['type' => 'submit', 'class' => 'max-w-fit bg-blue-500 text-white px-4 py-2 rounded-md hover:bg-blue-600 transition-colors disabled:bg-blue-200 cursor-pointer']) }}>
    {{ $slot }}
</button>
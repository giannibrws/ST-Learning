<button {{ $attributes->merge(['type' => 'submit', 'class' => 'text-white bg-blue-500 bg-transparent hover:bg-transparent font-semibold hover:text-blue-700 py-2 px-4 border border-blue-500 hover:border-blue-500 rounded']) }}>
    {{ $slot }}
</button>

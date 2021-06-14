<button {{ $attributes->merge(['type' => 'button', 'class' => 'px-4 py-2 bg-red-500 border border-transparent rounded font-semibold text-white hover:bg-red-400 focus:outline-none focus:border-red-700 focus:ring focus:ring-red-200 active:bg-red-600 disabled:opacity-25 transition']) }}>
    {{ $slot }}
</button>

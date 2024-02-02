<button
    {{ $attributes->merge(['type' => 'submit', 'class' => 'rounded-md text-sm font-medium ring-offset-background transition-colors focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ring focus-visible:ring-offset-2 disabled:pointer-events-none disabled:opacity-50 bg-black dark:bg-white text-white dark:text-black hover:bg-black/90 dark:hover:bg-white/90 h-10 px-4 py-2']) }}>
    {{ $slot }}
</button>

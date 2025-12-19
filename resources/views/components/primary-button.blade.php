<button {{ $attributes->merge(['type' => 'submit', 'class' => 'inline-flex items-center px-4 py-2 bg-primary border border-transparent rounded-lg font-bold text-xs text-primary-foreground uppercase tracking-widest hover:opacity-90 focus:outline-none focus:ring-4 focus:ring-primary/20 active:scale-95 transition-all duration-150 shadow-lg shadow-primary/20']) }}>
    {{ $slot }}
</button>
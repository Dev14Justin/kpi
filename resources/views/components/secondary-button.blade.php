<button {{ $attributes->merge(['type' => 'button', 'class' => 'inline-flex items-center px-4 py-2 bg-background border border-border rounded-lg font-bold text-xs text-foreground uppercase tracking-widest shadow-sm hover:bg-muted focus:outline-none focus:ring-4 focus:ring-primary/10 active:scale-95 disabled:opacity-25 transition-all duration-150']) }}>
    {{ $slot }}
</button>
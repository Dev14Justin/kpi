@props(['disabled' => false])

<input @disabled($disabled) {{ $attributes->merge(['class' => 'border-input bg-background text-foreground focus:border-primary focus:ring-4 focus:ring-primary/10 rounded-xl shadow-sm transition-all py-3 px-4 outline-none']) }}>
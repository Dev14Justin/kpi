@props(['href', 'active', 'icon', 'label', 'badge' => null])

<a href="{{ $href }}" wire:navigate
    class="group flex items-center gap-3 px-3 py-2 rounded-xl transition-all {{ $active ? 'bg-primary/10 dark:bg-[#282828] text-primary shadow-sm' : 'text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-white hover:bg-gray-100 dark:hover:bg-white/5' }}">
    <div class="relative">
        <svg class="w-5 h-5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="{{ $icon }}"></path>
        </svg>
        @if($badge)
        <span class="absolute -top-1.5 -right-1.5 flex h-4 w-4 items-center justify-center rounded-full bg-accent text-[8px] font-black text-white ring-2 ring-card group-hover:ring-muted transition-all">
            {{ $badge }}
        </span>
        @endif
    </div>
    <span x-show="sidebarOpen" x-transition class="font-bold whitespace-nowrap flex-1">{{ $label }}</span>
</a>
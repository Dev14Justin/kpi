@props(['href', 'active', 'icon', 'label'])

<a href="{{ $href }}" wire:navigate
    class="group flex items-center gap-3 px-3 py-2 rounded-xl transition-all {{ $active ? 'bg-primary/10 dark:bg-[#282828] text-primary shadow-sm' : 'text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-white hover:bg-gray-100 dark:hover:bg-white/5' }}">
    <svg class="w-5 h-5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="{{ $icon }}"></path>
    </svg>
    <span x-show="sidebarOpen" x-transition class="font-bold whitespace-nowrap">{{ $label }}</span>
</a>
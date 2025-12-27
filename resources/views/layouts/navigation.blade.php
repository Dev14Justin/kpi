<nav x-data="{ open: false }" class="sticky top-0 z-50 bg-card border-b border-border shadow-sm transition-colors duration-300">
    <!-- Primary Navigation Menu -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16 items-center relative">
            <div class="flex shrink-0 items-center">
                <!-- Logo -->
                <a href="{{ route('influencers.index') }}" wire:navigate>
                    <div class="flex items-center gap-2">
                        <div class="h-9 w-9 rounded-xl bg-primary flex items-center justify-center font-black text-primary-foreground">K</div>
                        <span class="text-base font-semibold text-foreground hidden sm:inline">KpiHub</span>
                    </div>
                </a>
            </div>

            <!-- Navigation Links (Icons only on mobile) -->
            <div class="flex items-center absolute left-1/2 top-1/2 -translate-x-1/2 -translate-y-1/2 space-x-5 md:space-x-8">
                <x-nav-link :href="route('influencers.index')" :active="request()->routeIs('influencers.index')" wire:navigate class="gap-2 px-2 sm:px-1">
                    <svg class="w-5 h-5 md:w-4 md:h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
                    </svg>
                    <span class="hidden md:inline">{{ __('Influenceurs') }}</span>
                </x-nav-link>
                <x-nav-link :href="route('ranking.index')" :active="request()->routeIs('ranking.index')" wire:navigate class="gap-2 px-2 sm:px-1">
                    <svg class="w-5 h-5 md:w-4 md:h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4M7.835 4.697a3.42 3.42 0 001.946-1.947m1.218 0a3.42 3.42 0 001.946 1.947m1.218 0a3.42 3.42 0 001.946-1.947m1.218 0a3.42 3.42 0 001.946-1.947m1.218 0a3.42 3.42 0 001.946-1.947m1.218 0a3.42 3.42 0 001.946-1.947M12 2v2m0 16v2m-8-8H2m20 0h-2m-2.05-4.95l-1.41 1.41M5.46 18.54l-1.41 1.41M18.54 18.54l1.41-1.41M5.46 5.46l1.41-1.41" />
                    </svg>
                    <span class="hidden md:inline">{{ __('Classement') }}</span>
                </x-nav-link>
                <x-nav-link :href="route('enterprises.index')" :active="request()->routeIs('enterprises.index')" wire:navigate class="gap-2 px-2 sm:px-1">
                    <svg class="w-5 h-5 md:w-4 md:h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
                    </svg>
                    <span class="hidden md:inline">{{ __('Entreprises') }}</span>
                </x-nav-link>
            </div>

            <!-- User Dropdown & Theme Toggle (Always visible) -->
            <div class="flex items-center gap-2 sm:gap-3">
                <x-theme-toggle />

                <x-dropdown align="right" width="48">
                    <x-slot name="trigger">
                        <button class="inline-flex items-center gap-2.5 px-1 sm:px-3 py-1.5 border border-transparent text-sm leading-4 font-medium rounded-xl text-muted-foreground bg-transparent hover:text-foreground hover:bg-muted/50 focus:outline-none transition ease-in-out duration-150">
                            <div class="flex-shrink-0 relative">
                                @if(Auth::user()->profile_photo_path)
                                <img src="{{ asset('storage/' . Auth::user()->profile_photo_path) }}" alt="{{ Auth::user()->name }}" class="w-8 h-8 rounded-full object-cover border border-border shadow-sm">
                                @else
                                <div class="w-8 h-8 rounded-full bg-accent flex items-center justify-center text-white text-[10px] font-black border border-border shadow-sm">
                                    {{ substr(Auth::user()->name ?? 'U', 0, 1) }}
                                </div>
                                @endif
                                <div class="absolute -bottom-0.5 -right-0.5 bg-green-500 w-2.5 h-2.5 rounded-full border-2 border-card"></div>
                            </div>

                            <div class="ms-0.5 opacity-50">
                                <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                </svg>
                            </div>
                        </button>
                    </x-slot>

                    <x-slot name="content">
                        <x-dropdown-link :href="route('dashboard')" wire:navigate>
                            {{ __('Mon Espace') }}
                        </x-dropdown-link>

                        <x-dropdown-link :href="route('profile.edit')" wire:navigate>
                            {{ __('Profile') }}
                        </x-dropdown-link>

                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <x-dropdown-link :href="route('logout')"
                                onclick="event.preventDefault();
                                                this.closest('form').submit();">
                                {{ __('Se déconnecter') }}
                            </x-dropdown-link>
                        </form>
                    </x-slot>
                </x-dropdown>
            </div>
        </div>
    </div>


</nav>
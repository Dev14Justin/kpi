<nav x-data="{ open: false }" class="sticky top-0 z-50 bg-white dark:bg-[#1C1C1C] border-b border-gray-100 dark:border-white/5 shadow-sm transition-colors duration-300">
    <!-- Primary Navigation Menu -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16 items-center relative">
            <div class="flex shrink-0 items-center">
                <!-- Logo -->
                <a href="{{ route('influencers.index') }}">
                    <div class="flex items-center gap-2">
                        <div class="h-9 w-9 rounded-xl bg-[var(--kpihub-primary)] flex items-center justify-center font-black text-[var(--kpihub-ink)]">K</div>
                        <span class="text-base font-semibold text-[var(--kpihub-ink)] dark:text-white hidden sm:inline">KpiHub</span>
                    </div>
                </a>
            </div>

            <!-- Centered Navigation Links -->
            <div class="hidden sm:flex absolute left-1/2 top-1/2 -translate-x-1/2 -translate-y-1/2 space-x-8">
                <x-nav-link :href="route('influencers.index')" :active="request()->routeIs('influencers.index')">
                    {{ __('Influenceurs') }}
                </x-nav-link>
                <x-nav-link :href="route('ranking.index')" :active="request()->routeIs('ranking.index')">
                    {{ __('Classement') }}
                </x-nav-link>
                <x-nav-link :href="route('enterprises.index')" :active="request()->routeIs('enterprises.index')">
                    {{ __('Entreprises') }}
                </x-nav-link>
            </div>

            <!-- Settings Dropdown -->
            <div class="hidden sm:flex sm:items-center sm:ms-6 gap-3">
                <x-theme-toggle />

                <x-dropdown align="right" width="48">
                    <x-slot name="trigger">
                        <button class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-lg text-gray-500 dark:text-gray-300 bg-white dark:bg-transparent hover:text-[var(--kpihub-ink)] dark:hover:text-white focus:outline-none transition ease-in-out duration-150">
                            <div>{{ Auth::user()->name }}</div>

                            <div class="ms-1">
                                <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                </svg>
                            </div>
                        </button>
                    </x-slot>

                    <x-slot name="content">
                        {{-- Link to Personal Dashboard/Profile Area --}}
                        <x-dropdown-link :href="route('dashboard')">
                            {{ __('Mon Espace') }}
                        </x-dropdown-link>

                        <x-dropdown-link :href="route('profile.edit')">
                            {{ __('Profile') }}
                        </x-dropdown-link>

                        <!-- Authentication -->
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

            <!-- Hamburger -->
            <div class="-me-2 flex items-center sm:hidden">
                <button @click="open = ! open" class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 dark:text-gray-500 hover:text-[var(--kpihub-ink)] dark:hover:text-white hover:bg-gray-100 dark:hover:bg-white/5 focus:outline-none transition duration-150 ease-in-out">
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{'hidden': open, 'inline-flex': ! open }" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{'hidden': ! open, 'inline-flex': open }" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Responsive Navigation Menu -->
    <div :class="{'block': open, 'hidden': ! open}" class="hidden sm:hidden bg-white dark:bg-[#1C1C1C] border-b border-gray-100 dark:border-white/5">
        <div class="pt-2 pb-3 space-y-1">
            <x-responsive-nav-link :href="route('influencers.index')" :active="request()->routeIs('influencers.index')">
                {{ __('Influenceurs') }}
            </x-responsive-nav-link>
            <x-responsive-nav-link :href="route('ranking.index')" :active="request()->routeIs('ranking.index')">
                {{ __('Classement') }}
            </x-responsive-nav-link>
            <x-responsive-nav-link :href="route('enterprises.index')" :active="request()->routeIs('enterprises.index')">
                {{ __('Entreprises') }}
            </x-responsive-nav-link>
            <x-responsive-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')">
                {{ __('Mon Espace') }}
            </x-responsive-nav-link>
        </div>

        <!-- Responsive Settings Options -->
        <div class="pt-4 pb-1 border-t border-gray-200 dark:border-white/10">
            <div class="px-4">
                <div class="font-medium text-base text-[var(--kpihub-ink)] dark:text-white">{{ Auth::user()->name }}</div>
                <div class="font-medium text-sm text-gray-500 dark:text-gray-400">{{ Auth::user()->email }}</div>
            </div>

            <div class="mt-3 space-y-1">
                <x-responsive-nav-link :href="route('profile.edit')">
                    {{ __('Profile') }}
                </x-responsive-nav-link>

                <!-- Authentication -->
                <form method="POST" action="{{ route('logout') }}">
                    @csrf

                    <x-responsive-nav-link :href="route('logout')"
                        onclick="event.preventDefault();
                                        this.closest('form').submit();">
                        {{ __('Se déconnecter') }}
                    </x-responsive-nav-link>
                </form>
            </div>
        </div>
    </div>
</nav>
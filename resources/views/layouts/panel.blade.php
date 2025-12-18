<x-app-layout :hideFooter="true">
    <div class="flex min-h-screen" x-data="{ sidebarOpen: true, mobileSidebarOpen: false }">
        <!-- Mobile Sidebar Overlay -->
        <div x-show="mobileSidebarOpen"
            @click="mobileSidebarOpen = false"
            x-transition:enter="transition-opacity ease-linear duration-300"
            x-transition:enter-start="opacity-0"
            x-transition:enter-end="opacity-100"
            x-transition:leave="transition-opacity ease-linear duration-300"
            x-transition:leave-start="opacity-100"
            x-transition:leave-end="opacity-0"
            class="fixed inset-0 bg-black/50 z-40 lg:hidden"></div>

        <!-- Sidebar Desktop -->
        <aside :class="sidebarOpen ? 'w-64' : 'w-20'"
            class="fixed inset-y-0 left-0 top-16 z-30 bg-white dark:bg-[#1C1C1C] border-r border-gray-200 dark:border-white/5 transition-all duration-300 ease-in-out hidden lg:flex flex-col">

            <!-- Sidebar Header -->
            <div class="h-14 flex items-center justify-between px-3 border-b border-gray-200 dark:border-white/5">
                <div x-show="sidebarOpen" x-transition class="flex items-center gap-3 px-4 text-gray-500 dark:text-gray-400">
                    <svg class="w-5 h-5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
                    </svg>
                    <span class="text-[10px] font-bold uppercase tracking-widest">Menu</span>
                </div>
                <button @click="sidebarOpen = !sidebarOpen"
                    class="p-2 rounded-lg hover:bg-gray-100 dark:hover:bg-white/5 text-gray-500 dark:text-gray-400 transition">
                    <!-- Custom Toggle Icon from Image -->
                    <svg class="w-6 h-6 rotate-180" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <rect x="3" y="4" width="18" height="16" rx="3" stroke="currentColor" stroke-width="2" />
                        <path d="M9 4V20" stroke="currentColor" stroke-width="2" />
                    </svg>
                </button>
            </div>

            <!-- Menu -->
            <nav class="flex-1 px-3 py-4 space-y-0.5 overflow-y-auto">
                <x-sidebar-link href="{{ route('dashboard') }}" :active="request()->routeIs('dashboard')" icon="m4 6 2-2h2a2 2 0 0 1 2 2v2a2 2 0 0 1-2 2h-2a2 2 0 0 1-2-2zm10 0 2-2h2a2 2 0 0 1 2 2v2a2 2 0 0 1-2 2h-2a2 2 0 0 1-2-2zm-10 10 2-2h2a2 2 0 0 1 2 2v2a2 2 0 0 1-2 2h-2a2 2 0 0 1-2-2zm10 0 2-2h2a2 2 0 0 1 2 2v2a2 2 0 0 1-2 2h-2a2 2 0 0 1-2-2z" label="Tableau de bord" />
                <x-sidebar-link href="{{ route('campaigns.index') }}" :active="request()->routeIs('campaigns.*')" icon="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z" label="Mes Campagnes" />
                <x-sidebar-link href="{{ route('discussions.index') }}" :active="request()->routeIs('discussions.*')" icon="M8 10h.01M12 10h.01M16 10h.01M9 16H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-5l-5 5v-5z" label="Discussion" />
                <x-sidebar-link href="{{ route('profile.public', Auth::user()) }}" :active="request()->routeIs('profile.public')" icon="M15 12a3 3 0 11-6 0 3 3 0 016 0z M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" label="Voir mon profil public" />
                <x-sidebar-link href="{{ route('portfolio.index') }}" :active="request()->routeIs('portfolio.*')" icon="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10" label="Mon Portfolio" />
                <x-sidebar-link href="{{ route('settings.index') }}" :active="request()->routeIs('settings.*')" icon="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z M15 12a3 3 0 11-6 0 3 3 0 016 0z" label="Paramètres" />
            </nav>

            <!-- User Section -->
            <div class="p-3 border-t border-gray-200 dark:border-white/5 space-y-3" x-show="sidebarOpen" x-transition>
                <a href="{{ route('profile.show') }}"
                    class="flex items-center justify-center gap-2 w-full py-2 px-4 text-center text-xs border border-gray-200 dark:border-white/10 rounded-xl text-gray-700 dark:text-gray-300 hover:text-primary hover:border-primary transition font-bold bg-white dark:bg-[#282828] shadow-sm">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                    </svg>
                    Mon Profil
                </a>

                <div class="flex items-center gap-3 p-2 rounded-2xl bg-gray-50 dark:bg-[#282828] border border-gray-100 dark:border-white/5">
                    @if(Auth::user()->profile_photo_path)
                    <img src="{{ asset('storage/' . Auth::user()->profile_photo_path) }}" alt="Photo" class="w-9 h-9 rounded-xl object-cover flex-shrink-0">
                    @else
                    <div class="w-9 h-9 rounded-xl bg-accent flex items-center justify-center text-white text-xs font-bold flex-shrink-0">
                        {{ substr(Auth::user()->first_name ?? Auth::user()->name ?? 'U', 0, 1) }}
                    </div>
                    @endif
                    <div class="flex-1 min-w-0">
                        <p class="text-xs font-bold text-gray-900 dark:text-white truncate">{{ Auth::user()->first_name }} {{ Auth::user()->last_name }}</p>
                        <p class="text-[10px] text-gray-500 dark:text-gray-400 truncate opacity-70">{{ Auth::user()->email }}</p>
                    </div>
                </div>

                <!-- Logout -->
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="flex items-center gap-2 w-full px-3 py-2 text-sm text-red-500 hover:bg-red-50 dark:hover:bg-red-500/10 rounded-xl transition font-bold">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path>
                        </svg>
                        Se déconnecter
                    </button>
                </form>
            </div>
        </aside>

        <!-- Mobile Sidebar -->
        <aside x-show="mobileSidebarOpen"
            x-transition:enter="transition ease-out duration-300"
            x-transition:enter-start="-translate-x-full"
            x-transition:enter-end="translate-x-0"
            x-transition:leave="transition ease-in duration-300"
            x-transition:leave-start="translate-x-0"
            x-transition:leave-end="-translate-x-full"
            class="fixed inset-y-0 left-0 top-16 z-50 w-64 bg-white dark:bg-[#1C1C1C] border-r border-gray-200 dark:border-white/5 lg:hidden flex flex-col">

            <!-- Menu Mobile -->
            <nav class="flex-1 px-4 py-4 space-y-0.5 overflow-y-auto">
                <x-sidebar-link href="{{ route('dashboard') }}" :active="request()->routeIs('dashboard')" icon="m4 6 2-2h2a2 2 0 0 1 2 2v2a2 2 0 0 1-2 2h-2a2 2 0 0 1-2-2zm10 0 2-2h2a2 2 0 0 1 2 2v2a2 2 0 0 1-2 2h-2a2 2 0 0 1-2-2zm-10 10 2-2h2a2 2 0 0 1 2 2v2a2 2 0 0 1-2 2h-2a2 2 0 0 1-2-2zm10 0 2-2h2a2 2 0 0 1 2 2v2a2 2 0 0 1-2 2h-2a2 2 0 0 1-2-2z" label="Tableau de bord" />
                <x-sidebar-link href="{{ route('campaigns.index') }}" :active="request()->routeIs('campaigns.*')" icon="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z" label="Mes Campagnes" />
                <x-sidebar-link href="{{ route('discussions.index') }}" :active="request()->routeIs('discussions.*')" icon="M8 10h.01M12 10h.01M16 10h.01M9 16H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-5l-5 5v-5z" label="Discussion" />
                <x-sidebar-link href="{{ route('profile.public', Auth::user()) }}" :active="request()->routeIs('profile.public')" icon="M15 12a3 3 0 11-6 0 3 3 0 016 0z M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" label="Voir mon profil public" />
                <x-sidebar-link href="{{ route('portfolio.index') }}" :active="request()->routeIs('portfolio.*')" icon="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10" label="Mon Portfolio" />
                <x-sidebar-link href="{{ route('settings.index') }}" :active="request()->routeIs('settings.*')" icon="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z M15 12a3 3 0 11-6 0 3 3 0 016 0z" label="Paramètres" />
            </nav>

            <!-- User Section Mobile -->
            <div class="p-4 border-t border-gray-200 dark:border-white/5 space-y-3">
                <a href="{{ route('profile.show') }}"
                    class="block w-full py-2 px-4 text-center text-xs border border-gray-200 dark:border-white/10 rounded-xl text-gray-700 dark:text-gray-300 font-bold bg-white dark:bg-[#282828] shadow-sm">
                    Mon Profil
                </a>

                <div class="flex items-center gap-3 p-2 rounded-2xl bg-gray-50 dark:bg-[#282828] border border-gray-100 dark:border-white/5">
                    @if(Auth::user()->profile_photo_path)
                    <img src="{{ asset('storage/' . Auth::user()->profile_photo_path) }}" alt="Photo" class="w-9 h-9 rounded-xl object-cover flex-shrink-0">
                    @else
                    <div class="w-9 h-9 rounded-xl bg-accent flex items-center justify-center text-white text-xs font-bold flex-shrink-0">
                        {{ substr(Auth::user()->first_name ?? Auth::user()->name ?? 'U', 0, 1) }}
                    </div>
                    @endif
                    <div class="flex-1 min-w-0">
                        <p class="text-xs font-bold text-gray-900 dark:text-white truncate">{{ Auth::user()->first_name }} {{ Auth::user()->last_name }}</p>
                        <p class="text-[10px] text-gray-500 font-medium truncate opacity-70">{{ Auth::user()->email }}</p>
                    </div>
                </div>

                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="flex items-center gap-2 w-full px-3 py-2 text-sm text-red-500 hover:bg-red-50 dark:hover:bg-red-500/10 rounded-xl transition font-bold">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path>
                        </svg>
                        Se déconnecter
                    </button>
                </form>
            </div>
        </aside>

        <!-- Main Content Wrapper -->
        <div :class="sidebarOpen ? 'lg:ml-64' : 'lg:ml-20'" class="flex-1 transition-all duration-300">
            <!-- Mobile Menu Button (visible only on mobile) -->
            <div class="lg:hidden sticky top-16 z-20 bg-white dark:bg-[#1C1C1C] border-b border-gray-200 dark:border-white/5 px-4 py-3">
                <button @click="mobileSidebarOpen = true" class="p-2 rounded-lg hover:bg-gray-100 dark:hover:bg-white/5">
                    <svg class="w-6 h-6 text-gray-600 dark:text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
                    </svg>
                </button>
            </div>

            <!-- Page Content -->
            <main class="p-4 lg:p-8">
                {{ $slot }}
            </main>

            @include('layouts.footer')
        </div>
    </div>
</x-app-layout>
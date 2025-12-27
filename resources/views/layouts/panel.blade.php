<x-app-layout :hide-footer="true">
    <div class="flex min-h-screen" x-data="{ sidebarOpen: true }">
        <!-- Sidebar Desktop -->
        <aside :class="sidebarOpen ? 'w-64' : 'w-20'"
            class="fixed inset-y-0 left-0 top-16 z-30 bg-card border-r border-border transition-all duration-300 ease-in-out hidden lg:flex flex-col">

            <!-- Sidebar Header -->
            <div class="h-14 flex items-center justify-between px-3 border-b border-border">
                <div x-show="sidebarOpen" x-transition class="flex items-center gap-3 px-4 text-muted-foreground">
                    <span class="text-[18px] font-bold text-foreground tracking-widest">Dashboard</span>
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
                <x-sidebar-link href="{{ route('campaigns.index') }}" :active="request()->routeIs('campaigns.*')" icon="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z" label="Mes Campagnes" :badge="Auth::user()->pending_invitations_count > 0 ? Auth::user()->pending_invitations_count : null" />
                <x-sidebar-link href="{{ route('discussions.index') }}" :active="request()->routeIs('discussions.*')" icon="M8 10h.01M12 10h.01M16 10h.01M9 16H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-5l-5 5v-5z" label="Discussion" />
                <x-sidebar-link href="{{ route('profile.public', Auth::user()) }}" :active="request()->routeIs('profile.public')" icon="M15 12a3 3 0 11-6 0 3 3 0 016 0z M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" label="Voir mon profil public" />
                @if(Auth::user()->role === \App\Enums\UserRole::User || Auth::user()->role === \App\Enums\UserRole::Influencer)
                <x-sidebar-link href="{{ route('portfolio.index') }}" :active="request()->routeIs('portfolio.*')" icon="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10" label="Mon Portfolio" />
                @endif

                @if(Auth::user()->role === \App\Enums\UserRole::User || Auth::user()->role === \App\Enums\UserRole::Enterprise)
                <x-sidebar-link href="{{ route('professional-tools.index') }}" :active="request()->routeIs('professional-tools.*')" icon="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745V20a2 2 0 002 2h14a2 2 0 002-2v-6.745zM3.17 6.755A9.946 9.946 0 0112 5a9.946 9.946 0 018.83 1.755l.271.271A2 2 0 0121.5 8.443V11a2 2 0 01-2 2H4.5a2 2 0 01-2-2V8.442a2 2 0 01.4-.917l.27-.27zM12 10a1 1 0 011 1v2a1 1 0 01-2 0v-2a1 1 0 011-1z" label="Outils professionnel" />
                @endif
            </nav>

            <!-- User Section -->
            <div class="p-3 border-t border-border space-y-3" x-show="sidebarOpen" x-transition>
                <a href="{{ route('profile.show') }}" wire:navigate
                    class="btn-secondary w-full py-2 px-4 shadow-sm">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                    </svg>
                    Mon Profil
                </a>

                <div class="flex items-center gap-3 p-2 rounded-2xl bg-background border border-border">
                    @if(Auth::user()->profile_photo_path)
                    <img src="{{ asset('storage/' . Auth::user()->profile_photo_path) }}" alt="Photo" class="w-9 h-9 rounded-xl object-cover flex-shrink-0">
                    @else
                    <div class="w-9 h-9 rounded-xl bg-accent flex items-center justify-center text-white text-xs font-bold flex-shrink-0">
                        {{ substr(Auth::user()->first_name ?? Auth::user()->name ?? 'U', 0, 1) }}
                    </div>
                    @endif
                    <div class="flex-1 min-w-0">
                        <p class="text-xs font-bold text-foreground truncate">{{ Auth::user()->first_name }} {{ Auth::user()->last_name }}</p>
                        <p class="text-[10px] text-muted-foreground truncate opacity-70">{{ Auth::user()->email }}</p>
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

        <!-- Mobile Horizontal Sub-Navbar -->
        <div class="lg:hidden fixed top-16 left-0 right-0 z-40 bg-card border-b border-border">
            <div class="flex items-center justify-around h-14 px-2">
                <a href="{{ route('dashboard') }}" class="p-2 rounded-lg {{ request()->routeIs('dashboard') ? 'text-primary bg-primary/10' : 'text-muted-foreground' }}">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m4 6 2-2h2a2 2 0 0 1 2 2v2a2 2 0 0 1-2 2h-2a2 2 0 0 1-2-2zm10 0 2-2h2a2 2 0 0 1 2 2v2a2 2 0 0 1-2 2h-2a2 2 0 0 1-2-2zm-10 10 2-2h2a2 2 0 0 1 2 2v2a2 2 0 0 1-2 2h-2a2 2 0 0 1-2-2zm10 0 2-2h2a2 2 0 0 1 2 2v2a2 2 0 0 1-2 2h-2a2 2 0 0 1-2-2z" />
                    </svg>
                </a>
                <a href="{{ route('campaigns.index') }}" class="p-2 rounded-lg relative {{ request()->routeIs('campaigns.*') ? 'text-primary bg-primary/10' : 'text-muted-foreground' }}">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z" />
                    </svg>
                    @if(Auth::user()->pending_invitations_count > 0)
                    <span class="absolute top-1 right-1 w-2 h-2 bg-red-500 rounded-full"></span>
                    @endif
                </a>
                <a href="{{ route('discussions.index') }}" class="p-2 rounded-lg {{ request()->routeIs('discussions.*') ? 'text-primary bg-primary/10' : 'text-muted-foreground' }}">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 10h.01M12 10h.01M16 10h.01M9 16H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-5l-5 5v-5z" />
                    </svg>
                </a>
                <a href="{{ route('profile.public', Auth::user()) }}" class="p-2 rounded-lg {{ request()->routeIs('profile.public') ? 'text-primary bg-primary/10' : 'text-muted-foreground' }}">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                    </svg>
                </a>
                @if(Auth::user()->role === \App\Enums\UserRole::User || Auth::user()->role === \App\Enums\UserRole::Influencer)
                <a href="{{ route('portfolio.index') }}" class="p-2 rounded-lg {{ request()->routeIs('portfolio.*') ? 'text-primary bg-primary/10' : 'text-muted-foreground' }}">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10" />
                    </svg>
                </a>
                @endif
                @if(Auth::user()->role === \App\Enums\UserRole::User || Auth::user()->role === \App\Enums\UserRole::Enterprise)
                <a href="{{ route('professional-tools.index') }}" class="p-2 rounded-lg {{ request()->routeIs('professional-tools.index') ? 'text-primary bg-primary/10' : 'text-muted-foreground' }}">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745V20a2 2 0 002 2h14a2 2 0 002-2v-6.745zM3.17 6.755A9.946 9.946 0 0112 5a9.946 9.946 0 018.83 1.755l.271.271A2 2 0 0121.5 8.443V11a2 2 0 01-2 2H4.5a2 2 0 01-2-2V8.442a2 2 0 01.4-.917l.27-.27zM12 10a1 1 0 011 1v2a1 1 0 01-2 0v-2a1 1 0 011-1z" />
                    </svg>
                </a>
                @endif
            </div>
        </div>

        <!-- Main Content Wrapper -->
        <div :class="sidebarOpen ? 'lg:ml-64' : 'lg:ml-20'" class="flex-1 transition-all duration-300 pt-14 lg:pt-0">
            <!-- Page Content -->
            <main class="p-4 lg:p-8">
                {{ $slot }}
            </main>

            @include('layouts.footer')
        </div>
    </div>
</x-app-layout>
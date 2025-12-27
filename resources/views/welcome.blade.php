<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="dark">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ config('app.name', 'KpiHub') }}</title>
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600,700,800&display=swap" rel="stylesheet" />
    <script>
        // Default to dark mode if no preference is saved
        if (localStorage.theme === 'dark' || (!('theme' in localStorage) && window.matchMedia('(prefers-color-scheme: dark)').matches)) {
            document.documentElement.classList.add('dark')
        } else {
            document.documentElement.classList.remove('dark')
        }
    </script>
    @livewireStyles
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-background text-foreground font-sans antialiased selection:bg-primary selection:text-primary-foreground overflow-x-hidden">
    <!-- Navbar -->
    <nav class="fixed w-full top-0 z-50 backdrop-blur-md bg-card/70 shadow-sm transition-colors duration-300">
        <div class="max-w-7xl mx-auto px-6 lg:px-8">
            <div class="flex items-center justify-between h-20">
                <!-- Logo -->
                <div class="flex-shrink-0 flex items-center gap-2">
                    <span class="text-2xl font-black tracking-tighter text-foreground">
                        <span class="text-primary">Kpi</span>Hub
                    </span>
                </div>

                <!-- Desktop Menu -->
                <div class="hidden md:flex items-center gap-8">
                    <a href="#features" class="text-sm font-medium text-muted-foreground hover:text-primary transition">Fonctionnalités</a>
                    <a href="#influencers" class="text-sm font-medium text-muted-foreground hover:text-primary transition">Pour les Influenceurs</a>
                    <a href="#brands" class="text-sm font-medium text-muted-foreground hover:text-primary transition">Pour les Entreprises</a>
                </div>

                <!-- CTA & Toggle -->
                <div class="hidden md:flex items-center gap-4">
                    <x-theme-toggle />
                    @auth
                    <a href="{{ url('/influencers') }}" wire:navigate class="btn-primary">Connexion</a>
                    @else
                    <a href="{{ route('login') }}" wire:navigate class="text-sm font-medium text-muted-foreground hover:text-primary transition">Connexion</a>
                    <a href="{{ route('register') }}" wire:navigate class="btn-primary shadow-[0_0_20px_rgba(var(--primary),0.3)] transition duration-300">Créer un compte</a>
                    @endauth
                </div>

                <!-- Mobile Navigation (Compact) -->
                <div class="md:hidden flex items-center gap-2">
                    <x-theme-toggle />
                    @auth
                    <a href="{{ url('/influencers') }}" wire:navigate class="px-4 py-2 bg-primary text-primary-foreground text-xs font-bold rounded-xl shadow-lg shadow-primary/20">
                        Tableau de bord
                    </a>
                    @else
                    <a href="{{ route('login') }}" wire:navigate class="px-4 py-2 border border-border text-foreground text-xs font-bold rounded-xl hover:bg-muted transition">
                        Connexion
                    </a>
                    @endauth
                </div>
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <div class="relative pt-32 pb-20 lg:pt-48 lg:pb-32 overflow-hidden bg-[radial-gradient(ellipse_at_top,_var(--tw-gradient-stops))] from-primary/20 via-background to-background">
        <!-- Background Glows -->
        <div class="absolute top-0 left-1/2 -translate-x-1/2 w-full max-w-7xl h-[600px] bg-gradient-to-b from-primary/10 via-accent/5 to-transparent rounded-full blur-[120px] -z-10 opacity-60 pointer-events-none"></div>
        <div class="absolute -top-24 -left-24 w-96 h-96 bg-primary/20 rounded-full blur-[100px] -z-10 opacity-40 animate-pulse"></div>
        <div class="absolute top-1/2 -right-24 w-80 h-80 bg-accent/20 rounded-full blur-[100px] -z-10 opacity-40 animate-pulse" style="animation-delay: 2s"></div>

        <div class="max-w-7xl mx-auto px-6 lg:px-8 text-center" x-data="{ show: false }" x-init="setTimeout(() => show = true, 100)">
            <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full border border-primary/30 bg-primary/10 text-primary text-xs font-semibold tracking-wide uppercase mb-8 backdrop-blur-sm"
                x-show="show" x-transition:enter="transition ease-out duration-700 delay-100" x-transition:enter-start="opacity-0 translate-y-4" x-transition:enter-end="opacity-100 translate-y-0">
                <span class="w-2 h-2 rounded-full bg-primary animate-pulse"></span>
                La plateforme #1 pour l'UGC et l'Influence
            </div>

            <h1 class="text-4xl sm:text-5xl lg:text-7xl font-extrabold tracking-tight text-title mb-6 leading-[1.1]"
                x-show="show" x-transition:enter="transition ease-out duration-700 delay-200" x-transition:enter-start="opacity-0 translate-y-4" x-transition:enter-end="opacity-100 translate-y-0">
                Gerez vos KPIs <br class="hidden sm:block" />
                Décrochez des <span class="text-primary drop-shadow-sm">Contrats</span>.
            </h1>

            <p class="mt-6 text-lg text-muted-foreground max-w-2xl mx-auto leading-relaxed"
                x-show="show" x-transition:enter="transition ease-out duration-700 delay-300" x-transition:enter-start="opacity-0 translate-y-4" x-transition:enter-end="opacity-100 translate-y-0">
                Créez un portfolio professionnel, suivez vos statistiques en temps réel et connectez-vous avec les meilleures marques. Tout au même endroit.
            </p>

            <div class="mt-12 flex flex-col sm:flex-row items-center justify-center gap-5 px-4"
                x-show="show" x-transition:enter="transition ease-out duration-700 delay-400" x-transition:enter-start="opacity-0 translate-y-4" x-transition:enter-end="opacity-100 translate-y-0">
                <a href="{{ route('register') }}" wire:navigate class="w-full sm:w-auto min-w-[200px] px-8 py-4 bg-primary text-primary-foreground font-black rounded-2xl transition-all duration-300 transform hover:scale-105 shadow-xl shadow-primary/20 flex items-center justify-center gap-2 group">
                    Créer mon Portfolio
                    <svg class="w-5 h-5 transition-transform group-hover:translate-x-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M17 8l4 4m0 0l-4 4m4-4H3"></path>
                    </svg>
                </a>
                <a href="#" class="w-full sm:w-auto min-w-[200px] px-8 py-4 bg-card/50 backdrop-blur-md border border-border text-foreground font-bold rounded-2xl transition-all hover:bg-muted/50 hover:border-primary/30 flex items-center justify-center">
                    Voir la démo
                </a>
            </div>

            <!-- Dashboard Preview Mockup -->
            <div class="mt-20 relative mx-auto max-w-5xl"
                x-show="show" x-transition:enter="transition ease-out duration-1000 delay-500" x-transition:enter-start="opacity-0 translate-y-12" x-transition:enter-end="opacity-100 translate-y-0">
                <!-- Border Gradient -->
                <div class="absolute -inset-1 bg-gradient-to-r from-primary/30 to-accent/30 rounded-2xl blur-lg opacity-40"></div>
                <!-- Card Glow -->
                <div class="absolute inset-0 bg-gradient-to-tr from-primary/10 to-accent/5 rounded-2xl pointer-events-none"></div>

                <div class="relative bg-background border border-border rounded-2xl shadow-2xl overflow-hidden aspect-[16/9] flex items-center justify-center group">
                    <!-- Top Bar Decoration -->
                    <div class="absolute top-0 left-0 right-0 h-12 bg-muted border-b border-border flex items-center px-4 gap-2">
                        <div class="w-3 h-3 rounded-full bg-red-400"></div>
                        <div class="w-3 h-3 rounded-full bg-yellow-400"></div>
                        <div class="w-3 h-3 rounded-full bg-primary/60"></div>
                    </div>

                    <!-- Placeholder Content -->
                    <div class="text-center group-hover:scale-105 transition-transform duration-700 ease-out z-10">
                        <img src="{{ Vite::asset('resources/images/dashboard.png') }}" alt="Dashboard" class="w-full h-full object-cover">
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Stats / Logos Section -->
    <div class="py-12 border-y border-border bg-muted/50 backdrop-blur-sm">
        <div class="max-w-7xl mx-auto px-6 lg:px-8">
            <p class="text-center text-sm font-semibold text-muted-foreground uppercase tracking-widest mb-8">Ils nous font confiance</p>
            <div class="flex flex-wrap justify-center items-center gap-8 md:gap-16">
                <!-- Fake Logos with improved visibility and hover -->
                <span class="text-xl font-bold text-muted-foreground hover:text-primary transition-colors cursor-default">BrandOne</span>
                <span class="text-xl font-bold text-muted-foreground hover:text-primary transition-colors cursor-default">AgenceX</span>
                <span class="text-xl font-bold text-muted-foreground hover:text-primary transition-colors cursor-default">StudioFlow</span>
                <span class="text-xl font-bold text-muted-foreground hover:text-primary transition-colors cursor-default">ViralLabs</span>
                <span class="text-xl font-bold text-muted-foreground hover:text-primary transition-colors cursor-default">CreatorHub</span>
            </div>
        </div>
    </div>

    <!-- Features Section -->
    <div class="py-24 bg-background" id="features">
        <div class="max-w-7xl mx-auto px-6 lg:px-8">
            <div class="text-center max-w-3xl mx-auto mb-20 animate-fade-in">
                <h2 class="text-3xl lg:text-5xl font-black text-title mb-6 tracking-tight">Pourquoi choisir KpiHub ?</h2>
                <p class="text-lg text-muted-foreground leading-relaxed">Des outils puissants conçus pour maximiser vos revenus et simplifier vos collaborations avec les meilleures marques du marché.</p>
            </div>

            <div class="grid md:grid-cols-3 gap-8">
                <!-- Feature 1 -->
                <div class="bg-card p-8 rounded-3xl border border-border hover:border-primary/50 hover:shadow-2xl hover:-translate-y-1 transition-all duration-300 group">
                    <div class="w-14 h-14 bg-muted rounded-2xl flex items-center justify-center mb-6 border border-border group-hover:bg-primary/10 group-hover:border-primary/20 transition-colors">
                        <svg class="h-7 w-7 text-primary" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M13.828 10.172a4 4 0 00-5.656 0l-4 4a4 4 0 105.656 5.656l1.102-1.101m-.758-4.899a4 4 0 005.656 0l4-4a4 4 0 00-5.656-5.656l-1.1 1.1" />
                        </svg>
                    </div>
                    <h3 class="text-xl font-bold text-title mb-3">Portfolio Public Unique</h3>
                    <p class="text-muted-foreground leading-relaxed text-sm">Générez automatiquement un site vitrine professionnel pour montrer vos meilleures campagnes aux marques.</p>
                </div>

                <!-- Feature 2 -->
                <div class="bg-card p-8 rounded-3xl border border-border hover:border-accent/50 hover:shadow-2xl hover:-translate-y-1 transition-all duration-300 group">
                    <div class="w-14 h-14 bg-muted rounded-2xl flex items-center justify-center mb-6 border border-border group-hover:bg-accent/10 group-hover:border-accent/20 transition-colors">
                        <svg class="h-7 w-7 text-accent" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 002 2h2a2 2 0 002-2z" />
                        </svg>
                    </div>
                    <h3 class="text-xl font-bold text-title mb-3">Analytics Centralisés</h3>
                    <p class="text-muted-foreground leading-relaxed text-sm">Ne perdez plus de temps sur Excel. Connectez Instagram, TikTok et YouTube pour voir vos statistiques unifiées en temps réel.</p>
                </div>

                <!-- Feature 3 -->
                <div class="bg-card p-8 rounded-3xl border border-border hover:border-blue-500/50 hover:shadow-2xl hover:-translate-y-1 transition-all duration-300 group">
                    <div class="w-14 h-14 bg-muted rounded-2xl flex items-center justify-center mb-6 border border-border group-hover:bg-blue-500/10 group-hover:border-blue-500/20 transition-colors">
                        <svg class="h-7 w-7 text-blue-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                    </div>
                    <h3 class="text-xl font-bold text-title mb-3">Générateur de Leads</h3>
                    <p class="text-muted-foreground leading-relaxed text-sm">Créez des formulaires personnalisés pour capturer les emails de votre communauté et monétisez votre audience efficacement.</p>
                </div>
            </div>
        </div>
    </div>

    <!-- CTA Section -->
    <div class="py-24 relative overflow-hidden">
        <div class="absolute inset-0 bg-primary/5 -z-10 bg-[radial-gradient(circle_at_center,_var(--tw-gradient-stops))] from-primary/10 via-transparent to-transparent"></div>
        <div class="max-w-4xl mx-auto px-6 lg:px-8 text-center">
            <h2 class="text-3xl sm:text-4xl lg:text-5xl font-black text-title mb-8 tracking-tight">Prêt à passer au niveau supérieur ?</h2>
            <p class="text-lg sm:text-xl text-muted-foreground mb-10 max-w-2xl mx-auto">Rejoignez plus de 5000 créateurs et marques qui utilisent KpiHub aujourd'hui pour piloter leur croissance.</p>
            <a href="{{ route('register') }}" wire:navigate class="inline-flex items-center gap-3 px-10 py-5 bg-primary text-primary-foreground font-black rounded-2xl transition-all hover:scale-105 shadow-2xl shadow-primary/30">
                Commencer maintenant gratuitement
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M13 7l5 5m0 0l-5 5m5-5H6" />
                </svg>
            </a>
        </div>
    </div>


    <!-- Footer -->
    @include('layouts.footer')

    @livewireScripts
</body>

</html>
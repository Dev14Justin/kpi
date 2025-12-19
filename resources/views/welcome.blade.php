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
        if (localStorage.theme === 'dark' || (!('theme' in localStorage) && window.matchMedia('(prefers-color-scheme: dark)').matches) || !('theme' in localStorage)) {
            document.documentElement.classList.add('dark')
        } else {
            document.documentElement.classList.remove('dark')
        }
    </script>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-background text-foreground font-sans antialiased selection:bg-primary selection:text-primary-foreground overflow-x-hidden">
    <!-- Navbar -->
    <nav x-data="{ open: false }" class="fixed w-full top-0 z-50 backdrop-blur-md bg-card/70 shadow-sm transition-colors duration-300">
        <div class="max-w-7xl mx-auto px-6 lg:px-8">
            <div class="flex items-center justify-between h-20">
                <!-- Logo -->
                <div class="flex-shrink-0 flex items-center gap-2">
                    <span class="text-2xl font-bold bg-clip-text text-transparent bg-gradient-to-r from-primary to-[#00a86b] dark:from-primary dark:to-[#00a86b]">KpiHub</span>
                </div>

                <!-- Desktop Menu -->
                <div class="hidden md:flex items-center gap-8">
                    <a href="#features" class="text-sm font-medium text-muted-foreground hover:text-primary transition">Fonctionnalités</a>
                    <a href="#influencers" class="text-sm font-medium text-muted-foreground hover:text-primary transition">Pour les Influenceurs</a>
                    <a href="#brands" class="text-sm font-medium text-muted-foreground hover:text-primary transition">Pour les Entreprises</a>
                </div>

                <!-- CTA & Toggle -->
                <div class="hidden md:flex items-center gap-4">
                    @auth
                    <a href="{{ url('/influencers') }}" wire:navigate class="btn-primary">Connexion</a>
                    @else
                    <a href="{{ route('login') }}" wire:navigate class="text-sm font-medium text-muted-foreground hover:text-primary transition">Connexion</a>
                    <a href="{{ route('register') }}" wire:navigate class="btn-primary shadow-[0_0_20px_rgba(var(--primary),0.3)] transition duration-300">Créer un compte</a>
                    @endauth
                    <x-theme-toggle />
                </div>

                <!-- Mobile menu button -->
                <div class="md:hidden flex items-center gap-4">
                    <x-theme-toggle />
                    <button @click="open = !open" class="text-gray-600 dark:text-gray-300 hover:text-primary dark:hover:text-white focus:outline-none">
                        <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        </svg>
                    </button>
                </div>
            </div>
        </div>

        <!-- Mobile Menu -->
        <div x-show="open"
            x-transition:enter="transition ease-out duration-200"
            x-transition:enter-start="opacity-0 -translate-y-2"
            x-transition:enter-end="opacity-100 translate-y-0"
            class="md:hidden bg-card border-b border-border absolute w-full">
            <div class="px-4 pt-2 pb-6 space-y-2">
                <a href="#features" class="block px-3 py-2 text-base font-medium text-muted-foreground hover:text-primary hover:bg-muted rounded-lg">Fonctionnalités</a>
                <a href="#influencers" class="block px-3 py-2 text-base font-medium text-muted-foreground hover:text-primary hover:bg-muted rounded-lg">Pour les Influenceurs</a>
                <a href="#" class="block px-3 py-2 text-base font-medium text-muted-foreground hover:text-primary hover:bg-muted rounded-lg">Pour les Entreprises</a>
                <div class="pt-4 border-t border-border mt-4">
                    <a href="{{ route('login') }}" wire:navigate class="block px-3 py-2 text-base font-medium text-muted-foreground hover:text-primary">Connexion</a>
                    <a href="{{ route('register') }}" wire:navigate class="block px-3 py-2 mt-2 text-base font-bold text-center bg-primary text-primary-foreground rounded-lg">Créer un compte</a>
                </div>
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <div class="relative pt-32 pb-20 lg:pt-48 lg:pb-32 overflow-hidden bg-[radial-gradient(ellipse_at_top,_var(--tw-gradient-stops))] from-primary/20 via-background to-background">
        <!-- Background Glows -->
        <div class="absolute top-0 left-1/2 -translate-x-1/2 w-[800px] h-[600px] bg-primary/20 rounded-full blur-[120px] -z-10 opacity-60 pointer-events-none"></div>

        <div class="max-w-7xl mx-auto px-6 lg:px-8 text-center" x-data="{ show: false }" x-init="setTimeout(() => show = true, 100)">
            <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full border border-primary/30 bg-primary/10 text-primary text-xs font-semibold tracking-wide uppercase mb-8 backdrop-blur-sm"
                x-show="show" x-transition:enter="transition ease-out duration-700 delay-100" x-transition:enter-start="opacity-0 translate-y-4" x-transition:enter-end="opacity-100 translate-y-0">
                <span class="w-2 h-2 rounded-full bg-primary animate-pulse"></span>
                La plateforme #1 pour l'UGC et l'Influence
            </div>

            <h1 class="text-5xl lg:text-7xl font-bold tracking-tight text-title mb-6 leading-tight"
                x-show="show" x-transition:enter="transition ease-out duration-700 delay-200" x-transition:enter-start="opacity-0 translate-y-4" x-transition:enter-end="opacity-100 translate-y-0">
                Gerez vos KPIs <br class="hidden lg:block" />
                Décrochez des <span class="bg-clip-text text-transparent bg-gradient-to-r from-primary to-accent">Contrats</span>.
            </h1>

            <p class="mt-6 text-lg text-muted-foreground max-w-2xl mx-auto leading-relaxed"
                x-show="show" x-transition:enter="transition ease-out duration-700 delay-300" x-transition:enter-start="opacity-0 translate-y-4" x-transition:enter-end="opacity-100 translate-y-0">
                Créez un portfolio professionnel, suivez vos statistiques en temps réel et connectez-vous avec les meilleures marques. Tout au même endroit.
            </p>

            <div class="mt-10 flex flex-col sm:flex-row items-center justify-center gap-4"
                x-show="show" x-transition:enter="transition ease-out duration-700 delay-400" x-transition:enter-start="opacity-0 translate-y-4" x-transition:enter-end="opacity-100 translate-y-0">
                <a href="{{ route('register') }}" wire:navigate class="w-full sm:w-auto px-8 py-4 bg-primary hover:opacity-90 text-primary-foreground font-bold rounded-xl transition-all duration-300 transform hover:scale-105 shadow-[0_0_20px_rgba(var(--primary),0.4)] flex items-center justify-center gap-2">
                    Créer mon Portfolio
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"></path>
                    </svg>
                </a>
                <a href="#" class="btn-secondary w-full sm:w-auto px-8 py-4">
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
                        <h3 class="text-2xl font-bold text-title mb-2">Interface Dashboard Simplifiée</h3>
                        <p class="text-muted-foreground">Analytics, Campagnes, et Portfolios</p>
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
            <div class="text-center max-w-3xl mx-auto mb-20">
                <h2 class="text-3xl lg:text-5xl font-bold text-title mb-6">Pourquoi choisir KpiHub ?</h2>
                <p class="text-lg text-muted-foreground">Des outils puissants conçus pour maximiser vos revenus et simplifier vos collaborations.</p>
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
                <div class="bg-white dark:bg-[#181818] p-8 rounded-3xl border border-gray-100 dark:border-white/5 hover:border-accent/50 hover:shadow-2xl hover:-translate-y-1 transition-all duration-300 group">
                    <div class="w-14 h-14 bg-gray-50 dark:bg-[#1C1C1C] rounded-2xl flex items-center justify-center mb-6 border border-gray-100 dark:border-white/5 group-hover:bg-accent/10 group-hover:border-accent/20 transition-colors">
                        <svg class="h-7 w-7 text-accent" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 002 2h2a2 2 0 002-2z" />
                        </svg>
                    </div>
                    <h3 class="text-xl font-bold text-ink dark:text-white mb-3">Analytics Centralisés</h3>
                    <p class="text-gray-600 dark:text-gray-400 leading-relaxed text-sm">Ne perdez plus de temps sur Excel. Connectez Instagram, TikTok et YouTube pour voir vos stats unifiées.</p>
                </div>

                <!-- Feature 3 -->
                <div class="bg-white dark:bg-[#181818] p-8 rounded-3xl border border-gray-100 dark:border-white/5 hover:border-blue-500/50 hover:shadow-2xl hover:-translate-y-1 transition-all duration-300 group">
                    <div class="w-14 h-14 bg-gray-50 dark:bg-[#1C1C1C] rounded-2xl flex items-center justify-center mb-6 border border-gray-100 dark:border-white/5 group-hover:bg-blue-500/10 group-hover:border-blue-500/20 transition-colors">
                        <svg class="h-7 w-7 text-blue-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                    </div>
                    <h3 class="text-xl font-bold text-ink dark:text-white mb-3">Générateur de Leads</h3>
                    <p class="text-gray-600 dark:text-gray-400 leading-relaxed text-sm">Créez des formulaires pour capturer les emails de votre communauté et monétisez votre audience.</p>
                </div>
            </div>
        </div>
    </div>

    <!-- CTA Section -->
    <div class="py-24 relative overflow-hidden">
        <div class="absolute inset-0 bg-primary/5 -z-10"></div>
        <div class="max-w-4xl mx-auto px-6 lg:px-8 text-center">
            <h2 class="text-4xl lg:text-5xl font-bold text-title mb-8">Prêt à passer au niveau supérieur ?</h2>
            <p class="text-xl text-muted-foreground mb-10">Rejoignez plus de 5000 créateurs et marques qui utilisent KpiHub aujourd'hui.</p>
            <a href="{{ route('register') }}" wire:navigate class="btn-primary px-8 py-4">
                Commencer maintenant
            </a>
        </div>
    </div>

    <!-- Footer -->
    <footer class="bg-card border-t border-border py-12">
        <div class="max-w-7xl mx-auto px-6 lg:px-8 flex flex-col md:flex-row justify-between items-center gap-8">
            <div class="flex items-center gap-2">
                <div class="h-8 w-8 rounded-lg bg-primary flex items-center justify-center font-black text-primary-foreground text-sm">K</div>
                <span class="text-xl font-bold text-foreground">KpiHub</span>
            </div>
            <p class="text-muted-foreground text-sm">© {{ date('Y') }} KpiHub. Tous droits réservés.</p>
            <div class="flex gap-6">
                <a href="#" class="text-muted-foreground hover:text-primary transition"><span class="sr-only">Twitter</span><svg class="h-5 w-5" fill="currentColor" viewBox="0 0 24 24">
                        <path d="M8.29 20.251c7.547 0 11.675-6.253 11.675-11.675 0-.178 0-.355-.012-.53A8.348 8.348 0 0022 5.92a8.19 8.19 0 01-2.357.646 4.118 4.118 0 001.804-2.27 8.224 8.224 0 01-2.605.996 4.107 4.107 0 00-6.993 3.743 11.65 11.65 0 01-8.457-4.287 4.106 4.106 0 001.27 5.477A4.072 4.072 0 012.8 9.713v.052a4.105 4.105 0 003.292 4.022 4.095 4.095 0 01-1.853.07 4.108 4.108 0 003.834 2.85A8.233 8.233 0 012 18.407a11.616 11.616 0 006.29 1.84" />
                    </svg></a>
                <a href="#" class="text-muted-foreground hover:text-primary transition"><span class="sr-only">GitHub</span><svg class="h-5 w-5" fill="currentColor" viewBox="0 0 24 24">
                        <path fill-rule="evenodd" d="M12 2C6.477 2 2 6.484 2 12.017c0 4.425 2.865 8.18 6.839 9.504.5.092.682-.217.682-.483 0-.237-.008-.868-.013-1.703-2.782.605-3.369-1.343-3.369-1.343-.454-1.158-1.11-1.466-1.11-1.466-.908-.62.069-.608.069-.608 1.003.07 1.531 1.032 1.531 1.032.892 1.53 2.341 1.088 2.91.832.092-.647.35-1.088.636-1.338-2.22-.253-4.555-1.11-4.555-4.943 0-1.091.39-1.988 1.029-2.688-.103-.253-.446-1.272.098-2.65 0 0 .84-.27 2.75 1.026A9.564 9.564 0 0112 6.844c.85.004 1.705.115 2.504.337 1.909-1.296 2.747-1.027 2.747-1.027.546 1.379.202 2.398.1 2.651.64.7 1.028 1.597 1.028 2.688 0 3.848-2.339 4.695-4.566 4.943.359.309.678.92.678 1.855 0 1.338-.012 2.419-.012 2.747 0 .268.18.58.688.482A10.019 10.019 0 0022 12.017C22 6.484 17.522 2 12 2z" clip-rule="evenodd" />
                    </svg></a>
            </div>
        </div>
    </footer>
</body>

</html>
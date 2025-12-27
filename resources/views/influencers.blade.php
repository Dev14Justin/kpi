<x-app-layout>
    <div class="py-6 md:py-12 bg-background min-h-screen" x-data="{ 
            search: '', 
            platform: 'all', 
            niche: 'all', 
            showFilters: false,
            platforms: [
                { id: 'tiktok', name: 'TikTok', icon: 'tiktok' },
                { id: 'instagram', name: 'Instagram', icon: 'instagram' },
                { id: 'youtube', name: 'YouTube', icon: 'youtube' },
                { id: 'linkedin', name: 'LinkedIn', icon: 'linkedin' },
                { id: 'facebook', name: 'Facebook', icon: 'facebook' },
                { id: 'x', name: 'X', icon: 'x' }
            ]
        }">

        <!-- 1. Header Section (Centered) -->
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 mb-8 md:mb-14">
            <div class="flex flex-col items-center text-center gap-4">
                <h1 class="text-4xl md:text-5xl font-black text-title tracking-tight">
                    Explorer les <span class="text-primary italic border-b-4 border-primary/30">Influenceurs</span>
                </h1>
                <p class="text-lg text-muted-foreground font-medium max-w-2xl">
                    Trouvez le partenaire idéal pour propulser votre marque et atteindre vos objectifs.
                </p>
            </div>
        </div>

        <!-- 2. Sticky Filtering Section -->
        <div class="mb-4 md:mb-8 py-2 md:py-4">

            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="bg-card rounded-2xl border border-border shadow-xl p-3 md:p-4 transition-all duration-300">
                    <div class="flex flex-col lg:flex-row gap-4 items-center">
                        <!-- Search Bar -->
                        <div class="relative flex-1 w-full">
                            <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                                <svg class="h-5 w-5 text-muted-foreground" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                                </svg>
                            </div>
                            <input type="text" x-model="search" placeholder="Rechercher par nom, pseudo ou mots-clés..."
                                class="w-full pl-11 pr-4 py-3 rounded-xl bg-background border border-border focus:border-primary focus:ring-4 focus:ring-primary/10 text-foreground placeholder-muted-foreground font-medium transition-all outline-none text-sm">
                        </div>

                        <!-- Platform Quick Toggle -->
                        <div class="flex items-center gap-2 p-1 bg-muted rounded-2xl w-full lg:w-auto overflow-x-auto no-scrollbar">
                            <button @click="platform = 'all'"
                                :class="platform === 'all' ? 'bg-primary text-primary-foreground shadow-lg shadow-primary/20' : 'text-muted-foreground hover:text-foreground'"
                                class="px-5 py-2.5 rounded-xl text-xs font-black uppercase tracking-widest transition-all whitespace-nowrap">
                                Tous
                            </button>
                            <template x-for="p in platforms" :key="p.id">
                                <button @click="platform = p.id"
                                    :class="platform === p.id ? 'bg-primary text-primary-foreground shadow-lg shadow-primary/20' : 'text-muted-foreground hover:text-primary'"
                                    class="p-2.5 rounded-xl transition-all">
                                    <div class="w-6 h-6 flex items-center justify-center">
                                        <template x-if="p.id === 'tiktok'"><svg class="w-5 h-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                                <path d="M9 12a4 4 0 1 0 4 4V4a5 5 0 0 0 5 5"></path>
                                            </svg></template>
                                        <template x-if="p.id === 'instagram'"><svg class="w-5 h-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                                <rect width="20" height="20" x="2" y="2" rx="5" ry="5" />
                                                <path d="M16 11.37A4 4 0 1 1 12.63 8 4 4 0 0 1 16 11.37z" />
                                                <line x1="17.5" x2="17.51" y1="6.5" y2="6.5" />
                                            </svg></template>
                                        <template x-if="p.id === 'youtube'"><svg class="w-5 h-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                                <path d="M2.5 17a24.12 24.12 0 0 1 0-10 2 2 0 0 1 2-2h15a2 2 0 0 1 2 2 24.12 24.12 0 0 1 0 10 2 2 0 0 1-2 2h-15a2-2-0 01-2-2Z" />
                                                <path d="m10 15 5-3-5-3z" />
                                            </svg></template>
                                        <template x-if="p.id === 'linkedin'"><svg class="w-5 h-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                                <path d="M16 8a6 6 0 0 1 6 6v7h-4v-7a2 2 0 0 0-2-2 2 2 0 0 0-2 2v7h-4v-7a6 6 0 0 1 6-6z" />
                                                <rect width="4" height="12" x="2" y="9" />
                                                <circle cx="4" cy="4" r="2" />
                                            </svg></template>
                                        <template x-if="p.id === 'facebook'"><svg class="w-5 h-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                                <path d="M18 2h-3a5 5 0 0 0-5 5v3H7v4h3v8h4v-8h3l1-4h-4V7a1 1 0 0 1 1-1h3z" />
                                            </svg></template>
                                        <template x-if="p.id === 'x'"><svg class="w-5 h-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                                <path d="M4 4l11.733 16h4.267l-11.733-16h-4.267z" />
                                                <path d="M4 20l6.768-6.768" />
                                                <path d="M13.232 10.768l6.768-6.768" />
                                            </svg></template>
                                    </div>
                                </button>
                            </template>
                        </div>

                        <!-- Advanced Toggle -->
                        <button @click="showFilters = !showFilters"
                            class="lg:w-auto w-full flex items-center justify-center gap-2 px-6 py-3 rounded-xl bg-muted text-foreground font-bold hover:bg-muted/80 transition-all outline-none border border-border text-sm">
                            <svg class="w-5 h-5 text-muted-foreground" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6V4m0 2a2 2 0 100 4m0-4a2 2 0 110 4m-6 8a2 2 0 100-4m0 4a2 2 0 110-4m0 4v2m0-6V4m6 6v10m6-2a2 2 0 100-4m0 4a2 2 0 110-4m0 4v2m0-6V4" />
                            </svg>
                            Filtres
                            <svg class="w-4 h-4 transition-transform duration-300 text-muted-foreground" :class="showFilters ? 'rotate-180' : ''" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M19 9l-7 7-7-7" />
                            </svg>
                        </button>
                    </div>

                    <!-- Advanced Filters Drawer -->
                    <div x-show="showFilters"
                        x-transition:enter="transition ease-out duration-300"
                        x-transition:enter-start="opacity-0 -translate-y-4"
                        x-transition:enter-end="opacity-100 translate-y-0"
                        class="mt-6 pt-6 border-t border-gray-100 dark:border-white/5 grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">

                        <!-- Niche Select -->
                        <div class="space-y-2">
                            <label class="text-[10px] font-black uppercase tracking-widest text-muted-foreground">Par Niche</label>
                            <select x-model="niche" class="w-full bg-background border border-border rounded-xl py-3 px-4 text-sm font-bold text-foreground outline-none focus:border-primary focus:ring-4 focus:ring-primary/10 transition-all cursor-pointer">
                                <option value="all" class="bg-card text-foreground">Toutes les niches</option>
                                @foreach(['Education', 'Humour/Comédie', 'Cuisine/Food', 'Art/Design', 'Technologie', 'Voyage', 'Mode/Beauté', 'Fitness/Sport', 'Gaming', 'Musique', 'Danse', 'Animaux', 'Lifestyle', 'Business/Finance', 'Développement Personnel', 'Actualités/Politique', 'Science'] as $item)
                                <option value="{{ $item }}" class="bg-card text-foreground">{{ $item }}</option>
                                @endforeach
                                <option value="Autre" class="bg-card text-foreground">Autre</option>
                            </select>
                        </div>

                        <!-- Followers Range -->
                        <div class="space-y-2">
                            <label class="text-[10px] font-black uppercase tracking-widest text-muted-foreground">Abonnés</label>
                            <select class="w-full bg-background border border-border rounded-xl py-3 px-4 text-sm font-bold text-foreground outline-none focus:border-primary focus:ring-4 focus:ring-primary/10 transition-all cursor-pointer">
                                <option class="bg-card text-foreground">Tous les niveaux</option>
                                <option class="bg-card text-foreground">1K - 10K (Nano)</option>
                                <option class="bg-card text-foreground">10K - 50K (Micro)</option>
                                <option class="bg-card text-foreground">50K - 500K (Mid-tier)</option>
                                <option class="bg-card text-foreground">500K+ (Macro)</option>
                            </select>
                        </div>

                        <!-- Engagement Rate -->
                        <div class="space-y-2" x-data="{ engagement: 2 }">
                            <label class="text-[10px] font-black uppercase tracking-widest text-muted-foreground">Engagement (%)</label>
                            <div class="flex items-center gap-3">
                                <button type="button" @click="engagement = Math.max(0, engagement - 1)"
                                    class="w-10 h-10 rounded-xl bg-background border border-border flex items-center justify-center text-foreground hover:bg-primary hover:text-primary-foreground hover:border-primary transition-all outline-none focus:ring-4 focus:ring-primary/10">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M20 12H4" />
                                    </svg>
                                </button>
                                <div class="flex-1 relative">
                                    <input type="number" x-model="engagement"
                                        class="w-full bg-background border border-border rounded-xl py-3 px-4 text-center font-bold text-foreground outline-none focus:border-primary focus:ring-4 focus:ring-primary/10 transition-all [appearance:textfield] [&::-webkit-outer-spin-button]:appearance-none [&::-webkit-inner-spin-button]:appearance-none">
                                    <span class="absolute right-4 top-1/2 -translate-y-1/2 text-xs font-bold text-primary">%+</span>
                                </div>
                                <button type="button" @click="engagement++"
                                    class="w-10 h-10 rounded-xl bg-background border border-border flex items-center justify-center text-foreground hover:bg-primary hover:text-primary-foreground hover:border-primary transition-all outline-none focus:ring-4 focus:ring-primary/10">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M12 4v16m8-8H4" />
                                    </svg>
                                </button>
                            </div>
                        </div>

                        <!-- Sort Options -->
                        <div class="space-y-2">
                            <label class="text-[10px] font-black uppercase tracking-widest text-muted-foreground">Trier par</label>
                            <select class="w-full bg-background border border-border rounded-xl py-3 px-4 text-sm font-bold text-foreground outline-none focus:border-primary focus:ring-4 focus:ring-primary/10 transition-all cursor-pointer">
                                <option class="bg-card text-foreground">Plus récents</option>
                                <option class="bg-card text-foreground">Plus d'abonnés</option>
                                <option class="bg-card text-foreground">Meilleur engagement</option>
                                <option class="bg-card text-foreground">Moins chers</option>
                            </select>
                        </div>
                    </div>

                    <!-- Active Filter Tags -->
                    <div class="mt-4 flex flex-wrap gap-2 justify-center">
                        <template x-if="platform !== 'all'">
                            <div class="bg-primary/10 text-primary px-3 py-1.5 rounded-full text-[10px] font-bold flex items-center gap-2 border border-primary/20">
                                <span x-text="'Plateforme: ' + platforms.find(p => p.id === platform).name"></span>
                                <button @click="platform = 'all'"><svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M6 18L18 6M6 6l12 12" />
                                    </svg></button>
                            </div>
                        </template>
                    </div>
                </div>
            </div>
        </div>

        <!-- 3. Influencers Grid Section -->
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 pb-12">
            @if($influencers->isEmpty())
            <div class="bg-card rounded-[2rem] p-20 border border-dashed border-border text-center">
                <p class="text-muted-foreground font-medium italic">Aucun influenceur disponible pour le moment.</p>
            </div>
            @else
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach($influencers as $influencer)
                <div x-show="(search === '' || 
                             @js(strtolower($influencer->influencerProfile->first_name ?? '') . ' ' . strtolower($influencer->influencerProfile->last_name ?? '')).includes(search.toLowerCase()) || 
                             @js(strtolower($influencer->first_name . ' ' . $influencer->last_name)).includes(search.toLowerCase()) || 
                             @js(strtolower($influencer->influencerProfile->pseudo ?? '')).includes(search.toLowerCase())) && 
                             (platform === 'all' || platform === @js($influencer->influencerProfile->main_platform->value ?? $influencer->main_platform->value ?? '')) &&
                             (niche === 'all' || niche === @js($influencer->influencerProfile->niche ?? ''))"
                    x-transition
                    class="group bg-card rounded-2xl border border-border p-5 hover:border-primary hover:ring-4 hover:ring-primary/20 transition-all duration-300 flex flex-col shadow-sm">

                    <div class="flex flex-col items-center text-center">
                        <div class="relative mb-4">
                            @if($influencer->profile_photo_path)
                            <img src="{{ asset('storage/' . $influencer->profile_photo_path) }}" alt="Avatar" class="w-16 h-16 rounded-2xl object-cover ring-2 ring-accent/20 p-0.5 shadow-lg">
                            @else
                            <div class="w-16 h-16 rounded-2xl bg-accent flex items-center justify-center text-white text-2xl font-bold ring-2 ring-accent/20 p-0.5 shadow-lg">
                                {{ substr($influencer->first_name ?? $influencer->name ?? 'U', 0, 1) }}
                            </div>
                            @endif
                            <div class="absolute -bottom-1 -right-1 bg-primary rounded-full border-2 border-background w-5 h-5 flex items-center justify-center shadow-sm z-10">
                                <svg class="w-2.5 h-2.5 text-primary-foreground" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"></path>
                                </svg>
                            </div>
                        </div>

                        <h3 class="text-xl font-bold text-foreground mb-0.5">
                            {{ $influencer->influencerProfile->pseudo ?? Str::slug($influencer->name) }}
                        </h3>
                        <p class="text-[11px] font-bold text-muted-foreground mb-2 uppercase tracking-widest flex items-center justify-center gap-1.5">
                            <svg class="w-2.5 h-2.5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2" />
                                <circle cx="12" cy="7" r="4" />
                            </svg>
                            {{ $influencer->influencerProfile->first_name ?? $influencer->first_name }} {{ $influencer->influencerProfile->last_name ?? $influencer->last_name }}
                        </p>

                        <!-- Niche Badge -->
                        @if($influencer->influencerProfile?->niche)
                        <div class="mb-3">
                            <span class="px-2.5 py-1 rounded-full bg-primary/10 text-primary text-[10px] font-black uppercase tracking-wider border border-primary/20">
                                {{ $influencer->influencerProfile->niche === 'Autre' ? $influencer->influencerProfile->niche_other : $influencer->influencerProfile->niche }}
                            </span>
                        </div>
                        @endif

                        <p class="text-sm text-muted-foreground leading-relaxed font-medium line-clamp-2 max-w-[240px]">
                            {{ $influencer->influencerProfile->professional_title ?? $influencer->professional_title ?? 'Créateur de contenu innovant' }}
                        </p>
                    </div>

                    <div class="mt-8 py-5 border-y border-border flex flex-wrap items-center justify-around md:justify-between gap-y-4 gap-x-2 px-1 relative">
                        <div class="flex flex-col items-center">
                            <span class="text-primary font-black text-sm leading-none">12</span>
                            <span class="text-[8px] font-bold text-muted-foreground uppercase tracking-tighter mt-1">Campaigns</span>
                        </div>
                        <div class="flex flex-col items-center text-center">
                            <span class="text-foreground font-black text-sm leading-none">45.2K</span>
                            <span class="text-[8px] font-bold text-muted-foreground uppercase tracking-tighter mt-1">Followers</span>
                        </div>
                        <div class="flex flex-col items-center text-center">
                            <span class="text-foreground font-black text-sm leading-none">15K</span>
                            <span class="text-[8px] font-bold text-muted-foreground uppercase tracking-tighter mt-1">Vue Moy.</span>
                        </div>
                        <div class="flex flex-col items-center text-center">
                            <span class="text-foreground font-black text-sm leading-none">3.2%</span>
                            <span class="text-[8px] font-bold text-muted-foreground uppercase tracking-tighter mt-1">Taux Conv.</span>
                        </div>

                        <!-- Main Platform Icon Integrated at the end -->
                        @if(($influencer->influencerProfile?->main_platform ?? $influencer->main_platform) && ($influencer->influencerProfile?->profile_url ?? $influencer->profile_url))
                        <div class="flex-shrink-0 ml-1">
                            <a href="{{ $influencer->influencerProfile->profile_url ?? $influencer->profile_url }}" target="_blank"
                                class="flex items-center justify-center w-8 h-8 rounded-full bg-card border border-border shadow-sm hover:border-primary hover:text-primary transition-all hover:scale-110"
                                title="Voir sur {{ ($influencer->influencerProfile?->main_platform ?? $influencer->main_platform)?->label() }}">
                                @php
                                $platform = ($influencer->influencerProfile?->main_platform ?? $influencer->main_platform)?->value;
                                @endphp
                                @if($platform === 'tiktok')
                                <svg class="w-4 h-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <path d="M9 12a4 4 0 1 0 4 4V4a5 5 0 0 0 5 5"></path>
                                </svg>
                                @elseif($platform === 'instagram')
                                <svg class="w-4 h-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <rect width="20" height="20" x="2" y="2" rx="5" ry="5" />
                                    <path d="M16 11.37A4 4 0 1 1 12.63 8 4 4 0 0 1 16 11.37z" />
                                    <line x1="17.5" x2="17.51" y1="6.5" y2="6.5" />
                                </svg>
                                @elseif($platform === 'youtube')
                                <svg class="w-4 h-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <path d="M2.5 17a24.12 24.12 0 0 1 0-10 2 2 0 0 1 2-2h15a2 2 0 0 1 2 2 24.12 24.12 0 0 1 0 10 2 2 0 0 1-2 2h-15a2 2 0 0 1-2-2Z" />
                                    <path d="m10 15 5-3-5-3z" />
                                </svg>
                                @elseif($platform === 'linkedin')
                                <svg class="w-4 h-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <path d="M16 8a6 6 0 0 1 6 6v7h-4v-7a2 2 0 0 0-2-2 2 2 0 0 0-2 2v7h-4v-7a6 6 0 0 1 6-6z" />
                                    <rect width="4" height="12" x="2" y="9" />
                                    <circle cx="4" cy="4" r="2" />
                                </svg>
                                @elseif($platform === 'facebook')
                                <svg class="w-4 h-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <path d="M18 2h-3a5 5 0 0 0-5 5v3H7v4h3v8h4v-8h3l1-4h-4V7a1 1 0 0 1 1-1h3z" />
                                </svg>
                                @elseif($platform === 'x')
                                <svg class="w-4 h-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <path d="M4 4l11.733 16h4.267l-11.733-16h-4.267z" />
                                    <path d="M4 20l6.768-6.768" />
                                    <path d="M13.232 10.768l6.768-6.768" />
                                </svg>
                                @else
                                <svg class="w-4 h-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <circle cx="12" cy="12" r="10" />
                                    <line x1="2" y1="12" x2="22" y2="12" />
                                    <path d="M12 2a15.3 15.3 0 0 1 4 10 15.3 15.3 0 0 1-4 10 15.3 15.3 0 0 1-4-10 15.3 15.3 0 0 1 4-10z" />
                                </svg>
                                @endif
                            </a>
                        </div>
                        @endif
                    </div>

                    <div class="mt-6 flex gap-2">
                        <a href="{{ route('discussions.index') }}" wire:navigate class="flex-1 inline-flex items-center justify-center gap-2 px-3 py-2.5 rounded-xl bg-primary text-primary-foreground font-bold text-xs hover:opacity-90 transition-all shadow-sm">
                            <svg class="w-3.5 h-3.5 text-primary-foreground" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M20 2H4c-1.1 0-2 .9-2 2v18l4-4h14c1.1 0 2-.9 2-2V4c0-1.1-.9-2-2-2z" />
                            </svg>
                            Discuter
                        </a>
                        <a href="{{ route('profile.public', $influencer) }}" wire:navigate class="flex-1 inline-flex items-center justify-center gap-2 px-3 py-2.5 rounded-xl bg-background border border-border text-foreground text-xs font-bold hover:border-primary hover:text-primary transition-all group">
                            Voir profil
                            <svg class="w-3.5 h-3.5 opacity-60 transition-colors group-hover:opacity-100" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M9 18l6-6-6-6"></path>
                            </svg>
                        </a>
                    </div>
                </div>
                @endforeach
            </div>
            @endif
        </div>
    </div>
</x-app-layout>
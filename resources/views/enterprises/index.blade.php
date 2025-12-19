<x-app-layout>
    <div class="py-12 bg-background min-h-screen" x-data="{ 
            search: '', 
            industry: 'all', 
            showFilters: false,
            industries: [
                { id: 'mode-beaute', name: 'Mode & Beauté' },
                { id: 'technologie', name: 'Technologie' },
                { id: 'alimentation', name: 'Alimentation' },
                { id: 'voyage', name: 'Voyage' },
                { id: 'sport-fitness', name: 'Sport & Fitness' }
            ]
        }">

        <!-- 1. Header Section (Centered) -->
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 mb-14">
            <div class="flex flex-col items-center text-center gap-4">
                <h1 class="text-4xl md:text-5xl font-black text-title tracking-tight">
                    Explorer les <span class="text-primary italic border-b-4 border-primary/30">Entreprises</span>
                </h1>
                <p class="text-lg text-muted-foreground font-medium max-w-2xl">
                    Découvrez des marques innovantes et trouvez votre prochain partenaire de campagne.
                </p>
            </div>
        </div>

        <!-- 2. Filtering Section -->
        <div class="mb-8 py-4">

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
                            <input type="text" x-model="search" placeholder="Rechercher une entreprise, un secteur, un mot-clé..."
                                class="w-full pl-11 pr-4 py-3 rounded-xl bg-background border border-border focus:border-primary focus:ring-4 focus:ring-primary/10 text-foreground placeholder-muted-foreground font-medium transition-all outline-none text-sm">
                        </div>

                        <!-- Industry Quick Toggle -->
                        <div class="flex items-center gap-2 p-1 bg-muted rounded-2xl w-full lg:w-auto overflow-x-auto no-scrollbar">
                            <button @click="industry = 'all'"
                                :class="industry === 'all' ? 'bg-primary text-primary-foreground shadow-lg shadow-primary/20' : 'text-muted-foreground hover:text-foreground'"
                                class="px-5 py-2.5 rounded-xl text-xs font-black uppercase tracking-widest transition-all whitespace-nowrap">
                                Tous
                            </button>
                            <template x-for="ind in industries" :key="ind.id">
                                <button @click="industry = ind.id"
                                    :class="industry === ind.id ? 'bg-primary text-primary-foreground shadow-lg shadow-primary/20' : 'text-muted-foreground hover:text-primary'"
                                    class="px-5 py-2.5 rounded-xl text-xs font-black uppercase tracking-widest transition-all whitespace-nowrap">
                                    <span x-text="ind.name"></span>
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
                        class="mt-6 pt-6 border-t border-border grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">

                        <!-- Full Industry Select -->
                        <div class="space-y-2">
                            <label class="text-[10px] font-black uppercase tracking-widest text-muted-foreground">Secteur d'activité</label>
                            <select x-model="industry" class="w-full bg-background border border-border rounded-xl py-3 px-4 text-sm font-bold text-foreground outline-none focus:border-primary focus:ring-4 focus:ring-primary/10 transition-all cursor-pointer">
                                <option value="all" class="bg-card text-foreground">Tous les secteurs</option>
                                <option value="fashion" class="bg-card text-foreground">Mode & Beauté</option>
                                <option value="tech" class="bg-card text-foreground">Technologie</option>
                                <option value="food" class="bg-card text-foreground">Alimentation</option>
                                <option value="travel" class="bg-card text-foreground">Voyage</option>
                                <option value="fitness" class="bg-card text-foreground">Sport & Santé</option>
                                <option value="education" class="bg-card text-foreground">Éducation</option>
                                <option value="auto" class="bg-card text-foreground">Automobile</option>
                            </select>
                        </div>

                        <!-- Location Select -->
                        <div class="space-y-2">
                            <label class="text-[10px] font-black uppercase tracking-widest text-muted-foreground">Localisation</label>
                            <select class="w-full bg-background border border-border rounded-xl py-3 px-4 text-sm font-bold text-foreground outline-none focus:border-primary focus:ring-4 focus:ring-primary/10 transition-all cursor-pointer">
                                <option class="bg-card text-foreground">Toutes les villes</option>
                                <option class="bg-card text-foreground">Paris, France</option>
                                <option class="bg-card text-foreground">Lyon, France</option>
                                <option class="bg-card text-foreground">Marseille, France</option>
                                <option class="bg-card text-foreground">Bordeaux, France</option>
                            </select>
                        </div>

                        <!-- Campaign Volume -->
                        <div class="space-y-2">
                            <label class="text-[10px] font-black uppercase tracking-widest text-muted-foreground">Volume de campagnes</label>
                            <select class="w-full bg-background border border-border rounded-xl py-3 px-4 text-sm font-bold text-foreground outline-none focus:border-primary focus:ring-4 focus:ring-primary/10 transition-all cursor-pointer">
                                <option class="bg-card text-foreground">Tous les volumes</option>
                                <option class="bg-card text-foreground">Petite Entreprise (1-5)</option>
                                <option class="bg-card text-foreground">Moyenne Entreprise (5-20)</option>
                                <option class="bg-card text-foreground">Grande Entreprise (20+)</option>
                            </select>
                        </div>

                        <!-- Sort Options -->
                        <div class="space-y-2">
                            <label class="text-[10px] font-black uppercase tracking-widest text-muted-foreground">Trier par</label>
                            <select class="w-full bg-background border border-border rounded-xl py-3 px-4 text-sm font-bold text-foreground outline-none focus:border-primary focus:ring-4 focus:ring-primary/10 transition-all cursor-pointer">
                                <option class="bg-card text-foreground">Plus récents</option>
                                <option class="bg-card text-foreground">Nom (A-Z)</option>
                                <option class="bg-card text-foreground">Plus actives</option>
                            </select>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- 3. Enterprises Grid Section -->
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 pb-12">
            @if($enterprises->isEmpty())
            <div class="bg-card rounded-[2rem] p-20 border border-dashed border-border text-center">
                <p class="text-muted-foreground font-medium italic">Aucune entreprise disponible pour le moment.</p>
            </div>
            @else
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach($enterprises as $enterprise)
                @php
                $companyName = $enterprise->enterpriseProfile->company_name ?? $enterprise->name ?? '';
                $industryName = $enterprise->enterpriseProfile->industry ?? '';
                $description = $enterprise->enterpriseProfile->description ?? '';
                $industrySlug = Str::slug($industryName);
                @endphp
                <div x-show="(search === '' || 
                             @js(strtolower($companyName)).includes(search.toLowerCase()) || 
                             @js(strtolower($industryName)).includes(search.toLowerCase()) || 
                             @js(strtolower($description)).includes(search.toLowerCase())) && 
                             (industry === 'all' || industry === @js($enterprise->enterpriseProfile->industry_id ?? $industrySlug))"
                    x-transition
                    class="group bg-card rounded-2xl border border-border p-5 hover:border-primary hover:ring-4 hover:ring-primary/20 transition-all duration-300 flex flex-col shadow-sm">

                    <div class="flex flex-col items-center text-center">
                        <div class="relative mb-4">
                            @if($enterprise->profile_photo_path)
                            <img src="{{ asset('storage/' . $enterprise->profile_photo_path) }}" alt="Logo" class="w-16 h-16 rounded-2xl object-cover ring-2 ring-primary/20 p-0.5 shadow-lg">
                            @else
                            <div class="w-16 h-16 rounded-2xl bg-muted border border-border flex items-center justify-center text-foreground text-2xl font-bold ring-2 ring-primary/10 p-0.5 shadow-lg">
                                {{ substr($enterprise->enterpriseProfile->company_name ?? $enterprise->name ?? 'E', 0, 1) }}
                            </div>
                            @endif
                            <div class="absolute -bottom-1 -right-1 bg-primary rounded-full border-2 border-background w-5 h-5 flex items-center justify-center shadow-sm z-10">
                                <svg class="w-2.5 h-2.5 text-primary-foreground" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                            </div>
                        </div>

                        <h3 class="text-xl font-bold text-foreground mb-0.5">
                            {{ $enterprise->enterpriseProfile->company_name ?? $enterprise->name }}
                        </h3>
                        <p class="text-[11px] font-bold text-primary mb-3 uppercase tracking-widest flex items-center justify-center gap-1.5">
                            <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
                            </svg>
                            {{ $enterprise->enterpriseProfile->industry ?? 'Secteur non défini' }}
                        </p>

                        <p class="text-sm text-muted-foreground leading-relaxed font-medium line-clamp-2 max-w-[240px]">
                            {{ $enterprise->enterpriseProfile->description ?? 'Une entreprise visionnaire engagée dans l\'excellence et le partenariat.' }}
                        </p>
                    </div>

                    <div class="mt-8 py-5 border-y border-border flex items-center justify-around gap-2 px-1">
                        <div class="flex flex-col items-center">
                            <span class="text-primary font-black text-sm leading-none">08</span>
                            <span class="text-[8px] font-bold text-muted-foreground uppercase tracking-tighter mt-1">Actives</span>
                        </div>
                        <div class="flex flex-col items-center text-center">
                            <span class="text-foreground font-black text-sm leading-none">24</span>
                            <span class="text-[8px] font-bold text-muted-foreground uppercase tracking-tighter mt-1">Total</span>
                        </div>
                        <div class="flex flex-col items-center text-center">
                            <span class="text-foreground font-black text-sm leading-none">4.8</span>
                            <span class="text-[8px] font-bold text-muted-foreground uppercase tracking-tighter mt-1">Note</span>
                        </div>

                        @if($enterprise->enterpriseProfile && $enterprise->enterpriseProfile->website)
                        <a href="{{ $enterprise->enterpriseProfile->website }}" target="_blank" class="transition-transform hover:scale-110 flex-shrink-0" title="Visiter le site web">
                            <div class="w-8 h-8 rounded-lg bg-background border border-border text-foreground flex items-center justify-center shadow-sm hover:border-primary hover:text-primary transition-all">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 12a9 9 0 01-9 9m9-9a9 9 0 00-9-9m9 9H3m9 9a9 9 0 01-9-9m9 9c1.657 0 3-4.03 3-9s-1.343-9-3-9m0 18c-1.657 0-3-4.03-3-9s1.343-9 3-9m-9 9a9 9 0 019-9" />
                                </svg>
                            </div>
                        </a>
                        @endif
                    </div>

                    <div class="mt-6 flex gap-2">
                        <a href="{{ route('discussions.index') }}" wire:navigate class="flex-1 inline-flex items-center justify-center gap-2 px-3 py-2.5 rounded-xl bg-primary text-primary-foreground font-bold text-xs hover:opacity-90 transition-all shadow-sm">
                            <svg class="w-3.5 h-3.5 text-primary-foreground" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M20 2H4c-1.1 0-2 .9-2 2v18l4-4h14c1.1 0 2-.9 2-2V4c0-1.1-.9-2-2-2z" />
                            </svg>
                            Contacter
                        </a>
                        <a href="{{ route('profile.public', $enterprise) }}" wire:navigate class="flex-1 inline-flex items-center justify-center gap-2 px-3 py-2.5 rounded-xl bg-background border border-border text-foreground text-xs font-bold hover:border-primary hover:text-primary transition-all group">
                            Découvrir
                            <svg class="w-3.5 h-3.5 opacity-60 transition-colors group-hover:opacity-100" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
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
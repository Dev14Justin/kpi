<x-app-layout>
    <div class="py-12 bg-gray-50 dark:bg-[#121212] min-h-screen">

        <!-- 1. Header Section (Centered) -->
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 mb-14">
            <div class="flex flex-col items-center text-center gap-4">
                <h1 class="text-4xl md:text-5xl font-black text-gray-900 dark:text-white tracking-tight">
                    Explorer les <span class="text-primary italic border-b-4 border-primary/20">Influenceurs</span>
                </h1>
                <p class="text-lg text-gray-600 dark:text-gray-400 font-medium max-w-2xl">
                    Trouvez le partenaire idéal pour propulser votre marque et atteindre vos objectifs.
                </p>
            </div>
        </div>

        <!-- 2. Sticky Filtering Section -->
        <div x-data="{ 
            search: '', 
            platform: 'all', 
            category: 'all', 
            showFilters: false,
            isStuck: false,
            platforms: [
                { id: 'tiktok', name: 'TikTok', icon: 'tiktok' },
                { id: 'instagram', name: 'Instagram', icon: 'instagram' },
                { id: 'youtube', name: 'YouTube', icon: 'youtube' },
                { id: 'linkedin', name: 'LinkedIn', icon: 'linkedin' }
            ]
        }"
            @scroll.window="isStuck = (window.pageYOffset > 100)"
            class="sticky top-[64px] z-40 mb-12 transition-all duration-300"
            :class="isStuck ? 'bg-white/90 dark:bg-[#1C1C1C]/90 backdrop-blur-md border-b border-gray-100 dark:border-white/10 shadow-lg py-4' : 'py-2'">

            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="bg-white dark:bg-[#1C1C1C] rounded-3xl border border-gray-100 dark:border-white/5 shadow-xl p-4 md:p-6 transition-all duration-300"
                    :class="isStuck ? 'border-transparent shadow-none bg-transparent' : ''">
                    <div class="flex flex-col lg:flex-row gap-4 items-center">
                        <!-- Search Bar -->
                        <div class="relative flex-1 w-full">
                            <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                                <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                                </svg>
                            </div>
                            <input type="text" x-model="search" placeholder="Rechercher par nom, pseudo ou mots-clés..."
                                class="w-full pl-11 pr-4 py-4 rounded-2xl bg-gray-50 dark:bg-black/20 border-transparent focus:border-primary focus:ring-4 focus:ring-primary/10 text-gray-900 dark:text-white placeholder-gray-500 font-medium transition-all outline-none">
                        </div>

                        <!-- Platform Quick Toggle -->
                        <div class="flex items-center gap-2 p-1 bg-gray-50 dark:bg-black/20 rounded-2xl w-full lg:w-auto overflow-x-auto no-scrollbar">
                            <button @click="platform = 'all'"
                                :class="platform === 'all' ? 'bg-primary text-white shadow-lg shadow-primary/20' : 'text-gray-500 hover:text-gray-900 dark:hover:text-white'"
                                class="px-5 py-2.5 rounded-xl text-xs font-black uppercase tracking-widest transition-all whitespace-nowrap">
                                Tous
                            </button>
                            <template x-for="p in platforms" :key="p.id">
                                <button @click="platform = p.id"
                                    :class="platform === p.id ? 'bg-white dark:bg-[#1C1C1C] text-primary shadow-md' : 'text-gray-400 hover:text-primary'"
                                    class="p-2.5 rounded-xl transition-all">
                                    <div class="w-6 h-6 flex items-center justify-center">
                                        <template x-if="p.id === 'tiktok'"><svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                                                <path d="M12.525.02c1.31-.02 2.61-.01 3.91-.02.08 1.53.63 3.09 1.75 4.17 1.12 1.11 2.7 1.62 4.24 1.79v4.03c-1.44-.05-2.89-.35-4.2-.97-.57-.26-1.1-.59-1.62-.93-.01 2.92.01 5.84-.02 8.75-.03 1.4-.54 2.79-1.35 3.94-1.31 1.92-3.58 3.17-5.91 3.21-1.43.08-2.86-.31-4.08-1.03-2.02-1.19-3.44-3.37-3.65-5.71-.02-.5-.03-1-.01-1.49.18-1.9 1.12-3.72 2.58-4.96a6.66 6.66 0 014.12-1.55c.02 1.48.01 2.96.02 4.44-1.14.01-2.34.42-3.15 1.25-.85.83-1.16 2.05-1.13 3.22.02 1.05.54 2.11 1.34 2.79.82.72 1.96 1.05 3.04.88 1.14-.11 2.19-.85 2.75-1.85.39-.68.53-1.48.51-2.27-.02-3.85-.01-7.7-.02-11.55z" />
                                            </svg></template>
                                        <template x-if="p.id === 'instagram'"><svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                                                <path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zm0-2.163c-3.259 0-3.667.014-4.947.072-4.358.2-6.78 2.618-6.98 6.98-.059 1.281-.073 1.689-.073 4.948 0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98 1.281.058 1.689.072 4.948.072 3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98-1.281-.059-1.69-.073-4.949-.073zm0 5.838c-3.403 0-6.162 2.759-6.162 6.162s2.759 6.163 6.162 6.163 6.162-2.759 6.162-6.163c0-3.403-2.759-6.162-6.162-6.162zm0 10.162c-2.209 0-4-1.79-4-4 0-2.209 1.791-4 4-4s4 1.791 4 4c0 2.21-1.791 4-4 4zm6.406-11.845c-.796 0-1.441.645-1.441 1.44s.645 1.44 1.441 1.44c.795 0 1.439-.645 1.439-1.44s-.644-1.44-1.439-1.44z" />
                                            </svg></template>
                                        <template x-if="p.id === 'youtube'"><svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                                                <path d="M23.498 6.186a3.016 3.016 0 0 0-2.122-2.136C19.505 3.545 12 3.545 12 3.545s-7.505 0-9.377.505A3.017 3.017 0 0 0 .502 6.186C0 8.07 0 12 0 12s0 3.93.502 5.814a3.016 3.016 0 0 0 2.122 2.136c1.871.505 9.376.505 9.376.505s7.505 0 9.377-.505a3.015 3.015 0 0 0 2.122-2.136C24 15.93 24 12 24 12s0-3.93-.502-5.814zM9.545 15.568V8.432L15.818 12l-6.273 3.568z" />
                                            </svg></template>
                                        <template x-if="p.id === 'linkedin'"><svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                                                <path d="M20.447 20.452h-3.554v-5.569c0-1.328-.027-3.037-1.852-3.037-1.853 0-2.136 1.445-2.136 2.939v5.667H9.351V9h3.414v1.561h.046c.477-.9 1.637-1.85 3.37-1.85 3.601 0 4.267 2.37 4.267 5.455v6.286zM5.337 7.433c-1.144 0-2.063-.926-2.063-2.065 0-1.138.92-2.063 2.063-2.063 1.14 0 2.064.925 2.064 2.063 0 1.139-.925 2.065-2.064 2.065zm1.782 13.019H3.555V9h3.564v11.452zM22.225 0H1.771C.792 0 0 .774 0 1.729v20.542C0 23.227.792 24 1.771 24h20.451C23.2 24 24 23.227 24 22.271V1.729C24 .774 23.2 0 22.222 0h.003z" />
                                            </svg></template>
                                    </div>
                                </button>
                            </template>
                        </div>

                        <!-- Advanced Toggle -->
                        <button @click="showFilters = !showFilters"
                            class="lg:w-auto w-full flex items-center justify-center gap-2 px-6 py-4 rounded-2xl bg-gray-50 dark:bg-black/20 text-gray-700 dark:text-gray-300 font-bold hover:bg-gray-100 dark:hover:bg-white/5 transition-all outline-none">
                            <svg class="w-5 h-5 opacity-60" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6V4m0 2a2 2 0 100 4m0-4a2 2 0 110 4m-6 8a2 2 0 100-4m0 4a2 2 0 110-4m0 4v2m0-6V4m6 6v10m6-2a2 2 0 100-4m0 4a2 2 0 110-4m0 4v2m0-6V4" />
                            </svg>
                            Filtres
                            <svg class="w-4 h-4 transition-transform duration-300" :class="showFilters ? 'rotate-180' : ''" fill="none" stroke="currentColor" viewBox="0 0 24 24">
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

                        <!-- Category Select -->
                        <div class="space-y-2">
                            <label class="text-[10px] font-black uppercase tracking-widest text-gray-400 dark:text-gray-500">Catégorie</label>
                            <select x-model="category" class="w-full bg-gray-50 dark:bg-black/20 border-transparent rounded-xl py-3 px-4 text-sm font-bold text-gray-900 dark:text-white outline-none focus:ring-2 focus:ring-primary/20">
                                <option value="all">Toutes les catégories</option>
                                <option value="lifestyle">Lifestyle & Mode</option>
                                <option value="tech">Tech & Gaming</option>
                                <option value="beauty">Beauté & Soins</option>
                                <option value="fitness">Sport & Santé</option>
                                <option value="food">Cuisine & Gastronomie</option>
                            </select>
                        </div>

                        <!-- Followers Range -->
                        <div class="space-y-2">
                            <label class="text-[10px] font-black uppercase tracking-widest text-gray-400 dark:text-gray-500">Abonnés</label>
                            <select class="w-full bg-gray-50 dark:bg-black/20 border-transparent rounded-xl py-3 px-4 text-sm font-bold text-gray-900 dark:text-white outline-none focus:ring-2 focus:ring-primary/20">
                                <option>Tous les niveaux</option>
                                <option>1K - 10K (Nano)</option>
                                <option>10K - 50K (Micro)</option>
                                <option>50K - 500K (Mid-tier)</option>
                                <option>500K+ (Macro)</option>
                            </select>
                        </div>

                        <!-- Engagement Rate -->
                        <div class="space-y-2">
                            <label class="text-[10px] font-black uppercase tracking-widest text-gray-400 dark:text-gray-500">Engagement</label>
                            <div class="flex items-center gap-2">
                                <input type="range" class="w-full accent-primary h-1.5 bg-gray-200 dark:bg-white/10 rounded-lg appearance-none cursor-pointer">
                                <span class="text-xs font-bold text-primary min-w-[30px]">2%+</span>
                            </div>
                        </div>

                        <!-- Sort Options -->
                        <div class="space-y-2">
                            <label class="text-[10px] font-black uppercase tracking-widest text-gray-400 dark:text-gray-500">Trier par</label>
                            <select class="w-full bg-gray-50 dark:bg-black/20 border-transparent rounded-xl py-3 px-4 text-sm font-bold text-gray-900 dark:text-white outline-none focus:ring-2 focus:ring-primary/20">
                                <option>Plus récents</option>
                                <option>Plus d'abonnés</option>
                                <option>Meilleur engagement</option>
                                <option>Moins chers</option>
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
            <div class="bg-white dark:bg-[#1C1C1C] rounded-[2rem] p-20 border border-dashed border-gray-200 dark:border-white/10 text-center">
                <p class="text-gray-500 font-medium italic">Aucun influenceur disponible pour le moment.</p>
            </div>
            @else
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach($influencers as $influencer)
                <div class="group bg-white dark:bg-[#1C1C1C] rounded-2xl border border-gray-100 dark:border-white/5 p-5 hover:border-[#00D084] hover:ring-4 hover:ring-[#00D084]/20 transition-all duration-300 flex flex-col shadow-sm">

                    <div class="flex flex-col items-center text-center">
                        <div class="relative mb-4">
                            @if($influencer->profile_photo_path)
                            <img src="{{ asset('storage/' . $influencer->profile_photo_path) }}" alt="Avatar" class="w-16 h-16 rounded-2xl object-cover ring-2 ring-accent/20 p-0.5 shadow-lg">
                            @else
                            <div class="w-16 h-16 rounded-2xl bg-accent flex items-center justify-center text-white text-2xl font-bold ring-2 ring-accent/20 p-0.5 shadow-lg">
                                {{ substr($influencer->first_name ?? $influencer->name ?? 'U', 0, 1) }}
                            </div>
                            @endif
                            <div class="absolute -bottom-1 -right-1 bg-[#10B981] rounded-full border-2 border-white dark:border-[#1C1C1C] w-5 h-5 flex items-center justify-center shadow-sm z-10">
                                <svg class="w-2.5 h-2.5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"></path>
                                </svg>
                            </div>
                        </div>

                        <h3 class="text-xl font-bold text-gray-900 dark:text-white mb-0.5">
                            {{ $influencer->first_name }} {{ $influencer->last_name }}
                        </h3>
                        <p class="text-[11px] font-bold text-gray-400 dark:text-gray-500 mb-3 uppercase tracking-widest flex items-center justify-center gap-1.5">
                            <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                            </svg>
                            {{ $influencer->influencerProfile->pseudo ?? Str::slug($influencer->name) }}
                        </p>

                        <p class="text-sm text-gray-600 dark:text-gray-400 leading-relaxed font-medium line-clamp-2 max-w-[240px]">
                            {{ $influencer->professional_title ?? 'Créateur de contenu innovant spécialisé.' }}
                        </p>
                    </div>

                    <div class="mt-8 py-5 border-y border-gray-100 dark:border-white/5 flex items-center justify-between gap-2 px-1">
                        <div class="flex flex-col items-center">
                            <span class="text-[#10B981] font-black text-sm leading-none">12</span>
                            <span class="text-[8px] font-bold text-gray-400 uppercase tracking-tighter mt-1">Campaigns</span>
                        </div>
                        <div class="flex flex-col items-center text-center">
                            <span class="text-gray-900 dark:text-white font-black text-sm leading-none">45.2K</span>
                            <span class="text-[8px] font-bold text-gray-400 uppercase tracking-tighter mt-1">Followers</span>
                        </div>
                        <div class="flex flex-col items-center text-center">
                            <span class="text-gray-900 dark:text-white font-black text-sm leading-none">15K</span>
                            <span class="text-[8px] font-bold text-gray-400 uppercase tracking-tighter mt-1">Vue Moy.</span>
                        </div>
                        <div class="flex flex-col items-center text-center">
                            <span class="text-gray-900 dark:text-white font-black text-sm leading-none">3.2%</span>
                            <span class="text-[8px] font-bold text-gray-400 uppercase tracking-tighter mt-1">Taux Conv.</span>
                        </div>

                        @if($influencer->main_platform && $influencer->profile_url)
                        <a href="{{ $influencer->profile_url }}" target="_blank" class="transition-transform hover:scale-110 flex-shrink-0" title="Voir sur {{ ucfirst($influencer->main_platform->value) }}">
                            @if($influencer->main_platform->value === 'tiktok')
                            <div class="w-8 h-8 rounded-lg bg-black text-white flex items-center justify-center shadow-lg">
                                <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24">
                                    <path d="M12.525.02c1.31-.02 2.61-.01 3.91-.02.08 1.53.63 3.09 1.75 4.17 1.12 1.11 2.7 1.62 4.24 1.79v4.03c-1.44-.05-2.89-.35-4.2-.97-.57-.26-1.1-.59-1.62-.93-.01 2.92.01 5.84-.02 8.75-.03 1.4-.54 2.79-1.35 3.94-1.31 1.92-3.58 3.17-5.91 3.21-1.43.08-2.86-.31-4.08-1.03-2.02-1.19-3.44-3.37-3.65-5.71-.02-.5-.03-1-.01-1.49.18-1.9 1.12-3.72 2.58-4.96a6.66 6.66 0 014.12-1.55c.02 1.48.01 2.96.02 4.44-1.14.01-2.34.42-3.15 1.25-.85.83-1.16 2.05-1.13 3.22.02 1.05.54 2.11 1.34 2.79.82.72 1.96 1.05 3.04.88 1.14-.11 2.19-.85 2.75-1.85.39-.68.53-1.48.51-2.27-.02-3.85-.01-7.7-.02-11.55z" />
                                </svg>
                            </div>
                            @elseif($influencer->main_platform->value === 'instagram')
                            <div class="w-8 h-8 rounded-lg bg-gradient-to-tr from-yellow-400 via-red-500 to-purple-600 text-white flex items-center justify-center shadow-lg">
                                <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24">
                                    <path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zm0-2.163c-3.259 0-3.667.014-4.947.072-4.358.2-6.78 2.618-6.98 6.98-.059 1.281-.073 1.689-.073 4.948 0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98 1.281.058 1.689.072 4.948.072 3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98-1.281-.059-1.69-.073-4.949-.073zm0 5.838c-3.403 0-6.162 2.759-6.162 6.162s2.759 6.163 6.162 6.163 6.162-2.759 6.162-6.163c0-3.403-2.759-6.162-6.162-6.162zm0 10.162c-2.209 0-4-1.79-4-4 0-2.209 1.791-4 4-4s4 1.791 4 4c0 2.21-1.791 4-4 4zm6.406-11.845c-.796 0-1.441.645-1.441 1.44s.645 1.44 1.441 1.44c.795 0 1.439-.645 1.439-1.44s-.644-1.44-1.439-1.44z" />
                                </svg>
                            </div>
                            @elseif($influencer->main_platform->value === 'youtube')
                            <div class="w-8 h-8 rounded-lg bg-red-600 text-white flex items-center justify-center shadow-lg">
                                <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24">
                                    <path d="M23.498 6.186a3.016 3.016 0 0 0-2.122-2.136C19.505 3.545 12 3.545 12 3.545s-7.505 0-9.377.505A3.017 3.017 0 0 0 .502 6.186C0 8.07 0 12 0 12s0 3.93.502 5.814a3.016 3.016 0 0 0 2.122 2.136c1.871.505 9.376.505 9.376.505s7.505 0 9.377-.505a3.015 3.015 0 0 0 2.122-2.136C24 15.93 24 12 24 12s0-3.93-.502-5.814zM9.545 15.568V8.432L15.818 12l-6.273 3.568z" />
                                </svg>
                            </div>
                            @elseif($influencer->main_platform->value === 'linkedin')
                            <div class="w-8 h-8 rounded-lg bg-[#0077b5] text-white flex items-center justify-center shadow-lg">
                                <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24">
                                    <path d="M20.447 20.452h-3.554v-5.569c0-1.328-.027-3.037-1.852-3.037-1.853 0-2.136 1.445-2.136 2.939v5.667H9.351V9h3.414v1.561h.046c.477-.9 1.637-1.85 3.37-1.85 3.601 0 4.267 2.37 4.267 5.455v6.286zM5.337 7.433c-1.144 0-2.063-.926-2.063-2.065 0-1.138.92-2.063 2.063-2.063 1.14 0 2.064.925 2.064 2.063 0 1.139-.925 2.065-2.064 2.065zm1.782 13.019H3.555V9h3.564v11.452zM22.225 0H1.771C.792 0 0 .774 0 1.729v20.542C0 23.227.792 24 1.771 24h20.451C23.2 24 24 23.227 24 22.271V1.729C24 .774 23.2 0 22.222 0h.003z" />
                                </svg>
                            </div>
                            @endif
                        </a>
                        @endif
                    </div>

                    <div class="mt-6 flex gap-2">
                        <a href="{{ route('discussions.index') }}" class="flex-1 inline-flex items-center justify-center gap-2 px-3 py-2.5 rounded-xl bg-primary text-white font-bold text-xs hover:opacity-90 transition-all shadow-sm">
                            <svg class="w-3.5 h-3.5 text-white" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M20 2H4c-1.1 0-2 .9-2 2v18l4-4h14c1.1 0 2-.9 2-2V4c0-1.1-.9-2-2-2z" />
                            </svg>
                            Discuter
                        </a>
                        <a href="{{ route('profile.public', $influencer) }}" class="flex-1 inline-flex items-center justify-center gap-2 px-3 py-2.5 rounded-xl bg-gray-50 dark:bg-white/5 border border-gray-200 dark:border-white/10 text-gray-700 dark:text-gray-300 text-xs font-bold hover:border-accent hover:text-accent transition-all group">
                            Voir profil
                            <svg class="w-3.5 h-3.5 opacity-60 transition-colors group-hover:text-accent group-hover:opacity-100" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"></path>
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
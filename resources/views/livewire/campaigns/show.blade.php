<div class="space-y-8 max-w-6xl mx-auto" x-data="{ 
    selectedPlatform: '{{ !empty($campaign->platforms) ? $campaign->platforms[0] : '' }}',
    platforms: {{ json_encode($campaign->platforms ?? []) }},
    links: {{ json_encode($campaign->content_links ?? []) }},
    statsMode: 'total',
    expandedDescription: false,
    getLink(p) { return this.links[p] || ''; },
    getEmbedUrl(p) {
        const url = this.getLink(p);
        if (!url) return '';
        if (url.includes('youtube.com') || url.includes('youtu.be')) {
            let id = '';
            if (url.includes('v=')) id = url.split('v=')[1].split('&')[0];
            else id = url.split('/').pop().split('?')[0];
            return `https://www.youtube.com/embed/${id}`;
        }
        if (url.includes('tiktok.com')) {
           const parts = url.split('/video/');
           if (parts.length > 1) {
               const id = parts[1].split('?')[0];
               return `https://www.tiktok.com/embed/v2/${id}`;
           }
        }
        return '';
    },
    getLinkType(p) {
        const url = this.getLink(p);
        if (!url) return 'none';
        if (url.match(/\.(jpeg|jpg|gif|png|webp)$/) != null) return 'image';
        if (url.includes('youtube.com') || url.includes('youtu.be')) return 'youtube';
        if (url.includes('tiktok.com') && url.includes('/video/')) return 'tiktok';
        return 'link';
    },
    getStats(p) {
        const seed = p.length;
        return {
            views: (seed * 1234).toLocaleString(),
            likes: (seed * 432).toLocaleString(),
            comments: (seed * 56).toLocaleString(),
            conversion: (5 + (seed % 10)).toFixed(1) + '%'
        };
    },
    globalStats() {
        let v = 0, l = 0, c = 0, conv = 0;
        if (this.platforms.length === 0) return { views: 0, likes: 0, comments: 0, conversion: '0%' };
        this.platforms.forEach(p => {
            const s = p.length;
            v += s * 1234;
            l += s * 432;
            c += s * 56;
            conv += (5 + (s % 10));
        });
        const n = this.platforms.length;
        if (this.statsMode === 'avg') {
            return {
                views: Math.round(v/n).toLocaleString(),
                likes: Math.round(l/n).toLocaleString(),
                comments: Math.round(c/n).toLocaleString(),
                conversion: (conv/n).toFixed(1) + '%'
            };
        }
        return { views: v.toLocaleString(), likes: l.toLocaleString(), comments: c.toLocaleString(), conversion: (conv/n).toFixed(1) + '%' };
    }
}">
    <!-- Header / Navigation -->
    <div class="flex flex-col lg:flex-row lg:items-center justify-between gap-6">
        <div class="flex items-center gap-4">
            <a href="{{ route('campaigns.index') }}" class="p-3 rounded-xl bg-muted text-muted-foreground hover:text-foreground transition-colors shrink-0">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M15 19l-7-7 7-7" />
                </svg>
            </a>
            <div>
                <nav class="flex text-xs font-bold uppercase tracking-widest text-muted-foreground mb-1 gap-2">
                    <a href="{{ route('campaigns.index') }}" class="hover:text-primary transition-colors">Campagnes</a>
                    <span>/</span>
                    <span class="text-foreground">Détails de l'édition</span>
                </nav>
                <h1 class="text-2xl md:text-3xl font-black text-foreground tracking-tight flex items-center gap-3">
                    {{ $campaign->title }}
                    @if($is_active)
                    <span class="flex h-2.5 w-2.5 rounded-full bg-primary animate-pulse" title="Campagne en ligne"></span>
                    @endif
                </h1>
            </div>
        </div>

        <div class="flex flex-col sm:flex-row items-stretch sm:items-center gap-4 w-full lg:w-auto">
            @can('manageParticipants', $campaign)
            <!-- Invitation Form -->
            <div class="flex items-center gap-2 bg-card border border-border p-1.5 rounded-xl shadow-sm w-full sm:w-auto">
                <input type="email" wire:model="inviteEmail" placeholder="Email du partenaire..."
                    class="bg-transparent border-none text-sm sm:text-xs font-bold focus:ring-0 px-3 flex-1 sm:w-48"
                    wire:keydown.enter="invitePartner">
                <button wire:click="invitePartner" class="px-4 py-2.5 sm:py-2 rounded-lg bg-primary text-white text-[10px] font-black uppercase tracking-widest hover:opacity-90 transition-all flex items-center justify-center gap-2 shrink-0">
                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M12 4v16m8-8H4" />
                    </svg>
                    <span class="sm:inline">Inviter</span>
                </button>
            </div>
            @endcan

            <div class="flex flex-col sm:flex-row gap-3 w-full sm:w-auto">
                @can('update', $campaign)
                <!-- Status Toggle -->
                <div x-data="{ active: @entangle('is_active').live }" class="w-full sm:w-auto">
                    <button wire:click="toggleStatus"
                        wire:loading.attr="disabled"
                        type="button"
                        class="h-[48px] sm:h-[44px] w-full flex items-center justify-between px-4 rounded-xl border transition-all duration-300 group sm:min-w-[140px] {{ !$this->isComplete ? 'opacity-50 cursor-not-allowed' : '' }}"
                        :class="active ? 'bg-primary/5 border-primary/30' : 'bg-muted/10 border-border hover:border-muted-foreground/50'"
                        @if(!$this->isComplete) title="Complétez toutes les étapes pour activer" @endif>

                        <div class="flex items-center gap-2.5" wire:loading.remove wire:target="toggleStatus">
                            <div class="w-2 h-2 sm:w-1.5 sm:h-1.5 rounded-full transition-colors"
                                :class="active ? 'bg-primary animate-pulse' : 'bg-muted-foreground/30'"></div>
                            <span class="text-[10px] sm:text-[9px] font-black uppercase tracking-wider transition-colors"
                                :class="active ? 'text-primary' : 'text-muted-foreground'"
                                x-text="active ? 'En ligne' : 'Hors ligne'">
                            </span>
                        </div>

                        <div wire:loading wire:target="toggleStatus" class="flex items-center gap-2">
                            <div class="w-3.5 h-3.5 border-2 border-primary/30 border-t-primary rounded-full animate-spin"></div>
                            <span class="text-[10px] sm:text-[9px] font-black uppercase tracking-wider text-primary">...</span>
                        </div>

                        <div class="ml-3 relative w-8 h-4.5 sm:w-7 sm:h-4 rounded-full transition-colors duration-300"
                            :class="active ? 'bg-primary' : 'bg-muted-foreground/40'">
                            <div class="absolute top-0.5 left-0.5 w-3.5 h-3.5 sm:w-3 sm:h-3 bg-white rounded-full transition-transform duration-300 shadow-sm"
                                :class="active ? 'translate-x-3.5 sm:translate-x-3' : 'translate-x-0'"></div>
                        </div>
                    </button>
                </div>

                <a href="{{ route('campaigns.complete', $campaign) }}" class="h-[48px] sm:h-[44px] px-6 sm:px-5 rounded-xl text-[10px] font-black uppercase tracking-widest bg-accent text-white shadow-lg shadow-accent/20 hover:opacity-90 transition-all flex items-center justify-center gap-2 whitespace-nowrap w-full sm:w-auto">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                    </svg>
                    Modifier / Compléter
                </a>
                @else
                <div class="px-5 py-3 sm:py-2.5 rounded-xl text-[10px] font-black uppercase tracking-widest bg-primary/10 text-primary border border-primary/20 flex items-center justify-center w-full sm:w-auto">
                    Vue Spectateur
                </div>
                @endcan
            </div>
        </div>
    </div>

    @if (session()->has('message'))
    <div class="bg-emerald-500/10 border border-emerald-500/20 text-emerald-500 px-6 py-4 rounded-2xl font-bold flex items-center gap-3">
        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7" />
        </svg>
        {{ session('message') }}
    </div>
    @endif

    @if (session()->has('error'))
    <div class="bg-rose-500/10 border border-rose-500/20 text-rose-500 px-6 py-4 rounded-2xl font-bold flex items-center gap-3">
        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
        </svg>
        {{ session('error') }}
    </div>
    @endif

    @error('inviteEmail')
    <div class="bg-rose-500/10 border border-rose-500/20 text-rose-500 px-6 py-3 rounded-xl text-xs font-bold">
        {{ $message }}
    </div>
    @enderror

    <!-- Global Statistics Summary -->
    <div class="space-y-6">
        <div class="flex items-center justify-between">
            <h3 class="text-[10px] font-black uppercase tracking-widest text-muted-foreground flex items-center gap-2">
                <div class="w-1 h-3 bg-accent rounded-full"></div>
                Performances Globales <span class="text-foreground">Omnicanal</span>
            </h3>

            <!-- Stats Toggle -->
            <div class="flex items-center bg-card border border-border p-1 rounded-xl">
                <button @click="statsMode = 'total'" :class="statsMode === 'total' ? 'bg-muted text-foreground' : 'text-muted-foreground'" class="px-3 py-1.5 rounded-lg text-[9px] font-black uppercase tracking-widest transition-all">Cumulé</button>
                <button @click="statsMode = 'avg'" :class="statsMode === 'avg' ? 'bg-muted text-foreground' : 'text-muted-foreground'" class="px-3 py-1.5 rounded-lg text-[9px] font-black uppercase tracking-widest transition-all">Moyenne</button>
            </div>
        </div>

        <div class="grid grid-cols-2 lg:grid-cols-4 gap-4 md:gap-6">
            <!-- Portée / Vues -->
            <div class="bg-card border border-border p-6 rounded-[2rem] shadow-sm relative overflow-hidden group">
                <div class="absolute top-0 right-0 w-24 h-24 bg-primary/5 rounded-full blur-2xl -mr-12 -mt-12"></div>
                <div class="flex items-center justify-between mb-4">
                    <p class="text-[9px] font-black uppercase tracking-widest text-muted-foreground" x-text="statsMode === 'avg' ? 'Portée Moyenne' : 'Portée Totale'"></p>
                    <div class="p-2 rounded-lg bg-primary/10 text-primary">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                        </svg>
                    </div>
                </div>
                <p class="text-2xl font-black text-foreground tabular-nums tracking-tight" x-text="globalStats().views"></p>
            </div>

            <!-- Engagement / J'aime -->
            <div class="bg-card border border-border p-6 rounded-[2rem] shadow-sm relative overflow-hidden group">
                <div class="absolute top-0 right-0 w-24 h-24 bg-rose-500/5 rounded-full blur-2xl -mr-12 -mt-12"></div>
                <div class="flex items-center justify-between mb-4">
                    <p class="text-[9px] font-black uppercase tracking-widest text-muted-foreground" x-text="statsMode === 'avg' ? 'Engagement Moyen' : 'Engagement Total'"></p>
                    <div class="p-2 rounded-lg bg-rose-500/10 text-rose-500">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z" />
                        </svg>
                    </div>
                </div>
                <p class="text-2xl font-black text-foreground tabular-nums tracking-tight" x-text="globalStats().likes"></p>
            </div>

            <!-- Interaction / Commentaires -->
            <div class="bg-card border border-border p-6 rounded-[2rem] shadow-sm relative overflow-hidden group">
                <div class="absolute top-0 right-0 w-24 h-24 bg-orange-500/5 rounded-full blur-2xl -mr-12 -mt-12"></div>
                <div class="flex items-center justify-between mb-4">
                    <p class="text-[9px] font-black uppercase tracking-widest text-muted-foreground" x-text="statsMode === 'avg' ? 'Interaction Moyenne' : 'Interaction Totale'"></p>
                    <div class="p-2 rounded-lg bg-orange-500/10 text-orange-500">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z" />
                        </svg>
                    </div>
                </div>
                <p class="text-2xl font-black text-foreground tabular-nums tracking-tight" x-text="globalStats().comments"></p>
            </div>

            <!-- Conversion Rate -->
            <div class="bg-card border border-border p-6 rounded-[2rem] shadow-sm relative overflow-hidden group">
                <div class="absolute top-0 right-0 w-24 h-24 bg-accent/5 rounded-full blur-2xl -mr-12 -mt-12"></div>
                <div class="flex items-center justify-between mb-4">
                    <p class="text-[9px] font-black uppercase tracking-widest text-muted-foreground">Taux de Conversion</p>
                    <div class="p-2 rounded-lg bg-accent/10 text-accent">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6" />
                        </svg>
                    </div>
                </div>
                <p class="text-2xl font-black text-accent tabular-nums tracking-tight" x-text="globalStats().conversion"></p>
            </div>
        </div>
    </div>

    <!-- Main Content Grid -->
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8 lg:items-stretch">

        <!-- Left Column: Primary Content (2/3) -->
        <div class="lg:col-span-2 space-y-8">
            <!-- 1. Identity, Description & Content Preview -->
            <div class="bg-card rounded-[2rem] md:rounded-[2.5rem] border border-border p-6 md:p-10 shadow-sm relative overflow-hidden h-full flex flex-col">
                <div class="absolute top-0 right-0 w-64 h-64 bg-primary/5 rounded-full blur-3xl -mr-32 -mt-32"></div>

                <div class="relative text-left">
                    <div class="flex items-center gap-3 mb-6">
                        <span class="px-3 py-1 rounded-full bg-primary/10 text-primary text-[10px] font-black uppercase tracking-widest">
                            {{ $campaign->content_type?->label() ?? 'Édition standard' }}
                        </span>
                        <div class="h-px flex-1 bg-border/50"></div>
                    </div>

                    <h2 class="text-2xl font-black text-foreground tracking-tight mb-4 leading-tight">{{ $campaign->short_description }}</h2>

                    <!-- Platform Selector & Preview Section -->
                    <div class="mt-8 space-y-8 flex-none">
                        <div class="flex flex-col md:flex-row md:items-center justify-between gap-6">
                            <div>
                                <h3 class="text-lg font-black text-foreground tracking-tight">Réseaux & <span class="text-accent italic">Aperçus</span></h3>
                                <p class="text-[10px] font-black uppercase tracking-widest text-muted-foreground mt-1">Cliquez sur une plateforme pour charger le contenu</p>
                            </div>

                            <!-- Platform Tabs -->
                            <div class="flex flex-wrap gap-2">
                                @foreach($campaign->platforms ?? [] as $platformValue)
                                @php $platform = \App\Enums\MainPlatform::tryFrom($platformValue); @endphp
                                @if($platform)
                                <button
                                    @click="selectedPlatform = '{{ $platformValue }}'"
                                    :class="selectedPlatform === '{{ $platformValue }}' ? 'bg-accent text-white shadow-lg shadow-accent/20 scale-105' : 'bg-muted/30 text-muted-foreground hover:bg-muted/50'"
                                    class="px-4 py-2.5 rounded-2xl transition-all duration-300 flex items-center gap-3 group border border-transparent"
                                    title="{{ $platform->label() }}">
                                    <span class="text-[10px] font-black uppercase tracking-widest">{{ $platform->label() }}</span>
                                    <div class="w-1.5 h-1.5 rounded-full" :class="selectedPlatform === '{{ $platformValue }}' ? 'bg-white' : 'bg-muted-foreground/30'"></div>
                                </button>
                                @endif
                                @endforeach
                            </div>
                        </div>

                        <!-- Content Preview Area -->
                        <div class="relative group">
                            <!-- Empty State / No Platform Selected -->
                            <template x-if="!selectedPlatform">
                                <div class="aspect-video rounded-[2.5rem] bg-muted/20 border-2 border-dashed border-border flex flex-col items-center justify-center text-muted-foreground p-10 text-center">
                                    <div class="w-16 h-16 rounded-2xl bg-muted/40 flex items-center justify-center mb-6">
                                        <svg class="w-8 h-8 opacity-20" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 4v16M17 4v16M3 8h4m10 0h4M3 12h18M3 16h4m10 0h4M4 20h16a1 1 0 001-1V5a1 1 0 00-1-1H4a1 1 0 00-1 1v14a1 1 0 001 1z" />
                                        </svg>
                                    </div>
                                    <p class="text-[10px] font-black uppercase tracking-widest max-w-[200px] leading-relaxed">Sélectionnez un réseau pour visualiser la diffusion</p>
                                </div>
                            </template>

                            <!-- Dynamic Preview Content -->
                            <template x-if="selectedPlatform">
                                <div class="space-y-4">
                                    <!-- URL Display -->
                                    <div class="flex items-center gap-3 px-6 py-4 rounded-2xl bg-muted/10 border border-border/50">
                                        <div class="p-2.5 rounded-xl bg-accent/10 text-accent">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.828 10.172a4 4 0 00-5.656 0l-4 4a4 4 0 105.656 5.656l1.102-1.101m-.758-4.828a4 4 0 005.656 0l4-4a4 4 0 00-5.656-5.656l-1.1 1.1" />
                                            </svg>
                                        </div>
                                        <div class="flex-1 min-w-0">
                                            <p class="text-[8px] font-black uppercase tracking-widest text-muted-foreground leading-none mb-1">Lien direct</p>
                                            <p class="text-[11px] font-bold text-foreground truncate" x-text="getLink(selectedPlatform)"></p>
                                        </div>
                                        <a :href="getLink(selectedPlatform)" target="_blank" class="px-4 py-2 rounded-lg bg-card border border-border text-[9px] font-black uppercase tracking-widest text-foreground hover:text-accent transition-colors flex items-center gap-2">
                                            Visiter
                                            <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14" />
                                            </svg>
                                        </a>
                                    </div>

                                    <!-- The Preview Frame -->
                                    <div class="relative aspect-video rounded-[2.5rem] overflow-hidden bg-black border border-border shadow-2xl">
                                        <!-- Loader -->
                                        <div class="absolute inset-0 flex items-center justify-center bg-black/50 backdrop-blur-sm z-0">
                                            <div class="w-8 h-8 border-4 border-accent border-t-transparent rounded-full animate-spin"></div>
                                        </div>

                                        <!-- Image Preview -->
                                        <template x-if="getLinkType(selectedPlatform) === 'image'">
                                            <img :src="getLink(selectedPlatform)" class="relative z-10 w-full h-full object-contain bg-muted/10">
                                        </template>

                                        <!-- Embed Frame for YouTube/TikTok -->
                                        <template x-if="['youtube', 'tiktok'].includes(getLinkType(selectedPlatform))">
                                            <iframe
                                                :src="getEmbedUrl(selectedPlatform)"
                                                class="relative z-10 w-full h-full border-0"
                                                allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
                                                allowfullscreen></iframe>
                                        </template>

                                        <!-- Fallback for generic links -->
                                        <template x-if="getLinkType(selectedPlatform) === 'link'">
                                            <div class="absolute inset-0 z-10 flex flex-col items-center justify-center p-12 text-center bg-gradient-to-br from-card to-muted/20">
                                                <div class="w-24 h-24 rounded-[2.5rem] bg-accent/10 flex items-center justify-center text-accent mb-8">
                                                    <svg class="w-10 h-10" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14" />
                                                    </svg>
                                                </div>
                                                <h4 class="text-xl font-black text-foreground tracking-tight mb-3">Aperçu protégé</h4>
                                                <p class="text-xs text-muted-foreground font-medium max-w-sm mx-auto leading-relaxed">Cette plateforme restreint l'affichage direct pour des raisons de sécurité. Vous pouvez consulter le contenu en cliquant sur le bouton ci-dessous.</p>
                                                <a :href="getLink(selectedPlatform)" target="_blank" class="mt-8 px-8 py-4 rounded-2xl bg-accent text-white text-[10px] font-black uppercase tracking-widest transition-all hover:shadow-xl hover:shadow-accent/40 active:scale-95">Explorer la publication</a>
                                            </div>
                                        </template>

                                        <!-- No Link Warning -->
                                        <template x-if="getLinkType(selectedPlatform) === 'none'">
                                            <div class="absolute inset-0 z-10 flex flex-col items-center justify-center p-12 text-center bg-muted/20">
                                                <div class="p-4 rounded-2xl bg-rose-500/10 text-rose-500 mb-4 font-black text-[10px] uppercase tracking-widest">Lien manquant</div>
                                                <p class="text-xs text-muted-foreground">Aucune URL n'a été renseignée pour cette plateforme.</p>
                                            </div>
                                        </template>
                                    </div>
                                </div>
                            </template>
                        </div>
                    </div>

                    <div class="mt-12 pt-10 border-t border-border/50 flex-1 flex flex-col min-h-0">
                        <div class="flex items-center gap-2 mb-6 flex-none">
                            <h3 class="text-[9px] font-black uppercase tracking-widest text-muted-foreground">Détails de la <span class="text-foreground">Campagne</span></h3>
                            <div class="h-px flex-1 bg-border/30"></div>
                        </div>

                        <div class="relative flex-1 overflow-hidden transition-all duration-500 min-h-0" :class="expandedDescription ? 'max-h-[2000px]' : 'max-h-full'">
                            <div class="prose dark:prose-invert max-w-none">
                                <div class="text-sm text-foreground/70 leading-relaxed space-y-4 text-left">
                                    @if($campaign->description)
                                    {!! $campaign->description !!}
                                    @else
                                    <p class="italic text-muted-foreground">Aucune description détaillée n'a été ajoutée pour le moment.</p>
                                    @endif
                                </div>
                            </div>

                            <!-- Gradient Fade for 'Voir plus' -->
                            <div x-show="!expandedDescription" class="absolute bottom-0 left-0 right-0 h-32 bg-gradient-to-t from-card to-transparent pointer-events-none"></div>
                        </div>

                        <!-- Read More / Less Toggle -->
                        @if($campaign->description)
                        <div class="mt-6 flex justify-center flex-none">
                            <button @click="expandedDescription = !expandedDescription" class="flex items-center gap-2 px-6 py-2.5 rounded-2xl bg-muted/30 border border-border text-[10px] font-black uppercase tracking-widest text-foreground hover:bg-accent hover:text-white hover:border-accent transition-all duration-300">
                                <span x-text="expandedDescription ? 'Réduire' : 'Lire la suite'"></span>
                                <svg class="w-3 h-3 transition-transform duration-300" :class="expandedDescription ? 'rotate-180' : ''" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M19 9l-7 7-7-7" />
                                </svg>
                            </button>
                        </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>

        <!-- Right Column: Lead Form & Partners (1/3) -->
        <div class="space-y-8">
            <!-- 2. Partners List / Collaboration -->
            <div class="bg-card rounded-[2.5rem] border border-border p-8 shadow-sm">
                <div class="flex items-center justify-between mb-6">
                    <div class="flex items-center gap-2">
                        <h3 class="text-[9px] font-black uppercase tracking-widest text-muted-foreground">Collaboration</h3>
                        <span class="px-2 py-0.5 rounded-lg bg-muted text-[10px] font-black text-muted-foreground leading-none">{{ $campaign->participants->count() }}</span>
                    </div>
                </div>

                <div class="space-y-3">
                    @forelse($campaign->participants as $participant)
                    <div class="flex items-center justify-between p-3 rounded-2xl bg-muted/10 border border-border/50">
                        <div class="flex items-center gap-3">
                            @if($participant->profile_photo_path)
                            <img src="{{ asset('storage/'.$participant->profile_photo_path) }}" class="w-8 h-8 rounded-lg object-cover">
                            @else
                            <div class="w-8 h-8 rounded-lg bg-primary/10 text-primary flex items-center justify-center text-[10px] font-black">
                                {{ substr($participant->name, 0, 1) }}
                            </div>
                            @endif
                            <span class="text-xs font-bold text-foreground">{{ $participant->enterpriseProfile->company_name ?? $participant->name }}</span>
                        </div>
                        <div class="flex items-center gap-2">
                            @if($participant->pivot->status === 'pending')
                            <span class="text-[7px] font-black uppercase px-2 py-1 rounded-md bg-amber-500/10 text-amber-500 border border-amber-500/20 leading-none">
                                En attente
                            </span>
                            @can('manageParticipants', $campaign)
                            <button wire:click="removeParticipant({{ $participant->id }})"
                                class="p-1 rounded bg-rose-500/10 text-rose-500 hover:bg-rose-500 hover:text-white transition-all"
                                title="Annuler l'invitation">
                                <svg class="w-2.5 h-2.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M6 18L18 6M6 6l12 12" />
                                </svg>
                            </button>
                            @endcan
                            @else
                            <span class="text-[7px] font-black uppercase px-2 py-1 rounded-md bg-emerald-500/10 text-emerald-500 border border-emerald-500/20 leading-none">
                                Collaborateur
                            </span>
                            @can('manageParticipants', $campaign)
                            <button wire:click="removeParticipant({{ $participant->id }})"
                                class="p-1 rounded bg-rose-500/10 text-rose-500 hover:bg-rose-500 hover:text-white transition-all"
                                title="Retirer le collaborateur">
                                <svg class="w-2.5 h-2.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                </svg>
                            </button>
                            @endcan
                            @endif
                        </div>
                    </div>
                    @empty
                    <p class="text-center py-6 text-[10px] text-muted-foreground italic font-medium">Aucun partenaire invité.</p>
                    @endforelse
                </div>
            </div>

            <!-- 2.5 New Stats Container -->
            <div class="bg-card rounded-[2.5rem] border border-border p-8 shadow-sm relative overflow-hidden" x-show="selectedPlatform">
                <div class="absolute top-0 left-0 w-32 h-32 bg-accent/5 rounded-full blur-2xl -ml-16 -mt-16"></div>

                <div class="relative">
                    <div class="flex items-center justify-between mb-8">
                        <div>
                            <h3 class="text-[9px] font-black uppercase tracking-widest text-muted-foreground leading-none mb-1">Performance</h3>
                            <p class="text-sm font-black text-foreground tracking-tight italic" x-text="selectedPlatform.toUpperCase()"></p>
                        </div>
                        <div class="p-2 rounded-lg bg-accent/10 text-accent">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6" />
                            </svg>
                        </div>
                    </div>

                    <div class="grid grid-cols-2 gap-6">
                        <!-- Stat 1: Views -->
                        <div class="space-y-1 text-left">
                            <p class="text-[8px] font-black uppercase tracking-widest text-muted-foreground">Vues</p>
                            <p class="text-lg font-black text-foreground leading-none tabular-nums" x-text="getStats(selectedPlatform).views"></p>
                        </div>
                        <!-- Stat 2: Likes -->
                        <div class="space-y-1 text-left">
                            <p class="text-[8px] font-black uppercase tracking-widest text-muted-foreground">J'aime</p>
                            <p class="text-lg font-black text-foreground leading-none tabular-nums" x-text="getStats(selectedPlatform).likes"></p>
                        </div>
                        <!-- Stat 3: Comments -->
                        <div class="space-y-1 text-left">
                            <p class="text-[8px] font-black uppercase tracking-widest text-muted-foreground">Commentaires</p>
                            <p class="text-lg font-black text-foreground leading-none tabular-nums" x-text="getStats(selectedPlatform).comments"></p>
                        </div>
                        <!-- Stat 4: Conversion -->
                        <div class="space-y-1 text-left">
                            <p class="text-[8px] font-black uppercase tracking-widest text-accent">Conversion</p>
                            <p class="text-lg font-black text-accent leading-none tabular-nums" x-text="getStats(selectedPlatform).conversion"></p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- 3. Lead Form Preview Card -->
            <div class="bg-card rounded-[2.5rem] border border-border p-8 md:p-10 shadow-sm relative overflow-hidden text-left">
                <div class="absolute bottom-0 right-0 w-48 h-48 bg-primary/5 rounded-full blur-3xl -mr-24 -mb-24"></div>

                <div class="flex items-center justify-between mb-8">
                    <div class="flex items-center gap-3">
                        <div class="p-2.5 rounded-xl bg-primary/10 text-primary">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
                            </svg>
                        </div>
                        <div>
                            <h3 class="text-lg font-black text-foreground tracking-tight">Configuration <span class="text-primary italic">Capture</span></h3>
                        </div>
                    </div>

                    <div class="text-right">
                        <div class="text-[10px] font-black uppercase tracking-widest text-muted-foreground leading-none mb-1">Leads Collectés</div>
                        <div class="text-2xl font-black text-accent leading-none tabular-nums">{{ $leadsCount }}</div>
                    </div>
                </div>

                <div class="space-y-4">
                    <div class="flex flex-wrap gap-2">
                        @php $fields = $campaign->lead_form_settings['fields'] ?? []; @endphp
                        @forelse($fields as $field)
                        <span class="px-3 py-1.5 rounded-lg bg-muted/30 border border-border text-[10px] font-bold text-foreground flex items-center gap-1.5">
                            {{ $field['label'] }}
                            @if($field['required'] ?? false) <span class="text-rose-500">*</span> @endif
                        </span>
                        @empty
                        <p class="text-xs text-muted-foreground italic">Aucun champ configuré.</p>
                        @endforelse
                    </div>

                    @if($campaign->slug)
                    <div class="pt-6 mt-6 border-t border-border space-y-6">
                        <div>
                            <span class="text-[9px] font-black uppercase tracking-widest text-muted-foreground block mb-3">Lien de Capture Public</span>
                            <div class="flex items-center gap-2 bg-muted/30 p-3 rounded-2xl border border-border/50">
                                <p class="flex-1 text-[10px] font-bold text-primary truncate">{{ route('campaigns.public-form', $campaign->slug) }}</p>
                                <button onclick="navigator.clipboard.writeText('{{ route('campaigns.public-form', $campaign->slug) }}'); alert('Lien copié !')"
                                    class="p-2 rounded-lg bg-card border border-border text-muted-foreground hover:text-primary transition-colors shrink-0">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 5H6a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2v-1M8 5a2 2 0 002 2h2a2 2 0 002-2M8 5a2 2 0 012-2h2a2 2 0 012 2m0 0h2a2 2 0 012 2v3m2 4H10m0 0l3-3m-3 3l3 3" />
                                    </svg>
                                </button>
                            </div>
                        </div>

                        <div class="space-y-3">
                            <span class="text-[9px] font-black uppercase tracking-widest text-muted-foreground block">Intégration Externe</span>

                            @if(auth()->user()->google_token) {{-- Simulated field --}}
                            <button wire:click="exportToGoogleSheets" class="w-full flex items-center justify-between p-4 rounded-2xl bg-accent/5 border border-accent/20 hover:bg-accent/10 transition-all group">
                                <div class="flex items-center gap-3 text-left">
                                    <div class="p-2 rounded-xl bg-accent/10 text-accent">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 17v-2m3 2v-4m3 4v-6m2 10H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                                        </svg>
                                    </div>
                                    <div>
                                        <p class="text-[10px] font-black uppercase tracking-widest text-accent leading-none mb-1">Google Sheets</p>
                                        <p class="text-xs font-bold text-foreground">Exporter les données</p>
                                    </div>
                                </div>
                                <svg class="w-4 h-4 text-accent/40 group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M9 5l7 7-7 7" />
                                </svg>
                            </button>
                            @else
                            <button wire:click="connectGoogle" class="w-full flex items-center justify-between p-4 rounded-2xl bg-muted/10 border border-border hover:bg-muted/20 transition-all group">
                                <div class="flex items-center gap-3 text-left">
                                    <div class="p-2 rounded-xl bg-blue-500/10 text-blue-500">
                                        <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24">
                                            <path d="M12.48 10.92v3.28h7.84c-.24 1.84-.908 3.153-1.859 4.133-1.571 1.571-3.906 3.153-7.981 3.153-6.505 0-11.513-5.291-11.513-11.931s5.008-11.931 11.513-11.931c3.58 0 6.505 1.417 8.659 3.593l2.251-2.251c-2.433-2.339-5.602-4.14-10.91-4.14-9.98 0-18 8.02-18 18s8.02 18 18 18c5.4 0 9.507-1.8 12.607-5.04s4.04-7.68 4.04-10.92c0-1.08-.08-2.12-.24-3.12h-16.407z" />
                                        </svg>
                                    </div>
                                    <div>
                                        <p class="text-[10px] font-black uppercase tracking-widest text-muted-foreground leading-none mb-1">Google Sheets</p>
                                        <p class="text-xs font-bold text-foreground">Se connecter pour exporter</p>
                                    </div>
                                </div>
                                <div class="w-6 h-6 rounded-lg bg-card border border-border flex items-center justify-center text-muted-foreground group-hover:bg-accent group-hover:text-white transition-colors">
                                    <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M12 4v16m8-8H4" />
                                    </svg>
                                </div>
                            </button>
                            @endif
                        </div>
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <!-- 4. Lower Row: Meta Info -->
    <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
        <!-- Creator -->
        <div class="bg-card rounded-[2.5rem] border border-border p-8 shadow-sm">
            <h3 class="text-[9px] font-black uppercase tracking-widest text-muted-foreground mb-6 text-left">Initialisée par</h3>
            <div class="flex items-center gap-4 py-3 px-4 rounded-2xl bg-accent/5 border border-accent/10">
                @if($campaign->user->profile_photo_path)
                <img src="{{ asset('storage/'.$campaign->user->profile_photo_path) }}" class="w-12 h-12 rounded-xl object-cover shadow-lg">
                @else
                <div class="w-12 h-12 rounded-xl bg-accent flex items-center justify-center text-white font-black text-lg shadow-lg shadow-accent/20">
                    {{ substr($campaign->user->first_name ?? $campaign->user->name, 0, 1) }}
                </div>
                @endif
                <div class="text-left">
                    <p class="font-bold text-foreground text-base leading-tight">{{ $campaign->user->first_name }} {{ $campaign->user->last_name }}</p>
                    <p class="text-[10px] text-muted-foreground font-black uppercase tracking-wider mt-1">{{ $campaign->user->role->label() }}</p>
                </div>
            </div>
        </div>

        <!-- Activity -->
        <div class="bg-card rounded-[2.5rem] border border-border p-8 shadow-sm">
            <h3 class="text-[9px] font-black uppercase tracking-widest text-muted-foreground mb-6 text-left">Activité Temporelle</h3>
            <div class="space-y-6 relative before:absolute before:inset-0 before:left-0 before:w-px before:bg-border before:ml-2.5">
                <div class="relative pl-8 text-left">
                    <div class="absolute left-0 top-1.5 w-2.5 h-2.5 rounded-full bg-primary ring-4 ring-primary/10 z-10"></div>
                    <p class="text-xs font-bold text-foreground leading-none">Édition créée</p>
                    <p class="text-[10px] text-muted-foreground mt-1.5 font-medium leading-none">{{ $campaign->created_at->format('d M, Y \à H:i') }}</p>
                </div>
                <div class="relative pl-8 text-left opacity-60">
                    <div class="absolute left-0 top-1.5 w-2.5 h-2.5 rounded-full bg-border z-10"></div>
                    <p class="text-xs font-bold text-foreground leading-none">Dernière mise à jour</p>
                    <p class="text-[10px] text-muted-foreground mt-1.5 font-medium leading-none">{{ $campaign->updated_at->format('d M, Y \à H:i') }}</p>
                </div>
            </div>
        </div>
    </div>
</div>
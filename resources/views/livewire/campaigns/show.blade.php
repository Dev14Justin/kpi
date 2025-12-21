<div class="space-y-8">
    <!-- Header / Navigation -->
    <div class="flex flex-col md:flex-row md:items-center justify-between gap-4">
        <div class="flex items-center gap-4">
            <a href="{{ route('campaigns.index') }}" class="p-3 rounded-xl bg-muted text-muted-foreground hover:text-foreground transition-colors">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M15 19l-7-7 7-7" />
                </svg>
            </a>
            <div>
                <nav class="flex text-xs font-bold uppercase tracking-widest text-muted-foreground mb-1 gap-2">
                    <a href="{{ route('campaigns.index') }}" class="hover:text-primary transition-colors">Campagnes</a>
                    <span>/</span>
                    <span class="text-foreground">Détails</span>
                </nav>
                <h1 class="text-3xl font-black text-foreground tracking-tight">{{ $campaign->title }}</h1>
            </div>
        </div>

        <div class="flex items-center gap-3">
            @can('update', $campaign)
            <select wire:model.live="newStatus" wire:change="updateStatus" class="bg-card border border-border rounded-xl px-4 py-2 text-sm font-bold text-foreground outline-none focus:ring-4 focus:ring-primary/10 transition-all">
                @foreach(\App\Enums\CampaignStatus::cases() as $status)
                <option value="{{ $status->value }}">{{ $status->label() }}</option>
                @endforeach
            </select>
            @else
            <span class="px-4 py-2 rounded-xl text-sm font-bold bg-{{ $campaign->status->color() }}-500/10 text-{{ $campaign->status->color() }}-500 border border-{{ $campaign->status->color() }}-500/20">
                {{ $campaign->status->label() }}
            </span>
            @endcan
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

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        <!-- Left Column: Details & Description -->
        <div class="lg:col-span-2 space-y-8">
            <div class="bg-card rounded-[2rem] border border-border p-8 md:p-10 shadow-sm">
                <h2 class="text-[10px] font-black uppercase tracking-widest text-muted-foreground mb-4">À propos de la campagne</h2>
                <div class="prose dark:prose-invert max-w-none">
                    <p class="text-lg text-foreground/80 leading-relaxed">
                        {{ $campaign->description ?: 'Aucune description détaillée.' }}
                    </p>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mt-10 pt-10 border-t border-border">
                    <div>
                        <span class="text-[10px] font-black uppercase tracking-widest text-muted-foreground block mb-2">Budget</span>
                        <p class="text-2xl font-black text-primary">{{ $campaign->budget ? number_format($campaign->budget, 0, ',', ' ') . ' €' : 'Non défini' }}</p>
                    </div>
                    <div>
                        <span class="text-[10px] font-black uppercase tracking-widest text-muted-foreground block mb-2">Début</span>
                        <p class="text-lg font-bold text-foreground">{{ $campaign->start_date ? $campaign->start_date->format('d M Y') : 'À venir' }}</p>
                    </div>
                    <div>
                        <span class="text-[10px] font-black uppercase tracking-widest text-muted-foreground block mb-2">Fin</span>
                        <p class="text-lg font-bold text-foreground">{{ $campaign->end_date ? $campaign->end_date->format('d M Y') : 'À venir' }}</p>
                    </div>
                </div>
            </div>

            <!-- Timeline / Progress (Mockup for "Evolution") -->
            <div class="bg-card rounded-[2rem] border border-border p-8 md:p-10 shadow-sm">
                <h2 class="text-[10px] font-black uppercase tracking-widest text-muted-foreground mb-8 text-center">Évolution de la campagne</h2>
                <div class="relative pl-8 space-y-8 before:absolute before:inset-0 before:left-[11px] before:w-1 before:bg-muted before:rounded-full">
                    <div class="relative">
                        <div class="absolute -left-8 top-1.5 w-6 h-6 rounded-full bg-primary border-4 border-card z-10"></div>
                        <h4 class="font-bold text-foreground">Création de la campagne</h4>
                        <p class="text-sm text-muted-foreground mt-1">La campagne a été initialisée par {{ $campaign->user->name }}.</p>
                        <span class="text-[10px] font-bold text-muted-foreground/50 uppercase mt-2 block">{{ $campaign->created_at->format('d/m/Y H:i') }}</span>
                    </div>
                    <div class="relative opacity-60">
                        <div class="absolute -left-8 top-1.5 w-6 h-6 rounded-full bg-muted border-4 border-card z-10"></div>
                        <h4 class="font-bold text-foreground">Validation des partenaires</h4>
                        <p class="text-sm text-muted-foreground mt-1">En attente de réponse des entreprises invitées.</p>
                    </div>
                    <div class="relative opacity-30">
                        <div class="absolute -left-8 top-1.5 w-6 h-6 rounded-full bg-muted border-4 border-card z-10"></div>
                        <h4 class="font-bold text-foreground">Lancement officiel</h4>
                        <p class="text-sm text-muted-foreground mt-1">Début de la diffusion du contenu.</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Right Column: Partners & Creator -->
        <div class="space-y-8">
            <!-- Creator info -->
            <div class="bg-card rounded-[2rem] border border-border p-6 shadow-sm">
                <h3 class="text-[10px] font-black uppercase tracking-widest text-muted-foreground mb-4">Initié par</h3>
                <div class="flex items-center gap-4">
                    @if($campaign->user->profile_photo_path)
                    <img src="{{ asset('storage/'.$campaign->user->profile_photo_path) }}" class="w-12 h-12 rounded-2xl object-cover shadow-lg">
                    @else
                    <div class="w-12 h-12 rounded-2xl bg-accent flex items-center justify-center text-white font-black text-lg">
                        {{ substr($campaign->user->first_name ?? $campaign->user->name, 0, 1) }}
                    </div>
                    @endif
                    <div>
                        <p class="font-bold text-foreground">{{ $campaign->user->first_name }} {{ $campaign->user->last_name }}</p>
                        <p class="text-xs text-muted-foreground font-medium">{{ $campaign->user->role->label() }}</p>
                    </div>
                </div>
            </div>

            <!-- Participants list -->
            <div class="bg-card rounded-[2rem] border border-border p-6 shadow-sm">
                <div class="flex items-center justify-between mb-6">
                    <h3 class="text-[10px] font-black uppercase tracking-widest text-muted-foreground">Partenaires</h3>
                    <span class="px-2 py-0.5 rounded-lg bg-muted text-[10px] font-black text-muted-foreground">{{ $campaign->participants->count() }}</span>
                </div>

                <div class="space-y-4">
                    @forelse($campaign->participants as $participant)
                    <div class="flex items-center justify-between p-3 rounded-2xl bg-background border border-border/50">
                        <div class="flex items-center gap-3">
                            @if($participant->profile_photo_path)
                            <img src="{{ asset('storage/'.$participant->profile_photo_path) }}" class="w-8 h-8 rounded-lg object-cover">
                            @else
                            <div class="w-8 h-8 rounded-lg bg-primary/20 text-primary flex items-center justify-center text-[10px] font-black">
                                {{ substr($participant->name, 0, 1) }}
                            </div>
                            @endif
                            <span class="text-xs font-bold text-foreground">{{ $participant->enterpriseProfile->company_name ?? $participant->name }}</span>
                        </div>
                        <span class="text-[8px] font-black uppercase px-2 py-1 rounded-md bg-amber-500/10 text-amber-500 border border-amber-500/20">
                            {{ $participant->pivot->status }}
                        </span>
                    </div>
                    @empty
                    <p class="text-center py-6 text-xs text-muted-foreground italic font-medium">Aucun partenaire invité pour le moment.</p>
                    @endforelse
                </div>

                @can('update', $campaign)
                <button class="w-full mt-6 py-3 rounded-xl bg-muted text-foreground hover:bg-primary hover:text-primary-foreground transition-all text-[10px] font-black uppercase tracking-widest">
                    Inviter un partenaire
                </button>
                @endcan
            </div>
        </div>
    </div>
</div>
<div class="space-y-8">
    <!-- Header Section -->
    <div class="flex flex-col md:flex-row md:items-center justify-between gap-4">
        <div>
            <h1 class="text-3xl font-black text-foreground tracking-tight">Mes <span class="text-primary italic border-b-4 border-primary/30">Campagnes</span></h1>
            <p class="text-muted-foreground font-medium mt-1">Gérez vos stratégies marketing et suivez vos collaborations.</p>
        </div>

        @if(auth()->user()->role !== \App\Enums\UserRole::Enterprise)
        <button @click="$wire.openCreateModal()" class="inline-flex items-center justify-center gap-2 px-6 py-3 rounded-xl bg-primary text-primary-foreground font-bold shadow-lg shadow-primary/20 hover:opacity-90 transition-all">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 4v16m8-8H4" />
            </svg>
            Créer une campagne
        </button>
        @endif
    </div>

    <!-- Flash Messages -->
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

    <!-- Campaigns Grid -->
    @if($campaigns->isEmpty())
    <div class="bg-card rounded-[2rem] p-20 border border-dashed border-border text-center">
        <div class="w-20 h-20 bg-muted rounded-2xl flex items-center justify-center mx-auto mb-6 text-muted-foreground/50">
            <svg class="w-10 h-10" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path>
            </svg>
        </div>
        <p class="text-muted-foreground font-medium italic text-lg">Aucune campagne disponible pour le moment.</p>
        @if(auth()->user()->role !== \App\Enums\UserRole::Enterprise)
        <button @click="$wire.openCreateModal()" class="mt-6 text-primary font-bold hover:underline">Lancez votre première campagne dès maintenant</button>
        @endif
    </div>
    @else
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        @foreach($campaigns as $campaign)
        <div class="group bg-card rounded-2xl border border-border p-6 hover:border-primary hover:ring-4 hover:ring-primary/10 transition-all duration-300 flex flex-col shadow-sm">
            <div class="flex items-start justify-between mb-4">
                <div class="p-3 bg-primary/10 rounded-xl text-primary">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path>
                    </svg>
                </div>
                <span class="px-3 py-1 rounded-full text-[10px] font-black uppercase tracking-widest bg-{{ $campaign->status->color() }}-500/10 text-{{ $campaign->status->color() }}-500 border border-{{ $campaign->status->color() }}-500/20">
                    {{ $campaign->status->label() }}
                </span>
            </div>

            <h3 class="text-xl font-bold text-foreground mb-2 group-hover:text-primary transition-colors">
                {{ $campaign->title }}
            </h3>

            <p class="text-sm text-muted-foreground font-medium line-clamp-2 mb-6 flex-1">
                {{ $campaign->description ?: 'Aucune description fournie.' }}
            </p>

            <div class="space-y-4 pt-4 border-t border-border">
                <div class="flex items-center justify-between text-xs font-bold uppercase tracking-widest">
                    <span class="text-muted-foreground flex items-center gap-2">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                        Budget
                    </span>
                    <span class="text-foreground italic">{{ $campaign->budget ? number_format($campaign->budget, 0, ',', ' ') . ' €' : 'Non défini' }}</span>
                </div>

                <div class="flex items-center justify-between text-xs font-bold uppercase tracking-widest">
                    <span class="text-muted-foreground flex items-center gap-2">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                        </svg>
                        Échéance
                    </span>
                    <span class="text-foreground italic">{{ $campaign->end_date ? $campaign->end_date->format('d/m/Y') : 'À définir' }}</span>
                </div>
            </div>

            <div class="mt-6">
                <a href="{{ route('campaigns.show', $campaign) }}" class="w-full inline-flex items-center justify-center gap-2 px-4 py-3 rounded-xl bg-muted text-foreground font-bold text-xs hover:bg-primary hover:text-primary-foreground transition-all">
                    Gérer la campagne
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M14 5l7 7m0 0l-7 7m7-7H3" />
                    </svg>
                </a>
            </div>
        </div>
        @endforeach
    </div>
    <div class="mt-8">
        {{ $campaigns->links() }}
    </div>
    @endif

    <!-- Create Campaign Modal -->
    <div x-data="{ show: @entangle('showCreateModal').live }"
        x-show="show"
        class="fixed inset-0 z-[60] overflow-y-auto"
        x-cloak>

        <!-- Backdrop -->
        <div x-show="show"
            x-transition:enter="ease-out duration-300"
            x-transition:enter-start="opacity-0"
            x-transition:enter-end="opacity-100"
            x-transition:leave="ease-in duration-200"
            x-transition:leave-start="opacity-100"
            x-transition:leave-end="opacity-0"
            class="fixed inset-0 bg-background/80 backdrop-blur-sm transition-opacity"></div>

        <!-- Modal Content -->
        <div class="flex min-h-screen items-center justify-center p-4">
            <div x-show="show"
                x-transition:enter="ease-out duration-300"
                x-transition:enter-start="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
                x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100"
                x-transition:leave="ease-in duration-200"
                x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100"
                x-transition:leave-end="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
                @click.away="show = false"
                class="relative bg-card w-full max-w-2xl rounded-[2rem] border border-border shadow-2xl p-8 md:p-10">

                <div class="flex items-center justify-between mb-8">
                    <h2 class="text-2xl font-black text-foreground tracking-tight">Nouvelle <span class="text-primary italic">Campagne</span></h2>
                    <button @click="show = false" class="p-2 rounded-xl bg-muted text-muted-foreground hover:text-foreground transition-colors">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                </div>

                <form wire:submit.prevent="save" class="space-y-6">
                    <!-- Title -->
                    <div class="space-y-2">
                        <label class="text-[10px] font-black uppercase tracking-widest text-muted-foreground">Titre de la campagne</label>
                        <input type="text" wire:model="title" placeholder="Ex: Lancement Collection Hiver 2025"
                            class="w-full px-4 py-3 rounded-xl bg-background border border-border focus:border-primary focus:ring-4 focus:ring-primary/10 text-foreground placeholder-muted-foreground font-bold transition-all outline-none">
                        @error('title') <span class="text-rose-500 text-[10px] font-bold uppercase">{{ $message }}</span> @enderror
                    </div>

                    <!-- Description -->
                    <div class="space-y-2">
                        <label class="text-[10px] font-black uppercase tracking-widest text-muted-foreground">Description & Objectifs</label>
                        <textarea wire:model="description" rows="3" placeholder="Décrivez les détails de votre collaboration..."
                            class="w-full px-4 py-3 rounded-xl bg-background border border-border focus:border-primary focus:ring-4 focus:ring-primary/10 text-foreground placeholder-muted-foreground font-bold transition-all outline-none"></textarea>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <!-- Budget -->
                        <div class="space-y-2">
                            <label class="text-[10px] font-black uppercase tracking-widest text-muted-foreground">Budget Estimé (€)</label>
                            <input type="number" wire:model="budget" placeholder="0.00"
                                class="w-full px-4 py-3 rounded-xl bg-background border border-border focus:border-primary focus:ring-4 focus:ring-primary/10 text-foreground placeholder-muted-foreground font-bold transition-all outline-none">
                        </div>

                        <!-- Dates -->
                        <div class="space-y-2">
                            <label class="text-[10px] font-black uppercase tracking-widest text-muted-foreground">Date de fin</label>
                            <input type="date" wire:model="end_date"
                                class="w-full px-4 py-3 rounded-xl bg-background border border-border focus:border-primary focus:ring-4 focus:ring-primary/10 text-foreground placeholder-muted-foreground font-bold transition-all outline-none">
                        </div>
                    </div>

                    <!-- Enterprise Invitations -->
                    <div class="space-y-4">
                        <label class="text-[10px] font-black uppercase tracking-widest text-muted-foreground">Inviter des Entreprises</label>
                        <div class="max-h-40 overflow-y-auto pr-2 space-y-2 no-scrollbar">
                            @foreach($enterprises as $enterprise)
                            <label class="flex items-center justify-between p-3 rounded-xl border border-border bg-muted/30 cursor-pointer hover:bg-muted/50 transition-colors">
                                <div class="flex items-center gap-3">
                                    @if($enterprise->profile_photo_path)
                                    <img src="{{ asset('storage/' . $enterprise->profile_photo_path) }}" class="w-8 h-8 rounded-lg object-cover">
                                    @else
                                    <div class="w-8 h-8 rounded-lg bg-primary/20 text-primary flex items-center justify-center text-[10px] font-black uppercase">
                                        {{ substr($enterprise->company_name ?? $enterprise->name, 0, 1) }}
                                    </div>
                                    @endif
                                    <span class="text-sm font-bold text-foreground">{{ $enterprise->enterpriseProfile->company_name ?? $enterprise->name }}</span>
                                </div>
                                <input type="checkbox" wire:model="invited_enterprise_ids" value="{{ $enterprise->id }}"
                                    class="w-5 h-5 rounded-lg border-border text-primary focus:ring-primary focus:ring-offset-background">
                            </label>
                            @endforeach
                        </div>
                        @if($enterprises->isEmpty())
                        <p class="text-[10px] text-muted-foreground italic">Aucune entreprise disponible pour le moment.</p>
                        @endif
                    </div>

                    <div class="pt-6 flex gap-3">
                        <button type="button" @click="show = false" class="flex-1 py-4 font-black text-xs uppercase tracking-widest text-muted-foreground hover:text-foreground transition-all">
                            Annuler
                        </button>
                        <button type="submit" class="flex-[2] py-4 rounded-2xl bg-primary text-primary-foreground font-black text-xs uppercase tracking-widest shadow-lg shadow-primary/20 hover:opacity-90 transition-all">
                            Lancer la campagne
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
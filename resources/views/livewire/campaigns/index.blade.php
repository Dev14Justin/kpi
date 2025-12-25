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

    <!-- Pending Invitations Section -->
    @if($pendingInvitations->isNotEmpty())
    <div class="space-y-4">
        <h2 class="text-[10px] font-black uppercase tracking-widest text-muted-foreground flex items-center gap-2 px-1">
            <div class="w-1 h-3 bg-accent rounded-full"></div>
            Invitations en attente <span class="bg-accent/10 text-accent px-1.5 py-0.5 rounded text-[8px]">{{ $pendingInvitations->count() }}</span>
        </h2>

        <div class="grid grid-cols-1 gap-4">
            @foreach($pendingInvitations as $invitation)
            <div class="bg-card border border-accent/20 rounded-2xl p-5 flex flex-col sm:flex-row items-start sm:items-center justify-between gap-4 shadow-sm relative overflow-hidden group">
                <div class="absolute top-0 left-0 w-1 h-full bg-accent"></div>

                <div class="flex items-center gap-4">
                    <div class="w-12 h-12 rounded-xl bg-accent/10 flex items-center justify-center text-accent shrink-0">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9" />
                        </svg>
                    </div>
                    <div>
                        <h4 class="font-bold text-foreground">{{ $invitation->title }}</h4>
                        <p class="text-xs text-muted-foreground font-medium">Invitation reçue de <span class="text-foreground font-bold">{{ $invitation->user->name }}</span></p>
                    </div>
                </div>

                <div class="flex items-center gap-3 w-full sm:w-auto">
                    <button wire:click="rejectInvitation('{{ $invitation->uuid }}')" class="flex-1 sm:flex-none px-4 py-2 rounded-lg text-[10px] font-black uppercase tracking-widest text-muted-foreground hover:bg-rose-500/10 hover:text-rose-500 transition-all border border-border">
                        Refuser
                    </button>
                    <button wire:click="acceptInvitation('{{ $invitation->uuid }}')" class="flex-1 sm:flex-none px-6 py-2 rounded-lg bg-accent text-white text-[10px] font-black uppercase tracking-widest shadow-lg shadow-accent/20 hover:opacity-90 transition-all border border-accent">
                        Accepter la collaboration
                    </button>
                </div>
            </div>
            @endforeach
        </div>
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
            </div>

            <h3 class="text-xl font-bold text-foreground mb-2 group-hover:text-primary transition-colors">
                {{ $campaign->title }}
            </h3>

            <p class="text-sm text-muted-foreground font-medium line-clamp-2 mb-6 flex-1">
                {{ $campaign->short_description ?: ($campaign->description ?: 'Aucune description fournie.') }}
            </p>

            <div class="space-y-4 pt-4 border-t border-border">
                <div class="flex items-center justify-between text-xs font-bold uppercase tracking-widest">
                    <span class="text-muted-foreground flex items-center gap-2">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 21a4 4 0 01-4-4V5a2 2 0 012-2h4a2 2 0 012 2v12a4 4 0 01-4 4zm0 0h12a2 2 0 002-2v-4a2 2 0 00-2-2h-2.343M11 7.343l1.657-1.657a2 2 0 012.828 0l2.829 2.829a2 2 0 010 2.828l-8.486 8.485M7 17h.01" />
                        </svg>
                        Type
                    </span>
                    <span class="text-foreground italic">{{ $campaign->content_type?->label() ?: 'Non défini' }}</span>
                </div>

                <div class="flex items-center justify-between text-xs font-bold uppercase tracking-widest">
                    <span class="text-muted-foreground flex items-center gap-2">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                        Plateformes
                    </span>
                    <div class="flex gap-1">
                        @foreach($campaign->platforms ?? [] as $platformValue)
                        @php $platform = \App\Enums\MainPlatform::from($platformValue); @endphp
                        <span class="text-primary italic" title="{{ $platform->label() }}">{{ strtoupper(substr($platform->value, 0, 2)) }}</span>
                        @endforeach
                    </div>
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

                    <!-- Short Description -->
                    <div class="space-y-2">
                        <label class="text-[10px] font-black uppercase tracking-widest text-muted-foreground">Description courte</label>
                        <input type="text" wire:model="short_description" placeholder="Ex: Campagne pour le lancement de notre nouvelle gamme de produits"
                            class="w-full px-4 py-3 rounded-xl bg-background border border-border focus:border-primary focus:ring-4 focus:ring-primary/10 text-foreground placeholder-muted-foreground font-bold transition-all outline-none">
                        @error('short_description') <span class="text-rose-500 text-[10px] font-bold uppercase">{{ $message }}</span> @enderror
                    </div>


                    <!-- Content Type -->
                    <div class="space-y-2">
                        <label class="text-[10px] font-black uppercase tracking-widest text-muted-foreground">Type de contenu à produire</label>
                        <select wire:model="content_type"
                            class="w-full px-4 py-3 rounded-xl bg-background border border-border focus:border-primary focus:ring-4 focus:ring-primary/10 text-foreground font-bold transition-all outline-none appearance-none">
                            <option value="">Choisir un type</option>
                            @foreach(\App\Enums\ContentType::cases() as $type)
                            <option value="{{ $type->value }}">{{ $type->label() }}</option>
                            @endforeach
                        </select>
                        @error('content_type') <span class="text-rose-500 text-[10px] font-bold uppercase">{{ $message }}</span> @enderror
                    </div>

                    <div class="space-y-3">
                        <label class="text-[10px] font-black uppercase tracking-widest text-muted-foreground">Plateformes de diffusion</label>
                        <div class="grid grid-cols-2 sm:grid-cols-3 gap-3">
                            @foreach(\App\Enums\MainPlatform::cases() as $platform)
                            <label class="flex items-center gap-2 p-3 rounded-xl border border-border bg-muted/30 cursor-pointer hover:bg-primary/5 hover:border-primary/30 transition-all group">
                                <input type="checkbox" wire:model="platforms" value="{{ $platform->value }}"
                                    class="w-4 h-4 rounded border-border text-primary focus:ring-primary focus:ring-offset-background">
                                <span class="text-[11px] font-bold text-muted-foreground group-hover:text-foreground transition-colors">{{ $platform->label() }}</span>
                            </label>
                            @endforeach
                        </div>
                        @error('platforms') <span class="text-rose-500 text-[10px] font-bold uppercase">{{ $message }}</span> @enderror
                    </div>



                    <div class="pt-6 flex gap-3">
                        <button type="button" @click="show = false" class="flex-1 py-4 font-black text-xs uppercase tracking-widest text-muted-foreground hover:text-foreground transition-all">
                            Annuler
                        </button>
                        <button type="submit" class="flex-[2] py-4 rounded-2xl bg-primary text-primary-foreground font-black text-xs uppercase tracking-widest shadow-lg shadow-primary/20 hover:opacity-90 transition-all">
                            Créer une campagne
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
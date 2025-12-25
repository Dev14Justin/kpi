<div class="space-y-8">
    @push('styles')
    <link rel="stylesheet" href="https://unpkg.com/trix@2.0.8/dist/trix.css">
    <style>
        /* Premium Rich Editor Styling */
        .rich-editor-container {
            border-radius: 1rem;
            background-color: hsl(var(--background));
            border: 1px solid hsl(var(--border));
            transition: all 0.3s ease;
            overflow: hidden;
        }

        .rich-editor-container:focus-within {
            border-color: hsl(var(--primary));
            box-shadow: 0 0 0 4px hsla(var(--primary), 0.1);
        }

        .rich-editor-container.has-error {
            border-color: #f43f5e;
        }

        trix-toolbar {
            border-bottom: 1px solid hsl(var(--border)) !important;
            padding: 0.5rem 0.75rem !important;
            background-color: hsla(var(--muted), 0.1) !important;
        }

        trix-toolbar .trix-button-row {
            gap: 0.4rem !important;
            align-items: center !important;
        }

        trix-toolbar .trix-button-group {
            border: 1px solid hsl(var(--border)) !important;
            border-radius: 0.6rem !important;
            background: hsl(var(--card)) !important;
            padding: 2px !important;
            margin-bottom: 0 !important;
        }

        trix-toolbar .trix-button {
            border: none !important;
            background: transparent !important;
            border-radius: 0.4rem !important;
            width: 1.85rem !important;
            height: 1.85rem !important;
            transition: all 0.2s ease !important;
            display: flex !important;
            align-items: center !important;
            justify-content: center !important;
            padding: 0 !important;
        }

        trix-toolbar .trix-button:hover {
            background-color: hsla(var(--primary), 0.1) !important;
            color: hsl(var(--primary)) !important;
        }

        trix-toolbar .trix-button--active {
            background-color: hsl(var(--primary)) !important;
        }

        trix-toolbar .trix-button--icon {
            filter: grayscale(1) invert(0.5);
        }

        .dark trix-toolbar .trix-button--icon {
            filter: grayscale(1) invert(1);
        }

        trix-toolbar .trix-button--active.trix-button--icon {
            filter: brightness(0) invert(1) !important;
        }

        trix-editor {
            border: none !important;
            min-height: 180px !important;
            padding: 1rem 1.25rem !important;
            font-family: inherit !important;
            font-size: 0.875rem !important;
            font-weight: 500 !important;
            color: hsl(var(--foreground)) !important;
            outline: none !important;
        }

        /* Hide unwanted trix elements */
        .trix-button-group--file-tools,
        .trix-button--icon-decrease-nesting-level,
        .trix-button--icon-increase-nesting-level {
            display: none !important;
        }
    </style>
    @endpush

    <!-- Header / Navigation -->
    <div class="flex flex-col lg:flex-row lg:items-center justify-between gap-6">
        <div class="flex items-center gap-4 w-full lg:w-auto">
            <a href="{{ route('campaigns.show', $campaign) }}" class="p-3 rounded-xl bg-muted text-muted-foreground hover:text-foreground transition-colors shrink-0">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M15 19l-7-7 7-7" />
                </svg>
            </a>
            <div class="min-w-0">
                <nav class="flex text-[10px] sm:text-xs font-bold uppercase tracking-widest text-muted-foreground mb-1 gap-2 overflow-hidden whitespace-nowrap overflow-ellipsis">
                    <a href="{{ route('campaigns.index') }}" class="hover:text-primary transition-colors hidden sm:inline">Campagnes</a>
                    <span class="hidden sm:inline">/</span>
                    <a href="{{ route('campaigns.show', $campaign) }}" class="hover:text-primary transition-colors">Détails</a>
                    <span>/</span>
                    <span class="text-foreground">Compléter</span>
                </nav>
                <h1 class="text-xl md:text-3xl font-black text-foreground tracking-tight line-clamp-1">Compléter <span class="text-primary italic">la campagne</span></h1>
            </div>
        </div>

        <!-- Horizontal Stats & Help (Header Right) -->
        <div class="flex flex-col sm:flex-row items-stretch sm:items-center gap-4 w-full lg:w-auto">
            <!-- Compact Stats -->
            <div class="flex items-center justify-around sm:justify-start gap-4 sm:gap-6 px-4 sm:px-6 py-3.5 bg-card border border-border rounded-2xl shadow-sm overflow-hidden shrink-0">
                <div class="flex flex-col shrink-0">
                    <span class="text-[7px] sm:text-[8px] font-black uppercase text-muted-foreground leading-none mb-1">Type</span>
                    <span class="text-[9px] sm:text-[10px] font-black uppercase text-primary leading-none whitespace-nowrap">{{ $campaign->content_type?->label() ?? 'Non défini' }}</span>
                </div>
                <div class="w-px h-6 bg-border shrink-0"></div>
                <div class="flex flex-col shrink-0">
                    <span class="text-[7px] sm:text-[8px] font-black uppercase text-muted-foreground leading-none mb-1">Config.</span>
                    <span class="text-[9px] sm:text-[10px] font-black text-foreground leading-none whitespace-nowrap">{{ floor(($currentStep / 3) * 100) }}%</span>
                </div>
                <div class="w-px h-6 bg-border shrink-0"></div>
                <div class="flex items-center gap-1.5 shrink-0">
                    @forelse($platforms as $plat)
                    <span class="px-2 py-0.5 rounded bg-muted text-[7px] sm:text-[8px] font-black text-foreground shrink-0">{{ strtoupper(substr($plat, 0, 2)) }}</span>
                    @empty
                    <span class="text-[8px] font-bold text-muted-foreground italic shrink-0 uppercase tracking-tighter">Aucun canal</span>
                    @endforelse
                </div>
            </div>

            <!-- Compact Hint -->
            <div class="px-4 py-3 bg-primary/5 border border-primary/10 rounded-2xl flex items-center gap-3 w-full sm:max-w-xs shrink-0">
                <div class="p-1.5 rounded-lg bg-primary/10 text-primary shrink-0">
                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                </div>
                <p class="text-[9px] text-muted-foreground leading-tight font-bold">
                    @if($currentStep === 1) Titres accrocheurs = plus de partenaires. @endif
                    @if($currentStep === 2) Moins de champs = plus de conversions. @endif
                    @if($currentStep === 3) Le lien public est généré automatiquement. @endif
                </p>
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

    <div class="space-y-8">
        <!-- Main Content Area -->
        <div class="space-y-8">
            <!-- Stepper Header -->
            <div class="bg-card border border-border rounded-[1.5rem] md:rounded-[2rem] py-5 md:py-6 px-4 md:px-8 shadow-sm relative overflow-hidden">
                <div class="absolute top-0 right-0 w-48 h-48 bg-primary/5 rounded-full blur-3xl -mr-24 -mt-24"></div>

                <h2 class="text-[9px] md:text-[10px] font-black uppercase tracking-widest text-muted-foreground mb-4 md:mb-6 text-center">Progression de la configuration</h2>

                <div class="relative px-2 sm:px-12 max-w-lg mx-auto md:max-w-none">
                    <!-- Progress Line -->
                    <div class="absolute top-[18px] left-[35px] right-[35px] sm:left-[50px] sm:right-[50px] h-1 bg-muted rounded-full z-0">
                        <div class="h-full bg-primary rounded-full transition-all duration-500" style="width: {{ ($currentStep - 1) / 2 * 100 }}%"></div>
                    </div>

                    <!-- Steps Items -->
                    <div class="relative z-10 flex justify-between">
                        @php
                        $steps = [
                        1 => 'Identité',
                        2 => 'Capture',
                        3 => 'Visibilité'
                        ];
                        @endphp

                        @foreach($steps as $stepNum => $label)
                        <div class="flex flex-col items-center gap-2 md:gap-3">
                            <button wire:click="goToStep({{ $stepNum }})"
                                class="w-8 h-8 md:w-9 md:h-9 rounded-lg md:rounded-xl flex items-center justify-center text-[10px] md:text-xs font-black transition-all border-2 md:border-4
                                    {{ $currentStep >= $stepNum ? 'bg-primary text-white border-primary' : 'bg-muted text-muted-foreground border-muted' }}
                                    {{ $currentStep == $stepNum ? 'ring-4 ring-primary/20 scale-105' : '' }}">
                                @if($currentStep > $stepNum)
                                <svg class="w-3.5 h-3.5 md:w-4 md:h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7" />
                                </svg>
                                @else
                                {{ $stepNum }}
                                @endif
                            </button>
                            <span class="text-[7px] md:text-[9px] font-black uppercase tracking-widest {{ $currentStep >= $stepNum ? 'text-primary' : 'text-muted-foreground' }}">
                                {{ $label }}
                            </span>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>

            <!-- Form Card -->
            <div class="bg-card border border-border rounded-[1.5rem] md:rounded-[2rem] p-6 md:p-10 shadow-sm relative overflow-hidden">
                <div class="absolute top-0 right-0 w-48 h-48 bg-primary/5 rounded-full blur-3xl -mr-24 -mt-24"></div>

                @if($currentStep === 1)
                <div wire:key="step-1" class="space-y-6">
                    <div class="flex items-center gap-3 mb-6">
                        <div class="p-2.5 rounded-xl bg-primary/10 text-primary">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                            </svg>
                        </div>
                        <div>
                            <h2 class="text-xl font-black text-foreground tracking-tight">Détails <span class="text-primary italic">de campagne</span></h2>
                            <p class="text-xs text-muted-foreground font-medium">Informations obligatoires pour identifier votre projet.</p>
                        </div>
                    </div>

                    <div class="grid grid-cols-1 gap-5">
                        <div wire:key="field-title" class="space-y-1.5">
                            <label class="text-[9px] font-black uppercase tracking-widest text-muted-foreground ml-1">Titre de la campagne <span class="text-rose-500">*</span></label>
                            <input type="text" wire:model="title" class="w-full px-4 py-3 rounded-xl bg-background border {{ $errors->has('title') ? 'border-rose-500' : 'border-border' }} focus:border-primary focus:ring-4 focus:ring-primary/10 text-foreground font-bold transition-all outline-none text-sm">
                            @error('title') <span class="text-[10px] text-rose-500 font-bold ml-1">{{ $message }}</span> @enderror
                        </div>

                        <div wire:key="field-short-desc" class="space-y-1.5">
                            <label class="text-[9px] font-black uppercase tracking-widest text-muted-foreground ml-1">Accroche (Description courte) <span class="text-rose-500">*</span></label>
                            <input type="text" wire:model="short_description" class="w-full px-4 py-3 rounded-xl bg-background border {{ $errors->has('short_description') ? 'border-rose-500' : 'border-border' }} focus:border-primary focus:ring-4 focus:ring-primary/10 text-foreground font-bold transition-all outline-none text-sm">
                            @error('short_description') <span class="text-[10px] text-rose-500 font-bold ml-1">{{ $message }}</span> @enderror
                        </div>

                        <div wire:key="field-content-type" class="space-y-1.5">
                            <label class="text-[9px] font-black uppercase tracking-widest text-muted-foreground ml-1">Type de contenu à produire <span class="text-rose-500">*</span></label>
                            <select wire:model="content_type" class="w-full px-4 py-3 rounded-xl bg-background border {{ $errors->has('content_type') ? 'border-rose-500' : 'border-border' }} focus:border-primary focus:ring-4 focus:ring-primary/10 text-foreground font-bold transition-all outline-none text-sm appearance-none">
                                <option value="">Choisir un type</option>
                                @foreach(\App\Enums\ContentType::cases() as $type)
                                <option value="{{ $type->value }}">{{ $type->label() }}</option>
                                @endforeach
                            </select>
                            @error('content_type') <span class="text-[10px] text-rose-500 font-bold ml-1">{{ $message }}</span> @enderror
                        </div>

                        <div wire:key="field-description" class="space-y-1.5" x-data="{ 
                            content: @entangle('description'),
                            init() {
                                // Function to load content into Trix safely
                                const loadTrix = () => {
                                    if (this.$refs.editor && this.$refs.editor.editor && this.content) {
                                        if (this.$refs.editor.editor.getHTML() !== this.content) {
                                            this.$refs.editor.editor.loadHTML(this.content);
                                        }
                                    }
                                };

                                // Sync Trix with Livewire when editor is ready
                                this.$refs.editor.addEventListener('trix-initialize', loadTrix);

                                // Sync Livewire with Trix when content changes
                                this.$refs.editor.addEventListener('trix-change', (e) => {
                                    this.content = e.target.value;
                                });

                                // Watch for external changes (like step navigation)
                                this.$watch('content', (value) => {
                                    if (!value) {
                                        this.$refs.editor.editor.loadHTML('');
                                    } else {
                                        loadTrix();
                                    }
                                });
                            }
                        }">
                            <label class="text-[9px] font-black uppercase tracking-widest text-muted-foreground ml-1">Détails & Objectifs <span class="text-rose-500">*</span></label>
                            <div class="rich-editor-container {{ $errors->has('description') ? 'has-error' : 'border-border' }}" wire:ignore>
                                <input id="description_trix" type="hidden" value="{{ $description }}">
                                <trix-editor input="description_trix" x-ref="editor" class="trix-content overflow-x-auto"></trix-editor>
                            </div>
                            @error('description') <span class="text-[10px] text-rose-500 font-bold ml-1">{{ $message }}</span> @enderror
                        </div>

                        <div wire:key="field-platforms" class="pt-6 border-t border-border">
                            <div class="flex items-center justify-between mb-4">
                                <h3 class="text-[10px] font-black uppercase tracking-widest text-primary flex items-center gap-2">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.828 10.172a4 4 0 00-5.656 0l-4 4a4 4 0 105.656 5.656l1.102-1.101m-.758-4.828a4 4 0 005.656 0l4-4a4 4 0 00-5.656-5.656l-1.1 1.1" />
                                    </svg>
                                    Liens vers les contenus (Diffusion) <span class="text-rose-500">*</span>
                                </h3>

                                <div x-data="{ open: false }" class="relative">
                                    <button @click="open = !open" class="text-[9px] font-black uppercase tracking-widest px-2 py-1 rounded bg-primary/10 text-primary hover:bg-primary hover:text-white transition-all">
                                        + Ajouter un réseau
                                    </button>
                                    <div x-show="open" @click.away="open = false" class="absolute right-0 mt-2 w-48 bg-card border border-border rounded-xl shadow-xl z-50 p-2">
                                        @foreach(\App\Enums\MainPlatform::cases() as $platform)
                                        <button @click="open = false" wire:click="addPlatform('{{ $platform->value }}')"
                                            class="w-full text-left px-3 py-2 text-[10px] font-bold text-foreground hover:bg-muted rounded-lg transition-all {{ in_array($platform->value, $platforms) ? 'opacity-30 pointer-events-none' : '' }}">
                                            {{ $platform->label() }}
                                        </button>
                                        @endforeach
                                    </div>
                                </div>
                            </div>

                            @error('platforms') <p class="text-[10px] text-rose-500 font-bold mb-4">{{ $message }}</p> @enderror

                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                @forelse($platforms as $platformValue)
                                @php $platform = \App\Enums\MainPlatform::tryFrom($platformValue); @endphp
                                @if($platform)
                                <div wire:key="platform-{{ $platformValue }}" class="space-y-1.5 group relative">
                                    <div class="flex items-center justify-between gap-2">
                                        <label class="text-[9px] font-black uppercase tracking-widest text-muted-foreground ml-1 truncate">Lien {{ $platform->label() }}</label>
                                        <button wire:click="removePlatform('{{ $platformValue }}')" class="sm:opacity-0 group-hover:opacity-100 text-rose-500 text-[8px] font-black uppercase tracking-widest transition-all shrink-0">Supprimer</button>
                                    </div>
                                    <div class="relative">
                                        <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none text-muted-foreground">
                                            <svg class="w-3.5 h-3.5" fill="currentColor" viewBox="0 0 24 24">
                                                <path d="M12 2C6.477 2 2 6.477 2 12s4.477 10 10 10 10-4.477 10-10S17.523 2 12 2zM12 20c-4.411 0-8-3.589-8-8s3.589-8 8-8 8 3.589 8 8-3.589 8-8 8z" />
                                            </svg>
                                        </div>
                                        <input type="url" wire:model="content_links.{{ $platformValue }}" placeholder="https://..."
                                            class="w-full pl-10 pr-4 py-3 rounded-xl bg-background border {{ $errors->has('content_links.'.$platformValue) ? 'border-rose-500' : 'border-border' }} focus:border-primary focus:ring-4 focus:ring-primary/10 text-foreground font-bold transition-all outline-none text-[13px] sm:text-xs">
                                    </div>
                                    @error('content_links.'.$platformValue) <span class="text-[10px] text-rose-500 font-bold ml-1">{{ $message }}</span> @enderror
                                </div>
                                @endif
                                @empty
                                <div class="md:col-span-2 py-8 border-2 border-dashed border-border rounded-2xl flex flex-col items-center justify-center text-muted-foreground italic text-xs">
                                    <p>Aucun réseau sélectionné.</p>
                                    <p class="text-[9px] uppercase font-black not-italic mt-1">Ajoutez-en un pour continuer</p>
                                </div>
                                @endforelse
                            </div>
                        </div>
                    </div>
                </div>

                @elseif($currentStep === 2)
                <div wire:key="step-2" class="space-y-6">
                    <div class="flex items-center gap-3 mb-6">
                        <div class="p-2.5 rounded-xl bg-primary/10 text-primary">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
                            </svg>
                        </div>
                        <div>
                            <h2 class="text-xl font-black text-foreground tracking-tight">Formulaire <span class="text-primary italic">de Leads</span></h2>
                            <p class="text-xs text-muted-foreground font-medium">Configurez votre capture de prospects.</p>
                        </div>
                    </div>

                    <div class="space-y-4">
                        <div class="flex items-center justify-between mb-2">
                            <label class="text-[9px] font-black uppercase tracking-widest text-muted-foreground">Structure du formulaire</label>
                            <button wire:click="addField" class="px-3 py-1.5 rounded-lg bg-primary/10 text-primary text-[9px] font-black uppercase tracking-widest hover:bg-primary hover:text-white transition-all shadow-sm">
                                + Ajouter un champ
                            </button>
                        </div>

                        <div class="space-y-3">
                            @foreach($formFields as $index => $field)
                            <div class="flex flex-col sm:flex-row items-stretch sm:items-end gap-3 p-4 rounded-xl border border-border bg-muted/20 hover:border-primary/20 transition-all group">
                                <div class="flex-1 grid grid-cols-1 sm:grid-cols-2 gap-3">
                                    <div class="space-y-1">
                                        <label class="text-[8px] font-black uppercase text-muted-foreground ml-1">Libellé</label>
                                        <input type="text" wire:model="formFields.{{ $index }}.label" class="w-full px-3 py-2.5 sm:py-2 rounded-lg bg-background border border-border focus:border-primary focus:ring-4 focus:ring-primary/10 text-xs font-bold text-foreground transition-all outline-none">
                                    </div>
                                    <div class="space-y-1">
                                        <label class="text-[8px] font-black uppercase text-muted-foreground ml-1">Type de donnée</label>
                                        <select wire:model="formFields.{{ $index }}.type" class="w-full px-3 py-2.5 sm:py-2 rounded-lg bg-background border border-border focus:border-primary focus:ring-4 focus:ring-primary/10 text-xs font-bold text-foreground transition-all outline-none appearance-none">
                                            <option value="text">Texte court</option>
                                            <option value="email">Email</option>
                                            <option value="tel">Téléphone</option>
                                            <option value="textarea">Texte long</option>
                                            <option value="number">Nombre</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="flex items-center justify-between sm:justify-end gap-4 mt-3 sm:mt-0 pt-3 sm:pt-0 border-t sm:border-t-0 border-border/50">
                                    <label class="flex items-center gap-1.5 cursor-pointer">
                                        <input type="checkbox" wire:model="formFields.{{ $index }}.required" class="w-4 h-4 sm:w-3.5 sm:h-3.5 rounded text-primary focus:ring-primary/20 border-border bg-background">
                                        <span class="text-[9px] sm:text-[8px] font-black uppercase text-muted-foreground">Requis</span>
                                    </label>
                                    <button wire:click="removeField({{ $index }})" class="p-2.5 sm:p-2 rounded-lg bg-rose-500/10 text-rose-500 hover:bg-rose-500 hover:text-white transition-all">
                                        <svg class="w-4 h-4 sm:w-3.5 sm:h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                        </svg>
                                    </button>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>
                </div>

                @elseif($currentStep === 3)
                <div wire:key="step-3" class="space-y-6">
                    <div class="flex items-center gap-3 mb-6">
                        <div class="p-2.5 rounded-xl bg-primary/10 text-primary">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                        </div>
                        <div>
                            <h2 class="text-xl font-black text-foreground tracking-tight">Publication <span class="text-primary italic">& Link</span></h2>
                            <p class="text-xs text-muted-foreground font-medium">Validez et diffusez votre lien public.</p>
                        </div>
                    </div>

                    <div class="grid grid-cols-1 gap-6">
                        <!-- Link Sharing -->
                        <div wire:key="field-public-link" class="bg-muted/30 rounded-2xl p-5 md:p-6 border border-border text-center">
                            <label class="text-[9px] font-black uppercase tracking-widest text-muted-foreground mb-3 block">Lien direct vers votre formulaire</label>
                            <div class="flex flex-col sm:flex-row items-stretch sm:items-center gap-2 max-w-lg mx-auto">
                                <input type="text" readonly value="{{ $public_link }}" class="flex-1 px-4 py-3 sm:py-2.5 rounded-xl bg-background border border-border focus:border-primary focus:ring-4 focus:ring-primary/10 text-[11px] font-bold text-muted-foreground truncate outline-none mb-2 sm:mb-0">
                                <div class="flex gap-2">
                                    <button onclick="navigator.clipboard.writeText('{{ $public_link }}'); alert('Lien copié !')"
                                        class="flex-1 sm:flex-none p-3 rounded-xl bg-accent text-white hover:opacity-90 transition-all shadow-md shadow-accent/10 flex items-center justify-center">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M8 5H6a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2v-1M8 5a2 2 0 002 2h2a2 2 0 002-2M8 5a2 2 0 012-2h2a2 2 0 012 2m0 0h2a2 2 0 012 2v3m2 4H10m0 0l3-3m-3 3l3 3" />
                                        </svg>
                                    </button>
                                    <a href="{{ $public_link }}" target="_blank" class="flex-1 sm:flex-none p-3 rounded-xl bg-primary text-white hover:opacity-90 transition-all shadow-md shadow-primary/10 flex items-center justify-center">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14" />
                                        </svg>
                                    </a>
                                </div>
                            </div>
                        </div>

                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                            <!-- Call Button -->
                            <div wire:key="field-call-phone" class="space-y-1.5">
                                <label class="text-[9px] font-black uppercase tracking-widest text-muted-foreground ml-1">Numéro d'appel (Direct)</label>
                                <div class="relative">
                                    <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none text-muted-foreground">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z" />
                                        </svg>
                                    </div>
                                    <input type="tel" wire:model="call_button_phone" placeholder="+33 6..."
                                        class="w-full pl-10 pr-4 py-3 rounded-xl bg-background border border-border focus:border-primary focus:ring-4 focus:ring-primary/10 text-sm font-bold transition-all outline-none">
                                </div>
                            </div>

                            <!-- Status Toggle -->
                            <div wire:key="field-visibility" class="space-y-1.5" x-data="{ active: @entangle('is_active') }">
                                <label class="text-[9px] font-black uppercase tracking-widest text-muted-foreground ml-1">Visibilité immédiate</label>
                                <button @click="active = !active" type="button"
                                    class="w-full h-[44px] flex items-center justify-between px-4 rounded-xl border transition-all duration-300 group"
                                    :class="active ? 'bg-primary/5 border-primary/30' : 'bg-muted/10 border-border hover:border-muted-foreground/50'">
                                    <div class="flex items-center gap-2.5">
                                        <div class="w-2 h-2 rounded-full transition-colors"
                                            :class="active ? 'bg-primary animate-pulse' : 'bg-muted-foreground/30'"></div>
                                        <span class="text-[10px] font-black uppercase tracking-wider transition-colors"
                                            :class="active ? 'text-primary' : 'text-muted-foreground'"
                                            x-text="active ? 'Activée' : 'Désactivée'">
                                        </span>
                                    </div>
                                    <div class="relative w-9 h-5 rounded-full transition-colors duration-300"
                                        :class="active ? 'bg-primary' : 'bg-muted-foreground/40'">
                                        <div class="absolute top-0.5 left-0.5 w-4 h-4 bg-white rounded-full transition-transform duration-300 shadow-sm"
                                            :class="active ? 'translate-x-4' : 'translate-x-0'"></div>
                                    </div>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
                @endif

                <!-- Footer Actions -->
                <div class="mt-8 pt-6 border-t border-border flex flex-col sm:flex-row items-center justify-between gap-4">
                    <div class="flex items-center justify-between w-full sm:w-auto sm:justify-start">
                        @if($currentStep > 1)
                        <button wire:click="prevStep" class="px-6 py-3 font-black text-[10px] uppercase tracking-widest text-muted-foreground hover:text-foreground transition-all">
                            Précédent
                        </button>
                        @endif
                    </div>

                    <div class="flex flex-col sm:flex-row gap-3 w-full sm:w-auto">
                        @if($currentStep < 3)
                            @if(($currentStep===1 && $step1Completed) || ($currentStep===2 && $step2Completed))
                            <button wire:click="saveOnly" class="h-[48px] sm:h-auto px-6 py-3 rounded-xl bg-accent/5 text-accent border border-accent/20 font-black text-[10px] uppercase tracking-widest hover:bg-accent hover:text-white hover:border-accent transition-all flex items-center justify-center gap-2 group order-2 sm:order-1">
                            <svg wire:loading.remove wire:target="saveOnly" class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M8 7H5a2 2 0 00-2 2v9a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2h-3m-1 4l-3 3m0 0l-3-3m3 3V4" />
                            </svg>
                            <div wire:loading wire:target="saveOnly" class="w-3.5 h-3.5 border-2 border-accent/30 border-t-accent rounded-full animate-spin"></div>
                            Enregistrer
                            </button>
                            @endif

                            <button wire:click="nextStep" class="h-[48px] sm:h-auto px-8 py-3 rounded-xl bg-primary text-white font-black text-[10px] uppercase tracking-widest shadow-lg shadow-primary/10 hover:opacity-90 transition-all w-full sm:w-auto order-1 sm:order-2">
                                Suivant
                            </button>
                            @else
                            <button wire:click="saveAndFinish" class="h-[52px] sm:h-auto px-8 py-3 rounded-xl bg-accent text-white font-black text-[10px] uppercase tracking-widest shadow-lg shadow-accent/10 hover:opacity-90 transition-all flex items-center justify-center gap-2 w-full sm:w-auto">
                                <div wire:loading wire:target="saveAndFinish" class="w-3.5 h-3.5 border-2 border-white/30 border-t-white rounded-full animate-spin"></div>
                                Enregistrer et terminer
                            </button>
                            @endif
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>

@push('scripts')
<script src="https://unpkg.com/trix@2.0.8/dist/trix.umd.min.js"></script>
@endpush
<div class="w-full max-w-lg mx-auto">
    <div class="bg-card border border-border rounded-[2rem] p-6 md:p-10 shadow-2xl relative overflow-hidden">
        <div class="absolute top-0 right-0 w-48 h-48 bg-primary/5 rounded-full blur-3xl -mr-24 -mt-24"></div>
        <div class="absolute bottom-0 left-0 w-48 h-48 bg-accent/5 rounded-full blur-3xl -ml-24 -mb-24"></div>

        @if($submitted)
        <div class="text-center py-8 space-y-4 relative z-10">
            <div class="w-16 h-16 bg-emerald-500/10 text-emerald-500 rounded-2xl flex items-center justify-center mx-auto mb-4">
                <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7" />
                </svg>
            </div>
            <h2 class="text-2xl font-black text-foreground tracking-tight">C'est envoyé !</h2>
            <p class="text-xs text-muted-foreground font-medium max-w-[250px] mx-auto leading-relaxed">Vos informations ont bien été transmises à l'équipe de la campagne.</p>

            @if($campaign->lead_form_settings['call_button_phone'] ?? null)
            <div class="pt-6">
                <a href="tel:{{ $campaign->lead_form_settings['call_button_phone'] }}"
                    class="inline-flex items-center gap-2 px-8 py-3.5 rounded-xl bg-accent text-white font-black text-[10px] uppercase tracking-widest shadow-lg shadow-accent/10 hover:scale-105 transition-all">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z" />
                    </svg>
                    Nous appeler
                </a>
            </div>
            @endif
        </div>
        @else
        <div class="relative z-10">
            <div class="mb-8 text-center">
                <h1 class="text-xl font-black text-foreground tracking-tight mb-2">{{ $campaign->title }}</h1>
                <p class="text-[11px] text-muted-foreground font-medium leading-relaxed max-w-xs mx-auto">{{ $campaign->short_description }}</p>
            </div>

            <form wire:submit.prevent="submit" class="space-y-4">
                @foreach($campaign->lead_form_settings['fields'] ?? [] as $field)
                <div class="space-y-1.5">
                    <label class="text-[9px] font-black uppercase tracking-widest text-muted-foreground ml-1">
                        {{ $field['label'] }} @if($field['required']) <span class="text-primary">*</span> @endif
                    </label>

                    @if($field['type'] === 'textarea')
                    <textarea wire:model="formData.{{ $field['label'] }}" rows="3"
                        class="w-full px-4 py-3 rounded-xl bg-background border border-border focus:border-primary focus:ring-4 focus:ring-primary/10 text-foreground font-bold transition-all outline-none text-sm"></textarea>
                    @else
                    <input type="{{ $field['type'] }}" wire:model="formData.{{ $field['label'] }}"
                        class="w-full px-4 py-3 rounded-xl bg-background border border-border focus:border-primary focus:ring-4 focus:ring-primary/10 text-foreground font-bold transition-all outline-none text-sm">
                    @endif

                    @error('formData.' . $field['label'])
                    <span class="text-rose-500 text-[8px] font-black uppercase tracking-widest ml-1">{{ $message }}</span>
                    @enderror
                </div>
                @endforeach

                <div class="pt-4">
                    <button type="submit"
                        class="w-full py-4 rounded-xl bg-primary text-white font-black text-[11px] uppercase tracking-widest shadow-lg shadow-primary/10 hover:opacity-90 transition-all flex items-center justify-center gap-2 group">
                        Envoyer mes informations
                        <svg class="w-4 h-4 group-hover:translate-x-0.5 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M14 5l7 7m0 0l-7 7m7-7H3" />
                        </svg>
                    </button>
                </div>
            </form>

            <div class="mt-8 pt-6 border-t border-border flex items-center justify-center">
                <p class="text-[8px] font-black uppercase tracking-widest text-muted-foreground/40">Propulsé par KPIHUB</p>
            </div>
        </div>
        @endif
    </div>
</div>
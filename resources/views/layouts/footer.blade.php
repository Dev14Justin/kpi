<footer class="bg-card border-t border-border transition-colors duration-300">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8 md:py-10">
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8 md:gap-12 items-start">
            <!-- 1. Brand Section -->
            <div class="space-y-4 text-left">
                <a href="{{ route('influencers.index') }}" class="flex items-center gap-2 group">
                    <div class="h-9 w-9 rounded-xl bg-primary flex items-center justify-center font-black text-primary-foreground transition-transform group-hover:scale-105">K</div>
                    <span class="text-xl font-bold text-foreground">KpiHub</span>
                </a>
                <p class="text-muted-foreground text-sm leading-6 max-w-xs">
                    La plateforme qui connecte marques et influenceurs. Pilotez vos campagnes, mesurez vos performances et maximisez votre impact.
                </p>
            </div>

            <!-- 2. Community Section (Centered) -->
            <div class="space-y-4 md:text-center">
                <h3 class="text-xs font-black uppercase tracking-widest text-foreground">Réseaux Sociaux</h3>
                <div class="flex flex-col md:items-center gap-3">
                    <a href="#" class="text-sm text-muted-foreground hover:text-primary transition-colors flex items-center gap-2 group md:justify-center">
                        <span>À propos</span>
                        <svg class="w-3.5 h-3.5 opacity-0 -translate-x-2 transition-all group-hover:opacity-100 group-hover:translate-x-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                        </svg>
                    </a>
                    <div class="flex items-center gap-4 pt-1 md:justify-center">
                        <a href="#" class="text-muted-foreground hover:text-primary transition-all hover:scale-110" title="Instagram">
                            <svg class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <rect x="2" y="2" width="20" height="20" rx="5" ry="5"></rect>
                                <path d="M16 11.37A4 4 0 1 1 12.63 8 4 4 0 0 1 16 11.37z"></path>
                                <line x1="17.5" y1="6.5" x2="17.51" y2="6.5"></line>
                            </svg>
                        </a>
                        <a href="#" class="text-muted-foreground hover:text-primary transition-all hover:scale-110" title="TikTok">
                            <svg class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M9 12a4 4 0 1 0 4 4V4a5 5 0 0 0 5 5"></path>
                            </svg>
                        </a>
                        <a href="#" class="text-muted-foreground hover:text-primary transition-all hover:scale-110" title="Facebook">
                            <svg class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M18 2h-3a5 5 0 0 0-5 5v3H7v4h3v8h4v-8h3l1-4h-4V7a1 1 0 0 1 1-1h3z"></path>
                            </svg>
                        </a>
                        <a href="#" class="text-muted-foreground hover:text-primary transition-all hover:scale-110" title="LinkedIn">
                            <svg class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M16 8a6 6 0 0 1 6 6v7h-4v-7a2 2 0 0 0-2-2 2 2 0 0 0-2 2v7h-4v-7a6 6 0 0 1 6-6z"></path>
                                <rect x="2" y="9" width="4" height="12"></rect>
                                <circle cx="4" cy="4" r="2"></circle>
                            </svg>
                        </a>
                    </div>
                </div>
            </div>

            <!-- 3. Legal Section (Right Aligned) -->
            <div class="space-y-4 md:text-right">
                <h3 class="text-xs font-black uppercase tracking-widest text-foreground">Mention Légal</h3>
                <ul role="list" class="space-y-3">
                    <li><a href="#" class="text-sm text-muted-foreground hover:text-primary transition-colors">Politique d'utilisation</a></li>
                    <li><a href="#" class="text-sm text-muted-foreground hover:text-primary transition-colors">Confidentialité</a></li>
                    <li><a href="#" class="text-sm text-muted-foreground hover:text-primary transition-colors">CGU</a></li>
                </ul>
            </div>
        </div>

        <!-- Bottom Bar -->
        <div class="mt-10 pt-6 border-t border-border flex flex-col md:flex-row justify-between items-center gap-4">
            <p class="text-[10px] uppercase font-bold tracking-widest text-muted-foreground/60">
                &copy; {{ date('Y') }} KpiHub. Tous droits réservés.
            </p>
            <p class="text-[10px] uppercase font-bold tracking-widest text-muted-foreground/60">
                Propulsé par <a href="https://Optix.com" class="text-primary hover:underline decoration-2 underline-offset-4">Optix</a>
            </p>
        </div>
    </div>
</footer>
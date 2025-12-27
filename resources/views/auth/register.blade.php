<x-guest-layout>
    <div
        x-data="{
            role: '{{ old('role', \App\Enums\UserRole::Influencer->value) }}',
            platform: '{{ old('main_platform', '') }}',
            profileUrl: '{{ old('profile_url', '') }}',
            pseudo: '{{ old('pseudo', '') }}',
            niche: '{{ old('niche', '') }}',
            industry: '{{ old('industry', '') }}',
            urlError: '',
            get isInfluencer() { return this.role === 'influencer'; },
            get isEnterprise() { return this.role === 'enterprise'; },
            get urlHint() {
                const map = {
                    tiktok: 'Ex: https://www.tiktok.com/@votre_compte',
                    instagram: 'Ex: https://www.instagram.com/votre_compte',
                    youtube: 'Ex: https://www.youtube.com/@votre_compte',
                    linkedin: 'Ex: https://www.linkedin.com/in/votre-profil',
                };
                return map[this.platform] ?? '';
            },
            validateUrl() {
                if (!this.platform || !this.profileUrl) {
                    this.urlError = '';
                    return;
                }
                const patterns = {
                    tiktok: /^https:\/\/www\.tiktok\.com\/@[\w.\-]+$/i,
                    instagram: /^https:\/\/(www\.)?instagram\.com\/[A-Za-z0-9._\-]+\/?$/i,
                    youtube: /^https:\/\/(www\.)?youtube\.com\/(c\/|channel\/|@)[A-Za-z0-9._\-]+$/i,
                    linkedin: /^https:\/\/(www\.)?linkedin\.com\/in\/[A-Za-z0-9.\-_%]+\/?$/i,
                };
                this.urlError = patterns[this.platform]?.test(this.profileUrl.trim()) ?
                    '' :
                    'Lien invalide pour la plateforme choisie.';
            }
        }"
        class="w-full space-y-6">
        <div class="text-center space-y-2">
            <p class="inline-flex items-center gap-2 rounded-full bg-primary/10 px-4 py-1.5 text-[10px] font-black uppercase tracking-widest text-primary shadow-sm border border-primary/20">
                Créez votre compte KpiHub
            </p>
            <h1 class="text-3xl font-black text-title tracking-tight">Pilotez vos campagnes en <span class="text-primary italic">confiance</span></h1>
            <p class="text-sm text-muted-foreground font-medium">Choisissez votre rôle pour commencer.</p>
        </div>

        <form method="POST" action="{{ route('register') }}" class="space-y-4">
            @csrf

            <!-- 1. Role Selection -->
            <div class="space-y-2 pb-2">
                <x-input-label for="role" :value="__('Vous êtes ? *')" class="text-xs font-black uppercase tracking-widest text-primary" />
                <div class="relative">
                    <select
                        id="role"
                        name="role"
                        x-model="role"
                        class="input-field border-2 border-primary/30 focus:border-primary bg-card text-foreground font-bold appearance-none cursor-pointer">
                        @foreach (\App\Enums\UserRole::cases() as $role)
                        @continue($role === \App\Enums\UserRole::Admin)
                        <option value="{{ $role->value }}" class="bg-card text-foreground">
                            {{ $role->label() }}
                        </option>
                        @endforeach
                    </select>
                    <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-4 text-primary">
                        <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M19 9l-7 7-7-7"></path>
                        </svg>
                    </div>
                </div>
                <x-input-error :messages="$errors->get('role')" class="mt-1" />
            </div>

            <!-- Unified Form Grid -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">

                <!-- Fields for User/Influencer: Nom & Prénom -->
                <div x-show="role !== 'enterprise'" class="space-y-2">
                    <x-input-label for="last_name" :value="__('Nom *')" />
                    <x-text-input id="last_name" class="input-field" type="text" name="last_name" :value="old('last_name')" ::required="role !== 'enterprise'" autocomplete="family-name" />
                    <x-input-error :messages="$errors->get('last_name')" class="mt-1" />
                </div>

                <div x-show="role !== 'enterprise'" class="space-y-2">
                    <x-input-label for="first_name" :value="__('Prénom *')" />
                    <x-text-input id="first_name" class="input-field" type="text" name="first_name" :value="old('first_name')" ::required="role !== 'enterprise'" autocomplete="given-name" />
                    <x-input-error :messages="$errors->get('first_name')" class="mt-1" />
                </div>

                <!-- Fields for Enterprise: Company Name & Industry -->
                <div x-show="role === 'enterprise'" class="space-y-2" x-cloak>
                    <x-input-label for="company_name" :value="__('Nom de l\'entreprise *')" />
                    <x-text-input id="company_name" class="input-field" type="text" name="company_name" :value="old('company_name')" ::required="role === 'enterprise'" />
                    <x-input-error :messages="$errors->get('company_name')" class="mt-1" />
                </div>

                <div x-show="role === 'enterprise'" class="space-y-2" x-cloak>
                    <x-input-label for="industry" :value="__('Domaine d\'activité *')" />
                    <div class="relative">
                        <select id="industry" name="industry" x-model="industry" class="input-field appearance-none bg-card text-foreground font-bold cursor-pointer pr-10" ::required="role === 'enterprise'">
                            <option value="">{{ __('Sélectionner') }}</option>
                            @foreach(['Agroalimentaire', 'Automobile', 'Banque / Assurance', 'BTP / Construction', 'Commerce / Retail', 'Communication / Médias', 'Éducation / Formation', 'Électronique / Tech', 'Énergie / Environnement', 'Finance / Conseil', 'Hôtellerie / Restauration', 'Immobilier', 'Industrie Pharmaceutique', 'Informatique / Télécoms', 'Luxe / Cosmétique', 'Mode / Textile', 'Santé / Médical', 'Services aux entreprises', 'Sport / Loisirs', 'Transport / Logistique', 'Voyage / Tourisme', 'E-commerce'] as $item)
                            <option value="{{ $item }}">{{ $item }}</option>
                            @endforeach
                            <option value="Autre">{{ __('Autre') }}</option>
                        </select>
                        <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-4 text-muted-foreground">
                            <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M19 9l-7 7-7-7"></path>
                            </svg>
                        </div>
                    </div>
                    <x-input-error :messages="$errors->get('industry')" class="mt-1" />
                </div>

                <!-- Enterprise specific: Industry Other -->
                <div x-show="role === 'enterprise' && industry === 'Autre'" class="col-span-full space-y-2" x-cloak>
                    <x-input-label for="industry_other" :value="__('Précisez votre domaine d\'activité *')" />
                    <x-text-input id="industry_other" name="industry_other" type="text" class="input-field" :value="old('industry_other')" ::required="industry === 'Autre'" />
                    <x-input-error :messages="$errors->get('industry_other')" class="mt-1" />
                </div>

                <!-- Email (Full width on User, half on Influencer/Enterprise) -->
                <div class="space-y-2" :class="(role === 'influencer' || role === 'enterprise') ? '' : 'col-span-full'">
                    <x-input-label for="email" :value="__('Email *')" />
                    <x-text-input id="email" class="input-field" type="email" name="email" :value="old('email')" required autocomplete="username" />
                    <x-input-error :messages="$errors->get('email')" class="mt-1" />
                </div>

                <!-- Influencer specific: Pseudo -->
                <div x-show="role === 'influencer'" class="space-y-2" x-cloak>
                    <x-input-label for="pseudo" :value="__('Pseudo / Nom d\'artiste *')" />
                    <x-text-input id="pseudo" class="input-field" type="text" name="pseudo" x-model="pseudo" ::required="role === 'influencer'" placeholder="Ex: @votre_pseudo" />
                    <x-input-error :messages="$errors->get('pseudo')" class="mt-1" />
                </div>

                <!-- Enterprise specific: Website -->
                <div x-show="role === 'enterprise'" class="space-y-2" x-cloak>
                    <x-input-label for="website" :value="__('Site internet (optionnel)')" />
                    <x-text-input id="website" class="input-field" type="url" name="website" :value="old('website')" />
                    <x-input-error :messages="$errors->get('website')" class="mt-1" />
                </div>

                <!-- Influencer specific: Niche & Platform -->
                <div x-show="role === 'influencer'" class="space-y-2" x-cloak>
                    <x-input-label for="niche" :value="__('Votre Niche *')" />
                    <div class="relative">
                        <select id="niche" name="niche" x-model="niche" class="input-field appearance-none bg-card text-foreground font-bold cursor-pointer pr-10" ::required="role === 'influencer'">
                            <option value="">{{ __('Sélectionner') }}</option>
                            @foreach(['Education', 'Humour/Comédie', 'Cuisine/Food', 'Art/Design', 'Technologie', 'Voyage', 'Mode/Beauté', 'Fitness/Sport', 'Gaming', 'Musique', 'Danse', 'Animaux', 'Lifestyle', 'Business/Finance', 'Développement Personnel', 'Actualités/Politique', 'Science'] as $item)
                            <option value="{{ $item }}">{{ $item }}</option>
                            @endforeach
                            <option value="Autre">{{ __('Autre') }}</option>
                        </select>
                        <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-4 text-muted-foreground">
                            <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M19 9l-7 7-7-7"></path>
                            </svg>
                        </div>
                    </div>
                    <x-input-error :messages="$errors->get('niche')" class="mt-1" />
                </div>

                <div x-show="role === 'influencer'" class="space-y-2" x-cloak>
                    <x-input-label for="main_platform" :value="__('Plateforme principale *')" />
                    <div class="relative">
                        <select
                            id="main_platform"
                            name="main_platform"
                            x-model="platform"
                            class="input-field appearance-none bg-card text-foreground font-bold cursor-pointer pr-10"
                            ::required="role === 'influencer'">
                            <option value="">{{ __('Sélectionner') }}</option>
                            <option value="tiktok">TikTok</option>
                            <option value="instagram">Instagram</option>
                            <option value="youtube">YouTube</option>
                            <option value="linkedin">LinkedIn</option>
                            <option value="twitter">Twitter</option>
                            <option value="facebook">Facebook</option>
                        </select>
                        <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-4 text-muted-foreground">
                            <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M19 9l-7 7-7-7"></path>
                            </svg>
                        </div>
                    </div>
                    <x-input-error :messages="$errors->get('main_platform')" class="mt-1" />
                </div>

                <!-- Influencer specific: Niche Other (Full width) -->
                <div x-show="role === 'influencer' && niche === 'Autre'" class="col-span-full space-y-2" x-cloak>
                    <x-input-label for="niche_other" :value="__('Précisez votre niche *')" />
                    <x-text-input id="niche_other" name="niche_other" type="text" class="input-field" :value="old('niche_other')" ::required="niche === 'Autre'" />
                    <x-input-error :messages="$errors->get('niche_other')" class="mt-1" />
                </div>

                <!-- Influencer specific: Profile URL (Full width) -->
                <div x-show="role === 'influencer'" class="col-span-full space-y-2" x-cloak>
                    <x-input-label for="profile_url" :value="__('Lien de votre profil *')" />
                    <x-text-input
                        id="profile_url"
                        name="profile_url"
                        x-model="profileUrl"
                        @input="validateUrl()"
                        class="input-field"
                        type="url"
                        ::required="role === 'influencer'"
                        placeholder="https://www.tiktok.com/@votre_compte" />
                    <div class="flex flex-col gap-1">
                        <p x-text="urlHint" class="text-[10px] text-muted-foreground font-medium"></p>
                        <p x-show="urlError" x-text="urlError" class="text-[10px] text-red-500 font-bold"></p>
                    </div>
                    <x-input-error :messages="$errors->get('profile_url')" class="mt-1" />
                </div>

                <!-- Security Fields (Always bottom, 2 columns) -->
                <div class="space-y-2 pt-2 md:pt-4 border-t border-border col-span-full">
                    <p class="text-[10px] font-black uppercase tracking-widest text-muted-foreground mb-4">{{ __('Sécurité du compte') }}</p>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div class="space-y-2">
                            <x-input-label for="password" :value="__('Mot de passe *')" />
                            <x-text-input id="password" class="input-field" type="password" name="password" required autocomplete="new-password" />
                            <x-input-error :messages="$errors->get('password')" class="mt-1" />
                        </div>

                        <div class="space-y-2">
                            <x-input-label for="password_confirmation" :value="__('Confirmer le mot de passe *')" />
                            <x-text-input id="password_confirmation" class="input-field" type="password" name="password_confirmation" required autocomplete="new-password" />
                            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-1" />
                        </div>
                    </div>
                </div>
            </div>

            <!-- 6. Footer Actions -->
            <div class="flex items-center justify-between pt-6">
                <a class="text-sm font-semibold text-[var(--kpihub-ink)] hover:text-[var(--kpihub-primary)]" href="{{ route('login') }}">
                    {{ __('Déjà inscrit ?') }}
                </a>

                <x-primary-button>
                    {{ __('Créer mon compte') }}
                </x-primary-button>
            </div>
        </form>
    </div>
</x-guest-layout>
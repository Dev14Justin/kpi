<section>
    <header>
        <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
            {{ __('Profile Information') }}
        </h2>
        <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
            {{ __("Mettez à jour les informations de votre profil.") }}
        </p>
    </header>

    <form id="send-verification" method="post" action="{{ route('verification.send') }}">
        @csrf
    </form>

    <form method="post" action="{{ route('profile.update') }}" class="mt-6 space-y-6" enctype="multipart/form-data">
        @csrf
        @method('patch')

        <!-- Photo de Profil -->
        <div class="mb-6">
            <x-input-label for="profile_photo_path" :value="__('Photo de Profil')" />
            <div class="mt-2 flex items-center gap-4">
                @if($user->profile_photo_path)
                <img src="{{ asset('storage/' . $user->profile_photo_path) }}" alt="Photo de profil" class="w-20 h-20 rounded-full object-cover">
                @else
                <div class="w-20 h-20 rounded-full bg-accent/20 flex items-center justify-center text-accent text-2xl font-bold">
                    {{ substr($user->first_name ?? $user->name ?? 'U', 0, 1) }}
                </div>
                @endif
                <input type="file" id="profile_photo_path" name="profile_photo_path" accept="image/*" class="block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-primary file:text-white hover:file:bg-primary/80">
            </div>
            <x-input-error class="mt-2" :messages="$errors->get('profile_photo_path')" />
        </div>

        <!-- Common Info -->
        <h3 class="text-md font-bold text-white border-b border-gray-700 pb-2 mb-4">Informations Personnelles</h3>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <div>
                <x-input-label for="last_name">
                    <span>Nom</span>
                    <span class="text-red-500">*</span>
                </x-input-label>
                <x-text-input id="last_name" name="last_name" type="text" class="mt-1 block w-full" :value="old('last_name', $user->last_name)" required />
                <x-input-error class="mt-2" :messages="$errors->get('last_name')" />
            </div>

            <div>
                <x-input-label for="first_name">
                    <span>Prénom</span>
                    <span class="text-red-500">*</span>
                </x-input-label>
                <x-text-input id="first_name" name="first_name" type="text" class="mt-1 block w-full" :value="old('first_name', $user->first_name)" required autofocus />
                <x-input-error class="mt-2" :messages="$errors->get('first_name')" />
            </div>

            <div>
                <x-input-label for="email">
                    <span>Email</span>
                    <span class="text-red-500">*</span>
                </x-input-label>
                <x-text-input id="email" name="email" type="email" class="mt-1 block w-full" :value="old('email', $user->email)" required autocomplete="username" />
                <x-input-error class="mt-2" :messages="$errors->get('email')" />
            </div>

            @if($user->role !== \App\Enums\UserRole::Enterprise)
            <div>
                <x-input-label for="gender" :value="__('Genre')" />
                <select id="gender" name="gender" class="mt-1 block w-full border-gray-300 dark:border-white/10 dark:bg-[#282828] dark:text-gray-300 focus:border-accent dark:focus:border-accent focus:ring-accent dark:focus:ring-accent rounded-md shadow-sm">
                    <option value="">Selectionner</option>
                    <option value="male" {{ old('gender', $user->gender) === 'male' ? 'selected' : '' }}>Masculin</option>
                    <option value="female" {{ old('gender', $user->gender) === 'female' ? 'selected' : '' }}>Féminin</option>
                </select>
            </div>

            <div>
                <x-input-label for="professional_title" :value="__('Titre Professionnel')" />
                <x-text-input id="professional_title" name="professional_title" type="text" class="mt-1 block w-full" :value="old('professional_title', $user->professional_title)" placeholder="Ex: Créateur de contenu" />
            </div>

            <div>
                <x-input-label for="country" :value="__('Pays')" />
                <x-text-input id="country" name="country" type="text" class="mt-1 block w-full" :value="old('country', $user->country)" />
            </div>

            <div>
                <x-input-label for="city" :value="__('Ville')" />
                <x-text-input id="city" name="city" type="text" class="mt-1 block w-full" :value="old('city', $user->city)" />
            </div>

            <div>
                <x-input-label for="phone" :value="__('Téléphone')" />
                <x-text-input id="phone" name="phone" type="text" class="mt-1 block w-full" :value="old('phone', $user->phone)" />
            </div>
            @endif
        </div>

        @if($user->role !== \App\Enums\UserRole::Enterprise)
        <div class="mt-4">
            <x-input-label for="bio" :value="__('À propos de vous')" />
            <textarea id="bio" name="bio" rows="3" class="mt-1 block w-full border-gray-300 dark:border-white/10 dark:bg-[#282828] dark:text-gray-300 focus:border-accent dark:focus:border-accent focus:ring-accent dark:focus:ring-accent rounded-md shadow-sm">{{ old('bio', $user->bio) }}</textarea>
        </div>

        @if($user->role !== \App\Enums\UserRole::Influencer)
        <div class="mt-4">
            <h4 class="text-sm font-medium text-gray-300 mb-2">Réseaux Sociaux (Personnels)</h4>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                @foreach(['tiktok', 'instagram', 'youtube', 'linkedin', 'twitter', 'facebook'] as $network)
                <div>
                    <x-input-label for="social_links_{{$network}}" :value="ucfirst($network)" />
                    <x-text-input id="social_links_{{$network}}" name="social_links[{{$network}}]" type="url" class="mt-1 block w-full" :value="old('social_links.'.$network, $user->social_links[$network] ?? '')" placeholder="https://..." />
                </div>
                @endforeach
            </div>
        </div>
        @endif
        @endif


        <!-- Role Specific: Influencer -->
        @if($user->role === \App\Enums\UserRole::Influencer)
        <div class="mt-8 pt-6 border-t border-gray-700">
            <h3 class="text-md font-bold text-accent mb-4">Informations Influenceur</h3>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4" x-data="{ niche: '{{ old('niche', $user->influencerProfile?->niche) }}' }">
                <div>
                    <x-input-label for="pseudo" :value="__('Pseudo')" />
                    <x-text-input id="pseudo" name="pseudo" type="text" class="mt-1 block w-full" :value="old('pseudo', $user->influencerProfile?->pseudo)" />
                </div>

                <div>
                    <x-input-label for="niche" :value="__('Niche')" />
                    <select id="niche" name="niche" x-model="niche" class="mt-1 block w-full border-gray-300 dark:border-white/10 dark:bg-[#282828] dark:text-gray-300 focus:border-accent dark:focus:border-accent focus:ring-accent dark:focus:ring-accent rounded-md shadow-sm">
                        <option value="">Selectionner</option>
                        @foreach(['Education', 'Humour/Comédie', 'Cuisine/Food', 'Art/Design', 'Technologie', 'Voyage', 'Mode/Beauté', 'Fitness/Sport', 'Gaming', 'Musique', 'Danse', 'Animaux', 'Lifestyle', 'Business/Finance', 'Développement Personnel', 'Actualités/Politique', 'Science'] as $item)
                        <option value="{{ $item }}">{{ $item }}</option>
                        @endforeach
                        <option value="Autre">Autre</option>
                    </select>
                </div>

                <div x-show="niche === 'Autre'" class="col-span-full">
                    <x-input-label for="niche_other" :value="__('Précisez votre niche')" />
                    <x-text-input id="niche_other" name="niche_other" type="text" class="mt-1 block w-full" :value="old('niche_other', $user->influencerProfile?->niche_other)" />
                </div>
            </div>

            <!-- Réseaux Sociaux Influenceur -->
            <div class="mt-6">
                <h4 class="text-sm font-medium text-gray-300 mb-2">Réseaux Sociaux</h4>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    @foreach(['tiktok', 'instagram', 'youtube', 'linkedin', 'twitter', 'facebook'] as $network)
                    <div>
                        <x-input-label for="influencer_social_links_{{ $network }}" :value="ucfirst($network)" />
                        <x-text-input id="influencer_social_links_{{ $network }}" name="influencer_social_links[{{ $network }}]" type="url" class="mt-1 block w-full" :value="old('influencer_social_links.'.$network, $user->influencerProfile?->social_links[$network] ?? '')" placeholder="https://..." />
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
        @endif

        <!-- Role Specific: Enterprise -->
        @if($user->role === \App\Enums\UserRole::Enterprise)
        <div class="mt-8 pt-6 border-t border-gray-700">
            <h3 class="text-md font-bold text-accent mb-4">Informations Entreprise</h3>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <x-input-label for="company_name" :value="__('Nom de l\'entreprise')" />
                    <x-text-input id="company_name" name="company_name" type="text" class="mt-1 block w-full" :value="old('company_name', $user->enterpriseProfile?->company_name)" />
                </div>
                <div>
                    <x-input-label for="company_email" :value="__('Email Pro')" />
                    <x-text-input id="company_email" name="company_email" type="email" class="mt-1 block w-full" :value="old('company_email', $user->enterpriseProfile?->company_email)" />
                </div>
                <div>
                    <x-input-label for="company_phone" :value="__('Téléphone Entreprise')" />
                    <x-text-input id="company_phone" name="company_phone" type="text" class="mt-1 block w-full" :value="old('company_phone', $user->enterpriseProfile?->company_phone)" />
                </div>
                <div>
                    <x-input-label for="industry" :value="__('Domaine d\'Activité')" />
                    <x-text-input id="industry" name="industry" type="text" class="mt-1 block w-full" :value="old('industry', $user->enterpriseProfile?->industry)" />
                </div>
                <div>
                    <x-input-label for="website" :value="__('Site Web')" />
                    <x-text-input id="website" name="website" type="url" class="mt-1 block w-full" :value="old('website', $user->enterpriseProfile?->website)" placeholder="https://" />
                </div>
                <div>
                    <x-input-label for="company_country" :value="__('Pays (Siège)')" />
                    <x-text-input id="company_country" name="company_country" type="text" class="mt-1 block w-full" :value="old('company_country', $user->enterpriseProfile?->company_country)" />
                </div>
                <div>
                    <x-input-label for="company_city" :value="__('Ville (Siège)')" />
                    <x-text-input id="company_city" name="company_city" type="text" class="mt-1 block w-full" :value="old('company_city', $user->enterpriseProfile?->company_city)" />
                </div>
            </div>
            <div class="mt-4">
                <x-input-label for="description" :value="__('À propos de l\'Entreprise')" />
                <textarea id="description" name="description" rows="3" class="mt-1 block w-full border-gray-300 dark:border-white/10 dark:bg-[#282828] dark:text-gray-300 focus:border-accent dark:focus:border-accent focus:ring-accent dark:focus:ring-accent rounded-md shadow-sm">{{ old('description', $user->enterpriseProfile?->description) }}</textarea>
            </div>

            <!-- Réseaux Sociaux Entreprise -->
            <div class="mt-6">
                <h4 class="text-sm font-medium text-gray-300 mb-2">Réseaux Sociaux Entreprise</h4>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    @foreach(['tiktok', 'instagram', 'youtube', 'linkedin', 'twitter', 'facebook'] as $network)
                    <div>
                        <x-input-label for="enterprise_social_links_{{ $network }}" :value="ucfirst($network)" />
                        <x-text-input id="enterprise_social_links_{{ $network }}" name="enterprise_social_links[{{ $network }}]" type="url" class="mt-1 block w-full" :value="old('enterprise_social_links.'.$network, $user->enterpriseProfile?->social_links[$network] ?? '')" placeholder="https://..." />
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
        @endif

        <!-- Privacy Settings -->
        <div class="mt-8 pt-6 border-t border-gray-700">
            <h3 class="text-md font-bold text-accent mb-4">Paramètres de visibilité (Profil Public)</h3>
            <p class="text-sm text-gray-400 mb-6">Choisissez les informations que vous souhaitez afficher sur votre profil public.</p>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach([
                'show_email' => 'Afficher l\'email',
                'show_phone' => 'Afficher le téléphone',
                'show_social' => 'Afficher les réseaux sociaux',
                'show_bio' => 'Afficher la biographie',
                'show_professional_title' => 'Afficher le titre professionnel',
                'show_location' => 'Afficher la localisation'
                ] as $key => $label)
                <div class="flex items-center justify-between p-4 bg-white dark:bg-[#282828] rounded-xl border border-gray-200 dark:border-white/5 transition-colors">
                    <span class="text-sm font-medium text-gray-700 dark:text-gray-300">{{ $label }}</span>
                    <label class="relative inline-flex items-center cursor-pointer">
                        <input type="hidden" name="privacy_settings[{{ $key }}]" value="0">
                        <input type="checkbox" name="privacy_settings[{{ $key }}]" value="1"
                            {{ ($user->privacy_settings[$key] ?? true) ? 'checked' : '' }}
                            class="sr-only peer">
                        <div class="w-11 h-6 bg-gray-200 peer-focus:outline-none rounded-full peer dark:bg-gray-700 peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all dark:border-gray-600 peer-checked:bg-accent"></div>
                    </label>
                </div>
                @endforeach
            </div>
        </div>


        <div class="flex items-center gap-4 mt-6">
            <x-primary-button>{{ __('Enregistrer les modifications') }}</x-primary-button>

            @if (session('status') === 'profile-updated')
            <p
                x-data="{ show: true }"
                x-show="show"
                x-transition
                x-init="setTimeout(() => show = false, 2000)"
                class="text-sm text-gray-600 dark:text-gray-400">{{ __('Enregistré.') }}</p>
            @endif
        </div>
    </form>
</section>
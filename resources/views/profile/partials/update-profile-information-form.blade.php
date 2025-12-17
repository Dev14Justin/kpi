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

    <form method="post" action="{{ route('profile.update') }}" class="mt-6 space-y-6">
        @csrf
        @method('patch')

        <!-- Common Info -->
        <h3 class="text-md font-bold text-white border-b border-gray-700 pb-2 mb-4">Informations Personnelles</h3>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <div>
                <x-input-label for="name" :value="__('Nom')" />
                <x-text-input id="name" name="name" type="text" class="mt-1 block w-full" :value="old('name', $user->name)" required autofocus autocomplete="name" />
                <x-input-error class="mt-2" :messages="$errors->get('name')" />
            </div>

            <div>
                <x-input-label for="email" :value="__('Email')" />
                <x-text-input id="email" name="email" type="email" class="mt-1 block w-full" :value="old('email', $user->email)" required autocomplete="username" />
                <x-input-error class="mt-2" :messages="$errors->get('email')" />
            </div>

            <div>
                <x-input-label for="gender" :value="__('Genre')" />
                <select id="gender" name="gender" class="mt-1 block w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm">
                    <option value="">Selectionner</option>
                    <option value="male" {{ old('gender', $user->gender) === 'male' ? 'selected' : '' }}>Masculin</option>
                    <option value="female" {{ old('gender', $user->gender) === 'female' ? 'selected' : '' }}>Féminin</option>
                </select>
            </div>

            <div>
                <x-input-label for="professional_title" :value="__('Titre Professionnel')" />
                <x-text-input id="professional_title" name="professional_title" type="text" class="mt-1 block w-full" :value="old('professional_title', $user->professional_title)" placeholder="Ex: Développeur Web" />
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
        </div>

        <div class="mt-4">
            <x-input-label for="bio" :value="__('À propos de vous')" />
            <textarea id="bio" name="bio" rows="3" class="mt-1 block w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm">{{ old('bio', $user->bio) }}</textarea>
        </div>

        <div class="mt-4">
            <h4 class="text-sm font-medium text-gray-300 mb-2">Réseaux Sociaux (Personnels)</h4>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                @foreach(['tiktok', 'instagram', 'youtube', 'linkedin', 'twitter'] as $network)
                <div>
                    <x-input-label for="social_links_{{ $network }}" :value="ucfirst($network)" />
                    <x-text-input id="social_links_{{ $network }}" name="social_links[{{ $network }}]" type="url" class="mt-1 block w-full" :value="old('social_links.'.$network, $user->social_links[$network] ?? '')" placeholder="https://..." />
                </div>
                @endforeach
            </div>
        </div>

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
                    <select id="niche" name="niche" x-model="niche" class="mt-1 block w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm">
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
                    <x-input-label for="industry" :value="__('Domaine d\'Activité')" />
                    <x-text-input id="industry" name="industry" type="text" class="mt-1 block w-full" :value="old('industry', $user->enterpriseProfile?->industry)" />
                </div>
                <div>
                    <x-input-label for="website" :value="__('Site Web')" />
                    <x-text-input id="website" name="website" type="url" class="mt-1 block w-full" :value="old('website', $user->enterpriseProfile?->website)" placeholder="https://" />
                </div>
                <div>
                    <x-input-label for="company_country" :value="__('Pays (Siège)' )" />
                    <x-text-input id="company_country" name="company_country" type="text" class="mt-1 block w-full" :value="old('company_country', $user->enterpriseProfile?->company_country)" />
                </div>
                <div>
                    <x-input-label for="company_city" :value="__('Ville (Siège)')" />
                    <x-text-input id="company_city" name="company_city" type="text" class="mt-1 block w-full" :value="old('company_city', $user->enterpriseProfile?->company_city)" />
                </div>
            </div>
            <div class="mt-4">
                <x-input-label for="description" :value="__('À propos de l\'Entreprise')" />
                <textarea id="description" name="description" rows="3" class="mt-1 block w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm">{{ old('description', $user->enterpriseProfile?->description) }}</textarea>
            </div>
        </div>
        @endif


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
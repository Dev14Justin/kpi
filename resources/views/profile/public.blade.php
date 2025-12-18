<x-dynamic-component :component="auth()->id() === $user->id ? 'panel-layout' : 'app-layout'">
    <div class="{{ auth()->id() === $user->id ? 'space-y-6' : 'max-w-7xl mx-auto py-10 px-4 sm:px-6 lg:px-8 space-y-6' }}">
        <!-- Profile Header -->
        <div class="bg-white dark:bg-[#1C1C1C] rounded-2xl border border-gray-200 dark:border-white/5 overflow-hidden shadow-sm">
            <div class="h-32 bg-accent/10"></div>
            <div class="px-6 pb-6 relative">
                <div class="flex flex-col md:flex-row md:items-end -mt-12 gap-4">
                    <div class="relative">
                        @if($user->profile_photo_path)
                        <img src="{{ asset('storage/' . $user->profile_photo_path) }}"
                            alt="Photo de profil"
                            class="w-32 h-32 rounded-2xl object-cover border-4 border-white dark:border-[#1C1C1C] shadow-md">
                        @else
                        <div class="w-32 h-32 rounded-2xl bg-accent flex items-center justify-center text-white text-4xl font-bold border-4 border-white dark:border-[#1C1C1C] shadow-md">
                            {{ substr($user->first_name ?? $user->name ?? 'U', 0, 1) }}
                        </div>
                        @endif
                    </div>
                    <div class="flex-1 min-w-0">
                        <div class="flex flex-wrap items-center gap-3">
                            <h2 class="text-3xl font-bold text-gray-900 dark:text-white truncate">
                                {{ $user->first_name }} {{ $user->last_name }}
                            </h2>
                            <span class="px-3 py-1 rounded-full border border-primary/30 bg-primary/10 text-primary text-xs font-semibold uppercase tracking-wider">
                                {{ $user->role->label() ?? 'Utilisateur' }}
                            </span>
                        </div>
                        @if($user->privacy_settings['show_professional_title'] ?? true)
                        <p class="text-gray-600 dark:text-gray-400 font-medium">
                            {{ $user->professional_title ?? 'Membre KpiHub' }}
                        </p>
                        @endif
                    </div>
                    @auth
                    @if(auth()->id() === $user->id)
                    <div class="flex gap-3">
                        <a href="{{ route('profile.edit') }}"
                            class="inline-flex items-center px-6 py-2 rounded-xl border border-accent text-accent font-bold transition hover:bg-accent hover:text-white">
                            Modifier
                        </a>
                    </div>
                    @endif
                    @endauth
                </div>
            </div>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
            <!-- Left Column: Details -->
            <div class="space-y-6">
                <!-- Info Section -->
                <div class="bg-white dark:bg-[#1C1C1C] rounded-2xl p-6 border border-gray-200 dark:border-white/5 shadow-sm">
                    <h3 class="text-lg font-bold text-gray-900 dark:text-white mb-4">Informations</h3>
                    <div class="space-y-4">
                        @if($user->privacy_settings['show_email'] ?? true)
                        <div class="flex items-center gap-3">
                            <div class="w-10 h-10 rounded-lg bg-gray-100 dark:bg-white/5 flex items-center justify-center text-gray-400">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                                </svg>
                            </div>
                            <div class="min-w-0">
                                <p class="text-xs text-gray-500 uppercase font-bold tracking-wider">Email</p>
                                <p class="text-gray-900 dark:text-gray-300 font-medium truncate">{{ $user->email }}</p>
                            </div>
                        </div>
                        @endif

                        @if(($user->privacy_settings['show_phone'] ?? true) && $user->phone)
                        <div class="flex items-center gap-3">
                            <div class="w-10 h-10 rounded-lg bg-gray-100 dark:bg-white/5 flex items-center justify-center text-gray-400">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path>
                                </svg>
                            </div>
                            <div>
                                <p class="text-xs text-gray-500 uppercase font-bold tracking-wider">Téléphone</p>
                                <p class="text-gray-900 dark:text-gray-300 font-medium">{{ $user->phone }}</p>
                            </div>
                        </div>
                        @endif

                        @if(($user->privacy_settings['show_location'] ?? true) && ($user->country || $user->city))
                        <div class="flex items-center gap-3">
                            <div class="w-10 h-10 rounded-lg bg-gray-100 dark:bg-white/5 flex items-center justify-center text-gray-400">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                </svg>
                            </div>
                            <div>
                                <p class="text-xs text-gray-500 uppercase font-bold tracking-wider">Localisation</p>
                                <p class="text-gray-900 dark:text-gray-300 font-medium">
                                    {{ $user->city }}{{ $user->city && $user->country ? ', ' : '' }}{{ $user->country }}
                                </p>
                            </div>
                        </div>
                        @endif
                    </div>
                </div>

                <!-- Social Links -->
                @if(($user->privacy_settings['show_social'] ?? true) && $user->social_links && count(array_filter($user->social_links)) > 0)
                <div class="bg-white dark:bg-[#1C1C1C] rounded-2xl p-6 border border-gray-200 dark:border-white/5 shadow-sm">
                    <h3 class="text-lg font-bold text-gray-900 dark:text-white mb-4">Réseaux Sociaux</h3>
                    <div class="flex flex-wrap gap-3">
                        @foreach($user->social_links as $platform => $url)
                        @if($url)
                        <a href="{{ $url }}" target="_blank"
                            class="w-10 h-10 rounded-lg bg-gray-100 dark:bg-white/5 flex items-center justify-center text-gray-500 hover:text-accent hover:bg-accent/10 transition">
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M12 2C6.477 2 2 6.477 2 12c0 5.523 4.477 10 10 10s10-4.477 10-10c0-5.523-4.477-10-10-10zM12 4c4.418 0 8 3.582 8 8s-3.582 8-8 8-8-3.582-8-8 3.582-8 8-8z" />
                            </svg>
                        </a>
                        @endif
                        @endforeach
                    </div>
                </div>
                @endif
            </div>

            <!-- Right Column: Bio & Other -->
            <div class="lg:col-span-2 space-y-6">
                <!-- Bio Section -->
                @if($user->privacy_settings['show_bio'] ?? true)
                <div class="bg-white dark:bg-[#1C1C1C] rounded-2xl p-6 border border-gray-200 dark:border-white/5 shadow-sm">
                    <h3 class="text-lg font-bold text-gray-900 dark:text-white mb-4">À propos</h3>
                    <div class="prose dark:prose-invert max-w-none text-gray-600 dark:text-gray-400">
                        @if($user->bio)
                        <p class="whitespace-pre-line">{{ $user->bio }}</p>
                        @else
                        <p class="italic text-gray-500">Aucune biographie disponible.</p>
                        @endif
                    </div>
                </div>
                @endif

                <!-- Platform Specifics -->
                @if($user->role === \App\Enums\UserRole::Influencer && $user->influencerProfile)
                <div class="bg-white dark:bg-[#1C1C1C] rounded-2xl p-6 border border-gray-200 dark:border-white/5 shadow-sm">
                    <h3 class="text-lg font-bold text-gray-900 dark:text-white mb-4">Statistiques Influenceur</h3>
                    <div class="grid grid-cols-2 sm:grid-cols-3 gap-4">
                        <div class="p-4 rounded-xl bg-gray-50 dark:bg-white/5">
                            <p class="text-xs text-gray-500 font-bold uppercase mb-1">Pseudo</p>
                            <p class="text-gray-900 dark:text-white font-bold">{{ $user->influencerProfile->pseudo ?? 'N/A' }}</p>
                        </div>
                        <div class="p-4 rounded-xl bg-gray-50 dark:bg-white/5">
                            <p class="text-xs text-gray-500 font-bold uppercase mb-1">Niche</p>
                            <p class="text-gray-900 dark:text-white font-bold truncate">
                                {{ $user->influencerProfile->niche === 'Autre' ? $user->influencerProfile->niche_other : ($user->influencerProfile->niche ?? 'N/A') }}
                            </p>
                        </div>
                    </div>
                </div>
                @elseif($user->role === \App\Enums\UserRole::Enterprise && $user->enterpriseProfile)
                <div class="bg-white dark:bg-[#1C1C1C] rounded-2xl p-6 border border-gray-200 dark:border-white/5 shadow-sm">
                    <h3 class="text-lg font-bold text-gray-900 dark:text-white mb-4">Informations Entreprise</h3>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div class="p-4 rounded-xl bg-gray-50 dark:bg-white/5">
                            <p class="text-xs text-gray-500 font-bold uppercase mb-1">Nom</p>
                            <p class="text-gray-900 dark:text-white font-bold">{{ $user->enterpriseProfile->company_name ?? 'N/A' }}</p>
                        </div>
                        <div class="p-4 rounded-xl bg-gray-50 dark:bg-white/5">
                            <p class="text-xs text-gray-500 font-bold uppercase mb-1">Domaine</p>
                            <p class="text-gray-900 dark:text-white font-bold">{{ $user->enterpriseProfile->industry ?? 'N/A' }}</p>
                        </div>
                    </div>
                </div>
                @endif
            </div>
        </div>
    </div>
</x-dynamic-component>
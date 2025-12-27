<x-panel-layout>
    <div class="space-y-6">
        <!-- Profile Header -->
        <div class="bg-white dark:bg-[#1C1C1C] rounded-2xl border border-gray-200 dark:border-white/5 overflow-hidden shadow-sm">
            <div class="h-32 bg-gradient-to-r from-primary/20 to-accent/20"></div>
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
                                @if($user->role === \App\Enums\UserRole::Enterprise && $user->enterpriseProfile)
                                {{ $user->enterpriseProfile->company_name }}
                                @elseif($user->role === \App\Enums\UserRole::Influencer && $user->influencerProfile)
                                {{ $user->influencerProfile->first_name }} {{ $user->influencerProfile->last_name }}
                                @else
                                {{ $user->first_name }} {{ $user->last_name }}
                                @endif
                            </h2>
                            <span class="px-3 py-1 rounded-full border border-primary/30 bg-primary/10 text-primary text-xs font-semibold uppercase tracking-wider">
                                {{ $user->role->label() ?? 'Utilisateur' }}
                            </span>
                        </div>
                        <p class="text-gray-600 dark:text-gray-400 font-medium">
                            @if($user->role === \App\Enums\UserRole::Enterprise && $user->enterpriseProfile)
                            {{ $user->enterpriseProfile->industry ?? 'Entreprise' }}
                            @elseif($user->role === \App\Enums\UserRole::Influencer && $user->influencerProfile)
                            {{ $user->influencerProfile->professional_title ?? 'Influenceur' }}
                            @else
                            {{ $user->professional_title ?? 'Membre KpiHub' }}
                            @endif
                        </p>
                    </div>
                    <div class="flex gap-3">
                        <a href="{{ route('profile.edit') }}"
                            class="inline-flex items-center px-6 py-3 rounded-xl bg-accent text-white font-bold transition hover:bg-accent/90 shadow-lg shadow-accent/20">
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                            </svg>
                            Modifier mon profil
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
            <!-- Left Column: Details -->
            <div class="space-y-6">
                <!-- Contact Info -->
                <div class="bg-white dark:bg-[#1C1C1C] rounded-2xl p-6 border border-gray-200 dark:border-white/5 shadow-sm">
                    <h3 class="text-lg font-bold text-gray-900 dark:text-white mb-4">Informations de contact</h3>
                    <div class="space-y-4">
                        <div class="flex items-center gap-3">
                            <div class="w-10 h-10 rounded-lg bg-gray-100 dark:bg-white/5 flex items-center justify-center text-gray-400">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                                </svg>
                            </div>
                            <div class="min-w-0">
                                <p class="text-xs text-gray-500 uppercase font-bold tracking-wider">Email</p>
                                @php
                                $emailToDisplay = match($user->role) {
                                \App\Enums\UserRole::Influencer => $user->influencerProfile?->email,
                                \App\Enums\UserRole::Enterprise => $user->enterpriseProfile?->company_email,
                                default => $user->email,
                                } ?? $user->email;
                                @endphp
                                <p class="text-gray-900 dark:text-gray-300 font-medium truncate">{{ $emailToDisplay }}</p>
                            </div>
                        </div>

                        @php
                        $phoneToDisplay = match($user->role) {
                        \App\Enums\UserRole::Influencer => $user->influencerProfile?->phone,
                        \App\Enums\UserRole::Enterprise => $user->enterpriseProfile?->company_phone,
                        default => $user->phone,
                        } ?? $user->phone;
                        @endphp
                        @if($phoneToDisplay)
                        <div class="flex items-center gap-3">
                            <div class="w-10 h-10 rounded-lg bg-gray-100 dark:bg-white/5 flex items-center justify-center text-gray-400">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path>
                                </svg>
                            </div>
                            <div>
                                <p class="text-xs text-gray-500 uppercase font-bold tracking-wider">Téléphone</p>
                                <p class="text-gray-900 dark:text-gray-300 font-medium">{{ $phoneToDisplay }}</p>
                            </div>
                        </div>
                        @endif

                        @php
                        $cityToDisplay = match($user->role) {
                        \App\Enums\UserRole::Influencer => $user->influencerProfile?->city,
                        \App\Enums\UserRole::Enterprise => $user->enterpriseProfile?->company_city,
                        default => $user->city,
                        } ?? $user->city;
                        $countryToDisplay = match($user->role) {
                        \App\Enums\UserRole::Influencer => $user->influencerProfile?->country,
                        \App\Enums\UserRole::Enterprise => $user->enterpriseProfile?->company_country,
                        default => $user->country,
                        } ?? $user->country;
                        @endphp
                        @if($countryToDisplay || $cityToDisplay)
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
                                    {{ $cityToDisplay }}{{ $cityToDisplay && $countryToDisplay ? ', ' : '' }}{{ $countryToDisplay }}
                                </p>
                            </div>
                        </div>
                        @endif
                    </div>
                </div>

                @php
                $socialLinksToDisplay = match($user->role) {
                \App\Enums\UserRole::Influencer => $user->influencerProfile?->social_links,
                \App\Enums\UserRole::Enterprise => $user->enterpriseProfile?->social_links,
                default => $user->social_links,
                } ?? $user->social_links;
                @endphp
                <!-- Social Links -->
                @if($socialLinksToDisplay && count(array_filter($socialLinksToDisplay)) > 0)
                <div class="bg-white dark:bg-[#1C1C1C] rounded-2xl p-6 border border-gray-200 dark:border-white/5 shadow-sm">
                    <h3 class="text-lg font-bold text-gray-900 dark:text-white mb-4">Réseaux Sociaux</h3>
                    <div class="flex flex-wrap gap-3">
                        @foreach($socialLinksToDisplay as $platform => $url)
                        @if($url)
                        <a href="{{ $url }}" target="_blank"
                            class="w-10 h-10 rounded-lg bg-gray-100 dark:bg-white/5 flex items-center justify-center text-gray-600 dark:text-gray-400 hover:text-accent hover:bg-accent/10 transition"
                            title="{{ ucfirst($platform) }}">
                            @switch($platform)
                            @case('tiktok')
                            <i class="fab fa-tiktok"></i>
                            @break
                            @case('instagram')
                            <i class="fab fa-instagram"></i>
                            @break
                            @case('youtube')
                            <i class="fab fa-youtube"></i>
                            @break
                            @case('facebook')
                            <i class="fab fa-facebook"></i>
                            @break
                            @default
                            <i class="fas fa-link"></i>
                            @endswitch
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
                <div class="bg-white dark:bg-[#1C1C1C] rounded-2xl p-6 border border-gray-200 dark:border-white/5 shadow-sm">
                    <h3 class="text-lg font-bold text-gray-900 dark:text-white mb-2">À propos</h3>
                    <div class="prose dark:prose-invert max-w-none text-gray-600 dark:text-gray-400">
                        @php
                        $bioToDisplay = match($user->role) {
                        \App\Enums\UserRole::Influencer => $user->influencerProfile?->bio,
                        \App\Enums\UserRole::Enterprise => $user->enterpriseProfile?->description,
                        default => $user->bio,
                        } ?? $user->bio;
                        @endphp
                        @if($bioToDisplay)
                        <p class="whitespace-pre-line">{{ $bioToDisplay }}</p>
                        @else
                        <p class="italic">Aucune information renseignée.</p>
                        @endif
                    </div>
                </div>

                <!-- Influenceur / Enterprise Specific Sections -->
                @if($user->role === \App\Enums\UserRole::Influencer && $user->influencerProfile)
                <div class="bg-white dark:bg-[#1C1C1C] rounded-2xl p-6 border border-gray-200 dark:border-white/5 shadow-sm">
                    <h3 class="text-lg font-bold text-gray-900 dark:text-white mb-4">Détails Influenceur</h3>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <p class="text-xs text-gray-500 uppercase font-bold tracking-wider mb-1">Pseudo</p>
                            <p class="text-gray-900 dark:text-gray-200 font-medium">{{ $user->influencerProfile->pseudo ?? 'Non défini' }}</p>
                        </div>
                        <div>
                            <p class="text-xs text-gray-500 uppercase font-bold tracking-wider mb-1">Niche</p>
                            <p class="text-gray-900 dark:text-gray-200 font-medium">
                                {{ $user->influencerProfile->niche === 'Autre' ? $user->influencerProfile->niche_other : ($user->influencerProfile->niche ?? 'Non défini') }}
                            </p>
                        </div>
                    </div>
                </div>
                @elseif($user->role === \App\Enums\UserRole::Enterprise && $user->enterpriseProfile)
                <div class="bg-white dark:bg-[#1C1C1C] rounded-2xl p-6 border border-gray-200 dark:border-white/5 shadow-sm">
                    <h3 class="text-lg font-bold text-gray-900 dark:text-white mb-4">Informations Entreprise</h3>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <p class="text-xs text-gray-500 uppercase font-bold tracking-wider mb-1">Nom</p>
                            <p class="text-gray-900 dark:text-gray-200 font-medium">{{ $user->enterpriseProfile->company_name ?? 'Non défini' }}</p>
                        </div>
                        <div>
                            <p class="text-xs text-gray-500 uppercase font-bold tracking-wider mb-1">Domaine</p>
                            <p class="text-gray-900 dark:text-gray-200 font-medium">{{ $user->enterpriseProfile->industry ?? 'Non défini' }}</p>
                        </div>
                        @if($user->enterpriseProfile->website)
                        <div>
                            <p class="text-xs text-gray-500 uppercase font-bold tracking-wider mb-1">Site Web</p>
                            <a href="{{ $user->enterpriseProfile->website }}" target="_blank" class="text-accent hover:underline font-medium">
                                {{ $user->enterpriseProfile->website }}
                            </a>
                        </div>
                        @endif
                    </div>
                </div>
                @endif
            </div>
        </div>
    </div>
</x-panel-layout>
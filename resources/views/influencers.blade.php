<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between w-full">
            <div>
                <p class="text-sm text-gray-500">Vue d’ensemble</p>
                <h2 class="font-semibold text-xl text-ink leading-tight">
                    {{ __('Dashboard influenceurs') }}
                </h2>
            </div>
        </div>
    </x-slot>

    <div class="py-10">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="bg-white dark:bg-[#2E2E2E] border border-gray-100 dark:border-gray-800 shadow-card rounded-2xl p-6">
                <div class="flex items-center justify-between mb-4">
                    <div>
                        <p class="text-sm text-gray-500">Influenceurs actifs</p>
                        <h3 class="text-xl font-semibold text-ink">{{ $influencers->count() }} profils</h3>
                    </div>
                </div>

                @if($influencers->isEmpty())
                <p class="text-sm text-gray-600 dark:text-gray-400">Aucun influenceur pour le moment.</p>
                @else
                <div class="grid sm:grid-cols-2 lg:grid-cols-3 gap-4">
                    @foreach($influencers as $influencer)
                    <div class="brand-card p-4 flex flex-col gap-3">
                        <div class="flex items-start justify-between">
                            <div>
                                <p class="text-sm text-gray-500">Influenceur</p>
                                <p class="text-lg font-semibold text-ink">{{ $influencer->name }}</p>
                                <p class="text-xs text-gray-500">{{ $influencer->email }}</p>
                            </div>
                            @if($influencer->main_platform)
                            <span class="brand-pill capitalize">{{ $influencer->main_platform }}</span>
                            @endif
                        </div>
                        @if($influencer->profile_url)
                        <a href="{{ $influencer->profile_url }}" target="_blank" class="text-sm font-semibold text-primary underline">
                            Voir le profil
                        </a>
                        @else
                        <p class="text-sm text-gray-500">Profil non renseigné</p>
                        @endif
                        <div class="text-xs text-gray-500">
                            Créé le {{ $influencer->created_at?->format('d M Y') }}
                        </div>
                    </div>
                    @endforeach
                </div>
                @endif
            </div>
        </div>
    </div>
</x-app-layout>
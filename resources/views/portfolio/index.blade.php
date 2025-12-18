<x-panel-layout>
    <div class="space-y-8">
        <div class="flex items-center justify-between">
            <div>
                <h1 class="text-3xl font-bold text-gray-900 dark:text-white">Mon Portfolio</h1>
                <p class="text-gray-600 dark:text-gray-400 mt-1">Votre vitrine publique pour les marques.</p>
            </div>
            <a href="{{ route('profile.public', auth()->user()) }}" class="btn-secondary">
                Voir mon portfolio public
            </a>
        </div>

        <div class="bg-white dark:bg-[#1C1C1C] rounded-2xl border border-gray-200 dark:border-white/5 shadow-sm overflow-hidden">
            <div class="p-12 text-center">
                <div class="w-16 h-16 bg-gray-100 dark:bg-white/5 rounded-2xl flex items-center justify-center mx-auto mb-4 text-gray-400">
                    <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path>
                    </svg>
                </div>
                <p class="text-gray-600 dark:text-gray-400 font-medium italic">Votre portfolio est vide.</p>
            </div>
        </div>
    </div>
</x-panel-layout>
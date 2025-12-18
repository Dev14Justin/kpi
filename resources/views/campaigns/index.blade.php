<x-panel-layout>
    <div class="space-y-8">
        <div class="flex items-center justify-between">
            <div>
                <h1 class="text-3xl font-bold text-gray-900 dark:text-white">Mes Campagnes</h1>
                <p class="text-gray-600 dark:text-gray-400 mt-1">Gérez vos campagnes marketing ici.</p>
            </div>
            <a href="#" class="btn-primary">
                Créer une campagne
            </a>
        </div>

        <div class="bg-white dark:bg-[#1C1C1C] rounded-2xl border border-gray-200 dark:border-white/5 shadow-sm overflow-hidden">
            <div class="p-12 text-center">
                <div class="w-16 h-16 bg-gray-100 dark:bg-white/5 rounded-2xl flex items-center justify-center mx-auto mb-4 text-gray-400">
                    <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path>
                    </svg>
                </div>
                <p class="text-gray-600 dark:text-gray-400 font-medium italic">Aucune campagne pour le moment.</p>
            </div>
        </div>
    </div>
</x-panel-layout>
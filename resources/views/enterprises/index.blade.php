<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-ink leading-tight">
            {{ __('Entreprises') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-[#1C1C1C] overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-ink">
                    <p>Liste des entreprises inscrites sur la plateforme.</p>

                    <div class="mt-6 grid gap-6 md:grid-cols-2 lg:grid-cols-3">
                        @forelse($enterprises as $enterprise)
                        <div class="p-4 border border-gray-100 dark:border-white/10 rounded-lg">
                            <h3 class="font-bold text-lg">{{ $enterprise->name }}</h3>
                            <p class="text-sm text-gray-500">{{ $enterprise->email }}</p>
                            <span class="inline-block mt-2 px-2 py-1 text-xs rounded bg-accent/10 text-accent dark:bg-accent/20 dark:text-accent">Entreprise</span>
                        </div>
                        @empty
                        <p class="text-gray-500">Aucune entreprise trouvée.</p>
                        @endforelse
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
<x-panel-layout>
    <div class="space-y-6">
        <!-- Header Profile Info -->
        <div class="bg-[#1C1C1C] rounded-2xl p-6 border border-white/5 flex items-center justify-between">
            <div class="flex items-center gap-4">
                <div class="w-16 h-16 rounded-full bg-accent/20 flex items-center justify-center text-accent text-2xl font-bold">
                    {{ substr($user->name, 0, 1) }}
                </div>
                <div>
                    <h2 class="text-2xl font-bold text-white">{{ $user->name }}</h2>
                    <p class="text-gray-400">{{ $user->email }}</p>
                </div>
            </div>
            <div class="px-4 py-2 rounded-full border border-primary/20 bg-primary/10 text-primary text-sm font-medium capitalize">
                {{ $user->role->value ?? 'Utilisateur' }}
            </div>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
            <!-- Left Column: Profile Info -->
            <div class="space-y-6">
                <div class="p-4 sm:p-8 bg-[#1C1C1C] rounded-2xl border border-white/5 shadow-sm">
                    <div class="max-w-xl">
                        @include('profile.partials.update-profile-information-form')
                    </div>
                </div>
            </div>

            <!-- Right Column: Security -->
            <div class="space-y-6">
                <div class="p-4 sm:p-8 bg-[#1C1C1C] rounded-2xl border border-white/5 shadow-sm">
                    <div class="max-w-xl">
                        @include('profile.partials.update-password-form')
                    </div>
                </div>

                <div class="p-4 sm:p-8 bg-red-900/10 rounded-2xl border border-red-500/20 shadow-sm">
                    <div class="max-w-xl">
                        @include('profile.partials.delete-user-form')
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-panel-layout>
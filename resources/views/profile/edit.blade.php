<x-panel-layout>
    <div class="space-y-6">
        <!-- Header Profile Info -->
        <div class="bg-white dark:bg-[#1C1C1C] rounded-2xl p-6 border border-gray-200 dark:border-white/5 shadow-sm flex items-center justify-between">
            <div class="flex items-center gap-4">
                @if($user->profile_photo_path)
                <img src="{{ asset('storage/' . $user->profile_photo_path) }}" alt="Photo de profil" class="w-16 h-16 rounded-full object-cover ring-2 ring-accent/20">
                @else
                <div class="w-16 h-16 rounded-full bg-accent flex items-center justify-center text-white text-2xl font-bold">
                    {{ substr($user->first_name ?? $user->name ?? 'U', 0, 1) }}
                </div>
                @endif
                <div>
                    <h2 class="text-2xl font-bold text-gray-900 dark:text-white">{{ $user->first_name }} {{ $user->last_name }}</h2>
                    <p class="text-gray-600 dark:text-gray-400">{{ $user->email }}</p>
                </div>
            </div>
            <div class="px-4 py-2 rounded-full border border-primary/30 bg-primary/10 text-primary text-sm font-medium capitalize">
                {{ $user->role->value ?? 'Utilisateur' }}
            </div>
        </div>

        <!-- One Column Layout -->
        <div class="space-y-6">
            <!-- Profile Information -->
            <div class="p-4 sm:p-8 bg-white dark:bg-[#1C1C1C] rounded-2xl border border-gray-200 dark:border-white/5 shadow-sm">
                <div class="max-w-4xl">
                    @include('profile.partials.update-profile-information-form')
                </div>
            </div>

            <!-- Update Password -->
            <div class="p-4 sm:p-8 bg-white dark:bg-[#1C1C1C] rounded-2xl border border-gray-200 dark:border-white/5 shadow-sm">
                <div class="max-w-4xl">
                    @include('profile.partials.update-password-form')
                </div>
            </div>

            <!-- Delete Account -->
            <div class="p-4 sm:p-8 bg-red-50 dark:bg-red-900/10 rounded-2xl border border-red-200 dark:border-red-500/20 shadow-sm">
                <div class="max-w-4xl">
                    @include('profile.partials.delete-user-form')
                </div>
            </div>
        </div>
    </div>
</x-panel-layout>
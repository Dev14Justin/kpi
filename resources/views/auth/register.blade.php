<x-guest-layout>
    <div
        x-data="registerForm()"
        class="w-full space-y-6">
        <div class="text-center space-y-2">
            <p class="inline-flex items-center gap-2 rounded-full bg-white px-3 py-1 text-xs font-semibold text-[var(--kpihub-ink)] shadow-subtle border border-gray-200">
                Créez votre compte KpiHub
            </p>
            <h1 class="text-2xl font-bold text-[var(--kpihub-ink)]">Pilotez vos campagnes en confiance</h1>
            <p class="text-sm text-gray-600">Rôles disponibles : Entreprise, Influenceur, Utilisateur.</p>
        </div>

        <form method="POST" action="{{ route('register') }}" class="space-y-4">
            @csrf

            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div class="space-y-2">
                    <x-input-label for="last_name" :value="__('Nom')" />
                    <x-text-input id="last_name" class="input-field" type="text" name="last_name" :value="old('last_name')" required autocomplete="family-name" />
                    <x-input-error :messages="$errors->get('last_name')" class="mt-1" />
                </div>
                
                <div class="space-y-2">
                    <x-input-label for="first_name" :value="__('Prénom')" />
                    <x-text-input id="first_name" class="input-field" type="text" name="first_name" :value="old('first_name')" required autofocus autocomplete="given-name" />
                    <x-input-error :messages="$errors->get('first_name')" class="mt-1" />
                </div>
            </div>

            <div class="space-y-2">
                <x-input-label for="email" :value="__('Email')" />
                <x-text-input id="email" class="input-field" type="email" name="email" :value="old('email')" required autocomplete="username" />
                <x-input-error :messages="$errors->get('email')" class="mt-1" />
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div class="space-y-2">
                    <x-input-label for="role" :value="__('Role')" />
                    <select
                        id="role"
                        name="role"
                        x-model="role"
                        class="input-field">
                        @foreach (\App\Enums\UserRole::cases() as $role)
                        @continue($role === \App\Enums\UserRole::Admin)
                        <option value="{{ $role->value }}" @selected(old('role', \App\Enums\UserRole::Influencer->value) === $role->value)>
                            {{ $role->label() }}
                        </option>
                        @endforeach
                    </select>
                    <x-input-error :messages="$errors->get('role')" class="mt-1" />
                </div>

                <div class="space-y-2">
                    <x-input-label for="password" :value="__('Password')" />
                    <x-text-input id="password" class="input-field"
                        type="password"
                        name="password"
                        required autocomplete="new-password" />
                    <x-input-error :messages="$errors->get('password')" class="mt-1" />
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div class="space-y-2">
                    <x-input-label for="password_confirmation" :value="__('Confirm Password')" />
                    <x-text-input id="password_confirmation" class="input-field"
                        type="password"
                        name="password_confirmation" required autocomplete="new-password" />
                    <x-input-error :messages="$errors->get('password_confirmation')" class="mt-1" />
                </div>

                <template x-if="isInfluencer">
                    <div class="space-y-2">
                        <x-input-label for="main_platform" value="Plateforme principale" />
                        <select
                            id="main_platform"
                            name="main_platform"
                            x-model="platform"
                            class="input-field">
                            <option value="">{{ __('Sélectionnez') }}</option>
                            <option value="tiktok" @selected(old('main_platform')==='tiktok' )>TikTok</option>
                            <option value="instagram" @selected(old('main_platform')==='instagram' )>Instagram</option>
                            <option value="youtube" @selected(old('main_platform')==='youtube' )>YouTube</option>
                            <option value="linkedin" @selected(old('main_platform')==='linkedin' )>LinkedIn</option>
                            <option value="twitter" @selected(old('main_platform')==='twitter' )>Twitter</option>
                            <option value="facebook" @selected(old('main_platform')==='facebook' )>Facebook</option>
                        </select>
                        <x-input-error :messages="$errors->get('main_platform')" class="mt-1" />
                    </div>
                </template>
            </div>

            <template x-if="isInfluencer">
                <div class="space-y-2">
                    <x-input-label for="profile_url" value="Lien de votre profil" />
                    <x-text-input
                        id="profile_url"
                        name="profile_url"
                        x-model="profileUrl"
                        @input="validateUrl()"
                        class="input-field"
                        type="url"
                        placeholder="https://www.tiktok.com/@votre_compte" />
                    <p x-text="urlHint" class="text-xs text-gray-600"></p>
                    <p x-show="urlError" x-text="urlError" class="text-xs text-red-600 font-semibold"></p>
                    <x-input-error :messages="$errors->get('profile_url')" class="mt-1" />
                </div>
            </template>

            <div class="flex items-center justify-between pt-2">
                <a class="text-sm font-semibold text-[var(--kpihub-ink)] hover:text-[var(--kpihub-primary)]" href="{{ route('login') }}">
                    {{ __('Already registered?') }}
                </a>

                <x-primary-button>
                    {{ __('Register') }}
                </x-primary-button>
            </div>
        </form>
    </div>

    @php
    $defaultRole = \App\Enums\UserRole::Influencer->value;
    @endphp

    <script>
        function registerForm() {
            return {
                role: @js(old('role', $defaultRole)),
                platform: @js(old('main_platform')),
                profileUrl: @js(old('profile_url')),
                urlError: '',
                get isInfluencer() {
                    return this.role === 'influencer';
                },
                get urlHint() {
                    const map = {
                        tiktok: 'Ex: https://www.tiktok.com/@votre_compte',
                        instagram: 'Ex: https://www.instagram.com/votre_compte',
                        youtube: 'Ex: https://www.youtube.com/@votre_compte',
                        linkedin: 'Ex: https://www.linkedin.com/in/votre-profil',
                    };
                    return map[this.platform] ?? '';
                },
                validateUrl() {
                    if (!this.platform || !this.profileUrl) {
                        this.urlError = '';
                        return;
                    }
                    const patterns = {
                        tiktok: /^https:\/\/www\.tiktok\.com\/@[\w.\-]+$/i,
                        instagram: /^https:\/\/(www\.)?instagram\.com\/[A-Za-z0-9._\-]+\/?$/i,
                        youtube: /^https:\/\/(www\.)?youtube\.com\/(c\/|channel\/|@)[A-Za-z0-9._\-]+$/i,
                        linkedin: /^https:\/\/(www\.)?linkedin\.com\/in\/[A-Za-z0-9.\-_%]+\/?$/i,
                    };
                    this.urlError = patterns[this.platform]?.test(this.profileUrl.trim()) ?
                        '' :
                        'Lien invalide pour la plateforme choisie.';
                },
            };
        }
    </script>
</x-guest-layout>
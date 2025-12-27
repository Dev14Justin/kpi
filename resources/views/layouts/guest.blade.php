<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <script>
        // Default to dark mode if no preference is saved
        if (localStorage.theme === 'dark' || (!('theme' in localStorage) && window.matchMedia('(prefers-color-scheme: dark)').matches) || !('theme' in localStorage)) {
            document.documentElement.classList.add('dark')
        } else {
            document.documentElement.classList.remove('dark')
        }
    </script>

    @livewireStyles
    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="font-sans bg-surface text-ink antialiased">
    <div class="min-h-screen flex flex-col items-center pt-10 px-4">
        <div class="flex items-center gap-3">
            <div class="h-12 w-12 rounded-2xl bg-primary flex items-center justify-center font-black text-[#1C1C1C] shadow-subtle">
                K
            </div>
            <div class="leading-tight">
                <p class="text-lg font-semibold">KpiHub</p>
                <p class="text-xs text-gray-600 dark:text-gray-400">Pilotez vos campagnes</p>
            </div>
        </div>

        <div class="w-full sm:max-w-xl mt-8 bg-white dark:bg-[#2E2E2E] border border-gray-100 dark:border-gray-800 shadow-card rounded-2xl p-8 space-y-4">
            {{ $slot }}
        </div>
    </div>
    @livewireScripts
</body>

</html>
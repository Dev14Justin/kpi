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
        if (localStorage.theme === 'dark' || (!('theme' in localStorage) && window.matchMedia('(prefers-color-scheme: dark)').matches)) {
            document.documentElement.classList.add('dark')
        } else {
            document.documentElement.classList.remove('dark')
        }
    </script>

    @livewireStyles
    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @stack('styles')
</head>

<body class="font-sans antialiased">
    {{-- Global Loading Progress Bar for wire:navigate --}}
    <div wire:loading.delay.class="livewire-progress-bar" class="fixed top-0 left-0 right-0 h-1 z-[100] pointer-events-none"></div>

    <div class="min-h-screen bg-background">
        @include('layouts.navigation')

        <!-- Page Heading -->
        @isset($header)
        <header class="bg-card shadow-sm border-b border-border">
            <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                {{ $header }}
            </div>
        </header>
        @endisset

        <!-- Page Content -->
        <main>
            {{ $slot }}
        </main>

        @if(!($hideFooter ?? false) && $attributes->get('hide-footer') !== 'true' && $attributes->get('hideFooter') !== 'true')
        @include('layouts.footer')
        @endif
    </div>

    @livewireScripts
    @stack('scripts')
</body>

</html>
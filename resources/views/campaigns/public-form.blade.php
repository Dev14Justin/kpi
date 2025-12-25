<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ $campaign->title }} - Lead Form</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-background font-sans antialiased text-ink">
    <div class="min-h-screen py-12 px-4 flex items-center justify-center">
        <livewire:campaigns.public-lead-form :campaign="$campaign" />
    </div>
</body>

</html>
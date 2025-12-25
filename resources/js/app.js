import.meta.glob([
    '../images/**',
]);
import './bootstrap';

// Alpine is now handled by Livewire 3 via @livewireScripts in layouts/app.blade.php
// to avoid multiple instance conflicts.
// Do not import Alpine here.

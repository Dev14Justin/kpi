import defaultTheme from 'tailwindcss/defaultTheme';
import forms from '@tailwindcss/forms';

/** @type {import('tailwindcss').Config} */
export default {
    darkMode: 'class',
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
    ],

    theme: {
        extend: {
            fontFamily: {
                sans: ['Figtree', ...defaultTheme.fontFamily.sans],
            },
            colors: {
                primary: 'var(--kpihub-primary)',
                accent: 'var(--kpihub-accent)',
                ink: 'var(--kpihub-ink)',
                surface: 'var(--kpihub-surface)',
            },
            boxShadow: {
                card: '0 10px 30px rgba(0,0,0,0.08)',
                subtle: '0 4px 14px rgba(0,0,0,0.06)',
            },
        },
    },

    plugins: [forms],
};

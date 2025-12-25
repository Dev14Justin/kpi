import defaultTheme from 'tailwindcss/defaultTheme';
import forms from '@tailwindcss/forms'; 

/** @type {import('tailwindcss').Config} */
export default {
    darkMode: 'class',
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
        './resources/js/**/*.js',
    ],

    theme: {
        extend: {
            fontFamily: {
                sans: ['Figtree', ...defaultTheme.fontFamily.sans],
            },
            backgroundColor: {
                background: "hsl(var(--background) / <alpha-value>)",
                card: "hsl(var(--card) / <alpha-value>)",
                primary: "hsl(var(--primary) / <alpha-value>)",
                secondary: "hsl(var(--secondary) / <alpha-value>)",
                muted: "hsl(var(--muted) / <alpha-value>)",
                accent: "hsl(var(--accent) / <alpha-value>)",
            },
            textColor: {
                foreground: "hsl(var(--foreground) / <alpha-value>)",
                primary: "hsl(var(--primary) / <alpha-value>)",
                accent: "hsl(var(--accent) / <alpha-value>)",
                "primary-foreground": "hsl(var(--primary-foreground) / <alpha-value>)",
                "secondary-foreground": "hsl(var(--secondary-foreground) / <alpha-value>)",
                "muted-foreground": "hsl(var(--muted-foreground) / <alpha-value>)",
                "accent-foreground": "hsl(var(--accent-foreground) / <alpha-value>)",
                "card-foreground": "hsl(var(--card-foreground) / <alpha-value>)",
                title: "hsl(var(--title) / <alpha-value>)",
                subtitle: "hsl(var(--subtitle) / <alpha-value>)",
            },
            borderColor: {
                border: "hsl(var(--border) / <alpha-value>)",
                input: "hsl(var(--input) / <alpha-value>)",
                ring: "hsl(var(--ring) / <alpha-value>)",
                primary: "hsl(var(--primary) / <alpha-value>)",
                accent: "hsl(var(--accent) / <alpha-value>)",
            },
            ringColor: {
                ring: "hsl(var(--ring))",
                primary: "hsl(var(--primary))",
            },
            accentColor: {
                primary: "hsl(var(--primary))",
                accent: "hsl(var(--accent))",
            },
            borderRadius: {
                lg: "var(--radius)",
                md: "calc(var(--radius) - 2px)",
                sm: "calc(var(--radius) - 4px)",
                xl: "1rem",
                "2xl": "1.5rem",
                "3xl": "2rem",
            },
            boxShadow: {
                card: '0 10px 30px rgba(0,0,0,0.08)',
                subtle: '0 4px 14px rgba(0,0,0,0.06)',
            },
        },
    },

    plugins: [forms],
};

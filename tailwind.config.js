import defaultTheme from 'tailwindcss/defaultTheme';
import forms from '@tailwindcss/forms';

/** @type {import('tailwindcss').Config} */
export default {
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
        './resources/js/**/*.vue',
    ],

    theme: {
        extend: {
            fontFamily: {
                sans: ['Inter', ...defaultTheme.fontFamily.sans],
                display: ['"Plus Jakarta Sans"', ...defaultTheme.fontFamily.sans],
                serif: ['"Playfair Display"', ...defaultTheme.fontFamily.serif],
            },
            colors: {
                mbg: {
                    green: '#7BC96F',
                    'green-hover': '#69B85A',
                    'light-green': '#EAF7E5',
                    'fresh-mint': '#F4FBF2',
                    navy: '#245A8D',
                    sky: '#DCEEF8',
                    gold: '#D4AF37',
                    'bg-primary': '#FAFCFB',
                    'bg-secondary': '#F5F7F9',
                }
            }
        },
    },

    plugins: [forms],
};

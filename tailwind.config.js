import defaultTheme from 'tailwindcss/defaultTheme';
import forms from '@tailwindcss/forms';

/** @type {import('tailwindcss').Config} */
export default {
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
    ],

    theme: {
        extend: {
            fontFamily: {
                sans: ['Inter', ...defaultTheme.fontFamily.sans],
            },
            colors: {
                primary: {
                    DEFAULT: '#f2163e', // Warna utama merah
                    '100': '#fee2e2',   // Versi lebih terang untuk background
                    '600': '#f2163e',   // Alias untuk DEFAULT
                    '700': '#dc2626',   // Versi lebih gelap untuk hover
                }
            }
        },
    },

    plugins: [forms],
};

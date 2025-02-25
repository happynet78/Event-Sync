import defaultTheme from 'tailwindcss/defaultTheme';
import forms from '@tailwindcss/forms';
import typography from '@tailwindcss/typography';

/** @type {import('tailwindcss').Config} */
export default {
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './vendor/laravel/jetstream/**/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
        './vendor/awcodes/filament-curator/resources/**/*.blade.php',
        './vendor/awcodes/filament-tiptap-editor/resources/**/*.blade.php',
        "./vendor/robsontenorio/mary/src/View/Components/**/*.php",
        './vendor/guava/calendar/resources/**/*.blade.php',
        './vendor/codewithdennis/filament-price-filter/resources/**/*.blade.php',
        './vendor/bezhansalleh/filament-language-switch/resources/views/language-switch.blade.php',
    ],

    theme: {
        extend: {
            fontFamily: {
                sans: ['Figtree', ...defaultTheme.fontFamily.sans],
            },
        },
    },

    plugins: [forms, typography, require('daisyui')],
};

const defaultTheme = require('tailwindcss/defaultTheme');

/** @type {import('tailwindcss').Config} */
module.exports = {
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
            backgroundColor: {
                'blue-500': '#3b82f6',
                'blue-700': '#1e3a8a',
              },
              textColor: {
                'blue-500': '#3b82f6',
                'blue-700': '#1e3a8a',
              },
        },
    },

    plugins: [require('@tailwindcss/forms')],
};

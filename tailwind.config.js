import defaultTheme from 'tailwindcss/defaultTheme';
import forms from '@tailwindcss/forms';

/** @type {import('tailwindcss').Config} */
module.exports = {
    content: [
        "./resources/**/*.blade.php", // Include Blade templates
        "./resources/**/*.js",       // Include JavaScript files
        "./resources/**/*.vue",       // Include Vue components
    ],
    theme: {
        extend: {},
    },
    plugins: [forms],
};
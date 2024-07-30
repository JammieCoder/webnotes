/** @type {import('tailwindcss').Config} */
    export default {
        content: [
            "./resources/**/*.blade.php",
            "./resources/**/*.js",
            "./resources/**/*.vue",
            "./storage/app/**/*.*",
            "./vendor/glhd/aire/**/*.*"
        ],
        theme: {
            extend: {},
        },
        plugins: [
            require('@tailwindcss/typography'),
        ],
    }


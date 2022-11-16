/** @type {import('tailwindcss').Config} */
module.exports = {
    content: [
        "./app/Http/Controllers/**/*.php",
        "./resources/**/*.blade.php",
        "./resources/**/*.js",
        "./resources/**/*.vue",
        "./Modules/*/Http/Controllers/**/*.php",
        "./Modules/**/*.blade.php",
        "./Modules/**/*.js",
        "./Modules/**/*.vue",
        "./node_modules/flowbite/**/*.js"
    ],
    theme: {
        extend: {},
    },
    plugins: [
        require('flowbite/plugin')
    ]
}

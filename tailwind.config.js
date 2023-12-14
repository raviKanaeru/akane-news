/** @type {import('tailwindcss').Config} */
module.exports = {
    content: [
        "./resources/**/*.blade.php",
        "./resources/**/*.js",
        "./resources/**/*.vue",
        "./vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php",
    ],
    theme: {
        container: {
            center: true,
            padding: "16px",
        },
        extend: {
            colors: {
                primary: "#14b8a6",
                secondary: "#64748b",
                dark: "#0f172a",
            },
        },
    },
    plugins: [],
};

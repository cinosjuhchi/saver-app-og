/** @type {import('tailwindcss').Config} */
export default {
    content: [
        "./resources/**/*.blade.php",
        "./resources/**/*.js",
        "./resources/**/*.vue",
    ],
    theme: {
        extend: {
            colors: {
                black: "#161616",
                white: "#ffffff",
                birutua: "#0087B2",
                birumuda: "#00BBF8",
                putihneut: "#D9D9D9",
                putihneut2: "#f4f4f4",
            },

            fontFamily: {
                jakarta: ["Plus Jakarta Sans", "sans-serif"],
            },
        },
    },
    plugins: [],
};

import defaultTheme from 'tailwindcss/defaultTheme';
import forms from '@tailwindcss/forms';

/** @type {import('tailwindcss').Config} */
export default {
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
    ],

    darkMode: 'class',

    theme: {
        fontFamily: {
            outfit: ["Outfit", "sans-serif"],
            sans: ['Figtree', ...defaultTheme.fontFamily.sans],
        },
        screens: {
            "2xsm": "375px",
            xsm: "425px",
            "3xl": "2000px",
            ...defaultTheme.screens,
        },
        extend: {
            fontSize: {
                "title-2xl": ["72px", "90px"],
                "title-xl": ["60px", "72px"],
                "title-lg": ["48px", "60px"],
                "title-md": ["36px", "44px"],
                "title-sm": ["30px", "38px"],
                "theme-xl": ["20px", "30px"],
                "theme-sm": ["14px", "20px"],
                "theme-xs": ["12px", "18px"],
            },
            colors: {
                current: "currentColor",
                transparent: "transparent",
                brand: {
                    25: "#F2F7FF",
                    50: "#ECF3FF",
                    100: "#DDE9FF",
                    200: "#C2D6FF",
                    300: "#9CB9FF",
                    400: "#7592FF",
                    500: "#465FFF",
                    600: "#3641F5",
                    700: "#2A31D8",
                    800: "#252DAE",
                    900: "#262E89",
                    950: "#161950",
                },
                "gray-dark": "#1D2939",
            },
            zIndex: {
                1: "1",
                99: "99",
                999: "999",
                9999: "9999",
                99999: "99999",
            },
        },
    },

    plugins: [forms],
};

export default {
    content: [
        "./resources/**/*.blade.php",
        "./resources/**/*.js",
        "./resources/**/*.vue",
    ],
    theme: {
        extend: {
            colors: {
                navy: {
                    DEFAULT: '#0B1D3A',
                    mid: '#122347',
                    light: '#1A3260',
                },
                gold: {
                    DEFAULT: '#C9A84C',
                    light: '#E2C176',
                    pale: '#F5E9C4',
                },
                'off-white': '#F0EDE6',
                'white-custom': '#FAFAF8',
                'text-dark': '#0D1B2A',
                'text-mid': '#3A4A5C',
                'text-light': '#7A8899',
            },
            fontFamily: {
                display: ['Playfair Display', 'serif'],
                sans: ['DM Sans', 'sans-serif'],
                serif: ['Libre Baskerville', 'serif'],
            },
            borderRadius: {
                'xl-custom': '12px',
                '2xl-custom': '20px',
            },
            boxShadow: {
                'custom': '0 8px 40px rgba(11,29,58,0.12)',
                'custom-hover': '0 16px 60px rgba(11,29,58,0.22)',
            }
        },
    },
    plugins: [],
};

/** @type {import('tailwindcss').Config} */
export default {
    content: [
        './resources/**/*.blade.php',
        './resources/**/*.js',
    ],
    theme: {
        extend: {
            colors: {
                cb: {
                    black:   '#0C0C0B',
                    white:   '#FAFAF7',
                    offwhite:'#F2EDE4',   // warm cream — Verdance-inspired
                    gray: {
                        50:  '#FAFAF7',
                        100: '#F2F0EB',
                        200: '#E4E1DB',
                        300: '#CCC9C2',
                        400: '#9E9B94',
                        500: '#6E6C66',
                        600: '#4E4D48',
                        700: '#373632',
                        800: '#242320',
                        900: '#141310',
                    },
                    gold: '#B8960C',
                },
            },
            fontFamily: {
                display: ['"Cormorant Garamond"', 'Georgia', 'serif'],
                body:    ['"DM Sans"', 'system-ui', 'sans-serif'],
            },
            fontSize: {
                '8xl': ['6rem',  { lineHeight: '1' }],
                '9xl': ['8rem',  { lineHeight: '1' }],
                '10xl':['10rem', { lineHeight: '1' }],
            },
            spacing: {
                '18': '4.5rem', '22': '5.5rem', '88': '22rem',
                '100': '25rem', '112': '28rem', '128': '32rem',
            },
            maxWidth: {
                '8xl': '90rem',
                '9xl': '100rem',
            },
            borderRadius: {
                '4xl': '2rem',
                '5xl': '3rem',
            },
            transitionTimingFunction: {
                'luxury': 'cubic-bezier(0.25, 0.1, 0.25, 1)',
                'reveal': 'cubic-bezier(0.16, 1, 0.3, 1)',
            },
        },
    },
    plugins: [
        require('@tailwindcss/forms'),
        require('@tailwindcss/typography'),
    ],
};

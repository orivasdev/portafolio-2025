/** @type {import('tailwindcss').Config} */
module.exports = {
  content: [
    "./resources/**/*.blade.php",
    "./resources/**/*.js",
    "./resources/**/*.vue",
  ],
  darkMode: 'class',
  theme: {
    extend: {
      colors: {
        'primary': {
          50: '#f0f0f5',
          100: '#e0e0eb',
          200: '#c1c1d7',
          300: '#9393c3',
          400: '#60A5FA',
          500: '#0A0635', // Color principal azul muy oscuro
          600: '#08052a',
          700: '#060420',
          800: '#040315',
          900: '#02020a',
        },
        'accent': {
          50: '#f5f0f0',
          100: '#ebe0e0',
          200: '#d7c1c1',
          300: '#c39393',
          400: '#9f5e5e',
          500: '#350A06', // Color de acento rojo muy oscuro
          600: '#2a0805',
          700: '#200604',
          800: '#150403',
          900: '#0a0202',
        },
        'success': {
          50: '#f0f5f0',
          100: '#e0ebe0',
          200: '#c1d7c1',
          300: '#93c393',
          400: '#5e9f5e',
          500: '#06350A', // Color de éxito verde muy oscuro
          600: '#052a08',
          700: '#042006',
          800: '#031504',
          900: '#020a02',
        }
      },
      fontFamily: {
        'sans': ['Inter', 'system-ui', 'sans-serif'],
        'mono': ['JetBrains Mono', 'monospace'],
      },
      animation: {
        'fade-in': 'fadeIn 0.5s ease-in-out',
        'slide-up': 'slideUp 0.5s ease-out',
        'bounce-slow': 'bounce 3s infinite',
        'pulse-slow': 'pulse 4s cubic-bezier(0.4, 0, 0.6, 1) infinite',
      },
      keyframes: {
        fadeIn: {
          '0%': { opacity: '0' },
          '100%': { opacity: '1' },
        },
        slideUp: {
          '0%': { transform: 'translateY(20px)', opacity: '0' },
          '100%': { transform: 'translateY(0)', opacity: '1' },
        },
      },
    },
  },
  plugins: [],
}

/** @type {import('tailwindcss').Config} */
module.exports = {
  content: ["./src/**/*.{html,js,php}"],
  theme: {
    extend: {
      colors: {
        'primary-500': 'rgba(255, 134, 0)', // Custom primary color
      },
    },
  },
  plugins: [],
}

const colors = require('tailwindcss/colors');
module.exports = {
  content: [
    "./*.vue",
    "./**/*.vue"
  ],
  theme: {
    extend: {
      colors: {
        primary: colors.emerald,
        danger: colors.rose,
      }
    },
  },
  plugins: [
    // require('@tailwindcss/typography'),
    // require('@tailwindcss/forms'),
    // require('@tailwindcss/line-clamp'),
    // require('@tailwindcss/aspect-ratio'),
  ],
}

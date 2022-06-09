const colors = require('tailwindcss/colors');
const formKitTailwind = require('@formkit/themes/tailwindcss')
module.exports = {
  content: [
    "./*.vue",
    "./**/*.vue",
    "./formkit.config.ts"
  ],
  theme: {
    extend: {
      colors: {
        primary: colors.emerald,
        danger: colors.rose,
        disabled: '#b9b7bd'
      }
    },
  },
  plugins: [formKitTailwind],
}

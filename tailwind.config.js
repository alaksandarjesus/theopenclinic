module.exports = {
  content: [
    "./resources/views/**/*.php",
    "./resources/js/**/*.js",
  ],
  theme: {
    container: {
      center: true
    },
    extend: {},
  },
  plugins: [
    require('@tailwindcss/forms'),
  ],
}

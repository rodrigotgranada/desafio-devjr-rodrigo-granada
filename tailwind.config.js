/** @type {import('tailwindcss').Config} */
module.exports = {
  content: [
    './resources/views/**/*.blade.php',
    './resources/js/**/*.js',
    './resources/css/**/*.css',
    './app/Modules/**/Views/**/*.blade.php',
  ],
  theme: {
    extend: {},
  },
  plugins: [],
}


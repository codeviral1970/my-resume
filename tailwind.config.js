/** @type {import('tailwindcss').Config} */
module.exports = {
  purge: [
    './templates/**/*.html.twig',
    './assets/**/*.css',
    './assets/**/*.js',
  ],
  content: [],
  theme: {
    extend: {
      colors: {
        'body': '#17171F',
        'selected-text': '#FAC748',
        'theme': '#FAC748',
        'secondary': '#9191A4',
        'badge': '#3F3F51',
        'input-border': '#565666',
        'input': '#2A2A35'
      },
      fontFamily: {
        'poppins': ["'poppins'", 'sans-serif']
      },
      animation: {
        blob: "blob 4s infinite"
      },
      keyframes: {
        blob: {
          "0%": {
            transform: "translate(0px, 0px) scale(1)",
          },
          "33%": {
            transform: "translate(30px, -50px) scale(1.1)",
          },
          "66%": {
            transform: "translate(-20px, 20px) scale(0.9)",
          },
          "100%": {
            transform: "translate(0px, 0px) scale(1)",
          },
        },
      },
      transitionTimingFunction: {
        'bloob': 'cubic-bezier(1,-0.65,0,2.31)',
      },
      marginBottom: {
        'mb': {
          '6': '1,5rem'
        }
      },
    },
  },
  variants: {
    extend: {
      display: ['group-focus']
    },
  },
  plugins: [],

}

//FAC748
//'body': '#17171F',
//'theme': '#3F3FFF',
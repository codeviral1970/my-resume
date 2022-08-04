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
            'inut-border': '#565666',
            'input': '#2A2A35'
          },
            fontFamily: {
                'poppins': ["'poppins'", 'sans-serif']
          },
         
    },
  },
    plugins: [],
  
}

//FAC748
//'body': '#17171F',
//'theme': '#3F3FFF',
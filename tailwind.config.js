module.exports = {
  purge: [
    './resources/views/**/*.blade.php',
    './resources/css/**/*.css',
  ],
  theme: {
    extend: {
      maxWidth:{
        '1/4': '25%',
        '1/2': '50%',
        '3/4': '75%',
        '15':'15rem'
      }
    }
  },
  variants: {
    borderWidth: ['responsive', 'hover'],
    textColor:['group-hover']
  },
  plugins: [
    require('@tailwindcss/ui'),
  ]
}

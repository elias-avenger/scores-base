/** @type {import('tailwindcss').Config} */
module.exports = {
  content: ["./*.php"],
  theme: {
    screens:{
      'sm': '640px',
      // => @media (min-width: 640px) { ... }

      'md': '768px',
      // => @media (min-width: 768px) { ... }

      'lg': '1024px',
      // => @media (min-width: 1024px) { ... }

      'xl': '1280px',
      // => @media (min-width: 1280px) { ... }

      '2xl': '1536px',
      // => @media (min-width: 1536px) { ... }
    },
    colors: {
      "white": "#ffffff",
      "black": "#000000",
      "blue": "#6699ff",
      "greener": "#009900",
      "lightBlue": "#cce0ff",
      "lightGreen": "#33ff33",
      "grayish": "#f2f2f2",
    },
    extend: {},
  },
  plugins: [],
}


// tailwind.config.js
/** @type {import('tailwindcss').Config} */
module.exports = {
  content: [
   "./resources/**/*.blade.php",
    "./resources/**/*.js",
    "./resources/**/*.vue",
    "./app/Http/Livewire/**/*.php",  // Opsional: Jika menggunakan Livewire
    "./app/Filament/**/*.php",       // Opsional: Jika menggunakan Filament  ],
  ],
    theme: {
    extend: {
    'color-primer': '#FFC50F', 
        'color-terang': '#FDE7B3',
        'color-hijau': '#63A361',
        'color-gelap': '#5B532C',  
    },
  },
  plugins: [],
}
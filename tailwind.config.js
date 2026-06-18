module.exports = {
	content: [
		'./resources/**/*.blade.php',
		'./resources/**/*.js',
		'./resources/**/*.vue',
	],
	darkMode: 'media',
		theme: {
		extend: {
	translate: ['active', 'group-hover'],
	  },
	},

	variants: {
		extend: {
		height: ['hover', 'focus', 'group-hover'],
		width: ['responsive', 'hover', 'focus'],
	  },
	},
	  plugins: [],
}


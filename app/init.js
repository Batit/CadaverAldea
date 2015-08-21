// Agregando todos los archivos usados para la App
var includes = [
	'tools/effects.js',
	'tools/views.js',
	'resources/request.js',
	'resources/connection.js',
	'tools/settings.js',
 	'resources/load.js'
];
function setInclude(anotherArray) {
	console.log(includes)
	includes = typeof anotherArray != "undefined" ? anotherArray : includes
	includes.forEach(function(v, k){
		var require 	= document.createElement("script");
		require.type 	= 'text/javascript';
		require.src 	= "app/"+v;
		// Agregando al Body del HTML
		document.body.appendChild(require)
	});
}
(setInclude)();
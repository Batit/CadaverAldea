var finalEvent = "";
var Load = function() {
	// Variables generales del objeto.
	var views_path 	= "/plantillas/";
	// Objetos usados para obtener datos y tratar con ellos.
	var connect 	= new Connection();
	// Bandera para agrupar comentarios
	var ban 		= 0;
	var current_comments = [];
	var current_obj = {};
	// función para asignar comentarios
	function add_to_image() {
		for(var comment in current_comments){
			var request 	= new Request();
			var setting 	= new Setting();
			var full_path 	= views_path + current_comments[comment][0].direccion;
			request.setPath(full_path, {all:"1"});
			request.setEventName('image_request' + comment);
			request.to_local();
			setting.setComments(current_comments[comment]);
			finalEvent = 'image_request' + comment;
			document.addEventListener('image_request' + comment, setting.setSVG);
		}
	}
	// Making comments order 
	function order (comment) {
		if(comment.cadaver_id == ban){
			current_comments[current_comments.length - 1].push(comment)
		} else {
			ban = comment.cadaver_id;
			current_comments.push([comment]);
		}
	}
	this.recive = function(data) {
			var contenidos = data.detail;
			for(var data in contenidos){
				comment = contenidos[data]
				order(comment);
			}
			add_to_image();
	};
	// Cargando comentarios dentro de las imagenes.
	this.loadImages = function() {
		connect.getAllComments(this.recive);
	};
	this.getSingle = function(id) {
		connect.getSingle(id, this.recive);
	};
	this.getCarousel = function() {
		connect.getCarousel(this.recive);
	};
	this.getSearch = function(name) {
		connect.getSearch(name, this.recive);
	};
};
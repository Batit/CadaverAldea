// Objeto para HTTP-Request
var Request = function(direction){
	this.direction = "";
	if(direction != 'undefined'){
		this.direction = direction;
	}
	var dataRequest		= {};
	var rawFile 		= null;
	this.entity 		= null;
	var x = 0;
	// Event request variable
	var event_name = 'request';
	this.setEventName = function(ev) {
		event_name = ev;
	};
	// Asignando Path al objeto
	this.setPath = function(direction, data) {
		this.direction = direction + "?parameters=" + encodeURIComponent(JSON.stringify(data));
		console.log(this.direction)
	};
	// Instancia del Objeto Request
	if(window.XMLHttpRequest) {
		rawFile = new XMLHttpRequest;
	}else {
		rawFile = new ActiveXObject("Microsoft.XMLHTTP");
	}
	this.get_request = function(callback){
		rawFile.open("GET", this.direction, true);
		rawFile.send();
		rawFile.onreadystatechange = function() {
			if( rawFile.readyState === 4 && rawFile.status === 200 ) {
				dataRequest = callback(rawFile)
				// Creando un nuevo evento con la clave
				// "detail"
				var event = new CustomEvent(event_name, {detail:dataRequest});
				// Enviando el Trigger del evento
				document.dispatchEvent(event)
				return false;
			}
		}
		return false;
	}
};

Request.prototype.to_url = function url_request() {
	// Tu códgio va aquí
}

// Función referenciada a si misma
Request.prototype.to_local = function local_request(current_request) {
	if( typeof current_request === "undefined" ){
		//this.direction = window.location + this.direction;
		return this.get_request(local_request);
	}
	// Retorna los datos actuales de la variable dataRequest
	try {
		Request.dataRequest = JSON.parse(current_request.response);
	} catch(e){
		Request.dataRequest = current_request.response;
		console.log("Imposible convertir a JSON");
	}
	return Request.dataRequest;
}
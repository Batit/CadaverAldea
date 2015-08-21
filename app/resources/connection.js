var Connection = function() {
	var request = new Request();
	var back = "/back/index.php";
	this.getAllComments = function(callback) {
		request.setPath(back, {all:"1"});
		request.setEventName('request');
		request.to_local();
		document.addEventListener('request', callback);
	};

	this.getSingle = function(id, callback) {
		$.get(back, {id: id}).done(function(data) {
			callback({detail:JSON.parse(data)})
		})
	};

	this.getCarousel = function(callback) {
		$.get(back, {limit: true}).done(function(data) {
			callback({detail:JSON.parse(data)})
		})
	};

	this.getSearch = function(collaborator, callback) {
		$.get(back, {colaborador: collaborator}).done(function(data) {
			callback({detail:JSON.parse(data)})
		})
	};

};
$(document).ready(function() {
	$('#sw_cadaver').on('click', function() {
		var colaborador = $('#name').val()
		if(colaborador == "") {
			alert("Porfavor Escribe tu pseudonimo");
			return false;
		}
		var images = new Load();
		images.getSearch(colaborador);
	})
})
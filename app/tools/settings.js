// Setting Text to image
var group = [];
function Setting (data) {
	var comments = []
	this.svg = "";
	this.setSVG = function(data) {
		console.log(data)
		this.svg = data.detail;
		var text = "";
		text = text.trim();
		var paths = $(this.svg).find('g#texto > path[id ^="p"]');
		var final_elements = "";
		var element_text = $(this.svg).find('g#added > text')[0];
		element_text = $(element_text).clone();
		var text_box = $(this.svg).find('g#added')
		$(text_box).html("");
		for(var comment in comments) {
			text += " "+ comments[comment].comentario;
			if(comments[comment].colaborador == ""){
				continue;
			}
			var elm = $(element_text).clone();
			var f_text = $(elm).find('textPath');
			var id = parseInt(comment)+1;
			f_text.attr('xlink:href', "#C"+id+""); 
			f_text.append(comments[comment].colaborador); 
			$(text_box).append(elm); 
		}
		paths.each(function(k, v) {
			var id = $(v).attr('id');
			var elm = $(element_text).clone();
			var characters = parseInt(id.split('_')[1]);
			var new_text = "";
			if(characters <= text.length){
				new_text = text.substring(0, characters-1);
				text = text.substring(characters-1, text.length)
			}else {
				new_text = text;
				text = "";
			}
			var f_text = $(elm).find('textPath'); 
			f_text.attr('xlink:href', "#"+id+""); 
			f_text.append(new_text); 
			$(text_box).append(elm);
		});
		var rs = $(this.svg).append($(text_box));
		var d = false;
		try {
			d = comments[comments.length - 1].fecha.split(" ");
		}catch(e){console.log("No se parseo la fecha")}
		if($.isArray(d)){
			var img_string = ""
			if (window.ActiveXObject){
		        img_string = $(rs)[4].xml;
		    }
		    else{
		        img_string = (new XMLSerializer()).serializeToString($(rs)[4]);
		    }
			var final_data = {image: img_string, id: d[0], fecha: d[0], hora: d[1], redirection:comments[comments.length - 1].cadaver_id };
			if(!$.isArray(group[d[0]])){
				eval("group['" + d[0] + "'] = []")
			}
			group[d[0]].push(final_data)
			console.log(data)
			if (data.type == finalEvent) {
				Views(group)
			}
		}
		console.log("No sale")
	};
	this.setComments = function(cmm) {
		comments = cmm
	};
}
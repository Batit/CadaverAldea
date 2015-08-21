var template 		= "";
single_template 	= "";
carousel_template 	= "";
var getTemplate = function() {
	$.get('app/resources/template.mts', function(tmp) {
		template = tmp;
	});
};

var getSingle = function() {
	$.get('app/resources/single_template.mts', function(tmp) {
		single_template = tmp;
	});
};

var getCarousel = function() {
	$.get('app/resources/carousel_template.mts', function(tmp) {
		carousel_template = tmp;
	});
};

(getTemplate)();
(getSingle)();
(getCarousel)();

var Views = function(data) {
	var rendered = "";
	for(var collection in data){
		console.log(collection)
		var datas = {
			title: collection,
			items: data[collection],
			fecha: function() {
				return this.fecha;
			},
			hora: function() {
				return this.hora;
			},
			id: function() {
				return this.id;
			},
			image: function() {
				return this.image;
			},
			redirection: function() {
				return this.redirection;
			}
		}
		
		if($('.oneItem').length > 0 || $('#search_tmp').length > 0){
			rendered 	+= Mustache.render(single_template, datas);
		}
		if($('.carousel-exp > .carousel-inner').length > 0){
			rendered 	+= Mustache.render(carousel_template, datas);
		}
		if($('.stacks-wrapper').length > 0 ){
			rendered 	+= Mustache.render(template, datas);
		}
	}
	if($('.stacks-wrapper').length > 0){
		$('.stacks-wrapper').html(rendered)
		$('.descarga').on('click', function() {
			var parent 	= $(this).parents('div.item__content');
			var svg 	= parent.find('svg');
			html2canvas($(svg), {
				onrendered: function(canvas) {
					context = canvas.getContext('2d');
					Canvas2Image.saveAsPNG(canvas, context.width, context.height)
			    }
			});
		});
		efects();
	}
	if( $('#search_tmp').length > 0 ){
		$('#search_tmp').html(rendered)
	}
	$('.oneItem').html(rendered)
	if($('.carousel-exp > .carousel-inner').length > 0){
		$('.carousel-exp > .carousel-inner').html(rendered)
		$('.carousel-exp > .carousel-inner > .item:first-child').addClass("active");
		$('.carousel').carousel()
	}
};
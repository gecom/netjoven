$(function(){

	var $search_keyword_directory = $('#keyword_directory'), $preview_map = $('#preview_map');

	$('#cbo_district').on('change', function(){
		window.location = $(this).val();
	})

	$search_keyword_directory.on('keypress', function(e){
		var $this = $(this), keyword = $this.val(),
		keycode = (e.keyCode ? e.keyCode : e.which);

		if(keycode == '13'){
			if(!keyword){
				return false;
			}

			keyword = uriSanitize(keyword);
			window.location = $this.attr('data-action') + '/' + keyword
		}
	});


	if($preview_map.length){
	
		var options_map = {
			marker : {
				values:[{latLng:[$preview_map.data('latitude'), $preview_map.data('longitude')]}]
			},
			map : {
				 options: { 
					draggable: false,
					scrollwheel: false,
					disableDoubleClickZoom: true,
					zoomControl: false,
					zoom : 14 
				 }
			}
		};

		$preview_map.gmap3(options_map);
	}

});
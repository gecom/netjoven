$(function(){

	var $search_keyword_directory = $('#keyword_directory');

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

});
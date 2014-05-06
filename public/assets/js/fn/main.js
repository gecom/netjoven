$(function(){

	var $modal = $('#ajax-modal'), $view_options = $('#view_options'), $search_form = $('#search-form'), url_search = $search_form.attr('action');

	$search_form.on('submit', function(){
		var $this = $(this), keyword = $this.find('input:text').val();
		if(!keyword){
			return false;
		}

		keyword = uriSanitize(keyword);

		$(this).attr('action', url_search + '/' + keyword);
		return true;
	})


	$('.dropdown ul').each(function(){
		$("li:first",$(this)).addClass('active custom_color_bg');
		$(".videos_drop:first",$(this).parent()).show();
	});

	$("nav ul li").hover(
		function(){
			$(this).children(".dropdown").stop(true,true).show();
		},
		function () {
			$(this).children(".dropdown").stop(true,true).hide();
		}
	);

	$('.dropdown ul a').hover(function(e){
		e.preventDefault();
		var $this = $(this);
		$('li', $this.parents('ul')).removeClass('active custom_color_bg');
		$this.parent().addClass('active custom_color_bg');
		var currentTab = $this.parent().attr('id');
		$('.videos_drop', $this.parents('.dropdown')).hide();
		$("#children_category_"+ currentTab).show();
	});


	$('.v1,.v2, .v3', '#view_options').on('click', function(e){
		e.preventDefault();
		var $this = $(this);

		if($this.find('a').hasClass('active')){
			return false;
		}

		$('body').modalmanager('loading');

		setTimeout(function(){
			$modal.load('/cambiar_tipo_vista/' + $this.data('type'), '', function(){
				$modal.modal({ backdrop: 'static'});
			});
		}, 1000);
	});

	$('#login').on('click', function(e){
		e.preventDefault();
		var $this = $(this);

		if(!$this.attr('href')){
			return false;
		}

		$('body').modalmanager('loading');

		setTimeout(function(){
			$modal.load($this.attr('href'), '', function(){
				$modal.modal({ backdrop: 'static'});
			});
		}, 1000);

	});

	$('#user_tools_color').on('click', function(e){
		e.preventDefault();
		var $this = $(this);

		if(!$this.attr('href')){
			return false;
		}

		$('body').modalmanager('loading');

		setTimeout(function(){
			$modal.load($this.attr('href'), '', function(){
				$modal.modal({ backdrop: 'static'});
			});
		}, 1000);

	});

	$modal.on('click', '#palette_color a', function(e){
		e.preventDefault();
		var $this = $(this), $confirm_palette_color = $('#confirm_palette_color');

		if($this.attr('data-auth') == 1){
			document.getElementById('stylesheet_custom_color').href = $this.attr('data-stylesheet');
			if($confirm_palette_color.is(':hidden')){
				$confirm_palette_color.show();
			}

		}else{
			$modal.load('/iniciar_sesion', '', function(){
				$modal.modal({ backdrop: 'static'});
			});			
		}
	});


	$modal.on('submit', '#frm_login', function(e){
		e.preventDefault();
		var $this = $(this);

		$.ajax({
			url: $this.attr('action') ,
			type:'post',
			dataType:'json',
			data: $this.serializeArray()
		}).done(function(response){
			if(response.success == true){
				setTimeout(function(){
					window.location.href = response.redirect;
				}, 1500)
			}else{

			}
		});

	});

	$modal.on('click', '#save_type_module', function(e){
		e.preventDefault();
		var $this = $(this);

		$.ajax({
			url: $this.attr('href') ,
			type:'post',
			dataType:'json',
			data: {type:$this.data('type')}
		}).done(function(response){
			$modal.find('.msg-confirm').show();
			$modal.find('.f1').text(response.message);
			$modal.find('.save_cancel_opt, .f2,.f4').remove();

			$view_options.find("li[data-type] a").removeClass('active').removeClass('custom_color_bg');
			$view_options.find("li[data-type='"+response.type_module+"'] a").addClass('active custom_color_bg');
		});

	});

	$modal.on('hide',function(e){
		 if($modal.find('#close_type_module').is(':visible')){
		 	location.reload();
		 }

		 if($modal.find('#cancel_color_palette').is(':visible')){
			document.getElementById('stylesheet_custom_color').href = $(document).data('color_palette_current');
		 }

	});

})

uriSanitize  = function(uri){
	return String(uri)
	.toLowerCase()
	.split(/[àáâãäå]/).join("a")
	.split(/æ/).join("ae")
	.split(/ç/).join("c")
	.split(/[èéêë]/).join("e")
	.split(/[ìíîï]/).join("i")
	.split(/ñ/).join("n")
	.split(/[òóôõö]/).join("o")
	.split(/œ/).join("oe")
	.split(/[ùúûü]/).join("u")
	.split(/[ýÿ]/).join("y")
	.split(/[\W_]+/).join("-")
	.split(/-+/).join("-");
}
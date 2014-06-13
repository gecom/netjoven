$(function(){

	var $modal = $('#ajax-modal'), $view_options = $('#view_options'),
	$search_form = $('.input-search, .input_search'), url_search = $search_form.attr('action'),
	color_select = null, $slider_more = $('#slider_more');

	$search_form.on('keypress', function(e){
		var $this = $(this), keyword = $this.val(),
		keycode = (e.keyCode ? e.keyCode : e.which);

		if(keycode == '13'){
			if(!keyword){
				return false;
			}

			keyword = uriSanitize(keyword);
			window.location = '/noticias/buscar/' + keyword
		}
	});

    $('#slider_more div.slider_item:gt(0)').hide();

    setInterval(function(){
      	$('#slider_more div.slider_item:first-child').fadeOut(0)
		         .next('div.slider_item').fadeIn(1000)
		         .end().appendTo('#slider_more');

		var $slider_item_visible = $('#slider_more div.slider_item:visible');
		$('#slider_more_tab').html($slider_item_visible.attr('data-title') + '<span class="'+$slider_item_visible.attr('data-class')+'"></span>');

     }, 4000);

	$('.dropdown ul').each(function(){
		$("li:first",$(this)).addClass('active custom_color_bg');
		$(".videos_drop:first",$(this).parent()).show();
	});

	$("nav ul li").hover(
		function(){
			if(!$(this).parents('ul').hasClass('showing_menu')){
				$(this).children(".dropdown").stop(true,true).show();
			}
		},
		function () {
			if(!$(this).parents('ul').hasClass('showing_menu')){
				$(this).children(".dropdown").stop(true,true).hide();
			}
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

	$('#user_tools_color, #options_menu_fixed_tools_color').on('click', function(e){
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
			color_select = $this.attr('data-color');
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

	$modal.on('click', '#save_color_palette', function(e){
		e.preventDefault();
		var $this = $(this);

		if(!color_select){
			return false;
		}

		$.ajax({
			url: $this.attr('href') ,
			type:'post',
			dataType:'json',
			data: {color:color_select}
		}).done(function(response){
			$('#confirm_palette_color').find('.text-danger').remove();
			if(response.success == true){
				setTimeout(function(){
					window.location.href = response.redirect;
				}, 1500)
			}

			$('#confirm_palette_color').append('<strong class="text-danger">'+response.message+'</strong>');
		});


	});

	$(' #frm_login').on('submit', function(e){
		e.preventDefault();
		var $this = $(this);

		$.ajax({
			url: $this.attr('action') ,
			type:'post',
			dataType:'json',
			data: $this.serializeArray()
		}).done(function(response){
			$this.find('.text-danger').remove();
			if(response.success == true){
				setTimeout(function(){
					window.location.href = response.redirect;
				}, 1500)
			}

			$this.append('<strong class="text-danger">'+response.message+'</strong>');
		});		
	});

	$modal.on('submit', '#frm_popup_login', function(e){
		e.preventDefault();
		var $this = $(this);

		$.ajax({
			url: $this.attr('action') ,
			type:'post',
			dataType:'json',
			data: $this.serializeArray()
		}).done(function(response){
			$this.find('.text-danger').remove();
			if(response.success == true){
				setTimeout(function(){
					window.location.href = response.redirect;
				}, 1500)
			}

			$this.append('<strong class="text-danger">'+response.message+'</strong>');

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


	$modal.on('shown.bs.modal', centerModal);
	$modal.on('show.bs.modal', centerModal);


	$("#main_nav .options_menu_fixed .search ").on('click', function(e){
		e.preventDefault();
		var $this = $(this), $search_box = $this.parent().find('.search_box');

		$search_box.toggle(function(){
			if($(this).is(':hidden')){
				$this.removeClass('active');
			}else{
				$this.addClass('active');
			}
		});
	});

	$(".options .show_menu").on('click', function(e){
		e.preventDefault();
		$('.menu_desktop').toggle();
		if($('.show_menu').hasClass('active')){
			$('.show_menu').removeClass('active');
			$('.menu_desktop').removeClass('showing_menu').css('display','');
			$('.menu_desktop li').removeClass('opt_menu');
			$('.menu_desktop .conecta_comparte').hide();

		} else {
			$('.show_menu').addClass('active');
			$('.menu_desktop').addClass('showing_menu');
			$('.menu_desktop li').addClass('opt_menu');
			$('.menu_desktop .conecta_comparte').show();
		}
	})

	$(".options .search").on('click', function(e){
		e.preventDefault();
		$('.options .search_box').toggle();
		if($(this).hasClass('active')){
			$(this).removeClass('active')
		} else {
			$(this).addClass('active')
		}
	});

	$(".options .config").on('click', function(e){
		e.preventDefault();
		$('.options .showing_config').toggle();
		if($(this).hasClass('active')){
			$(this).removeClass('active')
		} else {
			$(this).addClass('active')
		}
	});

	$(".log_in_mobile").on('click', function(e){
		e.preventDefault();
		$(this).parent().addClass('log_in');
		$('.welcome .iniciar_sesion').show();
	});

	$(document).scroll(function() {
		var scrolledHeight = $(document).scrollTop(), $main_nav = $("#main_nav");

		if(scrolledHeight >= 95){
			$main_nav.addClass("menu_fixed");
		}else{
			$main_nav.removeClass("menu_fixed");
		}
	});

})


function centerModal() {
	var $this = $(this);

	$this.css({
		"margin-left": function( index, value ) {
		  return ($this.width() / 2) * -1;
		}
	});
}

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
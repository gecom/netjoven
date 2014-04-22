$(document).ready(function(){


	$('.bxslider').bxSlider({
		mode: 'fade',
		captions: true,
		auto : true,
		hideControlOnEnd : false
	});

	$('.v1,.v2, .v3', '#view_options').on('click', function(e){
		e.preventDefault();
		var $this = $(this);

		$.ajax({
			url: '/cambiar_tipo_vista' ,
			type:'post',
			dataType:'json',
			data: {type:$this.data('type')}
		}).done(function(response){
			console.log(response);
		});

	})

	$(document).scroll(function() {
		var scrolledHeight = $(document).scrollTop(), $main_nav = $("#main_nav");

		if(scrolledHeight >= 95){
			$main_nav.addClass("menu_fixed");
		}else{
			$main_nav.removeClass("menu_fixed");
		}
	});

	var children_id = null;

	$('#main_nav .menu li').hover(function() {
		var $this = $(this);

		console.log($this);

		if($this.find('.dropdown').length){
			$this.children('.dropdown').stop(true, true).show();
		}else{
			$this.addClass('active custom_color_bg');
			$('#children_category_' + this.id).stop(true, true).show()
		}

	}, function() {
		var $this = $(this);

		if($this.find('.dropdown').length){
			$this.children('.dropdown').stop(true, true).hide();
		}else{
				$this.removeClass('active custom_color_bg');
				$('.videos_drop').stop(true, true).hide();
		}

	});


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
	$('.showing_menu').toggle();
	if($('.show_menu').hasClass('active')){
		$('.show_menu').removeClass('active')
	} else {
		$('.show_menu').addClass('active')
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
})

$(".options .config").on('click', function(e){
	e.preventDefault();
	$('.options .showing_config').toggle();
	if($(this).hasClass('active')){
		$(this).removeClass('active')
	} else {
		$(this).addClass('active')
	}
})


/*$( ".options_menu_fixed .config" ).hover(
	function(){
	$(this).attr('style', 'background-color: '+color+' !important')
	},
	function(){
		if(!$(this).hasClass('active')) {
			$(this).attr('style', '')
		}
	}
)*/


//$('.custom_color_bg').css('background-color',color);
//$('.custom_color_text').attr('style', 'color: '+color+' !important')






})




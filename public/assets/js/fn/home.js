$(document).ready(function(){

	$('.bxslider').bxSlider({
		mode: 'fade',
		captions: true,
		auto : true,
		controls :false,
		hideControlOnEnd : false
	});

	$(document).scroll(function() {
		var scrolledHeight = $(document).scrollTop(), $main_nav = $("#main_nav");

		if(scrolledHeight >= 95){
			$main_nav.addClass("menu_fixed");
		}else{
			$main_nav.removeClass("menu_fixed");
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




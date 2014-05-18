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

})




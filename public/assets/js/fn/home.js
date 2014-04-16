
var color = "#EF8535";

$(document).ready(function(){
	console.log($('.dropdown-toggle'));




	$('ul li.li_menu').hover(function() {


$(this).attr('style', 'background-color: '+color+' !important')
  $(this).children('.dropdown').stop(true, true).show();
  jQuery(this).addClass('open');
}, function() {
  $(this).children('.dropdown').stop(true, true).hide();
  $(this).removeClass('open');
  		if(!$(this).hasClass('active')) {
			$(this).attr('style', '')
		}
});

//$('.dropdown-toggle').dropdownHover().dropdown();

/*$( ".menu li, .paginate li, .view_options .v1 a, .view_options .v2 a, .view_options .v3 a", '#container' ).hover(
	function(){
	$(this).attr('style', 'background-color: '+color+' !important')
	},
	function(){
		if(!$(this).hasClass('active')) {
			$(this).attr('style', '')
		}
	}
);*/

$( ".option_news li a, #footer_nav ul li a" ).hover(
	function(){
	$(this).attr('style', 'color: '+color+' !important')
	},
	function(){
		if(!$(this).hasClass('active')) {
			$(this).attr('style', '')
		}
	}
)
$(".options_menu_fixed .search ").on('click', function(e){
	e.preventDefault();
	$('.search_box').toggle();
	if($('.search_box').hasClass('active')){
		$(this).attr('style', '')
		$('.search_box').removeClass('active')
	} else {
		$(this).attr('style', 'background-color: '+color+' !important')
		$('.search_box').addClass('active')
	}

})

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


$( ".options_menu_fixed .config" ).hover(
	function(){
	$(this).attr('style', 'background-color: '+color+' !important')
	},
	function(){
		if(!$(this).hasClass('active')) {
			$(this).attr('style', '')
		}
	}
)


$('.custom_color_bg').css('background-color',color);
$('.custom_color_text').attr('style', 'color: '+color+' !important')

$(document).scroll(function() {
		var scrolledHeight = $(document).scrollTop();

		if(scrolledHeight >= 95){
			$("#main_nav").addClass("menu_fixed");
		}
		else{
			$("#main_nav").removeClass("menu_fixed");
		}


})




})




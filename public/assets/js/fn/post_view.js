$(function(){

	var $modal = $('#ajax-modal');


	$('#open_post_gallery').on('click', function(e){
		e.preventDefault();
		var $this = $(this);

		if(!$this.attr('href')){
			return false;
		}

		$('body').modalmanager('loading');

		setTimeout(function(){
			$modal.load($this.attr('href'), '', function(){
				$modal.modal({ backdrop: 'static'});
				$('#slider_post_gallery').bxSlider({
					mode: 'fade',
					captions: true,
					auto : false,
					pager:false
				});


			});
		}, 1000);

	});

});
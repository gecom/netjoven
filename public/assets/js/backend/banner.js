$(function(){

	var $modal = $('#ajax-modal');

	$('#register_banner').on('click', function(e){
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

});
$(function(){

	var $modal = $('#ajax-modal'), $view_options = $('#view_options');;

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
	});

})
$(function(){
	var $modal_delete = $('#modal_delete');
	
	$('.delete', '#grid_post_list').on('click', function(e){
		e.preventDefault();
		var $this = $(this);
		$modal_delete.modal('show');
		$modal_delete.data('id', $this.data('id'));
		$modal_delete.data('url', $this.attr('href'));
	});

	$modal_delete.on('click', '#btn_confirm',function(e){
		e.preventDefault();
		$.ajax({
			url: $modal_delete.data('url'),
			type:'post',
			dataType:'json'
		}).done(function(response){
			var is_error = false;
			var message = '';
			if(response.success == true){
				message = response.message;				
				$modal_delete.modal('hide');
				setTimeout(function(){
					$('[data-id=' + $modal_delete.data('id') + ']').parent().parent().remove();
				}, 800);
			}else{
				is_error = true;
				var arr = response.errors;
				$.each(arr, function(index, value){
					if (value.length != 0){
						message += value +"\n";
					}
				});

			};

			$.notify(message, (is_error == true ? "error" : "success"));
		});
	});



})
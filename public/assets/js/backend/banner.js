$(function(){

	var $modal = $('#ajax-modal');

	$('.edit', '#grid_banner').on('click', function(e){
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

	$modal.on('submit', '#frm_banner', function(e){
		e.preventDefault();
		var $this = $(this);

		$.ajax({
			url: $this.attr('action') ,
			type:'post',
			dataType:'json',
			data: $this.serializeArray()
		}).done(function(response){

			var is_error = false;
			var message = '';
			if(response.success == true){
				message = response.message;
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

			if(is_error == false){
				setTimeout(function(){
					window.location.href = response.redirect;
				}, 1500);
			}

		});

	});

});
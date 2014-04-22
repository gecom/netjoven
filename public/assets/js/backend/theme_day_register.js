$(function(){

	$('#frm_theme_day').on('submit', function(e){
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

				if(response.redirect){
					window.location.href = response.redirect;
				}
			}else{
				is_error = true;
				var arr = response.errors;
				$.each(arr, function(index, value){
					if (value.length != 0){
						message += value +"\n";
					}
				});

			}

			$.notify(message, (is_error == true ? "error" : "success"));
		});

	});

})
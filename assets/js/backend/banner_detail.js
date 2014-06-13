$(function(){

	var $modal = $('#ajax-modal'), $modal_delete = $('#modal_delete'), $frm_banner_filter = $('#frm_banner_filter'), data_params = $('#banner_params_filter');

	$frm_banner_filter.find('select').on('change', function(){
		var $this = $(this);

		if($this.attr('id') == 'frm_banner_filter_module'){
			$('#frm_banner_filter_submodule').val('');
		}

		var data_banner_filter = $frm_banner_filter.serializeArray();

		$.ajax({
			url: $frm_banner_filter.attr('action'),
			type:'post',
			dataType:'json',
			data: data_banner_filter
		}).done(function(response){
			if(response.success == true){
				window.location = response.redirect;
			}
		});

	});

	$('.edit', '#grid_banner').on('click', function(e){
		e.preventDefault();
		var params = data_params.val();
		var $this = $(this);

		if(!$this.attr('href')){
			return false;
		}

		$('body').modalmanager('loading');

		setTimeout(function(){
			$modal.load($this.attr('href') + '?data_params=' + params, '', function(){
				$('#datetimepicker_date_start, #datetimepicker_date_end').datetimepicker({
					pickTime: false
				});
				$modal.modal({ backdrop: 'static'});
			});
		}, 1000);
	});


	$('.delete', '#grid_banner').on('click', function(e){
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

	$('#register_banner_detail').on('click', function(e){
		e.preventDefault();
		var params = data_params.val();
		var $this = $(this);

		if(!$this.attr('href')){
			return false;
		}

		$('body').modalmanager('loading');

		setTimeout(function(){
			$modal.load($this.attr('href') + '?data_params=' + params, '', function(){
				$('#datetimepicker_date_start, #datetimepicker_date_end').datetimepicker({
					pickTime: false
				});
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


	$('#grid_banner .change_status').on('change', function(){
		var $this = $(this);
		$.ajax({
			url: $this.attr('data-url') ,
			type:'post',
			dataType:'json',
			data: {status : $this.val()}
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

		});

	})




});
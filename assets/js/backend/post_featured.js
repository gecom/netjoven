var registerPostFeatured = (function(){

	var _uploadImage = function(filename, url , onSubmit, onSuccess){

 		$(filename).fileupload({
	        url: url,
	        dataType: 'json',
	       	autoUpload: true,
	        acceptFileTypes: /(\.|\/)(jpe?g|png|gif)$/i,
	        maxFileSize: 5000000,
	        submit:function(e, data){
	        	onSubmit(data);
	        	/*if(typeof params_url != 'undefined'){
					data.formData = params_url;
	        	}*/
	        },
			done: function (e, data) {
				onSuccess(data);
	        },
	        progressall: function (e, data) {
	        	console.log(data);

	           /* var progress = parseInt(data.loaded / data.total * 100, 10);
	            $('#progress .progress-bar').css(
	                'width',
	                progress + '%'
	            );*/
	        }
        }).prop('disabled', !$.support.fileInput)
		.parent().addClass($.support.fileInput ? undefined : 'disabled');

	};

	return {
		uploadImage : _uploadImage
	}

})();

$(function(){

	var $frm_post_featured = $('#frm_post_featured'), $frm_post_featured_type = $('#frm_post_featured_type'), $frm_post_featured_is_video = $('#frm_post_featured_is_video');

	$frm_post_featured.on('submit', function(e){
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
					setTimeout(function(){
						window.location.href = response.redirect;
					}, 500);

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

			if(message){
				$.notify(message, (is_error == true ? "error" : "success"));
			}

		});

	});

	 $('#datetimepicker_post_at, #datetimepicker_expired_at').datetimepicker({
	 	language: 'es'
	 });

	registerPostFeatured.uploadImage('#fileupload_principal','/backend/upload_file_image/featured',
	function(data){
			var param_form = {type_featured : $frm_post_featured_type.val()}

			if($frm_post_featured_is_video.length){
				param_form.is_video = 1;
			}

			data.formData = param_form;
	} ,
	function(response){
		var message = '', is_error = false;

		if(response.result.success == true){

			var $wrapper_image_data = $('#images-data').html(), data = {};
			data.image = response.result;

			$('#frm_post_featured_image').val(response.result.name);
			$('#preview_image').find('ul').html(_.template($wrapper_image_data,{item:data}));
			message = response.result.message;
		}else{
			is_error = true;
			var arr = response.result.errors;
			$.each(arr, function(index, value){
				if (value.length != 0){
					message += value +"\n";
				}
			});

		}

		if(message){
			$.notify(message, (is_error == true ? "error" : "success"));
		}

	});


})
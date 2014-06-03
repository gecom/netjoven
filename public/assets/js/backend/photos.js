$(function(){

	$('#fileupload_gallery').fileupload({
	    url: '/backend/upload_file_image/noticias',
	    dataType: 'json',
	   	autoUpload: true,
	    acceptFileTypes: /(\.|\/)(jpe?g|png|gif)$/i,
	    maxFileSize: 5000000,
		done: function (e, response) {
			var data = {};
			if(response.result.success == 1){
				data.image = response.result;

				$.ajax({
					url: '/backend/fotos/guardar',
					type:'post',
					dataType:'json',
					data: {image : response.result.name}
				}).done(function(response){
					var is_error = true;
					if(response.success == true){
						is_error = false;
						var $wrapper_image_data = $('#images-data').html();
						$('#wrapper_gallery').find('ul').append(_.template($wrapper_image_data,{item:data}));
					}

					$.notify(response.message, (is_error == true ? "error" : "success"));
				});

			}else{
				$.notify(data.result.message, "error");
			}

	    },
	    progressall: function (e, data) {
	    	console.log(data);
	    }
	}).prop('disabled', !$.support.fileInput)
	.parent().addClass($.support.fileInput ? undefined : 'disabled');

	$('.glyphicon-file', '#wrapper_gallery ').zclip({
		path:'/assets/ZeroClipboard.swf',
		copy:function(){
			var $this = $(this);
			return $this.parents('.thumbnail').find('input').val();
		},
		afterCopy:function(){
			$.notify("URL copiada",  "success");
		}
	});


});
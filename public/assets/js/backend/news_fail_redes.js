$(function(){

var 	$preview_image_principal = $('#preview_image_principal'),
	$frm_news_image_principal = $('#frm_news_image_principal');

	$('#fileupload_principal').fileupload({
		url: '/backend/upload_file_image/noticias',
		dataType: 'json',
		autoUpload: true,
		acceptFileTypes: /(\.|\/)(jpe?g|png|gif)$/i,
		maxFileSize: 5000000,
		submit:function(e, data){
			data.formData = {'is_fail_redes' : true};
		},
		done: function (e, response) {
			if(response.result.success == 1){
				var $wrapper_image_data = $('#images-data').html(), data = {};
				data.image = response.result;
				data.is_principal = true;

				$preview_image_principal.find('ul').empty().html(_.template($wrapper_image_data,{item:data}));
				$frm_news_image_principal.val(JSON.stringify(data));
			}

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


});
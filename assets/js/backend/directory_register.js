var registerDirectory = (function(){

	var _uploadImage = function(filename, url , params_url, onSuccess){

 		$(filename).fileupload({
	        url: url,
	        dataType: 'json',
	       	autoUpload: true,
	        acceptFileTypes: /(\.|\/)(jpe?g|png|gif)$/i,
	        maxFileSize: 5000000,
	        submit:function(e, data){
	        	if(typeof params_url != 'undefined'){
					data.formData = params_url;
	        	}
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

	var _addMarkerGoogleMap = function(map, event){
		map.gmap3({
			clear:{name : 'marker'},
			marker:{
				latLng:event.latLng
			}
		});

		$('#frm_diretory_latitude').val(event.latLng.lat());
		$('#frm_diretory_longitude').val(event.latLng.lng());
	}

	return {
		uploadImage : _uploadImage,
		addMarkerGoogleMap : _addMarkerGoogleMap
	}
})();

$(function(){

	var latitude = $('#frm_diretory_latitude').val() || '', longitude = $('#frm_diretory_longitude').val() || '',
	$preview_map = $('#preview_map');

	var options_map = {};


	if(!latitude && !longitude){

		options_map = {
			map : {
				options: {
					center : [-12.093878 , -77.039694],
					zoom : 14
				},
				events:{
					click: function(map, event){
						registerDirectory.addMarkerGoogleMap($(this), event);
					}
				}
			}

		}

	}else{

		options_map = {
			marker : {
				values:[{latLng:[latitude, longitude]}]
			},
			map : {
				 options: { zoom : 14 }
			}
		};
	}


	$preview_map.gmap3(options_map);


	$('#clear_map').on('click', function(){
		var $clear_map = $(this);
		$preview_map.gmap3({
			clear:{name : 'marker'},
			map : {
				options: { zoom : 14 },
				events:{
					click: function(map, event){
						registerDirectory.addMarkerGoogleMap($(this), event);
						$clear_map.remove();
					}
				}
			}
		});
	});


	$('#frm_directory_publication').on('submit', function(e){
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

				setTimeout(function(){
					if(response.redirect){
						window.location.href = response.redirect;
					}
				}, 700)

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

	$('#frm_directory_publication_image').on('submit', function(e){
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

			}

			if(message){
				$.notify(message, (is_error == true ? "error" : "success"));
			}

		});

	});


	registerDirectory.uploadImage('#file_image_principal','/backend/upload_file_image/agenda', {is_principal : true}, function(response){
		var $wrapper_image_data = $('#images-data').html(), data = {};
		data.image = response.result;
		data.is_principal = true;

		$('#frm_directory_image_principal').val(response.result.name);
		$('#wrapper_image_principal').find('ul').html(_.template($wrapper_image_data,{item:data}));
	});

	registerDirectory.uploadImage('#file_image_internal','/backend/upload_file_image/agenda', {is_gallery : true}, function(response){
		var $wrapper_image_data = $('#images-data').html(), data = {};
		data.image = response.result;
		data.is_gallery = true;

		$('#frm_directory_image_internal').val(response.result.name);
		$('#wrapper_image_internal').find('ul').html(_.template($wrapper_image_data,{item:data}));
	});



});

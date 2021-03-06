$(function(){
	var $parent_category = $('#frm_news_category'), $subcategory = $('#frm_news_subcategory'),
	$preview_image_principal = $('#preview_image_principal'), $wrapper_gallery = $('#wrapper_gallery'),
	$frm_news_image_principal = $('#frm_news_image_principal'),
	$frm_news_gallery = $('#frm_news_gallery');

	$('#frm_directory_publication_gallery').on('submit', function(e){
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

	})

	$parent_category.on('change', function(){
		var $this = $(this), category_id = $this.val(), $wrapper_video = $('#wrapper_video');

		if(!category_id){
			return false;
		}

		$.ajax({
			url:"/backend/autocompletar_categoria",
			type:'post',
			dataType: 'json',
			data: {
				'category_id' : category_id,
				'has_category_not_in' : 1
			}
		}).done(function(response){

			var subcategories = [];
			if(response.length){
				for (var i in response) {
					subcategories.push('<option value ="'+response[i].id+'">', response[i].name,'</option>');
				}
			}

			$subcategory.html(subcategories.join(''));

			if($this.val() == 63){
				$wrapper_video.fadeIn('slow');
			}else{
				$wrapper_video.fadeOut('slow');
			}

		})
	});

	registerPost.uploadImage('#fileupload_principal','/backend/upload_file_image/noticias', function(response){
		if(response.result.success == 1){
			var $wrapper_image_data = $('#images-data').html(), data = {}, category_id = $('#frm_news_subcategory').val();

			data.image = response.result;
			data.is_principal = true;

			$preview_image_principal.find('ul').empty().html(_.template($wrapper_image_data,{item:data}));
			$frm_news_image_principal.val(JSON.stringify(data));

			var $image_principal = $preview_image_principal.find('img');

			var width = 300; height = 187;
			if(category_id == 42){
				width = 260; 
				height = 370;
			}

			 $image_principal.load(function(){
				var ias = $image_principal.imgAreaSelect({
					x1: 0, y1: 0, x2: width, y2: height,
					resizable:false,
					aspectRatio: "12:8",
					handles: true,
					instance: true,
					onInit:function (img, selection){
						selection.width = width;
						selection.height = height;
					},
					onSelectChange:function(img, selection){
						if(selection.width == 0 && selection.height == 0){
							ias.setSelection(0, 0, width, height);
							ias.setOptions({ show: true });
							ias.update();
						}
					},
				});

				$preview_image_principal.find('button').on('click', function(e){
					e.preventDefault();
					var data_params = ias.getSelection();
						data_params.filename = response.result.name;

					$.ajax({

						url:"/backend/cortar_imagen",
						type:'post',
						dataType: 'json',
						data: data_params
					}).done(function(response){
						if(response.success == 1){
							var randomNum = Math.floor(Math.random()*10);
							setTimeout(function(){
								$image_principal.prop('src',response.filename + '?v=' + randomNum );
								ias.cancelSelection();
								ias.update();
							}, 500)

						}

					});
				});


			});
		}
	});


	registerPost.uploadImage('#fileupload_gallery', '/backend/upload_file_gallery', function(response){
		if(response.result.success == 1){
			var $wrapper_image_data = $('#images-data').html(), data = {};
			data.image = response.result;
			data.is_gallery = true;
			$wrapper_gallery.find('ul').append(_.template($wrapper_image_data,{item:data}));
		}
	});

	tinymce.init({
		mode : "textareas",
	    selector: "#frm_news_description",
	    theme: "modern",
	    plugins: [
	        "advlist autolink lists link image charmap print preview hr anchor pagebreak",
	        "searchreplace wordcount visualblocks visualchars code fullscreen",
	        "insertdatetime media nonbreaking save table contextmenu directionality",
	        "emoticons template paste textcolor"
	    ],
	    toolbar1: "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image",
	    toolbar2: "print preview media | forecolor backcolor emoticons",
	    image_advtab: true,
	    file_browser_callback : registerPost.elFinderBrowser
	});

});
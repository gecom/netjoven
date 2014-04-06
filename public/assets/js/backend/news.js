var registerPost = (function(){

	var _uploadImage = function(filename, url ,onSuccess){

 		$(filename).fileupload({
	        url: url,
	        dataType: 'json',
	       	autoUpload: true,
	        acceptFileTypes: /(\.|\/)(jpe?g|png|gif)$/i,
	        maxFileSize: 5000000,	       
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


$(document).ready(function(){

	var $parent_category = $('#frm_news_category'), $subcategory = $('#frm_news_subcategory'),
	$preview_image_principal = $('#preview_image_principal'), $wrapper_gallery = $('#wrapper_gallery'),
	$frm_news_image_principal = $('#frm_news_image_principal'),
	$frm_news_gallery = $('#frm_news_gallery');

	registerPost.uploadImage('#fileupload_principal','/backend/upload_file', function(response){
		if(response.result.success == 1){
			var $wrapper_image_data = $('#images-data').html(), data = {};

			data.image = response.result;
			data.is_principal = true;
			
			$preview_image_principal.find('ul').html(_.template($wrapper_image_data,{item:data}));
			$frm_news_image_principal.val(JSON.stringify(data));

			var $image_principal = $preview_image_principal.find('img');

			 $image_principal.load(function(){
				var ias = $image_principal.imgAreaSelect({ 
					x1: 0, y1: 0, x2: 300, y2: 187,
					resizable:false,
					aspectRatio: "12:8",
					handles: true,
					instance: true,
					onInit:function (img, selection){
						selection.width = 300;
						selection.height = 187;
					},
					onSelectChange:function(img, selection){
						if(selection.width == 0 && selection.height == 0){
							ias.setSelection(0, 0, 300, 187);
							ias.setOptions({ show: true });
							ias.update();
						}						
					},
				});

				$preview_image_principal.find('button').on('click', function(e){
					e.preventDefault();
					console.log(ias.getSelection());
					var data_params = ias.getSelection();
						data_params.filename = response.result.name;

					$.ajax({

						url:"/backend/cortar_imagen",
						type:'post',
						dataType: 'json',
						data: data_params
					}).done(function(response){
						if(response.success == 1){
							var randomNum = Math.floor(Math.random()*2);
							$image_principal.prop('src',response.filename + '?v=' + randomNum );
							//delete $.fn.imgAreaSelect;
						}

					});
				});


			});					
		}
	});

   
	registerPost.uploadImage('#fileupload_gallery', '/backend/upload_file_gallery', function(response){
		if(response.result.success == 1){
			var $wrapper_image_data = $('#images-data').html(), data_galleries = $frm_news_gallery.val() , data = {};	

			data.image = response.result;
			data.is_gallery = true;

			if(data_galleries){
				data_galleries = JSON.parse(data_galleries);
			}else{
				data_galleries = [];
			}

			data_galleries.push(data);

			$frm_news_gallery.val(JSON.stringify(data_galleries));			
			$wrapper_gallery.find('ul').append(_.template($wrapper_image_data,{item:data}));
		}
	});

	$parent_category.on('change', function(){
		var $this = $(this), category_id = $this.val();

		if(!category_id){
		return false;
		}

		$.ajax({
			url:"/backend/autocompletar_categoria",
			type:'post',
			dataType: 'json',
			data: {
				'category_id' : category_id
			}
		}).done(function(response){

			var subcategories = [];
			if(response.length){
				for (var i in response) {
					subcategories.push('<option value ="'+response[i].id+'">', response[i].name,'</option>');
				}
			}

			$subcategory.html(subcategories.join(''));
		})
	});


	$('#frm_news_description').tinymce({
		script_url : '/assets/js/tiny_mce/tiny_mce.js',
		theme : "advanced",
		plugins : "save,advhr,advimage,advlink,preview,media,searchreplace,print,contextmenu,paste,fullscreen",
		theme_advanced_buttons1 : "bold,italic,underline,strikethrough,|,justifyleft,justifycenter,justifyright,justifyfull,cut,copy,paste,pastetext,|,search,replace,|,undo,redo,|,link,unlink,image,cleanup,code,|,preview,|,forecolor,backcolor,fullscreen,media",
		theme_advanced_buttons2 : "",
		theme_advanced_buttons3 : "",
		theme_advanced_toolbar_location : "top",
		theme_advanced_toolbar_align : "left",
		theme_advanced_statusbar_location : "bottom",
		theme_advanced_resizing : true,
		theme_advanced_resizing_min_width : 800,
		theme_advanced_resizing_max_width : 800,
		content_css : "/assets/js/tiny_mce/themes/advanced/skins/default/content.css",
		external_link_list_url : "lists/link_list.js",
		external_image_list_url : "lists/image_list.js",
		convert_urls : false
	});

});
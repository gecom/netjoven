$(document).ready(function(){
	var $subcategory = $('#frm_news_subcategory');

		$('#frm_news_category').on('change', function(){
			var $this = $(this), category_id = $this.val();

			if(!category_id){
				return false;
			}

			$.ajax({
				url:"/backend/noticia/autocompletar_categoria",
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
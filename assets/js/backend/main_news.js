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


	var _elFinderBrowser = function(field_name, url, type, win){
		tinymce.activeEditor.windowManager.open({
				file: '/backend/elfinder/tinymce',// use an absolute path!
				title: 'Subir Imagenes',
				width: 900,
				height: 450,
				resizable: 'yes'
			},
			{
			setUrl: function (url) {
				win.document.getElementById(field_name).value = url;
			}
		});

		return false;
	}

	return {
		uploadImage : _uploadImage,
		elFinderBrowser : _elFinderBrowser
	}
})();



$(function(){

	var $frm_news_register = $('#frm_news_register'), $frm_news_description = $('#frm_news_description');

	$('#datetimepicker_post_at').datetimepicker({
	 	language: 'es'
	 });

    var elt = $('#frm_news_keywords');

    elt.tagsinput();
    elt.tagsinput('input').typeahead({
        name: 'user-search',
	    remote: '/backend/autocompletar_tag?keyword=%QUERY',
	    limit: 10 // limit to show only 10 results
    }).bind('typeahead:selected', $.proxy(function (obj, datum) {
        this.tagsinput('add', datum.value);
        this.tagsinput('input').typeahead('setQuery', '');
    }, elt));


	$frm_news_register.on('submit', function(e){
		e.preventDefault();
		var $this = $(this)

		if($frm_news_description.length){
			$('#frm_news_description').val(tinyMCE.activeEditor.getContent());
		}

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

			};

			$.notify(message, (is_error == true ? "error" : "success"));
		});

	});

});
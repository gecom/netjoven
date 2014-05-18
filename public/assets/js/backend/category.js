$(function(){

	$('#file_image').fileupload({
		url: '/backend/upload_file_image/category',
		dataType: 'json',
		autoUpload: true,
		acceptFileTypes: /(\.|\/)(jpe?g|png|gif)$/i,
		maxFileSize: 5000000,
		done: function (e, data) {
			if(data.result.success == 1){
				$('#frm_category_image').val(data.result.name);
				$('#preview_image_principal').show().find('.thumbnail div').html('<img src="'+data.result.filename+'">');
				$.notify(data.result.message, "success");
			}else{
				$.notify(data.result.message, "error");
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


	$('#frm_category').on('submit', function(e){
		e.preventDefault();
		var $this = $(this);

		$.ajax({
			url: $this.attr('action'),
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

				}, 2000)

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

	var elt = $('#frm_category_keyword');

    elt.tagsinput();
    elt.tagsinput('input').typeahead({
        name: 'user-search',
	    remote: '/backend/autocompletar_tag?keyword=%QUERY',
	    limit: 10 // limit to show only 10 results
    }).bind('typeahead:selected', $.proxy(function (obj, datum) {
        this.tagsinput('add', datum.value);
        this.tagsinput('input').typeahead('setQuery', '');
    }, elt));

});
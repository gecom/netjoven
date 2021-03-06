$(function(){

	var $wrapper_department = $('#wrapper_department'), $frm_user_city = $('#frm_user_city'), $frm_user_department = $('#frm_user_department');

	$('#frm_user_country').on('change', function(){
		var $this = $(this);

		if($this.val() == 'Peru'){
			$wrapper_department.show();
			$frm_user_department[0].selectedIndex = 0;
			$frm_user_department.attr('disabled', false);
			$frm_user_city.html('<option value="">--Seleccione--</option>');
		}else{
			$wrapper_department.hide();

			$.ajax({
				url:"/load_city.html",
				type:'post',
				dataType: 'json',
				data: {
					'country_name' : $this.val()
				}
			}).done(function(response){

				var data_city = [];
				data_city.push('<option value="">--Seleccione--</option>');
				if(response.length){
					for (var i in response) {
						data_city.push('<option value ="'+response[i].name+'">', response[i].name,'</option>');
					}
				}

				$frm_user_city.html(data_city.join(''));
				$frm_user_department.attr('disabled', true);
			})
		}

	});

	$frm_user_department.on('change', function(){
		var $this = $(this);
			$.ajax({
				url:"/load_province.html",
				type:'post',
				dataType: 'json',
				data: {
					'department_name' : $this.val()
				}
			}).done(function(response){

				var data_city = [];
				data_city.push('<option value="">--Seleccione--</option>');
				if(response.length){
					for (var i in response) {
						data_city.push('<option value ="'+response[i].name+'">', response[i].name,'</option>');
					}
				}

				$frm_user_city.html(data_city.join(''));
			})
	});


	$('#file_upload_image').fileupload({
	    url: '/upload_image_user.html',
	    dataType: 'json',
	   	autoUpload: true,
	    acceptFileTypes: /(\.|\/)(jpe?g|png|gif)$/i,
	    maxFileSize: 5000000,
		done: function (e, response) {
			if(response.result.success == 1){
				$('#photo_user').attr('src', response.result.filename);	
				$('#frm_user_image').val(response.result.image_original);
			}else{
				$('#wrapper_message').html(response.result.message);
			}
	    },
	    progressall: function (e, data) {
	    	console.log(data);
	    }
	}).prop('disabled', !$.support.fileInput)
	.parent().addClass($.support.fileInput ? undefined : 'disabled');

});
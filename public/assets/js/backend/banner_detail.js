$(function(){

	var $frm_banner_filter_submodule =  $('#frm_banner_filter_submodule'), 
	$frm_banner_filter = $('#frm_banner_filter');

	$('#frm_banner_filter_module').on('change', function(){
		var $this = $(this);

		$.ajax({
			url: '/backend/banners/load_submodule' ,
			type:'post',
			dataType:'json',
			data: {parent_id : $this.val() }
		}).done(function(response){
			var submodules = [];
			if(response.length){
				submodules.push('<option value ="">--Seleccione--</option>');
				for (var i in response) {
					submodules.push('<option value ="'+response[i].id+'">', response[i].name,'</option>');
				}
			}

			var $wrapper_submodule = $('#wrapper_submodule');

			if(submodules.length){
				$frm_banner_filter_submodule.html(submodules.join(''));
				$wrapper_submodule.show();
			}else{
				$frm_banner_filter_submodule.empty()
				$wrapper_submodule.hide();
			}

		});
	});

	$frm_banner_filter.find('select').on('change', function(){
		var data_banner_filter = $frm_banner_filter.serializeArray();

		$.ajax({
			url: $frm_banner_filter.attr('action'),
			type:'post',
			dataType:'json',
			data: data_banner_filter
		}).done(function(response){
			console.log(response);
		});

	});



});
$(function(){
	var $subcategory = $('#frm_statistics_filter_category_id');

	$('#datetimepicker_date_start, #datetimepicker_date_end').datetimepicker({
		pickTime: false
	});

	$('#frm_statistics_filter_category_parent_id').on('change', function(){
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
			subcategories.push('<option value="">--Seleccione--</option>');
			if(response.length){
				for (var i in response) {
					subcategories.push('<option value ="'+response[i].id+'">', response[i].name,'</option>');
				}
			}

			$subcategory.html(subcategories.join(''));
		})
	});

});
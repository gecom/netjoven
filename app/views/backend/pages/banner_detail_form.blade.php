<div class="modal-header">
	<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
	<h4 class="modal-title">{{$title}}</h4>
</div>
<div class="modal-body">
	<div class="row">
		<ol class="breadcrumb">
			@foreach ($breadkund as $b)
				<?php 
					if(empty($b)){
						continue;
					}
				?>
				<li class="">{{$b}}</li>
			@endforeach
		</ol>

		{{ Form::open(array('id' => 'frm_banner')) }}
			{{Form::hidden('frm_banner_detail[module_id]', (!empty($data_params['submodule']) ? $data_params['submodule'] : $data_params['module']), array('id' => 'frm_banner_detail_module_id'))}}
			{{Form::hidden('frm_banner_detail[sector_id]', $data_params['sector'], array('id' => 'frm_banner_detail_sector_id'))}}
			{{Form::hidden('frm_banner_detail[type]', $data_params['type'], array('id' => 'frm_banner_detail_type'))}}
			<div class="col-md-12">
				<div class="row">
					<div class="col-lg-9 form-group">
						<label for="frm_banner_detail_banner_id">Banner</label>                                    					
						<select class="form-control" id="frm_banner_detail_banner_id" name="frm_banner_detail[banner_id]">
							<option value="">--Seleccione--</option>
							@foreach ($dbl_banner as $dbr_banner)
								<?php $selected = (!$is_new && $dbr_banner_detail->banner_id == $dbr_banner->id ? 'selected="selected"' : '' ) ?>
								<option value="{{$dbr_banner->id}}" {{$selected}}  >{{$dbr_banner->title}}</option>
							@endforeach
						</select>
					</div>
				</div>

				@if ($data_params['module'] == 2)
					<div class="row">
						<div class="col-lg-9 form-group">
							<label for="frm_banner_detail_banner_id">Tag</label>                                    					
							<input class="form-control" value="{{($is_new ? '' : $dbr_banner_detail->tag)}}" id="frm_banner_detail_tag" name="frm_banner_detail[tag]" />
						</div>
					</div>
				@endif

				<div class="checkbox">
					<label>
						<?php $checked = ($is_new ? '' : ($dbr_banner_detail->status == Status::STATUS_ACTIVO ? 'checked="checked"' : '')) ?>
						<input  id="frm_banner_detail_status" name="frm_banner_detail[status]" {{$checked}} type="checkbox" value="1" /> Activo
					</label>
				</div>
				<div class="row">
					<div class="col-lg-6">
						<div class="form-group ">
						<label for="frm_banner_detail_weight">Peso</label> 
							<input type="number" min="0" value="{{($is_new ? 1 : $dbr_banner_detail->weight)}}"  id="frm_banner_detail_weight" name="frm_banner_detail[weight]" class="form-control" />
						</div>
					</div>
					<div class="col-lg-6 pull-right">
						<div class="form-group ">
						<label for="frm_banner_detail_country">Pais</label> 
						<select class="form-control" id="frm_banner_detail_country" name="frm_banner_detail[country]">
							<option value="">--Seleccione--</option>
							@foreach ($dbl_country as $dbr_country)
								<?php $selected = (!$is_new && $dbr_banner_detail->country == $dbr_country->country_code ? 'selected="selected"' : ($dbr_country->country_code == 'PE' ? 'selected="selected"' : '') ) ?>
								<option value="{{$dbr_country->country_code}}" {{$selected}} >{{$dbr_country->country_name}}</option>
							@endforeach
						</select>
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-lg-6">
						<div class="form-group ">
							<label for="frm_banner_detail_date_start">Fech. Inicio</label> 
							<div id="datetimepicker_date_start" class="input-group date"  data-date-format="DD/MM/YYYY">
								<?php $date_start = (!$is_new && $dbr_banner_detail->date_start != '0000-00-00' ? Helpers::getDateFormat($dbr_banner_detail->date_start, 'd/m/Y') : ''); ?>
								<input type="date" value="{{$date_start}}" id="frm_banner_detail_date_start" name="frm_banner_detail[date_start]" class="form-control" />
								<span class="input-group-addon"><span class="glyphicon-calendar glyphicon"></span></span>
							</div>									
						</div>
					</div>
					<div class="col-lg-6 pull-right">
						<div class="form-group ">
						<label for="frm_banner_detail_date_end">Fech. Fin</label> 
						<div id="datetimepicker_date_end" class="input-group date" data-date-format="DD/MM/YYYY" >
							<?php $date_end = (!$is_new && $dbr_banner_detail->date_end != '0000-00-00' ? Helpers::getDateFormat($dbr_banner_detail->date_end, 'd/m/Y') : ''); ?>
							<input type="date" value="{{$date_end}}" id="frm_banner_detail_date_end" name="frm_banner_detail[date_end]"  class="form-control" />
							<span class="input-group-addon"><span class="glyphicon-calendar glyphicon"></span></span>
						</div>	
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-lg-6">
						<div class="form-group ">
						<label for="frm_banner_filter_module">Hor. Inicio</label> 
							{{Form::selectRange('frm_banner_detail[time_start]', 0, 23, ($is_new ? 0 : $dbr_banner_detail->time_start), array('class' => 'form-control', 'id' => 'frm_banner_detail_time_start' ))}}
						</div>
					</div>

					<div class="col-lg-6 pull-right">
						<div class="form-group ">
						<label for="frm_banner_filter_module">Hor. Fin</label> 
							{{Form::selectRange('frm_banner_detail[time_end]', 0, 23, ($is_new ? 0 : $dbr_banner_detail->time_end), array('class' => 'form-control', 'id' => 'frm_banner_detail_time_end' ))}}
						</div>
					</div>
				</div>
			</div>
	        <div class="col-lg-10">
	        	<button type="submit" class="btn btn-success">Guardar</button>
	        </div>
		{{ Form::close() }} 
	</div>
</div>
<div class="modal-footer">
	<button type="button" data-dismiss="modal" class="btn btn-default">Close</button>
</div>
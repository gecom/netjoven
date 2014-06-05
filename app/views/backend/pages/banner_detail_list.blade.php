@extends('backend.layouts.default')

@section('title_content')
	{{$title}}
@stop

@section('css')
	{{ HTML::style('assets/css/bootstrap_modal/bootstrap-modal-bs3patch.css')}}
	{{ HTML::style('assets/css/bootstrap_modal/bootstrap-modal.css')}}
	{{ HTML::style('assets/css/backend/datetimepicker.css')}}
@stop


@section('content')

<div class="col-lg-12">
    <div class="panel panel-default">
        <div class="panel-heading">
            Detalle de {{$title}}
        </div>
        <div class="panel-body">
            <div class="row">
            	{{ Form::open(array('id' => 'frm_banner_filter')) }}
	            	<div class="col-md-8">
						<div class="row">
						    <div class="col-lg-6">
						        <div class="form-group ">
						            <label for="frm_banner_filter_module">Modulo</label> 
									<select class="form-control" id="frm_banner_filter_module" name="frm_banner_filter[module]">
										@foreach ($dbl_banner_module_parent as $dbr_banner_module_parent)
											<?php $selected = (is_array($data_params) && $data_params['module'] == $dbr_banner_module_parent->id ? 'selected="selected"' : '' ); ?>
											<option value="{{$dbr_banner_module_parent->id}}" {{$selected}} >{{$dbr_banner_module_parent->name}}</option>
										@endforeach
									</select>
						        </div>
						    </div>
							@if ($dbl_banner_module_children)
							    <div id="wrapper_submodule" class="col-lg-6 pull-right">
							        <div class="form-group">
										<label for="frm_banner_filter_submodule">Sub modulo</label>                                               
										<select class="form-control" id="frm_banner_filter_submodule" name="frm_banner_filter[submodule]">
											<option value="">--Seleccione--</option>
											@foreach ($dbl_banner_module_children as $dbr_banner_module_children)
												<?php $selected = (is_array($data_params) && isset($data_params['submodule']) && $data_params['submodule'] == $dbr_banner_module_children->id ? 'selected="selected"' : '' ); ?>
												<option value="{{$dbr_banner_module_children->id}}"  {{$selected}} >{{$dbr_banner_module_children->name}}</option>
											@endforeach											
										</select>
							        </div>
							    </div>
						    @endif
						</div>
						<div class="row">
							<div class="col-lg-4 form-group">
								<label for="frm_banner_filter_type">Tipo</label>                                    					
								<select class="form-control" id="frm_banner_filter_type" name="frm_banner_filter[type]">
									@foreach (BannerHelper::$type_banner as $key => $type)
										<?php $selected = (is_array($data_params) && $data_params['type'] == $key ? 'selected="selected"' : '' ); ?>
										<option value="{{$key}}" {{$selected}} >{{$type}}</option>
									@endforeach
								</select>
							</div>
						</div>
						<div class="row">
							<div class="col-lg-4 form-group">
								<label for="frm_banner_filter_sector">Sector</label>                                    					
								<select class="form-control" id="frm_banner_filter_sector" name="frm_banner_filter[sector]">
									@foreach ($dbl_banner_sector as $dbr_banner_sector)
										<?php $selected = (is_array($data_params) && $data_params['sector'] == $dbr_banner_sector->id ? 'selected="selected"' : '' ); ?>
										<option value="{{$dbr_banner_sector->id}}" {{$selected}} >{{$dbr_banner_sector->name}}</option>
									@endforeach
								</select>
							</div>
						</div>
	            	</div>
            	{{ Form::close() }} 
                <div class="col-lg-12">
                	<input type="hidden" id="banner_params_filter" value='{{json_encode($data_params)}}' />
                	<a href="{{ route('backend.banner_detail.register') }}" id="register_banner_detail" class="btn btn-primary pull-right"><b>+</b> Agregar Detalle {{$title}}</a>
                </div>
                <div class="show-grid col-lg-12">
					<table id="grid_banner" class="table table-striped table-bordered table-hover dataTable no-footer">
						<thead>
							<tr>
								<th>Titulo</th>
								<th>Peso</th>
								<th>Pais</th>
								<th>Fech. Inicio</th>
								<th>Fech. Fin</th>
								<th>Hor. Inicio</th>
								<th>Hor. Fin</th>
								<th>Estado</th>
								<th class="td-actions">Opciones</th>
							</tr>
						</thead>
						<tbody>
							@foreach ($dbl_banner_detail as $dbr_banner_detail)
								<tr>
									<td>{{$dbr_banner_detail->banner_title}}</td>
									<td>{{$dbr_banner_detail->weight}}</td>
									<td>{{$dbr_banner_detail->country}}</td>
									<td>{{($dbr_banner_detail->date_start == '0000-00-00' ? '' : Helpers::getDateFormat($dbr_banner_detail->date_start, 'd/m/Y'))}}</td>
									<td>{{($dbr_banner_detail->date_start == '0000-00-00' ? '' : Helpers::getDateFormat($dbr_banner_detail->date_end, 'd/m/Y'))}}</td>
									<td>{{$dbr_banner_detail->time_start}}</td>
									<td>{{$dbr_banner_detail->time_end}}</td>
									<td>{{Form::select('banner', Status::$statuses_banner, $dbr_banner_detail->status, array('class' => 'form-control change_status', 'data-url' => route('backend.banner_detail.change_status', array($dbr_banner_detail->id))))}}</td>
									<td>
										<a href="{{ route('backend.banner_detail.register', array($dbr_banner_detail->id)) }}" title="Editar" class="btn btn-primary btn-xs edit" ><span class="glyphicon glyphicon-edit"></span></a>
										<a data-id="{{$dbr_banner_detail->id}}" href="{{ route('backend.banner_detail.delete', array($dbr_banner_detail->id)) }}" title="Eliminar" class="btn btn-primary btn-xs delete" ><span class="glyphicon glyphicon-trash"></span></a>
									</td>
								</tr>
							@endforeach
						</tbody>
					</table>
					{{$dbl_banner_detail->links()}}
                </div>
            </div>
        </div>
    </div>
</div>

<div style="display: none;" tabindex="-1" class="modal fade" data-width="500" id="ajax-modal"></div>
<div id="modal_delete" tabindex="-1" data-width="500" class="modal fade" style="display: none;" >
    <div class="modal-header">
        <a href="#" data-dismiss="modal" aria-hidden="true" class="close">×</a>
         <h3>Eliminar</h3>
    </div>
    <div class="modal-body">
        <p>Usted va eliminar el registro.</p>
        <p>¿Desea continuar con el proceso?</p>
    </div>
    <div class="modal-footer">
      <a href="#" id="btn_confirm" class="btn btn-primary btn-xs">Aceptar</a>
      <a href="#" data-dismiss="modal" aria-hidden="true" class="btn btn-danger btn-xs">Cancelar</a>
    </div>
</div>
@stop

@section('js')
    {{ HTML::script('assets/js/bootstrap_modal/bootstrap-modal.js'); }}
    {{ HTML::script('assets/js/bootstrap_modal/bootstrap-modalmanager.js'); }}
	{{ HTML::script('assets/js/sb-admin.js'); }}
	{{ HTML::script('assets/js/datetimepicker/moment.js'); }}
	{{ HTML::script('assets/js/datetimepicker/datetimepicker.es.js'); }}
	{{ HTML::script('assets/js/datetimepicker/datetimepicker.js'); }}
	{{ HTML::script('assets/js/backend/banner_detail.js'); }}
@stop
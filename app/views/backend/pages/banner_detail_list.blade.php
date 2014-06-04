@extends('backend.layouts.default')

@section('title_content')
	{{$title}}
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
											<option value="{{$dbr_banner_module_parent->id}}">{{$dbr_banner_module_parent->name}}</option>
										@endforeach
									</select>
						        </div>
						    </div>
						    <div id="wrapper_submodule" class="col-lg-6 pull-right">
						        <div class="form-group">
									<label for="frm_banner_filter_submodule">Sub modulo</label>                                               
									<select class="form-control" id="frm_banner_filter_submodule" name="frm_banner_filter[submodule]">
										<option value="">--Selecciona--</option>
									</select>
						        </div>
						    </div>
						</div>
						<div class="row">
							<div class="col-lg-4 form-group">
								<label for="frm_banner_filter_type">Tipo</label>                                    					
								<select class="form-control" id="frm_banner_filter_type" name="frm_banner_filter[type]">
									@foreach (BannerHelper::$type_banner as $key => $type)
										<option value="{{$key}}">{{$type}}</option>
									@endforeach
								</select>
							</div>
						</div>
						<div class="row">
							<div class="col-lg-4 form-group">
								<label for="frm_banner_filter_sector">Sector</label>                                    					
								<select class="form-control" id="frm_banner_filter_sector" name="frm_banner_filter[sector]">
									@foreach ($dbl_banner_sector as $dbr_banner_sector)
										<option value="{{$dbr_banner_sector->id}}">{{$dbr_banner_sector->name}}</option>
									@endforeach
								</select>
							</div>
						</div>
	            	</div>
            	{{ Form::close() }} 
                <div class="col-lg-12">
                	<a href="{{ route('backend.banner.register') }}" id="register_banner" class="btn btn-primary pull-right"><b>+</b> Agregar Detalle {{$title}}</a>
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
									<td>{{Form::select('banner', Status::$statuses_banner, $dbr_banner_detail->status, array('class' => 'form-control'))}}</td>
									<td></td>
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
@stop

@section('js')
    {{ HTML::script('assets/js/bootstrap_modal/bootstrap-modal.js'); }}
    {{ HTML::script('assets/js/bootstrap_modal/bootstrap-modalmanager.js'); }}
	{{ HTML::script('assets/js/sb-admin.js'); }}
	{{ HTML::script('assets/js/backend/banner_detail.js'); }}
@stop
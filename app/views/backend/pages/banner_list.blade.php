@extends('backend.layouts.default')

@section('css')
	{{ HTML::style('assets/css/bootstrap_modal/bootstrap-modal-bs3patch.css')}}
	{{ HTML::style('assets/css/bootstrap_modal/bootstrap-modal.css')}}
@stop

@section('title_content')
	{{$title}}
@stop

@section('content')

<div class="col-lg-12">
    <div class="panel panel-default">
        <div class="panel-heading">
            Listado de {{$title}}
        </div>
        <div class="panel-body">
            <div class="row">
                <div class="col-lg-12">
                	<a href="{{ route('backend.banner.register') }}" id="register_banner" class="btn btn-primary pull-right"><b>+</b> Agregar {{$title}}</a>
                </div>
                <div class="show-grid col-lg-12">
					<table class="table table-striped table-bordered table-hover dataTable no-footer">
						<thead>
							<tr>
								<th class="col-md-6">Titulo</th>
								<th class="col-md-1 text-center" >Opciones</th>
							</tr>
						</thead>
						<tbody>
							@foreach($dbl_banners as $dbr_banner)
								<tr>
									<td>{{$dbr_banner->title}}</td>
									<td class="text-center">
										<a href="{{ route('backend.banner.register', array($dbr_banner->id)) }}" title="Editar" class="btn btn-primary btn-xs" ><span class="glyphicon glyphicon-edit"></span></a>
										<a href="#" title="Eliminar" class="btn btn-primary btn-xs" ><span class="glyphicon glyphicon-trash"></span></a>
									</td>
								</tr>
							@endforeach
						</tbody>
					</table>

					{{$dbl_banners->links()}}
                </div>
            </div>
        </div>
    </div>
</div>
<div style="display: none;" tabindex="-1" class="modal fade" data-width="500" id="ajax-modal"></div>
@stop

@section('js')
    {{ HTML::script('assets/js/bootstrap_modal/bootstrap-modal.js'); }}
    {{ HTML::script('assets/js/bootstrap_modal/bootstrap-modalmanager.js'); }}
	{{ HTML::script('assets/js/sb-admin.js'); }}
	{{ HTML::script('assets/js/backend/banner.js'); }}
@stop
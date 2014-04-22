@extends('backend.layouts.default')

@section('title_content')
	Temas del Día
@stop

@section('content')

<div class="col-lg-12">
    <div class="panel panel-default">
        <div class="panel-heading">
            Listado de Temas del día
        </div>
        <div class="panel-body">
            <div class="row">
                <div class="col-lg-12">
                	<a href="{{route('backend.theme_day.register_new')}}" class="btn btn-primary pull-right"><b>+</b> Agregar Tema del Día</a>
                </div>
                <div class="show-grid col-lg-12">
					<table class="table table-striped table-bordered table-hover dataTable no-footer">
						<thead>
							<tr>
								<th class="col-md-3">Tema</th>
								<th class="col-md-3" >Url</th>
								<th class="col-md-4" class="text-center">Acciones</th>
							</tr>
						</thead>
						<tbody>

						</tbody>
					</table>

                </div>
            </div>
        </div>
    </div>
</div>
@stop

@section('js')
	{{ HTML::script('assets/js/sb-admin.js'); }}
@stop
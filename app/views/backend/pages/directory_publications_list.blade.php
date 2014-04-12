@extends('backend.layouts.default')

@section('title_content')
	Directorio
@stop

@section('content')

<div class="col-lg-12">
    <div class="panel panel-default">
        <div class="panel-heading">
			{{$title_directory}}
        </div>
        <div class="panel-body">
            <div class="row">

                <div class="col-lg-12">
                	<a href="{{ route('backend.directory.new', array($dbr_directory->id, $dbr_directory->slug)) }}" class="btn btn-primary pull-right"><b>+</b> {{$name_button_add}}</a>
                </div>
                <div class="show-grid col-lg-12">

					<table class="table table-striped table-bordered table-hover dataTable no-footer">
						<thead>
							<tr>
								<th class="col-md-2">Titulo</th>
								<th class="col-md-4">Dirección</th>
								<th class="col-md-3">Telefono</th>
								<th class="col-md-2" >Estado</th>
								<th class="col-md-3" class="text-center">Acciones</th>
							</tr>
						</thead>
						<tbody>
							@foreach ($dbl_directory_publications as $dbr_directory_publication)
								<tr>
									<td>{{ $dbr_directory_publication->title}}</td>
									<td>{{ $dbr_directory_publication->address}}</td>
									<td>{{ $dbr_directory_publication->phone}}</td>
									<td>{{ Status::$statuses[$dbr_directory_publication->status] }}</td>
									<td><a href="{{ route('backend.directory.edit', array($dbr_directory_publication->directory_id, $dbr_directory->slug, $dbr_directory_publication->id)); }}" class="btn btn-success btn-xs" ><span class="glyphicon glyphicon-edit"></span></a></td>
								</tr>
							@endforeach
						</tbody>
					</table>
					{{ $dbl_directory_publications->links() }}
                </div>
            </div>
        </div>
    </div>
</div>
@stop

@section('js')
	{{ HTML::script('assets/js/sb-admin.js'); }}
@stop
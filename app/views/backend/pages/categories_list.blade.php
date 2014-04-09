@extends('backend.layouts.default')

@section('title_content')
	Categorias
@stop

@section('css')
    {{ HTML::style('assets/css/backend/jquery.treegrid.css')}}
@stop

@section('content')

<div class="col-lg-12">
    <div class="panel panel-default">
        <div class="panel-heading">
            Listado de Categorias
        </div>
        <div class="panel-body">
            <div class="row">

                <div class="col-lg-12">
                	<a href="{{ route('register_category_new') }}" class="btn btn-primary pull-right"><b>+</b> Agregar Categoria Padre</a>
                </div>
                <div class="show-grid col-lg-12">

					<table id="wrapper_list_categories" class="table tree-2 table-bordered table-striped table-condensed">
						<thead>
							<tr>
								<th class="col-md-1">ID</th>
								<th class="col-md-3">Nombre</th>
								<th class="col-md-3">Estado</th>
								<th class="col-md-2" >Type</th>
								<th class="col-md-2" >Fec. Creación</th>
								<th class="col-md-4" class="text-center">Acciones</th>
							</tr>
						</thead>
						<tbody>
							<?php $i = 1; ?>
							@foreach ($dbl_categories as $dbr_category)
								<?php $i++; ?>
								<tr class="treegrid-{{$i}} ">
									<td>{{$dbr_category->id}}</td>
									<td>{{$dbr_category->name}}</td>
									<td>{{$dbr_category->status}}</td>
									<td>{{$dbr_category->type}}</td>
									<td>{{$dbr_category->created_at}}</td>
									<td>
										<a title="Agregar Subcategoria" href="{{ route('register_parent_category_new', array($dbr_category->id)); }}" class="btn btn-success btn-xs" ><span class="glyphicon glyphicon-file"></span></a>
										<a title="Editar Categoria"  href="{{ route('register_category', array($dbr_category->id)); }}" class="btn btn-success btn-xs" ><span class="glyphicon glyphicon-edit"></span></a>

									</td>
								</tr>
								<?php $j = $i; ?>
								<?php $i++; ?>
								@foreach ($dbr_category->childrenCategories as $childrenCategory)
									<tr class="treegrid-{{$i}} treegrid-parent-{{$j}}">
										<td>{{$childrenCategory->id}}</td>
										<td>{{$childrenCategory->name}}</td>
										<td>{{$childrenCategory->status}}</td>
										<td>{{$childrenCategory->type}}</td>
										<td>{{$childrenCategory->created_at}}</td>
										<td><a href="{{ route('register_subcategory', array($dbr_category->id, $childrenCategory->id)); }}" class="btn btn-success btn-xs" ><span class="glyphicon glyphicon-edit"></span></a></td>
									</tr>
								@endforeach
							@endforeach
						</tbody>
					</table>

					{{ $dbl_categories->links() }}
                </div>
            </div>
        </div>
    </div>
</div>
@stop

@section('js')
	{{ HTML::script('assets/js/sb-admin.js'); }}
	{{ HTML::script('assets/js/treegrid/jquery.treegrid.js'); }}
	{{ HTML::script('assets/js/treegrid/jquery.treegrid.bootstrap3.js'); }}
	{{ HTML::script('assets/js/backend/list_categories.js'); }}
@stop
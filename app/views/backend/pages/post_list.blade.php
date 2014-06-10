@extends('backend.layouts.default')

@section('title_content')
	{{$title}}
@stop

@section('css')
	{{ HTML::style('assets/css/bootstrap_modal/bootstrap-modal-bs3patch.css')}}
	{{ HTML::style('assets/css/bootstrap_modal/bootstrap-modal.css')}}
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
                	<a href="{{ route('backend.register.new', array($type_post))}}" class="btn btn-primary pull-right"><b>+</b> Agregar {{$title}}</a>
                </div>
                <div class="show-grid col-lg-12">
					<table id="grid_post_list" class="table table-striped table-bordered table-hover dataTable no-footer">
						<thead>
							<tr>
								<th >Titulo</th>
								<th >Categoria</th>
								<!--<th >Tags</th>-->
								<th >Fec. Publicación</th>
								<th >Destacado</th>
								<th class="text-center col-md-2">Acciones</th>
							</tr>
						</thead>
						<tbody>
							@foreach($dbl_post as $dbr_post)
								<tr>
									<td>{{$dbr_post->title}}</td>
									<td>{{$dbr_post->category_parent_name . ' > ' . $dbr_post->category_name}}</td>
									<td>{{Helpers::getDateFormat($dbr_post->post_at)}}</td>
									<?php
										$dbr_post_featured = PostFeatured::getFeaturedActiveByPostId($dbr_post->id)->first();
										$post_featured = ($dbr_post_featured ? 'Si': 'No');
									?>
									<td>{{ $post_featured }}</td>
									<td class="text-center">
										<a href="{{ route('backend.register.edit', array(mb_strtolower($dbr_post->type),$dbr_post->id)); }}" title="Editar" class="btn btn-primary btn-xs" ><span class="glyphicon glyphicon-pencil"></span></a>
										<a href="{{ route('backend.register.featured', array($dbr_post->id) )}}" title="Destacar" class="btn btn-primary btn-xs" ><span class="glyphicon glyphicon-ok-sign"></span></a>
										<a data-id="{{$dbr_post->id}}" href="{{ route('backend.post.delete',array($dbr_post->id)) }}" title="Eliminar" class="btn btn-primary btn-xs delete"><span class="glyphicon glyphicon-trash"></span></a>
										<!--<a href="#" class="btn btn-success btn-xs" ><span class="glyphicon glyphicon-file"></span> Copiar</a>-->
									</td>
								</tr>
							@endforeach
						</tbody>
					</table>

					{{ $dbl_post->links() }}
                </div>
            </div>
        </div>
    </div>
</div>

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
	{{ HTML::script('assets/js/backend/news_list.js'); }}
@stop
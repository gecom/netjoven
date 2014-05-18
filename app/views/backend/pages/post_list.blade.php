@extends('backend.layouts.default')

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
                	<a href="{{ route('backend.register.new', array($type_post))}}" class="btn btn-primary pull-right"><b>+</b> Agregar {{$title}}</a>
                </div>
                <div class="show-grid col-lg-12">
					<table class="table table-striped table-bordered table-hover dataTable no-footer">
						<thead>
							<tr>
								<th class="col-md-3">Titulo</th>
								<th class="col-md-3" >Categoria</th>
								<th class="col-md-2">Tags</th>
								<th class="col-md-2" >Fec. Publicación</th>
								<th class="col-md-1" >Destacado</th>
								<th class="col-md-4" class="text-center">Acciones</th>
							</tr>
						</thead>
						<tbody>
							@foreach($dbl_post as $dbr_post)
								<tr>
									<td>{{$dbr_post->title}}</td>
									<td>{{$dbr_post->parent_category}}</td>
									<?php $tags = Tag::getTagByPostId($dbr_post->id)->get(); ?>
									<?php $data_tags = array(); ?>
									@if($tags)
										@foreach($tags as $tag)
											<?php $data_tags[] = $tag->tag; ?>
										@endforeach
									@endif
									<td>{{ implode( ", ",$data_tags)}}</td>
									<td>{{Helpers::getDateFormat($dbr_post->post_at)}}</td>
									<?php
										$dbr_post_featured = PostFeatured::getFeaturedActiveByPostId($dbr_post->id)->first();
										$post_featured = ($dbr_post_featured ? 'Si': 'No');
									?>
									<td>{{ $post_featured }}</td>
									<td class="text-center">
										<a href="{{ route('backend.register.edit', array(mb_strtolower($dbr_post->type),$dbr_post->id)); }}" title="Editar" class="btn btn-primary btn-xs" ><span class="glyphicon glyphicon-pencil"></span></a>
										<a href="{{ route('backend.register.featured', array($dbr_post->id) )}}" title="Destacar" class="btn btn-primary btn-xs" ><span class="glyphicon glyphicon-ok-sign"></span></a>
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
@stop

@section('js')
	{{ HTML::script('assets/js/sb-admin.js'); }}
@stop
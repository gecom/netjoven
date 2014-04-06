@extends('backend.layouts.default')

@section('title_content')
	Noticias
@stop

@section('content')

<div class="col-lg-12">
    <div class="panel panel-default">
        <div class="panel-heading">
            Listado de Noticias
        </div>
        <div class="panel-body">
            <div class="row">
                <div class="col-lg-12">
                    <form role="form">

						<div class="col-lg-4">
							<div class="form-group">
								<label>Text Input</label>
								<input class="form-control">
								<p class="help-block">Example block-level help text here.</p>
							</div>
						</div>

						<div class="col-lg-4">
							<div class="form-group">
								<label>Selects</label>
								<select class="form-control">
									<option>1</option>
									<option>2</option>
									<option>3</option>
									<option>4</option>
									<option>5</option>
								</select>
							</div>
						</div>
						<div class="col-lg-4">
							<div class="form-group">
								<label>Selects</label>
								<select class="form-control">
									<option>1</option>
									<option>2</option>
									<option>3</option>
									<option>4</option>
									<option>5</option>
								</select>
							</div>
						</div>
						<div class="col-lg-12">
							<button type="submit" class="btn btn-default">Buscar</button>
							<button type="reset" class="btn btn-default">Reset</button>
						</div>

                    </form>
                </div>

                <div class="col-lg-12">
                	<a href="#" class="btn btn-primary pull-right"><b>+</b> Agregar Nueva Noticia</a>
                </div>
                <div class="show-grid col-lg-12">                	
					<table class="table table-striped table-bordered table-hover dataTable no-footer">
						<thead>  							
							<tr>
								<th class="col-md-3">Titulo</th>
								<th class="col-md-3" >Categoria</th>
								<th class="col-md-3">Tags</th>
								<th class="col-md-2" >Fec. Creación</th>
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
									<td>{{$dbr_post->post_at}}</td>
									<td class="text-center">
										<a href="{{  route('regiter_post_edit', array('news_id'=> $dbr_post->id)); }}" class="btn btn-primary btn-xs" ><span class="glyphicon glyphicon-file"></span> Editar</a>
										<a href="#" class="btn btn-success btn-xs" ><span class="glyphicon glyphicon-pencil"></span> Destacar</a>
										<a href="#" class="btn btn-success btn-xs" ><span class="glyphicon glyphicon-pencil"></span> Copiar</a>
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
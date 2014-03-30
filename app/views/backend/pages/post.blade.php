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
                <div class="show-grid col-lg-12">
                	
					<table class="table table-striped table-bordered table-hover dataTable no-footer">
						<thead>
							<tr>
								<th>Titulo</th>
								<th>Categoria</th>
								<th>Tags</th>
								<th>Estado</th>
								<th>Fec. Creación</th>
								<th>Accciones</th>
							</tr>
						</thead>
						<tbody>
							@foreach($dbl_post as $dbr_post)
								<tr>
									<td>{{$dbr_post->title}}</td>
									<td>{{$dbr_post->parent_category}}</td>
									<td>{{$dbr_post->status}}</td>
									<td>{{$dbr_post->title}}</td>
									<td>{{$dbr_post->title}}</td>
									<td>
										<a href="#" class="btn btn-primary btn-xs active" ><span class="glyphicon glyphicon-file"></span> Editar</a>
										<a href="#" class="btn btn-success btn-xs active" ><span class="glyphicon glyphicon-pencil"></span> Copiar</a>
									</td>
								</tr>

							@endforeach
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
@extends('backend.layouts.default')

@section('title_content')
	Noticias
@stop

@section('content')


<div class="panel panel-default">
    <div class="panel-heading">
        Editar Noticia
    </div>
    <div class="panel-body">
        <div class="row">
            <div class="col-lg-7">
                <form>
                    <div class="form-group">
                        <label>Titulo</label>
                        <input name="" class="form-control">
                    </div>

                    <div class="row">
                        <div class="col-lg-6">
                            <div class="form-group ">
                                <label for="estact">Categoría:</label>
                                <select class="form-control" >
                                    <option>seleccione</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-6 pull-right">
                            <div class="form-group">
                                <label for="codmat">Subcategoria</label>
                                <select class="form-control" >
                                    <option>seleccione</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@stop

@section('js')
	{{ HTML::script('assets/js/sb-admin.js'); }}
@stop
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
                <form method="post" action="{{ ($is_new == true ? route('save_news_create') : route('save_news_edit', array('news_id'=> $dbr_post->id))) }}"  autocomplete="off">
                    {{ Form::hidden('frm_news[is_new]', ($is_new ? 1 : 0) , array('id' => 'frm_is_new')) }}
                    <div class="form-group">
                        {{ Form::label('frm_news_title', 'Titulo') }}
                        {{ Form::text('frm_news[title]', ($is_new ? null: $dbr_post->title ), array('id' => 'frm_news_title', 'placeholder' => 'Ingrese un titulo', 'class' => 'form-control')) }}
                    </div>
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="form-group ">
                                {{ Form::label('frm_news_category', 'Categoría') }}
                                <select name="frm_news[category]" id="frm_news_category" class="form-control">
                                    <option value="">Selecciona Categoria</option>
                                    @foreach($parent_categories as $parent_category)
                                    <?php $selected = (!$is_new && ($parent_category->id == $dbr_post->parent_category_id)  ? 'selected="selected"': '' ); ?>
                                        <option value="{{$parent_category->id}}" {{ $selected}}>{{$parent_category->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-6 pull-right">
                            <div class="form-group">
                                {{ Form::label('frm_news_subcategory', 'Sub Categoría') }}
                                <select name="frm_news[subcategory]" id="frm_news_subcategory" class="form-control">
                                    <option value="">Selecciona Subcategoría</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        {{ Form::label('frm_news_keywords', 'Etiqueta') }}                                      
                        {{ Form::text('frm_news[keywords]', null, array('id' => 'frm_news_keywords', 'placeholder' => 'Ingrese una etiqueta', 'class' => 'form-control')) }}
                    </div>
                    <div class="row">
                        <div class="col-lg-6">
                            <label>Opciones</label>
                            <div class="checkbox">
                            <label>
                                {{ Form::checkbox('frm_news[twitter]', 'si', ($is_new ? false : ($dbr_post->twitter == 'si' ? true : false))) }} Twitter
                            </label>
                            </div>
                            <div class="checkbox">
                            <label>
                                {{ Form::checkbox('frm_news[america]', 'si', ($is_new ? false : ($dbr_post->america == 'si' ? true : false))) }} America
                            </label>
                            </div>
                            <div class="checkbox">
                            <label>
                                {{ Form::checkbox('frm_news[frecuencia]', 'si', ($is_new ? false : ($dbr_post->frecuencia == 'si' ? true : false))) }} Frecuencia Latina
                            </label>
                            </div>
                        </div>
                        <div class="col-lg-6 pull-right">
                            <label>Destacar en: </label>
                            <div class="checkbox">
                                <label>
                                    {{ Form::checkbox('frm_news[super_featured]', 'si') }} Super Destacado
                                </label>
                            </div>
                            <div class="checkbox">
                                <label>
                                    {{ Form::checkbox('frm_news[featured_principal]', 'si') }} Principal
                                </label>
                            </div>
                            <div class="checkbox">
                                <label>
                                    {{ Form::checkbox('frm_news[featured_parent_category]', 'si') }} Categoría Padre
                                </label>
                            </div>
                            <div class="checkbox">
                                <label>
                                    {{ Form::checkbox('frm_news[featured_children_category]', 'si') }} SubCategoría
                                </label>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        {{ Form::label('frm_news_summary', 'Resumen') }} 
                        {{ Form::textarea('frm_news[summary]', ($is_new ? null: $dbr_post->summary ), array('id' => 'frm_news_summary', 'placeholder' => 'Ingrese un Resumen', 'class' => 'form-control')) }}
                    </div>
                    <div class="form-group">
                        {{ Form::label('frm_news_description', 'Descripción') }} 
                        {{ Form::textarea('frm_news[description]', ($is_new ? null: $dbr_post->content ), array('id' => 'frm_news_description', 'placeholder' => 'Ingrese Descripción', 'class' => 'form-control')) }}
                    </div>
                    <button type="submit" class="btn btn-info">Guardar</button>
                    <button type="reset" class="btn btn-default">Cancelar</button>
                </form>
            </div>
        </div>
    </div>
</div>
@stop

@section('js')
    {{ HTML::script('assets/js/tiny_mce/jquery.tinymce.js'); }}
	{{ HTML::script('assets/js/sb-admin.js'); }}
    {{ HTML::script('assets/js/backend/news.js'); }}
@stop
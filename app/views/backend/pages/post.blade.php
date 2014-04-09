@extends('backend.layouts.default')

@section('css')

    {{ HTML::style('assets/css/backend/jquery.fileupload.css')}}
    {{ HTML::style('assets/css/backend/imgareaselect-default.css')}}
@stop

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

                <form enctype="multipart/form-data" accept-charset="UTF-8" method="post" action="{{ ($is_new == true ? route('save_news_create') : route('save_news_edit', array('news_id'=> $dbr_post->id))) }}"  autocomplete="off">
                <div class="col-lg-7">
                    {{ Form::hidden('frm_news[is_new]', ($is_new ? 1 : 0) , array('id' => 'frm_is_new')) }}
                    {{ Form::hidden('frm_news[image_principal]', null, array('id' => 'frm_news_image_principal')) }}
                    {{ Form::hidden('frm_news[gallery]', null , array('id' => 'frm_news_gallery')) }}
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
                                    @foreach($dbl_parent_categories as $parent_category)
                                    <?php $selected = (!$is_new && ($parent_category->id == $dbr_post_category->parent_id)  ? 'selected="selected"': '' ); ?>
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
                                    @if($is_new == 0)
                                        @foreach($dbl_categories as $dbr_category)
                                            <?php $selected = (!$is_new && ($dbr_category->id == $dbr_post_category->id)  ? 'selected="selected"': '' ); ?>
                                            <option value="{{$dbr_category->id}}" {{ $selected}}>{{$dbr_category->name}}</option>
                                        @endforeach
                                    @endif
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
                    </div>
                    <div class="form-group">
                        {{ Form::label('frm_news_summary', 'Resumen') }} 
                        {{ Form::textarea('frm_news[summary]', ($is_new ? null: $dbr_post->summary ), array('id' => 'frm_news_summary', 'placeholder' => 'Ingrese un Resumen', 'class' => 'form-control')) }}
                    </div>
                    <div class="form-group">
                        {{ Form::label('frm_news_description', 'Descripción') }} 
                        {{ Form::textarea('frm_news[description]', ($is_new ? null: $dbr_post->content ), array('id' => 'frm_news_description', 'placeholder' => 'Ingrese Descripción', 'class' => 'form-control')) }}
                    </div>                 

                    <div class="form-group">
                        <span class="btn btn-success fileinput-button">
                            <i class="glyphicon glyphicon-plus"></i>
                            <span>Subir Imagen Principal</span>
                            <input id="fileupload_principal" type="file" name="file_image">
                        </span>                        
                    </div>
                    <div class="row">
                        <div class="col-md-12" id="preview_image_principal">
                            <ul class="thumbnails list-unstyled">
                                @if ($is_new == 0)
                                    @foreach ($dbl_galleries as $dbr_gallery)
                                        @if ($dbr_gallery->is_principal == 1)
                                            <li class="col-md-12">
                                                <div class="thumbnail" style="padding: 0">
                                                    <div style="padding:4px" class="text-center">
                                                        <img  src="{{ Config::get('settings.urlupload') . 'noticias/'. $dbr_gallery->image}}">
                                                    </div>
                                                    <div class="modal-footer" style="text-align: left; display: none">
                                                        <button type="button" class="btn btn-danger">Cortar Imagen</button>
                                                    </div>
                                                </div>
                                            </li> 
                                        @endif
                                    @endforeach
                                @endif

                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-lg-12">
                    <div class="form-group">
                        <span class="btn btn-success fileinput-button">
                            <i class="glyphicon glyphicon-plus"></i>
                            <span>Subir Galeria</span>
                            <input id="fileupload_gallery" type="file" name="file_image" multiple />
                        </span>
                    </div>

                    <div class="row">                        
                        <div class="col-lg-12" id="wrapper_gallery">
                            <ul class="thumbnails list-unstyled">
                                @if ($is_new == 0)
                                    @foreach ($dbl_galleries as $dbr_gallery)
                                        @if ($dbr_gallery->is_gallery == 1)
                                            <li class="col-md-3">
                                                <div class="thumbnail" style="padding: 0">
                                                    <div style="padding:4px" class="text-center">
                                                        <img  src="{{ Config::get('settings.urlupload') . 'gallery/pp/'. $dbr_gallery->image}}">
                                                    </div>
                                                    <div class="caption">
                                                        <textarea placeholder="Ingrese Titulo" class="form-control" cols="10" rows="5">{{$dbr_gallery->title}}</textarea>
                                                    </div>
                                                </div>
                                            </li> 
                                        @endif
                                    @endforeach
                                @endif
                            </ul>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-info">Guardar</button>
                    <button type="reset" class="btn btn-danger">Cancelar</button>
                </div>
                </form>
        </div>
    </div>
</div>
@stop

<script type="text/html" id='images-data'>
    
        <li class="col-md-<%= item.is_principal == true ?  12 : 3 %>">
            <div class="thumbnail" style="padding: 0">
                <div style="padding:4px" class="text-center">
                    <img  src="<%= item.is_principal == true ? item.image.filename : item.image.filename_thumb %>">
                </div>
                <% if(item.is_gallery == true){ %>
                    <div class="caption">
                        <textarea placeholder="Ingrese Titulo" class="form-control" cols="10" rows="5"></textarea>
                    </div>
                <% } %>
                <% if(item.is_principal == true){ %>
                    <div class="modal-footer" style="text-align: left">
                        <button type="button" class="btn btn-danger">Cortar Imagen</button>
                    </div>
                <% } %>
            </div>
        </li>        
</script>

@section('js')
    {{ HTML::script('assets/js/tiny_mce/jquery.tinymce.js'); }}
	{{ HTML::script('assets/js/sb-admin.js'); }}
    {{ HTML::script('assets/js/jquery_file_upload/jquery.ui.widget.js'); }}
    {{ HTML::script('assets/js/jquery_file_upload/jquery.iframe-transport.js'); }}
    {{ HTML::script('assets/js/jquery_file_upload/jquery.fileupload.js'); }}
    {{ HTML::script('assets/js/jquery_file_upload/jquery.fileupload-process.js'); }}
    {{ HTML::script('assets/js/jquery_file_upload/jquery.fileupload-validate.js'); }}
    {{ HTML::script('assets/js/img_area_select/jquery.imgareaselect.js'); }}
    {{ HTML::script('assets/js/underscore.js'); }}    
    {{ HTML::script('assets/js/backend/news.js'); }}
@stop
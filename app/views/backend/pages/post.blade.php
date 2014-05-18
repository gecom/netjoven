@extends('backend.layouts.default')

@section('css')
    {{ HTML::style('assets/css/backend/jquery.fileupload.css')}}
    {{ HTML::style('assets/css/backend/imgareaselect-default.css')}}
    {{ HTML::style('assets/css/plugins/tagsinput/bootstrap-tagsinput.css')}}
    {{ HTML::style('assets/css/plugins/tagsinput/typeahead.css')}}
    {{ HTML::style('assets/css/backend/datetimepicker.css')}}
@stop

@section('title_content')
	Noticias
@stop

@section('content')

<div class="panel panel-default">
    <div class="panel-heading">
    Editar {{ strtoupper($type_post) }}
    </div>
    <div class="panel-body">
        <div class="row">
             <div class="col-lg-12">
                <ul id="myTab" class="nav nav-tabs">
                    <li id="body_tabHeaderPost" class="active"><a id="body_lnkHeaderPost" href="#register_publication" data-toggle="tab">Registrar</a></li>
                    <li id="body_tabHeaderImages" class="{{($is_new ? 'disabled' : '')}}"><a id="body_lnkHeaderImages" href="#register_publication_gallery" data-toggle="tab">Registrar Galeria</a></li>
                </ul>
                <?php

                    if($is_new == true){
                        $url_post = route('backend.register.save.new', array(strtolower($type_post)));
                    }else{
                        $url_post = route('backend.register.save.edit', array(strtolower($type_post), $dbr_post->id));
                    }
                ?>
                <!-- Tab panes -->
                <div class="tab-content" style="padding-top: 20px;">
                    <div class="tab-pane active" id="register_publication">
                        <form id="frm_news_register" enctype="multipart/form-data" accept-charset="UTF-8" method="post" action="{{ $url_post }}"  autocomplete="off">
                            <div class="col-lg-8">
                                {{ Form::hidden('frm_news[is_new]', ($is_new ? 1 : 0) , array('id' => 'frm_is_new')) }}
                                {{ Form::hidden('frm_news[image_principal]', null, array('id' => 'frm_news_image_principal')) }}
                                <div class="form-group">
                                    {{ Form::label('frm_news_title', 'Titulo') }}
                                    {{ Form::text('frm_news[title]', ($is_new ? null: $dbr_post->title ), array('id' => 'frm_news_title', 'placeholder' => 'Ingrese un titulo', 'class' => 'form-control')) }}
                                </div>
                                @if ($dbr_category)
                                    {{ Form::hidden('frm_news[subcategory]', $dbr_category->id, array('id' => 'frm_news_subcategory')) }}
                                @else
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
                                @endif

                                @if ($type_post == Helpers::TYPE_POST_VIDEO)
                                    <div id="wrapper_video" class="row">
                                        <div class="col-lg-6">
                                            <div class="form-group ">
                                                {{ Form::label('frm_news_type_video', 'Tipo Video') }}
                                                <select name="frm_news[type_video]" id="frm_news_type_video" class="form-control">
                                                    <option value="">Selecciona Tipo Video</option>
                                                    @foreach($data_type_video as $key_video => $type_video)
                                                        <?php $selected = (!$is_new && ($dbr_post->type_video == $key_video)  ? 'selected="selected"': '' ); ?>
                                                        <option value="{{$key_video}}" {{ $selected}}>{{$type_video}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-lg-6 pull-right">
                                            {{ Form::label('frm_news_id_video', 'ID Video') }}
                                            {{ Form::text('frm_news[id_video]', ($is_new ? null: $dbr_post->id_video), array('id' => 'frm_news_id_video', 'placeholder' => 'Ingrese codigo video', 'class' => 'form-control')) }}
                                        </div>
                                    </div>
                                @endif
                                <div class="form-group">
                                    {{ Form::label('frm_news_keywords', 'Etiqueta') }}
                                    {{ Form::text('frm_news[keywords]', ($is_new ? null : $tags), array('id' => 'frm_news_keywords', 'placeholder' => 'Ingrese una etiqueta', 'class' => 'form-control')) }}
                                </div>
                                <div class="form-group">
                                    <label>Opciones</label>
                                </div>
                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="checkbox">
                                        <label>
                                            {{ Form::checkbox('frm_news[twitter]', '1', ($is_new ? false : ($dbr_post->twitter == '1' ? true : false))) }} Twitter
                                        </label>
                                        </div>
                                        <div class="checkbox">
                                        <label>
                                            {{ Form::checkbox('frm_news[america]', '1', ($is_new ? false : ($dbr_post->america == '1' ? true : false))) }} America
                                        </label>
                                        </div>
                                        <div class="checkbox">
                                        <label>
                                            {{ Form::checkbox('frm_news[frecuencia]', '1', ($is_new ? false : ($dbr_post->frecuencia == '1' ? true : false))) }} Frecuencia Latina
                                        </label>
                                        </div>
                                    </div>
                                    <div class="col-lg-6 pull-right">
                                        <div class="checkbox">
                                            <label>
                                                {{ Form::checkbox('frm_news[view_index]', '1', ($is_new ? false : ($dbr_post->view_index == '1' ? true : false))) }} Home
                                            </label>
                                        </div>
                                        <div class="checkbox">
                                            <label>
                                                {{ Form::checkbox('frm_news[display]', '1', ($is_new ? false : ($dbr_post->display == '1' ? true : false))) }} Mostrar
                                            </label>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    {{ Form::label('frm_news_summary', 'Resumen') }}
                                    {{ Form::textarea('frm_news[summary]', ($is_new ? null: $dbr_post->summary ), array('id' => 'frm_news_summary', 'placeholder' => 'Ingrese un Resumen', 'class' => 'form-control')) }}
                                </div>

                                @if ( $type_post != Helpers::TYPE_POST_FAIL)
                                    <div class="form-group">
                                        {{ Form::label('frm_news_description', 'Descripción') }}
                                        {{ Form::textarea('frm_news[description]', ($is_new ? null: $dbr_post->content ), array('id' => 'frm_news_description', 'placeholder' => 'Ingrese Descripción', 'class' => 'form-control')) }}
                                    </div>
                                @endif
                                <div class="form-group">
                                    {{ Form::label('frm_news_post_at', 'Fecha de Publicación') }}
                                    <div class='input-group date' id='datetimepicker_post_at'>
                                        {{ Form::text('frm_news[post_at]', ($is_new ? Date('d/m/Y H:i') :  Helpers::getDateFormat($dbr_post->post_at)), array('id' => 'frm_news_post_at', 'readonly' => 'readonly', 'placeholder' => 'Ingrese Fecha de Publicación', 'class' => 'form-control')) }}
                                        <span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></span>
                                    </div>
                                </div>
                                @if (in_array($type_post, array(Helpers::TYPE_POST_NEWS, Helpers::TYPE_POST_FAIL)))
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
                                @endif

                                <button type="submit" class="btn btn-info">Guardar</button>
                                <button type="reset" class="btn btn-danger">Cancelar</button>
                            </div>
                        </form>

                    </div>
                    <div class="tab-pane" id="register_publication_gallery">
                        @if(!$is_new)
                        <form id="frm_directory_publication_gallery" action="{{route('backend.register.save.gallery', array($dbr_post->id))}}" enctype="multipart/form-data" accept-charset="UTF-8" method="post"  autocomplete="off">
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
                                                                    <textarea placeholder="Ingrese Titulo" class="form-control" name="frm_news_gallery[title][]" cols="10" rows="5">{{$dbr_gallery->title}}</textarea>
                                                                    <input type="hidden" value="{{$dbr_gallery->image}}" name="frm_news_gallery[name][]" />
                                                                </div>
                                                            </div>
                                                        </li>
                                                    @endif
                                                @endforeach
                                            @endif
                                        </ul>
                                    </div>
                                </div>
                                <button type="submit" class="btn btn-info">Guardar Galeria</button>
                            </div>
                        </form>
                        @endif
                    </div>
                </div>
             </div>
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
                        <textarea placeholder="Ingrese Titulo" name="frm_news_gallery[title][]" class="form-control" cols="10" rows="5"></textarea>
                        <input type="hidden" value="<%= item.image.name %>"  name="frm_news_gallery[name][]" />
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

    {{ HTML::script('assets/js/tinymce/tinymce.min.js'); }}
	{{ HTML::script('assets/js/sb-admin.js'); }}
    {{ HTML::script('http://code.jquery.com/ui/1.10.3/jquery-ui.js'); }}
    {{ HTML::script('assets/js/jquery_file_upload/jquery.iframe-transport.js'); }}
    {{ HTML::script('assets/js/jquery_file_upload/jquery.fileupload.js'); }}
    {{ HTML::script('assets/js/jquery_file_upload/jquery.fileupload-process.js'); }}
    {{ HTML::script('assets/js/jquery_file_upload/jquery.fileupload-validate.js'); }}
    {{ HTML::script('assets/js/img_area_select/jquery.imgareaselect.js'); }}
    {{ HTML::script('assets/js/underscore.js'); }}
    {{ HTML::script('assets/js/datetimepicker/moment.js'); }}
    {{ HTML::script('assets/js/datetimepicker/datetimepicker.es.js'); }}
    {{ HTML::script('assets/js/datetimepicker/datetimepicker.js'); }}
    {{ HTML::script('assets/js/typeahead/typeahead.js'); }}
    {{ HTML::script('assets/js/tagsinput/bootstrap-tagsinput.js'); }}
    {{ HTML::script('assets/js/bootstrap-disabled-tabclick.js'); }}
    {{ HTML::script('assets/js/backend/main_news.js'); }}
    @if ( $type_post == Helpers::TYPE_POST_FAIL)
        {{ HTML::script('assets/js/backend/news_fail_redes.js'); }}
    @else
        {{ HTML::script('assets/js/backend/news.js'); }}
    @endif


@stop
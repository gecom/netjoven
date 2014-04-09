@extends('backend.layouts.default')

@section('title_content')
	Categorias
@stop

@section('css')
    {{ HTML::style('assets/css/backend/jquery.fileupload.css')}}
@stop

@section('content')

<div class="col-lg-12">
    <div class="panel panel-default">
        <div class="panel-heading">
            {{$title}}
        </div>
        <div class="panel-body">
            <div class="row">

                <?php
                $data_form = array();

                if(isset($dbr_category)){
                    if(!$dbr_category->parent_id){
                        $data_form = array($dbr_category->id);
                    }else{
                        $data_form = array($dbr_category->parent_id, $dbr_category->id);
                    }
                }

                $url_action = null;
                if($is_new == true){
                    if(isset($dbr_category)){
                        $url_action = route('save_parent_category_new',array($dbr_category->id));
                    }else{
                        $url_action = route('save_category_new');
                    }


                }else{
                    if(empty($dbr_category->parent_id)){
                        $url_action = route('save_category_parent', $data_form);
                    }else{
                       $url_action = route('save_category',$data_form);
                    }
                }

                ?>

                <form id="frm_category" enctype="multipart/form-data" accept-charset="UTF-8" method="post" action="{{ $url_action }}"  autocomplete="off">
                    {{ Form::hidden('frm_category[is_new]', ($is_new ? 1 : 0) , array('id' => 'frm_category_is_new')) }}
                    @if ($is_new == 1 || (!is_null($dbr_category->parent_id) &&  $is_new == 0))
                        {{ Form::hidden('frm_category[image]', null , array('id' => 'frm_category_image')) }}
                    @endif
                    <div class="col-lg-7">
                        <div class="form-group">
                            {{ Form::label('frm_category_name', 'Titulo') }}
                            {{ Form::text('frm_category[name]', (!empty($dbr_category) && $is_new == 0 ? $dbr_category->name: null ), array('id' => 'frm_category_name', 'placeholder' => 'Ingrese un titulo', 'class' => 'form-control')) }}
                        </div>
                        <div class="form-group">
                            <div class="checkbox">
                                <label>
                                {{ Form::checkbox('frm_category[is_menu]', '1', (!empty($dbr_category) && $is_new == 0 ? ($dbr_category->is_menu == 1 ? true : false) : false )) }} Mostrar en Menu Principal
                                </label>
                            </div>
                        </div>
                        <div class="form-group">
                            {{ Form::label('frm_category_description', 'Descripcíon') }}
                            {{ Form::textarea('frm_category[description]', (!empty($dbr_category) && $is_new == 0  ? $dbr_category->description: null ), array('id' => 'frm_category_description', 'placeholder' => 'Ingrese la descripcíon', 'class' => 'form-control')) }}
                        </div>
                        @if($is_new == 1 || ($is_new == 0 && isset($type_category)))
                            <div class="form-group">
                                {{ Form::label('frm_category_type', 'Tipo Categoría') }}
                                <select name="frm_category[type]" id="frm_category_type" class="form-control">
                                    <option value="">Selecciona Tipo</option>
                                    @foreach($type_category as $type)
                                    <?php $selected = (!$is_new && ($type == $dbr_category->type)  ? 'selected="selected"': '' ); ?>
                                    <option value="{{$type}}" {{ $selected}}>{{$type}}</option>
                                    @endforeach
                                </select>
                            </div>
                        @endif

                        @if (($is_new == 1 && isset($dbr_category)) || ($is_new == 0 && !is_null($dbr_category->parent_id)))
                            <div class="form-group">
                                <span class="btn btn-success fileinput-button">
                                <i class="glyphicon glyphicon-plus"></i>
                                <span>Subir Imagen</span>
                                <input id="file_image" type="file" name="file_image" />
                                </span>
                            </div>
                        @endif
                        <div class="row">
                            <div class="col-md-12" id="preview_image_principal" style="{{ $dbr_category->image ? '' : 'display:none' }}">
                                <ul class="thumbnails list-unstyled">
                                            <li class="col-md-12">
                                                <div class="thumbnail" style="padding: 0">
                                                    <div style="padding:4px" class="text-center">
                                                        @if($dbr_category->image)
                                                            @if ($is_new == 0 &&  !is_null($dbr_category->parent_id) )
                                                                <?php
                                                                    $filename = $dbr_category->image;
                                                                    $pos = strpos($filename, '.');
                                                                    $data_size = Helpers::$size_images['category_others'];
                                                                    $filename = substr($filename, 0, $pos).'_'. implode('x', $data_size).Helpers::$extension;
                                                                ?>
                                                                <img  src="{{Helpers::getImage($filename, 'category')}}" />
                                                            @endif
                                                        @endif
                                                    </div>
                                                </div>
                                            </li>


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
</div>
@stop


<script type="text/html" id='images-data'>

        <li class="col-md-12">
            <div class="thumbnail" style="padding: 0">
                <div style="padding:4px" class="text-center">

                </div>
            </div>
        </li>
</script>

@section('js')
	{{ HTML::script('assets/js/sb-admin.js'); }}
    {{ HTML::script('assets/js/jquery_file_upload/jquery.ui.widget.js'); }}
    {{ HTML::script('assets/js/jquery_file_upload/jquery.iframe-transport.js'); }}
    {{ HTML::script('assets/js/jquery_file_upload/jquery.fileupload.js'); }}
    {{ HTML::script('assets/js/jquery_file_upload/jquery.fileupload-process.js'); }}
    {{ HTML::script('assets/js/jquery_file_upload/jquery.fileupload-validate.js'); }}
    {{ HTML::script('assets/js/underscore.js'); }}
    {{ HTML::script('assets/js/backend/category.js'); }}
@stop
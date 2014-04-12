@extends('backend.layouts.default')

@section('title_content')
	Directorio
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

            <div class="col-lg-12">
                <ul class="nav nav-tabs" id="myTab">
                    <li id="body_tabHeaderDirectory" class="active"><a id="body_lnkHeaderDirectory" href="#register_directory" data-toggle="tab">Registrar</a></li>
                    <li id="body_tabHeaderImages" class="{{($is_new ? 'disabled' : '')}}"><a id="body_lnkHeaderImages" href="#register_images" data-toggle="tab">Imagenes</a></li>
                </ul>
                <div class="tab-content" style="padding-top: 20px;">
                    <div class="tab-pane active" id="register_directory">
                        <div class="container">

                            <?php
                                $params_form = array();
                                $url_action = null;

                                if(!$is_new){
                                    $params_form = array($dbr_directory->id, $dbr_directory->slug, $dbl_directory_publication->id);
                                    $url_action = route('backend.directory.save_edit',$params_form);
                                }else{
                                    $params_form = array($dbr_directory->id, $dbr_directory->slug);
                                    $url_action = route('backend.directory.save_new',$params_form);
                                }

                            ?>

                            <form id="frm_directory_publication" method="post" action="{{$url_action}}"  autocomplete="off">
                                <div class="col-lg-7">
                                    {{ Form::hidden('frm_directory[is_new]', ($is_new ? 1 : 0) , array('id' => 'frm_directory_is_new')) }}
                                    {{ Form::hidden('frm_directory[latitude]', (!$is_new ? $dbl_directory_publication->latitude: null ) , array('id' => 'frm_diretory_latitude')) }}
                                    {{ Form::hidden('frm_directory[longitude]', (!$is_new ? $dbl_directory_publication->longitude: null ) , array('id' => 'frm_diretory_longitude')) }}
                                    <div class="form-group">
                                        {{ Form::label('frm_directory_title', 'Titulo') }}
                                        {{ Form::text('frm_directory[title]', (!$is_new ? $dbl_directory_publication->title: null ), array('id' => 'frm_directory_title', 'placeholder' => 'Ingrese un titulo', 'class' => 'form-control')) }}
                                    </div>
                                    @if($dbr_directory->id == 2)
                                        <div class="form-group">
                                            {{ Form::label('frm_directory_type', 'Tipo') }}
                                            <select name="frm_directory[type]" id="frm_directory_type" class="form-control">
                                                <option value="">Selecciona Tipo</option>
                                                @foreach($type_binge as $type)
                                                    <?php $selected = (!$is_new && ($type == $dbl_directory_publication->type)  ? 'selected="selected"': '' ); ?>
                                                    <option value="{{$type}}" {{ $selected}}>{{$type}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    @endif
                                    <div class="form-group">
                                        {{ Form::label('frm_directory_address', 'Dirección') }}
                                        {{ Form::text('frm_directory[address]', (!$is_new ? $dbl_directory_publication->address: null ), array('id' => 'frm_directory_address', 'placeholder' => 'Ingrese Dirección', 'class' => 'form-control')) }}
                                    </div>

                                    <div class="form-group">
                                        {{ Form::label('frm_directory_district', 'Distrito') }}
                                        <select name="frm_directory[district]" id="frm_directory_district" class="form-control">
                                            <option value="">Selecciona Distrito</option>
                                            @foreach($dbl_district as $dbr_district)
                                                <?php $selected = (!$is_new && ($dbr_district->id == $dbl_directory_publication->id_district)  ? 'selected="selected"': '' ); ?>
                                                <option value="{{$dbr_district->id}}" {{ $selected}}>{{$dbr_district->district}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        {{ Form::label('frm_directory_web', 'Web') }}
                                        {{ Form::text('frm_directory[web]', (!$is_new ? $dbl_directory_publication->web: null ), array('id' => 'frm_directory_web', 'placeholder' => 'Ingrese web', 'class' => 'form-control')) }}
                                    </div>
                                    <div class="form-group">
                                        {{ Form::label('frm_directory_phone', 'Telefono') }}
                                        {{ Form::text('frm_directory[phone]', (!$is_new ? $dbl_directory_publication->phone: null ), array('id' => 'frm_directory_phone', 'placeholder' => 'Ingrese Telefono', 'class' => 'form-control')) }}
                                    </div>
                                    <div class="form-group">
                                        {{ Form::label('frm_directory_observation', 'Descripcíon') }}
                                        {{ Form::textarea('frm_directory[observation]', (!$is_new ? $dbl_directory_publication->observation: null ), array('id' => 'frm_directory_observacion', 'placeholder' => 'Ingrese Observacion', 'class' => 'form-control')) }}
                                    </div>

                                    @if(!$is_new && $dbl_directory_publication->latitude && $dbl_directory_publication->longitude)
                                        <div class="form-group"><button id="clear_map" type="button" class="btn btn-info">Cambiar Dirección</button></div>
                                    @endif
                                    <div class="row">
                                        <ul class="thumbnails list-unstyled" >
                                            <li class="col-md-12">
                                                <div class="thumbnail" style="padding: 0">
                                                    <div id="preview_map" style="padding:4px;height: 500px" class="text-center"></div>
                                                </div>
                                            </li>
                                        </ul>
                                    </div>
                                    <button type="submit" class="btn btn-info">Guardar</button>
                                </div>
                            </form>

                        </div>
                    </div>
                    <div class="tab-pane" id="register_images">
                        @if(!$is_new)
                            <form id="frm_directory_publication_image" action="{{route('backend.directory.save_images', array($dbr_directory->id, $dbr_directory->slug, $dbl_directory_publication->id))}}" enctype="multipart/form-data" accept-charset="UTF-8" method="post"  autocomplete="off">
                                <div class="col-lg-8">
                                    {{ Form::hidden('frm_directory[image_principal]', null, array('id' => 'frm_directory_image_principal')) }}
                                    {{ Form::hidden('frm_directory[image_internal]', null, array('id' => 'frm_directory_image_internal')) }}

                                    <div class="form-group">
                                        <span class="btn btn-success fileinput-button">
                                        <i class="glyphicon glyphicon-plus"></i>
                                        <span>Subir Imagen Principal</span>
                                        <input id="file_image_principal" type="file" name="file_image" />
                                        </span>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-7" id="wrapper_image_principal" >
                                            <ul class="thumbnails list-unstyled">
                                                @if($dbl_directory_publication->image)
                                                    <li class="col-md-12">
                                                        <div class="thumbnail" style="padding: 0">
                                                            <div style="padding:4px" class="text-center">
                                                                <img  src="{{Helpers::getImage($dbl_directory_publication->image, 'agenda')}}">
                                                            </div>
                                                        </div>
                                                    </li>
                                                @endif
                                            </ul>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <span class="btn btn-success fileinput-button">
                                        <i class="glyphicon glyphicon-plus"></i>
                                        <span>Subir Imagen Interna</span>
                                        <input id="file_image_internal" type="file" name="file_image" />
                                        </span>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-12" id="wrapper_image_internal" >
                                            <ul class="thumbnails list-unstyled">
                                                @if($dbl_directory_publication->banner)
                                                    <li class="col-md-12">
                                                        <div class="thumbnail" style="padding: 0">
                                                            <div style="padding:4px" class="text-center">
                                                                <img  src="{{Helpers::getImage($dbl_directory_publication->banner, 'agenda')}}">
                                                            </div>
                                                        </div>
                                                    </li>
                                                @endif
                                            </ul>
                                        </div>
                                    </div>

                                    <button type="submit" class="btn btn-info">Guardar Imagenes</button>

                                </div>
                            </form>
                        @endif
                    </div>
                </div>
            </div>
            </div>
        </div>
    </div>
</div>
@stop

<script type="text/html" id='images-data'>
    <li class="col-md-12">
        <div class="thumbnail" style="padding: 0">
            <div style="padding:4px" class="text-center">
                <img  src="<%= item.image.filename %>">
            </div>
        </div>
    </li>
</script>

@section('js')
	{{ HTML::script('assets/js/sb-admin.js'); }}
    {{ HTML::script('http://maps.googleapis.com/maps/api/js?sensor=false'); }}
    {{ HTML::script('assets/js/jquery_file_upload/jquery.ui.widget.js'); }}
    {{ HTML::script('assets/js/jquery_file_upload/jquery.iframe-transport.js'); }}
    {{ HTML::script('assets/js/jquery_file_upload/jquery.fileupload.js'); }}
    {{ HTML::script('assets/js/jquery_file_upload/jquery.fileupload-process.js'); }}
    {{ HTML::script('assets/js/jquery_file_upload/jquery.fileupload-validate.js'); }}
    {{ HTML::script('assets/js/gmap3.js'); }}
    {{ HTML::script('assets/js/underscore.js'); }}
    {{ HTML::script('assets/js/bootstrap-disabled-tabclick.js'); }}
    {{ HTML::script('assets/js/backend/directory_register.js'); }}

@stop
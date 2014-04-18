@extends('backend.layouts.default')

@section('css')
    {{ HTML::style('assets/css/backend/jquery.fileupload.css')}}
    {{ HTML::style('assets/css/backend/datetimepicker.css')}}
@stop

@section('title_content')
	Registrar Destacado
@stop

@section('content')

<div class="panel panel-default">
    <div class="panel-heading">{{$title_content}}</div>
    <div class="panel-body">
        <div class="row">
             <div class="col-lg-12">
                <form id="frm_post_featured" enctype="multipart/form-data" accept-charset="UTF-8" method="post" action="{{route('backend.register.save.featured', $dbl_post->id)}}"  autocomplete="off">
                    {{ Form::hidden('frm_post_featured[image]', ($dbl_post_featured ? $dbl_post_featured->image : null), array('id' => 'frm_post_featured_image')) }}
                    <div class="col-lg-7">
                        <div class="form-group">
                            {{ Form::label('frm_post_featured_type', 'Tipo Destacado') }}
                            <select name="frm_post_featured[type]" id="frm_post_featured_type" {{($dbl_post_featured ? "disabled='disabled'" : '' )}} class="form-control">
                                <option value="">Seleccionar Tipo Destacado</option>
                                @foreach($data_type_featured as $key_featured => $type_featured)
                                    <?php $selected = ($dbl_post_featured && ($dbl_post_featured->type == $key_featured)  ? 'selected="selected"': '' ); ?>
                                    <option value="{{$key_featured}}" {{$selected}} >{{$type_featured}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            {{ Form::label('frm_post_featured_title', 'Titulo') }}
                            {{ Form::text('frm_post_featured[title]', ($dbl_post_featured ? $dbl_post_featured->title : null), array('id' => 'frm_post_featured_title', 'placeholder' => 'Ingrese un titulo', 'class' => 'form-control')) }}
                        </div>
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="form-group ">
                                    {{ Form::label('frm_post_featured_post_at', 'Fecha de Publicación') }}
                                    <div class='input-group date' id='datetimepicker_post_at'>
                                        {{ Form::text('frm_post_featured[post_at]', ($dbl_post_featured ? Helpers::getDateFormat($dbl_post_featured->post_at) : null), array('id' => 'frm_post_featured_post_at', 'readonly' => 'readonly', 'placeholder' => 'Ingrese Fecha de Publicación', 'class' => 'form-control')) }}
                                        <span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6 pull-right">
                                <div class="form-group">
                                    {{ Form::label('frm_post_featured_expired_at', 'Fecha de Expiración') }}
                                    <div class='input-group date' id='datetimepicker_expired_at'>
                                        {{ Form::text('frm_post_featured[expired_at]', ($dbl_post_featured ?  Helpers::getDateFormat($dbl_post_featured->expired_at) : null), array('id' => 'frm_post_featured_expired_at', 'readonly' => 'readonly', 'placeholder' => 'Ingrese Fecha de Expiración', 'class' => 'form-control')) }}
                                        <span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></span>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <span class="btn btn-success fileinput-button">
                                <i class="glyphicon glyphicon-plus"></i>
                                <span>Subir Imagen</span>
                                <input id="fileupload_principal" type="file" name="file_image">
                            </span>
                        </div>

                        <div class="row">
                            <div class="col-md-12" id="preview_image">
                                <ul class="thumbnails list-unstyled">
                                    @if($dbl_post_featured && $dbl_post_featured->image)
                                    <li class="col-md-12">
                                        <div class="thumbnail" style="padding: 0">
                                            <div style="padding:4px" class="text-center">
                                                <img  src="{{ Helpers::getImage( $dbl_post_featured->image, 'featured/pp')}}">
                                            </div>
                                        </div>
                                    </li>
                                    @endif
                                </ul>
                            </div>
                        </div>

                         <button type="submit" class="btn btn-info">Guardar</button>
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
                <img  src="<%= item.image.filename_thumb %>">
            </div>
        </div>
    </li>
</script>

@section('js')
    {{ HTML::script('assets/js/sb-admin.js'); }}
    {{ HTML::script('http://code.jquery.com/ui/1.10.3/jquery-ui.js'); }}
    {{ HTML::script('assets/js/jquery_file_upload/jquery.iframe-transport.js'); }}
    {{ HTML::script('assets/js/jquery_file_upload/jquery.fileupload.js'); }}
    {{ HTML::script('assets/js/jquery_file_upload/jquery.fileupload-process.js'); }}
    {{ HTML::script('assets/js/jquery_file_upload/jquery.fileupload-validate.js'); }}
    {{ HTML::script('assets/js/datetimepicker/moment.js'); }}
    {{ HTML::script('assets/js/datetimepicker/datetimepicker.es.js'); }}
    {{ HTML::script('assets/js/datetimepicker/datetimepicker.js'); }}
    {{ HTML::script('assets/js/underscore.js'); }}
    {{ HTML::script('assets/js/backend/post_featured.js'); }}
@stop

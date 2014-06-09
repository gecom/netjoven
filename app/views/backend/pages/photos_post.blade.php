@extends('backend.layouts.default')

@section('title_content')
	Fotos
@stop

@section('css')
    {{ HTML::style('assets/css/backend/jquery.fileupload.css')}}
@stop

@section('content')

<div class="col-lg-12">
    <div class="panel panel-default">
        <div class="panel-heading">
            Listado de Fotos
        </div>
        <div class="panel-body">
            <div class="row">
				<form id="frm_directory_publication_gallery" action="" enctype="multipart/form-data" accept-charset="UTF-8" method="post"  autocomplete="off">
				<div class="col-lg-12">
					<div class="form-group">
						<span class="btn btn-success fileinput-button">
							<i class="glyphicon glyphicon-plus"></i>
							<span>Subir Imagen</span>
							<input id="fileupload_gallery" type="file" name="file_image" multiple />
						</span>
					</div>
					<div class="row">
						<div class="col-lg-12" id="wrapper_gallery">
						    <ul class="thumbnails list-unstyled">

						    	@if ($dbl_photos)
						    		@foreach ($dbl_photos as $dbr_photos)
										<li class="col-md-4">
											<div style="padding: 0" class="thumbnail">
												<div class="text-center" style="padding:4px">
													<?php $image_thumb = Helpers::getImage($dbr_photos->image, 'noticias/pp'); ?>
													<img src="{{$image_thumb}}">
												</div>
												<div class="caption">
													<?php $image = Helpers::getImage($dbr_photos->image, 'noticias'); ?>
													<input type="url" class="form-control" name="frm_news_gallery[title][]" value="{{$image}}" placeholder="Ingrese URL" readonly="readonly">
													<input type="hidden" name="frm_news_gallery[name][]" value="1401747934-239.jpg">
												</div>
												<div class="panel-footer text-center">
													<a title="Copiar"><span class="glyphicon glyphicon-file"></span></a>
													<a href="#remove" title="Eliminar"><span class="glyphicon glyphicon-trash"></span></a>
												</div>
											</div>
										</li>
						    		@endforeach
						    	@endif
						    </ul>
						</div>
					</div>
					<button type="submit" class="btn btn-info">Guardar Galeria</button>
				</div>
				</form>

            </div>
        </div>
    </div>
</div>
@stop

<script type="text/html" id='images-data'>
        <li class="col-md-4">
            <div class="thumbnail" style="padding: 0">
                <div style="padding:4px" class="text-center">
                    <img  src="<%= item.image.filename_thumb %>">
                </div>
                <div class="caption">
					<input readonly="readonly" placeholder="Ingrese URL" value="<%= item.image.filename %>" type="url" name="frm_news_gallery[title][]" class="form-control"  />
                    <input type="hidden" value="<%= item.image.name %>"  name="frm_news_gallery[name][]" />
                </div>
            </div>
        </li>
</script>

@section('js')
    {{ HTML::script('http://code.jquery.com/ui/1.10.3/jquery-ui.js'); }}
    {{ HTML::script('assets/js/jquery_file_upload/jquery.iframe-transport.js'); }}
    {{ HTML::script('assets/js/jquery_file_upload/jquery.fileupload.js'); }}
    {{ HTML::script('assets/js/jquery_file_upload/jquery.fileupload-process.js'); }}
    {{ HTML::script('assets/js/jquery_file_upload/jquery.fileupload-validate.js'); }}
    {{ HTML::script('assets/js/underscore.js'); }}
    {{ HTML::script('assets/js/backend/jquery.zclip.js'); }}
    {{ HTML::script('assets/js/backend/photos.js'); }}
@stop
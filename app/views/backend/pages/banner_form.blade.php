<div class="modal-header">
	<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
	<h4 class="modal-title">{{$title}}</h4>
</div>
<div class="modal-body">
	<div class="row">
		{{ Form::open(array('id' => 'frm_banner')) }}
			<div class="col-lg-10">
	            <div class="form-group">
	                {{ Form::label('frm_banner_title', 'Titulo') }}
	                {{ Form::text('frm_banner[title]', (!$is_new ? $dbr_banner->title : null), array('id' => 'frm_banner_title', 'placeholder' => 'Ingrese titulo', 'class' => 'form-control')) }}
	            </div>
	        </div>
			<div class="col-lg-10">
	            <div class="form-group">
	                {{ Form::label('frm_banner_code', 'Codigo') }}
	                {{ Form::textarea('frm_banner[code]', (!$is_new ? $dbr_banner->code : null), array('id' => 'frm_banner_code', 'placeholder' => 'Ingrese codigo', 'class' => 'form-control')) }}
	            </div>
	        </div>
	        <div class="col-lg-10">
	        	<button type="submit" class="btn btn-success">Guardar</button>
	        </div>
		{{ Form::close() }} 
	</div>
</div>
<div class="modal-footer">
	<button type="button" data-dismiss="modal" class="btn btn-default">Close</button>
</div>
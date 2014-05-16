@extends('frontend.layouts.default')

@section('css')
@stop

@section('content')
<div id="notes" class="facebook_fail">
	<div class="right_notes ">
		<div class="group_title custom_color_text">
			@if (isset($dbr_user))
				{{Lang::get('messages.frontend.user_group_edit_title')}}
			@else
				{{Lang::get('messages.frontend.user_group_register_title')}}
			@endif
		</div>
		<div class="form_fail">
			<div class="title_form custom_color_bg">
				@if (isset($dbr_user))
					{{Lang::get('messages.frontend.user_form_edit_title')}}
				@else
					{{Lang::get('messages.frontend.user_form_register_title')}}
				@endif
			</div>
			{{ Form::open(array('role'=>'form')) }}
				<ul>
					@foreach($errors->all() as $error)
						<li>{{ $error }}</li>
					@endforeach
				</ul>
				<div class="form-group col-md-8">
					<label for="frm_user_name">Nombres</label>
					<input type="text" value="{{(isset($dbr_user) ? $dbr_user_profile->first_name : null)}}" class="form-control" id="frm_user_name" name="frm_user[first_name]" placeholder="Nombres" />
				</div>
				<div class="form-group col-md-8">
					<label for="frm_user_last_name">Apellidos</label>
					<input type="text" value="{{(isset($dbr_user) ? $dbr_user_profile->last_name : null)}}" class="form-control" id="frm_user_last_name" name="frm_user[last_name]" placeholder="Apellidos" />
				</div>
				<div class="form-group col-md-8">
					<label for="frm_user_email">Correo Electronico</label>
					<input type="email" value="{{(isset($dbr_user) ? $dbr_user->email : null)}}" class="form-control" id="frm_user_email" name="frm_user[email]" placeholder="Correo electronico" />
				</div>

				@if (!isset($dbr_user))
					<div class="form-group col-md-8">
						<label for="frm_user_password">Contraseña</label>
						<input type="password" class="form-control" id="frm_user_password" name="frm_user[password]" placeholder="Contraseña" />
					</div>
				@else

					<div class="form-group col-md-8">
						<label for="frm_user_gender">Pais</label>
						<select class="form-control" id="frm_user_gender" name="frm_user[gender]">
							<option value="">--Seleccione--</option>
							<option value="M">Hombre</option>
							<option value="F">Mujer</option>
						</select>
					</div>
					<div class="form-group col-md-8">
						<label for="frm_user_gender">Departamento</label>
						<select class="form-control" id="frm_user_gender" name="frm_user[gender]">
							<option value="">--Seleccione--</option>
							<option value="M">Hombre</option>
							<option value="F">Mujer</option>
						</select>
					</div>
					<div class="form-group col-md-8">
						<label for="frm_user_gender">Ciudad</label>
						<select class="form-control" id="frm_user_gender" name="frm_user[gender]">
							<option value="">--Seleccione--</option>
							<option value="M">Hombre</option>
							<option value="F">Mujer</option>
						</select>
					</div>
				@endif

				<div class="form-group">
					<div class="col-md-12">
						<label for="frm_user_gender">Fecha de Nacimiento</label>
					</div>				
					<div class="col-md-2">
						{{Form::selectRange('frm_user[day]', 1, 31, null, ['class' => 'form-control'])}}
					</div>
					<div class="col-md-3">
						{{ Form::selectMonth('frm_user[month]', 1, ['class' => 'form-control']) }}
					</div>
					<div class="col-md-3">
						{{ Form::selectYear('frm_user[year]', date('Y')-100, date('Y'), date('Y') - 1 , ['class' => 'form-control']) }}
					</div>
				</div>
				<div class="form-group col-md-8">
					<label for="frm_user_gender">Sexo</label>
					<select class="form-control" id="frm_user_gender" name="frm_user[gender]">
						<option value="">--Seleccione--</option>
						<option value="M">Hombre</option>
						<option value="F">Mujer</option>
					</select>
				</div>
				<div class="actions form-group col-md-8">
					<input type="submit" value="Guardar" class="listo custom_color_bg">
				</div>
			{{ Form::close() }}
		</div>
	</div>

	<div class="left_notes">
		<div class="add">
			<img src="{{asset('assets/images/maq/banner.jpg')}}" alt="">
		</div>

		@include('frontend.pages.partials.slider_section')
		<div class="plugin_fb">
			@include('frontend.pages.partials.likebox')
		</div>

		<section id="ads">
			@include('frontend.pages.home.other_sections')
		</section>		
	</div>

</div>
@stop

@section('js')
@stop
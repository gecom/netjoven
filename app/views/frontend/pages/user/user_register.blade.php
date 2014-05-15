@extends('frontend.layouts.default')

@section('css')
@stop

@section('content')
<div id="notes" class="facebook_fail">

	<div class="right_notes ">
		<div class="group_title custom_color_text">Registro de Usuario</div>
		<div class="form_fail">
			<div class="title_form custom_color_bg">Registrate</div>
			<form>
				<div class="form-group col-md-8">
					<label for="frm_user_name">Nombres</label>
					<input type="text" class="form-control" id="frm_user_name" name="frm_user[name]" placeholder="Nombres" />
				</div>
				<div class="form-group col-md-8">
					<label for="frm_user_last_name">Apellidos</label>
					<input type="text" class="form-control" id="frm_user_last_name" name="frm_user[last_name]" placeholder="Apellidos" />
				</div>

				<div class="form-group col-md-8">
					<label for="frm_user_email">Correo Electronico</label>
					<input type="email" class="form-control" id="frm_user_email" name="frm_user[email]" placeholder="Correo electronico" />
				</div>
				<div class="form-group col-md-8">
					<label for="frm_user_gender">Sexo</label>
					<select class="form-control" id="frm_user_gender" name="frm_user[gender]">
						<option value="M">Hombre</option>
						<option value="F">Mujer</option>
					</select>
				</div>

				<div class="form-group col-md-8">
					<label for="frm_user_gender">Fecha de Nacmiento</label>
					<select size="10" class="form-control" id="frm_user_gender" name="frm_user[gender]">
						<option value="M">1</option>
						<option value="F">2</option>
					</select>
					<select class="form-control" id="frm_user_gender" name="frm_user[gender]">
						<option value="M">enero</option>
						<option value="F"></option>
					</select>
				</div>
				<div class="actions form-group col-md-8">
					<input type="submit" value="Guardar" class="listo custom_color_bg">
				</div>
			</form>
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
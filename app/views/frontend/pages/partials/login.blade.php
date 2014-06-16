<div id="popup_show_login">
	<div class="close_popup custom_color_bg"><a href="#">X</a></div>
	<div class="show_login">
		<div class="welcome log_in">
			<span class="log_in_mobile">Iniciar Sesión</span>
			<span class="user_icon"></span>
		</div>
		<div class="iniciar_sesion">
			{{ Form::open(array('role'=>'form', 'id' => 'frm_popup_login', 'autocomplete' => 'off')) }}
				<input type="text" name="email" class="login_input form-control" placeholder="Correo electronico" /><br>
				<input type="password" name="password" class="login_input form-control" placeholder="Contraseña" /><br>
				<div class="form-group">
					<input type="submit" value="Entrar" class="btn_login" />
				</div>
			{{ Form::close() }}
			<a class="lnk1" href="#">¿Olvidaste tu Contraseña?</a>
			<div class="share">
				<span>Registrate con: </span>
				<a class="gp" href="#"><span></span></a>
				<a class="tw" href="{{ route('frontend.login.twitter') }}"><span></span></a>
				<a class="fb" href="{{ route('frontend.login.facebook') }}"><span></span></a>
			</div>
			<div class="registrate">
				¿Eres nuevo en Netjoven?<br>
				<a class="btn btn-sm custom_color_bg" href="{{ route('frontend.user.register') }}"><span class="glyphicon glyphicon-edit"></span> Registrate</a>
			</div>
		</div>
	</div>
</div>
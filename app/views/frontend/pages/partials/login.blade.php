<div id="popup_show_login">
	<div class="close_popup custom_color_bg"><a href="#">X</a></div>
	<div class="show_login">
		<div class="welcome log_in">
		<!--<div class="bien">Bienvenido Luis Walters</div>-->
		<span class="log_in_mobile" href="#">Iniciar Sesión</span>
		<span class="user_icon"></span>

		</div>
		<div class="iniciar_sesion">
			{{ Form::open(array('role'=>'form', 'id' => 'frm_login', 'autocomplete' => 'off')) }}                   
				<input type="text" id="email" name="email" class="login_input" placeholder="Correo electronico" /><br>
				<input type="password" id="password" name="password" class="login_input" placeholder="Contraseña" /><br>
				<input type="submit" value="Entrar" class="btn_login" />
			{{ Form::close() }}			
			<a class="lnk1" href="#">Olvidaste tu Contraseña?</a>
			<div class="share">
				<span>Registrate con: </span>
				<a class="gp" href="#"><span></span></a>
				<a class="tw" href="#"><span></span></a>
				<a class="fb" href="{{ route('frontend.login.facebook') }}"><span></span></a>
			</div>
			<div class="registrate">
				Eres nuevo en Netjoven?<br><a class="registrate_btn" href="#">Regístrate</a>
			</div>
		</div>
		<div style="display:none" class="registro_form">
			Regístrate con Netjoven<br>
			<input type="text" class="login_input" value="Nombre"><br>
			<input type="text" class="login_input" value="Apellidos"><br>
			<input type="text" class="login_input" value="Correo Electrónico"><br>
			<input type="text" class="login_input" value="Contraseña"><br>
			<input type="text" class="login_input" value="Repetir Contraseña"><br>
			<select id="" name="" class="sel1"><option>Día</option></select>
			<select id="" name="" class="sel1"><option>Mes</option></select>
			<select id="" name="" class="sel1"><option>Año</option></select><br>
			<select id="" name="" class="sel2"><option>Sexo</option></select><br>
			<a class="finalizar_btn" href="#">Finalizar</a>
			<div class="redes_sociales">
				Registro con Redes<br>
				<a class="fb" href="#"></a>
				<a class="tw" href="#"></a>
				<a class="gp" href="#"></a>
			</div>
		</div>
	</div>	
</div>	
<?php 

if (!Cache::has('dbl_color_palette')){
    Cache::forever('dbl_color_palette', ColorPalette::all());
}

$dbl_color_palette = Cache::get('dbl_color_palette');
?>

<div id="popup_login">
	<div class="close_popup custom_color_bg"><a href="#">X</a></div>
	<div class="options_login">
		<div class="welcome">
			<span class="t1">{{Lang::get('messages.frontend.user_tool_title')}}</span>
		</div>
		<div class="pick_color">			
			<ul id="palette_color">
				@foreach ($dbl_color_palette as $dbr_color_palette)
					<li><a data-color="{{$dbr_color_palette->color}}" data-auth="{{ Auth::check() ? true : false}}" data-stylesheet="{{$dbr_color_palette->path}}" style="background-color: {{$dbr_color_palette->color}}"></a></li>
				@endforeach
			</ul>
			<div id="confirm_palette_color" style="display:none" >
				<span class="t2">{{Lang::get('messages.frontend.user_tool_confirm')}}</span>
				<a title="Cancelar" data-dismiss="modal" id="cancel_color_palette" class="cancel"></a>
				<a href="{{ route('frontend.user.tools.savechangecolor') }}" id="save_color_palette" title="Guardar" class="save"></a>
			</div>
		</div>
		<div class="share">
			<span>Conectate y comparte</span>
			<a href="#" class="gp"><span></span></a>
			<a href="#" class="tw"><span></span></a>
			<a href="#" class="fb"><span></span></a>
		</div>
		<div class="col-md-12" style="padding: 5px 0;">
			<a class="btn btn-default btn-sm custom_color_bg">
				<span class="glyphicon glyphicon-edit"></span> Edita tu perfil
			</a>
			<a href="{{ route('frontend.login.close_session') }}" class="btn btn-default btn-sm custom_color_bg">
				<span class="glyphicon glyphicon-remove-sign"></span> Cerrar Sesión
			</a>
		</div>
	</div>	
</div>
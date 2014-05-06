
<?php 

$dbr_user_tool = Auth::user()->userTool()->first();

if (!Cache::has('dbl_color_palette')){
    Cache::forever('dbl_color_palette', ColorPalette::all());
}

$dbl_color_palette = Cache::get('dbl_color_palette');

?>

<div id="popup_login">
	<div class="close_popup custom_color_bg"><a href="#">X</a></div>
	<div class="options_login">
		<div class="welcome">Login <span class="user_av"></span></div>
		<div class="pick_color">
			<span class="t1">Diseña tu interfaz</span>
			<ul id="pick_color">
				@foreach ($dbl_color_palette as $dbr_color_palette)
					<li><a href="#" data-stylesheet="{{$dbr_color_palette->path}}" style="background-color: {{$dbr_color_palette->color}}"></a></li>
				@endforeach
			</ul>
			<span class="t2">¿Deseas guardar los cambios?</span>
			<a href="#" class="cancel"></a>
			<a href="#" class="save"></a>
		</div>
		<div class="share">
			<span>Conectate y comparte</span>
			<a href="#" class="gp"><span></span>12200</a>
			<a href="#" class="tw"><span></span>1200</a>
			<a href="#" class="fb"><span></span>14000</a>
		</div>
		<!--<div class="change">
			<span>Cambia la interfaz de netjoven a tu estilo</span>
			<a href="#" class="v3"></a>
			<a href="#" class="v2"></a>
		</div>-->
	</div>	
</div>
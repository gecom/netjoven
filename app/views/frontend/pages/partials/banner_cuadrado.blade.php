<div class="monsterbox">
	@if (isset($banner_cuadrado) && !empty($banner_cuadrado))
		{{$banner_cuadrado}}
	@else
		{{ BannerHelper::getBanner(2)}}
	@endif	
</div>
@extends('frontend.layouts.default')

@section('css')
@stop

@section('content')

<section id="portada_espectaculos" class="{{$type_module == Helpers::TYPE_MODULE_LISTADO ? 'view_3' : '' }}">
	<div class="title custom_color_text">{{$title_section}}</div>
	<div class="left2_column">
		@include('frontend.pages.partials.banner_cuadrado')
		@if ($type_module != Helpers::TYPE_MODULE_LISTADO)
			<div class="plugin_fb">
				@include('frontend.pages.partials.likebox')
			</div>
		@endif

	</div>
	<div class="left_column left3_column">
		@include('frontend.pages.section.featured_section')
	</div>

	@if ($type_module == Helpers::TYPE_MODULE_MODULAR || $type_module == Helpers::TYPE_MODULE_LISTADO)
		<div class="more_news">
			@include('frontend.pages.partials.news_list', array('dbl_post_view'=> $dbl_post_view1, 'is_section_facebook' => false))
		</div>
		@include('frontend.pages.partials.banner_intermedio')
		<div class="more_news_v2 {{ $type_module == Helpers::TYPE_MODULE_MODULAR ? 'subseccion_modular' : 'subseccion_modular_listado'}}">
			@include('frontend.pages.partials.news_list', array('dbl_post_view'=> $dbl_post_view2, 'is_section_facebook' => $type_module == Helpers::TYPE_MODULE_MODULAR ? false : true))
		</div>
		<div class="features {{ $type_module == Helpers::TYPE_MODULE_MODULAR ? 'subseccion_modular' : 'subseccion_modular_listado'}}">
			@include('frontend.pages.partials.slider_section')
			@if($type_module == Helpers::TYPE_MODULE_LISTADO)
				@include('frontend.pages.partials.banner_cuadrado')
				@include('frontend.pages.partials.news_list', array('dbl_post_view'=> $dbl_post_view3, 'is_section_facebook' => false))
			@else
				@include('frontend.pages.partials.news_list', array('dbl_post_view'=> $dbl_post_view3, 'is_section_facebook' => false))
				@include('frontend.pages.partials.banner_cuadrado')
			@endif
		</div>
	@endif

	@if ($type_module == Helpers::TYPE_MODULE_ESTANDAR)
		<div class="features">
			@include('frontend.pages.partials.slider_section')
		</div>
		<div class="more_news_v2">
			@include('frontend.pages.partials.news_list', array('dbl_post_view'=> $dbl_post_view1, 'is_section_facebook' => false))
		</div>
	@endif

	<div class="paginate">
		{{$dbl_post_links}}
	</div>
</section>
@include('frontend.pages.partials.banner_intermedio')
<section id="ads">
@include('frontend.pages.home.other_sections')
</section>
@stop

@section('js')
@stop
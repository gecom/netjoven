@extends('frontend.layouts.default')

@section('css')
@stop

@section('content')

<div id="notes">

	<div class="right_notes pichanga_y_juerga">
		<div class="group_title custom_color_text p2">
			{{$dbr_directory->title}}
		</div>
		<div class="title_nota">
			{{$dbr_directory_publication->title}}
		</div>
		<div class="image p2">					
			<figure>
				<?php 
					$image_featured = Helpers::getImage($dbr_directory_publication->banner, 'agenda');
				?>
				<img src="{{$image_featured}}" alt="{{$dbr_directory_publication->title}}">
			</figure>
		</div>
		<div class="text_note">
			<span class="custom_color_text">DESCRIPCION DEL {{($dbr_directory_publication->directory_id == 1 ? 'CANCHA' : 'LUGAR')}}:</span>
			<p>{{$dbr_directory_publication->observation}}</p>
		</div>
		<div class="address custom_color_text">Dirección</div>
		<div id="preview_map" style="width: 600px;height: 275px" class="image p3" data-Latitude = "{{$dbr_directory_publication->latitude}}" data-longitude="{{$dbr_directory_publication->longitude}}"></div>
		<div class="text_note">
			<span class="custom_color_text">Datos:</span>
			<p>
				@if ($dbr_directory_publication->address)
					{{$dbr_directory_publication->address}} , {{$dbr_directory_publication->district_name}}<br/>
				@endif

				@if ($dbr_directory_publication->web)
					{{$dbr_directory_publication->web}}<br/>
				@endif
				
				@if ($dbr_directory_publication->phone)
					Tlf: {{$dbr_directory_publication->phone}}<br/>
				@endif		
			</p>
		</div>

		<div class="author">
			<span class="custom_color_bg"></span>Samantha Cervantes / NetJoven
		</div>
		<div class="social">
			@include('frontend.pages.section.post_button_social')
		</div>
		<div class="tags">
			<!--<span class="custom_color_text">Tags:</span> Kim Kardashian, Kanye West, matrimonio, Francia, Palacio de Versalles-->
		</div>
		<div class="action">
			<a href="{{$redirect}}" class="btn_volver custom_color_bg">Volver</a>
		</div>

		<div class="comment">
			@include('frontend.pages.section.post_comment')
		</div>
	</div>

	<div class="left_notes">
		@include('frontend.pages.partials.banner_cuadrado')
		@include('frontend.pages.partials.slider_section')
		<div class="plugin_fb">
			@include('frontend.pages.partials.likebox')
		</div>
		<section id="ads">
			@include('frontend.pages.home.other_sections');
		</section>		
	</div>
</div>
@stop

@section('js')
	{{ HTML::script('http://maps.googleapis.com/maps/api/js?sensor=false'); }}
	{{ HTML::script('assets/js/gmap3.js'); }}
	{{ HTML::script('assets/js/fn/directorio.js'); }}
@stop
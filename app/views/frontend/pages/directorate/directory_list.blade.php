@extends('frontend.layouts.default')

@section('css')
@stop

@section('content')

<div id="notes">
	<div class="right_notes pichanga_y_juerga">
		<div class="group_title custom_color_text">{{$dbr_directory->title}}</div>
		<div class="image">					
			@include('frontend.pages.directorate.directory_featured')
		</div>		
		<div class="subtitle">
			{{Lang::get('messages.frontend.directory_sub_title_'. mb_strtolower($dbr_directory->title))}}
		</div>
		<div class="list_content">
			@include('frontend.pages.directorate.directory_list_item')
		</div>		
	</div>
	<div class="left_notes pichanga_juerga">
		<div class="add">
			<img src="{{asset('assets/images/maq/add_1.png')}}" alt="">
		</div>
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
	{{ HTML::script('assets/js/fn/directorio.js'); }}
@stop
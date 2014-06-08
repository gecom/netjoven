@extends('frontend.layouts.default')

@section('css')
@stop

@section('content')
<div id="notes" class="facebook_fail">
	<div class="right_notes ">
		<div class="group_title custom_color_text">
				{{Lang::get('messages.frontend.radio_title')}}
		</div>
		<div class="form_fail">
			<div class="title_form custom_color_bg">
				{{Lang::get('messages.frontend.radio_title_content')}}
			</div>
			<div class="wrapper_radio col-md-12" style="background: url('http://www.netjoven.pe/images/bg_radio.jpg') no-repeat scroll 0 0 rgba(0, 0, 0, 0)">
				<div>
					<iframe src="http://portgrafperu.com/clientes/player/netjoven.php" name="portgrafperu=""" width="340" marginwidth="0" height="105" marginheight="0" align="middle" scrolling="No" frameborder="0" id="atmosfera="portgrafstreaming="portgrafstreaming"></iframe>
				</div>
			</div>
            <div class="radio_comment">
                @include('frontend.pages.section.post_comment')
            </div>
		</div>
	</div>

	<div class="left_notes">
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
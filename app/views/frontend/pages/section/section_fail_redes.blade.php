@extends('frontend.layouts.default')

@section('css')
@stop

@section('content')
<div id="notes" class="facebook_fail">

	<div class="right_notes ">
		<div class="group_title custom_color_text">
			Facebook Fail <a href="#" class="show_form_upload" style="display:none">Sube tu fail</a>
		</div>
		<section class="fails">
			<article class="fail_item">
				<div class="fail_item_title custom_color_text">
					Hembra que se Respeta
				</div>
				<figure>
					<img src="images/maq/fail.jpg" alt="">
				</figure>
				<div class="thanks">
					Gracias por tu publicación Harry Potter
				</div>
				<div class="sociales">
					compartir, me gusta, twitter, google
				</div>
			</article>
			<article class="fail_item">
				<div class="fail_item_title custom_color_text">
					Hembra que se Respeta
				</div>
				<figure>
					<img src="images/maq/fail.jpg" alt="">
				</figure>
				<div class="thanks">
					Gracias por tu publicación Harry Potter
				</div>
				<div class="sociales">
					compartir, me gusta, twitter, google
				</div>
			</article>
			<article class="fail_item">
				<div class="fail_item_title custom_color_text">
					Hembra que se Respeta
				</div>
				<figure>
					<img src="images/maq/fail.jpg" alt="">
				</figure>
				<div class="thanks">
					Gracias por tu publicación Harry Potter
				</div>
				<div class="sociales">
					compartir, me gusta, twitter, google
				</div>
			</article>
		</section>
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

	<div class="paginate_fail">
		<ul>
			<li class="active custom_color_bg" style="background-color: rgb(239, 133, 53);"><a href="#">1</a></li>
			<li><a href="#">2</a></li>
			<li><a href="#">3</a></li>
			<li><a href="#">4</a></li>
			<li><a href="#">5</a></li>
			<li>...</li>
			<li><a href="#">&gt;&gt;</a></li>
		</ul>
	</div>

</div>
@stop

@section('js')
@stop
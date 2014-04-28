@extends('frontend.layouts.default')

@section('css')
@stop

@section('content')

<div id="horoscopo_resultados">
	<div class="big_title custom_color_text">{{$title_text_search}}</div>
	<div class="right_horoscopo">
		<div class="list_articles">

			@if (!empty($dbl_post))
				@foreach ($dbl_post as $dbr_post)
					<article>
						<div class="media"><img alt="{{$dbr_post->title}}" src="{{Helpers::getImage($dbr_post->image, 'noticias')}}"></div>
						<div class="text">{{$dbr_post->title}}</div>
						<div class="opt">
							<ul>
								<li class="e1"><a href="{{route('frontend.section.list', array($dbr_post->category_slug))}}">+ {{$dbr_post->category_name}}</a></li>
								<li class="e2"><a href="#"></a></li>
								<li class="e3">{{ Helpers::intervalDate($dbr_post->post_at, date('Y-m-d H:i:s'))}}</li>
							</ul>
						</div>
					</article>
				@endforeach
			@endif

			@if ($message)
				{{$message}}
			@endif

		</div>
	</div>
	<div class="left_horoscopo">
		<div class="add">
			<img src="/assets/images/maq/banner1.png" alt="">
		</div>
		@include('frontend.pages.partials.slider_section')
		<div class="plugin_fb">
			@include('frontend.pages.partials.likebox')
		</div>
	</div>
	<div class="paginate">
		@if (!empty($dbl_post))
			{{$dbl_post->links('frontend.pages.partials.paginator')}}
		@endif
	</div>
</div>

@stop

@section('js')
@stop
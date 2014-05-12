<div class="tabs">
	<ul>
		<li class="active custom_color_bg"><a href="{{route('frontend.directorate.list.'.$dbr_directory->slug)}}" >Todas las {{mb_strtolower($dbr_directory->title)}}s</a></li>
		<li><a href="{{route('frontend.directorate.list.'.$dbr_directory->slug.'.cerca_de_ti')}}">Cerca de ti</a></li>
		<li><a href="{{route('frontend.directorate.list.'.$dbr_directory->slug.'.alfabetico')}}">Por orden alfabético</a></li>
	</ul>
	<div class="buscar_otro">					
		<div class="box_form">							
			<div class="box_search">
				<input type="text" class="ipt">
				<input type="button" value="" class="btn">
			</div>
		</div>
	</div>
</div>

<div class="list_articles">
	<div class="filter">
		@if ($is_juerga)
			<div class="filter1">
				<ul class="pestanas">
					<li class="p1"><a class="p2" href="{{route($data_url_directory[$slug_url_current])}}">Todos</a></li>
					<li class="p1"><a class="p2" href="{{route($data_url_directory[$slug_url_current], array(strtolower(Helpers::TYPE_BINGE_BAR)))}}">{{Helpers::TYPE_BINGE_BAR}}</a></li>
					<li class="p1"><a class="p2" href="{{route($data_url_directory[$slug_url_current], array(strtolower(Helpers::TYPE_BINGE_DISCOTECA)))}}">{{Helpers::TYPE_BINGE_DISCOTECA}}</a></li>
					<li class="p1"><a class="p2" href="{{route($data_url_directory[$slug_url_current], array(strtolower(Helpers::TYPE_BINGE_LOUNGES)))}}">{{Helpers::TYPE_BINGE_LOUNGES}}</a></li>
				</ul>
			</div>
		@endif

		@if ($slug_url_current == 'juerga-cerca-de-ti')
			<div class="filter2" >		
				<span>Nombre de Distrito</span>
				<select name="" id="">
				@foreach ($dbl_district as $dbr_district)
				<option value="{{$dbr_district->id}}">{{$dbr_district->district}}</option>
				@endforeach
			</select>
			</div>
		@endif

		@if ($slug_url_current == 'juerga-alfabetico')
				<?php
					$data_pagination_letter = array('A','B','C','D','E','F','G','H','I','J','K','L','M','N','O','P','Q','R','S','T','U','V','W','X','Y','Z');
				 ?>
				<div class="filter3">
					@foreach ($data_pagination_letter as $pagination_letter)
						<a class="" href="{{route($data_url_directory[$slug_url_current], array(strtolower(Helpers::TYPE_BINGE_BAR), ':' . $pagination_letter))}}">{{strtolower($pagination_letter)}}</a>
					@endforeach
				</div>
		@endif


	</div>
	@foreach ($dbl_directory_publications as $dbr_directory_publication)
		<article>
			<div class="media"><img src="images/maq/pich1.jpg"></div>
			<div class="text"><a>"{{$dbr_directory_publication->title}}"</a><br/>{{$dbr_directory_publication->district_name}}</div>
			<div class="opt">
				<div class="opt1"></div>
				<div class="opt2"></div>
				<div class="opt3">{{ Helpers::intervalDate($dbr_directory_publication->created_at, date('Y-m-d H:i:s'))}}</div>
			</div>
		</article>
	@endforeach
	<div class="paginate">{{ $dbl_directory_publications_links}}</div>
</div>

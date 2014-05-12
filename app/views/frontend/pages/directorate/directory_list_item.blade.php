<div class="tabs">
	<ul>
		<li class="active custom_color_bg"><a href="{{ URL::to($slug_url_current)}}" >Todas las {{mb_strtolower($dbr_directory->title)}}s</a></li>
		<li><a href="{{ URL::to('juerga-cerca-de-ti')}}">Cerca de ti</a></li>
		<li><a href="{{ URL::to('juerga-cerca-de-ti') }}">Por orden alfabético</a></li>
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
			<div id="filter1">
				<ul class="pestanas">
					<li class="p1"><a class="p2" href="{{URL::to('foo/hello')}}">Todos</a></li>
					<li class="p1"><a class="p2" href="{{route('frontend.directorate.list.' . $dbr_directory->slug, array(strtolower(Helpers::TYPE_BINGE_BAR)))}}">{{Helpers::TYPE_BINGE_BAR}}</a></li>
					<li class="p1"><a class="p2" href="{{route('frontend.directorate.list.' . $dbr_directory->slug, array(strtolower(Helpers::TYPE_BINGE_DISCOTECA)))}}">{{Helpers::TYPE_BINGE_DISCOTECA}}</a></li>
					<li class="p1"><a class="p2" href="{{route('frontend.directorate.list.' . $dbr_directory->slug, array(strtolower(Helpers::TYPE_BINGE_LOUNGES)))}}">{{Helpers::TYPE_BINGE_LOUNGES}}</a></li>
				</ul>
			</div>
		@endif

		<div id="filter2" style="display:none">		
			<span>Nombre de Distrito</span>
			<select name="" id="">
				@foreach ($dbl_district as $dbr_district)
					<option value="{{$dbr_district->id}}">{{$dbr_district->district}}</option>
				@endforeach
			</select>
		</div>

		<div id="filter3" style="display: none">
			<a class="custom_color_bg active" href="#">a</a>
			<a class="" href="#">b</a>
			<a class="" href="#">c</a>
			<a class="" href="#">d</a>
			<a class="" href="#">e</a>
			<a class="" href="#">f</a>
			<a class="" href="#">g</a>
			<a class="" href="#">h</a>
			<a class="" href="#">i</a>
			<a class="" href="#">j</a>
			<a class="" href="#">k</a>
			<a class="" href="#">l</a>
			<a class="" href="#">m</a>
			<a class="" href="#">n</a>
			<a class="" href="#">o</a>
			<a class="" href="#">p</a>
			<a class="" href="#">q</a>
			<a class="" href="#">r</a>
			<a class="" href="#">s</a>
			<a class="" href="#">t</a>
			<a class="" href="#">u</a>
			<a class="" href="#">v</a>
			<a class="" href="#">w</a>
			<a class="" href="#">x</a>
			<a class="" href="#">y</a>
			<a class="" href="#">z</a>
		</div>
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

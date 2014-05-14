<div class="tabs">
	<ul>
		<li class="active custom_color_bg"><a href="{{route('frontend.'.$dbr_directory->slug.'.list')}}" >Todas las {{mb_strtolower($dbr_directory->title)}}s</a></li>
		<li><a href="{{route('frontend.'.$dbr_directory->slug.'.list', array('cerca-de-ti'))}}">Cerca de ti</a></li>
		<li><a href="{{route('frontend.'.$dbr_directory->slug.'.list', array('alfabetico'))}}">Por orden alfabético</a></li>
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
				<?php

					if($is_cerca_de_ti || $is_alfabetico ){
						$url_current = route('frontend.'.$dbr_directory->slug.'.list', array($data_segments[0]));
					}else{
						$url_current = route('frontend.'.$dbr_directory->slug.'.list');
					}


					$data_type_juerga = array(Helpers::TYPE_BINGE_BAR, Helpers::TYPE_BINGE_DISCOTECA, Helpers::TYPE_BINGE_LOUNGES);


				?>

				<ul class="pestanas">
					@if (isset($data_segments[0]))
						<li class="p1"><a class="p2" href="{{route('frontend.'.$dbr_directory->slug.'.list', array($data_segments[0] ))}}">Todos</a></li>
					@else
						<li class="p1"><a class="p2" href="{{route('frontend.'.$dbr_directory->slug.'.list')}}">Todos</a></li>
					@endif					
						@foreach ($data_type_juerga as $type_juerga)
							@if($is_cerca_de_ti || $is_alfabetico )
								<li class="p1"><a class="p2" href="{{ route('frontend.'.$dbr_directory->slug.'.list', array($data_segments[0], strtolower($type_juerga))) }}">{{$type_juerga}}</a></li>
							@else
								<li class="p1"><a class="p2" href="{{route('frontend.'.$dbr_directory->slug.'.list', array(strtolower($type_juerga)))}}">{{$type_juerga}}</a></li>						
							@endif
						@endforeach
					</li>
				</ul>
			</div>
		@endif

		@if ($is_cerca_de_ti == true)
			<div class="filter2" >		
				<span>Nombre de Distrito</span>
				<select id="cbo_district">
				@foreach ($dbl_district as $dbr_district)
					<?php $slug_district = Str::slug($dbr_district->district . ' ' . $dbr_district->id ) ?>
					@if (isset($data_segments[0]) && isset($data_segments[1]) )	
						<?php preg_match('/[a-z0-9-]+/', $data_segments[1], $matches) ?>
						@if (count($matches) == 0)							
							<option  value="{{ URL::to($dbr_directory->slug. '/'.$data_segments[0].'/'.$data_segments[1]. '/'.$slug_district ); }}">{{$dbr_district->district}}</option>												
						@else
							@if(in_array(strtoupper($data_segments[1]), array(Helpers::TYPE_BINGE_BAR, Helpers::TYPE_BINGE_DISCOTECA, Helpers::TYPE_BINGE_LOUNGES)))
								<option  value="{{ URL::to($dbr_directory->slug. '/'.$data_segments[0].'/'.$data_segments[1]. '/'.$slug_district ); }}">{{$dbr_district->district}}</option>												
							@else
								<option  value="{{ URL::to($dbr_directory->slug. '/'.$data_segments[0].'/'.$slug_district ); }}">{{$dbr_district->district}}</option>
							@endif
						@endif						
					@else
						<option  value="{{ URL::to($dbr_directory->slug. '/'.$data_segments[0]. '/' . $slug_district ); }}">{{$dbr_district->district}}</option>
					@endif
				@endforeach
			</select>
			</div>
		@endif

		@if ($is_alfabetico == true)
				<?php
					$data_pagination_letter = array('A','B','C','D','E','F','G','H','I','J','K','L','M','N','O','P','Q','R','S','T','U','V','W','X','Y','Z');
				 ?>
				<div class="filter3">
					@foreach ($data_pagination_letter as $pagination_letter)
						@if (isset($data_segments[0]) && isset($data_segments[1]) )
							<?php $pos = strpos($data_segments[1], ':'); ?>
							@if ($pos === false)
								<a class="" href="{{ URL::to($dbr_directory->slug. '/'.$data_segments[0].'/'.$data_segments[1]. '/:'.$pagination_letter ); }}">{{strtolower($pagination_letter)}}</a>
							@else
								<a class="" href="{{ URL::to($dbr_directory->slug. '/'.$data_segments[0].'/:'.$pagination_letter ); }}">{{strtolower($pagination_letter)}}</a>								
							@endif							
						@else
							<a class="" href="{{ route('frontend.'.$dbr_directory->slug.'.list', array($data_segments[0], ':'.$pagination_letter)) }}">{{strtolower($pagination_letter)}}</a>
						@endif
						
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

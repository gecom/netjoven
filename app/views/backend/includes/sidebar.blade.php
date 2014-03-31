<div class="sidebar-collapse">
    <ul class="nav" id="side-menu">
        @foreach ($sidebar as $menu)
            <li>
            	<a href="{{ $menu['url'] }}"><i class="fa {{ $menu['class'] }} fa-fw"></i> {{ $menu['name'] }}
				@if(isset($menu['subcategories']))
					<span class="fa arrow"></span>
				@endif
            	</a>
            	@if(isset($menu['subcategories']))
					<ul class="nav nav-second-level">
						@foreach ($menu['subcategories'] as $submenu)
							<li><a href="{{ $submenu['url'] }}">{{ $submenu['name'] }}</a></li>
						@endforeach
					</ul>
            	@endif
            </li>
        @endforeach
    </ul>
</div>
<div class="sidebar-collapse">
    <ul class="nav" id="side-menu">
        @foreach ($sidebar as $s)
            <li>
            <a href="{{ $s['url'] }}"><i class="fa {{ $s['class'] }} fa-fw"></i> {{ $s['name'] }}</a>
            </li>
        @endforeach
    </ul>
<!-- /#side-menu -->
</div>
<!-- /.sidebar-collapse -->
<?php if ($paginator->getLastPage() > 1): ?>

<?php


//echo $router_paginator;
	$showBeforeAndAfter = 5;

	$currentPage = $paginator->getCurrentPage();
	$lastPage = $paginator->getLastPage();

	$start = $currentPage - $showBeforeAndAfter;

	if($start < 1){

		$diff = $start - 1;

		$start = $currentPage - ($showBeforeAndAfter + $diff);
	}


	$end = $currentPage + $showBeforeAndAfter;

	if($end > $lastPage){

		$diff = $end - $lastPage;
		$end = $end - $diff;
	}

?>
<ul>
	@if ($paginator->getCurrentPage() <= 1)
	    <li class="disabled"><span>&lt;</span></li>
	@else
	   <li><a href="{{route( 'home_pagination', $paginator->getCurrentPage()-1 ) }}">&lt;</a></li>
	@endif

	@for ($page = $start; $page <= $end; $page++)
		@if ($paginator->getCurrentPage() == $page)
			<li class="active custom_color_bg"><a href="">{{$page}}</a></li>
		@else
			<li><a href="{{route('home_pagination', $page) }}">{{$page}}</a></li>
		@endif
	@endfor


	@if ($paginator->getCurrentPage() >= $paginator->getLastPage())
		<li class="disabled"><span>&gt;</span></li>
	@else
		<li><a href="{{route( 'home_pagination', $paginator->getCurrentPage()+1 ) }}">&gt;</a></li>
	@endif
</ul>
<?php endif; ?>


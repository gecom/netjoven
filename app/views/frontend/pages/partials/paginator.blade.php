<?php if ($paginator->getLastPage() > 1): ?>

<?php

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
	@if ($paginator->getCurrentPage() > 1)
	   <li><a href="{{$paginator->getUrl($paginator->getCurrentPage()+1) }}">&lt;</a></li>
	@endif

	@for ($page = $start; $page <= $end; $page++)
		@if ($paginator->getCurrentPage() == $page)
			<li class="active custom_color_bg"><span>{{$page}}</span></li>
		@else
			<li><a href="{{$paginator->getUrl($page) }}">{{$page}}</a></li>
		@endif
	@endfor


	@if ($paginator->getCurrentPage() < $paginator->getLastPage())
		<li><a href="{{$paginator->getUrl($paginator->getCurrentPage()+1)}}">&gt;</a></li>
	@endif
</ul>
<?php endif; ?>


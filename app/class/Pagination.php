<?php

class Pagination{

	protected $paginator;
	protected $currentPage;
	protected $lastPage;


	public function setPagination(Paginator $paginator){
		$this->paginator = $paginator;
		$this->lastPage = $this->paginator->getLastPage();
		$this->currentPage = $this->paginator->getCurrentPage();
	}


	public function getPageRange($start, $end)
	{
		$pages = array();

		for ($page = $start; $page <= $end; $page++){
			if ($this->currentPage == $page){
				$pages[] = '<li class="active custom_color_bg"><a href="">'.$page.'</a></li>';
			}else{
				$pages[] = $this->getLink($page);
			}
		}

		return implode('', $pages);
	}

	function getLink($page)
	{
		$url = 'url';//$paginator->getUrl($page);

		return '<li><a href="'.$url.'">'.$page.'</a></li>';
	}

	function getPrevious($currentPage, $url)
	{
	    if ($this->currentPage <= 1)
	        return '<li class="previous disabled"><span>&lt;</span></li>';
	    else
	       return '<li class="previous"><a href="'.$url.'">&lt;</a></li>';
	}

	function getNext($currentPage, $lastPage, $url)
	{
	    if ($this->currentPage >= $lastPage)
	        return '<li class="next disabled"><span>&gt;</span></li>';
	    else
	        return '<li class="next"><a href="'.$url.'">&gt;</a></li>';
	}
}

?>
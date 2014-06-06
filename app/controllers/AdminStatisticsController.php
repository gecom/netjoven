<?php

class AdminStatisticsController extends BaseController {

	public function statisticsNews(){

		$params_template['title'] = 'Noticias';
		$params_template['dbl_statistics_post'] = $dbl_statistics_post = StatisticsHelper::statisticsPost()->paginate(25);
		return View::make('backend.pages.statistics_news', $params_template);
	}

	public function statisticsRedactores(){

		$params_template['title'] = 'Redactores';
		$params_template['dbl_statistics_post'] = $dbl_statistics_post = StatisticsHelper::statisticsRedactores()->paginate(25);
		return View::make('backend.pages.statistics_redactores', $params_template);
	}

	public function statisticsCategories(){

		$params_template['title'] = 'Categorias';
		$params_template['dbl_statistics_post'] = $dbl_statistics_post = StatisticsHelper::statisticsCategories()->paginate(25);
		return View::make('backend.pages.statistics_categories', $params_template);
	}

}

?>
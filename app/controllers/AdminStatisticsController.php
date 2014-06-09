<?php

class AdminStatisticsController extends BaseController {

	public function statisticsNews(){
		$data_params = Input::get('frm_statistics_filter', array());
		if(count($data_params)){
			Session::put('statistics', $data_params);
		}

		$params_template['data_params'] = $data_params = (Session::has('statistics') ? Session::get('statistics') : array());
		$params_template['title'] = 'Noticias';
		$params_template['dbl_statistics_post'] = $dbl_statistics_post = StatisticsHelper::statisticsPost($data_params)->paginate(15);
		$params_template['dbl_user'] = UserHelper::getUsersAdmin();
		
		$params_template['dbl_categories'] = Category::getParentCategories(array('is_menu' => true))->get(array('id', 'name'));

		if(isset($data_params['category_parent_id']) && !empty($data_params['category_parent_id'])){
			$params_template['dbl_children_categories'] = CategoryHelper::getCategoryChildrenByParent($data_params['category_parent_id'])->get();
		}

		return View::make('backend.pages.statistics_news', $params_template);
	}

	public function statisticsRedactores(){

		$data_params = Input::get('frm_statistics_filter', array());
		if(count($data_params)){
			Session::put('statistics_redactores', $data_params);
		}

		$params_template['data_params'] = $data_params = (Session::has('statistics_redactores') ? Session::get('statistics_redactores') : array());
		$params_template['title'] = 'Redactores';
		$params_template['dbl_statistics_post'] = $dbl_statistics_post = StatisticsHelper::statisticsRedactores($data_params)->paginate(15);
		return View::make('backend.pages.statistics_redactores', $params_template);
	}

	public function statisticsCategories(){

		$data_params = Input::get('frm_statistics_filter', array());
		if(count($data_params)){
			Session::put('statistics_categories', $data_params);
		}

		$params_template['data_params'] = $data_params = (Session::has('statistics_categories') ? Session::get('statistics_categories') : array());
		$params_template['title'] = 'Categorias';
		$params_template['dbl_statistics_post'] = $dbl_statistics_post = StatisticsHelper::statisticsCategories($data_params)->paginate(15);
		return View::make('backend.pages.statistics_categories', $params_template);
	}

}

?>
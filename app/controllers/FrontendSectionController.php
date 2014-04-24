<?php

class FrontendSectionController extends BaseController {

	public function listSection($slug){

		$dbr_category = Category::where('slug', $slug)->first();

		if(!$dbr_category)
			App::abort(404);

		$categories_ids  = array();

		if(empty($dbr_category->parent_id)){
			$dbl_categories = Category::getChildrenCategoryByParentId($dbr_category->id)->get();

			foreach ($dbl_categories as $dbr_category) {
				$categories_ids[] = $dbr_category->id;
			}

		}else{
			$categories_ids = array($dbr_category->id);
		}

		$params['display'] 		=  1;
		$params['category_id'] 	=  $categories_ids;
		$params['type'] 		=  array($dbr_category->type);
		$params['with_post_at'] =  true;


		$params_template['type_module'] = $type_module = Helpers::getTypeModule();

		if($type_module == Helpers::TYPE_MODULE_ESTANDAR){
			$paginate = 14;
			$total_post_v1 = 2;
			$total_post_v2 = 3;
			$total_post_v3 = 9;
		}

		if($type_module == Helpers::TYPE_MODULE_MODULAR){
			$paginate = 15;
			$total_post_v1 = 6;
			$total_post_v2 = 1;
			$total_post_v3 = 8;
		}

		if($type_module == Helpers::TYPE_MODULE_LISTADO){
			$paginate = 18;
			$total_post_v1 = 6;
			$total_post_v2 = 8;
			$total_post_v3 = 4;
		}

		$params_template['dbl_post'] = $dbl_post = Post::getPost($params)->paginate($paginate)->route('frontend.section.pagination', array($slug));

		$dbl_post_view1 = array();
		$dbl_post_view2 = array();
		$dbl_post_view3 = array();

		foreach ($dbl_post as $dbr_post) {
				if(count($dbl_post_view1) < $total_post_v1){
					$dbl_post_view1[] = $dbr_post;
				}elseif(count($dbl_post_view2) < $total_post_v2){
					$dbl_post_view2[] = $dbr_post;
				}else{
					$dbl_post_view3[] = $dbr_post;
				}
		}

		if(count($dbl_post_view1)){
			$params_template['dbl_post_view1'] = $dbl_post_view1;
		}

		if(count($dbl_post_view2)){
			$params_template['dbl_post_view2'] = $dbl_post_view2;
		}

		if(count($dbl_post_view3)){
			$params_template['dbl_post_view3'] = $dbl_post_view3;
		}


		return View::make('frontend.pages.section.section',$params_template);

	}

}

?>
<?php

class AdminCategoryController extends BaseController {

	public function listCategories()
	{
		$dbl_categories = Category::getParentCategories()->paginate(15);
		return View::make('backend.pages.categories_list', array('dbl_categories' => $dbl_categories ));
	}

	public function registerCategory($parent_category = null, $category = null){

        $params_template['is_new'] = $is_new =  false;
        $params_template['title'] = 'Editar Categoría';
        if(empty($category) && empty($parent_category)){
            $params_template['is_new'] = $is_new = true;
            $params_template['title'] = 'Registrar Categoría';
        }

        if(!$is_new){
        	if(!empty($parent_category) && !empty($category)){
        		$params_template['dbr_category'] = $category;
        	}elseif(!empty($parent_category) && empty($category)){
        		$params_template['dbr_category'] = $parent_category;
        		$params_template['type_category'] = array(Helpers::TYPE_POST_NEWS, Helpers::TYPE_POST_VIDEO);
        	}else{
				$params_template['dbr_category'] = null;
				$params_template['type_category'] = null;
        	}
        }else{
        	$params_template['type_category'] = array(Helpers::TYPE_POST_NEWS, Helpers::TYPE_POST_VIDEO);
        }


		return View::make('backend.pages.register_category', $params_template);
	}

	public function registerNewCategory($parent_category){
		$params_template['is_new'] = $is_new =  true;
		$params_template['title'] = 'Agregar Subcategoría';
		$params_template['dbr_category'] = $parent_category;

		return View::make('backend.pages.register_category', $params_template);
	}

	public function saveCategory($parent_category = null, $category = null){

		$data_frm_category = Input::get('frm_category');

		$is_new =  false;
		$is_parent_category = false;

		if($data_frm_category['is_new'] == 1){
			$is_new = true;
		}

		$rules = array(
			'name'   => 'required|min:3'
		);

		if(!$is_new){
        	if(!empty($parent_category) && !empty($category)){
        		$dbr_category = $category;
        	}elseif(!empty($parent_category) && empty($category)){
        		$dbr_category = $parent_category;
        		$is_parent_category = true;
        	}else{
				$dbr_category = null;
        	}
        }

		$dbr_category = ($is_new == true ? new Category() : $dbr_category);

		$validator = Validator::make($data_frm_category, $rules);
		$response = array();

        if ( $validator->fails() ){
			if(Request::ajax()){
				$response['success'] = false;
				$response['errors'] =  $validator->getMessageBag()->toArray();
			} else{
				return Redirect::back()->withInput()->withErrors($validator);
			}
        }else{

			$dbr_category->name = $data_frm_category['name'];

			if($is_new && $parent_category){
				$dbr_category->parent_id = $parent_category->id;
			}

			if($dbr_category->parent_id){
				$dbr_category->slug = Str::slug($parent_category->name . ' ' . $data_frm_category['name']);
			}else{
				$dbr_category->slug = Str::slug($data_frm_category['name']);
			}

			$dbr_category->description = $data_frm_category['description'];

			if(isset($data_frm_category['is_menu'])){
				$dbr_category->is_menu = $data_frm_category['is_menu'];
			}

			if(isset($data_frm_category['keyword'])){
				$data_keywords = Helpers::getTagIds(explode(',', $data_frm_category['keyword']), false);
				$keywords = implode(',', $data_keywords);
				$dbr_category->keyword = $keywords;
			}

			if(!empty($data_frm_category['image'])){
				$dbr_category->image = $data_frm_category['image'];
			}

			if($is_new && $parent_category){
				$dbr_category->parent_id = $parent_category->id;
			}

			if($dbr_category->save()){
				$response['success'] = true;
				$response['message'] =  'Categoría registrada satisfactoriamente';
				$response['redirect'] =  route('list_categories');

			}else{
				$response['success'] = true;
				$response['errors'] =  ['Error al registrar la categoría'];
			}

        }

		return Response::json($response);

	}

}

?>
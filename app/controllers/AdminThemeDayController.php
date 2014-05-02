<?php

class AdminThemeDayController extends BaseController {

	public function listThemeDay(){

		return View::make('backend.pages.theme_day_list');
	}

	public function registerThemeDay($theme_day = null){
		$params_template['is_new'] = false;

		if(empty($theme_day)){
			$params_template['is_new'] = true;
		}

		$params_template['dbl_parent_categories'] = Category::getParentCategories()->get();
		return View::make('backend.pages.theme_day_register', $params_template);
	}

	public function saveRegisterThemeDay($theme_day = null){

        $data_frm_theme_day = Input::get('frm_theme_day');

        $is_new = false;
        if(empty($theme_day) && $data_frm_theme_day['is_new'] == true){
            $is_new = true;
        }

        $dbr_theme_day = ($is_new == true ? new ThemeDay() : $theme_day);

        $rules = array(
            'name'   => 'required|min:3'
        );

        $validator = Validator::make($data_frm_theme_day, $rules);

		if ( $validator->fails() ){
            if(Request::ajax()){
                $response['success'] = false;
                $response['errors'] =  $validator->getMessageBag()->toArray();
            } else{
                return Redirect::back()->withInput()->withErrors($validator);
            }
        }else{


        		/*$data_sections = ThemeDay::find(1)->sections()->get();


        		print_r($data_sections);

        		die();*/


        		try {
					$tag_data_id = Helpers::getTagIds(array($data_frm_theme_day['name']));

					if(count($tag_data_id) == 0){

					}

					$dbr_theme_day->tag_id = $tag_data_id[0];

					if(!empty($data_frm_theme_day['params'])){
						$dbr_theme_day->params = $data_frm_theme_day['params'];
					}

					if(!empty($data_frm_theme_day['color'])){
						$dbr_theme_day->color = $data_frm_theme_day['color'];
					}

					if($dbr_theme_day->save()){
						$dbr_theme_day->sections = $data_frm_theme_day['sections'];
						$response['success'] = true;
						$response['message'] =  'Nota registrada satisfactorimente';
						$response['redirect'] =  route('backend.theme_day.list');
					}else{
						$response['success'] = false;
						$response['errors'] =  ['Error: Hubo un error al registrar el tema del dia'];
					}

        		} catch (Exception $e) {
					$response['success'] = false;
					$response['errors'] =  ['Error:' . $e->getMessage()];
        		}





/*print_r($name);

die();
			$dbr_theme_day->name = $data_frm_theme_day['name'];
			$dbr_theme_day->category_id = $data_frm_theme_day['category_id'];



			try {
				if($dbr_theme_day->save()){
					$response['success'] = true;
					$response['message'] =  'Nota registrada satisfactorimente';
					$response['redirect'] =  route('backend.theme_day.list');
				}else{
					$response['success'] = false;
					$response['errors'] =  ['Error: Hubo un error al registrar el tema del dia'];
				}
			} catch (Exception $e) {
				$response['success'] = false;
				$response['errors'] =  ['Error:' . $e->getMessage()];
			}*/

        }

        return Response::json($response);

	}

}
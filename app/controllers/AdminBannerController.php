<?php

class AdminBannerController extends BaseController {

	public function listBannersDetail(){

        $data_params = Input::get('frm_banner_filter');

        if(Request::ajax()){

            if(count($data_params)){

                if(Cookie::has('data_params_banner')){
                    Cookie::forget('data_params_banner');
                }

print_r($data_params);

die();
           

                $cookie = Cookie::forever('data_params_banner', $data_params);

                $response['success'] = true;
                $response['redirect'] = route('backend.banner_detail.list');
 //dd($response);
               // if($cookie){
                    return Response::json($response);
                //}
            }
        }

        $params['module_id'] = 3;
        $params['sector_id'] = 1;
        $params['type'] = BannerHelper::TYPE_BANNER_ALL;

        if(Cookie::has('data_params_banner')){
            $data_params = Cookie::get('data_params_banner');

            if(!empty($data_params['submodule'])){
                $params['module_id'] = $data_params['submodule'];
            }else{
                $params['module_id'] = $data_params['module'];
            }


            if(!empty($data_params['sector'])){
                $params['sector_id'] = $data_params['sector'];
            }

            if(!empty($data_params['type'])){
                $params['type'] = $data_params['type'];
            }

        }


        $params['join_banner'] = true;
        $params['status'] = array(Status::STATUS_ACTIVO, Status::STATUS_INACTIVO);

        $dbl_banner_detail = BannerDetail::getBannerDetail($params)->paginate(30);
        $dbl_banner_module_parent = BannerHelper::getBannerModuleParent();
        $dbl_banner_sector = BannerHelper::getSector();        
        unset($params);

        $params_template['title'] = 'Banners';
        $params_template['dbl_banner_detail'] = $dbl_banner_detail;
        $params_template['dbl_banner_module_parent'] = $dbl_banner_module_parent;
        $params_template['dbl_banner_sector'] = $dbl_banner_sector;

        return View::make('backend.pages.banner_detail_list', $params_template);
	}

	public function listBanners(){
		$dbl_banners = Banner::orderBy('created_at', 'desc')->paginate(25);

		$params_template['title'] = 'Banners';
		$params_template['dbl_banners'] = $dbl_banners;
        return View::make('backend.pages.banner_list', $params_template);
	}

	public function bannerRegister($dbr_banner = null){
		if(Request::ajax()){
			$params_template['title'] = 'Registrar Banner';
			$params_template['is_new'] = ($dbr_banner ? false : true);
			$params_template['dbr_banner'] = $dbr_banner;

			return View::make('backend.pages.banner_form', $params_template)->render();
		}
	}

	public function bannerSave($dbr_banner = null){

        $data_frm_banner = Input::get('frm_banner');
        $response = array();

        $rules = array(
            'title'         => 'required|min:3',
            'code'      	=> 'required'
        );

        $validator = Validator::make($data_frm_banner, $rules);

        if ( $validator->fails() ){
            if(Request::ajax()){
                $response['success'] = false;
                $response['errors'] =  $validator->getMessageBag()->toArray();
            } else{
                return Redirect::back()->withInput()->withErrors($validator);
            }
        }else{
			$dbr_banner = ($dbr_banner ? $dbr_banner : new Banner());

            $dbr_banner->title    =   $data_frm_banner['title'];
            $dbr_banner->code     =   $data_frm_banner['code'];

            try {
            	if($dbr_banner->save()){
            	    $response['success'] = true;
                    $response['message'] =  'La nota se destaco satisfactoriamente';
                    $response['redirect'] = route('backend.banner.list');
            	}else{
					$response['success'] = false;
					$response['errors'] =  ['Error: Hubo un error al registrar la nota como destacada'];
            	}
            } catch (Exception $e) {
				$response['success'] = false;
				$response['errors'] =  ['Error:' . $e->getMessage()];
            }

        }

        return Response::json($response);
	}


    public function bannerSubmodule(){
        if(Request::ajax()){
            $parent_module_id = Input::get('parent_id', null);

            $data_banner_submodule = array();
            $dbl_banner_submodule = null;

            if(!empty($parent_module_id)){
                $dbl_banner_submodule = BannerHelper::getBannerModuleByParentId($parent_module_id);    
            }

            if($dbl_banner_submodule){
                foreach ($dbl_banner_submodule as $dbr_banner_submodule) {
                   $data_banner_submodule[] = array('id' => $dbr_banner_submodule->id, 'name' => $dbr_banner_submodule->name);
                }
            }

            return Response::json($data_banner_submodule);
        }
    }

}

?>
<?php

class AdminBannerController extends BaseController {

	public function listBannersDetail(){

        $data_params = array();
        if(Request::ajax()){
            $data_params = Input::get('frm_banner_filter', array());
            if(count($data_params)){

                if(Cookie::has('data_params_banner')){
                    Cookie::forget('data_params_banner');
                }

                $cookie = Cookie::forever('data_params_banner', json_encode($data_params));

                $response['success'] = true;
                $response['redirect'] = route('backend.banner_detail.list');

                if($cookie){
                    return Response::json($response)->withCookie($cookie);
                }
            }
        }

        $params['module_id'] = $data_params['module'] = 3;
        $params['sector_id'] = $data_params['sector'] = 1;
        $params['type'] = $data_params['type'] = BannerHelper::TYPE_BANNER_ALL;

        if(Cookie::has('data_params_banner')){
            $data_params = Cookie::get('data_params_banner');
            $data_params = json_decode($data_params,true);

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
        $dbl_banner_module_children = null;

        if(is_array($data_params) && count($data_params)){
            $parent_module_id = $data_params['module'];
            $dbl_banner_module_children = BannerHelper::getBannerModuleByParentId($parent_module_id);  
        }
        
        $params_template['title'] = 'Banners';
        $params_template['data_params'] = (is_array($data_params) && count($data_params) ? $data_params : array());
        $params_template['dbl_banner_detail'] = $dbl_banner_detail;
        $params_template['dbl_banner_module_parent'] = $dbl_banner_module_parent;
        $params_template['dbl_banner_module_children'] = $dbl_banner_module_children;
        $params_template['dbl_banner_sector'] = $dbl_banner_sector;
        unset($params);

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

    public function bannerDetailRegister($dbr_banner_detail = null){
        $data_params = Input::get('data_params');
        $data_params = json_decode($data_params, true);

        $breadkund[0] = BannerModule::where('id', '=', $data_params['module'])->first()->name;
        $breadkund[1] = !empty($data_params['submodule']) ? BannerModule::where('id', '=', $data_params['submodule'])->first()->name: '';
        $breadkund[2] = BannerHelper::$type_banner[$data_params['type']];
        $breadkund[3] = BannerSector::where('id', '=',$data_params['sector'])->first()->name;

        $params_template['title'] = 'Detalle Banner';
        $params_template['is_new'] = ($dbr_banner_detail ? false : true);
        $params_template['dbl_banner'] = Banner::select('id', 'title')->orderBy('created_at', 'desc')->get();
        $params_template['dbl_country'] = Helpers::getCountry();
        $params_template['dbr_banner_detail'] = $dbr_banner_detail;
        $params_template['data_params'] = $data_params;
        $params_template['breadkund'] = $breadkund;

        return View::make('backend.pages.banner_detail_form', $params_template)->render();
    }


    public function bannerDetailSave($dbr_banner_detail = null){
        $data_frm_banner = Input::get('frm_banner_detail');  

        $response = array();

        $rules = array(
            'banner_id'     => 'required',
            'weight'   => 'required',
            'country' => 'required' 
        );

        if(isset($data_frm_banner['tag'])){
            $rules['tag'] = 'required|min:3';
        }

        $validator = Validator::make($data_frm_banner, $rules);

        if ( $validator->fails() ){
            if(Request::ajax()){
                $response['success'] = false;
                $response['errors'] =  $validator->getMessageBag()->toArray();
            } else{
                return Redirect::back()->withInput()->withErrors($validator);
            }
        }else{

            $dbr_banner_detail = ($dbr_banner_detail ? $dbr_banner_detail : new BannerDetail());

            $dbr_banner_detail->status          =   isset($data_frm_banner['status']) ? Status::STATUS_ACTIVO : Status::STATUS_INACTIVO;
            $dbr_banner_detail->banner_id       =   $data_frm_banner['banner_id'];
            $dbr_banner_detail->module_id       =   $data_frm_banner['module_id'];
            $dbr_banner_detail->sector_id       =   $data_frm_banner['sector_id'];
            $dbr_banner_detail->type            =   $data_frm_banner['type'];
            $dbr_banner_detail->weight          =   $data_frm_banner['weight'];
            $dbr_banner_detail->country         =   $data_frm_banner['country'];
            $dbr_banner_detail->date_start      =   Helpers::getDateFormat($data_frm_banner['date_start'], 'Y/m/d');
            $dbr_banner_detail->date_end        =   Helpers::getDateFormat($data_frm_banner['date_end'], 'Y/m/d');
            $dbr_banner_detail->time_start      =   $data_frm_banner['time_start'];
            $dbr_banner_detail->time_end        =   $data_frm_banner['time_end'];

            if(isset($data_frm_banner['tag'])){
                $dbr_banner_detail->tag       =   $data_frm_banner['tag'];
            }
            
            try {
                if($dbr_banner_detail->save()){
                    $response['success'] = true;
                    $response['message'] =  'El banner se registro satisfactoriamente';
                    $response['redirect'] = route('backend.banner_detail.list');
                }else{
                    $response['success'] = false;
                    $response['errors'] =  ['Error: Hubo un error al registrar el banner'];
                }
            } catch (Exception $e) {
                $response['success'] = false;
                $response['errors'] =  ['Error:' . $e->getMessage()];
            }
        }

        return Response::json($response);
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
                    $response['message'] =  'El banner se destaco satisfactoriamente';
                    $response['redirect'] = route('backend.banner.list');
            	}else{
					$response['success'] = false;
					$response['errors'] =  ['Error: Hubo un error al registrar el banner'];
            	}
            } catch (Exception $e) {
				$response['success'] = false;
				$response['errors'] =  ['Error:' . $e->getMessage()];
            }

        }

        return Response::json($response);
	}

    public function changeStatusBannerDetail($dbr_banner_detail){

        $status = Input::get('status');

        if(Request::ajax()){

            if (!$status) {
                throw new Exception('Error : Ingrese un estado valido');
            }

            try {
                $dbr_banner_detail->status = $status;
                $dbr_banner_detail->save();
                $response['success'] = true;
                $response['message'] =  'Estado actualizado satisfactoriamente';
            } catch (Exception $e) {
                $response['success'] = false;
                $response['errors'] =  ['Error:' . $e->getMessage()];
            }

            return Response::json($response);            
        }

    }

    public function deleteBannerDetail($dbr_banner_detail){
        if(Request::ajax()){

            if (!$dbr_banner_detail) {
                throw new Exception('Error : no se puedo eliminar el banner');
            }

            try {
                $dbr_banner_detail->delete();
                $response['success'] = true;
                $response['message'] =  'Banner eliminado satisfactoriamente';
            } catch (Exception $e) {
                $response['success'] = false;
                $response['errors'] =  ['Error:' . $e->getMessage()];
            }

            return Response::json($response);  
        }
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
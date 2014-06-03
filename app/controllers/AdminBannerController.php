<?php

class AdminBannerController extends BaseController {

	public function listBannersDetail(){

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

        $validator = Validator::make($data_frm_news, $rules);

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
                    $response['redirect'] = route('backend.post.list');
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

}

?>
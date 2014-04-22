<?php

class FrontEndHomeController extends BaseController {


	public function home(){

		$type_module = (empty(Input::get('type')) ? Helpers::TYPE_MODULE_ESTANDAR : Input::get('type'));

		$params['type'] =  array(Helpers::TYPE_POST_NEWS,Helpers::TYPE_POST_VIDEO,Helpers::TYPE_POST_GALLERY);
		$params['view_index'] =  1;
		$params['with_post_at'] =  true;
		$params['display'] =  1;

		$params_template['dbl_last_post_featured_super'] = PostFeatured::GetFeaturedPost(Helpers::TYPE_POST_SUPER_FEATURED)->first();
		$params_template['dbl_last_post_featured_slider'] = PostFeatured::GetFeaturedPost(Helpers::TYPE_POST_SLIDER_FEATURED)->limit(5)->get();
		$params_template['dbl_theme_day'] = ThemeDay::getThemeDay()->get();

		if(Request::ajax()){
			Cookie::forget('type_module');
			$cookie = Cookie::forever('type_module', $type_module);
			$data['susccess'] = true;

			return Response::json($data)->withCookie($cookie);
		}else{

			if(Cookie::has('type_module')){
				$type_module = Cookie::get('type_module');
			}

			if($type_module == Helpers::TYPE_MODULE_ESTANDAR){
				$params['show_limit'] = array(6,0);
			}

			if($type_module == Helpers::TYPE_MODULE_MODULAR){
				$params['show_limit'] = array(9,0);
			}

			if($type_module == Helpers::TYPE_MODULE_LISTADO){
				$params['show_limit'] = array(8,0);
			}

			$dbl_last_post = Post::getPost($params)->get();

			$params_template['dbl_last_post'] = $dbl_last_post;

			if($type_module == Helpers::TYPE_MODULE_LISTADO || $type_module == Helpers::TYPE_MODULE_MODULAR){

				if($type_module == Helpers::TYPE_MODULE_MODULAR){
					$params['show_limit'] = array(12,9);
				}

				if($type_module == Helpers::TYPE_MODULE_LISTADO){
					$params['show_limit'] = array(10,8);
				}

				$dbl_more_post = Post::getPost($params)->get();
				$params_template['dbl_more_post'] = $dbl_more_post;
			}

		}

		$params_template['type_module'] = $type_module;
		return View::make('frontend.pages.home.home', $params_template);
	}

}


?>
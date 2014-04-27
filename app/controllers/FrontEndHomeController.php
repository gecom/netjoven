<?php

class FrontendHomeController extends BaseController {


	public function home($type_module = null){

		$type_module = (empty($type_module) ? Helpers::TYPE_MODULE_ESTANDAR : $type_module);

		$params_template['dbl_last_post_featured_super'] = PostFeatured::GetFeaturedPost(Helpers::TYPE_POST_SUPER_FEATURED)->first();
		$params_template['dbl_last_post_featured_slider'] = PostFeatured::GetFeaturedPost(Helpers::TYPE_POST_SLIDER_FEATURED)->limit(5)->get();
		$params_template['dbl_last_post_video_featured'] = PostFeatured::GetFeaturedPost(Helpers::TYPE_VIDEO_FEATURED)->limit(5)->get();
		$params_template['dbl_theme_day'] = ThemeDay::getThemeDay()->get();

		if(Cookie::has('type_module')){
			$type_module = Cookie::get('type_module');
		}

		$params_template = array_merge($params_template, $this->getPostByTypeModule($type_module));
		$params_template['type_module'] = $type_module;

		return View::make('frontend.pages.home.home', $params_template);
	}


	protected function getPostByTypeModule($type_module){

		$params['type'] =  array(Helpers::TYPE_POST_NEWS,Helpers::TYPE_POST_VIDEO);
		$params['view_index'] =  1;
		$params['with_post_at'] =  true;
		$params['display'] =  1;

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

		$data['dbl_last_post'] = $dbl_last_post;

		if($type_module == Helpers::TYPE_MODULE_LISTADO || $type_module == Helpers::TYPE_MODULE_MODULAR){

			if($type_module == Helpers::TYPE_MODULE_MODULAR){
				$params['show_limit'] = array(12,9);
			}

			if($type_module == Helpers::TYPE_MODULE_LISTADO){
				$params['show_limit'] = array(10,8);
			}

			$dbl_more_post = Post::getPost($params)->get();
			$data['dbl_more_post'] = $dbl_more_post;
		}

		return $data;
	}

	public function changeTypeModule($type_module = null){
		$type_module = (empty($type_module) ? Helpers::TYPE_MODULE_ESTANDAR : $type_module);

		if(Request::ajax()){
			return View::make('frontend.pages.partials.type_module',array('type_module'=>$type_module))->render();
		}

	}

	public function saveTypeModule($type_module){
		$type_module = (empty($type_module) ? Helpers::TYPE_MODULE_ESTANDAR : $type_module);

		if(Cookie::has('type_module')){
			Cookie::forget('type_module');
		}

		$cookie = Cookie::forever('type_module', $type_module);

		$response['success'] = true;
		$response['type_module'] = $type_module;
		$response['message'] = 'Tus cambios se realizaron con éxito';
		return Response::json($response)->withCookie($cookie);

		//$data = $this->getPostByTypeModule($type_module);

		/*$params_template['dbl_theme_day'] = ThemeDay::getThemeDay()->get();
		$params_template['dbl_last_post'] = $data['dbl_last_post'];
		$params_template['type_module'] = $type_module;

		$response['template_last_post'] = View::make('frontend.pages.home.latest_news',$params_template)->render();

		if (isset($data['dbl_more_post'])) {
			unset($params_template);
			$params_template['dbl_more_post'] = $data['dbl_more_post'];
			$params_template['type_module'] = $type_module;
			$response['template_more_post'] = View::make('frontend.pages.home.more_news',$params_template)->render();
		}*/

	}

}


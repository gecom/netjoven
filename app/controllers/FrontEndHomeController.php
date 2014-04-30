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

	public function viewMoreNews(){

		$params['type'] =  array(Helpers::TYPE_POST_NEWS,Helpers::TYPE_POST_VIDEO);
		$params['with_post_at'] =  true;
		$params['display'] =  1;

		$dbl_post = Post::getPost($params)->paginate(12)->route('frontend.post.more_news_paginate');

		$params_template['meter_likebox'] = array(300, 300);
		$params_template['title_text_search'] = 'Noticias';
		$params_template['dbl_post_search'] = $dbl_post;

		return View::make('frontend.pages.search.search', $params_template);
	}


	protected function getPostByTypeModule($type_module){

		$params['type'] =  array(Helpers::TYPE_POST_NEWS,Helpers::TYPE_POST_VIDEO);
		$params['view_index'] =  1;
		$params['with_post_at'] =  true;
		$params['display'] =  1;

		$total_post_v1 = 0;
		$total_post_v2 = 0;

		if($type_module == Helpers::TYPE_MODULE_ESTANDAR){
			$total_post_v1 = 6;
			$params['show_limit'] = array(6,0);
		}

		if($type_module == Helpers::TYPE_MODULE_MODULAR){
			$params['show_limit'] = array(21,0);
			$total_post_v1 = 9;
			$total_post_v2 = 12;
		}

		if($type_module == Helpers::TYPE_MODULE_LISTADO){
			$params['show_limit'] = array(18,0);
			$total_post_v1 = 8;
			$total_post_v2 = 10;
		}

		$dbl_last_post = Post::getPost($params)->get();

		$dbl_post_view1 = array();
		$dbl_post_view2 = array();

		foreach ($dbl_last_post as $dbr_last_post) {
			if(count($dbl_post_view1) < $total_post_v1){
				$dbl_post_view1[] = $dbr_last_post;
			}elseif(count($dbl_post_view2) < $total_post_v2){
				$dbl_post_view2[] = $dbr_last_post;
			}
		}

		$data['dbl_last_post'] = $dbl_post_view1;
		$data['dbl_more_post'] = $dbl_post_view2;

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
	}

}


<?php

class FrontendHomeController extends BaseController {


	public function home($type_module = null){

		$type_module = (empty($type_module) ? Helpers::TYPE_MODULE_ESTANDAR : $type_module);

		$params_template['dbl_last_post_featured_super'] = PostFeatured::GetFeaturedPost(Helpers::TYPE_POST_SUPER_FEATURED)->first();
		$params_template['dbl_last_post_featured_slider'] = PostFeatured::GetFeaturedPost(Helpers::TYPE_POST_SLIDER_FEATURED)->limit(5)->get();
		$params_template['dbl_last_post_video_featured'] = PostFeatured::GetFeaturedPost(Helpers::TYPE_VIDEO_FEATURED)->limit(5)->get();
		$params_template['dbr_post_cartelera'] = Post::getPostNews(array('type' => array(Helpers::TYPE_POST_CARTELERA), 'with_post_at' => true))->first();

		$type_module = Helpers::getTypeModule();

		$params_template = array_merge($params_template, $this->getPostByTypeModule($type_module));
		$params_template['type_module'] = $type_module;

		return View::make('frontend.pages.home.home', $params_template);
	}

	public function viewMoreNews(){

		$params['with_post_at'] =  true;
		$params['display'] =  1;

		$dbl_post = Post::getPostNews($params)->paginate(12)->route('frontend.post.more_news_paginate');

		$params_template['dbl_slider_more'] = Helpers::viewMoreSlider();
		$params_template['meter_likebox'] = array(300, 300);
		$params_template['title_text_search'] = 'Noticias';
		$params_template['dbl_post_search'] = $dbl_post;

		return View::make('frontend.pages.search.search', $params_template);
	}


	protected function getPostByTypeModule($type_module){

		//$params['type'] =  array(Helpers::TYPE_POST_NEWS,Helpers::TYPE_POST_VIDEO);
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

		$key = 'home';

		if (!Cache::has($key)) {
			$dbl_last_post = Cache::remember($key, 3, function() use ($params) {
				$dbl_last_post = Post::getPostNews($params)->get();

				return $dbl_last_post;
			});
		}else{
			$dbl_last_post = Cache::get($key);
		}

		$dbl_post_view1 = array();
		$dbl_post_view2 = array();
		$data_post_id = array();
		$limit_post_tags = 6;
		$last_tags = null;

		foreach ($dbl_last_post as $key => $dbr_last_post) {
			if($key <= $limit_post_tags){
				$data_post_id[] = $dbr_last_post->id;
			}

			if(count($dbl_post_view1) < $total_post_v1){
				$dbl_post_view1[] = $dbr_last_post;
			}elseif(count($dbl_post_view2) < $total_post_v2){
				$dbl_post_view2[] = $dbr_last_post;
			}
		}

		$key = 'home_tags_seo';

		if (!Cache::has($key)) {
			$dbr_last_tag = Cache::remember($key, 3, function() use ($data_post_id) {
				$dbr_last_tag = Post::getLastTag($data_post_id)->first();

				return $dbr_last_tag;
			});
		}else{
			$dbr_last_tag = Cache::get($key);
		}

		$last_tags = ucwords(strtolower($dbr_last_tag->tags_name));
		
		$data['title_page'] = Lang::get('messages.frontend.title_page', array('message' => 'Noticias Peru', 'tags' => $last_tags));
		$data['dbl_last_post'] = $dbl_post_view1;
		$data['dbl_more_post'] = $dbl_post_view2;

		return $data;
	}

}


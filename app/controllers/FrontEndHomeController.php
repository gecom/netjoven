<?php

class FrontendHomeController extends BaseController {


	public function home($type_module = null){

		$type_module = (empty($type_module) ? Helpers::TYPE_MODULE_ESTANDAR : $type_module);
		$type_module = Helpers::getTypeModule();

		$key = 'home_'.$type_module;

		if (!Cache::has($key)) {
			$params_template = Cache::remember($key, 3, function() use ($type_module) {
				$params_template['dbl_last_post_featured_super'] = PostFeatured::GetFeaturedPost(Helpers::TYPE_POST_SUPER_FEATURED)->first();
				$params_template['dbl_last_post_featured_slider'] = PostFeatured::GetFeaturedPost(Helpers::TYPE_POST_SLIDER_FEATURED)->limit(5)->get();
				$params_template['dbl_last_post_video_featured'] = PostFeatured::GetFeaturedPost(Helpers::TYPE_VIDEO_FEATURED)->limit(5)->get();
				$params_template['dbr_post_cartelera'] = Post::getPostNews(array('type' => array(Helpers::TYPE_POST_CARTELERA), 'with_post_at' => true))->first();


				$params_template = array_merge($params_template, $this->getPostByTypeModule($type_module));
				$params_template['type_module'] = $type_module;

				return $params_template;
			});
		}else{
			$params_template = Cache::get($key);
		}

		$banner_cuadrado = BannerHelper::getBanner(2);
		$pos = strpos($banner_cuadrado,'id="monsterbox"');
		$params_template['is_monsterbox'] = ($pos === false ? false : true);
		$params_template['banner_cuadrado']  = $banner_cuadrado;

		return View::make('frontend.pages.home.home', $params_template);
	}

	public function viewMoreNews($page = null){

		$params['with_post_at'] =  true;
		$params['display'] =  1;
		$key = 'view_more_news_'.$page;

		if (!Cache::has($key)) {
			$params_template = Cache::remember($key, 3, function() use ($params) {
				$dbl_post = Post::getPostNews($params)->paginate(12)->route('frontend.post.more_news_paginate');

				$params_template['dbl_post_search'] = $dbl_post->getItems();
				$params_template['dbl_post_search_links'] = (string) $dbl_post->links('frontend.pages.partials.paginator');

				$limit_post_tags = 6;
				$data_post_id = array();
				foreach ($dbl_post as $key => $dbr_post) {
					if($key <= $limit_post_tags){
						$data_post_id[] = $dbr_post->id;
					}else{
						break;
					}
				}

				$last_tags = null;
				if(count($data_post_id)){
					$dbr_last_tag = Post::getLastTag($data_post_id)->first();
					$last_tags = $dbr_last_tag ? ucwords(strtolower($dbr_last_tag->tags_name)) : null;
				}

				$params_template['last_tags'] = $last_tags;

				return $params_template;

			});
		}else{
			$params_template = Cache::get($key);
		}
		
		$params_template['title_page'] = Lang::get('messages.frontend.title_page', array('message' => 'Noticias Peru ' , 'tags' => $params_template['last_tags']));
		$params_template['dbl_slider_more'] = Helpers::viewMoreSlider();
		$params_template['meter_likebox'] = array(300, 300);
		$params_template['title_text_search'] = 'Noticias';

		return View::make('frontend.pages.search.search', $params_template);
	}


	protected function getPostByTypeModule($type_module){

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

		$dbl_last_post = Post::getPostNews($params)->get();

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

		$dbr_last_tag = Post::getLastTag($data_post_id)->first();
		$last_tags = $dbr_last_tag ? ucwords(strtolower($dbr_last_tag->tags_name)) : null;
		
		$data['title_page'] = Lang::get('messages.frontend.title_page', array('message' => 'Noticias Peru', 'tags' => $last_tags));
		$data['dbl_last_post'] = $dbl_post_view1;
		$data['dbl_more_post'] = $dbl_post_view2;

		return $data;
	}

}


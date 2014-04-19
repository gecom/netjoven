<?php

class FrontEndHomeController extends BaseController {

	public function home(){

		$params['type'] =  array(Helpers::TYPE_POST_NEWS,Helpers::TYPE_POST_VIDEO,Helpers::TYPE_POST_GALLERY);
		$params['view_index'] =  1;
		$params['with_post_at'] =  true;

		$params_template['dbl_last_post_featured_super'] = PostFeatured::getLastFeaturedSuper()->first();
		$params_template['dbl_last_post'] = Post::getPost($params)->paginate(6);
		$params_template['router_paginator'] = 'home_pagination';

		return View::make('frontend.pages.home.home', $params_template);
	}

}


?>
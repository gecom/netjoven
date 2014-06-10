<?php

class SitemapsController extends BaseController {


    public function index()
    {
        // Get a general sitemap.
		$sitemap = App::make("sitemap");
		$sitemap->setCache('laravel.sitemap-index', 3600);

		$sitemap->addSitemap(route('sitemap.netjoven'));
		$sitemap->addSitemap(route('sitemap.news'));
		$sitemap->addSitemap(route('sitemap.news.tag'));
		return $sitemap->render('sitemapindex');
    }

    public function netjoven(){

    	$sitemap_netjoven = App::make("sitemap");
    	$sitemap_netjoven->setCache('laravel.sitemap-netjoven', 3600);

    	$dbl_categories = Category::getParentCategoriesHome()->get();    	

		$sitemap_netjoven->add(route('/'), null, '0.8', 'hourly' );
    	foreach ($dbl_categories as $dbr_category) {
			$sitemap_netjoven->add(route('frontend.section.list', $dbr_category->slug), null, '0.7', 'hourly');
    	}

		return $sitemap_netjoven->render('xml');    
    }

    public function news(){
    	$sitemap_posts = App::make("sitemap");
    	$sitemap_posts->setCache('laravel.sitemap-news', 3600);

    	$params['with_post_at'] = true;
    	$params['show_limit'] = array(20000, 0);    	
    	$dbl_post = Post::getPostNews($params)->get();

		$i = 1;
    	foreach ($dbl_post as $dbr_post) {

			if($i < 20){
				$freq = 'always';
				$pri = '1.0';
			}else if($i < 50){
				$freq = 'daily';
				$pri = '0.8';
			}else{
				$freq = 'monthly';
				$pri = "0.".rand(3,5);
			}

			$sitemap_posts->add(route('frontend.post.view', array($dbr_post->category_parent_slug, $dbr_post->id, $dbr_post->slug)), $dbr_post->post_at, $pri, $freq);

    		$i++;
    	}

    	return $sitemap_posts->render('xml');  
    }

    public function newsTag(){

		$sitemap = App::make("sitemap");
		$sitemap->setCache('laravel.sitemap-tags', 3600);

		$params['with_post_at'] = true;
		$params['show_limit'] = array(50, 0);    	
		$dbl_post = Post::getPostNews($params)->get();
		$i = 0;

    	foreach ($dbl_post as $dbr_post) {

    		if($i < 20){
				$freq = 'always';
				$pri = '1.0';
			}else if($i < 50){
				$freq = 'daily';
				$pri = '0.8';
			}else{
				$freq = 'monthly';
				$pri = "0.".rand(3,5);
			}

			$sitemap->add(route('frontend.post.view', array($dbr_post->category_parent_slug, $dbr_post->id, $dbr_post->slug)), $dbr_post->post_at, $pri, $freq);
    	}

		return $sitemap->render('xml');  
    }

}


?>
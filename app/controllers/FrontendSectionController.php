<?php

class FrontendSectionController extends BaseController {

	public function listSection($slug, $keyword = '', $page = 1){

		$dbr_category = Category::getCategoryBySlug($slug)->first();

		if(!$dbr_category) App::abort(404);

		$dbr_post_featured_section = null;
		$params_template = $this->getListSection($dbr_category, $slug, $keyword, $page);
		$params_template['dbl_slider_more'] = Helpers::viewMoreSlider();

		if(empty($dbr_category->parent_id)){
			$dbr_post_featured_section = PostFeatured::GetFeaturedPost(Helpers::TYPE_POST_SECTION_FEATURED, $dbr_category->id)->first();
		}else{
			$dbr_post_featured_section = PostFeatured::GetFeaturedPost(Helpers::TYPE_POST_SUBSECTION_FEATURED, $dbr_category->id)->first();
		}

		$params_template['dbr_post_featured_section'] = $dbr_post_featured_section;

		if($slug == 'actualidad-fail-en-redes'){
			$params_template['meter_likebox'] = array(300, 286);
			return View::make('frontend.pages.section.section_fail_redes',$params_template);
		}

		if($slug == 'estilo-de-vida-horoscopo'){
			$params_template['meter_likebox'] = array(300, 500);
			return View::make('frontend.pages.section.section_horoscopo',$params_template);
		}

		if($params_template['is_parent_category']){
			return View::make('frontend.pages.section.section',$params_template);
		}else{
			return View::make('frontend.pages.section.subsection', $params_template);
		}

	}

	public function listDirectorate($args = null, $page = 1){

		$slug_url_current = Request::segment(1);
		$dbr_directory = Directorate::where('slug',  '=', $slug_url_current)->first();

		if(!$dbr_directory){
			App::abort(404);
		}

		$data_segments = array();
		if(!empty($args)){
			$data_segments = explode('/', $args);
		}

		$is_cerca_de_ti = false;
		$is_alfabetico = false;
		if(isset($data_segments[0]) && $data_segments[0] == 'cerca-de-ti'){
			$is_cerca_de_ti = true;
		}

		if(isset($data_segments[0]) && $data_segments[0] == 'alfabetico'){
			$is_alfabetico = true;
		}

		$params_template = $this->getListDirectoryPublications($dbr_directory,$data_segments, $page);
		$params_template['dbl_slider_more'] = Helpers::viewMoreSlider();
		$params_template['is_cerca_de_ti'] = $is_cerca_de_ti;
		$params_template['is_alfabetico'] = $is_alfabetico;
		$params_template['data_segments'] = $data_segments;

		return View::make('frontend.pages.directorate.directory_list', $params_template);

	}

	private function getListSection($dbr_category, $slug, $keyword = null, $page = 1) {

		$params_template = array();
		$categories_ids  = array();
		$is_parent_category = true;
		$total_post_v1 = 0;
		$total_post_v2 = 0;
		$total_post_v3 = 0;

		if(empty($dbr_category->parent_id)){
			$dbl_children_categories = $dbr_category->childrenCategories()->get();

			foreach ($dbl_children_categories as $dbr_children_category) {
				$categories_ids[] = $dbr_children_category->id;
			}

		}else{
			$is_parent_category = false;
			$categories_ids = array($dbr_category->id);
		}

		$params['display'] 		=  1;
		$params['category_id'] 	=  $categories_ids;
		$params['with_post_at'] =  true;

		$params_template['title_section'] = $dbr_category->name;
		$params_template['is_parent_category'] = $is_parent_category;
		$params_template['type_module'] = $type_module = Helpers::getTypeModule();

		if($is_parent_category){
			
			$params['type'] =  array(Helpers::TYPE_POST_NEWS, 
								Helpers::TYPE_POST_VIDEO,
								Helpers::TYPE_POST_HOROSCOPO,
								Helpers::TYPE_POST_PARANORMAL,
								Helpers::TYPE_POST_JUEGOS,
								Helpers::TYPE_POST_BLOGS,
							);

			if($type_module == Helpers::TYPE_MODULE_ESTANDAR){
				$params_template['meter_likebox'] = array(300, 286);
				$paginate = 14;
				$total_post_v1 = 2;
				$total_post_v2 = 3;
				$total_post_v3 = 9;
			}

			if($type_module == Helpers::TYPE_MODULE_MODULAR){
				$params_template['meter_likebox'] = array(300, 286);
				$paginate = 15;
				$total_post_v1 = 6;
				$total_post_v2 = 1;
				$total_post_v3 = 8;
			}

			if($type_module == Helpers::TYPE_MODULE_LISTADO){
				$params_template['meter_likebox'] = array(457, 261);
				$paginate = 18;
				$total_post_v1 = 6;
				$total_post_v2 = 8;
				$total_post_v3 = 4;
			}
		}else{
			if(!in_array($slug, array('actualidad-fail-en-redes', 'estilo-de-vida-horoscopo'))){
				if($type_module == Helpers::TYPE_MODULE_ESTANDAR){
					$params_template['meter_likebox'] = array(300, 286);
					$paginate = 6;
					$total_post_v1 = 6;
				}

				if($type_module == Helpers::TYPE_MODULE_MODULAR){
					$params_template['meter_likebox'] = array(300, 286);
					$paginate = 15;
					$total_post_v1 = 6;
					$total_post_v2 = 8;
					$total_post_v3 = 1;
				}

				if($type_module == Helpers::TYPE_MODULE_LISTADO){
					$params_template['meter_likebox'] = array(457, 261);
					$paginate = 18;
					$total_post_v1 = 6;
					$total_post_v2 = 8;
					$total_post_v3 = 4;
				}
			}else{
				$paginate = 12;
			}
		}

		$key = 'post_' . $dbr_category->slug . '__' . $keyword . '_' . $type_module . '_' . $page;

		if (!Cache::has($key)) {
			$dbl_post = Cache::remember($key, 3, function() use ($params, $paginate, $keyword, $slug) {

				$dbl_post = Post::getPostNews($params)
					->paginate($paginate)
					->route('frontend.section.pagination', array($slug));

				return ['list' => $dbl_post->getItems(), 'links' => (string) $dbl_post->links('frontend.pages.partials.paginator')];
			});

		}else{
			$dbl_post = Cache::get($key);
		}

		$dbl_post_view1 = array();
		$dbl_post_view2 = array();
		$dbl_post_view3 = array();
		$limit_post_tags = 6;
		$data_post_id = array();

		if($total_post_v1 || $total_post_v2 || $total_post_v3){
			foreach ($dbl_post['list'] as $key => $dbr_post) {
				if($key <= $limit_post_tags){
					$data_post_id[] = $dbr_post->id;
				}

				if(count($dbl_post_view1) < $total_post_v1){
					$dbl_post_view1[] = $dbr_post;
				}elseif(count($dbl_post_view2) < $total_post_v2){
					$dbl_post_view2[] = $dbr_post;
				}else{
					$dbl_post_view3[] = $dbr_post;
				}
			}

			$params_template['dbl_post_view1'] = $dbl_post_view1;
			$params_template['dbl_post_view2'] = $dbl_post_view2;
			$params_template['dbl_post_view3'] = $dbl_post_view3;

		}else{
			$params_template['dbl_post_view'] = $dbl_post['list'];

			foreach ($dbl_post['list'] as $key => $dbr_post) {
				if($key <= $limit_post_tags){
					$data_post_id[] = $dbr_post->id;
				}else{
					break;
				}
			}
		}

		$last_tags = null;
		if(count($data_post_id)){
			$dbr_last_tag = Post::getLastTag($data_post_id)->first();
			$last_tags = $dbr_last_tag ? ucwords(strtolower($dbr_last_tag->tags_name)) : null;
		}
		
		$params_template['title_page'] = Lang::get('messages.frontend.title_page', array('message' => 'Noticias ' . $dbr_category->name , 'tags' => $last_tags));
		$params_template['dbl_post_links'] = $dbl_post['links'];

		return $params_template;
	}

	private function getListDirectoryPublications($dbr_directory, $data_segments, $page = 1){


		$keyword = null;
		if(isset($data_segments[0])){
			$keyword = $data_segments[0];
		}

		$key = 'directory_' . $dbr_directory->slug  . '_' . implode('_', $data_segments) . '_'.  $page;

		if (!Cache::has($key)) {
			$dbl_directory_publications = Cache::remember($key, 5, function() use ($dbr_directory, $data_segments, $keyword) {

				$params['status'] = array(Status::STATUS_ACTIVO);
				$params['id'] = $dbr_directory->id;

				if(in_array(strtoupper($keyword), array(Helpers::TYPE_BINGE_BAR, Helpers::TYPE_BINGE_DISCOTECA, Helpers::TYPE_BINGE_LOUNGES))){
					$params['type'] = strtoupper($keyword);
				}

				switch ($keyword) {
					case 'alfabetico':
						$filter = 'A';
						if(isset($data_segments[1]) && isset($data_segments[2])){
							if(in_array(strtoupper($data_segments[1]), array(Helpers::TYPE_BINGE_BAR, Helpers::TYPE_BINGE_DISCOTECA, Helpers::TYPE_BINGE_LOUNGES))){
								$params['type'] = strtoupper($data_segments[1]);
							}

							$pos = strpos($data_segments[2], ':');
							if($pos === false){
								$filter = 'A';
							}else{
								$filter = str_replace(':', '', $data_segments[2]);
							}

						}else{
							if(isset($data_segments[1])){
								if(in_array(strtoupper($data_segments[1]), array(Helpers::TYPE_BINGE_BAR, Helpers::TYPE_BINGE_DISCOTECA, Helpers::TYPE_BINGE_LOUNGES))){
									$params['type'] = strtoupper($data_segments[1]);
								}else{
									$pos = strpos($data_segments[1], ':');
									if($pos === false){
										$filter = 'A';
									}else{
										$filter = str_replace(':', '', $data_segments[1]);
									}
								}
							}else{
								$filter = 'A';
							}
						}

						$params['letter'] = $filter;
						break;
					case 'cerca-de-ti':
						$filter = 26;
						if(isset($data_segments[1]) && isset($data_segments[2])){
							if(in_array(strtoupper($data_segments[1]), array(Helpers::TYPE_BINGE_BAR, Helpers::TYPE_BINGE_DISCOTECA, Helpers::TYPE_BINGE_LOUNGES))){
								$params['type'] = strtoupper($data_segments[1]);
							}

							$search_neo = array_reverse(explode("-",$data_segments[2]));
							$filter = intval($search_neo[0]);

						}else{
							if(isset($data_segments[1])){
								if(in_array(strtoupper($data_segments[1]), array(Helpers::TYPE_BINGE_BAR, Helpers::TYPE_BINGE_DISCOTECA, Helpers::TYPE_BINGE_LOUNGES))){
									$params['type'] = strtoupper($data_segments[1]);
								}else{
									$search_neo = array_reverse(explode("-",$data_segments[1]));
									$filter = intval($search_neo[0]);
								}
							}
						}

						$params['district_id'] = $filter;
						break;
					default:
						$params['title'] = $keyword;
						break;
				}

				$dbl_directory_publications = DirectoryPublication::getPublicationsByDirectoryId($params)
									->paginate(10)
									->useCurrentRoute()
									->pagesProximity(3);				

				return ['list' => $dbl_directory_publications->getItems(), 'links' => (string) $dbl_directory_publications->links('frontend.pages.partials.paginator')];
			});

		}else{
			$dbl_directory_publications = Cache::get($key);
		}

		$limit_post_tags = 6;
		$data_post_id = array();
		foreach ($dbl_directory_publications['list'] as $key => $dbr_publication) {
			if($key <= $limit_post_tags){
				$data_post_id[] = $dbr_publication->title;
			}else{
				break;
			}
		}

		$params_template['title_page'] = Lang::get('messages.frontend.title_page', array('message' => $dbr_directory->title .' '. implode(' ', $data_segments) , 'tags' => implode(',', $data_post_id)));
		$params_template['meter_likebox'] = array(300, 286);
		$params_template['dbl_district'] = Helpers::getDistrict();
		$params_template['is_juerga'] = ($dbr_directory->id == 2 ? true : false );
		$params_template['dbr_directory'] = $dbr_directory;
		$params_template['dbl_directory_publications'] = $dbl_directory_publications['list'];
		$params_template['dbl_directory_publications_links'] = $dbl_directory_publications['links'];

		return $params_template;
	}

	public function redirectTag($slug, $keyword = null){

		$dbr_category = Category::getCategoryBySlug($slug)->where('parent_id')->first();
		if(empty($keyword) || !$dbr_category ){
			App::abort(404);
		}

		return Redirect::route('frontend.post.tags', array($keyword), 301);
	}

	public function searchPost($keyword = null){

		if(empty($keyword)){
			App::abort(404);
		}

		$text_search = Helpers::cleanStopWords($keyword);

		$result = SphinxSearch::search($text_search)
		->setMatchMode(\Sphinx\SphinxClient::SPH_MATCH_EXTENDED2)
		->setSortMode(\Sphinx\SphinxClient::SPH_SORT_EXTENDED, "post_id DESC")
		->get();

		$data_post_id = array();
		$dbl_post_search = null;

		if($result){
			if ( ! empty($result["matches"]) ){
				foreach ($result['matches'] as $matches) {
					$data_post_id[] = $matches['attrs']['post_id'];
				}
			}
		}

		if(count($data_post_id) > 0){
			$params['with_post_at'] =  true;
			$params['id'] =  $data_post_id;
			$dbl_post_search = Post::getPostNews($params)->paginate(12)->route('frontend.post.search.pagination', array($keyword));
		}

		if(!empty($dbl_post_search)){
			$params_template['dbl_post_search'] = $dbl_post_search;
			$params_template['dbl_post_search_links'] = (string) $dbl_post_search->links('frontend.pages.partials.paginator');
		}else{
			$params_template['message'] = 'Su búsqueda no produjo ningún resultado';
		}

		$params_template['title_page'] = $text_search .'| Noticias '. $text_search;
		$params_template['meter_likebox'] = array(300, 300);
		$params_template['title_text_search'] = $text_search;
		$params_template['dbl_slider_more'] = Helpers::viewMoreSlider();

		return View::make('frontend.pages.search.search', $params_template);
	}

	public function searchTag($keyword = null, $page = 1){

		if(empty($keyword)){
			App::abort(404);
		}

		$text_search = Helpers::cleanStopWords($keyword);
		$key = 'search_tag_' . $keyword .'_'. $page;

		if (!Cache::has($key)) {
			$dbl_post_search = Cache::remember($key, 3, function() use ($text_search) {
				$dbl_post_search = Search::getPostTags($text_search)->paginate(12)->route('frontend.post.tags.pagination', array($text_search));

				return ['list' => $dbl_post_search->getItems(), 'links' => (string) $dbl_post_search->links('frontend.pages.partials.paginator')];
			});

		}else{
			$dbl_post_search = Cache::get($key);
		}

		if(!empty($dbl_post_search)){
			$params_template['dbl_post_search'] = $dbl_post_search['list'];
			$params_template['dbl_post_search_links'] = $dbl_post_search['links'];
		}else{
			$params_template['message'] = 'Su búsqueda no produjo ningún resultado';
		}


		$params_template['title_page'] = $text_search .'| Noticias '. $text_search;
		$params_template['meter_likebox'] = array(300, 300);
		$params_template['title_text_search'] = $text_search;
		$params_template['dbl_slider_more'] = Helpers::viewMoreSlider();

		return View::make('frontend.pages.search.search', $params_template);
	}

	public function viewPost($slug_category, $post, $slug){

		$http_referer = Request::server('HTTP_REFERER');
		$key = 'dbl_post_view_' . $post;

		if (!Cache::has($key)) {
			$data_params = Cache::remember($key, 240, function() use ($post) {
				$dbr_post = Post::getPostById($post)->first();

				if(!$dbr_post){
					App::abort(404);
				}

				$dbr_post_gallery = ($dbr_post->has_gallery ? $dbr_post->galleries()->select('image', 'title')->where('is_gallery', '=', 1)->first() : null);
				$dbr_post->content = Helpers::bbcodes($dbr_post->content);

				$params_template['meter_likebox'] = array(300, 300);
				$params_template['dbr_post'] = $dbr_post;
				$params_template['title_page'] = $dbr_post->title;
				$params_template['description'] = Helpers::getDescriptionPost($dbr_post->content);
				$params_template['dbr_post_gallery'] = $dbr_post_gallery;
				$params_template['dbr_redactor'] = UserHelper::getUserRedactor($dbr_post->user_id);

				return $params_template;
			});
		}else{
			$data_params = Cache::get($key);
		}

		$dbr_post = $data_params['dbr_post'];
		App::instance('singleton_dbr_post', $dbr_post);

		$dbr_user_login = Auth::check() ? Auth::User() : null;

		if(!$dbr_user_login || ($dbr_user_login && $dbr_user_login->level == UserHelper::LEVEL_USER_NORMAL)){
			Post::updateCounterRead($dbr_post->id);			
		}

		$params_template = $data_params;
		$params_template['redirect'] = ($http_referer ? $http_referer : route('home')) ;
		$params_template['dbl_slider_more'] = Helpers::viewMoreSlider($data_params['dbr_post']);

		return View::make('frontend.pages.section.post_view', $params_template);
	}

	public function viewDirectoryPublication($directory_publication, $slug){

		$slug_url_current = Request::segment(1);
		$dbr_directory = Directorate::where('slug',  '=', $slug_url_current)->first();

		if(!$dbr_directory || !$directory_publication || ($directory_publication->slug != $slug)){
			App::abort(404);
		}

		$http_referer = Request::server('HTTP_REFERER');
		$key = 'dbl_directory_publication__' . $directory_publication->id;


		if (!Cache::has($key)) {
			$data_params = Cache::remember($key, 3, function() use ($directory_publication, $dbr_directory) {
				$params['meter_likebox'] = array(300, 300);
				$params['dbr_directory_publication'] = $directory_publication;
				$params['dbr_directory'] = $dbr_directory;
				$params['dbl_slider_more'] = Helpers::viewMoreSlider();

				return $params;
			});
		}else{
			$data_params = Cache::get($key);
		}		

		$params_template = $data_params;
		$params_template['title_page'] = $directory_publication->title;
		$params_template['redirect'] = ($http_referer ? $http_referer : route('home')) ;

		return View::make('frontend.pages.directorate.directory_view', $params_template);
	}

	public function viewPostGallery($post){
		if(!$post){
			App::abort(404);
		}

		$dbr_post = $post;
		$key = 'dbr_post_gallery_' . $dbr_post->id;

		if (!Cache::has($key)) {
			$dbl_post_gallery = Cache::remember($key, 240, function() use ($dbr_post) {
				return $dbr_post->galleries()
					->select('image', 'title')
					->where('is_gallery', '=', 1)->get();
			});

		}else{
			$dbl_post_gallery = Cache::get($key);
		}

		if(Request::ajax()){
			return View::make('frontend.pages.partials.post_gallery',array('dbl_post_gallery'=>$dbl_post_gallery))->render();
		}

	}

	public function radio(){
		$params_template['meter_likebox'] = array(300, 300);
		$params_template['is_mobile'] = (Agent::isMobile() || Agent::isTablet() ? true : false);
		$params_template['title_page'] = 'Radio En Vivo - Netjoven Radio - Música Online';
		$params_template['description'] = 'Escucha nuestra Netjoven Radio En Vivo que tiene la Mejor Música Online del Pop, Pachanga, Hip-Hop, Electro-Pop, Latin y Rock en Inglés y Español.';
		return View::make('frontend.pages.section.radio', $params_template);
	}

	public function shortUrlPosting($id){
		$post_id = substr($id, 0,15);
		$post_id = base_convert($post_id,36,10);

		$dbr_post = Post::getPostById($post_id)->first();

		if(!$dbr_post){
			App::abort(404);			
		}

		return Redirect::route('frontend.post.view', array($dbr_post->category_parent_slug, $dbr_post->id, $dbr_post->slug), 301);
	}

}


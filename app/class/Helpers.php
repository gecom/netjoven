<?php

class Helpers {

	const TYPE_POST_NEWS 		= 'NOTA';
	const TYPE_POST_VIDEO		= 'VIDEO';
	const TYPE_POST_CARTELERA  	= 'CARTELERA';
	const TYPE_POST_HOROSCOPO 	= 'HOROSCOPO';
	const TYPE_POST_PARANORMAL 	= 'PARANORMAL';
	const TYPE_POST_JUEGOS     	= 'JUEGOS';
	const TYPE_POST_BLOGS      	= 'BLOGS';
	const TYPE_POST_FAIL       	= 'FAIL';

	const TYPE_BINGE_BAR 		= 'BAR';
	const TYPE_BINGE_DISCOTECA 	= 'DISCOTECAS';
	const TYPE_BINGE_LOUNGES 	= 'LOUNGE';

	const TYPE_VIDEO_YOUTUBE 		= 'Y';
	const TYPE_VIDEO_DAILYMOTION 	= 'D';

	const TYPE_POST_SUPER_FEATURED 		= 'S';
	const TYPE_POST_SLIDER_FEATURED 	= 'SL';
	const TYPE_POST_SECTION_FEATURED 	= 'SE';
	const TYPE_POST_SUBSECTION_FEATURED	= 'SSE';
	const TYPE_VIDEO_FEATURED 			= 'V';

	const TYPE_MODULE_ESTANDAR	= 'E';
	const TYPE_MODULE_MODULAR 	= 'M';
	const TYPE_MODULE_LISTADO	= 'L';

	public static $prefix_table	= 'njv_';
	public static $extension 	= '.jpg';

	public static $type_video = array(
		self::TYPE_VIDEO_YOUTUBE => 'Youtube',
		self::TYPE_VIDEO_DAILYMOTION => 'Dailymotion'
	);

	public static $type_featured_post = array(
		self::TYPE_POST_SUPER_FEATURED => 'Super Destacado',
		self::TYPE_POST_SLIDER_FEATURED => 'Destacado Slider',
		self::TYPE_POST_SECTION_FEATURED => 'Destacado Sección',
		self::TYPE_POST_SUBSECTION_FEATURED => 'Destacado Subsección'
	);

	public static $type_module_status = array(
		self::TYPE_MODULE_ESTANDAR => 'Estandar',
		self::TYPE_MODULE_MODULAR => 'Modular',
		self::TYPE_MODULE_LISTADO => 'Listado',
	);

	public static function createDir($directory){

		if (!file_exists($directory)) {
			mkdir($directory, 0777);
			chmod($directory,  0777);
		}

	}

	public static function getCategoriesHome(){
		$dbl_parent_categories = Category::getParentCategoriesHome()->get();
		$categories = array();

		foreach ($dbl_parent_categories as $dbr_category) {
			$category = $dbr_category->toArray();
			$category['children_category'] = $dbr_category->childrenCategories()->where('is_menu', '=', 1)->get()->toArray();

			$categories[] = $category;
		}

		return $categories;

	}

	public static function getTagsByPost($post){

		$dbl_post = $post->tags()->get();
		$data_tags = array();

		foreach ($dbl_post as $dbr_post) {
			$data_tags[] = $dbr_post->tag;
		}

		return $data_tags;
	}

	public static function sidebarBackend(){

		$data_sidebar = array(
			array('name' => 'Dashboard', 'class'=>'fa-dashboard', 'url' => url('/backend') ),
			array('name' => 'Estadisticas', 'class'=>'fa-bar-chart-o', 'url' => '#',
				'subcategories'=> array(
						array('name' => 'Noticias', 'url' => url('backend/estadisticas/noticias')),
						array('name' => 'Categorias', 'url' => url('backend/estadisticas/categorias')),
						array('name' => 'Redactores', 'url' => url('backend/estadisticas/redactores'))
					)
			),
			array('name' => 'Administrar Banners', 'class'=>'fa-table', 'url' => '#' ,
					'subcategories'=> array(
						array('name' => 'Banners', 'url' => url('backend/banners')),
						array('name' => 'Detalle de Banners', 'url' => url('backend/detalle_banners'))
					)
			),
			array('name' => 'Publicaciones', 'class'=>'fa-table', 'url' => '#',
				'subcategories'=> array(
						array('name' => 'Noticias', 'url' => url('backend/publicaciones/' . mb_strtolower(self::TYPE_POST_NEWS))),
						array('name' => 'Videos', 'url' => url('backend/publicaciones/' . mb_strtolower(self::TYPE_POST_VIDEO))),
						array('name' => 'Fail en Redes', 'url' => url('backend/publicaciones/' . mb_strtolower(self::TYPE_POST_FAIL))),
						array('name' => 'Juegos', 'url' => url('backend/publicaciones/' . mb_strtolower(self::TYPE_POST_JUEGOS))),
						array('name' => 'Blogs', 'url' => url('backend/publicaciones/' . mb_strtolower(self::TYPE_POST_BLOGS))),
						array('name' => 'Cartelera', 'url' => url('backend/publicaciones/' . mb_strtolower(self::TYPE_POST_CARTELERA))),
						array('name' => 'Horoscopo', 'url' => url('backend/publicaciones/' . mb_strtolower(self::TYPE_POST_HOROSCOPO))),
						array('name' => 'Paranormal', 'url' => url('backend/publicaciones/' . mb_strtolower(self::TYPE_POST_PARANORMAL))),
						array('name' => 'Fotos', 'url' => url('backend/fotos'))
					)
			),
			array('name' => 'Directorio', 'class'=>'fa-table', 'url' => '#',
					'subcategories'=> array(
						array('name' => 'Pichanga', 'url' => url('backend/directorio/1/pichanga')),
						array('name' => 'Juerga', 'url' => url('backend/directorio/2/juerga'))
					)
			),
			array('name' => 'Categorias', 'class'=>'fa-table', 'url' => url('backend/categorias') ),
			array('name' => 'Temas del Día', 'class'=>'fa-table', 'url' => url('backend/temas_del_dia') ),
			array('name' => 'Usuarios', 'class'=>'fa-wrench', 'url' => '#' )
		);

		return $data_sidebar;
	}


	public static $size_images = array(
			'featured' 					=> array('width' => 935, 'height' => 393),
			'featured_slider' 			=> array('width' => 623, 'height' => 398),
			'featured_section_standar'	=> array('width' => 612, 'height' => 383),
			'featured_section_module'	=> array('width' => 250, 'height' => 155),
			'content' 					=> array('width' => 500, 'height' => 500),
			'fail_redes' 				=> array('width' => 530, 'height' => 400),
			'gallery' 					=> array('width' => 600, 'height' => 374),
			'category' 					=> array('width' => 216, 'height' => 265),
			'video_featured'			=> array('width' => 500, 'height' => 300),
			'view'						=> array('width' => 300, 'height' => 187),
			'view_thumb' 				=> array('width' => 160, 'height' => 160),
			'directory' 				=> array('width' => 194, 'height' => 120)
	);

	public static function uploadImage($file, $new_name = null ,$path = null, $data_size = array(), $generate_thumbnail = false,$max_size = array(2000, 1024)){

		$path_upload = Config::get('settings.upload') . $path;
		$valid_exts = array('jpeg', 'jpg'); // valid extensions
		$max_size = $max_size[0] * $max_size[1]; // max file size (200kb)

		if ( $_SERVER['REQUEST_METHOD'] === 'POST' )
        {
            $ext = $file->guessClientExtension();
            $size = $file->getClientSize();
            $name = $file->getClientOriginalName();

            if (in_array($ext, $valid_exts) AND $size < $max_size){

                if(self::saveImage($file, $path_upload, $new_name, $data_size)){
                	if($generate_thumbnail){
                		self::saveImage($file, $path_upload . "pp/", $new_name, self::$size_images['view_thumb']);
                		$response['filename_thumb'] = Config::get('settings.urlupload') . $path . 'pp/'. $new_name;
                	}

                    $response['message'] = 'Imagen subida satisfactoriamente';
                    $response['success'] = true;
                    $response['filename'] = Config::get('settings.urlupload') . $path . $new_name;
                    $response['name'] = $new_name;

                }else {
                    $response['errors'] = ['Upload Fail: Unknown error occurred!'];
                    $response['success'] = false;
                }
            }else {
                $response['errors'] = ['Upload Fail: Unsupported file format or It is too large to upload!'];
                $response['success'] = false;
            }
        }else {
            $response['errors'] = ['Bad request!'];
            $response['success'] = false;
        }

        return $response;
	}

	public static function saveImage($file, $path = null, $name = null, $size = array()){
        $image = Image::make($file->getRealPath());

        if(count($size) == 0){
        	return false;
        }

        if($image->resize($size['width'], $size['height'], function($constraint){
        	 $constraint->aspectRatio();
        	 $constraint->upsize();
        })->save($path . $name)){
        	$image->destroy();
        	return true;
        }

        return false;
    }

    public static function cropImage($path, $data_pos){
		$img = Image::make($path);

		$data_pos['width'] = intval($data_pos['width']);
		$data_pos['height'] = intval($data_pos['height']);
		$data_pos['x'] = intval($data_pos['x']);
		$data_pos['y'] = intval($data_pos['y']);

		$img->crop($data_pos['width'], $data_pos['height'], $data_pos['x'], $data_pos['y']);

		if($img->save($path)){
			return true;
		}

		return false;
    }

	public static function intervalDate($init,$finish){
		//formateamos las fechas a segundos tipo 1374998435
		$difference = strtotime($finish) - strtotime($init);

		//comprobamos el tiempo que ha pasado en segundos entre las dos fechas
		//floor devuelve el número entero anterior, si es 5.7 devuelve 5
		if($difference < 60){
			$time = "Hace " . floor($difference) . " seg";
		}else if($difference > 60 && $difference < 3600){
			$time = "Hace " . floor($difference/60) . " min'";
		}else if($difference > 3600 && $difference < 86400){
			$time = "Hace " . floor($difference/3600) . " horas";
		}else if($difference > 86400 && $difference < 2592000){
			$time = "Hace " . floor($difference/86400) . " días";
		}else if($difference > 2592000 && $difference < 31104000){
			$time = "Hace " . floor($difference/2592000) . " meses";
		}else if($difference > 31104000){
			$time = "Hace " . floor($difference/31104000) . " años";
		}else{
			$time = "Error";
		}

		return $time;
	}

	public static function getThumbnailYoutubeByIdVideo($id_video, $quality = '0')
	{
		return 'http://img.youtube.com/vi/' . $id_video . '/' . $quality . '.jpg';
	}

	public static function getDateFormat($date, $format = 'd/m/Y H:i')
	{
		$date = date_create($date);
		return date_format($date, $format);
	}

	public static function changeToMysql($date)
	{
		$date_format = date_parse_from_format ( 'd/m/Y H:i' , $date );

		return $date_format['year'] .'/'.$date_format['month'].'/'.$date_format['day'] . ' '. $date_format['hour'] .':'.$date_format['minute'];
	}

	/**
	*  retorna la direccion IP de la PC cliente.
	*/
	public static function getClientIp()
	{
		$v = '';

		//bifurcador ternario
		$v =  (!empty($_SERVER['REMOTE_ADDR']))? $_SERVER['REMOTE_ADDR'] :((!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) ? $_SERVER['HTTP_X_FORWARDED_FOR']: @getenv('REMOTE_ADDR'));

		if(isset($_SERVER['HTTP_CLIENT_IP']))
		{
			$v = $_SERVER['HTTP_CLIENT_IP'];
		}
		return htmlspecialchars($v,ENT_QUOTES);
	}

	public static function getCountryData(){

		$ip_num = sprintf("%u",ip2long(self::getClientIp()));

		$key = "dbr_country_data_" . $ip_num;

		if (!Cache::has($key)) {

			$dbr_country_data = DB::table('njv_ip2c')
						->select('country_code','country_name')
						->whereRaw('"'.$ip_num.'" BETWEEN begin_ip_num AND end_ip_num')
						->first();

			Cache::forever($key, $dbr_country_data);
		}

		$dbr_country_data = Cache::get($key);

		return $dbr_country_data;
	}


	public static function getCountrycode(){

		$dbr_country_data = self::getCountryData();



		$country_code = null;
		if(Cookie::has('country_code')){
			$country_code = Cookie::get('country_code');
		}

		if(!$country_code){
			if(!$dbr_country_data){
				$country_code = 'PE';
			}else{
				$country_code = $dbr_country_data->country_code;
			}

			$time_minutes_cookie = time() + 31536000;
			Cookie::queue('country_code', $country_code, $time_minutes_cookie);
		}

		return $country_code;
	}

	public static function urlExists($url){
		$ch = @curl_init($url);
		@curl_setopt($ch, CURLOPT_HEADER, TRUE);
		@curl_setopt($ch, CURLOPT_NOBODY, TRUE);
		@curl_setopt($ch, CURLOPT_FOLLOWLOCATION, FALSE);
		@curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
		$status = array();
		preg_match('/HTTP\/.* ([0-9]+) .*/', @curl_exec($ch) , $status);

		return ($status[1] == 200);
	}


	public static function getImage($name, $path){

		if(!empty($name)){
			$url = Config::get('settings.urlupload') . $path . '/' . $name;

			if(self::urlExists($url)){
				return $url;
			}
		}

		return Config::get('settings.urlupload') . 'images_default' . '/' . 'netjoven_default.jpg';
	}

	public static function getPathImage($name, $path){

		$filename = Config::get('settings.upload') . $path . DIRECTORY_SEPARATOR . $name;

		if(file_exists($filename)){
			return $filename;
		}

		return false;
	}

	public static function prepareContent($content, $category_id = null){
		preg_match_all("#\[tag\](.*?)\[/tag\]#si", $content , $matches);

		foreach($matches[1] as $value){
			$url = route('frontend.post.tags', array(Str::slug($value))) ;
			$pre_replace = '[tag='.$url.']'.$value.'[/tag]';
			$content =  preg_replace("#\[tag\]$value\[/tag\]#si", $pre_replace , $content);
		}

		return $content;
	}

	public static function getDescriptionPost($content){

		$content = preg_replace("/<img[^>]+\>/i", "", $content);
		if(empty($content)){return '';}

		$article = explode("<br />", $content);
		if(count($article)){
			$i = 0;
			while($i < count($article)){

				if(isset($article[$i])){
					$html = $article[$i];
					$html_reg = '/<+\s*\/*\s*([A-Z][A-Z0-9]*)\b[^>]*\/*\s*>+/i';
					$content_html = htmlentities( preg_replace( $html_reg, '', $html ) );

					if(trim($content_html) !='' && strpos($content_html , "Foto:") === FALSE){
						$caracteres = array("&amp;aacute;","&amp;eacute;","&amp;iacute;","&amp;oacute;","&amp;uacute;","&amp;Aacute;",
						"&amp;Eacute;","&amp;Iacute;","&amp;Oacute;","&amp;Uacute;","&amp;ntilde;","&amp;Ntilde;","&aacute;","&eacute;","&iacute;","&oacute;","&uacute;","&Aacute;",
						"&Eacute;","&Iacute;","&Oacute;","&Uacute;","&ntilde;","&Ntilde;");
						$normales   = array("á","é","í","ó","ú","Á","É","Í","Ó","Ú","ñ","Ñ","á","é","í","ó","ú","Á","É","Í","Ó","Ú","ñ","Ñ");
						return str_replace($caracteres, $normales , $content_html);
					}

					$i++;
				}
			}
		}

		return '';
	}

	public static function getTagIds($data_tags, $is_return_ids = true){
		$data_return_tags = array();
		foreach ($data_tags as $tag) {
			$tag = trim($tag);
			$dbr_tag = Tag::where('slug',Str::slug($tag))->first();

			if(!$dbr_tag){
				$dbr_tag = new Tag();
				$dbr_tag->tag = $tag;
				$dbr_tag->slug = $tag;
				$dbr_tag->save();
			}

			$data_return_tags[] = ($is_return_ids ? $dbr_tag->id : $dbr_tag->tag);
		}

		return $data_return_tags;
	}

	public static function getPostGalleryByPost($post, $where = array('is_principal', 1)){
 		$dbl_post_gallery = $post->galleries()->where($where[0],$where[1])->get();

 		$data_post_gallery = array();
		foreach ($dbl_post_gallery as $dbr_post_gallery) {
			$file_exists_image = Helpers::getPathImage($dbr_post_gallery->image, 'noticias');

			$data_post_gallery[sha1_file($file_exists_image)] = $dbr_post_gallery;
		}

		return $data_post_gallery;
	}

	public static function getDistrict(){
		$dbl_district = DB::select("SELECT id, id_city, district, link_uri, place FROM  njv_district ORDER BY district");
		return $dbl_district;
	}


	public static function getTagByKeyword($keyword, $limit){
		$dbl_tags = DB::select("SELECT tag FROM njv_tag WHERE tag LIKE '%".$keyword."%' LIMIT $limit");
		return $dbl_tags;
	}


	public static function viewMoreSlider($dbr_post = null){

		$key = 'slider_more_section'. ($dbr_post ? $dbr_post->id : '');

		if (!Cache::has($key)) {
			$dbl_slider_more = Cache::remember($key, 240, function() use($dbr_post){
				if(!empty($dbr_post->category_id)){
					$params['category_id'] = $dbr_post->category_id;
					$dbr_slider_more['related'] 	= self::getMoreSlider(array('tags' => $dbr_post->tags));
				}else{
					$dbr_slider_more['more_read'] 		= self::getMoreSlider(array('order_read' => true));
				}

				$dbr_slider_more['more_commented'] 	= self::getMoreSlider(array('order_commented' => true));
				$dbr_slider_more['more_shared'] 	= self::getMoreSlider(array('order_shared' => true));
				$dbr_slider_more['has_gallery'] 	= self::getMoreSlider(array('has_gallery' => true));
				$dbr_slider_more['has_video'] 		= self::getMoreSlider(array('has_video' => true));

				return $dbr_slider_more;
			});

		}else{
			$dbl_slider_more = Cache::get($key);
		}


		return $dbl_slider_more;

	}

	public static function getTypeModule(){
		if(Auth::check()){
			$dbr_user_tool = self::getUserTool();

			if($dbr_user_tool && $dbr_user_tool->type_module){
				return $dbr_user_tool->type_module;
			}

			return self::TYPE_MODULE_ESTANDAR;
		}else{
			if(Cookie::has('type_module')){
				return Cookie::get('type_module');
			}else{
				return self::TYPE_MODULE_ESTANDAR;
			}
		}
	}

	public static function getUserTool(){
		return Auth::user()->userTool()->first();
	}

	public static function getColorCurrent(){
		if(Auth::check()){
			$dbr_user_tool = self::getUserTool();

			if(!$dbr_user_tool){
				return ColorPalette::where('is_default', '=', 1)->first()->color;
			}else{
				return ColorPalette::where('id', '=', $dbr_user_tool->color_palette_id)->first()->color;
			}

		}else{
			return ColorPalette::where('is_default', '=', 1)->first()->color;
		}
	}

	public static function  bbcodes($content){

		$pattern[0] = "#\[video\](.*?)\[/video\]#si";
		$pre_replace[0] = '<div class="video-container">
		<object width="455" height="344">
		<param name="movie" value="http://www.youtube.com/v/\1&hl=es&fs=1&showinfo=0&rel=0&"></param>
		<param name="allowFullScreen" value="true"></param>
		<param name="allowscriptaccess" value="always"></param>
		<param name="wmode" value="transparent"></param>
		<embed src="http://www.youtube.com/v/\1&hl=es&fs=1&showinfo=0&rel=0&" type="application/x-shockwave-flash" allowscriptaccess="always" wmode="transparent" allowfullscreen="true" width="580" height="350"></embed>
		</object>
		</div>';

		$pattern[1] = '#<span style="font-weight: bold;">(.*?)</span>#si';
		$pre_replace[1] = '<strong>\1</strong>';

		$pattern[2] = '#\[en\=(.*?)\](.*?)\[\/en\]#si';
		$pre_replace[2] = '<a href="\1" title="\2"><strong class="custom_color_text">\2</strong></a>';

		$pattern[3] = '#\[tag\=(.*?)\](.*?)\[\/tag\]#si';
		$pre_replace[3] = '<a href="\1" title="\2"><strong class="custom_color_text">\2</strong></a>';

		$content = preg_replace($pattern, $pre_replace,$content);
		return $content;

	}

	public static function cleanStopWords($string){
		$string = self::extractExtraWhiteSpaces($string);
		if (trim($string) != '') {
		  $string = preg_replace('/[^-Ã¡Ã©Ã­óÃºÃ±_@.,\\\s\w\'\"]+/iu', "--", $string); //caracteres que se escapan al alfanumerico
		}

		$array_string = explode(' ', mb_strtolower($string, 'UTF-8'));

		return str_replace('-', ' ', implode(' ', $array_string));
	}

	public static function extractExtraWhiteSpaces($string, $to_upper = false){
		$string = trim($string);
		$string = preg_replace('/\s[\s]+/', ' ', $string);
		if ($to_upper) {
		$string = mb_strtoupper($string);
		}
		return $string;
	}

	public static function getMoreSlider($params, $limit = 6){

		$params_default = array('tags' => null,'order_read' => false , 'order_commented' => false,'order_shared' => false, 'has_gallery' => false, 'has_video' => false, 'category_id' => null);
		$params = array_merge($params_default, $params);

		$query = DB::table('njv_slider_more')
			->select('njv_slider_more.post_id',
						Db::raw('(SELECT image FROM njv_post_multimedia WHERE post_id = njv_slider_more.post_id and is_principal = 1 ) as image') ,
						DB::raw('(SELECT slug FROM njv_category WHERE id = njv_slider_more.category_parent_id) category_parent_slug'),
						'njv_slider_more.title',
						'njv_slider_more.slug',
						'njv_slider_more.id_video',
						'njv_slider_more.type_video',
						'njv_slider_more.category_id' ,
						'njv_slider_more.category_parent_id' ,
						'njv_slider_more.tags')
			->take($limit);

		if($params['tags']){
			$query->addSelect(DB::raw("MATCH (tags) AGAINST ( '" . $params['tags'] . "' IN BOOLEAN MODE) as ranking"))
					->whereRaw("MATCH (tags) AGAINST ( '" . $params['tags'] . "' IN BOOLEAN MODE)")
					->orderBy('ranking', 'desc');
		}

		if($params['order_read']){
			$query->orderBy('count_read', 'desc');
		}

		if($params['order_commented']){
			$query->orderBy('count_commented', 'desc');
		}

		if($params['order_shared']){
			$query->orderBy('count_shared', 'desc');
		}

		if($params['has_gallery']){
			$query->where('has_gallery', '=', 1)->orderBy('post_id', 'desc');
		}

		if($params['has_video']){
			$query->where('has_video', '=', 1)->orderBy('post_id', 'desc');
		}

		if($params['category_id']){
			$query->where('category_id', '=', $params['category_id']);
		}

		return $query->get();
	}

	public static function getTagsCategory($category_id = null){

		$key = "dbl_tags_category" . $category_id;

		if (!Cache::has($key)) {
			$dbl_category_tags = Cache::remember($key, 180, function() use($category_id){
				$dbl_category_tags = Category::where('parent_id')
							->select(DB::raw('GROUP_CONCAT(keyword) as keywords'));

				if($category_id){
					$dbl_category_tags->where('id', '=', $category_id);
				}

				return $dbl_category_tags->first();
			});

		}else{
			$dbl_category_tags = Cache::get($key);
		}

		return $dbl_category_tags;
	}

	public static function formatTags($tags){

		$data_tags = explode(',', $tags);

		$tags_html = array();
		foreach ($data_tags as $tag) {
			$tags_html[] = '<a href="' . route('frontend.post.tags', array(Str::slug($tag))) . '">' . ucwords($tag) . '</a>';
		}

		return implode(', ', $tags_html);

	}

	public static function getNameComScore(){
		$current_route_action = Route::currentRouteAction();
		$data_route_action = explode('@', $current_route_action);
		$url_current = null;

		if($data_route_action[0] == 'FrontendSectionController' && $data_route_action[1] == 'viewPost'){
			$dbr_post = App::make('singleton_dbr_post');
			$url_current = Request::path();
			$url_current = preg_replace('/[0-9]+/', Str::slug($dbr_post->category_name) . '.articulo', $url_current);

		}else{
			$data_segments = Request::segments();

			switch (count($data_segments)) {
				case 0:
					$url_current = 'inicio.portada';
					break;
				case 1 :
					$url_current = $data_segments[0].'.portada';
					break;
				default:
					$url_current = implode('/', $data_segments);
					break;
			}
		}

		$url_current = str_replace('/', '.' , $url_current);
		$url_current = str_replace('.html', '', $url_current);

		return $url_current;
	}

	public static function getCountry(){
		$dbl_country = DB::select("SELECT DISTINCT country_code,country_name FROM njv_ip2c ORDER BY country_name");
		return $dbl_country;
	}

}

?>
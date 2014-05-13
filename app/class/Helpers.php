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

	const TYPE_BINGE_BAR = 'BAR';
	const TYPE_BINGE_DISCOTECA = 'DISCOTECAS';
	const TYPE_BINGE_LOUNGES = 'LOUNGE';

	const TYPE_VIDEO_YOUTUBE = 'Y';
	const TYPE_VIDEO_DAILYMOTION = 'D';

	const TYPE_POST_SUPER_FEATURED = 'S';
	const TYPE_POST_SLIDER_FEATURED = 'SL';
	const TYPE_POST_SECTION_FEATURED = 'SE';
	const TYPE_POST_SUBSECTION_FEATURED = 'SSE';
	const TYPE_VIDEO_FEATURED = 'V';

	const TYPE_MODULE_ESTANDAR = 'E';
	const TYPE_MODULE_MODULAR = 'M';
	const TYPE_MODULE_LISTADO = 'L';

	public static $prefix_table = 'njv_';
	public static $extension = '.jpg';

	public static $type_video = array(
		self::TYPE_VIDEO_YOUTUBE => 'Yotube',
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
			array('name' => 'Dashboard', 'class'=>'fa-dashboard', 'url' => '#' ),
			array('name' => 'Estadisticas', 'class'=>'fa-bar-chart-o', 'url' => '#' ),
			array('name' => 'Administrar Banners', 'class'=>'fa-table', 'url' => '#' ),
			array('name' => 'Publicaciones', 'class'=>'fa-table', 'url' => '#',
				'subcategories'=> array(
						array('name' => 'Noticias', 'url' => url('backend/publicaciones/' . mb_strtolower(self::TYPE_POST_NEWS))),
						array('name' => 'Videos', 'url' => url('backend/publicaciones/' . mb_strtolower(self::TYPE_POST_VIDEO))),
						array('name' => 'Fail en Redes', 'url' => '#'),
						array('name' => 'Cartelera', 'url' => '#'),
						array('name' => 'Blogs', 'url' => '#'),
						array('name' => 'Fotos', 'url' => '#')
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
			'gallery' 					=> array('width' => 600, 'height' => 374),
			'category' 					=> array('width' => 216, 'height' => 265),
			'video_featured'			=> array('width' => 500, 'height' => 300),
			'view'						=> array('width' => 300, 'height' => 187),
			'view_thumb' 				=> array('width' => 160, 'height' => 160)
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

        if($image->resize($size['width'], $size['height'], true)->save($path . $name)){
        	$image->destroy();
        	return true;
        }

        return false;
    }

    public static function cropInmage($path, $data_pos){
		$img = Image::make($path);

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
		$v =  (!empty($_SERVER['REMOTE_ADDR']))?$_SERVER['REMOTE_ADDR'] :((!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) ? $_SERVER['HTTP_X_FORWARDED_FOR']: @getenv('REMOTE_ADDR'));

		if(isset($_SERVER['HTTP_CLIENT_IP']))
		{
			$v = $_SERVER['HTTP_CLIENT_IP'];
		}
		return htmlspecialchars($v,ENT_QUOTES);
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
			$url = '';
			$pre_replace = '[tag='.$url.']'.$value.'[/tag]';
			$content =  preg_replace("#\[tag\]$value\[/tag\]#si", $pre_replace , $content);
		}

		return $content;
	}

	public static function getTagIds($data_tags){

		$data_tag_ids = array();
		foreach ($data_tags as $tag) {
			$tag = trim($tag);
			$dbr_tag = Tag::where('slug',Str::slug($tag))->first();

			if(!$dbr_tag){
				$dbr_tag = new Tag();
				$dbr_tag->tag = $tag;
				$dbr_tag->slug = $tag;
				$dbr_tag->save();
			}

			$data_tag_ids[] = $dbr_tag->id;

		}

		return $data_tag_ids;

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
		<object width="455" height="344"><param name="movie" value="http://www.youtube.com/v/\1&hl=es&fs=1&showinfo=0&rel=0&"></param><param name="allowFullScreen"
		value="true"></param><param name="allowscriptaccess" value="always"></param>
		<param name="wmode" value="transparent"></param><embed src="http://www.youtube.com/v/\1&hl=es&fs=1&showinfo=0&rel=0&" type="application/x-shockwave-flash"
		allowscriptaccess="always" wmode="transparent" allowfullscreen="true" width="580" height="350"></embed></object></div>';

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

}

?>
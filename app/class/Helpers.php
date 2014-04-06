<?php 

class Helpers {

	const TYPE_POST_NEWS = 'NEWS';
	const TYPE_POST_VIDEO = 'VIDEO';
	const TYPE_POST_GALLERY = 'GALLERY';

	public static $prefix_table = 'njv_';
	public static $extension = '.jpg';

	public static function sidebarBackend(){

		$data_sidebar = array(			
			array('name' => 'Dashboard', 'class'=>'fa-dashboard', 'url' => '#' ),
			array('name' => 'Estadisticas', 'class'=>'fa-bar-chart-o', 'url' => '#' ),
			array('name' => 'Administrar Banners', 'class'=>'fa-table', 'url' => '#' ),
			array('name' => 'Publicaciones', 'class'=>'fa-table', 'url' => '#',
				'subcategories'=> array(
						array('name' => 'Noticias', 'url' => url('backend/publicaciones')),
						array('name' => 'Juerga', 'url' => '#'),
						array('name' => 'Pichanga', 'url' => '#'),
						array('name' => 'Videos', 'url' => '#'),
						array('name' => 'Fotos', 'url' => '#')
					)
			),
			array('name' => 'Categorias', 'class'=>'fa-table', 'url' => '#' ),
			array('name' => 'Usuarios', 'class'=>'fa-wrench', 'url' => '#' )
		);

		return $data_sidebar;
	}


	public static $size_images = array(
			'featured' 					=> array('width' => 1212, 'height' => 399),
			'featured_principal' 		=> array('width' => 623, 'height' => 398),
			'featured_section_standar'	=> array('width' => 612, 'height' => 383),
			'featured_section_module'	=> array('width' => 252, 'height' => 155),			
			'content' 					=> array('width' => 500, 'height' => 500),
			'content_thumbnail' 		=> array('width' => 160, 'height' => 160),
			'gallery' 					=> array('width' => 600, 'height' => 374)
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
                		self::saveImage($file, $path_upload . "pp/", $new_name, self::$size_images['content_thumbnail']); 
                		$response['filename_thumb'] = Config::get('settings.urlupload') . $path . 'pp/'. $new_name;	               		
                	}

                    $response['message'] = 'Imagen subida satisfactoriamente';
                    $response['success'] = 1;
                    $response['filename'] = Config::get('settings.urlupload') . $path . $new_name;
                    $response['name'] = $new_name;
                    
                }else {
                    $response['message'] = 'Upload Fail: Unknown error occurred!';
                    $response['success'] = 0;
                }
            }else {
                $response['message'] = 'Upload Fail: Unsupported file format or It is too large to upload!';
                $response['success'] = 0;
            }
        }else {
            $response['message'] = 'Bad request!';
            $response['success'] = 0;
        }

        return $response;


	}

	public static function saveImage($file, $path = null, $name = null, $size = array()){
        $image = Image::make($file->getRealPath());

        if($image->resize($size['width'], $size['height'], true, true)->save($path . $name)){
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




}

?>
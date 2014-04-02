<?php 

class Helpers {

	const TYPE_POST_NEWS = 'NEWS';
	const TYPE_POST_VIDEO = 'VIDEO';
	const TYPE_POST_GALLERY = 'GALLERY';

	public static $prefix_table = 'njv_';

	public static function sidebarBackend(){

		$data_sidebar = array(			
			array('name' => 'Dashboard', 'class'=>'fa-dashboard', 'url' => '#' ),
			array('name' => 'Estadisticas', 'class'=>'fa-bar-chart-o', 'url' => '#' ),
			array('name' => 'Administrar Banners', 'class'=>'fa-table', 'url' => '#' ),
			array('name' => 'Publicaciones', 'class'=>'fa-table', 'url' => '#',
				'subcategories'=> array(
						array('name' => 'Noticias', 'url' => url('backend/noticias')),
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


}

?>
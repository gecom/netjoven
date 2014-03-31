<?php 

class Helpers {

	public static $prefix_table = 'njv_';

	public static function generateSlug($s)
	{
		$s = trim($s);
		$s = preg_replace('`\[.*\]`U','',$s);
		$s = str_replace( array('!','¿','?','ç', 'Ç','.','(',')','$',',',';','\'',':','_'),'', $s );
		$s = preg_replace('`&(amp;)?#?[a-z0-9]+;`i','-',$s);
		$s = htmlentities($s, ENT_COMPAT, "UTF-8");
		$s = preg_replace( '`&([a-z]+)(acute|uml|circ|grave|ring|cedil|slash|tilde|caron|lig);`i',"\\1", $s );
		$s = preg_replace( array('`[^a-z0-9_]`i','`[-]+`') , ' ',$s);
		$s = trim($s);
		$s = str_replace(" ","-",$s);
		return $s;
	}

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
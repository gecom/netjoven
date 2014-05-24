<?php

class Banner{



	const TYPE_BANNER_ALL 		= 'ALL';
	const TYPE_BANNER_VIEW		= 'VIEW';

	public static $type_video = array(
		self::TYPE_BANNER_ALL => 'All',
		self::TYPE_BANNER_VIEW => 'Ver'
	);

	public static function getBanner($sector_id){

		//$routes = Route::getCurrentRoute()->getParameter('keyword');  obtner paramtro
		$current_route_action = Route::currentRouteAction();
		$data_route_action = explode('@', $current_route_action);

		if($data_route_action[0] == 'FrontendHomeController' && $data_route_action[1] == 'home'){
			$module = '0';
		}

		$type = self::TYPE_BANNER_ALL;
		$dbr_post = null;
		$tags = null;
		if($data_route_action[0] == 'FrontendSectionController' && $data_route_action[1] == 'viewPost'){
			$type = self::TYPE_BANNER_VIEW;
			$dbr_post = Route::getCurrentRoute()->getParameter('post');
			$tags = $dbr_post->tags;
		}

		if($data_route_action[0] == 'FrontendSectionController' && $data_route_action[1] == 'listSection'){
			$slug = Route::getCurrentRoute()->getParameter('slug');
			$dbr_category = Category::getCategoryBySlug($slug)->first();
			$module = $dbr_category->id;
		}

		if(($data_route_action[0] == 'FrontendSectionController' && $data_route_action[1] == 'searchPost') || $tags){ // esto se puede cambiar por el route de tags
			$keyword = (!$tags ? Route::getCurrentRoute()->getParameter('keyword') : $tags);


			
		}
		



		$params['category_id'] = $module;
		$params['sector_id'] = $sector_id;
		$params['type'] = $type;

		$dbr_banner_detail = BannerDeTail::getBannerDetail($params)->first();
		
	}



function _banner($sector='all',$base='',$do=FALSE){
	
	$CI =& get_instance();
	$obej = $CI->uri->segment(1);
	
	if( empty($base )){
		if( empty($obej) ){
			$base = 'index';
			
		}else{
		  	$base = $CI->uri->segment(1);

		}
	}

	if( is_numeric( $CI->uri->segment(2) ) ){
		$method = 'ver';
	}else{
	  	$method = "all";
	}
	

	if(isset($CI->m_noticias) and !$do){
		
		
		
		if(!empty( $CI->m_noticias->categoria )){
			$base = links(strtolower($CI->m_noticias->categoria));
			
			switch( $base ){
				
				case 'tecnologia':
				case 'apps':
				case 'video-juego':
					$base = 'tecnologia';
				break;
			}
		}else{
			switch( $CI->uri->segment(1) ){
				case 'espectaculos':
					$base = 'internacionales';	
				break;
				case 'deportes':
					$base = 'deportes-internacionales';
				break;
				case 'estilo_de_vida':
					$base = 'estilo';
				break;
				case 'tecnologia':
				case 'apps':
				case 'video_juego':
					$base = 'tecnologia';
				break;
				case 'redes_sociales':
					$base = 'redes-sociales';
				break;
			}
		}
		if( ! empty ( $CI->m_noticias->tag ) ) {
			
				
				$tag = $CI->m_noticias->tag;
				$query_str = "SELECT idbanner,peso,pais,horainicio,horafin,UNIX_TIMESTAMP(inicio) as inicio,UNIX_TIMESTAMP(fin) as fin
				FROM banners 
				WHERE modulo = 'tags' and tipo = 'all' and sector='$sector' and activo='si' and tag = '$tag'";
			
				return load_banner(0, $query_str, $sector, $do);
		}
		if( ! empty ( $CI->m_noticias->tags ) ) {
				
				$tag = explode( ",", $CI->m_noticias->tags );
				$tag = links( $tag[0]);
				
				$query_str = "SELECT idbanner,peso,pais,horainicio,horafin,UNIX_TIMESTAMP(inicio) as inicio,UNIX_TIMESTAMP(fin) as fin
				FROM banners 
				WHERE modulo = 'tags' and tipo = 'all' and sector='$sector' and activo='si' and MATCH (tag) AGAINST ('$tag' IN BOOLEAN MODE)";
				
				$query = $CI->db->query($query_str);
				
				if($query->num_rows > 0 ){
					
					return load_banner(0, $query_str, $sector, $do);
				}
				
			
		}
	}
	
	$query_str = "SELECT idbanner,peso,pais,horainicio,horafin,UNIX_TIMESTAMP(inicio) as inicio,UNIX_TIMESTAMP(fin) as fin
	FROM banners 
	WHERE modulo = '$base' and tipo = '$method' and sector='$sector' and activo='si'";
	
	
	return load_banner(0, $query_str, $sector, $do);
}

function _banner_by_id($idBanner, $sector='all', $base='', $do=FALSE){
	$CI =& get_instance();
	$obej = $CI->uri->segment(1);
	
	if($obej == 'adminnet' or $obej == 'addnoticia' or $obej == 'ingresar'){
		return;
	}
	
	if(empty($base)){
		if( empty($obej) ){
			$base = 'index';
		}else{
		  $base = $CI->uri->segment(1);
		}
	}

	if(is_numeric($CI->uri->segment(2)) or $CI->uri->segment(2) == "jugar" or $CI->uri->segment(2) == "ver" ){
		$method = 'ver';
	}else if( $CI->uri->segment(2) == "genero" or $CI->uri->segment(2) == "categoria"){
		$method = "categorias";
	}else{
	  $method = "all";
	}
	
	if($base == 'all'){
		$method = 'all';
	}
	
	if($CI->uri->segment(1) == 'noticias' and $method == 'ver'){
		
		switch($CI->noticia->cat){
			case 4:
				$base = 'internacionales';
				$method = 'all';
				break;
			case 23:
				$base = 'deporinternacionales';
				$method = 'all';
				break;
			case 22:
				$base = 'depornacionales';
				$method = 'all';
				break;
			case 15:
				$base = 'cine';
				$method = 'all';
				break;
		}
	}

	$query_str = "SELECT id,idbanner,peso,pais,horainicio,horafin,UNIX_TIMESTAMP(inicio) as inicio,UNIX_TIMESTAMP(fin) as fin
	FROM banners ";
	//WHERE id= '$idBanner' and tipo = '$method' and sector='$sector' and activo='si'";
	$query_str .= "WHERE (modulo = '$base' or idBanner='$idBanner') and tipo = '$method' and sector='$sector' and activo='si'";
	
	return load_banner($idBanner, $query_str, $sector, $do);
}

function _load_banner($idBanner, $query_str, $sector, $do=FALSE){
	$CI =& get_instance();

	$query = $CI->db->query($query_str);
	
	if($query->num_rows() == 0){
		if($do){
			return;
		}else{
			return banner($sector,'all',true);
		}
	}
	
	
	$bPais = '';
	$b ='';
	$bFP = '';
	$bF = '';
	$i = 0;
	$y = 0;
	$today = strtotime(date('Y-m-d'), time());
	$hora = date("G");
	
	foreach ($query->result_array() as $row){
		
		if(!empty($row['inicio']) and ($row['inicio'] <= $today and $row['fin'] >= $today) ){
			
			if($row['horainicio'] <= $hora and $row['horafin'] >= $hora ){
			   	
				if( strtolower($CI->m_login->countryName) == strtolower($row['pais']) ){
					
					$bFP['id'][] = $row['idbanner'];
					$bFP['peso'][] = $row['peso'];
				}else{
				    if(empty($row['pais'])){
				    	$bF['id'][] = $row['idbanner'];
					    $bF['peso'][] = $row['peso'];
				    }
				}
				continue;
			}else{
				$existh = TRUE;
				continue;
			}
		}else{
			if(!empty($row['inicio'])) continue;
		}
		
		if( strtolower($CI->m_login->countryName) == strtolower($row['pais']) ){
			
			$bFP['id'][] = $row['idbanner'];
			$bFP['peso'][] = $row['peso'];
			$i++;
		}else{
			if(empty($row['pais'])){
				$bF['id'][] = $row['idbanner'];
				$bF['peso'][] = $row['peso'];
				$y++;
			}
		}
	}
	
	//en caso sea 1
	if($idBanner != 0){
			return obtenerbanner($idBanner);
	}
	if(is_array($bFP) and count($bFP) >= 1){
		 return obtenerbanner(bannerRandon($bFP['id'], $bFP['peso']));
	}
	if(is_array($bF) and count($bF) >= 1){
		// return obtenerbanner(bannerRandon($bF['id'], $bF['peso']));
	}
	// en el caso que halla varios
	if($i >= 1){
		if($idBanner){
			return obtenerbanner($idBanner);
		}
		return obtenerbanner(bannerRandon($bPais['id'], $bPais['peso']));
	}else if($y >= 1){
		 return obtenerbanner(bannerRandon($b['id'], $b['peso']));
	}else{
	 	if(!$do) return banner($sector,'all',true);
	}
}

function _get_id_from_banner($banners, $idBanner){
	foreach($banners as $banner => $guid){
		if($guid == $idBanner){
			return $guid;
		}
	}
}

function _bannerRandon($values, $weights){ 
		
    $count = count($values); 
    $i = 0; 
    $n = 0; 
    $num = mt_rand(0, array_sum($weights)); 
    while($i < $count){
        $n += $weights[$i]; 
        if($n >= $num){
            break; 
        }
        $i++; 
    } 
    return $values[$i]; 
}
function _obtenerbanner($id){



	$CI =& get_instance();
	$query = $CI->db->query("SELECT codigo FROM bannerstxt WHERE id='$id'");
	$ret = $query->row_array();
	
	return stripslashes($ret['codigo']); 
}


}

?>
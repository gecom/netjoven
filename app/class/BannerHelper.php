<?php

class BannerHelper{

	const TYPE_BANNER_ALL 		= 'ALL';
	const TYPE_BANNER_VIEW		= 'VIEW';

	public static $type_banner = array(
		self::TYPE_BANNER_ALL => 'Todos',
		self::TYPE_BANNER_VIEW => 'Ver'
	);

	public static function getBanner($sector_id, $module = null, $do = false){
		$current_route_action = Route::currentRouteAction();
		$data_route_action = explode('@', $current_route_action);
		$type = self::TYPE_BANNER_ALL;
		$dbr_post = null;
		$keyword = null;
		$tags = null;

		if(!$do){
			if($data_route_action[0] == 'FrontendHomeController' && $data_route_action[1] == 'home'){
				$module = 1;
			}

			if($data_route_action[0] == 'FrontendSectionController' && $data_route_action[1] == 'viewPost'){
				$type = self::TYPE_BANNER_VIEW;
				$dbr_post = Route::getCurrentRoute()->getParameter('dbr_post');
				$data_tags = explode(',', $dbr_post->tags_name);
				$tags = Str::slug($data_tags[0]);
			}

			if($data_route_action[0] == 'FrontendSectionController' &&  in_array($data_route_action[1], array('viewDirectoryPublication', 'listDirectorate'))){
					
				if($data_route_action[1] == 'viewDirectoryPublication'){
					$type = self::TYPE_BANNER_VIEW;
				}

				$dbr_banner_nodule = BannerModule::where('slug', '=', Request::segment(1))->first();
				$module = $dbr_banner_nodule->id;
			}

			if($data_route_action[0] == 'FrontendSectionController' && $data_route_action[1] == 'listSection'){
				$slug = Route::getCurrentRoute()->getParameter('slug');
				$dbr_banner_nodule = BannerModule::where('slug', '=', $slug)->first();
				$module = $dbr_banner_nodule->id;
			}

			if(($data_route_action[0] == 'FrontendSectionController' && $data_route_action[1] == 'searchTag') || $tags){ // esto se puede cambiar por el route de tags
				$tags = (!$tags ? Route::getCurrentRoute()->getParameter('keyword') : $tags);
				$module = 2;			
			}
		}
		
		$params['module_id'] 	= $module;
		$params['sector_id'] 	= $sector_id;
		$params['type'] 		= $type;

		if($tags){
			$params['tags']		= $tags;
		}

		return self::loadBanner($params, $do);		
	}

	private static function loadBanner($params, $do){
		$dbl_banner_detail = BannerDeTail::getBannerDetail($params)->get();

		if(!$dbl_banner_detail){
			if($do){
				return;
			}else{
				return self::getBanner($params['sector_id'], 3, true);
			}
		}

		$bFP = array();
		$bF = array();
		$today = strtotime(date('Y-m-d'), time());
		$time = date("G");


		foreach ($dbl_banner_detail as $dbr_banner_detail) {

		
			if(!empty($dbr_banner_detail->start) and ($dbr_banner_detail->start <= $today and $dbr_banner_detail->end >= $today) ){
				if($dbr_banner_detail->time_start <= $time and $dbr_banner_detail->time_end >= $time ){					
				   	
					if( Helpers::getCountrycode() == $dbr_banner_detail->country){						
						$bFP['id'][] = $dbr_banner_detail->banner_id;
						$bFP['weight'][] = $dbr_banner_detail->weight;
					}else{
					    if(empty($dbr_banner_detail->country)){
					    	$bF['id'][] = $dbr_banner_detail->banner_id;
						    $bF['weight'][] = $dbr_banner_detail->weight;
					    }
					}
					continue;
				}else{
					continue;
				}


			}else{
				if(!empty($dbr_banner_detail->start)) continue;
			}

			if( Helpers::getCountrycode() == $dbr_banner_detail->country ){
				$bFP['id'][] = $dbr_banner_detail->banner_id;
				$bFP['weight'][] = $dbr_banner_detail->weight;
			}else{
				if(empty($dbr_banner_detail->country)){
			    	$bF['id'][] = $dbr_banner_detail->banner_id;
				    $bF['weight'][] = $dbr_banner_detail->weight;
				}
			}
		}


		if(is_array($bFP) and count($bFP) >= 1){
			return self::getBannerById(self::bannerRandon($bFP['id'], $bFP['weight']));
		}

		if(is_array($bF) and count($bF) >= 1){
			return self::getBannerById(self::bannerRandon($bF['id'], $bF['weight']));
		}

		return ;
	}

	private static function bannerRandon($values, $weights){ 
		
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

	private static function getBannerById($id){
		$dbr_banner = Banner::where('id', '=', $id)->first();
		return stripslashes($dbr_banner->code); 
	}

	public static function getBannerModuleParent(){
		return DB::table('njv_banner_module')
						->select('id','parent_id','name')
						->whereNull('parent_id')
						->orderBy('order', 'asc')->get();
	}

	public static function getBannerModuleByParentId($parent_id){
		return DB::table('njv_banner_module')
						->select('id','parent_id','name')
						->where('parent_id', '=', $parent_id)
						->orderBy('id', 'asc')->get();
	}

	public static function getSector(){
		return DB::table('njv_banner_sector')
						->select('id','name')
						->where('status', '=', Status::STATUS_ACTIVO)
						->orderBy('id', 'asc')->get();
	}

}

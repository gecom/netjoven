<?php 

class BannerDetail extends Eloquent {
	protected $table =  'njv_banner_detail';

	public function banner(){
		return $this->belongsTo('Banner');
	}


	public function scopeGetBannerDetail($query, $data_param){

		$params_default = array('category_id' => null, 'sector_id' => null, 'type' => null ,  'tags' => null);
		$params = array_merge($params_default, $params);

		$query->where('status', '=', Status::STATUS_ACTIVO);

		if(empty($params['category_id'])){
			$query->where('category_id');
		}else{
			$query->where('category_id', '=', $params['category_id']);
		}


		if($params['sector_id']){
			$query->where('sector_id', '=', $params['sector_id']);
		}

		if(!$params['type']){
			$query->where('type', '=', $params['type']);
		}

		if(!$params['tags']){


		}

		return $query;
	}
}

?>
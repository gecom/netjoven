<?php 

class BannerDetail extends Eloquent {
	protected $table =  'njv_banner_detail';

	public function banner(){
		return $this->belongsTo('Banner');
	}

	public function scopeGetBannerDetail($query, $params){

		$params_default = array('module_id' => null, 'status' => array(Status::STATUS_ACTIVO), 'sector_id' => null, 'type' => null ,  'tags' => null, 'join_banner' => false);
		$params = array_merge($params_default, $params);
		$query->select('njv_banner_detail.*');

		if($params['status'] &&  is_array($params['status'])){
			$query->whereIn('status',  $params['status']);
		}

		if($params['join_banner'] == true){
			$query->join('njv_banner', 'njv_banner.id','=', 'njv_banner_detail.banner_id');
			$query->addSelect('njv_banner.id as banner_id', 'njv_banner.title as banner_title', 'njv_banner.code as banner_code');
		}

		if($params['module_id']){
			$query->where('module_id', '=', $params['module_id']);
		}

		if($params['sector_id']){
			$query->where('sector_id', '=', $params['sector_id']);
		}

		if(!$params['type']){
			$query->where('type', '=', $params['type']);
		}

		if(!empty($params['tags'])){
			$tags = $params['tags'];
			$query->whereRaw("MATCH(tag) AGAINST('$tags' IN BOOLEAN MODE)");
		}

		return $query;
	}

	public function newQuery($excludeDeleted = true){
	    return parent::newQuery()->addSelect('*',DB::raw('UNIX_TIMESTAMP(date_start)  AS start, UNIX_TIMESTAMP(date_end)  AS end'));
	}
}

?>
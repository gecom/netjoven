<?php

class Directorate extends Eloquent {

	protected $table = 'njv_directory';

	public function directoryPublications(){
		return $this->hasMany('DirectoryPublication', 'directory_id');
	}

	public function category(){
        return $this->belongsTo('Category');
    }

	public static function getPublications($params){

		$params_default = array('id' => null, 'status' => array(Status::STATUS_ACTIVO, Status::STATUS_INACTIVO),'show_limit' => false);
		$params = array_merge($params_default, $params);

		$publications = (new Directorate())
		->select(Helpers::$prefix_table .'directory_publishing.id', 
				Helpers::$prefix_table .'directory_publishing.directory_id',
				Helpers::$prefix_table .'directory_publishing.slug',
				Helpers::$prefix_table .'directory_publishing.title',
				Helpers::$prefix_table .'directory_publishing.address',
				Helpers::$prefix_table .'directory_publishing.phone',
				Helpers::$prefix_table .'directory_publishing.status')
			->join( Helpers::$prefix_table . 'directory_publishing', Helpers::$prefix_table . 'directory_publishing.directory_id', '=', Helpers::$prefix_table .'directory.id')
			->where(Helpers::$prefix_table .'directory_publishing.directory_id', '=', $params['id'] );

		if(is_array($params['status'])){
			$publications->whereIn(Helpers::$prefix_table . 'directory_publishing.status', $params['status']);
		}

		return $publications;
	}

}


?>
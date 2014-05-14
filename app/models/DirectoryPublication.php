<?php

class DirectoryPublication extends Eloquent {

	protected $table = 'njv_directory_publishing';

	public function directorate(){
		return $this->belongsTo('Directorate');
	}

	public function setPlaceAttribute($value){
        $this->attributes['place'] = DB::raw("GeomFromText('POINT($value)')");
    }

	public function setSlugAttribute($value){

		$slug = Str::slug($value);

		$slugCount = count( $this->whereRaw("slug REGEXP '^{$slug}(-[0-9]*)?$'")->get() );

		$slugFinal = ($slugCount > 0) ? "{$slug}-{$slugCount}" : $slug;

		$this->attributes['slug'] = $slugFinal;
	}

	public function scopeGetPublicationsByDirectoryId($query, $params = array()){

		$params_default = array('id' => null,'district_id' => null, 'letter' => null, 'status' => array(Status::STATUS_ACTIVO, Status::STATUS_INACTIVO), 'type' => null ,'title' => null);
		$params = array_merge($params_default, $params);

		 $query->where('directory_id', '=', $params['id']);

		if(is_array($params['status'])){
			$query->whereIn('status', $params['status']);
		}

		if($params['type']){
			$query->where('type', '=', $params['type']);
		}

		if($params['letter']){
			$query->where('title', 'LIKE', $params['letter'].'%');
		}

		if($params['district_id']){
			$query->where('id_district', '=', $params['district_id']);
		}

		if($params['title']){
			$query->where('title', 'LIKE', '%'.$params['title'].'%');
		}

		$query->orderBy('id', 'desc');
		
		return $query;

	}

	public function newQuery($excludeDeleted = true){
	    return parent::newQuery()->addSelect('*',DB::raw('X(place) latitude, Y(place) longitude, (SELECT njv_district.district FROM njv_district WHERE njv_district.id =  njv_directory_publishing.id_district) district_name'));
	}

}


?>
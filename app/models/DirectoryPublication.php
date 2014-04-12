<?php

class DirectoryPublication extends Eloquent {

	protected $table = 'njv_directory_publishing';

	public function directorate(){
		return $this->belongsTo('Directorate', 'directory_id');
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

	public function newQuery($excludeDeleted = true){
	    return parent::newQuery()->addSelect('*',DB::raw('X(place) latitude, Y(place) longitude'));
	}

}


?>
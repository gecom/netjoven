<?php

class Gallery extends Eloquent {

	protected $table = 'njv_post_multimedia';
	public $timestamps = false;

	public function post(){
		return $this->belongsTo('Post');
	}

	public function scopeGetImageFeaturedByPostId($query, $post_id)
	{
		return $query
				->where('post_id', '=', $post_id)
				->where('is_principal','=', 1);
	}

}


?>
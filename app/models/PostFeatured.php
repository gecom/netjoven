<?php

class PostFeatured extends Eloquent {

	protected $table = 'njv_post_featured';

	public function post(){
		return $this->belongsTo('Post');
	}

	public function scopeGetFeaturedActiveByPostId($query, $post_id)
	{
		return $query
				->where('post_id', '=', $post_id)
				->where('expired_at','>=', DB::raw("NOW()"))
				->orderBy('id', 'desc');
	}


	public function scopeGetLastFeaturedSuper($query)
	{
		return $query
				->where('expired_at','>=', DB::raw("NOW()"))
				->where('type', '=', Helpers::TYPE_POST_SUPER_FEATURED)
				->orderBy('id', 'desc');
	}

}

?>
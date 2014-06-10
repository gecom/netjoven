<?php

class PostFeatured extends Eloquent {

	protected $table = 'njv_post_featured';

	public function post(){
		return $this->belongsTo('Post');
	}

	public function scopeGetFeaturedActiveByPostId($query, $post_id)
	{
		return $query->where('post_id', '=', $post_id);
	}


	public function scopeGetFeaturedPost($query, $type_featured, $category_id = null, $category_parent_id = null)
	{
		$query->where('expired_at','>=', DB::raw("NOW()"))
				->where('post_at','<=', DB::raw("NOW()"))
				->where('type', '=', $type_featured)
				->with('Post')
				->orderBy('id', 'desc');


		if($category_id){
				$query->where('category_id', '=', $category_id);
		}

		return $query;
	}

}

?>
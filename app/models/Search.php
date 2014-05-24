<?php

class Search extends Eloquent {
	protected $table =  'njv_search';


	public function scopeGetPostTags($query, $data_tags){
		return $query
				->select ('post_id as id', 'category_slug' ,'category as category_name' , 'category_id', 'has_gallery', 'post_at', 'category_parent_id', 'slug', 'type', 'type_video', 'id_video', 'tag', 'title', 'summary', 'content')
				->whereRaw("MATCH(tag) AGAINST('$data_tags' IN BOOLEAN MODE)")
				->orderBy('post_id', 'DESC');
	}

}


?>
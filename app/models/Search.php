<?php

class Search extends Eloquent {
	protected $table =  'njv_search';


	public function scopeGetPostTags($query, $data_tags){
		return $query
				->select ('post_id as id', 'category_slug' ,
						DB::raw('(SELECT pm.image FROM njv_post_multimedia pm WHERE pm.post_id = njv_search.post_id and pm.is_principal = 1) AS image_featured'),
						DB::raw('(SELECT name FROM njv_category c WHERE id = njv_search.category_parent_id) category_parent_name'),
						DB::raw('(SELECT slug FROM njv_category c WHERE id = njv_search.category_parent_id) category_parent_slug'),
						'category as category_name' ,
						'category_id', 'has_gallery',
						'post_at', 'category_parent_id',
						'slug',
						'type', 'type_video',
						'id_video', 'tag',
						'title', 'summary', 'content')
						->whereRaw("MATCH(tag) AGAINST('$data_tags' IN BOOLEAN MODE)")
						->orderBy('post_id', 'DESC');
	}

}


?>
<?php

class Post extends Eloquent {
	protected $table =  'njv_post';

	public static $rules = array();

	public function category()
	{
		return $this->belongsTo('Category');
	}

	public function tags()
    {
        return $this->belongsToMany('Tag', 'njv_post_tag');
    }

    public function galleries()
    {
        return $this->hasMany('Gallery');
    }

    public function featuredPosts()
    {
        return $this->hasMany('PostFeatured');
    }

	public function post_at($date=null)
    {
        if(is_null($date)) {
            $date = $this->created_at;
        }

        return String::date($date);
    }

    public function setTagsAttribute($tag_ids)
    {
        $this->tags()->sync($tag_ids, true);
    }

	public function setSlugAttribute($value){

		$slug = Str::slug($value);

		$slugCount = count( $this->whereRaw("slug REGEXP '^{$slug}(-[0-9]*)?$'")->get() );

		$slugFinal = ($slugCount > 0) ? "{$slug}-{$slugCount}" : $slug;

		$this->attributes['slug'] = $slugFinal;
	}

    public function scopeGetPostById($query, $post_id){

    	return $query->select('njv_post.id',
					DB::raw("GROUP_CONCAT(njv_tag.tag) as tags"),
					'njv_post.category_id',
					'njv_category.name as category_name',
					'njv_category.slug as category_slug',
					'njv_post.type',
					'njv_post.id_video',
					'njv_post.type_video',
					'njv_post.title',
					'njv_post.slug',
					'njv_post.content',
					'njv_post.summary',
					'njv_post.twitter',
					'njv_post.america',
					'njv_post.frecuencia',
					'njv_post.post_at')
				->join('njv_category', 'njv_category.id','=', 'njv_post.category_id')
				->leftJoin('njv_post_tag', 'njv_post_tag.post_id','=', 'njv_post.id')
				->leftJoin('njv_tag', 'njv_tag.id','=', 'njv_post_tag.tag_id')
				->where('njv_post.id', '=', $post_id)
				->where('njv_post.status', '=', Status::STATUS_PUBLICADO)
				->groupBy('njv_post.id')
				->first();
    }


    public function scopeGetPostNews($query, $params = array()){
		$params_default = array('id' => null,'type' => array(Helpers::TYPE_POST_NEWS, Helpers::TYPE_POST_VIDEO), 'display' => null,'with_post_at' => false ,'category_id' => null, 'show_not_featured' => false, 'view_index' => false,'show_limit' => false);
		$params = array_merge($params_default, $params);

    	$query->select('njv_post.id',
						'njv_post.title',
						'njv_post.slug',
						'njv_post.content',
						'njv_post.summary',
						'njv_post.status',
						'njv_post.post_at',
						'njv_post.view_index',
						'njv_post.id_video',
						'njv_post.type_video',
						'njv_post.type',
						'njv_post.has_gallery',
						'njv_category.id as category_id',
						'njv_category.parent_id as category_parent_id',
						'njv_category.name as category_name',
						'njv_category.slug as category_slug')
    			->join('njv_category', 'njv_category.id', '=', 'njv_post.category_id')
    			->orderBy('njv_post.post_at', 'desc');


		if(is_array($params['id'])){
			$query->whereIn('njv_post.id', $params['id']);
		}

		if(is_array($params['type'])){
			$query->whereIn('njv_post.type', $params['type']);
		}

		if($params['with_post_at'] == true){
			$query->where('njv_post.post_at', '<=', DB::raw("NOW()"));
		}

		if(is_numeric($params['view_index'])){
			$query->where('njv_post.view_index', '=', $params['view_index']);
		}

		if(is_numeric($params['display'])){
			$query->where('njv_post.display', '=', $params['display']);
		}

		if(!empty($params['category_id'])){
			if(is_array($params['category_id']) && count($params['category_id']) > 0){
				$query->whereIn('njv_post.category_id', $params['category_id']);
			}else{
				$query->where('njv_post.category_id', '=', $params['category_id']);
			}
		}

		if(is_array($params['show_limit']) && count($params['show_limit'])){
			$limit_end = $params['show_limit'][0] ;
			$limit_start = $params['show_limit'][1] ;
			$query->take($limit_end)->skip($limit_start);
		}

		return $query;
    }

	/*public static function getPost($params = array())
	{

		$params_default = array('id' => null,'type' => array(Helpers::TYPE_POST_NEWS, Helpers::TYPE_POST_VIDEO), 'display' => null,'with_post_at' => false ,'category_id' => null, 'show_not_featured' => false, 'view_index' => false,'show_limit' => false);
		$params = array_merge($params_default, $params);

		$post = (new Post())
					->select(Helpers::$prefix_table . 'post.id',
							Helpers::$prefix_table . 'post.title',
							Helpers::$prefix_table . 'post.slug',
							Helpers::$prefix_table . 'post.content',
							Helpers::$prefix_table . 'post.summary',
							Helpers::$prefix_table . 'post.status',
							Helpers::$prefix_table . 'post.post_at',
							Helpers::$prefix_table . 'post.view_index',
							Helpers::$prefix_table . 'post.id_video',
							Helpers::$prefix_table . 'post.type_video',
							Helpers::$prefix_table . 'post.type',
							Helpers::$prefix_table . 'post.has_gallery',
							Helpers::$prefix_table . 'category.id as category_id',
							Helpers::$prefix_table . 'category.parent_id as category_parent_id',
							Helpers::$prefix_table . 'category.name as category_name',
							Helpers::$prefix_table . 'category.slug as category_slug',
							'parent_category.slug as parent_category_slug')
					->join(Helpers::$prefix_table . 'category', Helpers::$prefix_table . 'category.id', '=', Helpers::$prefix_table .'post.category_id')
					->join(DB::raw('(SELECT c.id, c.name, c.slug FROM njv_category c WHERE parent_id IS NULL ) AS parent_category'), 'parent_category.id' ,'=', 'njv_category.parent_id')
					->orderBy(Helpers::$prefix_table . 'post.post_at', 'desc');

		if(is_array($params['type'])){
			$post->whereIn(Helpers::$prefix_table . 'post.type', $params['type']);
		}

		if(is_array($params['id'])){
			$post->whereIn(Helpers::$prefix_table . 'post.id', $params['id']);
		}

		if(is_numeric($params['view_index'])){
			$post->where(Helpers::$prefix_table . 'post.view_index', '=', $params['view_index']);
		}

		if(is_numeric($params['display'])){
			$post->where(Helpers::$prefix_table . 'post.display', '=', $params['display']);
		}

		if($params['show_not_featured'] == true){
			//$post->whereIn(Helpers::$prefix_table . 'post.id', DB::table('njv_post_featured')->lists('post_id'));
		}

		if(!empty($params['category_id'])){
			if(is_array($params['category_id']) && count($params['category_id']) > 0){
				$post->whereIn(Helpers::$prefix_table . 'post.category_id', $params['category_id']);
			}else{
				$post->where(Helpers::$prefix_table . 'post.category_id', '=', $params['category_id']);
			}
		}

		if($params['with_post_at'] == true){
			$post->where(Helpers::$prefix_table . 'post.post_at', '<=', DB::raw("NOW()"));
		}

		if(is_array($params['show_limit']) && count($params['show_limit'])){
			$limit_end = $params['show_limit'][0] ;
			$limit_start = $params['show_limit'][1] ;
			$post->take($limit_end)->skip($limit_start);
		}

		return $post;
	}*/

	public function scopeUpdateCounterRead($query, $post_id){
		return $query
				->where('id', '=', $post_id)
				->update(array('total_read' => DB::raw('total_read + 1')));
	}


}

?>
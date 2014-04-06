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
        return $this->belongsToMany('Tag');
    }

    public function galleries()
    {
        return $this->hasMany('Gallery');
    }

	public function post_at($date=null)
    {
        if(is_null($date)) {
            $date = $this->created_at;
        }

        return String::date($date);
    }

    public static function getPostById($post_id)
    {

		$dbr_post = (new Post())
			->select('id', DB::raw('(SELECT parent_id FROM njv_category c WHERE c.id = njv_post.category_id ) as parent_category_id'),
					'category_id', 'type', 'id_youtube', 'dailymotion_code', 'title', 'slug', 'content', 'summary',
					'twitter', 'america', 'frecuencia')
			->where('id', '=', $post_id)
			->where('status', '=', Status::STATUS_PUBLICADO)
			->first();

		return $dbr_post;
    }

	public static function getPost($params = array())
	{

		$params_default = array('type' => array("NEWS", "VIDEOS"), 'show_not_featured' => false, 'show_limit' => false);
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
							Helpers::$prefix_table . 'category.name as category_name',
							Helpers::$prefix_table . 'category.slug as category_slug',
							DB::raw('(SELECT CONCAT(c1.name, " > " ,'.Helpers::$prefix_table . 'category.name'.', "|", c1.slug) FROM ' . Helpers::$prefix_table . 'category c1 WHERE c1.parent_id IS NULL AND c1.id = '.Helpers::$prefix_table .'category.parent_id) as parent_category'))
					->join( Helpers::$prefix_table . 'category', Helpers::$prefix_table . 'category.id', '=', Helpers::$prefix_table .'post.category_id')					
					->orderBy(Helpers::$prefix_table . 'post.created_at', 'desc');

		if(is_array($params['type'])){
			$post->whereIn(Helpers::$prefix_table . 'post.type', $params['type']);
		}

		if($params['show_not_featured'] == true){
			$post->whereIn(Helpers::$prefix_table . 'post.id', DB::table('njv_post_featured')->lists('post_id'));
		}

		if(is_array($params['show_limit']) && count($params['show_limit'])){
			$limit_end = $params['show_limit'][0] ;
			$limit_start = $params['show_limit'][1] ;
			$post->take($limit_end)->skip($limit_start);
		}

		return $post;
	}

}

?>
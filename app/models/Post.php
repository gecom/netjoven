<?php 

class Post extends Eloquent {
	protected $table =  'njv_news';

	public function category()
	{ 
		return $this->belongsTo('Category');
	}

	    public function tags()
    {
        return $this->belongsToMany('Tag');
    }

	public static function getPost($params = array())
	{

		$params_default = array('is_index' => false, 'is_exclusive' => false, 'type' => array("NEWS", "VIDEOS"), 'limit_start' => 0, 'limit_end' => 6);
		$params = array_merge($params_default, $params);

		$post = (new Post())
					->select(Helpers::$prefix_table . 'news.id', 
							Helpers::$prefix_table . 'news.title', 
							Helpers::$prefix_table . 'news.slug', 
							Helpers::$prefix_table . 'news.content', 
							Helpers::$prefix_table . 'news.summary', 
							Helpers::$prefix_table . 'news.status', 
							Helpers::$prefix_table . 'news.view_index',
							Helpers::$prefix_table . 'category.name as category_name',
							Helpers::$prefix_table . 'category.slug as category_slug',
							DB::raw('(SELECT CONCAT(c1.name, " > " ,'.Helpers::$prefix_table . 'category.name'.', "|", c1.slug) FROM ' . Helpers::$prefix_table . 'category c1 WHERE c1.parent_id IS NULL AND c1.id = '.Helpers::$prefix_table .'category.parent_id) as parent_category'))
					->join( Helpers::$prefix_table . 'category', Helpers::$prefix_table . 'category.id', '=', Helpers::$prefix_table .'news.category_id')					
					->orderBy(Helpers::$prefix_table . 'news.created_at', 'desc');

		if($params['is_index'] == true){
			$post->where('view_index', '=', 1);
		}

		if(is_array($params['type'] )){
			$post->whereIn(Helpers::$prefix_table . 'news.type', $params['type']);	
		}

		if($params['is_exclusive'] == true){
			$post->orWhere('is_exclusive', '=', 1);
		}

		$post->take($params['limit_end'])->skip($params['limit_start']);

		return $post;
	}

}

?>
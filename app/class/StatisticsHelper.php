<?php 

class StatisticsHelper {

	private static $current_date = '2014-01-01'; //Date('Y-m-d');

	public static function statisticsPost($params = array()){

		$params_default = array('date_start' => self::$current_date, 'date_end' => null, 'sort_dir' => 'desc', 'sort_by' => 'views');
		$params = array_merge($params_default, $params);

		$orders_by = array('title' => 'njv_post.title',
							'category_name' => 'category_name', 
							'redactor' 	=> 'njv_user_profile.first_name', 
							'date' 		=> 'njv_post.post_at',
							'views' 	=> 'page_views'
						);

		$sort_by = $orders_by[$params['sort_by']];
		$sort_dir = $params['sort_dir'];

		$dbl_post = Post::select('njv_post.id', 'njv_post.title', 'njv_post.slug', 'njv_post.post_at', 'njv_category.id as category_id', 
							DB::raw('(select slug from njv_category c1 where c1.id = njv_category.parent_id) as category_parent_slug'), 
							'njv_category.name as category_name', 'njv_user_profile.first_name', 'njv_user_profile.last_name',
							DB::raw('( SELECT count(id) FROM njv_post_visits where njv_post_visits.post_id = njv_post.id) as page_views'))
							->join('njv_category', 'njv_category.id', '=', 'njv_post.category_id')
							->join('njv_user_profile', 'njv_user_profile.user_id', '=', 'njv_post.user_id' )
							->where('njv_post.is_deleted','=', 0)
							->orderBy($sort_by, $sort_dir);

		if(!$params['date_end']){
			$dbl_post->where('njv_post.post_at' , '=', $params['date_start']);
		}else{
			$dbl_post->where('njv_post.post_at' , '>=', $params['date_start']);
			$dbl_post->where('njv_post.post_at' , '<=', $params['date_end']);
		}

		return $dbl_post;

	}

	public static function statisticsCategories($params = array()){

		$params_default = array('date_start' => self::$current_date , 'date_end' => null);
		$params = array_merge($params_default, $params);

		$dbl_post = Post::select(DB::raw('COUNT(njv_post.id) AS total_post'), 
							DB::raw('(select name from njv_category c1 where c1.id = njv_category.parent_id) as category_parent_name'),
							'njv_category.id', 'njv_category.parent_id', 'njv_category.name'
							)
							->join('njv_category', 'njv_category.id', '=', 'njv_post.category_id')
							->where('njv_post.is_deleted','=', 0)
							->groupBy('njv_category.id')
							->orderBy('njv_category.parent_id')
							->orderBy('njv_category.id');

		if(!$params['date_end']){
			$dbl_post->where('njv_post.post_at' , '=', $params['date_start']);
		}else{
			$dbl_post->where('njv_post.post_at' , '>=', $params['date_start']);
			$dbl_post->where('njv_post.post_at' , '<=', $params['date_end']);
		}

		return $dbl_post;
	}

	public static function statisticsRedactores($params = array()){

		$params_default = array('date_start' => self::$current_date , 'date_end' => null, 'sort_dir' => 'desc', 'sort_by' => 'views');
		$params = array_merge($params_default, $params);

		$orders_by = array(
			 		'total_post' => 'total_post',
					'views' 	=> 'page_views'
					);

		$sort_by = $orders_by[$params['sort_by']];
		$sort_dir = $params['sort_dir'];

		$dbl_post = Post::select(DB::raw('COUNT(njv_post.id) as total_post'),
								'njv_post.user_id',
								'njv_user_profile.first_name',
								'njv_user_profile.last_name',
								DB::raw('SUM(( SELECT count(id) FROM njv_post_visits where njv_post_visits.post_id = njv_post.id)) as page_views'))
							->join('njv_user', 'njv_user.id', '=', 'njv_post.user_id')
							->join('njv_user_profile', 'njv_user_profile.user_id', '=', 'njv_user.id')
							->where('njv_post.is_deleted','=', 0)
							->groupBy('njv_post.user_id')
							->orderBy($sort_by, $sort_dir);

		if(!$params['date_end']){
			$dbl_post->where('njv_post.post_at' , '=', $params['date_start']);
		}else{
			$dbl_post->where('njv_post.post_at' , '>=', $params['date_start']);
			$dbl_post->where('njv_post.post_at' , '<=', $params['date_end']);
		}

		return $dbl_post;
	}
}


?>
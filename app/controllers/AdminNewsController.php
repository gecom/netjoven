<?php 

class AdminNewsController extends BaseController {


    public function listNews()
    {
        $params['type'] = array('NEWS');
        $params['show_pagination'] = 15;
        $dbl_post = Post::getPost($params)->paginate(15);
        return View::make('backend.pages.post_list', array('dbl_post' => $dbl_post ));
    }

    public function news($news_id = null)
    {


        $params['is_new'] = $is_new =  true;
        if(empty($news_id)){
            $params['is_new'] = $is_new = false;
        }

        $dbr_post = null;
        if($is_new){
            $dbr_post = Post::getPostById($news_id);
        }

    	$params['parent_category'] = Category::getParentCategories();
        $params['is_new'] = $is_new;
        $params['dbr_post'] = $dbr_post;
    	return View::make('backend.pages.post', $params);


        /*select id, (SELECT parent_id FROM njv_category c WHERE c.id = p.category_id ) ,
category_id, type,id_youtube, dailymotion_code,title, slug, content, summary
from njv_post p where id = 8870*/
    }

}

?>
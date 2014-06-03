<?php

class AdminNewsController extends BaseController {


    public function listNews($type_post)
    {

        $params['type'] = array($type_post);
        $dbl_post = Post::getPostNews($params)->paginate(15);

        $params_template['dbl_post'] = $dbl_post;
        $params_template['type_post'] = $type_post;
        $params_template['title'] = ucfirst($type_post);
        return View::make('backend.pages.post_list', $params_template);
    }

    public function newsFeatured($post){
        $params['title_content'] = 'Destacar ' . $post->title;
        $params['data_type_featured'] = Helpers::$type_featured_post;
        $params['dbl_post'] = $post;
        $params['dbl_post_featured'] = PostFeatured::getFeaturedActiveByPostId($post->id)->first();

        return View::make('backend.pages.post_featured', $params);
    }

    public function saveFeatured($post){

        $data_frm_news = Input::get('frm_post_featured');

        $rules = array(
            'title'         => 'required|min:3',
            'post_at'       => 'required|before:expired_at',
            'expired_at'    => 'required',
            'image'         => 'required'
        );

        $data_frm_news['post_at'] = Helpers::changeToMysql( $data_frm_news['post_at']);
        $data_frm_news['expired_at'] = Helpers::changeToMysql( $data_frm_news['expired_at']);

         $dbr_post_featured = PostFeatured::getFeaturedActiveByPostId($post->id)->first();

         if($post->type == Helpers::TYPE_POST_NEWS && !$dbr_post_featured){
            $rules['type'] = 'required';
         }

         $validator = Validator::make($data_frm_news, $rules);

        if ( $validator->fails() ){
            if(Request::ajax()){
                $response['success'] = false;
                $response['errors'] =  $validator->getMessageBag()->toArray();
            } else{
                return Redirect::back()->withInput()->withErrors($validator);
            }
        }else{

            $dbr_post_featured = ($dbr_post_featured ? $dbr_post_featured : new PostFeatured());

            if( isset($data_frm_news['type'])){
                $dbr_post_featured->type = $data_frm_news['type'];
            }else{
                $dbr_post_featured->type = Helpers::TYPE_VIDEO_FEATURED;
            }

            $dbr_post_featured->title       =   $data_frm_news['title'];
            $dbr_post_featured->post_at     =   $data_frm_news['post_at'];
            $dbr_post_featured->expired_at  =   $data_frm_news['expired_at'];
            $dbr_post_featured->image       =   $data_frm_news['image'];
            $dbr_post_featured->post_id     =   $post->id;

            try {
                if($dbr_post_featured->save()){
                    $response['success'] = true;
                    $response['message'] =  'La nota se destaco satisfactoriamente';
                    $response['redirect'] = route('backend.post.list', array(mb_strtolower($post->type)));
                }else{
                    $response['success'] = false;
                    $response['errors'] =  ['Error: Hubo un error al registrar la nota como destacada'];
                }

            } catch (Exception $e) {
                $response['success'] = false;
                $response['errors'] =  ['Error:' . $e->getMessage()];
            }
        }

        return Response::json($response);
    }

    public function news($type_post, $post = null)
    {

        $params['is_new'] = $is_new =  false;
        if(empty($post)){
            $params['is_new'] = $is_new = true;
        }

        $params = array();
        $dbr_category = null;
        $type_post = strtoupper($type_post);

        switch ($type_post) {
            case Helpers::TYPE_POST_VIDEO:
                $params['id'] = 34;
                break;
            case Helpers::TYPE_POST_HOROSCOPO:
                $dbr_category = Category::find(24);
                break;
            case Helpers::TYPE_POST_FAIL:
                $dbr_category = Category::find(2);
                break;
            case Helpers::TYPE_POST_CARTELERA:
                $dbr_category = Category::find(42);
                break;
            case Helpers::TYPE_POST_PARANORMAL:
                $dbr_category = Category::find(35);
                break;
            case Helpers::TYPE_POST_JUEGOS:
                $dbr_category = Category::find(30);
                break;
            case Helpers::TYPE_POST_BLOGS:
                $dbr_category = Category::find(40);
                break;
            case Helpers::TYPE_POST_NEWS:
                $params['category_not_id'] = array(2,24,30,34,35,40,42);
                break;
        }

        $params_template['data_type_video'] = Helpers::$type_video;
        $params_template['dbr_category'] = $dbr_category;
    	$params_template['dbl_parent_categories'] = (!$dbr_category ? Category::getParentCategories($params)->get() : null);

        if(!$is_new){
            $params_template['dbr_post_category'] = $dbr_post_category = $post->category()->first();
            $params_template['dbl_categories'] = (!$dbr_category ? Category::getChildrenCategoryByParentId($dbr_post_category->parent_id)->get() : null);
            $params_template['dbl_galleries'] = $post->galleries()->get();
            $params_template['tags'] = implode(',', Helpers::getTagsByPost($post));
        }

        $params_template['is_new'] = $is_new;
        $params_template['dbr_post'] = $post;
        $params_template['type_post'] = $type_post;

    	return View::make('backend.pages.post', $params_template);
    }


    public function saveNews($type_post, $post = null)
    {

        $data_frm_news = Input::get('frm_news');
        $type_post = strtoupper($type_post);

        $is_new = false;
        if(!$post && $data_frm_news['is_new'] == true){
            $is_new = true;
        }

        $post = ($is_new == true ? new Post() : $post);

        $rules = array(
            'title'   => 'required|min:3',
            'subcategory'   => 'required|numeric',
            'summary'       => 'required',
            'keywords'       => 'required',
        );

        if(!empty($data_frm_news['type_video'])){
            $rules['id_video'] = 'required';
        }

        if($type_post != Helpers::TYPE_POST_FAIL){
            $rules['category']  = 'required|numeric';
        }

        $validator = Validator::make($data_frm_news, $rules);

        if($post){
            if ( $validator->fails() ){
                if(Request::ajax()){
                    $response['success'] = false;
                    $response['errors'] =  $validator->getMessageBag()->toArray();
                } else{
                    return Redirect::back()->withInput()->withErrors($validator);
                }
            }else{
                $post->title = $data_frm_news['title'];
                $data_frm_news['post_at'] = Helpers::changeToMysql( $data_frm_news['post_at']);
                $post->post_at     =   $data_frm_news['post_at'];

                if($is_new == true){
                    $post->slug = $data_frm_news['title'];
                }

                if(!empty($data_frm_news['type_video']) && !empty($data_frm_news['id_video'])){
                    $post->type_video =  $data_frm_news['type_video'];
                    $post->id_video =  $data_frm_news['id_video'];
                }

                $post->type = $type_post;

                if(isset($data_frm_news['twitter'])){
                   $post->twitter = $data_frm_news['twitter'];
                }

                if(isset($data_frm_news['america'])){
                   $post->america = $data_frm_news['america'];
                }

                if(isset($data_frm_news['frecuencia'])){
                   $post->frecuencia = $data_frm_news['frecuencia'];
                }

                if(isset($data_frm_news['view_index'])){
                    $post->view_index = $data_frm_news['view_index'];
                }

                if(isset($data_frm_news['display'])){
                    $post->display = $data_frm_news['display'];
                }

                $content = '';
                if(!empty($data_frm_news['description'])){
                    $content = Helpers::prepareContent($data_frm_news['description']);                    
                }

                $post->summary = $data_frm_news['summary'];
                $post->content = $content;
                $post->category_id = $data_frm_news['subcategory'];
                $data_image_principal = !empty($data_frm_news['image_principal']) ? array(json_decode($data_frm_news['image_principal'], true)) : array();

                try {
                    if($post->save()){
                        $data_frm_news['keywords'] = explode(',', $data_frm_news['keywords']);
                        $post->tags = Helpers::getTagIds($data_frm_news['keywords']);
                        $this->saveGalleryByPost($data_image_principal, $post);
                        $response['success'] = true;
                        $response['message'] =  'Nota registrada satisfactorimente';
                        if($is_new){
                            $response['redirect'] =  route('backend.register.edit', array(strtolower($type_post), $post->id));
                        }

                        $key = 'dbl_post_view_' . $post->id;

                        if(Cache::has($key)){
                            Cache::forget($key);
                        }

                    }else{
                        $response['success'] = false;
                        $response['errors'] =  ['Error: Hubo un error al registrar la nota'];
                    }

                } catch (Exception $e) {
                    $response['success'] = false;
                    $response['errors'] =  ['Error:' . $e->getMessage()];
                }

            }

        }else{
                $response['success'] = false;
                $response['errors'] =  ['Error: Nota no existe'];
        }

        return Response::json($response);
    }


    public function saveNewsGallery($post){

        $data_frm_news_gallery = Input::get('frm_news_gallery');

        if(!count($data_frm_news_gallery) && !isset($data_frm_news_gallery['name'])){
            throw new Exception("Registre al menos una imagen", 1);
        }

        $data_gallery_filename = $data_frm_news_gallery['name'];
        $data_images = array();

        foreach ($data_gallery_filename as $key_filename => $filename) {
            $data_images[] = array(
                    'image' => array('name' => $filename, 'title' => $data_frm_news_gallery['title'][$key_filename] ),
                    'is_gallery' => 1
                );
        }

        try {
            $post->has_gallery = 1;
            $post->save();
            $this->saveGalleryByPost($data_images, $post);
            $response['success'] = true;
            $response['message'] =  'Galeria guardada satisfactoriamente';

            $key = 'dbl_post_view_' . $post->id;

            if(Cache::has($key)){
                Cache::forget($key);
            }

            $key_gallery = 'dbr_post_gallery_' . $post->id;

            if(Cache::has($key_gallery)){
                Cache::forget($key_gallery);
            }

        } catch (Exception $e) {
            $response['success'] = false;
            $response['errors'] =  ['Error:' . $e->getMessage()];
        }

        return Response::json($response);

    }


    public function saveGalleryByPost($data_images, $post){

        if(count($data_images)){

            foreach ($data_images as $image) {

                if(isset($image['is_principal'])){
                    $dbr_post_gallery = $post->galleries()->where('is_principal', 1)->first();

                    if(!$dbr_post_gallery){
                        $dbr_post_gallery = new Gallery();
                    }

                    $dbr_post_gallery->is_principal = $image['is_principal'];
                }else{

                    $dbr_post_gallery = $post->galleries()->where('is_gallery', 1)->where('image', $image['image']['name'])->first();
                    $dbr_post_gallery = ($dbr_post_gallery ? $dbr_post_gallery :new Gallery());
                }

                $dbr_post_gallery->image = $image['image']['name'];
                $dbr_post_gallery->thumbnail_one = $image['image']['name'];
                $dbr_post_gallery->thumbnail_two = $image['image']['name'];

                if(isset($image['image']['title'])){
                     $dbr_post_gallery->title = $image['image']['title'];
                }

                if(isset($image['is_gallery'])){
                    $dbr_post_gallery->is_gallery = 1;
                }

                $post->galleries()->save($dbr_post_gallery);
            }
        }

    }

    public function autoCompleteCategory(){

        if(Request::ajax()){
            $category_id = Input::get('category_id');
            $category_not_id = array(2,24,30,34,35,40,42);
            $dbl_category = Category::getChildrenCategoryByParentId($category_id, $category_not_id)->select('id', 'name')->get()->toArray();

            return Response::json($dbl_category);
        }
    }

    public function autoCompleteTags(){

        if(Request::ajax()){
            $keyword   = Input::get('keyword');
            $limit      = Input::get('limit', 10);

            if(!$keyword){
                return array();
            }

            $dbl_tags = Helpers::getTagByKeyword($keyword, $limit);
            $data_tag = array();
            foreach ($dbl_tags as $dbr_tag) {
                $data_tag[] = $dbr_tag->tag;
            }

            return Response::json($data_tag);
        }
    }

}

?>
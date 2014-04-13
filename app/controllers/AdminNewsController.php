<?php

class AdminNewsController extends BaseController {


    public function listNews()
    {
        $params['type'] = array('NEWS');
        $dbl_post = Post::getPost($params)->paginate(15);
        return View::make('backend.pages.post_list', array('dbl_post' => $dbl_post ));
    }

    public function news($post = null)
    {

        $params['is_new'] = $is_new =  false;
        if(empty($post)){
            $params['is_new'] = $is_new = true;
        }

    	$params['dbl_parent_categories'] = Category::getParentCategories()->get();
        $params['data_type_video'] = array('Y' => Helpers::TYPE_VIDEO_YOUTUBE, 'D' => Helpers::TYPE_VIDEO_DAILYMOTION);

        if(!$is_new){
            $params['dbr_post_category'] = $dbr_post_category = $post->category()->first();
            $params['dbl_categories'] = Category::getChildrenCategoryByParentId($dbr_post_category->parent_id)->get();
            $params['dbl_galleries'] = $post->galleries()->get();
            $params['tags'] = implode(',', Helpers::getTagsByPost($post));
        }

        $params['is_new'] = $is_new;
        $params['dbr_post'] = $post;
    	return View::make('backend.pages.post', $params);
    }


    public function saveNews($post = null)
    {

        $data_frm_news = Input::get('frm_news');

        $is_new = false;
        if(!$post && $data_frm_news['is_new'] == true){
            $is_new = true;
        }

        $post = ($is_new == true ? new Post() : $post);

        $rules = array(
            'title'   => 'required|min:3',
            'category'      => 'required|numeric',
            'subcategory'   => 'required|numeric',
            'summary'       => 'required',
            'keywords'       => 'required',
        );


        if(!empty($data_frm_news['type_video'])){
            $rules['id_video'] = $data_frm_news['id_video'];
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

                if($is_new == true){
                    $post->slug = $data_frm_news['title'];
                }

                if(!empty($data_frm_news['type_video']) && !empty($data_frm_news['id_video'])){
                    $post->type = Helpers::TYPE_POST_VIDEO;
                }else{
                    $post->type = Helpers::TYPE_POST_NEWS;
                }

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

                if(isset($data_frm_news['is_recommended'])){
                    $post->is_recommended = $data_frm_news['is_recommended'];
                }

                $post->content = Helpers::prepareContent($data_frm_news['description']);
                $post->summary = $data_frm_news['summary'];
                $post->category_id = $data_frm_news['subcategory'];
                $data_image_principal = !empty($data_frm_news['image_principal']) ? array(json_decode($data_frm_news['image_principal'], true)) : array();
                //$data_gallery = $data_frm_news['gallery'] ? json_decode($data_frm_news['gallery'],true) : array();
                //$data_images = array_merge($data_image_principal, $data_gallery);

                try {
                    if($post->save()){
                        $data_frm_news['keywords'] = explode(',', $data_frm_news['keywords']);
                        $post->tags = Helpers::getTagIds($data_frm_news['keywords']);
                        $this->saveGalleryByPost($data_image_principal, $post);
                        $response['success'] = true;
                        $response['message'] =  'Nota registrada satisfactorimente';
                        if($is_new){
                            $response['redirect'] =  route('backend.register.edit', array($post->id));
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
                    $dbr_post_gallery = new Gallery();
                }

                $dbr_post_gallery->image = $image['image']['name'];
                $dbr_post_gallery->thumbnail_one = $image['image']['name'];
                $dbr_post_gallery->thumbnail_two = $image['image']['name'];

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

            $dbl_category = Category::getChildrenCategoryByParentId($category_id)->select('id', 'name')->get()->toArray();

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
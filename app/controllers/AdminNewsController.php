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

        if(!$is_new){
            $params['dbr_post_category'] = $dbr_post_category = $post->category()->first();
            $params['dbl_categories'] = Category::getChildrenCategoryByParentId($dbr_post_category->parent_id)->get();
            $params['dbl_galleries'] = $post->galleries()->get();
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
            'keywords'      => 'required',
            'summary'       => 'required'
        );

        $validator = Validator::make($data_frm_news, $rules);

        if($post){
            if ($validator->passes()){

                $post->title = $data_frm_news['title'];

                if($is_new == true){
                    $post->slug = Str::slug($data_frm_news['title']);
                    $post->type = Helpers::TYPE_POST_NEWS;
                }

                $post->content = $data_frm_news['description'];
                $post->summary = $data_frm_news['summary'];
                $post->category_id = $data_frm_news['subcategory'];


                $data_image_principal = $data_frm_news['image_principal'] ? array(json_decode($data_frm_news['image_principal'], true)) : array();
                $data_gallery = $data_frm_news['gallery'] ? json_decode($data_frm_news['gallery'],true) : array();
                $data_images = array_merge($data_image_principal, $data_gallery);

                if($post->save()){

                    if(count($data_images)){
                        foreach ($data_images as $image) {
                            $gallery = new Gallery();

                            $gallery->image = $image['image']['name'];
                            $gallery->thumbnail_one = $image['image']['name'];
                            $gallery->thumbnail_two = $image['image']['name'];


                            if(isset($image['is_principal'])){
                            $gallery->is_principal = 1;
                            }

                            if(isset($image['is_gallery'])){
                            $gallery->is_gallery = 1;
                            }

                            $post->galleries()->save($gallery);
                        }
                    }

                //$post->galeries =

                //return Redirect::to('admin/blogs/' . $post->id . '/edit')->with('success', Lang::get('admin/blogs/messages.update.success'));
                //return "Guardo SatisfactoriMNETE";

                //URL::current()
                }

            }else{
                return Redirect::to('backend/publicaciones/nota/' . $post->id . '/editar')->with('error', 'Error al registrar la nota');
            }
        }else{
            return "La Noticia no existe";
        }

    }

    public function autoCompleteCategory(){

        if(Request::ajax()){
            $category_id = Input::get('category_id');

            $dbl_category = Category::getChildrenCategoryByParentId($category_id)->select('id', 'name')->get()->toArray();

            return Response::json($dbl_category);
        }
    }

}

?>
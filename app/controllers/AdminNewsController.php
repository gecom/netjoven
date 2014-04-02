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
        $params['is_new'] = $is_new =  false;
        if(empty($news_id)){
            $params['is_new'] = $is_new = true;
        }

        $dbr_post = null;
        if($is_new == false){
            $dbr_post = Post::getPostById($news_id);
        }

    	$params['parent_categories'] = Category::getParentCategories()->get();
        $params['is_new'] = $is_new;
        $params['dbr_post'] = $dbr_post;
    	return View::make('backend.pages.post', $params);
    }


    public function saveNews($news_id = null)
    {

        $data_frm_news = Input::all();
        $is_new = false;
        if(empty($news_id) && $data_frm_news['is_new'] == true){
            $is_new = true;
        }

        $post = ($is_new == true ? new Post() : Post::find($news_id));


        $rules = array(
            'title'   => 'required|min:3',
            'category'      => 'required|numeric',
            'subcategory'   => 'required|numeric',
            'keywords'      => 'required',
            'summary'       => 'required',
        );

        $validator = Validator::make($data_frm_news, $rules);

        if($post){
            if ($validator->passes()){

                $post->title = $data_frm_news['title'];
                $post->slug = Str::slug($data_frm_news['slug']);
                $post->content = $data_frm_news['content'];
                $post->summary = $data_frm_news['summary'];
                $post->category_id = $data_frm_news['subcategory'];
                $post->type = Helpers::TYPE_POST_NEWS;
                //$post->title = $data_frm_news['keywords'];
                if($post){
                    return "Guardo SatisfactoriMNETE";
                }

            }else{
                return "Error en la validacion";
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
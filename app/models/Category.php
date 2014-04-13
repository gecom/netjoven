<?php


class Category extends Eloquent {

	protected $table = 'njv_category';

	public function post(){
		return $this->belongsToMany('Post');
	}

    public function directorates()
    {
        return $this->hasMany('Directorate');
    }

    public function childrenCategories(){
        return $this->hasMany('Category', 'parent_id', 'id');
    }

    public function parentCategory()
    {
        return $this->belongsTo('Category','id', 'parent_id');
    }

	public static function getParentCategories($type = Helpers::TYPE_POST_NEWS)
    {
        $dbl_categories = (new Category())
        ->where('parent_id')
        ->where('status', '=', Status::STATUS_ACTIVO);

        if(is_array($type)){
            $dbl_categories->whereIn('type', $type);
        }else{
            if(!empty($type)){
                $dbl_categories->where('type', '=', $type);
            }
        }

        $dbl_categories->orderBy('created_at', 'desc');

        return $dbl_categories;
    }

    public static function getParentCategoryById($parent_id){

		$dbr_parent_category = (new Category())
		->where('id' , '=', $parent_id)
        ->where('parent_id')
		->first();

		return $dbr_parent_category;
    }

    public static function getChildrenCategoryByParentId($parent_id, $type = Helpers::TYPE_POST_NEWS){

        $categories = (new Category())
        ->where('status', '=', Status::STATUS_ACTIVO)
        ->where('type', '=', $type)
		->where('parent_id','=', $parent_id);

        return $categories;
    }

    public static function getParentCategoriesHome(){

        $categories = (new Category())
        ->whereIn('njv_category.type', array(Helpers::TYPE_POST_NEWS, Helpers::TYPE_POST_VIDEO))
        ->where('njv_category.parent_id')
        ->where('njv_category.is_menu', '=', 1);

        return $categories;

    }




}


?>
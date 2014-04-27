<?php


class Category extends Eloquent {

	protected $table = 'njv_category';

	public function post(){
		return $this->belongsToMany('Post');
	}

    public function themeDays(){
        return $this->belongsToMany('ThemeDay');
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

	public static function getParentCategories()
    {
        $dbl_categories = (new Category())
        ->where('parent_id')
        ->where('status', '=', Status::STATUS_ACTIVO);

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

    public static function getChildrenCategoryByParentId($parent_id){

        $categories = (new Category())
        ->where('status', '=', Status::STATUS_ACTIVO)
		->where('parent_id','=', $parent_id);

        return $categories;
    }

    public static function getParentCategoriesHome(){

        $categories = (new Category())
        ->where('njv_category.parent_id')
        ->where('njv_category.is_menu', '=', 1);

        return $categories;

    }




}


?>
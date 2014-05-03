<?php


class Category extends Eloquent {

	protected $table = 'njv_category';

	public function post(){
		return $this->belongsToMany('Post');
	}

    public function themeDays()
    {
        return $this->belongsToMany('ThemeDay');
    }

    public function directorates()
    {
        return $this->hasMany('Directorate');
    }

    public function childrenCategories()
    {
        return $this->hasMany('Category', 'parent_id');
    }

    public function parentCategory()
    {
        return $this->belongsTo('Category', 'parent_id');
    }

    public function scopeGetCategoriesByids($query, $data_category_ids){
        return $query
                ->whereIn('id', $data_category_ids);
    }

	public static function getParentCategories($is_menu = false)
    {
        $dbl_categories = (new Category())
        ->where('parent_id')
        ->where('status', '=', Status::STATUS_ACTIVO);

        if($is_menu == true){
            $dbl_categories->where('is_menu', '=', 1);
        }

        $dbl_categories->orderBy('created_at', 'desc');

        return $dbl_categories;
    }

    public function scopeGetParentCategoryById($query, $parent_id){
        return $query->where('id','=', $parent_id)
                    ->where('parent_id');
    }

    public function scopeGetChildrenCategoryByParentId($query, $parent_id){
        return $query->where('status', '=', Status::STATUS_ACTIVO)
                    ->where('parent_id','=', $parent_id);
    }

    public function scopeGetParentCategoriesHome($query){
        return $query->where('njv_category.parent_id')
                ->where('njv_category.is_menu', '=', 1);
    }




}


?>
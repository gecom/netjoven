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

	public function scopeGetParentCategories($query, $params = array())
    {

        $params_default = array('id' => null, 'is_menu' => false, 'category_not_id' => array() );
        $params = array_merge($params_default, $params);

        $query->where('parent_id')
            ->where('status', '=', Status::STATUS_ACTIVO);


        if(!empty($params['id'])){
            $query->where('id', '=', $params['id']);
        }

        if($params['is_menu']){
            $query->where('is_menu', '=', 1);
        }

        if(is_array($params['category_not_id']) && count($params['category_not_id'])){
            $query->whereNotIn('id', $params['category_not_id']);
        }

       return $query;
    }

    public function scopeGetParentCategoryById($query, $parent_id){
        return $query->where('id','=', $parent_id)
                    ->where('parent_id');
    }

    public function scopeGetChildrenCategoryByParentId($query, $parent_id, $category_not_id = array()){
        $query->where('status', '=', Status::STATUS_ACTIVO)
                ->where('parent_id','=', $parent_id);

        if(is_array($category_not_id) && count($category_not_id)){
            $query->whereNotIn('id', $category_not_id);
        }

        return $query;
    }

    public function scopeGetParentCategoriesHome($query){
        return $query->where('njv_category.parent_id')
                ->where('njv_category.is_menu', '=', 1);
    }

    public function scopeGetCategoryBySlug($query, $slug){
        return $query->where('njv_category.slug', '=', $slug);
    }

}


?>
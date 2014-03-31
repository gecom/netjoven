<?php 


class Category extends Eloquent {

	protected $table = 'njv_category';

	public function post(){
		return $this->belongsToMany('Post');
	}

	public static function getParentCategories()
    {
        $dbl_categories = (new Category())
        ->where('parent_id  IS NULL')
        ->where('status', '=', Status::STATUS_ACTIVO);

        return $dbl_categories;
    }

    public static function getParentCategoryById($children_id){

		$dbr_parent_category = (new Category())
		->where('id' , '=', $children_id)
		->first();

		return $dbr_parent_category;
    }

    

	
}


?>
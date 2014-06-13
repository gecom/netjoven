<?php 

class CategoryHelper {

	public static function getCategoryChildrenByParent($category_id, $category_not_id = array()){

		return Category::getChildrenCategoryByParentId($category_id, $category_not_id);

	}
}

?>


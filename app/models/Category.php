<?php 


class Category extends Eloquent {

	protected $table = 'njv_category';

	public function post(){
		return $this->belongsToMany('Post');
	}

	
}


?>
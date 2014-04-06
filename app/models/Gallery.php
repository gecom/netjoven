<?php 

class Gallery extends Eloquent {

protected $table = 'njv_post_multimedia';
  public $timestamps = false;

	public function post(){
		return $this->belongsTo('Post');
	}

}


?>
<?php 

class Tag extends Eloquent {
	protected $table =  'njv_tag';

    public function posts()
    {
        return $this->belongsToMany('Post');
    }

}

?>
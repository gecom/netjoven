<?php

class UserProfile extends Eloquent {

	protected $table =  'njv_user_profile';

	public function user()
    {
        return $this->belongsTo('User');
    }


}

?>
<?php 


class UserTool extends Eloquent {

	protected $table =  'njv_user_tools';

	public function user()
    {
        return $this->belongsTo('User');
    }

    public function colorPalette()
    {
        return $this->belongsTo('ColorPalette');
    }

    public function scopeGetToolByUserId($query, $user_id){
    	return $query->where('user_id', '=', $user_id);
    }


}


?>
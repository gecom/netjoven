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


}


?>
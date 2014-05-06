<?php 

class ColorPalette extends Eloquent {

	protected $table =  'njv_color_palette';

    public function userColors()
    {
        return $this->hasMany('UserTool');
    }


}

?>
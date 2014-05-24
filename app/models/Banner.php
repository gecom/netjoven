<?php 

class Banner extends Eloquent {
	protected $table =  'njv_banner';

	public function bannerDetails()
    {
        return $this->hasMany('BannerDetail');
    }

}


?>
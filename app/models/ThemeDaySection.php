<?php

class ThemeDaySection extends Eloquent {

	protected $table =  'njv_theme_day_section';

	public function themeDay()
	{
		return $this->belongsTo('ThemeDay');
	}

}


?>
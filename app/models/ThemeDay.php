<?php


class ThemeDay extends Eloquent {

	protected $table =  'njv_theme_day';

	public function category()
	{
		return $this->belongsTo('Category');
	}

	public function setSlugAttribute($value){

		$slug = Str::slug($value);

		$slugCount = count( $this->whereRaw("slug REGEXP '^{$slug}(-[0-9]*)?$'")->get() );

		$slugFinal = ($slugCount > 0) ? "{$slug}-{$slugCount}" : $slug;

		$this->attributes['slug'] = $slugFinal;
	}

	public static function getThemeDay(){

		$dbl_theme_day = (new ThemeDay())
		->select('id', 'name', DB::raw('(SELECT slug from njv_category c where c.id = njv_theme_day.category_id ) as category_slug'),'slug', 'params', 'color');

		return $dbl_theme_day;

//		SELECT name,(SELECT slug from njv_category c where c.id = d.category_id ) as category_slug, slug, params, color from njv_theme_day d
	}

}

?>
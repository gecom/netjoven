<?php


class ThemeDay extends Eloquent {

	protected $table =  'njv_theme_day';

	public function category()
	{
		return $this->belongsTo('Category');
	}

	public function sections()
    {
        return $this->belongsToMany('Category', 'njv_theme_day_section');
    }

    public function setSectionsAttribute($category_ids)
    {
        $this->sections()->sync($category_ids, true);
    }

	public function setSlugAttribute($value){

		$slug = Str::slug($value);

		$slugCount = count( $this->whereRaw("slug REGEXP '^{$slug}(-[0-9]*)?$'")->get() );

		$slugFinal = ($slugCount > 0) ? "{$slug}-{$slugCount}" : $slug;

		$this->attributes['slug'] = $slugFinal;
	}

	public static function getThemeDay(){

		$dbl_theme_day = (new ThemeDay())
			->select('njv_theme_day.tag_id', 'njv_tag.tag', 'njv_tag.slug', 'njv_theme_day.color', 'njv_theme_day.params', DB::raw('GROUP_CONCAT(njv_theme_day_section.category_id) as sections'))
			->join('njv_tag', 'njv_tag.id', '=', 'njv_theme_day.tag_id')
			->leftJoin('njv_theme_day_section', 'njv_theme_day.id', '=', 'njv_theme_day_section.theme_day_id')
			->groupBy('njv_theme_day.tag_id');

		return $dbl_theme_day;

	}

}

?>
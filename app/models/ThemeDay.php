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
			->select('njv_theme_day.tag_id', 'njv_tag.tag', 'njv_tag, slug', 'njv_theme_day.color', 'njv_theme_day.params', DB::raw('GROUP_CONCAT(s.category_id) as sections'))
			->join('njv_tag', 'njv_tag.id', '=', 'njv_theme_day.tag_id')
			->leftJoin('njv_theme_day_section', 'njv_theme_day.id', '=', 'njv_theme_day_section.theme_day_id')
			->groupBy('njv_theme_day.tag_id');

		return $dbl_theme_day;



		/*select a.tag_id, a.color, params, GROUP_CONCAT(s.category_id) as sections from njv_theme_day a
INNER JOIN njv_tag b ON a.tag_id = b.id
LEFT JOIN njv_theme_day_section s ON a.id = s.theme_day_id
GROUP BY a.tag_id

		$dbl_theme_day = (new ThemeDay())
		->select('id', 'name', DB::raw('(SELECT slug from njv_category c where c.id = njv_theme_day.category_id ) as category_slug'),'slug', 'params', 'coloz<r');

		return $dbl_theme_day;*/

//		SELECT name,(SELECT slug from njv_category c where c.id = d.category_id ) as category_slug, slug, params, color from njv_theme_day d
	}

}

?>
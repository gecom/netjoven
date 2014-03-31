<?php 

class Tag extends Eloquent {
	protected $table =  'njv_tag';

    public function posts()
    {
        return $this->belongsToMany('Post');
    }

    public static function getTagByPostId($post_id)
    {
		$dbr_tag = (new Tag())
			->select(Helpers::$prefix_table . 'tag.id',
					Helpers::$prefix_table . 'tag.tag',
					Helpers::$prefix_table . 'tag.slug')
			->join(Helpers::$prefix_table . 'post_tag', Helpers::$prefix_table . 'post_tag.tag_id', '=', Helpers::$prefix_table . 'tag.id')
			->where(Helpers::$prefix_table . 'post_tag.post_id', '=', $post_id);

		return $dbr_tag;
    }

}

?>
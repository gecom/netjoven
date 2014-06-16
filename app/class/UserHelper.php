<?php

class UserHelper{

	const LEVEL_USER_ADMIN = 'admin';
	const LEVEL_USER_GOOD = 'good';
	const LEVEL_USER_MODE = 'mode';
	const LEVEL_USER_NORMAL = 'usuario';

	const TYPE_SOCIAL_FACEBOOK = 'fb';
	const TYPE_SOCIAL_TWITTER = 'tw';

	public static $type_social = array(
		self::TYPE_SOCIAL_FACEBOOK => 'Facebook',
		self::TYPE_SOCIAL_TWITTER => 'Twitter'
	);

	public static function getUsersAdmin(){
		return User::getAdmin()
					->with(array('userProfile' => function($query){
							return $query->orderBy('first_name')->orderBy('last_name');
					}))
					->get();
	}

	public static function getImageAvatarUser($dbr_user, $dbr_user_profile, $type_image = 'normal' ){

		$image_avatar = null;

		if($dbr_user && $dbr_user_profile){
			if($dbr_user->user_social){ //square, nomral
				$image_avatar = $dbr_user_profile->image.'?type='.$type_image;
			}else{
	            $data_image = explode("-",$dbr_user_profile->image);
	            $directory = ($type_image == 'normal' ? 'user/'.$data_image[0] : 'user/'.$data_image[0].'/pp');
	            $image_avatar = Helpers::getImage($data_image[1], $directory);
			}

		}

		return $image_avatar;
	}


	public static function getUserRedactor($user_id){
		return User::getAdmin()->where('id', '=', $user_id)
		->with(array('userProfile' => function($query){
			$query->select('user_id', 'first_name', 'last_name');
		}))->first();
	}

	public static function getCountry(){
		return DB::table('njv_country')
					->select('code','country')
					->orderBy('country', 'asc')->get();
	}

	public static function getCountrybyName($name = ''){

		return DB::table('njv_country')
					->select('code','country')
					->where('country', '=', $name)
					->first();
	}

	public static function getDepartment(){
		return DB::table('njv_department')
					->select('id','department')
					->orderBy('department', 'asc')->get();
	}

	public static function getDepartmentByName($name){
		return DB::table('njv_department')
					->select('id','department')
					->where('department', '=', $name)
					->first();
	}

	public static function getCityByCountry($name){
		if(!$name){
			return;
		}

		$dbr_country = self::getCountrybyName($name);

		return DB::table('njv_city')
					->select('id','city as name')
					->where('country_code', '=', $dbr_country->code)
					->orderBy('city', 'asc')->get();

	}

	public static function getProvinceByDepartment($name){
		$dbr_department = self::getDepartmentByName($name);

		return DB::table('njv_province')
					->select('id','province as name')
					->where('id', '=', $dbr_department->id)
					->orderBy('province', 'asc')->get();

	}

}

?>
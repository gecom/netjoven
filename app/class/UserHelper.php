<?php

class UserHelper{

	const LEVEL_USER_ADMIN = 'admin';
	const LEVEL_USER_GOOD = 'good';
	const LEVEL_USER_MODE = 'mode';
	const LEVEL_USER_NORMAL = 'usuario';

	public static function getUsersAdmin(){
		return User::getAdmin()
					->with(array('userProfile' => function($query){
							return $query->orderBy('first_name')->orderBy('last_name');
					}))
					->get();
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
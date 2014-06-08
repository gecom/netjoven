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

}

?>
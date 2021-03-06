<?php

use Illuminate\Auth\UserInterface;
use Illuminate\Auth\Reminders\RemindableInterface;

class User extends Eloquent implements UserInterface, RemindableInterface {


	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'njv_user';

	/**
	 * The attributes excluded from the model's JSON form.
	 *
	 * @var array
	 */
	protected $hidden = array('password');

	/**
	 * Get the unique identifier for the user.
	 *
	 * @return mixed
	 */
	public function getAuthIdentifier()
	{
		return $this->getKey();
	}

	/**
	 * Get the password for the user.
	 *
	 * @return string
	 */
	public function getAuthPassword()
	{
		return $this->password;
	}

	/**
	 * Get the e-mail address where password reminders are sent.
	 *
	 * @return string
	 */
	public function getReminderEmail()
	{
		return $this->email;
	}

	public function getRememberToken()
	{
		return $this->remember_token;
	}

	public function setRememberToken($value)
	{
		$this->remember_token = $value;
	}

	public function getRememberTokenName()
	{
		return 'remember_token';
	}

	public function userProfile()
    {
        return $this->hasOne('UserProfile');
    }

	public function userTool()
    {
        return $this->hasOne('UserTool');
    }

    public function scopeGetAdmin($query){
    	return $query->whereIn('level', array(UserHelper::LEVEL_USER_ADMIN, UserHelper::LEVEL_USER_GOOD, UserHelper::LEVEL_USER_MODE));
    }



}
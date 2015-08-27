<?php namespace App;
use Illuminate\Database\Eloquent\Model;

class Group extends Model{

	public function events()
	{
		return $this->hasMany('App\Event');
	}

	public function posts()
	{
		return $this->hasMany('App\Post');
	}

	public function missions()
	{
		return $this->hasMany('App\Mission');
	}

}
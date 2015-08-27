<?php namespace App;
use Illuminate\Database\Eloquent\Model;

class Event extends Model{
	
	public function likes()
	{
		return $this->hasMany('App\EventLike');
	}

	public function group()
	{
		return $this->belongsTo('App\Group');
	}


}
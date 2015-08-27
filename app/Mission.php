<?php namespace App;
use Illuminate\Database\Eloquent\Model;

class Mission extends Model{
	
	 public function group()
	{
		return $this->belongsTo('App\Group');
	}
}
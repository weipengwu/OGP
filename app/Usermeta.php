<?php namespace App;
use Illuminate\Database\Eloquent\Model;

class Usermeta extends Model{

	protected $table = 'user_meta';

	public $timestamps = false;

	public function user()
	{
		return $this->belongsTo('App\User');
	}

}
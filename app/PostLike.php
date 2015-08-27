<?php namespace App;
use Illuminate\Database\Eloquent\Model;

class PostLike extends Model{

	protected $table = 'postlikes';

	public $timestamps = false;

	public function post()
	{
		return $this->belongsTo('App\Post');
	}

}
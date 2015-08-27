<?php namespace App;
use Illuminate\Database\Eloquent\Model;

class PostComment extends Model{

	protected $table = 'post_comments';

	public function event()
	{
		return $this->belongsTo('App\Post');
	}
}
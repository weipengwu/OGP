<?php namespace App;
use Illuminate\Database\Eloquent\Model;
use Nicolaslopezj\Searchable\SearchableTrait;
use Jenssegers\Date\Date;

class Post extends Model{

	use SearchableTrait;

	protected $searchable = [
        'columns' => [
            'title' => 10,
            'content' => 5,
        ],
    ];
	
	public function comments()
	{
		return $this->hasMany('App\PostComment');
	}

	public function likes()
	{
		return $this->hasMany('App\PostLike');
	}

	public function group()
	{
		return $this->belongsTo('App\Group');
	}

	public function author()
	{
		return $this->belongsTo('App\User');
	}
	public function getCreatedAtAttribute($value)
	{
	    return Date::instance($value);
	}
}
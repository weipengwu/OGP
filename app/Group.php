<?php namespace App;
use Illuminate\Database\Eloquent\Model;
use Nicolaslopezj\Searchable\SearchableTrait;

class Group extends Model{

	use SearchableTrait;

	protected $searchable = [
        'columns' => [
            'name' => 10,
            'description' => 5,
        ],
    ];

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
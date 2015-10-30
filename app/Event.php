<?php namespace App;
use Illuminate\Database\Eloquent\Model;

class Event extends Model{

	use SearchableTrait;

	protected $searchable = [
        'columns' => [
            'title' => 10,
            'content' => 5,
        ],
    ];
	
	public function likes()
	{
		return $this->hasMany('App\EventLike');
	}

	public function group()
	{
		return $this->belongsTo('App\Group');
	}


}
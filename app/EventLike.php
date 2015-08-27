<?php namespace App;
use Illuminate\Database\Eloquent\Model;

class EventLike extends Model{

	protected $table = 'eventlikes';

	public $timestamps = false;

	public function event()
	{
		return $this->belongsTo('App\Event');
	}

}
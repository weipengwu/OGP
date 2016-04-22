<?php namespace App\Http\Controllers;
use App\Event;
use App\Group;
use App\Post;

class SearchController extends Controller {

	public function search()
	{
		if(isset($_GET['q'])){
			$query = $_GET['q'];
			$posts = Post::search($query)->get();
			$groups = Group::where('verified', '1')->search($query)->get();
			$events = Event::search($query)->get();

			return view('search.index')->with('posts', $posts)->with('events', $events)->with('groups', $groups);
		}else{
			return view('search.index')->with('posts', array())->with('events', array())->with('groups', array());
		}
	}


}
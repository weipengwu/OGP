<?php namespace App\Http\Controllers;
use App\Event;
use App\Group;
use App\Post;

class SearchController extends Controller {

	public function search()
	{
		$query = $_GET['q'];
		$posts = Post::search($query)->get();
		$groups = Group::search($query)->get();
		$events = Event::search($query)->get();

		return view('search.index')->with('posts', $posts->toArray())->with('events', $events->toArray())->with('groups', $groups->toArray());
	}


}
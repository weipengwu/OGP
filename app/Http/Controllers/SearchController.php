<?php namespace App\Http\Controllers;
use App\Event;
use App\Group;
use App\Post;

class SearchController extends Controller {

	public function search()
	{
		$query = $_GET['q'];
		$posts = Post::search($query)->get();

		return view('search.index')->with('posts', $posts);
	}


}
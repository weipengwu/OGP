<?php namespace App\Http\Controllers;
use App\Event;
use App\Post;

class HomeController extends Controller {

	/*
	|--------------------------------------------------------------------------
	| Home Controller
	|--------------------------------------------------------------------------
	|
	| This controller renders your application's "dashboard" for users that
	| are authenticated. Of course, you are free to change or remove the
	| controller as you wish. It is just here to get your app started!
	|
	*/

	/**
	 * Create a new controller instance.
	 *
	 * @return void
	 */
	public function __construct()
	{
		$this->middleware('auth');
	}

	/**
	 * Show the application dashboard to the user.
	 *
	 * @return Response
	 */
	public function index()
	{
		$events = Event::join('groups', function($join){
			$join->on('groups.id', '=', 'events.group_id')->where('groups.verified', '=', '1');
		})->select('events.*')->orderBy('events.created_at', 'DESC')->take(10)->get();
		//$events = Event::orderBy('created_at', 'DESC')->simplePaginate(5);
		$posts = Post::join('groups', function($join){
			$join->on('groups.id', '=', 'posts.group_id')->where('groups.verified', '=', '1');
		})->where('posts.featured', '=', '1')->select('posts.*')->orderBy('posts.created_at', 'DESC')->paginate(18);
		return view('home')->with('events', $events)->with('allposts', $posts);
	}

}

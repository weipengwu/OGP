<?php namespace App\Http\Controllers;
use App\Group;
use App\Post;
use App\Member;
use App\Event;
use App\EventLike;
use App\Mission;

class WelcomeController extends Controller {

	/*
	|--------------------------------------------------------------------------
	| Welcome Controller
	|--------------------------------------------------------------------------
	|
	| This controller renders the "marketing page" for the application and
	| is configured to only allow guests. Like most of the other sample
	| controllers, you are free to modify or remove it as you desire.
	|
	*/

	/**
	 * Create a new controller instance.
	 *
	 * @return void
	 */
	public function __construct()
	{
		$this->middleware('guest');
	}

	/**
	 * Show the application welcome screen to the user.
	 *
	 * @return Response
	 */
	public function index()
	{
		$events = Event::join('groups', function($join){
			$join->on('groups.id', '=', 'events.group_id')->where('groups.verified', '=', '1');
		})->select('events.*')->orderBy('events.created_at', 'DESC')->take(10)->get();
		$posts = Post::join('groups', function($join){
			$join->on('groups.id', '=', 'posts.group_id')->where('groups.verified', '=', '1');
		})->where('posts.featured', '=', '1')->select('posts.*')->orderBy('posts.created_at', 'DESC')->paginate(18);
		return view('welcome')->with('events', $events)->with('allposts', $posts);
	}

}

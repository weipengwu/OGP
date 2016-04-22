<?php namespace App\Http\Controllers;
use App\User;
use App\Group;
use App\Post;
use App\Ticket;
use Request;

class AdminController extends Controller {

	/*
	|--------------------------------------------------------------------------
	| Admin Controller
	|--------------------------------------------------------------------------
	|
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
		return view('admin.adminogp');
	}

	public function users()
	{
		$users = User::all();
		return view('admin.adminusers')->with('users', $users);
	}

	public function brands()
	{
		$brands = Group::all();
		return view('admin.adminbrands')->with('brands', $brands);
	}

	public function posts()
	{
		$posts = Post::all()->sortByDesc("created_at");
		return view('admin.adminposts')->with('posts', $posts);
	}

	public function tickets()
	{
		$tickets = Ticket::all()->sortByDesc("created_at");
		return view('admin.admintickets')->with('tickets', $tickets);
	}

	public function approve()
	{
		$bid = Request::input('brand');
		$brand = Group::find($bid);
		$brand->verified = '1';
		$brand->save();
		echo 'Active';
	}

	public function disapprove()
	{
		$bid = Request::input('brand');
		$brand = Group::find($bid);
		$brand->verified = '0';
		$brand->save();
		echo 'Pending';
	}

	public function postfeature()
	{
		$pid = Request::input('pid');
		$post = Post::find($pid);
		$post->featured = '1';
		$post->save();

		echo "success";
	}
	public function postunfeature()
	{
		$pid = Request::input('pid');
		$post = Post::find($pid);
		$post->featured = '0';
		$post->save();

		echo "success";
	}
}
<?php namespace App\Http\Controllers;
use App\Following;
use App\User;
use Request;

class ProfileController extends Controller {

	/*
	|--------------------------------------------------------------------------
	| Profile Controller
	|--------------------------------------------------------------------------
	*/

	/**
	 * Create a new controller instance.
	 *
	 * @return void
	 */
	// public function __construct()
	// {
	// 	$this->middleware('auth');
	// }

	/**
	 * Show the application new profile screen to the user.
	 *
	 * @return Response
	 */

	public function viewUser($id)
	{
		$user = User::findOrFail($id);
		return view('profiles.view')->with('user', $user);
	}

	public function followUser()
	{
		$toid = Request::input('to-id');
		$myid = Request::input('my-id');
		$follow = new Following();
		$follow->user_id = $toid;
		$follow->followed_id = $myid;
		$follow->save();

		echo 'success';
	}
	public function unfollowUser()
	{
		$toid = Request::input('to-id');
		$myid = Request::input('my-id');
		$follow = Following::where('user_id', $toid)->where('followed_id', $myid);
		$follow->delete();

		echo 'success';
	}

}
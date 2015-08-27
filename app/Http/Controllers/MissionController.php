<?php namespace App\Http\Controllers;
use App\Mission;
use App\Group;
use Request;
use Validator;

class MissionController extends Controller {

	/*
	|--------------------------------------------------------------------------
	| Mission Controller
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
	 * Show the application new mission screen to the user.
	 *
	 * @return Response
	 */
	public function index()
	{
		return view('missions.index')->with('missions', Mission::orderBy('created_at', 'DESC')->get());
	}
	public function newMission($slug)
	{
		$gid = Group::where('slug', $slug)->pluck('id');
		return view('missions.new')->with('gid', $gid);
	}
	public function createMission()
	{
		$mission = new Mission();
		
			$mission->author = Request::input('author');
			$mission->title = Request::input('title');
			$mission->fromtime = Request::input('fromtime');
			$mission->totime = Request::input('totime');
			$mission->city = Request::input('city');
			$mission->address = Request::input('address');
			$mission->bounty = Request::input('bounty');
			$mission->content = nl2br(Request::input('content'));
			$mission->group_id = Request::input('gid');
			$mission->save();

			return redirect()->route('viewMission', [ 'id' => $mission->id ]);
		
	}

	public function viewMission($id)
	{
		$mission = Mission::findOrFail($id);

		return view('missions.view')->with('mission', $mission);
	}

	public function applyMission($id)
	{
		$mission = Mission::findOrFail($id);

		return view('missions.apply')->with('mission', $mission);
	}

	public function sendResume($id)
	{
		
	}


}

<?php namespace App\Http\Controllers;
use App\Event;
use App\EventLike;
use App\Group;
use Request;
use Validator;

class EventController extends Controller {

	/*
	|--------------------------------------------------------------------------
	| Event Controller
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
	 * Show the application new event screen to the user.
	 *
	 * @return Response
	 */
	public function index()
	{
		if(isset($_GET['category'])){
			$groups = Group::where('category', $_GET['category'])->get();
			$groups_id = [];
			foreach ($groups as $group) {
				array_push($groups_id, $group->id);			
			}
			if(isset($_GET['time'])){

			}else{
				return view('events.index')->with('events', Event::whereIn('group_id',$groups_id)->orderBy('created_at', 'DESC')->get());
			}

		}else{
			if(isset($_GET['time'])){
				$time = $_GET['time'];
				$nextmondytime = strtotime('next Monday');
				$nextsudaytime = strtotime('next Sunday');
				if ($time == 'nextweek'){
					return view('events.index')->with('events', Event::where('fromtime', '>', $nextmondytime)->where('fromtime', '<', $nextsudaytime)->orderBy('created_at', 'DESC')->get());
				}else{
					$currenttime = time();
					return view('events.index')->with('events', Event::where('fromtime', '>', $currenttime)->where('fromtime', '<', $nextmondytime)->orderBy('created_at', 'DESC')->get());
				}
			}else{
				return view('events.index')->with('events', Event::orderBy('created_at', 'DESC')->get());
			}
		}
	}
	public function newEvent($slug)
	{
		$gid = Group::where('slug', $slug)->pluck('id');
		return view('events.new')->with('gid', $gid);
	}
	public function createEvent()
	{
		$event = new Event();
		if(Request::file('banner')){
			$file = array('banner' => Request::file('banner'));
			$rules = array('banner' => 'required|image');
			$validator = Validator::make($file, $rules);
			if ($validator->fails()){
				return redirect()->back()->withErrors($validator);
			}else{
				if (Request::file('banner')->isValid()) {
			      $destinationPath = 'uploads'; // upload path
			      $extension = Request::file('banner')->getClientOriginalExtension(); // getting image extension
			      $fileName = 'Event_'.date('YmdHis').'_'.rand(111111,999999).'.'.$extension; // renameing image
			      Request::file('banner')->move($destinationPath, $fileName); // uploading file to given path
				  $event->banner = $destinationPath."/".$fileName;
				  $event->author = Request::input('author');
				  $event->title = Request::input('title');
				  $fromtime = Request::input('fromtime');
				  $unixfromtime = strtotime($fromtime);
				  $event->fromtime = $unixfromtime;
				  $totime = Request::input('totime');
				  $unixtotime = strtotime($totime);
				  $event->totime = $unixtotime;
				  $event->city = Request::input('city');
				  $event->address = Request::input('address');
				  $event->fee = Request::input('fee');
			      $event->content = nl2br(Request::input('content'));
			      $event->group_id = Request::input('gid');
				  $event->save();
			
					return redirect()->route('viewEvent', [ 'id' => $event->id ]);
			    }
			}
		}else{
			$event->banner = 'img/defaultbg'.rand(1,8).'.jpg';
			$event->author = Request::input('author');
			$event->title = Request::input('title');
			$fromtime = Request::input('fromtime');
			$unixfromtime = strtotime($fromtime);
			$event->fromtime = $unixfromtime;
			$totime = Request::input('totime');
			$unixtotime = strtotime($totime);
			$event->totime = $unixtotime;
			$event->city = Request::input('city');
			$event->address = Request::input('address');
			$event->fee = Request::input('fee');
			$event->content = nl2br(Request::input('content'));
			$event->group_id = Request::input('gid');
			$event->save();

			return redirect()->route('viewEvent', [ 'id' => $event->id ]);
		}
	}

	public function viewEvent($id)
	{
		$event = Event::findOrFail($id);

		return view('events.view')->with('event', $event);
	}


	public function eventLike()
	{
		$eid = Request::input('event-id');
		$event = Event::findOrFail($eid);
		$like = new EventLike();
		$like->author_id = Request::input('author-id');
		$like->event_id = $eid;
		$event->likes()->save($like);

		$count = EventLike::where('event_id','=',$eid)->count();
		echo $count;
	}
	public function eventUnlike()
	{
		$eid = Request::input('event-id');
		$uid = Request::input('author-id');
		$event = Event::findOrFail($eid);
		$like = EventLike::where('event_id','=',$eid)->where('author_id','=',$uid);
		$event->likes()->delete($like);

		$count = EventLike::where('event_id','=',$eid)->count();
		echo $count;
	}
}

<?php namespace App\Http\Controllers;
use App\Event;
use App\EventLike;
use App\Group;
use App\Following;
use App\User;
use Request;
use Validator;
use Stripe\Stripe;
use Config;
use Image;
use Mail;

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
				if(date('l') == 'Sunday'){
					$nextsudaytime = strtotime('next Sunday');
				}else{
					$nextsudaytime = strtotime('next Sunday', $nextmondytime);
				}
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
		$eventimages = array();
			if(Request::file('postimage1')){

				$file = array('postimage1' => Request::file('postimage1'));
				$rules = array('postimage1' => 'required|image|max:4096');
				$validator = Validator::make($file, $rules);
				if ($validator->fails()){
					return redirect()->back()->withErrors($validator);
				}else{
					if (Request::file('postimage1')->isValid()) {
			      		$destinationPath = 'uploads'; // upload path
			      		//$originalname = Request::file('postimage1')->getClientOriginalName();
			      		$extension = Request::file('postimage1')->getClientOriginalExtension(); // getting image extension
			      		$fileName = 'Event_'.date('YmdHis').'_'.rand(111111,999999).'.'.$extension; // renameing image
			      		Request::file('postimage1')->move($destinationPath, $fileName); // uploading file to given path
				  		$postimage1 = $destinationPath."/".$fileName;
				  		$img = Image::make($postimage1);
				  		$img->resize(900, null, function ($constraint) {
						    $constraint->aspectRatio();
						    $constraint->upsize();
						});
						$img->save($destinationPath."/Medium_".$fileName);
						array_push($eventimages, $fileName);
					}
				}
			}
			if(Request::file('postimage2')){
				$file = array('postimage2' => Request::file('postimage2'));
				$rules = array('postimage2' => 'required|image|max:4096');
				$validator = Validator::make($file, $rules);
				if ($validator->fails()){
					return redirect()->back()->withErrors($validator);
				}else{
					if (Request::file('postimage2')->isValid()) {
			      		$destinationPath = 'uploads'; // upload path
			      		//$originalname = Request::file('postimage2')->getClientOriginalName();
			      		$extension = Request::file('postimage2')->getClientOriginalExtension(); // getting image extension
			      		$fileName = 'Event_'.date('YmdHis').'_'.rand(111111,999999).'.'.$extension; // renameing image
			      		Request::file('postimage2')->move($destinationPath, $fileName); // uploading file to given path
				  		$postimage2 = $destinationPath."/".$fileName;
						$img = Image::make($postimage2);
				  		$img->resize(900, null, function ($constraint) {
						    $constraint->aspectRatio();
						    $constraint->upsize();
						});
						$img->save($destinationPath."/Medium_".$fileName);
						array_push($eventimages, $fileName);
					}
				}
			}
			if(Request::file('postimage3')){
				$file = array('postimage3' => Request::file('postimage3'));
				$rules = array('postimage3' => 'required|image|max:4096');
				$validator = Validator::make($file, $rules);
				if ($validator->fails()){
					return redirect()->back()->withErrors($validator);
				}else{
					if (Request::file('postimage3')->isValid()) {
			      		$destinationPath = 'uploads'; // upload path
			      		//$originalname = Request::file('postimage3')->getClientOriginalName();
			      		$extension = Request::file('postimage3')->getClientOriginalExtension(); // getting image extension
			      		$fileName = 'Event_'.date('YmdHis').'_'.rand(111111,999999).'.'.$extension; // renameing image
			      		Request::file('postimage3')->move($destinationPath, $fileName); // uploading file to given path
				  		$postimage3 = $destinationPath."/".$fileName;
						$img = Image::make($postimage3);
				  		$img->resize(900, null, function ($constraint) {
						    $constraint->aspectRatio();
						    $constraint->upsize();
						});
						$img->save($destinationPath."/Medium_".$fileName);
						array_push($eventimages, $fileName);
					}
				}
			}
			if(Request::file('postimage4')){
				$file = array('postimage4' => Request::file('postimage4'));
				$rules = array('postimage4' => 'required|image|max:4096');
				$validator = Validator::make($file, $rules);
				if ($validator->fails()){
					return redirect()->back()->withErrors($validator);
				}else{
					if (Request::file('postimage4')->isValid()) {
			      		$destinationPath = 'uploads'; // upload path
			      		//$originalname = Request::file('postimage4')->getClientOriginalName();
			      		$extension = Request::file('postimage4')->getClientOriginalExtension(); // getting image extension
			      		$fileName = 'Event_'.date('YmdHis').'_'.rand(111111,999999).'.'.$extension; // renameing image
			      		Request::file('postimage4')->move($destinationPath, $fileName); // uploading file to given path
				  		$postimage4 = $destinationPath."/".$fileName;
						$img = Image::make($postimage4);
				  		$img->resize(900, null, function ($constraint) {
						    $constraint->aspectRatio();
						    $constraint->upsize();
						});
						$img->save($destinationPath."/Medium_".$fileName);
						array_push($eventimages, $fileName);
					}
				}
			}
		if(Request::file('banner')){
			$file = array('banner' => Request::file('banner'));
			$rules = array('banner' => 'required|image|max:4096');
			$validator = Validator::make($file, $rules);
			if ($validator->fails()){
				return redirect()->back()->withErrors($validator);
			}else{
				if (Request::file('banner')->isValid()) {
			      $destinationPath = 'uploads'; // upload path
			      $extension = Request::file('banner')->getClientOriginalExtension(); // getting image extension
			      $fileName = 'Event_'.date('YmdHis').'_'.rand(111111,999999).'.'.$extension; // renameing image
			      Request::file('banner')->move($destinationPath, $fileName); // uploading file to given path
			      $bannerimage = $destinationPath."/".$fileName;
			      $img = Image::make($bannerimage);
				  		$img->resize(1200, null, function ($constraint) {
						    $constraint->aspectRatio();
						    $constraint->upsize();
						});
						$img->save($destinationPath."/Large_".$fileName);
					$img->resize(800, null, function ($constraint) {
						    $constraint->aspectRatio();
						    $constraint->upsize();
						});
						$img->save($destinationPath."/Medium_".$fileName);
					$eventbanner = $fileName;
				  $event->banner = $eventbanner;
			    }
			}
		}else{
			$eventbanner = 'defaultbg'.rand(1,6).'.jpg';
			$event->banner = $eventbanner;
		}

			$event->author = Request::input('author');
			$event->type = Request::input('type');
			$event->title = Request::input('title');
			$timezone = Request::input('timezone');
			$event->timezone = $timezone;
			$fromtime = Request::input('fromtime');
			$unixfromtime = strtotime($fromtime.' '.$timezone);
			$event->fromtime = $unixfromtime;
			$totime = Request::input('totime');
			$unixtotime = strtotime($totime.' '.$timezone);
			$event->totime = $unixtotime;
			$event->city = Request::input('city');
			$event->suitenum = Request::input('suitenum');
			$event->address = Request::input('address');
			if(Request::input('selectprice') == 'Free'){
				$eventfee = 'Free';
				$event->fee = $eventfee;
			}else{
				$eventfee = Request::input('fee');
				$event->fee = $eventfee;
				$event->currency = Request::input('eventcurrency');
			}
			$event->content = nl2br(Request::input('content'));
			$event->gallery = implode(',', $eventimages);
			$event->group_id = Request::input('gid');
			$event->save();
			$eventid = $event->id;
			$gslug = getGroupSlug(Request::input('gid'));
			$gname = getGroupName(Request::input('gid'));
			
			if( Following::where('followed_id', Request::input('gid'))->count() > 0 ){
				Mail::queue(['html' => 'emails.newevent'], ['eventid' => $eventid, 'eventtitle' => Request::input('title'), 'eventbanner' => $eventbanner, 'gslug' => $gslug, 'gname' => $gname, 'eventfee' => $eventfee, 'location' => Request::input('address'), 'fromtime' => $unixfromtime, 'totime' => $unixtotime], function($message)
		        {
		            $message->from('noreply@ohgoodparty.com', 'OGP');
		            $followers = Following::where('followed_id', Request::input('gid'))->get();
		            foreach ($followers as $follower) {
		            	$user = User::where('id', $follower->user_id)->get();
		            	$message->to('members@ohgoodparty.com', 'Members')->bcc($user[0]->email)->subject('New Event on OGP');
		            }

		        });
			}

			return redirect()->route('viewEvent', [ 'id' => $event->id ]);
	}

	public function editEvent($id)
	{
		$event = Event::findOrFail($id);
		return view('events.edit')->with('event', $event);
	}

	public function editingEvent()
	{
		$event = Event::find(Request::input('eid'));
		if(Request::file('banner')){
			$file = array('banner' => Request::file('banner'));
			$rules = array('banner' => 'required|image|max:4096');
			$validator = Validator::make($file, $rules);
			if ($validator->fails()){
				return redirect()->back()->withErrors($validator);
			}else{
				if (Request::file('banner')->isValid()) {
			      $destinationPath = 'uploads'; // upload path
			      $extension = Request::file('banner')->getClientOriginalExtension(); // getting image extension
			      $fileName = 'Event_'.date('YmdHis').'_'.rand(111111,999999).'.'.$extension; // renameing image
			      Request::file('banner')->move($destinationPath, $fileName); // uploading file to given path
			      $bannerimage = $destinationPath."/".$fileName;
			      $img = Image::make($bannerimage);
				  		$img->resize(1200, null, function ($constraint) {
						    $constraint->aspectRatio();
						    $constraint->upsize();
						});
						$img->save($destinationPath."/Large_".$fileName);
					$img->resize(800, null, function ($constraint) {
						    $constraint->aspectRatio();
						    $constraint->upsize();
						});
						$img->save($destinationPath."/Medium_".$fileName);
				  $event->banner = $fileName;
			    }
			}
		}
			$event->author = Request::input('author');
			$event->title = Request::input('title');
			$event->type = Request::input('type');
			$fromtime = Request::input('fromtime');
			$unixfromtime = strtotime($fromtime);
			$event->fromtime = $unixfromtime;
			$totime = Request::input('totime');
			$unixtotime = strtotime($totime);
			$event->totime = $unixtotime;
			$event->suitenum = Request::input('suitenum');
			$event->address = Request::input('address');
			$event->city = Request::input('city');
			if(Request::input('selectprice') == 'Free'){
				$event->fee = 'Free';
			}else{
				$event->fee = Request::input('fee');
				$event->currency = Request::input('eventcurrency');
			}
			$event->content = nl2br(Request::input('content'));
			$event->group_id = Request::input('gid');
			$event->save();

			return redirect()->route('viewEvent', [ 'id' => $event->id ]);
	}

	public function viewEvent($id)
	{
		$event = Event::findOrFail($id);

		return view('events.view')->with('event', $event);
	}

	public function deleteEvent($id)
	{
		$event = Event::findOrFail($id);
		$event->delete();

		return redirect()->route('dashboard');
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
		$event->likes()->where('author_id','=',$uid)->delete();

		$count = EventLike::where('event_id','=',$eid)->count();
		echo $count;
	}

	public function eventCharge()
	{
		$event = Event::findOrFail(Request::input('eid'));
		\Stripe\Stripe::setApiKey(Config::get('stripe.stripe.secret'));

		if($event->quantity > 0 ){
			try {
				$token  = Request::get('stripeToken');

				  $customer = \Stripe\Customer::create(array(
				      'email' => Request::get('stripeEmail'),
				      'card'  => $token
				  ));

				  $charge = \Stripe\Charge::create(array(
				      'customer' => $customer->id,
				      'amount'   => $event->fee,
				      'currency' => 'usd'
				  ));
				echo '<h1>Successfully charged CAD $'.$event->fee.'!</h1>';
			} catch(\Stripe\Error\Card $e){
				echo $e->getMessage();
			}
		}
	}
}

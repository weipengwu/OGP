<?php namespace App\Http\Controllers;
use App\User;
use App\Usermeta;
use Auth;
use Request;
use Validator;
use Image;
use App\Message;

class DashboardController extends Controller {

	/*
	|--------------------------------------------------------------------------
	| Dashboard Controller
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

	public function index()
	{
		return view('dashboard.index');
	}

	public function updateProfile()
	{
		$id = Request::input('user');
		$user = User::findOrFail($id);
		//create or edit profile image
		if(Request::file('u-profile')){
			if(count(Usermeta::where('user_id', $id)->where('meta_key','profile')->get()) > 0){
				$meta_id = Usermeta::where('user_id', $id)->where('meta_key','profile')->pluck('id');
				$profile = Usermeta::find($meta_id);
				
				$file = array('u-profile' => Request::file('u-profile'));
				$rules = array('u-profile' => 'required|image|max:4096');
				$validator = Validator::make($file, $rules);
				if ($validator->fails()){
					return redirect()->back()->withErrors($validator);
				}else{
						if (Request::file('u-profile')->isValid()){
							$destinationPath = 'uploads'; // upload path
					      	$extension = Request::file('u-profile')->getClientOriginalExtension(); // getting image extension
					      	$fileName = 'U_Profile_'.date('YmdHis').'_'.rand(111111,999999).'.'.$extension; // renameing image
					      	Request::file('u-profile')->move($destinationPath, $fileName); // uploading file to given path
					      	$profileimage = $destinationPath."/".$fileName;
			      		    $img = Image::make($profileimage);
					      	$img->resize(300, null, function ($constraint) {
							    $constraint->aspectRatio();
							    $constraint->upsize();
							});
							$img->save($destinationPath."/Small_".$fileName);
							$profile->meta_key = 'profile';
							$profile->meta_value = $fileName;
							$profile->save();
						}
					}
				
			}else{

				$profile = new Usermeta();
				$profile->user_id = $id;
					$file = array('u-profile' => Request::file('u-profile'));
					$rules = array('u-profile' => 'required|image|max:4096');
					$validator = Validator::make($file, $rules);
					if ($validator->fails()){
						return redirect()->back()->withErrors($validator);
					}else{

						if (Request::file('u-profile')->isValid()){
							$destinationPath = 'uploads'; // upload path
					      	$extension = Request::file('u-profile')->getClientOriginalExtension(); // getting image extension
					      	$fileName = 'U_Profile_'.date('YmdHis').'_'.rand(111111,999999).'.'.$extension; // renameing image
					      	Request::file('u-profile')->move($destinationPath, $fileName); // uploading file to given path
							$profile->meta_key = 'profile';
							$profile->meta_value = $destinationPath."/".$fileName;
							$profile->save();
						}
					}
				
			}
		}
		//edit or create bio
		if(Request::input('desc')){
			if(count(Usermeta::where('user_id', $id)->where('meta_key','description')->get()) > 0){
				$meta_id = Usermeta::where('user_id', $id)->where('meta_key','description')->pluck('id');
				$profile = Usermeta::find($meta_id);
				$profile->meta_key = 'description';
				$profile->meta_value = nl2br(Request::input('desc'));
				$profile->save();
				$user->name = Request::input('username');
				$user->email = Request::input('useremail');
				$user->save();
			}else{
				$profile = new Usermeta();
				$profile->user_id = $id;
				$profile->meta_key = 'description';
				$profile->meta_value = nl2br(Request::input('desc'));
				$profile->save();
				$user->name = Request::input('username');
				$user->email = Request::input('useremail');
				$user->save();
			}
		}else{
				$user->name = Request::input('username');
				$user->email = Request::input('useremail');
				$user->save();
		}

		return redirect()->route('dashboard');
	}

	public function viewMessages()
	{
		$id = Auth::user()->id;
		$messages = Message::where('sentto', $id)->orderBy('created_at', 'DESC')->get();
		return view('dashboard.messages')->with('messages', $messages);
	}

	public function messageuser($id)
	{
		$user = Auth::user()->id;
		$inbox = ['sentto'=>$user, 'sentby'=>$id];
		$outbox = ['sentby'=>$user, 'sentto'=>$id];
		$readmessages = Message::where($inbox)->get();
		foreach ($readmessages as $readmessage) {
			if($readmessage->unread == '1'){
				$readmessage->unread = '0';
				$readmessage->save();
			}
		}
		$messages = Message::where($inbox)->orWhere($outbox)->orderBy('created_at', 'ASC')->get();
		return view('dashboard.messageuser')->with('sentto', $id)->with('messages', $messages);
	}

	public function sendMessage()
	{
		$sentto = Request::input('sentto');
		$sentby = Request::input('sentby');
		$message = new Message();
		$message->sentto = $sentto;
		$message->sentby = $sentby;
		$message->message = nl2br(Request::input('message'));
		$message->unread = '1';
		$message->save();

		return redirect()->back();
	}
}

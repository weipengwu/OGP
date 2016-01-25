<?php namespace App\Http\Controllers;
use App\User;
use App\Usermeta;
use Request;
use Validator;

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
}

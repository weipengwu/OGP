<?php namespace App\Http\Controllers;
use App\Group;
use App\Member;
use App\Following;
use App\Post;
use Request;
use Validator;
use Image;

class GroupController extends Controller {

	/*
	|--------------------------------------------------------------------------
	| Group Controller
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
	 * Show the application new group screen to the user.
	 *
	 * @return Response
	 */
	public function index()
	{
		return view('groups.index')->with('groups', Group::orderBy('created_at', 'DESC')->get())->with('artsgroups',Group::where('category','Arts & Design')->orderBy('created_at', 'DESC')->get())->with('autogroups',Group::where('category','Auto')->orderBy('created_at', 'DESC')->get())->with('businessgroups',Group::where('category','Business')->orderBy('created_at', 'DESC')->get())->with('educationgroups',Group::where('category','Education')->orderBy('created_at', 'DESC')->get())->with('fashiongroups',Group::where('category','Fashion')->orderBy('created_at', 'DESC')->get())->with('foodgroups',Group::where('category','Food & Drink')->orderBy('created_at', 'DESC')->get())->with('gamesgroups',Group::where('category','Games')->orderBy('created_at', 'DESC')->get())->with('healthgroups',Group::where('category','Health')->orderBy('created_at', 'DESC')->get())->with('homegroups',Group::where('category','Home')->orderBy('created_at', 'DESC')->get())->with('musicgroups',Group::where('category','Music')->orderBy('created_at', 'DESC')->get())->with('sportsgroups',Group::where('category','Sports')->orderBy('created_at', 'DESC')->get())->with('technologygroups',Group::where('category','Technology')->orderBy('created_at', 'DESC')->get())->with('travelgroups',Group::where('category','Travel')->orderBy('created_at', 'DESC')->get())->with('othergroups',Group::where('category','Other')->orderBy('created_at', 'DESC')->get());
	}
	public function newGroup()
	{
		return view('groups.new');
	}
	public function createGroup()
	{
		$user = Request::input('owner');
		$checkGroup = Group::where('owner',$user)->count();
		if($checkGroup > 0){
			//one user can only create one brand
			return redirect()->back()->withErrors("You can only have one brand!");
		}else{
			//double check brand name
			$bname =  Request::input('name');
			$checkBname = Group::where('name',$bname)->count();
			if($checkBname > 0){
				return redirect()->back()->withErrors("Brand name is unavailable, please choose another one.");
			}else{
				//create new brand
				$group = new Group();
				if(Request::file('g-profile')){
					$file = array('g-profile' => Request::file('g-profile'));
					$rules = array('g-profile' => 'required|image|max:4096');
					$validator = Validator::make($file, $rules);
					if ($validator->fails()){
						return redirect()->back()->withErrors($validator);
					}else{
						if (Request::file('g-profile')->isValid()){
							$destinationPath = 'uploads'; // upload path
					      $extension = Request::file('g-profile')->getClientOriginalExtension(); // getting image extension
					      $fileName = 'Group_'.date('YmdHis').'_'.rand(111111,999999).'.'.$extension; // renameing image
					      Request::file('g-profile')->move($destinationPath, $fileName); // uploading file to given path
						  
							$profileimage = $destinationPath."/".$fileName;
			      		  $img = Image::make($profileimage);
					  		$img->resize(600, null, function ($constraint) {
							    $constraint->aspectRatio();
							    $constraint->upsize();
							});
							$img->save($destinationPath."/Medium_".$fileName);
							$img->resize(300, null, function ($constraint) {
							    $constraint->aspectRatio();
							    $constraint->upsize();
							});
							$img->save($destinationPath."/Small_".$fileName);
							$group->profile = $fileName;
						 
						}
					}
				}else{
					$group->profile = 'img/defaultbg'.rand(1,8).'.jpg';

				}
				if(Request::file('g-banner')){
					$file = array('g-banner' => Request::file('g-banner'));
					$rules = array('g-banner' => 'required|image|max:4096');
					$validator = Validator::make($file, $rules);
					if ($validator->fails()){
						return redirect()->back()->withErrors($validator);
					}else{
						if (Request::file('g-banner')->isValid()){
							$destinationPath = 'uploads'; // upload path
					      $extension = Request::file('g-banner')->getClientOriginalExtension(); // getting image extension
					      $fileName = 'Group_'.date('YmdHis').'_'.rand(111111,999999).'.'.$extension; // renameing image
					      Request::file('g-banner')->move($destinationPath, $fileName); // uploading file to given path
					      $bannerimage = $destinationPath."/".$fileName;
			      		  $img = Image::make($bannerimage);
					  		$img->resize(1200, null, function ($constraint) {
							    $constraint->aspectRatio();
							    $constraint->upsize();
							});
							$img->save($destinationPath."/Large_".$fileName);
						  $group->banner = $fileName;
						}
					}
				}else{
					$group->banner = 'img/defaultbg'.rand(1,8).'.jpg';

				}

				$group->creator = Request::input('creator');
				$group->owner = Request::input('owner');
				$group->name = Request::input('name');
				$slug = slug(Request::input('name'));
				$group->slug = $slug;
				$group->category = Request::input('category');
				$group->tag = Request::input('tag');
				$group->website = Request::input('website');
				$group->originCountry = Request::input('originCountry');
				//$group->originProvince = Request::input('originProvince');
				$group->target = Request::input('target');
				// if(Request::input('translate') == 'no'){
				// 	$group->translate = 'no';
				// }else{
				// 	$group->translate = Request::input('trlang');
				// }
				$group->description = nl2br(Request::input('description'));
				$group->save();
					
				return redirect()->route('viewGroup', [ 'slug' => $slug ]);
			}
		}
	}

	public function editGroup($slug)
	{
		$group = Group::where('slug', $slug)->firstOrFail();
		return view('groups.edit')->with('group', $group);
	}

	public function editingGroup()
	{
		$bname =  Request::input('name');
		$checkBname = Group::where('name',$bname)->count();
		if($checkBname > 0){
			return redirect()->back()->withErrors("Brand name is unavailable, please choose another one.");
		}else{
			$id = Request::input('id');
			$group = Group::where('id', $id)->firstOrFail();
			if(Request::file('g-profile')){
				$file = array('g-profile' => Request::file('g-profile'));
				$rules = array('g-profile' => 'required|image|max:4096');
				$validator = Validator::make($file, $rules);
				if ($validator->fails()){
					return redirect()->back()->withErrors($validator);
				}else{
					if (Request::file('g-profile')->isValid()){
						$destinationPath = 'uploads'; // upload path
				      $extension = Request::file('g-profile')->getClientOriginalExtension(); // getting image extension
				      $fileName = 'Group_'.date('YmdHis').'_'.rand(111111,999999).'.'.$extension; // renameing image
				      Request::file('g-profile')->move($destinationPath, $fileName); // uploading file to given path
				      $profileimage = $destinationPath."/".$fileName;
				      		  $img = Image::make($profileimage);
						  		$img->resize(600, null, function ($constraint) {
								    $constraint->aspectRatio();
								    $constraint->upsize();
								});
								$img->save($destinationPath."/Medium_".$fileName);
								$img->resize(300, null, function ($constraint) {
								    $constraint->aspectRatio();
								    $constraint->upsize();
								});
								$img->save($destinationPath."/Small_".$fileName);
					  $group->profile = $fileName;
					}
				}
			}else{
				//do nothing
			}
			if(Request::file('g-banner')){
				$file = array('g-banner' => Request::file('g-banner'));
				$rules = array('g-banner' => 'required|image|max:4096');
				$validator = Validator::make($file, $rules);
				if ($validator->fails()){
					return redirect()->back()->withErrors($validator);
				}else{
					if (Request::file('g-banner')->isValid()){
						$destinationPath = 'uploads'; // upload path
				      $extension = Request::file('g-banner')->getClientOriginalExtension(); // getting image extension
				      $fileName = 'Group_'.date('YmdHis').'_'.rand(111111,999999).'.'.$extension; // renameing image
				      Request::file('g-banner')->move($destinationPath, $fileName); // uploading file to given path
				      $bannerimage = $destinationPath."/".$fileName;
				      		  $img = Image::make($bannerimage);
						  		$img->resize(1200, null, function ($constraint) {
								    $constraint->aspectRatio();
								    $constraint->upsize();
								});
								$img->save($destinationPath."/Large_".$fileName);
					  $group->banner = $fileName;
					}
				}
			}else{
				//do nothing
			}


			$group->name = Request::input('name');
			$slug = slug(Request::input('name'));
			$group->slug = $slug;
			$group->category = Request::input('category');
			$group->tag = Request::input('tag');
			$group->website = Request::input('website');
			$group->originCountry = Request::input('originCountry');
			//$group->originProvince = Request::input('originProvince');
			$group->target = Request::input('target');
			// if(Request::input('translate') == 'no'){
			// 	$group->translate = 'no';
			// }else{
			// 	$group->translate = Request::input('trlang');
			// }
			$group->description = nl2br(Request::input('description'));
			$group->save();
				
			return redirect()->route('viewGroup', [ 'slug' => $group->slug ]);
		}
	}

	public function viewGroup($slug)
	{
		$group = Group::where('slug', $slug)->firstOrFail();
		$gposts = Post::where('group_id', $group->id)->orderBy('created_at', 'DESC')->paginate(12);

		return view('groups.view')->with('group', $group)->with('gposts', $gposts);
	}

	public function joinGroup()
	{
		$gid = Request::input('gid');
		$member = new Member();
		$member->group_id = $gid;
		$member->user_id = Request::input('uid');
		$member->save();

		$slug = Group::findOrFail($gid)->slug;

		return redirect()->route('viewGroup', [ 'slug' =>  $slug]);
	}
	public function leaveGroup()
	{
		$member = Member::where('user_id', '=', Request::input('uid'))->where('group_id', '=', Request::input('gid'));
		$member->delete();

		$slug = Group::findOrFail($id)->slug;
		return redirect()->route('viewGroup', [ 'slug' =>  $slug]);
	}

	public function follow()
	{
		$gid = Request::input('gid');
		$uid = Request::input('uid');
		$follow = new Following();
		$follow->user_id = Request::input('uid');
		$follow->followed_id = Request::input('gid');
		$follow->save();
		$follower = Following::where('followed_id', Request::input('gid'))->count();

		echo $follower;
	}
	public function unfollow()
	{
		$gid = Request::input('gid');
		$uid = Request::input('uid');
		$follow = Following::where('user_id', $uid)->where('followed_id', $gid);
		$follow->delete();
		$follower = Following::where('followed_id', Request::input('gid'))->count();

		echo $follower;
	}

	public function postDelete($id)
	{
		$post = Post::findOrFail($id);
		$group_id = $post->group_id;
		$slug = Group::findOrFail($group_id)->slug;
		$post->delete();

		return redirect()->route('viewGroup', [ 'slug' => $slug ]);

	}
	public function checkBrandname()
	{
		$bname = Request::input('brandname');
		$group = Group::where('slug', slug($bname))->count();
		if ( $group > 0 ) {
			echo 'duplicated';
		}else{
			echo "pass";
		}
	}
}

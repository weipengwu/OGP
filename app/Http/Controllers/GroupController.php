<?php namespace App\Http\Controllers;
use App\Group;
use App\Member;
use App\Following;
use Request;
use Validator;

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
		return view('groups.index')->with('groups', Group::orderBy('created_at', 'DESC')->get());;
	}
	public function newGroup()
	{
		return view('groups.new');
	}
	public function createGroup()
	{
		$group = new Group();
		if(Request::file('g-profile')){
			$file = array('profile' => Request::file('g-profile'));
			$rules = array('profile' => 'required|image');
			$validator = Validator::make($file, $rules);
			if ($validator->fails()){
				return redirect()->back()->withErrors($validator);
			}else{
				if (Request::file('g-profile')->isValid()){
					$destinationPath = 'uploads'; // upload path
			      $extension = Request::file('g-profile')->getClientOriginalExtension(); // getting image extension
			      $fileName = 'Group_'.date('YmdHis').'_'.rand(111111,999999).'.'.$extension; // renameing image
			      Request::file('g-profile')->move($destinationPath, $fileName); // uploading file to given path
				  $group->profile = $destinationPath."/".$fileName;
				  $group->creator = Request::input('creator');
				  $group->owner = Request::input('owner');
				  $group->name = Request::input('name');
				  $slug = slug(Request::input('name'));
				  $group->slug = $slug;
				  $group->category = Request::input('category');
				  $group->tag = Request::input('tag');
			      $group->website = Request::input('website');
				  $group->type = Request::input('type');
				  $group->description = nl2br(Request::input('description'));
				  $group->save();
			
				  return redirect()->route('viewGroup', [ 'slug' => $slug ]);
				}
			}
		}else{
			$group->profile = 'img/defaultbg'.rand(1,8).'.jpg';
			$group->creator = Request::input('creator');
			$group->owner = Request::input('owner');
			$group->name = Request::input('name');
			$group->slug = slug(Request::input('name'));
			$group->category = Request::input('category');
			$group->tag = Request::input('tag');
			$group->website = Request::input('website');
			$group->type = Request::input('type');
			$group->description = nl2br(Request::input('description'));
			$group->save();
			
			return redirect()->route('viewGroup', [ 'slug' => $group->slug ]);
		}
	}

	public function editGroup($slug)
	{
		$group = Group::where('slug', $slug)->firstOrFail();
		return view('groups.edit')->with('group', $group);
	}

	public function editingGroup()
	{

	}

	public function viewGroup($slug)
	{
		$group = Group::where('slug', $slug)->firstOrFail();

		return view('groups.view')->with('group', $group);
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

		echo 'success';
	}
	public function unfollow()
	{
		$gid = Request::input('gid');
		$uid = Request::input('uid');
		$follow = Following::where('user_id', $uid)->where('followed_id', $gid);
		$follow->delete();

		echo 'success';
	}
}

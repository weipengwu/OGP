<?php namespace App\Http\Controllers;
use App\Post;
use App\PostComment;
use App\PostLike;
use App\Group;
use Request;
use Validator;
use Image;

class PostController extends Controller {

	/*
	|--------------------------------------------------------------------------
	| Post Controller
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
	 * Show the application new post screen to the user.
	 *
	 * @return Response
	 */
	// public function index()
	// {
	// 	return view('posts.index')->with('posts', Post::orderBy('created_at', 'DESC')->get());
	// }
	public function newPost($slug)
	{
		$gid = Group::where('slug', $slug)->pluck('id');
		return view('posts.new')->with('gid', $gid);
	}
	public function createPost()
	{
		$post = new Post();
			$postimages = array();
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
			      		$fileName = 'Post_'.date('YmdHis').'_'.rand(111111,999999).'.'.$extension; // renameing image
			      		Request::file('postimage1')->move($destinationPath, $fileName); // uploading file to given path
				  		$postimage1 = $destinationPath."/".$fileName;
				  		$img = Image::make($postimage1);
				  		$img->resize(900, null, function ($constraint) {
						    $constraint->aspectRatio();
						    $constraint->upsize();
						});
						$img->save($destinationPath."/Medium_".$fileName);
				  		$img->resize(500, null, function ($constraint) {
						    $constraint->aspectRatio();
						    $constraint->upsize();
						});
						$img->save($destinationPath."/Small_".$fileName);
						array_push($postimages, $fileName);
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
			      		$fileName = 'Post_'.date('YmdHis').'_'.rand(111111,999999).'.'.$extension; // renameing image
			      		Request::file('postimage2')->move($destinationPath, $fileName); // uploading file to given path
				  		$postimage2 = $destinationPath."/".$fileName;
						$img = Image::make($postimage2);
				  		$img->resize(900, null, function ($constraint) {
						    $constraint->aspectRatio();
						    $constraint->upsize();
						});
						$img->save($destinationPath."/Medium_".$fileName);
						$img->resize(500, null, function ($constraint) {
						    $constraint->aspectRatio();
						    $constraint->upsize();
						});
						$img->save($destinationPath."/Small_".$fileName);
						array_push($postimages, $fileName);
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
			      		$fileName = 'Post_'.date('YmdHis').'_'.rand(111111,999999).'.'.$extension; // renameing image
			      		Request::file('postimage3')->move($destinationPath, $fileName); // uploading file to given path
				  		$postimage3 = $destinationPath."/".$fileName;
						$img = Image::make($postimage3);
				  		$img->resize(900, null, function ($constraint) {
						    $constraint->aspectRatio();
						    $constraint->upsize();
						});
						$img->save($destinationPath."/Medium_".$fileName);
						$img->resize(500, null, function ($constraint) {
						    $constraint->aspectRatio();
						    $constraint->upsize();
						});
						$img->save($destinationPath."/Small_".$fileName);
						array_push($postimages, $fileName);
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
			      		$fileName = 'Post_'.date('YmdHis').'_'.rand(111111,999999).'.'.$extension; // renameing image
			      		Request::file('postimage4')->move($destinationPath, $fileName); // uploading file to given path
				  		$postimage4 = $destinationPath."/".$fileName;
						$img = Image::make($postimage4);
				  		$img->resize(900, null, function ($constraint) {
						    $constraint->aspectRatio();
						    $constraint->upsize();
						});
						$img->save($destinationPath."/Medium_".$fileName);
						$img->resize(500, null, function ($constraint) {
						    $constraint->aspectRatio();
						    $constraint->upsize();
						});
						$img->save($destinationPath."/Small_".$fileName);
						array_push($postimages, $fileName);
					}
				}
			}
			if(Request::file('postimage5')){
				$file = array('postimage5' => Request::file('postimage5'));
				$rules = array('postimage5' => 'required|image|max:4096');
				$validator = Validator::make($file, $rules);
				if ($validator->fails()){
					return redirect()->back()->withErrors($validator);
				}else{
					if (Request::file('postimage5')->isValid()) {
			      		$destinationPath = 'uploads'; // upload path
			      		//$originalname = Request::file('postimage4')->getClientOriginalName();
			      		$extension = Request::file('postimage5')->getClientOriginalExtension(); // getting image extension
			      		$fileName = 'Post_'.date('YmdHis').'_'.rand(111111,999999).'.'.$extension; // renameing image
			      		Request::file('postimage5')->move($destinationPath, $fileName); // uploading file to given path
				  		$postimage5 = $destinationPath."/".$fileName;
						$img = Image::make($postimage5);
				  		$img->resize(900, null, function ($constraint) {
						    $constraint->aspectRatio();
						    $constraint->upsize();
						});
						$img->save($destinationPath."/Medium_".$fileName);
						$img->resize(500, null, function ($constraint) {
						    $constraint->aspectRatio();
						    $constraint->upsize();
						});
						$img->save($destinationPath."/Small_".$fileName);
						array_push($postimages, $fileName);
					}
				}
			}
			if(Request::file('postimage6')){
				$file = array('postimage6' => Request::file('postimage6'));
				$rules = array('postimage6' => 'required|image|max:4096');
				$validator = Validator::make($file, $rules);
				if ($validator->fails()){
					return redirect()->back()->withErrors($validator);
				}else{
					if (Request::file('postimage6')->isValid()) {
			      		$destinationPath = 'uploads'; // upload path
			      		//$originalname = Request::file('postimage4')->getClientOriginalName();
			      		$extension = Request::file('postimage6')->getClientOriginalExtension(); // getting image extension
			      		$fileName = 'Post_'.date('YmdHis').'_'.rand(111111,999999).'.'.$extension; // renameing image
			      		Request::file('postimage6')->move($destinationPath, $fileName); // uploading file to given path
				  		$postimage6 = $destinationPath."/".$fileName;
						$img = Image::make($postimage6);
				  		$img->resize(900, null, function ($constraint) {
						    $constraint->aspectRatio();
						    $constraint->upsize();
						});
						$img->save($destinationPath."/Medium_".$fileName);
						$img->resize(500, null, function ($constraint) {
						    $constraint->aspectRatio();
						    $constraint->upsize();
						});
						$img->save($destinationPath."/Small_".$fileName);
						array_push($postimages, $fileName);
					}
				}
			}

			if(count($postimages) > 0){
				$post->banner = implode(',', $postimages);
				$post->author = Request::input('author');
				$post->title = Request::input('title');
				$post->content = nl2br(Request::input('content'));
				$post->group_id = Request::input('gid');
				$post->save();

				return redirect()->route('viewPost', [ 'id' => $post->id ]);
			}else{
				return redirect()->back()->withErrors('You must upload at least one image!');
			}
			
	}

	public function viewPost($id)
	{
		$post = Post::findOrFail($id);

		return view('posts.view')->with('post', $post);
	}

	public function createComment($id)
	{
		$post = Post::findOrFail($id);
		$comment = new PostComment();
		$comment->author = Request::input('author');
		$comment->content = nl2br(Request::input('content'));

		$post->comments()->save($comment);

		return redirect()->route('viewPost', [ 'id' => $post->id ]);
	}

	public function postLike()
	{
		$pid = Request::input('post-id');
		$post = Post::findOrFail($pid);
		$like = new PostLike();
		$like->author_id = Request::input('author-id');
		$like->post_id = $pid;
		$post->likes()->save($like);

		$count = PostLike::where('post_id','=',$pid)->count();
		echo $count;
		die();
	}
	public function postUnlike()
	{
		$pid = Request::input('post-id');
		$uid = Request::input('author-id');
		$post = Post::findOrFail($pid);
		$like = PostLike::where('post_id','=',$pid)->where('author_id','=',$uid)->first();
		var_dump($like);

		// $count = PostLike::where('post_id','=',$pid)->count();
		// echo $count;
		// die();
	}

}

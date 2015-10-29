<?php

	function getAuthorname($id){
		$name = DB::table('users')->where('id', $id)->pluck('name');
		return $name;
	}


	function alreadyLikedEvent($id,$eid){
		return DB::table('eventlikes')->where('author_id', $id)->where('event_id', '=', $eid)->count();
	}

	function alreadyLikedPost($id,$pid){
		return DB::table('postlikes')->where('author_id', $id)->where('post_id', '=', $pid)->count();
	}

	function alreadyJoined($uid, $gid){
		return DB::table('members')->where('user_id', '=', $uid)->where('group_id', '=', $gid)->count();
	}

	function memberCount($gid){
		return DB::table('members')->where('group_id', '=', $gid)->count();
	}

	function joinedGroupCount($uid){
		return DB::table('members')->where('user_id', '=', $uid)->count();
	}

	function joinedGroup($uid){
		return DB::table('groups')->join('members', function($join){
			$join->on('members.group_id', '=', 'groups.id');
		})->get();
	}

	function followedGroup($uid){
		$groups_id = DB::table('following')->where('user_id', $uid)->get();
		$ids = [];
		foreach ($groups_id as $group_id) {
			$ids[] = $group_id->followed_id;
		}
		return DB::table('groups')->whereIn('id', $ids)->get();
	}

	function myGroup($uid){
		return DB::table('groups')->where('owner', $uid)->get();
	}
	function isFollowing($uid, $gid){
		return DB::table('following')->where('user_id', $uid)->where('followed_id', $gid)->count();
	}

	function groupFollowers($group_id){
		return DB::table('following')->where('followed_id', $group_id)->get();
	}

	function generateRandomString($length = 8) {
	    $characters = '0123456789abcdefghijklmnopqrstuvwxyz';
	    $charactersLength = strlen($characters);
	    $randomString = '';
	    for ($i = 0; $i < $length; $i++) {
	        $randomString .= $characters[rand(0, $charactersLength - 1)];
	    }
	    return $randomString;
	}
	function getFollowedposts($uid,$skip = 0,$offset = 100){
		$ids = DB::table('following')->where('followed_id', $uid)->select('user_id')->get();
		$uids = [];
		foreach ($ids as $id) {
			$uids[] = $id->user_id;
		}

		$posts = array();
		$posts[] = DB::table('posts')->whereIn('author', $uids)->orderBy('created_at', 'DESC')->skip($skip)->take($offset)->get();
		return $posts;
	}
	function getJoinedevents($groups = array()){
		$events = DB::table('events')->whereIn('group_id', $groups)->orderBy('created_at', 'DESC')->get();
		return $events;
	}
	function getMyevents($uid){
		$events = DB::table('events')->where('author', $uid)->orderBy('created_at', 'DESC')->get();
		return $events;
	}

	function getExcerpt($desc,$length=20){
		if(str_word_count($desc) > $length){
			$words = str_word_count($desc, 2);
			$pos = array_keys($words);
			$excerpt = substr($desc, 0, $pos[$length]) . '...';
		}else{
			$excerpt = $desc;
		}

		return $excerpt;
	}

	function slug($string){
	    return strtolower(trim(preg_replace('~[^0-9a-z]+~i', '-', html_entity_decode(preg_replace('~&([a-z]{1,2})(?:acute|cedil|circ|grave|lig|orn|ring|slash|th|tilde|uml);~i', '$1', htmlentities($string, ENT_QUOTES, 'UTF-8')), ENT_QUOTES, 'UTF-8')), '-'));
	}

	function getGroupName($id){
		$name = DB::table('groups')->where('id', $id)->pluck('name');
		return $name;
	}

	function getGroupSlug($id){
		$slug = DB::table('groups')->where('id', $id)->pluck('slug');
		return $slug;
	}

	function userProfile($user_id){
		return DB::table('user_meta')->where('user_id', $user_id)->where('meta_key', 'profile')->get();
	}

	function userDesc($user_id){
		return DB::table('user_meta')->where('user_id', $user_id)->where('meta_key', 'description')->get();
	}
	function getFirstCharter($str){
		if(empty($str)){return '';}
		$fchar=ord($str{0});
		if($fchar>=ord('A')&&$fchar<=ord('z')) return strtoupper($str{0});
		$s1=iconv('UTF-8','gb2312',$str);
		$s2=iconv('gb2312','UTF-8',$s1);
		$s=$s2==$str?$s1:$str;
		$asc=ord($s{0})*256+ord($s{1})-65536;
		if($asc>=-20319&&$asc<=-20284) return 'A';
		if($asc>=-20283&&$asc<=-19776) return 'B';
		if($asc>=-19775&&$asc<=-19219) return 'C';
		if($asc>=-19218&&$asc<=-18711) return 'D';
		if($asc>=-18710&&$asc<=-18527) return 'E';
		if($asc>=-18526&&$asc<=-18240) return 'F';
		if($asc>=-18239&&$asc<=-17923) return 'G';
		if($asc>=-17922&&$asc<=-17418) return 'H';
		if($asc>=-17417&&$asc<=-16475) return 'J';
		if($asc>=-16474&&$asc<=-16213) return 'K';
		if($asc>=-16212&&$asc<=-15641) return 'L';
		if($asc>=-15640&&$asc<=-15166) return 'M';
		if($asc>=-15165&&$asc<=-14923) return 'N';
		if($asc>=-14922&&$asc<=-14915) return 'O';
		if($asc>=-14914&&$asc<=-14631) return 'P';
		if($asc>=-14630&&$asc<=-14150) return 'Q';
		if($asc>=-14149&&$asc<=-14091) return 'R';
		if($asc>=-14090&&$asc<=-13319) return 'S';
		if($asc>=-13318&&$asc<=-12839) return 'T';
		if($asc>=-12838&&$asc<=-12557) return 'W';
		if($asc>=-12556&&$asc<=-11848) return 'X';
		if($asc>=-11847&&$asc<=-11056) return 'Y';
		if($asc>=-11055&&$asc<=-10247) return 'Z';
		return null;
	}
	// function fetchAll(){
	// 	$events = DB::table('events')->select('title','content','city')->orderBy('created_at', 'DESC');
	// 	$posts = DB::table('posts')->select('title','content','author')->orderBy('created_at', 'DESC');
	// 	return $events->union($posts)->get();
	// }
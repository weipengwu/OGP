@extends('layouts.master')

@section('content')
<div class="bannerwrapper">
	<div class="groupbanner" style="background: #ccc url('<?php echo url()."/".$group->banner;?>') center center no-repeat; background-size: cover;">
		<div class="caption">
			<div class="container">
				<div class="col-md-2">
					<div class="groupprofile" style="background: #666 url('<?php echo url()."/".$group->profile;?>') center center no-repeat; background-size: cover;"></div>
				</div>
				<div class="col-md-10">
				<h1>{{ $group->name }}</h1>
				<p>By {{ getAuthorname($group->owner) }}</p>
				@if(Auth::check())
					@if($group->owner == Auth::user()->id)
						<a href="/groups/{{ $group->slug }}/edit" class="btn btn_logo">Edit Group</a>
					@elseif(isFollowing(Auth::user()->id, $group->id))
						<a href="" class="follow_btn unfollow_group" data-user-id="{{ Auth::user()->id }}" data-group-id="{{ $group->id }}">Following</a>
					@else
						<a href="" class="follow_btn follow_group" data-user-id="{{ Auth::user()->id }}" data-group-id="{{ $group->id }}">Follow</a>
					@endif
				@endif
				</div>
			</div>
		</div>	
	</div>
	<div class="statusbar">
		<div class="left"><span>{{ memberCount($group->id) }} Members</span> <span>{{ count(groupFollowers($group->id)) }} Followers</span> <span>{{ count($group->events) }} Events</span> <span>{{ count($group->posts) }} Posts</span></div>
		<div class="right">
			@if(Auth::check())
				@if($group->owner == Auth::user()->id)
					<a href="<?php echo url();?>/groups/<?php echo $group->slug;?>/events/new"><img src="{{ asset('img/ticket_icon.png') }}" width="20"></a> <a href="<?php echo url();?>/groups/<?php echo $group->slug;?>/posts/new"><img src="{{ asset('img/createpost_icon.png') }}" width="16"></a>
				@else
					<div class="sharebox">
						<a href="" class="social_icons social_tw"><i class="fa fa-twitter"></i></a> <a href="" class="social_icons social_fb"><i class="fa fa-facebook"></i></a> <a href="" class="social_icons social_wc"><i class="fa fa-wechat"></i></a> <a href="" class="social_icons social_wb"><i class="fa fa-weibo"></i></a>
					</div>
					<div class="shareto">
						<a href="" class="share_btn"> <img src="{{ asset('img/share_icon.png') }}" width="16"> </a>
					</div>
					<div class="groupfollow">
						<span><a href=""><img src="{{ asset('img/follow_icon.png') }}" width="20"></a></span>
					</div>
					<div class="groupjoin">
						<span><a href=""><img src="{{ asset('img/join_icon.png') }}" width="16"></a></span>
					</div>
				@endif
			@endif
		</div>
	</div>
</div>

	<div class="panel">
		<div class="panel-body">

			@if(count($group->posts) == 0)
				<section class="container">
					<div class="row noposts">
						<p>No posts</p>
					</div>
				</section>
			@else
				<?php $posts = array();?>
				@foreach ($group->posts as $singlepost)
					<?php 
						array_push($posts, $singlepost);
					?>
				@endforeach
							
				<section class="container">
					<div class="row singlegroup layout84">
							<?php $i = 0;?>
							@foreach ($posts as $post)
								<?php if($i > 1) break;?>
								<div <?php if($i == 0) { echo 'class="col-md-8"';} else{ echo 'class="col-md-4 last"'; } ?>>
									<div class="postfrom"><div>From <a href="/groups/<?php echo $post->group->slug; ?>">{{ $post->group->name }}</a></div>
									<div class="grouppost">{{ $post->group->category }}</div></div>
									<a href="{{ url() }}/posts/<?php echo $post->id; ?>">
										<div class="bannerholder" style="background: #ccc url('<?php echo url().'/'.$post->banner;?>'); background-size: cover;">
										</div>
									</a>
										<div class="postauthor">By {{ getAuthorname($post->author) }}</div>
										<div class="title-area"><a href="{{ url() }}/posts/<?php echo $post->id; ?>"><h3>{{ $post->title }}</h3></a></div>
										<div class="bottom">
											<div class="left">
												
											</div>
											<div class="right">
												<div class="sharebox">
													<a href="" class="social_icons social_tw"><i class="fa fa-twitter"></i></a> <a href="" class="social_icons social_fb"><i class="fa fa-facebook"></i></a> <a href="" class="social_icons social_wc"><i class="fa fa-wechat"></i></a> <a href="" class="social_icons social_wb"><i class="fa fa-weibo"></i></a>
												</div>
												<div class="shareto">
													<a href="" class="share_btn"> <img src="{{ asset('img/share_icon.png') }}" width="16"> </a>
												</div>
												<div class="postcomments">
													<span><a href="{{ url() }}/posts/<?php echo $post->id; ?>"><img src="{{ asset('img/comments_icon.png') }}" width="16"></a></span> <span class="count">{{ count($post->comments) }}</span>
												</div>
												<div class="postlikes">
												@if(Auth::check())
													@if(alreadyLikedPost(Auth::user()->id,$post->id) > 0)
														<span><a href="" data-post-id="{{ $post->id }}" data-author-id="{{ Auth::user()->id }}" class="like_btn post_unlike"><img src="{{ asset('img/already_likes_icon.png') }}" width="16"></a></span>
													@else
														<span><a href="" data-post-id="{{ $post->id }}" data-author-id="{{ Auth::user()->id }}" class="like_btn post_like"><img src="{{ asset('img/likes_icon.png') }}" width="16"></a></span>
													@endif
												@endif
												<span class="count">{{ count($post->likes) }}</span>
												</div>
												
											</div>
										</div>
								</div>
								<?php array_splice($posts,0,1); $i++;?>
							@endforeach
						
						<div class="row-gap"></div>
					</div>
					</section>
					<section class="container">
						<div class="row singlegroup layout444">
							<?php $i = 0; $j = 1; ?>
								@foreach ($posts as $post)
									<?php if($i > 2) break;?>
									<div class="col-md-4<?php if(is_int($j/3)) echo " last";?>">
										<div class="postfrom"><div>From <a href="/groups/<?php echo $post->group->slug; ?>">{{ $post->group->name }}</a></div><div class="grouppost">{{ $post->group->category }}</div></div>
										<a href="{{ url() }}/posts/<?php echo $post->id; ?>"><div class="bannerholder" style="background: #ccc url('<?php echo url().'/'.$post->banner;?>'); background-size: cover;">
											</div></a>
										<div class="postauthor">By {{ getAuthorname($post->author) }}</div>
											<div class="title-area"><a href="{{ url() }}/post/<?php echo $post->id; ?>"><h3>{{ $post->title }}</h3></a></div>
											<div class="excerpt-area">{{ getExcerpt($post->content) }}</div>
											<div class="bottom">
												<div class="left">
													
												</div>
												<div class="right">
													<div class="sharebox">
														<a href="" class="social_icons social_tw"><i class="fa fa-twitter"></i></a> <a href="" class="social_icons social_fb"><i class="fa fa-facebook"></i></a> <a href="" class="social_icons social_wc"><i class="fa fa-wechat"></i></a> <a href="" class="social_icons social_wb"><i class="fa fa-weibo"></i></a>
													</div>
													<div class="shareto">
														<a href="" class="share_btn"><img src="{{ asset('img/share_icon.png') }}" width="16"></a>
													</div>
													<div class="postcomments">
														<span><a href="{{ url() }}/posts/<?php echo $post->id; ?>"><img src="{{ asset('img/comments_icon.png') }}" width="16"></a></span> <span class="count">{{ count($post->comments) }}</span>
													</div>
													<div class="postlikes">
													@if(Auth::check())
														@if(alreadyLikedPost(Auth::user()->id,$post->id) > 0)
															<span><a href="" data-post-id="{{ $post->id }}" data-author-id="{{ Auth::user()->id }}" class="like_btn post_unlike"><img src="{{ asset('img/already_likes_icon.png') }}" width="16"></a></span>
														@else
															<span><a href="" data-post-id="{{ $post->id }}" data-author-id="{{ Auth::user()->id }}" class="like_btn post_like"><img src="{{ asset('img/likes_icon.png') }}" width="16"></a></span>
														@endif
													@endif
													<span class="count">{{ count($post->likes) }}</span>
													</div>
													
												</div>
											</div>
									</div>
								<?php array_splice($posts,0,1); $i++;$j++;?>
								@endforeach
								<div class="row-gap"></div>
						</div>
						</section>
			@endif

			</div>
	</div>
@endsection
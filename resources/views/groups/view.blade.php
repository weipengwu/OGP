@extends('layouts.master')

@section('content')
<div class="bannerwrapper">
	<div class="groupbanner" style="background: #ccc url('<?php echo url()."/uploads/Large_".$group->banner;?>') center center no-repeat; background-size: cover;">
		<div class="caption">
			<div class="container">
				<div class="groupprofile" style="background: #666 url('<?php echo url()."/uploads/Small_".$group->profile;?>') center center no-repeat; background-size: cover;"></div>
				<p class="groupcategory">{{ $group->category }}</p>
				<h1>{{ $group->name }}</h1>
				<p>{!! html_entity_decode($group->description) !!}</p>
				<p><a href="http://{{ $group->website }}" target="_blank" class="website">{{ $group->website }}</a></p>
				@if(Auth::check())
					@if($group->owner == Auth::user()->id)
						<a href="/groups/{{ $group->slug }}/edit" class="btn btn_logo">Edit Brand</a>
					@elseif(isFollowing(Auth::user()->id, $group->id))
						<a href="" class="follow_btn unfollow_group" data-user-id="{{ Auth::user()->id }}" data-group-id="{{ $group->id }}">Following</a>
					@else
						<a href="" class="follow_btn follow_group" data-user-id="{{ Auth::user()->id }}" data-group-id="{{ $group->id }}">Follow</a>
					@endif
				@endif
			</div>
		</div>	
	</div>
	<div class="statusbar">
		<div class="left"><span class="followerNumber">{{ count(groupFollowers($group->id)) }} @if(count(groupFollowers($group->id)) > 1) Followers @else Follower @endif</span> <span>{{ count($group->events) }} @if(count($group->events) > 1) Events @else Event @endif</span> <span>{{ count($group->posts) }} @if(count($group->posts) > 1) Posts @else Post @endif</span></div>
		<div class="right">
			@if(Auth::check())
				@if($group->owner == Auth::user()->id)
					<a class="create_btn" data-toggle="tooltip" title="Create Event" href="<?php echo url();?>/groups/<?php echo $group->slug;?>/events/new"><img src="{{ asset('img/ticket_icon.png') }}" width="20"></a> <a class="create_btn" data-toggle="tooltip" title="Create Post" href="<?php echo url();?>/groups/<?php echo $group->slug;?>/posts/new"><img src="{{ asset('img/createpost_big_icon.png') }}" width="16"></a>
				@else
					<div class="sharebox">
						<a href="" class="social_icons social_tw"><i class="fa fa-twitter"></i></a> <a href="" class="social_icons social_fb"><i class="fa fa-facebook"></i></a> <a href="" class="social_icons social_wc"><i class="fa fa-wechat"></i></a> <a href="" class="social_icons social_wb"><i class="fa fa-weibo"></i></a>
					</div>
					<div class="shareto">
						<a href="" data-toggle="tooltip" title="Share" class="share_btn"> <img src="{{ asset('img/share_icon.png') }}" width="16"> </a>
					</div>
					@if(isFollowing(Auth::user()->id, $group->id))
					<div class="groupfollow">
						<span><a href="" data-toggle="tooltip" title="Unfollow" class="unfollow_group" data-user-id="{{ Auth::user()->id }}" data-group-id="{{ $group->id }}"><img src="{{ asset('img/unfollow_big_icon.png') }}" width="20"></a></span>
					</div>
					@else
					<div class="groupfollow">
						<span><a href="" data-toggle="tooltip" title="Follow" class="follow_group" data-user-id="{{ Auth::user()->id }}" data-group-id="{{ $group->id }}"><img src="{{ asset('img/follow_big_icon.png') }}" width="20"></a></span>
					</div>
					@endif
				@endif
			@endif
		</div>
	</div>
</div>

	<div class="panel">
		<div class="panel-body" id="allposts">

			@if(count($gposts) == 0)
				<section class="container">
					<div class="row noposts">
						<p>No posts</p>
					</div>
				</section>
			@else
				<?php $posts = array();?>
				@foreach ($gposts as $singlepost)
					<?php 
						array_push($posts, $singlepost);
					?>
				@endforeach
				@if(count($posts) > 0)
				<section class="container">
					<div class="row singlegroup layout84">
							<?php $i = 0;?>
							@foreach ($posts as $post)
								<?php if($i > 1) break;?>
								<div <?php if($i == 0) { echo 'class="col-md-8"';} else{ echo 'class="col-md-4 last"'; } ?>>
									<?php if(Auth::check()) : ?>
									<?php if($post->author == Auth::user()->id || $group->owner == Auth::user()->id):?>
										<div class="deletepost"><a class="various" href="#confirmdelete<?php echo $post->id; ?>"><img src="{{ asset('img/delete_icon.png') }}" width="20"></a></div>
										<div id="confirmdelete<?php echo $post->id; ?>" class="confirmdelete">
											<h3>Are you sure to delete this post?</h3>
											<a href="{{ url() }}/posts/<?php echo $post->id; ?>/delete" class="btn btn-danger">Delete</a> <a href="" class="btn btn-logo close_btn">Cancel</a>
										</div>
									<?php endif;?>
									<?php endif;?>
									<div class="postfrom"><div>From <a href="/groups/<?php echo $post->group->slug; ?>">{{ $post->group->name }}</a></div>
									<div class="grouppost">{{ $post->group->category }}</div></div>
									<a href="{{ url() }}/posts/<?php echo $post->id; ?>">
										<?php $banner = explode(',', $post->banner); ?>
										<div class="bannerholder" style="background: #ccc url('<?php echo url().'/uploads/Medium_'.$banner[0];?>') no-repeat center center; background-size: cover;">
										</div>
									</a>
										<?php if($i == 0):?>
										<div class="postinforight">
										<?php endif;?>
											<div class="postauthor">By {{ getAuthorname($post->author) }}</div>
											<div class="title-area"><a href="{{ url() }}/posts/<?php echo $post->id; ?>"><h3>{{ $post->title }}</h3></a></div>
										<?php if($i == 0):?>
											<div class="excerpt-area">{!! html_entity_decode(getExcerpt($post->content)) !!}</div>
										</div>
										<?php endif;?>
										<div class="bottom">
											<div class="left">
												
											</div>
											<div class="right">
												<div class="sharebox">
													<a href="" class="social_icons social_tw"><i class="fa fa-twitter"></i></a> <a href="" class="social_icons social_fb"><i class="fa fa-facebook"></i></a> <a href="" class="social_icons social_wc"><i class="fa fa-wechat"></i></a> <a href="" class="social_icons social_wb"><i class="fa fa-weibo"></i></a>
												</div>
												<div class="shareto">
													<a href="" data-toggle="tooltip" title="Share" class="share_btn"> <img src="{{ asset('img/share_icon.png') }}" width="16"> </a>
												</div>
												<div class="postcomments">
													<span><a href="{{ url() }}/posts/<?php echo $post->id; ?>#leavecomments" data-toggle="tooltip" title="Comments"><img src="{{ asset('img/comments_icon.png') }}" width="16"></a></span> <span class="count">{{ count($post->comments) }}</span>
												</div>
												<div class="postlikes">
												@if(Auth::check())
													@if(alreadyLikedPost(Auth::user()->id,$post->id) > 0)
														<span><a href="" data-toggle="tooltip" title="Unlike" data-post-id="{{ $post->id }}" data-author-id="{{ Auth::user()->id }}" class="like_btn post_unlike"><img src="{{ asset('img/already_likes_icon.png') }}" width="16"></a></span>
													@else
														<span><a href="" data-toggle="tooltip" title="Like" data-post-id="{{ $post->id }}" data-author-id="{{ Auth::user()->id }}" class="like_btn post_like"><img src="{{ asset('img/likes_icon.png') }}" width="16"></a></span>
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
					@endif
					@if(count($posts) > 0)
					<section class="container">
						<div class="row singlegroup layout444">
							<?php $i = 0; $j = 1; ?>
								@foreach ($posts as $post)
									<?php if($i > 2) break;?>
									<div class="col-md-4<?php if(is_int($j/3)) echo " last";?>">
										<?php if(Auth::check()) : ?>
										<?php if($post->author == Auth::user()->id || $group->owner == Auth::user()->id):?>
											<div class="deletepost"><a class="various" href="#confirmdelete<?php echo $post->id; ?>"><img src="{{ asset('img/delete_icon.png') }}" width="20"></a></div>
											<div id="confirmdelete<?php echo $post->id; ?>" class="confirmdelete">
												<h3>Are you sure to delete this post?</h3>
												<a href="{{ url() }}/posts/<?php echo $post->id; ?>/delete" class="btn btn-danger">Delete</a> <a href="" class="btn btn-logo close_btn">Cancel</a>
											</div>
										<?php endif;?>
										<?php endif;?>
										<div class="postfrom"><div>From <a href="/groups/<?php echo $post->group->slug; ?>">{{ $post->group->name }}</a></div><div class="grouppost">{{ $post->group->category }}</div></div>
										<a href="{{ url() }}/posts/<?php echo $post->id; ?>">
										<?php $banner = explode(',', $post->banner); ?>
										<div class="bannerholder" style="background: #ccc url('<?php echo url().'/uploads/Small_'.$banner[0];?>') no-repeat center center; background-size: cover;">
											</div></a>
										<div class="postauthor">By {{ getAuthorname($post->author) }}</div>
											<div class="title-area"><a href="{{ url() }}/post/<?php echo $post->id; ?>"><h3>{{ $post->title }}</h3></a></div>
											<div class="excerpt-area">{!! html_entity_decode(getExcerpt($post->content)) !!}</div>
											<div class="bottom">
												<div class="left">
													
												</div>
												<div class="right">
													<div class="sharebox">
														<a href="" class="social_icons social_tw"><i class="fa fa-twitter"></i></a> <a href="" class="social_icons social_fb"><i class="fa fa-facebook"></i></a> <a href="" class="social_icons social_wc"><i class="fa fa-wechat"></i></a> <a href="" class="social_icons social_wb"><i class="fa fa-weibo"></i></a>
													</div>
													<div class="shareto">
														<a href="" data-toggle="tooltip" title="Share" class="share_btn"><img src="{{ asset('img/share_icon.png') }}" width="16"></a>
													</div>
													<div class="postcomments">
														<span><a href="{{ url() }}/posts/<?php echo $post->id; ?>#leavecomments" data-toggle="tooltip" title="Comments"><img src="{{ asset('img/comments_icon.png') }}" width="16"></a></span> <span class="count">{{ count($post->comments) }}</span>
													</div>
													<div class="postlikes">
													@if(Auth::check())
														@if(alreadyLikedPost(Auth::user()->id,$post->id) > 0)
															<span><a href="" data-toggle="tooltip" title="Unlike" data-post-id="{{ $post->id }}" data-author-id="{{ Auth::user()->id }}" class="like_btn post_unlike"><img src="{{ asset('img/already_likes_icon.png') }}" width="16"></a></span>
														@else
															<span><a href="" data-toggle="tooltip" title="Like" data-post-id="{{ $post->id }}" data-author-id="{{ Auth::user()->id }}" class="like_btn post_like"><img src="{{ asset('img/likes_icon.png') }}" width="16"></a></span>
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
						@if(count($posts) > 0)
							<section class="container posts">
							<div class="row singlegroup layout633">
								<?php $i = 0; $j = 1;?>
									@foreach ($posts as $post)
										<?php if($i >= 3) break;?>
										<div class="<?php if($i == 0) { echo "col-md-6";} else{ echo "col-md-3"; }?><?php if(is_int($j/3)) echo " last";?>">
												<?php if(Auth::check()) : ?>
										<?php if($post->author == Auth::user()->id || $group->owner == Auth::user()->id):?>
											<div class="deletepost"><a class="various" href="#confirmdelete<?php echo $post->id; ?>"><img src="{{ asset('img/delete_icon.png') }}" width="20"></a></div>
											<div id="confirmdelete<?php echo $post->id; ?>" class="confirmdelete">
												<h3>Are you sure to delete this post?</h3>
												<a href="{{ url() }}/posts/<?php echo $post->id; ?>/delete" class="btn btn-danger">Delete</a> <a href="" class="btn btn-logo close_btn">Cancel</a>
											</div>
										<?php endif;?>
										<?php endif;?>
											<div class="postfrom"><div>From <a href="/groups/<?php echo $post->group->slug; ?>">{{ $post->group->name }}</a></div><div class="grouppost">{{ $post->group->category }}</div></div>
											<a href="{{ url() }}/posts/<?php echo $post->id; ?>">
											<?php $banner = explode(',', $post->banner); ?>
												<div class="bannerholder" style="background: #ccc url('<?php echo url().'/uploads/Small_'.$banner[0];?>') no-repeat center center; background-size: cover;">
												</div>
											</a>
												<div class="postauthor">By {{ getAuthorname($post->author) }}</div>
												<div class="title-area"><a href="{{ url() }}/posts/<?php echo $post->id; ?>"><h3>{{ $post->title }}</h3></a></div>
												<?php if($i > 0): ?>
												<div class="excerpt-area">{!! html_entity_decode(getExcerpt($post->content, 12)) !!}</div>
												<?php endif;?>
												<div class="bottom">
													<div class="left">
														
													</div>
													<div class="right">
														<div class="sharebox">
															<a href="" class="social_icons social_tw"><i class="fa fa-twitter"></i></a> <a href="" class="social_icons social_fb"><i class="fa fa-facebook"></i></a> <a href="" class="social_icons social_wc"><i class="fa fa-wechat"></i></a> <a href="" class="social_icons social_wb"><i class="fa fa-weibo"></i></a>
														</div>
														<div class="shareto">
															<a href="" data-toggle="tooltip" title="Share" class="share_btn"><img src="{{ asset('img/share_icon.png') }}" width="16"></a>
														</div>
														<div class="postcomments">
															<span><a href="{{ url() }}/posts/<?php echo $post->id; ?>#leavecomments" data-toggle="tooltip" title="Comments"><img src="{{ asset('img/comments_icon.png') }}" width="16"></a></span> <span class="count">{{ count($post->comments) }}</span>
														</div>
														<div class="postlikes">
														@if(Auth::check())
															@if(alreadyLikedPost(Auth::user()->id,$post->id) > 0)
																<span><a href="" data-toggle="tooltip" title="Unlike" data-post-id="{{ $post->id }}" data-author-id="{{ Auth::user()->id }}" class="like_btn post_unlike"><img src="{{ asset('img/already_likes_icon.png') }}" width="16"></a></span>
															@else
																<span><a href="" data-toggle="tooltip" title="Like" data-post-id="{{ $post->id }}" data-author-id="{{ Auth::user()->id }}" class="like_btn post_like"><img src="{{ asset('img/likes_icon.png') }}" width="16"></a></span>
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
							@if(count($posts) > 0)
								<section class="container posts">
								<div class="row singlegroup layout3333">
									<?php $i = 0; $j = 1;?>
										@foreach ($posts as $post)
											<?php if($i >= 4) break;?>
											<div class="col-md-3<?php if(is_int($j/4)) echo " last";?>">
											<?php if(Auth::check()) : ?>
										<?php if($post->author == Auth::user()->id || $group->owner == Auth::user()->id):?>
											<div class="deletepost"><a class="various" href="#confirmdelete<?php echo $post->id; ?>"><img src="{{ asset('img/delete_icon.png') }}" width="20"></a></div>
											<div id="confirmdelete<?php echo $post->id; ?>" class="confirmdelete">
												<h3>Are you sure to delete this post?</h3>
												<a href="{{ url() }}/posts/<?php echo $post->id; ?>/delete" class="btn btn-danger">Delete</a> <a href="" class="btn btn-logo close_btn">Cancel</a>
											</div>
										<?php endif;?>
										<?php endif;?>
												<div class="postfrom"><div>From <a href="/groups/<?php echo $post->group->slug; ?>">{{ $post->group->name }}</a></div><div class="grouppost">{{ $post->group->category }}</div></div>
												<a href="{{ url() }}/posts/<?php echo $post->id; ?>">
												<?php $banner = explode(',', $post->banner); ?>
													<div class="bannerholder" style="background: #ccc url('<?php echo url().'/uploads/Small_'.$banner[0];?>') no-repeat center center; background-size: cover;">
													</div>
												</a>
													<div class="postauthor">By {{ getAuthorname($post->author) }}</div>
													<div class="title-area"><a href="{{ url() }}/posts/<?php echo $post->id; ?>"><h3>{{ $post->title }}</h3></a></div>
													<div class="excerpt-area">{!! html_entity_decode(getExcerpt($post->content, 12)) !!}</div>
													<div class="bottom">
														<div class="left">
															
														</div>
														<div class="right">
															<div class="sharebox">
																<a href="" class="social_icons social_tw"><i class="fa fa-twitter"></i></a> <a href="" class="social_icons social_fb"><i class="fa fa-facebook"></i></a> <a href="" class="social_icons social_wc"><i class="fa fa-wechat"></i></a> <a href="" class="social_icons social_wb"><i class="fa fa-weibo"></i></a>
															</div>
															<div class="shareto">
																<a href="" data-toggle="tooltip" title="Share" class="share_btn"><img src="{{ asset('img/share_icon.png') }}" width="16"></a>
															</div>
															<div class="postcomments">
																<span><a href="{{ url() }}/posts/<?php echo $post->id; ?>#leavecomments" data-toggle="tooltip" title="Comments"><img src="{{ asset('img/comments_icon.png') }}" width="16"></a></span> <span class="count">{{ count($post->comments) }}</span>
															</div>
															<div class="postlikes">
															@if(Auth::check())
																@if(alreadyLikedPost(Auth::user()->id,$post->id) > 0)
																	<span><a href="" data-toggle="tooltip" title="Unlike" data-post-id="{{ $post->id }}" data-author-id="{{ Auth::user()->id }}" class="like_btn post_unlike"><img src="{{ asset('img/already_likes_icon.png') }}" width="16"></a></span>
																@else
																	<span><a href="" data-toggle="tooltip" title="Like" data-post-id="{{ $post->id }}" data-author-id="{{ Auth::user()->id }}" class="like_btn post_like"><img src="{{ asset('img/likes_icon.png') }}" width="16"></a></span>
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
						<?php echo $gposts->render(); ?>
			@endif

			</div>
	</div>
<script src="{{ asset('js/jquery.infinitescroll.min.js') }}"></script>
<script type="text/javascript">
(function(){

    var loading_options = {
        finishedMsg: "",
        msgText: "<div class='center'>Loading...</div>",
        //img: null
    };
    var pagesNum = <?php echo $gposts->lastPage(); ?>; 
    $('#allposts').infinitescroll({
      loading : loading_options,
      navSelector : "#allposts .pagination",
      nextSelector : "#allposts .pagination li.active + li a",
      itemSelector : "#allposts section.container.posts",
      maxPage: pagesNum
    });
})();
</script>
@endsection
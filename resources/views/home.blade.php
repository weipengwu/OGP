@extends('layouts.master')

@section('content')
<div class="home">
	
		<?php 
			$group = DB::table('groups')->orderBy('created_at', 'desc')->take(1)->get();
		?>
		<section class="container">
		<a href="/groups/{{ $group[0]->slug }}">
			<div class="homebanner" style="background: #ccc url('<?php echo url().'/uploads/Large_'.$group[0]->banner;?>') no-repeat center center; background-size: cover;">
			
				<div class="caption">
					<p>from {{ getAuthorname($group[0]->owner) }}</p>
					<h1>{{ $group[0]->name }}</h1>
				</div>
				<div id="hblikebar">
					<span class="cat">{{ $group[0]->category }}</span>
				</div>
			
			</div>
		</a>
		</section>
			<?php $posts = array();?>
			@foreach ($allposts as $singlepost)
				<?php 
					array_push($posts, $singlepost);
				?>
			@endforeach
		<div id="allposts">
			@if(count($posts) > 0)
			<section class="container posts">
			<div class="row singlegroup layout84">
					<?php $i = 0;?>
					@foreach ($posts as $post)
						<?php if($i > 1) break;?>
						<div <?php if($i == 0) { echo 'class="col-md-8"';} else{ echo 'class="col-md-4 last"'; } ?>>
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
			<section class="container posts">
			<div class="row singlegroup layout444">
				<?php $i = 0; $j = 1; ?>
					@foreach ($posts as $post)
						<?php if($i > 2) break;?>
						<div class="col-md-4<?php if(is_int($j/3)) echo " last";?>">
							<div class="postfrom"><div>From <a href="/groups/<?php echo $post->group->slug; ?>">{{ $post->group->name }}</a></div><div class="grouppost">{{ $post->group->category }}</div></div>
							<a href="{{ url() }}/posts/<?php echo $post->id; ?>">
								<?php $banner = explode(',', $post->banner); ?>
								<div class="bannerholder" style="background: #ccc url('<?php echo url().'/uploads/Small_'.$banner[0];?>') no-repeat center center; background-size: cover;">
								</div></a>
							<div class="postauthor">By {{ getAuthorname($post->author) }}</div>
								<div class="title-area"><a href="{{ url() }}/posts/<?php echo $post->id; ?>"><h3>{{ $post->title }}</h3></a></div>
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
			<section class="events_section container">
				<h2>EVENTS</h2>
				<h4>See What's Happening Around You</h4>
				<div class="home_events">
					<?php $e = 0; ?>
					@foreach ($events as $event)
					<?php
							if ( $event->type == 'private' && isFollowing($event->group_id, Auth::user()->id) == 0 ){
								continue;
							}
						?>
					<?php if($e > 3) break;?>
					<div class="eventgroup">
						<div class="eventgroup-list">
							<a href="/events/{{ $event->id }}">
							<div class="imgholder" style="background: url('<?php echo url()."/uploads/Medium_".$event->banner;?>') center center; background-size: cover;"></div>
							</a>
							<p class="location">{{ $event->city }}</p>
							<h3><a href="events/{{ $event->id }}">{{ $event->title }}</a></h3>
							<div class="event-details">
											<p class="event-info">
												<img src="{{ asset('img/calendar_icon.png') }}" width="14" class="edicons"> 
												<?php 
													if(gmdate('M j',$event->fromtime) == gmdate('M j',$event->totime)) : 
												?>
												{{ gmdate('D, M j',$event->fromtime) }}
												<?php else: ?>
												{{ gmdate('M j',$event->fromtime) }} - {{ gmdate('M j',$event->totime) }}

												<?php endif; ?>
											</p>
							</div>
						</div>
					</div>
					<?php $e++;?>
					@endforeach
				</div>
				<div class="viewmore"><a href="/events">VIEW MORE</a></div>
				<div class="row-gap"></div>
				<div class="divider"></div>
			</section>
			@if(count($posts) > 0)
			<section class="container posts">
			<div class="row singlegroup layout633">
				<?php $i = 0; $j = 1;?>
					@foreach ($posts as $post)
						<?php if($i >= 3) break;?>
						<div class="<?php if($i == 0) { echo "col-md-6";} else{ echo "col-md-3"; }?><?php if(is_int($j/3)) echo " last";?>">
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
			@if(joinedGroupCount(Auth::user()->id) > 0)
			<section class="container">
				<div class="joinedgroups">
					<h3>FOLLOWING</h3>
					<p>Groups that you have are following</p>
					<div class="groupsrow collapsed">
					<?php
						$uid = Auth::user()->id;
						$groups = followedGroup($uid);
						$f =1;
						//$groups_id = array();
						foreach ($groups as $group) :
					?>
						<div class="grouplist<?php if(is_int($f/4)) echo " last";?>">
							<a href="groups/{{ $group->slug }}">
							<div class="bannerholder" style="background: #ccc url('{{$group->profile}}') no-repeat center center;background-size:cover"></div>
							<div class="caption">
								<h3>{{ $group->name }}</h3>
								<p>{{ memberCount($group->id) }} Members</p>
							</div>
							</a>
						</div>
						<?php 
							//array_push($groups_id, $group->group_id);
						?>
					<?php $f++; endforeach;?>
					</div>
					<div class="showall"><a href="">SHOW ALL</a></div>
					<div class="joinmore"><a href="/groups">Follow more groups to get more information</a></div>

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
			@if(count($posts) > 0)
			<section class="container posts">
			<div class="row singlegroup layout633">
				<?php $i = 0; $j = 1;?>
					@foreach ($posts as $post)
						<?php if($i >= 3) break;?>
						<div class="<?php if($i == 0) { echo "col-md-6";} else{ echo "col-md-3"; }?><?php if(is_int($j/3)) echo " last";?>">
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
			<div class="row singlegroup layout444">
				<?php $i = 0; $j = 1; ?>
					@foreach ($posts as $post)
						<?php if($i > 2) break;?>
						<div class="col-md-4<?php if(is_int($j/3)) echo " last";?>">
							<div class="postfrom"><div>From <a href="/groups/<?php echo $post->group->slug; ?>">{{ $post->group->name }}</a></div><div class="grouppost">{{ $post->group->category }}</div></div>
							<a href="{{ url() }}/posts/<?php echo $post->id; ?>">
								<?php $banner = explode(',', $post->banner); ?>
								<div class="bannerholder" style="background: #ccc url('<?php echo url().'/uploads/Small_'.$banner[0];?>') no-repeat center center; background-size: cover;">
								</div></a>
							<div class="postauthor">By {{ getAuthorname($post->author) }}</div>
								<div class="title-area"><a href="{{ url() }}/posts/<?php echo $post->id; ?>"><h3>{{ $post->title }}</h3></a></div>
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
			<?php echo $allposts->render(); ?>
		</div>

</div>
<script src="{{ asset('js/jquery.infinitescroll.min.js') }}"></script>
<script type="text/javascript">
(function(){

    var loading_options = {
        finishedMsg: "",
        msgText: "<div class='center'>Loading...</div>",
        img: "{{ asset('img/spinner.gif') }}"
    };
    var pagesNum = <?php echo $allposts->lastPage(); ?>; 
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

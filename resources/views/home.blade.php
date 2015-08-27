@extends('layouts.master')

@section('content')
<div class="home">
	
		<?php 
			$group = DB::table('groups')->orderBy('created_at', 'desc')->take(1)->get();
		?>
		<section class="container">
		<div class="homebanner">
			<a href="/groups/{{ $group[0]->slug }}"><img src=<?php echo url()."/".$group[0]->profile;?> alt="" class="banner-img"/>
			<div class="caption">
				<p>from {{ getAuthorname($group[0]->owner) }}</p>
				<h1>{{ $group[0]->name }}</h1>
			</div>
			<div id="hblikebar">
				<span class="cat">{{ $group[0]->category }}</span>
			</div>
			</a>
		</div>
		</section>
			<?php $posts = array();?>
			@foreach ($allposts as $singlepost)
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
								<?php $banner = explode(',', $post->banner); ?>
								<div class="bannerholder" style="background: url('<?php echo url().'/'.$banner[0];?>'); background-size: cover;">
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
							<a href="{{ url() }}/posts/<?php echo $post->id; ?>"><div class="bannerholder" style="background: url('<?php echo url().'/'.$post->banner;?>'); background-size: cover;">
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
			<section class="events_section">
				<h2>EVENTS</h2>
				<h4>See What's Happening Around You</h4>
				<div class="home_events">
					<?php $e = 0; ?>
					@foreach ($events as $event)
					<?php if($e > 4) break;?>
					<a href="/events/{{ $event->id }}">
					<div class="col" style="background: url('{{ $event->banner }}');background-size:cover;">
						<div class="caption">
							<h3>{{ $event->title }}</h3>
						</div>
					</div>
					</a>
					<?php $e++;?>
					@endforeach
				</div>
				<div class="row-gap"></div>
				<div class="row-gap"></div>
				<div class="row-gap"></div>
				<div class="container">
					<div class="divider"></div>
				</div>
			</section>
			
			<section class="container">
			<div class="row singlegroup layout633">
				<?php $i = 0; $j = 1;?>
					@foreach ($posts as $post)
						<?php if($i >= 3) break;?>
						<div class="<?php if($i == 0) { echo "col-md-6";} else{ echo "col-md-3"; }?><?php if(is_int($j/3)) echo " last";?>">
							<div class="postfrom"><div>From <a href="/groups/<?php echo $post->group->slug; ?>">{{ $post->group->name }}</a></div><div class="grouppost">{{ $post->group->category }}</div></div>
							<a href="{{ url() }}/posts/<?php echo $post->id; ?>">
								<div class="bannerholder" style="background: url('<?php echo url().'/'.$post->banner;?>'); background-size: cover;">
								</div>
							</a>
								<div class="postauthor">By {{ getAuthorname($post->author) }}</div>
								<div class="title-area"><a href="{{ url() }}/posts/<?php echo $post->id; ?>"><h3>{{ $post->title }}</h3></a></div>
								<div class="excerpt-area">{{ getExcerpt($post->content, 12) }}</div>
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
			<section class="container">
				<div class="joinedgroups">
					<h3>JOINED GROUPS</h3>
					<p>Groups that you have already joined</p>
					<div class="groupsrow">
					<?php
						$uid = Auth::user()->id;
						$groups = joinedGroup($uid);
						$i =1;
						$groups_id = array();
						foreach ($groups as $group) :
					?>
						<div class="grouplist<?php if(is_int($i/4)) echo " last";?>">
							<a href="groups/<?= $group->slug;?>">
							<div class="bannerholder" style="background: url('{{$group->profile}}');background-size:cover"></div>
							<div class="caption">
								<h3>{{ $group->name }}</h3>
								<p>{{ memberCount($group->group_id) }} Members</p>
							</div>
							</a>
						</div>
						<?php 
							array_push($groups_id, $group->group_id);
						?>
					<?php endforeach;$i++;?>
					</div>
					<div class="joinmore"><a href="">Join more groups to get more information</a></div>
					<!-- <div class="row singlegroup">
					<?php 
						$gevents = getJoinedevents($groups_id);
						foreach ($gevents as $gevent) :
					?>
						<div class="col-md-4">
							<a href="{{ url() }}/events/<?php echo $gevent->id; ?>"><img src=<?php echo url()."/".$gevent->banner;?> alt="event banner" class="banner-img"/></a>
								<p class="type">Events</p>
								<div class="title-area"><a href="{{ url() }}/events/<?php echo $gevent->id; ?>"><h4>{{ $gevent->title }}</h4></a></div>
								<div class="bottom">
									<div class="left">
										<div class="location"><?php echo $gevent->city;?></div>
									</div>
									
								</div>
						</div>
					<?php endforeach;?>
					</div> -->
				</div>
			</section>
			<section class="container">
			<div class="row singlegroup layout3333">
				<?php $i = 0; $j = 1;?>
					@foreach ($posts as $post)
						<?php if($i >= 4) break;?>
						<div class="col-md-3<?php if(is_int($j/4)) echo " last";?>">
							<div class="postfrom"><div>From <a href="/groups/<?php echo $post->group->slug; ?>">{{ $post->group->name }}</a></div><div class="grouppost">{{ $post->group->category }}</div></div>
							<a href="{{ url() }}/posts/<?php echo $post->id; ?>">
								<div class="bannerholder" style="background: url('<?php echo url().'/'.$post->banner;?>'); background-size: cover;">
								</div>
							</a>
								<div class="postauthor">By {{ getAuthorname($post->author) }}</div>
								<div class="title-area"><a href="{{ url() }}/posts/<?php echo $post->id; ?>"><h3>{{ $post->title }}</h3></a></div>
								<div class="excerpt-area">{{ getExcerpt($post->content, 12) }}</div>
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

</div>
@endsection

@extends('layouts.master')

@section('content')
<div class="home">
	
		<?php 
			$group = DB::table('groups')->where('id', '32')->get();
		?>
		<section class="container">
		<a href="/brands/{{ $group[0]->slug }}">
			<div class="homebanner" style="background: #ccc url('<?php echo url().'/uploads/Large_'.$group[0]->banner;?>') no-repeat center center; background-size: cover;">		
				<div class="caption">
					<p class="cat"><a href="/brands/category/{{ $group[0]->categorykey }}">{{ trans('brands.'.$group[0]->categorykey) }}</a></p>
					<h1>{{ $group[0]->name }}</h1>
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
			<?php Jenssegers\Date\Date::setLocale(Config::get('app.locale'));?>
			<section class="container posts">
			<div class="row singlegroup layout84">
					<?php $i = 0;?>
					@foreach ($posts as $post)
						<?php if($i > 1) break;?>
						<div <?php if($i == 0) { echo 'class="col-md-8"';} else{ echo 'class="col-md-4 last"'; } ?>>
							<div class="postfrom"><div>{{ trans('posts.from') }} <a href="/brands/<?php echo $post->group->slug; ?>">{{ $post->group->name }}</a></div>
							<div class="grouppost"><a href="{{ url() }}/brands/category/{{$post->group->categorykey}}">{{ trans('brands.'.$post->group->categorykey) }}</a></div></div>
							<a href="{{ url() }}/posts/<?php echo $post->id; ?>">
								<?php $banner = explode(',', $post->banner); ?>
								<div class="bannerholder" style="background: #ccc url('<?php echo url().'/uploads/Medium_'.$banner[0];?>') no-repeat center center; background-size: cover;">
								</div>
							</a>
							<?php if($i == 0):?>
							<div class="postinforight">
							<?php endif;?>
								<div class="postauthor">{{ Jenssegers\Date\Date::instance($post->created_at)->diffForHumans() }}</div>
								<div class="title-area"><a href="{{ url() }}/posts/<?php echo $post->id; ?>"><h3>{{ $post->title }}</h3></a></div>
							<?php if($i == 0):?>
								<div class="excerpt-area">{{ strip_tags(getExcerpt($post->content, 60)) }}</div>
							</div>
							<?php endif;?>
								<div class="bottom">
									<div class="left">
										
									</div>
									<div class="right">
										<div class="sharebox" id="post{{$post->id}}" data-post-id="{{ $post->id }}" data-post-title="{{ $post->title }}" data-banner="{{ $banner[0] }}" data-post-description="{{ strip_tags( getExcerpt($post->content, 60) ) }}">
											<a href="" class="social_icons social_tw"><i class="fa fa-twitter"></i></a> <a href="" class="social_icons social_fb"><i class="fa fa-facebook"></i></a> <a href="" class="social_icons social_lk"><i class="fa fa-linkedin"></i></a><a href="" class="social_icons social_wb"><i class="fa fa-weibo"></i></a><!-- <a href="" class="social_icons social_wc"><i class="fa fa-wechat"></i></a>  -->
										</div>
										<div class="shareto">
											<a href="" data-toggle="tooltip" title="{{ trans('general.share') }}" class="share_btn"> <img src="{{ asset('img/share_icon.png') }}" width="16"> </a>
										</div>
										<div class="postcomments">
											<span><a href="{{ url() }}/posts/<?php echo $post->id; ?>#leavecomments" data-toggle="tooltip" title="{{ trans('posts.comments') }}"><img src="{{ asset('img/comments_icon.png') }}" width="16"></a></span> <span class="count">{{ count($post->comments) }}</span>
										</div>
										<div class="postlikes">
										@if(Auth::check())
											@if(alreadyLikedPost(Auth::user()->id,$post->id) > 0)
												<span><a href="" data-toggle="tooltip" title="{{ trans('general.unlike') }}" data-post-id="{{ $post->id }}" data-author-id="{{ Auth::user()->id }}" class="like_btn post_unlike"><img src="{{ asset('img/already_likes_icon.png') }}" width="16"></a></span>
											@else
												<span><a href="" data-toggle="tooltip" title="{{ trans('general.like') }}" data-post-id="{{ $post->id }}" data-author-id="{{ Auth::user()->id }}" class="like_btn post_like"><img src="{{ asset('img/likes_icon.png') }}" width="16"></a></span>
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
							<div class="postfrom"><div>{{ trans('posts.from') }} <a href="/brands/<?php echo $post->group->slug; ?>">{{ $post->group->name }}</a></div><div class="grouppost"><a href="{{ url() }}/brands/category/{{$post->group->categorykey}}">{{ trans('brands.'.$post->group->categorykey) }}</a></div></div>
							<a href="{{ url() }}/posts/<?php echo $post->id; ?>">
								<?php $banner = explode(',', $post->banner); ?>
								<div class="bannerholder" style="background: #ccc url('<?php echo url().'/uploads/Small_'.$banner[0];?>') no-repeat center center; background-size: cover;">
								</div></a>
							<div class="postauthor">{{ Jenssegers\Date\Date::instance($post->created_at)->diffForHumans() }}</div>
								<div class="title-area"><a href="{{ url() }}/posts/<?php echo $post->id; ?>"><h3>{{ $post->title }}</h3></a></div>
								<div class="excerpt-area">{{ strip_tags(getExcerpt($post->content)) }}</div>
								<div class="bottom">
									<div class="left">
										
									</div>
									<div class="right">
										<div class="sharebox" id="post{{$post->id}}" data-post-id="{{ $post->id }}" data-post-title="{{ $post->title }}" data-banner="{{ $banner[0] }}" data-post-description="{{ strip_tags( getExcerpt($post->content, 60) ) }}">
											<a href="" class="social_icons social_tw"><i class="fa fa-twitter"></i></a> <a href="" class="social_icons social_fb"><i class="fa fa-facebook"></i></a> <a href="" class="social_icons social_lk"><i class="fa fa-linkedin"></i></a><a href="" class="social_icons social_wb"><i class="fa fa-weibo"></i></a>
										</div>
										<div class="shareto">
											<a href="" data-toggle="tooltip" title="{{ trans('general.share') }}" class="share_btn"><img src="{{ asset('img/share_icon.png') }}" width="16"></a>
										</div>
										<div class="postcomments">
											<span><a href="{{ url() }}/posts/<?php echo $post->id; ?>#leavecomments" data-toggle="tooltip" title="{{ trans('posts.comments') }}"><img src="{{ asset('img/comments_icon.png') }}" width="16"></a></span> <span class="count">{{ count($post->comments) }}</span>
										</div>
										<div class="postlikes">
										@if(Auth::check())
											@if(alreadyLikedPost(Auth::user()->id,$post->id) > 0)
												<span><a href="" data-toggle="tooltip" title="{{ trans('general.unlike') }}" data-post-id="{{ $post->id }}" data-author-id="{{ Auth::user()->id }}" class="like_btn post_unlike"><img src="{{ asset('img/already_likes_icon.png') }}" width="16"></a></span>
											@else
												<span><a href="" data-toggle="tooltip" title="{{ trans('general.like') }}" data-post-id="{{ $post->id }}" data-author-id="{{ Auth::user()->id }}" class="like_btn post_like"><img src="{{ asset('img/likes_icon.png') }}" width="16"></a></span>
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
				<h2>{{ trans('headermenu.discoverevents') }}</h2>
				<h4>{{ trans('general.seehappen') }}</h4>
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
												date_default_timezone_set($event->timezone);
													if(date('M j',$event->fromtime) == date('M j',$event->totime)) : 
														if(Config::get('app.locale') == 'en'):
												?>
															{{ date('D, M j',$event->fromtime) }}
														<?php else: ?>
															{{ zhweekday(date('D',$event->fromtime)) }} {{ date('n',$event->fromtime) }}月{{ date('j',$event->fromtime) }}日
														<?php endif;?>
												<?php else: ?>
													<?php if(Config::get('app.locale') == 'en'):?>
														{{ date('M j',$event->fromtime) }} - {{ date('M j',$event->totime) }}
													<?php else: ?>
														{{ date('n',$event->fromtime) }}月{{ date('j',$event->fromtime) }}日 - {{ date('n',$event->totime) }}月{{ date('j',$event->totime) }}日
													<?php endif;?>
												<?php endif; ?>
											</p>
							</div>
						</div>
					</div>
					<?php $e++;?>
					@endforeach
				</div>
				<div class="viewmore"><a href="/events">{{ trans('general.viewmore') }}</a></div>
				<div class="row-gap"></div>
				<div class="divider"></div>
				<?php date_default_timezone_set(Config::get('app.timezone'));?>
			</section>
			@if(count($posts) > 0)
			<section class="container posts">
			<div class="row singlegroup layout633">
				<?php $i = 0; $j = 1;?>
					@foreach ($posts as $post)
						<?php if($i >= 3) break;?>
						<div class="<?php if($i == 0) { echo "col-md-6";} else{ echo "col-md-3"; }?><?php if(is_int($j/3)) echo " last";?>">
							<div class="postfrom"><div>{{ trans('posts.from') }} <a href="/brands/<?php echo $post->group->slug; ?>">{{ $post->group->name }}</a></div><div class="grouppost"><a href="{{ url() }}/brands/category/{{$post->group->categorykey}}">{{ trans('brands.'.$post->group->categorykey) }}</a></div></div>
							<a href="{{ url() }}/posts/<?php echo $post->id; ?>">
							<?php $banner = explode(',', $post->banner); ?>
								<div class="bannerholder" style="background: #ccc url('<?php echo url().'/uploads/Small_'.$banner[0];?>') no-repeat center center; background-size: cover;">
								</div>
							</a>
								<div class="postauthor">{{ Jenssegers\Date\Date::instance($post->created_at)->diffForHumans() }}</div>
								<div class="title-area"><a href="{{ url() }}/posts/<?php echo $post->id; ?>"><h3>{{ $post->title }}</h3></a></div>
								<?php if($i > 0): ?>
								<div class="excerpt-area">{{ strip_tags(getExcerpt($post->content, 12)) }}</div>
								<?php endif;?>
								<div class="bottom">
									<div class="left">
										
									</div>
									<div class="right">
										<div class="sharebox" id="post{{$post->id}}" data-post-id="{{ $post->id }}" data-post-title="{{ $post->title }}" data-banner="{{ $banner[0] }}" data-post-description="{{ strip_tags( getExcerpt($post->content, 60) ) }}">
											<a href="" class="social_icons social_tw"><i class="fa fa-twitter"></i></a> <a href="" class="social_icons social_fb"><i class="fa fa-facebook"></i></a> <a href="" class="social_icons social_lk"><i class="fa fa-linkedin"></i></a><a href="" class="social_icons social_wb"><i class="fa fa-weibo"></i></a>
										</div>
										<div class="shareto">
											<a href="" data-toggle="tooltip" title="{{ trans('general.share') }}" class="share_btn"><img src="{{ asset('img/share_icon.png') }}" width="16"></a>
										</div>
										<div class="postcomments">
											<span><a href="{{ url() }}/posts/<?php echo $post->id; ?>#leavecomments" data-toggle="tooltip" title="{{ trans('posts.comments') }}"><img src="{{ asset('img/comments_icon.png') }}" width="16"></a></span> <span class="count">{{ count($post->comments) }}</span>
										</div>
										<div class="postlikes">
										@if(Auth::check())
											@if(alreadyLikedPost(Auth::user()->id,$post->id) > 0)
												<span><a href="" data-toggle="tooltip" title="{{ trans('general.unlike') }}" data-post-id="{{ $post->id }}" data-author-id="{{ Auth::user()->id }}" class="like_btn post_unlike"><img src="{{ asset('img/already_likes_icon.png') }}" width="16"></a></span>
											@else
												<span><a href="" data-toggle="tooltip" title="{{ trans('general.like') }}" data-post-id="{{ $post->id }}" data-author-id="{{ Auth::user()->id }}" class="like_btn post_like"><img src="{{ asset('img/likes_icon.png') }}" width="16"></a></span>
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
							<div class="postfrom"><div>{{ trans('posts.from') }} <a href="/brands/<?php echo $post->group->slug; ?>">{{ $post->group->name }}</a></div><div class="grouppost"><a href="{{ url() }}/brands/category/{{$post->group->categorykey}}">{{ trans('brands.'.$post->group->categorykey) }}</a></div></div>
							<a href="{{ url() }}/posts/<?php echo $post->id; ?>">
							<?php $banner = explode(',', $post->banner); ?>
								<div class="bannerholder" style="background: #ccc url('<?php echo url().'/uploads/Small_'.$banner[0];?>') no-repeat center center; background-size: cover;">
								</div>
							</a>
								<div class="postauthor">{{ $post->created_at->diffForHumans() }}</div>
								<div class="title-area"><a href="{{ url() }}/posts/<?php echo $post->id; ?>"><h3>{{ $post->title }}</h3></a></div>
								<div class="excerpt-area">{{ strip_tags(getExcerpt($post->content, 12)) }}</div>
								<div class="bottom">
									<div class="left">
										
									</div>
									<div class="right">
										<div class="sharebox" id="post{{$post->id}}" data-post-id="{{ $post->id }}" data-post-title="{{ $post->title }}" data-banner="{{ $banner[0] }}" data-post-description="{{ strip_tags( getExcerpt($post->content, 60) ) }}">
											<a href="" class="social_icons social_tw"><i class="fa fa-twitter"></i></a> <a href="" class="social_icons social_fb"><i class="fa fa-facebook"></i></a> <a href="" class="social_icons social_lk"><i class="fa fa-linkedin"></i></a><a href="" class="social_icons social_wb"><i class="fa fa-weibo"></i></a>
										</div>
										<div class="shareto">
											<a href="" data-toggle="tooltip" title="{{ trans('general.share') }}" class="share_btn"><img src="{{ asset('img/share_icon.png') }}" width="16"></a>
										</div>
										<div class="postcomments">
											<span><a href="{{ url() }}/posts/<?php echo $post->id; ?>#leavecomments" data-toggle="tooltip" title="{{ trans('posts.comments') }}"><img src="{{ asset('img/comments_icon.png') }}" width="16"></a></span> <span class="count">{{ count($post->comments) }}</span>
										</div>
										<div class="postlikes">
										@if(Auth::check())
											@if(alreadyLikedPost(Auth::user()->id,$post->id) > 0)
												<span><a href="" data-toggle="tooltip" title="{{ trans('general.unlike') }}" data-post-id="{{ $post->id }}" data-author-id="{{ Auth::user()->id }}" class="like_btn post_unlike"><img src="{{ asset('img/already_likes_icon.png') }}" width="16"></a></span>
											@else
												<span><a href="" data-toggle="tooltip" title="{{ trans('general.like') }}" data-post-id="{{ $post->id }}" data-author-id="{{ Auth::user()->id }}" class="like_btn post_like"><img src="{{ asset('img/likes_icon.png') }}" width="16"></a></span>
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
							<div class="postfrom"><div>{{ trans('posts.from') }} <a href="/brands/<?php echo $post->group->slug; ?>">{{ $post->group->name }}</a></div><div class="grouppost"><a href="{{ url() }}/brands/category/{{$post->group->categorykey}}">{{ trans('brands.'.$post->group->categorykey) }}</a></div></div>
							<a href="{{ url() }}/posts/<?php echo $post->id; ?>">
							<?php $banner = explode(',', $post->banner); ?>
								<div class="bannerholder" style="background: #ccc url('<?php echo url().'/uploads/Small_'.$banner[0];?>') no-repeat center center; background-size: cover;">
								</div>
							</a>
								<div class="postauthor">{{ Jenssegers\Date\Date::instance($post->created_at)->diffForHumans() }}</div>
								<div class="title-area"><a href="{{ url() }}/posts/<?php echo $post->id; ?>"><h3>{{ $post->title }}</h3></a></div>
								<?php if($i > 0): ?>
								<div class="excerpt-area">{{ strip_tags(getExcerpt($post->content, 12)) }}</div>
								<?php endif;?>
								<div class="bottom">
									<div class="left">
										
									</div>
									<div class="right">
										<div class="sharebox" id="post{{$post->id}}" data-post-id="{{ $post->id }}" data-post-title="{{ $post->title }}" data-banner="{{ $banner[0] }}" data-post-description="{{ strip_tags( getExcerpt($post->content, 60) ) }}">
											<a href="" class="social_icons social_tw"><i class="fa fa-twitter"></i></a> <a href="" class="social_icons social_fb"><i class="fa fa-facebook"></i></a> <a href="" class="social_icons social_lk"><i class="fa fa-linkedin"></i></a><a href="" class="social_icons social_wb"><i class="fa fa-weibo"></i></a>
										</div>
										<div class="shareto">
											<a href="" data-toggle="tooltip" title="{{ trans('general.share') }}" class="share_btn"><img src="{{ asset('img/share_icon.png') }}" width="16"></a>
										</div>
										<div class="postcomments">
											<span><a href="{{ url() }}/posts/<?php echo $post->id; ?>#leavecomments" data-toggle="tooltip" title="{{ trans('posts.comments') }}"><img src="{{ asset('img/comments_icon.png') }}" width="16"></a></span> <span class="count">{{ count($post->comments) }}</span>
										</div>
										<div class="postlikes">
										@if(Auth::check())
											@if(alreadyLikedPost(Auth::user()->id,$post->id) > 0)
												<span><a href="" data-toggle="tooltip" title="{{ trans('general.unlike') }}" data-post-id="{{ $post->id }}" data-author-id="{{ Auth::user()->id }}" class="like_btn post_unlike"><img src="{{ asset('img/already_likes_icon.png') }}" width="16"></a></span>
											@else
												<span><a href="" data-toggle="tooltip" title="{{ trans('general.like') }}" data-post-id="{{ $post->id }}" data-author-id="{{ Auth::user()->id }}" class="like_btn post_like"><img src="{{ asset('img/likes_icon.png') }}" width="16"></a></span>
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
			@if(count(followedGroup(Auth::user()->id)) > 0)
			<section class="container">
				<div class="joinedgroups">
					<h3>{{ trans('general.following') }}</h3>
					<p>{{ trans('general.youarefollowing') }}</p>
					<div class="groupsrow collapsed">
					<?php
						$uid = Auth::user()->id;
						$groups = followedGroup($uid);
						$f =1;
						//$groups_id = array();
						foreach ($groups as $group) :
					?>
						<div class="grouplist<?php if(is_int($f/4)) echo " last";?>">
						<a href="brands/{{ $group->slug }}">
							<div class="bannerholder" style="background: url('<?php echo url()."/uploads/Medium_".$group->profile;?>');background-size:cover"></div>
							
							<div class="caption">
								<h3>{{ $group->name }}</h3>
								<p><!-- <span class="membercount"><img src="{{ asset('img/member_icon_white.png') }}" width="14"> {{ memberCount($group->id) }}</span> --><span class="followcount"><img src="{{ asset('img/follow_icon_white.png') }}" width="20"> {{ count(groupFollowers($group->id)) }}</span></p>
							</div>
							</a>
						</div>
						<?php 
							//array_push($groups_id, $group->group_id);
						?>
					<?php $f++; endforeach;?>
					</div>
					<div class="showall"><a href="">{{ trans('brands.showall') }}</a></div>
					<div class="joinmore"><a href="/brands">{{ trans('general.followmore') }}</a></div>

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
							<div class="postfrom"><div>{{ trans('posts.from') }} <a href="/brands/<?php echo $post->group->slug; ?>">{{ $post->group->name }}</a></div><div class="grouppost"><a href="{{ url() }}/brands/category/{{$post->group->categorykey}}">{{ trans('brands.'.$post->group->categorykey) }}</a></div></div>
							<a href="{{ url() }}/posts/<?php echo $post->id; ?>">
								<?php $banner = explode(',', $post->banner); ?>
								<div class="bannerholder" style="background: #ccc url('<?php echo url().'/uploads/Small_'.$banner[0];?>') no-repeat center center; background-size: cover;">
								</div></a>
							<div class="postauthor">{{ Jenssegers\Date\Date::instance($post->created_at)->diffForHumans() }}</div>
								<div class="title-area"><a href="{{ url() }}/posts/<?php echo $post->id; ?>"><h3>{{ $post->title }}</h3></a></div>
								<div class="excerpt-area">{{ strip_tags(getExcerpt($post->content)) }}</div>
								<div class="bottom">
									<div class="left">
										
									</div>
									<div class="right">
										<div class="sharebox" id="post{{$post->id}}" data-post-id="{{ $post->id }}" data-post-title="{{ $post->title }}" data-banner="{{ $banner[0] }}" data-post-description="{{ strip_tags( getExcerpt($post->content, 60) ) }}">
											<a href="" class="social_icons social_tw"><i class="fa fa-twitter"></i></a> <a href="" class="social_icons social_fb"><i class="fa fa-facebook"></i></a> <a href="" class="social_icons social_lk"><i class="fa fa-linkedin"></i></a><a href="" class="social_icons social_wb"><i class="fa fa-weibo"></i></a>
										</div>
										<div class="shareto">
											<a href="" data-toggle="tooltip" title="{{ trans('general.share') }}" class="share_btn"><img src="{{ asset('img/share_icon.png') }}" width="16"></a>
										</div>
										<div class="postcomments">
											<span><a href="{{ url() }}/posts/<?php echo $post->id; ?>#leavecomments" data-toggle="tooltip" title="{{ trans('posts.comments') }}"><img src="{{ asset('img/comments_icon.png') }}" width="16"></a></span> <span class="count">{{ count($post->comments) }}</span>
										</div>
										<div class="postlikes">
										@if(Auth::check())
											@if(alreadyLikedPost(Auth::user()->id,$post->id) > 0)
												<span><a href="" data-toggle="tooltip" title="{{ trans('general.unlike') }}" data-post-id="{{ $post->id }}" data-author-id="{{ Auth::user()->id }}" class="like_btn post_unlike"><img src="{{ asset('img/already_likes_icon.png') }}" width="16"></a></span>
											@else
												<span><a href="" data-toggle="tooltip" title="{{ trans('general.like') }}" data-post-id="{{ $post->id }}" data-author-id="{{ Auth::user()->id }}" class="like_btn post_like"><img src="{{ asset('img/likes_icon.png') }}" width="16"></a></span>
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
<script type="text/javascript">
	$('body').on('click', '.right a.social_fb', function(e){
		e.preventDefault();
		var pid = $(this).parent().data('post-id');
		var ptitle = $(this).parent().data('post-title');
		var pbanner = $(this).parent().data('banner');
		var pdesc = $(this).parent().data('post-description');
		window.open('https://www.facebook.com/v2.0/dialog/feed?app_id=866884463391641&display=popup&link='+encodeURIComponent('{{ url() }}/posts/'+pid)+'&caption=OHGOODPARTY&picture={{ url() }}/uploads/Medium_'+pbanner+'&name='+encodeURIComponent(ptitle)+'&description='+pdesc+'&redirect_uri=https://www.facebook.com', "_blank", "width=600, height=400");
	})
	$('body').on('click', '.right a.social_tw', function(e){
		e.preventDefault();
		var pid = $(this).parent().data('post-id');
		var ptitle = $(this).parent().data('post-title');
		var pbanner = $(this).parent().data('banner');
		var pdesc = $(this).parent().data('post-description');
		window.open('https://twitter.com/intent/tweet?text='+encodeURIComponent(ptitle)+'&via=ohgoodparty_ogp&url={{ url() }}/posts/'+pid, "_blank", "width=360, height=360");
	})
	$('body').on('click', '.right a.social_lk', function(e){
		e.preventDefault();
		var pid = $(this).parent().data('post-id');
		var ptitle = $(this).parent().data('post-title');
		var pbanner = $(this).parent().data('banner');
		var pdesc = $(this).parent().data('post-description');
		window.open('https://www.linkedin.com/shareArticle?mini=true&url={{ url() }}/posts/'+pid+'&title='+encodeURIComponent(ptitle)+'&summary='+pdesc+'&source=OHGOODPARTY', "_blank", "width=360, height=360");
	})
	$('body').on('click', '.right a.social_wb', function(e){
		e.preventDefault();
		var pid = $(this).parent().data('post-id');
		var ptitle = $(this).parent().data('post-title');
		var pbanner = $(this).parent().data('banner');
		var pdesc = $(this).parent().data('post-description');
		window.open('http://service.weibo.com/share/share.php?appkey=3304326450&title='+encodeURIComponent(ptitle)+' @奥格派&url={{ url() }}/posts/'+pid+'&pic={{ url() }}/uploads/Medium_'+pbanner+'&searchPic=false&style=simple', "_blank", "width=360, height=360");
	})
</script>
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

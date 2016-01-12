@extends('layouts.master')

@section('content')
	
<div class="container search">
	<div class="row">
		<div class="col-md-12">
			<div class="panel">
				<div class="panel-heading">
					<h1>SEACH RESULTS</h1>
				</div>
				<div class="panel-body">
					@if (count($groups) > 0)
						<h3>Brands</h3>
						<div class="groupsrow collapsed">
						<?php $i = 1;?>
						@foreach ($groups as $group)
							<div class="grouplist<?php if(is_int($i/4)) echo " last";?>">
								<a href="brands/{{ $group->slug }}">
									<div class="bannerholder" style="background: url('<?php echo url()."/uploads/Medium_".$group->profile;?>');background-size:cover"></div>
									
									<div class="caption">
										<h3>{{ $group->name }}</h3>
										<p><!-- <span class="membercount"><img src="{{ asset('img/member_icon_white.png') }}" width="14"> {{ memberCount($group->id) }}</span> --><span class="followcount"><img src="{{ asset('img/follow_icon_white.png') }}" width="20"> {{ count(groupFollowers($group->id)) }}</span></p>
									</div>
									</a>
								</div>
							<?php $i++;?>
						@endforeach
						</div>
						@if (count($groups) > 4 )
						<div class="brandsshowall"><a href="">SHOW ALL</a></div>
						@endif
					@endif
					@if (count($posts) > 0)
						<h3>Posts</h3>
						@foreach ($posts as $post)
							<section class="groupsrow collapsed">
								<div class="row singlegroup layout3333">
									<?php $j = 1;?>
										@foreach ($posts as $post)
											<div class="col-md-3<?php if(is_int($j/4)) echo " last";?>">
												<div class="postfrom"><div>From <a href="/brands/<?php echo $post->group->slug; ?>">{{ $post->group->name }}</a></div><div class="grouppost">{{ $post->group->category }}</div></div>
												<a href="{{ url() }}/posts/<?php echo $post->id; ?>">
												<?php $banner = explode(',', $post->banner); ?>
													<div class="bannerholder" style="background: #ccc url('<?php echo url().'/uploads/Small_'.$banner[0];?>') no-repeat center center; background-size: cover;">
													</div>
												</a>
													<div class="postauthor">{{ $post->created_at->diffForHumans() }}</div>
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
															@else
																<img src="{{ asset('img/likes_icon.png') }}" width="16">
															@endif
															<span class="count">{{ count($post->likes) }}</span>
															</div>
															
														</div>
													</div>
											</div>
										@endforeach
										<div class="row-gap"></div>
								</div>
								</section>
								@if (count($posts) > 4 )
								<div class="brandsshowall"><a href="">SHOW ALL</a></div>
								@endif
						@endforeach
					@endif
					@if (count($events) > 0)
						<h3>Events</h3>
						<div class="groupsrow collapsed">
						<?php $i = 1; ?>
						@foreach ($events as $event)
							<?php
							if(Auth::check()){
								if ( $event->type == 'private' && (isFollowing(Auth::user()->id, $event->group_id ) == 0 && $event->author !== Auth::user()->id) ){
									continue;
								}
							}else{
								if($event->type == 'private'){
									continue;
								}
							}
						?>
						<div class="eventgroup<?php if(is_int($i/3)) { echo " last"; }?>">
							<div class="eventgroup-list">
										<a href="events/{{ $event->id }}">
										<div class="imgholder" style="background: #666 url('<?php echo url()."/uploads/Medium_".$event->banner;?>') center center; background-size: cover;">
										</div>
										</a>
										<!-- <div style="clear:both; height:4px; background-color: #fc6c25"></div> -->
										
										<p class="location">{{ $event->city }}</p>
										<h3><a href="events/{{ $event->id }}">{{ $event->title }}</a></h3>
										
										<div class="event-details">
											<p class="event-info">
												<img src="{{ asset('img/calendar_icon.png') }}" width="16" class="edicons"> 
												<?php 
												date_default_timezone_set($event->timezone);
													if(date('M j',$event->fromtime) == date('M j',$event->totime)) : 
												?>
												{{ date('D, M j',$event->fromtime) }} @ {{ date('g : i a',$event->fromtime) }} - {{ date('g : i a' ,$event->totime) }}
												<?php else: ?>
												{{ date('M j',$event->fromtime) }} - {{ date('M j',$event->totime) }}

												<?php endif; ?>
											</p>
											<p class="event-info"><img src="{{ asset('img/address_icon.png') }}" width="15" class="edicons"> {{ $event->address }}</p>
											<p class="event-info"><img src="{{ asset('img/ticket_icon.png') }}" height="12" class="edicons">
											@if($event->fee == 'Free') 
												{{ $event->fee }}
											@else
												@if($event->currency == 'cad'){{ 'C$' }}@elseif($event->currency == 'usd'){{ '$' }}@elseif($event->currency == 'cny'){{ '¥' }}@elseif($event->currency == 'eur'){{ '€' }}@endif{{ $event->fee }}
											@endif
											</p>
										</div>

										<div class="interested">
											@if(Auth::check())
												<div class="interestcount">
												@if(alreadyLikedEvent(Auth::user()->id,$event->id) > 0)
													<span><a href="" data-toggle="tooltip" title="Not interested" data-event-id="{{ $event->id }}" data-author-id="{{ Auth::user()->id }}" class="like_btn event_unlike"><img src="{{ asset('img/already_likes_icon.png') }}" width="16"></a></span>
												@else
													<span><a href="" data-toggle="tooltip" title="Interested" data-event-id="{{ $event->id }}" data-author-id="{{ Auth::user()->id }}" class="like_btn event_like"><img src="{{ asset('img/likes_icon.png') }}" width="16"></a></span>
												@endif
													<span class="likenum">{{ $event->likes->count()}}</span></div>
											@else
											<div class="interestcount"><img src="{{ asset('img/likes_icon.png') }}" width="16"> {{ $event->likes->count() }}</div>
											@endif
										</div>
										<div class="postfrom">
											From: <a href="/brands/{{ ($event->group->slug) }}">{{ ($event->group->name) }}</a>
										</div>
							</div>
						</div>
						<?php $i++;?>
						@endforeach
						</div>
							@if (count($posts) > 4 )
								<div class="brandsshowall"><a href="">SHOW ALL</a></div>
							@endif
					@endif
					@if (count($groups) == 0 && count($events) == 0 && count($events) == 0 )
						<div>
							No results found.
						</div>
					@endif
				</div>
			</div>
		</div>
	</div>
</div>

@endsection
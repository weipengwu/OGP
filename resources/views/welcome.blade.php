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
					<p class="cat">{{ trans('brands.'.$group[0]->categorykey) }}</p>
					<h1>{{ $group[0]->name }}</h1>
				</div>
			
			</div>
		</a>
		<script type="text/javascript">
			$('.homebanner .cat').on('click', function(){
				window.location.href = "/brands/category/{{ $group[0]->categorykey }}";
			})
		</script>
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
							<div class="postfrom"><div>{{ trans('posts.from') }} <a href="/brands/<?php echo $post->group->slug; ?>">{{ $post->group->name }}</a></div>
							<div class="grouppost">{{ $post->group->category }}</div></div>
							<a href="{{ url() }}/posts/<?php echo $post->id; ?>">
								<?php $banner = explode(',', $post->banner); ?>
								<div class="bannerholder" style="background: #ccc url('<?php echo url().'/uploads/Medium_'.$banner[0];?>') no-repeat center center; background-size: cover;">
								</div>
							</a>
							<?php if($i == 0):?>
							<div class="postinforight">
							<?php endif;?>
								<div class="postauthor">{{ $post->created_at->diffForHumans() }}</div>
								<div class="title-area"><a href="{{ url() }}/posts/<?php echo $post->id; ?>"><h3>{{ $post->title }}</h3></a></div>
							<?php if($i == 0):?>
								<div class="excerpt-area">{!! html_entity_decode(getExcerpt($post->content)) !!}</div>
							</div>
							<?php endif;?>
								<div class="bottom">
									<div class="left">
										
									</div>
									<div class="right">
										<div class="postcomments">
											<span><img src="{{ asset('img/comments_icon.png') }}" width="16"></span> <span class="count">{{ count($post->comments) }}</span>
										</div>
										<div class="postlikes">
										<img src="{{ asset('img/likes_icon.png') }}" width="16">
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
							<div class="postfrom"><div>{{ trans('posts.from') }} <a href="/brands/<?php echo $post->group->slug; ?>">{{ $post->group->name }}</a></div><div class="grouppost">{{ $post->group->category }}</div></div>
							<a href="{{ url() }}/posts/<?php echo $post->id; ?>">
								<?php $banner = explode(',', $post->banner); ?>
								<div class="bannerholder" style="background: #ccc url('<?php echo url().'/uploads/Small_'.$banner[0];?>') no-repeat center center; background-size: cover;">
								</div></a>
							<div class="postauthor">{{ $post->created_at->diffForHumans() }}</div>
								<div class="title-area"><a href="{{ url() }}/posts/<?php echo $post->id; ?>"><h3>{{ $post->title }}</h3></a></div>
								<div class="excerpt-area">{!! html_entity_decode(getExcerpt($post->content)) !!}</div>
								<div class="bottom">
									<div class="left">
										
									</div>
									<div class="right">
										<div class="postcomments">
											<span><img src="{{ asset('img/comments_icon.png') }}" width="16"></span> <span class="count">{{ count($post->comments) }}</span>
										</div>
										<div class="postlikes">
										<img src="{{ asset('img/likes_icon.png') }}" width="16">
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

								if($event->type == 'private'){
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
				<div class="viewmore"><a href="/events">VIEW MORE</a></div>
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
							<div class="postfrom"><div>{{ trans('posts.from') }} <a href="/brands/<?php echo $post->group->slug; ?>">{{ $post->group->name }}</a></div><div class="grouppost">{{ $post->group->category }}</div></div>
							<a href="{{ url() }}/posts/<?php echo $post->id; ?>">
							<?php $banner = explode(',', $post->banner); ?>
								<div class="bannerholder" style="background: #ccc url('<?php echo url().'/uploads/Small_'.$banner[0];?>') no-repeat center center; background-size: cover;">
								</div>
							</a>
								<div class="postauthor">{{ $post->created_at->diffForHumans() }}</div>
								<div class="title-area"><a href="{{ url() }}/posts/<?php echo $post->id; ?>"><h3>{{ $post->title }}</h3></a></div>
								<?php if($i > 0): ?>
								<div class="excerpt-area">{!! html_entity_decode(getExcerpt($post->content, 12)) !!}</div>
								<?php endif;?>
								<div class="bottom">
									<div class="left">
										
									</div>
									<div class="right">
										<div class="postcomments">
											<span><img src="{{ asset('img/comments_icon.png') }}" width="16"></span> <span class="count">{{ count($post->comments) }}</span>
										</div>
										<div class="postlikes">
										<img src="{{ asset('img/likes_icon.png') }}" width="16">
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
							<div class="postfrom"><div>{{ trans('posts.from') }} <a href="/brands/<?php echo $post->group->slug; ?>">{{ $post->group->name }}</a></div><div class="grouppost">{{ $post->group->category }}</div></div>
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
										<div class="postcomments">
											<span><img src="{{ asset('img/comments_icon.png') }}" width="16"></span> <span class="count">{{ count($post->comments) }}</span>
										</div>
										<div class="postlikes">
										<img src="{{ asset('img/likes_icon.png') }}" width="16">
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
							<div class="postfrom"><div>{{ trans('posts.from') }} <a href="/brands/<?php echo $post->group->slug; ?>">{{ $post->group->name }}</a></div><div class="grouppost">{{ $post->group->category }}</div></div>
							<a href="{{ url() }}/posts/<?php echo $post->id; ?>">
							<?php $banner = explode(',', $post->banner); ?>
								<div class="bannerholder" style="background: #ccc url('<?php echo url().'/uploads/Small_'.$banner[0];?>') no-repeat center center; background-size: cover;">
								</div>
							</a>
								<div class="postauthor">{{ $post->created_at->diffForHumans() }}</div>
								<div class="title-area"><a href="{{ url() }}/posts/<?php echo $post->id; ?>"><h3>{{ $post->title }}</h3></a></div>
								<?php if($i > 0): ?>
								<div class="excerpt-area">{!! html_entity_decode(getExcerpt($post->content, 12)) !!}</div>
								<?php endif;?>
								<div class="bottom">
									<div class="left">
										
									</div>
									<div class="right">
										<div class="postcomments">
											<span><img src="{{ asset('img/comments_icon.png') }}" width="16"></span> <span class="count">{{ count($post->comments) }}</span>
										</div>
										<div class="postlikes">
										<img src="{{ asset('img/likes_icon.png') }}" width="16">
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
							<div class="postfrom"><div>{{ trans('posts.from') }} <a href="/brands/<?php echo $post->group->slug; ?>">{{ $post->group->name }}</a></div><div class="grouppost">{{ $post->group->category }}</div></div>
							<a href="{{ url() }}/posts/<?php echo $post->id; ?>">
								<?php $banner = explode(',', $post->banner); ?>
								<div class="bannerholder" style="background: #ccc url('<?php echo url().'/uploads/Small_'.$banner[0];?>') no-repeat center center; background-size: cover;">
								</div></a>
							<div class="postauthor">{{ $post->created_at->diffForHumans() }}</div>
								<div class="title-area"><a href="{{ url() }}/posts/<?php echo $post->id; ?>"><h3>{{ $post->title }}</h3></a></div>
								<div class="excerpt-area">{!! html_entity_decode(getExcerpt($post->content)) !!}</div>
								<div class="bottom">
									<div class="left">
										
									</div>
									<div class="right">
										<div class="postcomments">
											<span><img src="{{ asset('img/comments_icon.png') }}" width="16"></span> <span class="count">{{ count($post->comments) }}</span>
										</div>
										<div class="postlikes">
										<img src="{{ asset('img/likes_icon.png') }}" width="16">
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

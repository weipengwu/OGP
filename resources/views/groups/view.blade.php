@extends('layouts.master')

@section('content')
<div class="bannerwrapper">
	<div class="groupbanner" style="background: #ccc url('<?php echo url()."/uploads/Large_".$group->banner;?>') center center no-repeat; background-size: cover;">
		<div class="caption">
			<div class="container">
				<div class="groupprofile" style="background: #666 url('<?php echo url()."/uploads/Small_".$group->profile;?>') center center no-repeat; background-size: cover;"></div>
				<p class="groupcategory"><a href="{{ url() }}/brands/category/{{$group->categorykey}}">{{ trans('brands.'.$group->categorykey) }}</a></p>
				<h1>{{ $group->name }}</h1>
				<p>{!! html_entity_decode($group->description) !!}</p>
				<p><a href="http://{{ $group->website }}" target="_blank" class="website">{{ $group->website }}</a></p>
				@if(Auth::check())
					@if($group->owner == Auth::user()->id)
						<a href="/brands/{{ $group->slug }}/edit" class="btn btn_logo">{{ trans('brands.editbrand') }}</a>
					@elseif(isFollowing(Auth::user()->id, $group->id))
						<a href="" class="follow_btn unfollow_group" data-user-id="{{ Auth::user()->id }}" data-group-id="{{ $group->id }}">{{ trans('brands.following') }}</a>
						<a href="{{ url() }}/dashboard/message/user/{{ $group->owner }}">{{ trans('brands.message') }}</a>
					@else
						<a href="" class="follow_btn follow_group" data-user-id="{{ Auth::user()->id }}" data-group-id="{{ $group->id }}">{{ trans('brands.follow') }}</a>
						<a href="{{ url() }}/dashboard/message/user/{{ $group->owner }}">{{ trans('brands.message') }}</a>
					@endif
				@endif
			</div>
		</div>	
	</div>
</div>
	<div class="statusbar">
		<div class="left"><span class="followerNumber">{{ count(groupFollowers($group->id)) }} @if(count(groupFollowers($group->id)) > 1) {{ trans('brands.followers') }} @else {{ trans('brands.follower') }} @endif</span> <span>{{ count($group->events) }} @if(count($group->events) > 1) {{ trans('brands.events') }} @else {{ trans('brands.event') }} @endif</span> <span>{{ count($group->posts) }} @if(count($group->posts) > 1) {{ trans('brands.posts') }} @else {{ trans('brands.post') }} @endif</span></div>
		<div class="right">
			@if(Auth::check())
				@if($group->owner == Auth::user()->id)
					<a class="create_btn" data-toggle="tooltip" title="{{ trans('dashboard.createevent') }}" href="<?php echo url();?>/brands/<?php echo $group->slug;?>/events/new"><img src="{{ asset('img/ticket_icon.png') }}" width="20"></a> <a class="create_btn" data-toggle="tooltip" title="{{ trans('dashboard.createpost') }}" href="<?php echo url();?>/brands/<?php echo $group->slug;?>/posts/new"><img src="{{ asset('img/createpost_big_icon.png') }}" width="16"></a>
				@else
					<div class="sharebox" id="brand{{$group->id}}">
						<a href="" class="social_icons social_tw"><i class="fa fa-twitter"></i></a> <a href="" class="social_icons social_fb"><i class="fa fa-facebook"></i></a> <a href="" class="social_icons social_lk"><i class="fa fa-linkedin"></i></a><a href="" class="social_icons social_wb"><i class="fa fa-weibo"></i></a>
					</div>
					<div class="shareto">
						<a href="" data-toggle="tooltip" title="{{ trans('general.share') }}" class="share_btn"> <img src="{{ asset('img/share_icon.png') }}" width="16"> </a>
					</div>
					@if(isFollowing(Auth::user()->id, $group->id))
					<div class="groupfollow">
						<span><a href="" data-toggle="tooltip" title="{{ trans('brands.unfollow') }}" class="unfollow_group" data-user-id="{{ Auth::user()->id }}" data-group-id="{{ $group->id }}"><img src="{{ asset('img/unfollow_big_icon.png') }}" width="20"></a></span>
					</div>
					@else
					<div class="groupfollow">
						<span><a href="" data-toggle="tooltip" title="{{ trans('brands.follow') }}" class="follow_group" data-user-id="{{ Auth::user()->id }}" data-group-id="{{ $group->id }}"><img src="{{ asset('img/follow_big_icon.png') }}" width="20"></a></span>
					</div>
					@endif
				@endif
			@endif
		</div>
		<script type="text/javascript">
					$('.right #brand{{$group->id}} a.social_fb').on('click', function(e){
						e.preventDefault();
                        window.open('https://www.facebook.com/v2.0/dialog/feed?app_id=866884463391641&display=popup&link='+encodeURIComponent('{{ url() }}/brands/<?php echo $group->slug; ?>')+'&caption=OHGOODPARTY&picture={{ url()."/uploads/Large_".$group->banner }}&name='+encodeURIComponent('{{ $group->name }}')+'&description={{ strip_tags( $group->description ) }}&redirect_uri=https://www.facebook.com', "_blank", "width=600, height=400");
					})
					$('.right #brand{{$group->id}} a.social_tw').on('click', function(e){
						e.preventDefault();
                        window.open('https://twitter.com/intent/tweet?text={{ $group->name }}&via=ohgoodparty_ogp&url={{ url() }}/brands/<?php echo $group->slug; ?>', "_blank", "width=360, height=360");
					})
					$('.right #brand{{$group->id}} a.social_lk').on('click', function(e){
						e.preventDefault();
                        window.open('https://www.linkedin.com/shareArticle?mini=true&url={{ url() }}/brands/<?php echo $group->slug; ?>&title={{ $group->name }}&summary={{ strip_tags( $group->description ) }}&source=OHGOODPARTY', "_blank", "width=360, height=360");
					})
					$('.right #brand{{$group->id}} a.social_wb').on('click', function(e){
						e.preventDefault();
						window.open('http://service.weibo.com/share/share.php?appkey=3304326450&title={{ $group->name }} @奥格派&url={{ url() }}/brands/<?php echo $group->slug; ?>&pic={{ url()."/uploads/Large_".$group->banner }}&searchPic=false&style=simple', "_blank", "width=360, height=360");
					})
				</script>
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
				<?php $posts = array(); ?>
				@foreach ($gposts as $singlepost)
					<?php 
						array_push($posts, $singlepost);
					?>
				@endforeach
				@if(count($posts) > 0)
				<section class="container posts">
				<?php Jenssegers\Date\Date::setLocale(Config::get('app.locale'));?>
					<div class="row singlegroup layout84">
							<?php $i = 0;?>
							@foreach ($posts as $post)
								<?php if($i > 1) break;?>
								<div <?php if($i == 0) { echo 'class="col-md-8"';} else{ echo 'class="col-md-4 last"'; } ?>>
									<?php if(Auth::check()) : ?>
									<?php if($post->author == Auth::user()->id || $group->owner == Auth::user()->id):?>
										<div class="deletepost"><a href="{{ url() }}/posts/{{ $post->id }}/edit"><img src="{{ asset('img/editpost_icon.png') }}" width="20"></a><a class="various" href="#confirmdelete<?php echo $post->id; ?>"><img src="{{ asset('img/delete_icon.png') }}" width="20"></a></div>
										<div id="confirmdelete<?php echo $post->id; ?>" class="confirmdelete">
											<h3>{{ trans('messages.postdeleteconfirmation') }}</h3>
											<a href="{{ url() }}/posts/<?php echo $post->id; ?>/delete" class="btn btn-danger">{{ trans('messages.delete') }}</a> <a href="" class="btn btn-logo close_btn">{{ trans('messages.cancel') }}</a>
										</div>
									<?php endif;?>
									<?php endif;?>
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
											<div class="excerpt-area">{{ strip_tags(getExcerpt($post->content)) }}</div>
										</div>
										<?php endif;?>
										<div class="bottom">
											<div class="left">
												
											</div>
											<div class="right">
												<div class="sharebox" id="post{{$post->id}}">
													<a href="" class="social_icons social_tw"><i class="fa fa-twitter"></i></a> <a href="" class="social_icons social_fb"><i class="fa fa-facebook"></i></a> <a href="" class="social_icons social_lk"><i class="fa fa-linkedin"></i></a><a href="" class="social_icons social_wb"><i class="fa fa-weibo"></i></a>
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
								<script type="text/javascript">
									$('.right #post{{$post->id}} a.social_fb').on('click', function(e){
										e.preventDefault();
										window.open('https://www.facebook.com/v2.0/dialog/feed?app_id=866884463391641&display=popup&link='+encodeURIComponent('{{ url() }}/posts/<?php echo $post->id; ?>')+'&caption=OHGOODPARTY&picture={{ url()."/uploads/Medium_".$banner[0] }}&name='+encodeURIComponent('{{ $post->title }}')+'&description={{ strip_tags( trim(preg_replace("/\s+/", " ", getExcerpt($post->content, 60))) ) }}&redirect_uri=https://www.facebook.com', "_blank", "width=600, height=400");
									})
									$('.right #post{{$post->id}} a.social_tw').on('click', function(e){
										e.preventDefault();
										window.open('https://twitter.com/intent/tweet?text={{ $post->title }}&via=ohgoodparty_ogp&url={{ url() }}/posts/<?php echo $post->id; ?>', "_blank", "width=360, height=360");
									})
									$('.right #post{{$post->id}} a.social_lk').on('click', function(e){
										e.preventDefault();
										window.open('https://www.linkedin.com/shareArticle?mini=true&url={{ url() }}/posts/<?php echo $post->id; ?>&title={{ $post->title }}&summary={{ strip_tags( trim(preg_replace("/\s+/", " ", getExcerpt($post->content, 60))) ) }}&source=OHGOODPARTY', "_blank", "width=360, height=360");
									})
									$('.right #post{{$post->id}} a.social_wb').on('click', function(e){
										e.preventDefault();
										window.open('http://service.weibo.com/share/share.php?appkey=3304326450&title={{ $post->title }} @奥格派&url={{ url() }}/posts/<?php echo $post->id; ?>&pic={{ url()."/uploads/Medium_".$banner[0] }}&searchPic=false&style=simple', "_blank", "width=360, height=360");
									})
								</script>
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
										<?php if(Auth::check()) : ?>
										<?php if($post->author == Auth::user()->id || $group->owner == Auth::user()->id):?>
											<div class="deletepost"><a href="{{ url() }}/posts/{{ $post->id }}/edit"><img src="{{ asset('img/editpost_icon.png') }}" width="20"></a><a class="various" href="#confirmdelete<?php echo $post->id; ?>"><img src="{{ asset('img/delete_icon.png') }}" width="20"></a></div>
											<div id="confirmdelete<?php echo $post->id; ?>" class="confirmdelete">
												<h3>{{ trans('messages.postdeleteconfirmation') }}</h3>
												<a href="{{ url() }}/posts/<?php echo $post->id; ?>/delete" class="btn btn-danger">{{ trans('messages.delete') }}</a> <a href="" class="btn btn-logo close_btn">{{ trans('messages.cancel') }}</a>
											</div>
										<?php endif;?>
										<?php endif;?>
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
													<div class="sharebox" id="post{{$post->id}}">
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
									<script type="text/javascript">
										$('.right #post{{$post->id}} a.social_fb').on('click', function(e){
											e.preventDefault();
											window.open('https://www.facebook.com/v2.0/dialog/feed?app_id=866884463391641&display=popup&link='+encodeURIComponent('{{ url() }}/posts/<?php echo $post->id; ?>')+'&caption=OHGOODPARTY&picture={{ url()."/uploads/Medium_".$banner[0] }}&name='+encodeURIComponent('{{ $post->title }}')+'&description={{ strip_tags( trim(preg_replace("/\s+/", " ", getExcerpt($post->content, 60))) ) }}&redirect_uri=https://www.facebook.com', "_blank", "width=600, height=400");
										})
										$('.right #post{{$post->id}} a.social_tw').on('click', function(e){
											e.preventDefault();
											window.open('https://twitter.com/intent/tweet?text={{ $post->title }}&via=ohgoodparty_ogp&url={{ url() }}/posts/<?php echo $post->id; ?>', "_blank", "width=360, height=360");
										})
										$('.right #post{{$post->id}} a.social_lk').on('click', function(e){
											e.preventDefault();
											window.open('https://www.linkedin.com/shareArticle?mini=true&url={{ url() }}/posts/<?php echo $post->id; ?>&title={{ $post->title }}&summary={{ strip_tags( trim(preg_replace("/\s+/", " ", getExcerpt($post->content, 60))) ) }}&source=OHGOODPARTY', "_blank", "width=360, height=360");
										})
										$('.right #post{{$post->id}} a.social_wb').on('click', function(e){
											e.preventDefault();
											window.open('http://service.weibo.com/share/share.php?appkey=3304326450&title={{ $post->title }} @奥格派&url={{ url() }}/posts/<?php echo $post->id; ?>&pic={{ url()."/uploads/Medium_".$banner[0] }}&searchPic=false&style=simple', "_blank", "width=360, height=360");
										})
									</script>
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
											<div class="deletepost"><a href="{{ url() }}/posts/{{ $post->id }}/edit"><img src="{{ asset('img/editpost_icon.png') }}" width="20"></a><a class="various" href="#confirmdelete<?php echo $post->id; ?>"><img src="{{ asset('img/delete_icon.png') }}" width="20"></a></div>
											<div id="confirmdelete<?php echo $post->id; ?>" class="confirmdelete">
												<h3>{{ trans('messages.postdeleteconfirmation') }}</h3>
												<a href="{{ url() }}/posts/<?php echo $post->id; ?>/delete" class="btn btn-danger">{{ trans('messages.delete') }}</a> <a href="" class="btn btn-logo close_btn">{{ trans('messages.cancel') }}</a>
											</div>
										<?php endif;?>
										<?php endif;?>
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
														<div class="sharebox" id="post{{$post->id}}">
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
										<script type="text/javascript">
											$('.right #post{{$post->id}} a.social_fb').on('click', function(e){
												e.preventDefault();
												window.open('https://www.facebook.com/v2.0/dialog/feed?app_id=866884463391641&display=popup&link='+encodeURIComponent('{{ url() }}/posts/<?php echo $post->id; ?>')+'&caption=OHGOODPARTY&picture={{ url()."/uploads/Medium_".$banner[0] }}&name='+encodeURIComponent('{{ $post->title }}')+'&description={{ strip_tags( trim(preg_replace("/\s+/", " ", getExcerpt($post->content, 60))) ) }}&redirect_uri=https://www.facebook.com', "_blank", "width=600, height=400");
											})
											$('.right #post{{$post->id}} a.social_tw').on('click', function(e){
												e.preventDefault();
												window.open('https://twitter.com/intent/tweet?text={{ $post->title }}&via=ohgoodparty_ogp&url={{ url() }}/posts/<?php echo $post->id; ?>', "_blank", "width=360, height=360");
											})
											$('.right #post{{$post->id}} a.social_lk').on('click', function(e){
												e.preventDefault();
												window.open('https://www.linkedin.com/shareArticle?mini=true&url={{ url() }}/posts/<?php echo $post->id; ?>&title={{ $post->title }}&summary={{ strip_tags( trim(preg_replace("/\s+/", " ", getExcerpt($post->content, 60))) ) }}&source=OHGOODPARTY', "_blank", "width=360, height=360");
											})
											$('.right #post{{$post->id}} a.social_wb').on('click', function(e){
												e.preventDefault();
												window.open('http://service.weibo.com/share/share.php?appkey=3304326450&title={{ $post->title }} @奥格派&url={{ url() }}/posts/<?php echo $post->id; ?>&pic={{ url()."/uploads/Medium_".$banner[0] }}&searchPic=false&style=simple', "_blank", "width=360, height=360");
											})
										</script>
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
											<div class="deletepost"><a href="{{ url() }}/posts/{{ $post->id }}/edit"><img src="{{ asset('img/editpost_icon.png') }}" width="20"></a><a class="various" href="#confirmdelete<?php echo $post->id; ?>"><img src="{{ asset('img/delete_icon.png') }}" width="20"></a></div>
											<div id="confirmdelete<?php echo $post->id; ?>" class="confirmdelete">
												<h3>Are you sure to delete this post?</h3>
												<a href="{{ url() }}/posts/<?php echo $post->id; ?>/delete" class="btn btn-danger">Delete</a> <a href="" class="btn btn-logo close_btn">Cancel</a>
											</div>
										<?php endif;?>
										<?php endif;?>
												<div class="postfrom"><div>{{ trans('posts.from') }} <a href="/brands/<?php echo $post->group->slug; ?>">{{ $post->group->name }}</a></div><div class="grouppost"><a href="{{ url() }}/brands/category/{{$post->group->categorykey}}">{{ trans('brands.'.$post->group->categorykey) }}</a></div></div>
												<a href="{{ url() }}/posts/<?php echo $post->id; ?>">
												<?php $banner = explode(',', $post->banner); ?>
													<div class="bannerholder" style="background: #ccc url('<?php echo url().'/uploads/Small_'.$banner[0];?>') no-repeat center center; background-size: cover;">
													</div>
												</a>
													<div class="postauthor">{{ Jenssegers\Date\Date::instance($post->created_at)->diffForHumans() }}</div>
													<div class="title-area"><a href="{{ url() }}/posts/<?php echo $post->id; ?>"><h3>{{ $post->title }}</h3></a></div>
													<div class="excerpt-area">{{ strip_tags(getExcerpt($post->content, 12)) }}</div>
													<div class="bottom">
														<div class="left">
															
														</div>
														<div class="right">
															<div class="sharebox" id="post{{$post->id}}">
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
											<script type="text/javascript">
												$('.right #post{{$post->id}} a.social_fb').on('click', function(e){
													e.preventDefault();
													window.open('https://www.facebook.com/v2.0/dialog/feed?app_id=866884463391641&display=popup&link='+encodeURIComponent('{{ url() }}/posts/<?php echo $post->id; ?>')+'&caption=OHGOODPARTY&picture={{ url()."/uploads/Medium_".$banner[0] }}&name='+encodeURIComponent('{{ $post->title }}')+'&description={{ strip_tags( trim(preg_replace("/\s+/", " ", getExcerpt($post->content, 60))) ) }}&redirect_uri=https://www.facebook.com', "_blank", "width=600, height=400");
												})
												$('.right #post{{$post->id}} a.social_tw').on('click', function(e){
													e.preventDefault();
													window.open('https://twitter.com/intent/tweet?text={{ $post->title }}&via=ohgoodparty_ogp&url={{ url() }}/posts/<?php echo $post->id; ?>', "_blank", "width=360, height=360");
												})
												$('.right #post{{$post->id}} a.social_lk').on('click', function(e){
													e.preventDefault();
													window.open('https://www.linkedin.com/shareArticle?mini=true&url={{ url() }}/posts/<?php echo $post->id; ?>&title={{ $post->title }}&summary={{ strip_tags( trim(preg_replace("/\s+/", " ", getExcerpt($post->content, 60))) ) }}&source=OHGOODPARTY', "_blank", "width=360, height=360");
												})
												$('.right #post{{$post->id}} a.social_wb').on('click', function(e){
													e.preventDefault();
													window.open('http://service.weibo.com/share/share.php?appkey=3304326450&title={{ $post->title }} @奥格派&url={{ url() }}/posts/<?php echo $post->id; ?>&pic={{ url()."/uploads/Medium_".$banner[0] }}&searchPic=false&style=simple', "_blank", "width=360, height=360");
												})
											</script>
										<?php array_splice($posts,0,1); $i++;$j++;?>
										@endforeach
										<div class="row-gap"></div>
								</div>
								</section>
								@endif
						
			@endif
			<?php echo $gposts->render(); ?>
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
    var pagesNum = <?php echo $gposts->lastPage(); ?>; 
    $('#allposts').infinitescroll({
      loading : loading_options,
      navSelector : "#allposts .pagination",
      nextSelector : "#allposts .pagination li.active + li a",
      itemSelector : "#allposts section.container.posts",
      maxPage: pagesNum
    });
})();

$(window).scroll(function(){
		if($(this).scrollTop() > 465){
			$('.navbar-default').addClass('whitebg');
			//$('.bannerwrapper').addClass('locked');
			//$('.bannerwrapper').next().next().css('margin-top', '520px');
			$('.statusbar').addClass('locked');
			$('.bannerwrapper').next().next().css({'margin-top':'55px'});
		}else{
			$('.navbar-default').removeClass('whitebg');
			//$('bannerwrapper').removeClass('locked');
			//$('.bannerwrapper').next().next().css('margin-top', '0');
			$('.statusbar').removeClass('locked');
			$('.bannerwrapper').next().next().css({'margin-top':'0'});
		}
	})
</script>
@endsection
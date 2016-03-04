@extends('layouts.master')

@section('content')
<a href="#" class="post_close"><img src="{{ asset('img/close_btn.png') }}" width="16"></a>
<script type="text/javascript">
	$('.post_close').on('click', function(e){
		e.preventDefault();
		if(document.referrer == "{{ url() }}/home" || document.referrer == "{{ url() }}"){
			window.history.back();
		}else{
			window.location.href = "{{  url() }}/brands/{{ $post->group->slug }}";
		}
	})
</script>
<div class="container single-post">

			<div class="panel">

				<div class="panel-body">
					<div class="groupinfo">
						<span>{{ trans('posts.from') }} <a href="{{  url() }}/brands/{{ $post->group->slug }}">{{ getGroupName($post->group->id) }}</a></span>
					</div>
					<h1> {{ $post->title }}</h1>
					<div class="authorinfo">
						<?php use Jenssegers\Date\Date; Date::setLocale(Config::get('app.locale'));?>
						<!-- <span>By {{ getAuthorname($post->author) }}</span> --> <span><img src="{{ asset('img/calendar_icon.png') }}" width="16"> <?php echo Date::instance($post->created_at)->diffForHumans();//$timestamp = strtotime($post->created_at); echo date('M j, Y', $timestamp); ?></span>
					</div>
					<?php $banners = explode(',', $post->banner); if(count($banners) > 0 && strpos($post->banner,'img/defaultbg') == false):?>
					<div class="postbanner">
						<ul class="bxslider">
						@foreach ($banners as $banner)
							<li><img src="<?php echo url().'/uploads/Medium_'.$banner;?>"></li>
						@endforeach
						</ul>
					</div>
					<?php endif;?>
					<p>{!!html_entity_decode($post->content)!!}</p>
					<br />
					<p>For more information, visit <a href="{{  url() }}/brands/{{ $post->group->slug }}">{{ getGroupName($post->group->id) }}</a></p>
					<div class="postshare">
						<a href="" class="social_icons social_tw"><i class="fa fa-twitter"></i></a> <a href="" class="social_icons social_fb"><i class="fa fa-facebook"></i></a> <a href="" class="social_icons social_lk"><i class="fa fa-linkedin"></i></a><a href="" class="social_icons social_wb"><i class="fa fa-weibo"></i></a>
					</div>
					<script type="text/javascript">
							$('.postshare a.social_fb').on('click', function(e){
								e.preventDefault();
								window.open('https://www.facebook.com/v2.0/dialog/feed?app_id=866884463391641&display=popup&link='+encodeURIComponent('{{ url() }}/posts/<?php echo $post->id; ?>')+'&caption=OHGOODPARTY&picture={{ url()."/uploads/Medium_".$banners[0] }}&name='+encodeURIComponent('{{ $post->title }}')+'&description={!! html_entity_decode( trim(preg_replace("/\s+/", " ", getExcerpt($post->content, 60))) ) !!}&redirect_uri=https://www.facebook.com', "_blank", "width=360, height=360");
							})
							$('.postshare a.social_tw').on('click', function(e){
								e.preventDefault();
								window.open('https://www.twitter.com/share?text={{ $post->title }} {{ url() }}/posts/<?php echo $post->id; ?> @ohgoodparty_ogp&url=/', "_blank", "width=360, height=360");
							})
							$('.postshare a.social_lk').on('click', function(e){
								e.preventDefault();
								window.open('https://www.linkedin.com/shareArticle?mini=true&url={{ url() }}/posts/<?php echo $post->id; ?>&title={{ $post->title }}&summary={!! html_entity_decode( trim(preg_replace("/\s+/", " ", getExcerpt($post->content, 60))) ) !!}&source=OHGOODPARTY', "_blank", "width=360, height=360");
							})
							$('.postshare a.social_wb').on('click', function(e){
								e.preventDefault();
								window.open('http://service.weibo.com/share/share.php?appkey=3304326450&title={{ $post->title }} @奥格派&url={{ url() }}/posts/<?php echo $post->id; ?>&pic={{ url()."/uploads/Medium_".$banners[0] }}&searchPic=false&style=simple', "_blank", "width=360, height=360");
							})
					</script>
					<div class="commentscount">
						<span class="c_holder">{{ $post->comments->count()}} {{ trans('posts.comments') }}</span> | <span>{{ trans('events.category') }} {{ trans('brands.'.$post->group->categorykey) }}</span>
					</div>
					<hr>
					@if(Auth::check())
					<section id="leavecomments">
						<h4 class="title">{{ trans('posts.leavecomment') }}</h4>
						<form action="{{ URL::route('createComment', array('id' => $post->id)) }}" method="post">
							<input type="hidden" name="_token" value="{{ csrf_token() }}">
							<input type="hidden" name="author" value="{{ Auth::user()->id }}">
							<div class="form-group">
								<textarea name="content" class="form-control" placeholder="{{ trans('posts.writedown') }}" required></textarea>
							</div>
							<input type="submit" class="btn btn-logo" value="{{ trans('posts.submit') }}">
						</form>
					</section> 
					@endif
					<section id="comments">
						@foreach ($post->comments as $comment)
							<div class="comment row">
								<div class="col-md-1 col-sm-1 col-xs-2">
									<?php 
										$user_profile = DB::table('user_meta')->where('user_id', $comment->author)->where('meta_key', 'profile')->get();
										if(count($user_profile) > 0):
									?>
										<div class="top-profile" style="background: url(<?php echo url()."/uploads/Small_".$user_profile[0]->meta_value;?>) center center no-repeat; background-size: cover; border-radius: 50px"></div>
									<?php
										else:
									?>
										<div class="top-profile">{{ getFirstCharter(getAuthorname($comment->author)) }}</div>
									<?php endif;?>
								</div>
								<div class="col-md-11 col-sm-11 col-xs-10">
									<p class="commentauthor"><strong>{{ getAuthorname($comment->author) }}</strong>&nbsp;&nbsp;<span class="ago-bullet">•</span>&nbsp;&nbsp;{{ $comment->created_at->diffForHumans() }}</p> 
									<p>{!! html_entity_decode($comment->content) !!}</p>
								</div>
							</div>
						@endforeach
					</section>
				</div>
			</div>

</div>
@endsection
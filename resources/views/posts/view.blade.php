@extends('layouts.master')

@section('content')
<a href="javascript: history.go(-1)" class="post_close"><img src="{{ asset('img/close_btn') }}" width="22"></a>
<div class="container single-post">

			<div class="panel">

				<div class="panel-body">
					<div class="groupinfo">
						<span>{{ trans('posts.from') }} <a href="{{  url() }}/brands/{{ $post->group->slug }}">{{ getGroupName($post->group->id) }}</a></span>
					</div>
					<h1> {{ $post->title }}</h1>
					<div class="authorinfo">
						<!-- <span>By {{ getAuthorname($post->author) }}</span> --> <span><img src="{{ asset('img/calendar_icon.png') }}" width="16"> <?php echo $post->created_at->diffForHumans();//$timestamp = strtotime($post->created_at); echo date('M j, Y', $timestamp); ?></span>
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
					<p>For more information, visit <a href="{{  url() }}/brands/{{ $post->group->slug }}" class="nobreak">{{ getGroupName($post->group->id) }}</a></p>
					<div class="postshare">
						<span>Share</span> <a href="" class="social_icons social_tw"><i class="fa fa-twitter"></i></a> <a href="" class="social_icons social_fb"><i class="fa fa-facebook"></i></a> <a href="" class="social_icons social_lk"><i class="fa fa-linkedin"></i></a><a href="" class="social_icons social_wb"><i class="fa fa-weibo"></i></a>
					</div>
					<div class="commentscount">
						<span class="c_holder">{{ $post->comments->count()}} {{ trans('posts.comments') }}</span> | <span>{{ trans('events.category') }} {{ $post->group->category }}</span>
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
							<input type="submit" class="btn btn-logo">
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
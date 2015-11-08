@extends('layouts.master')

@section('content')
<div class="container single-post">
	<div class="row">
		<div class="col-md-10 col-md-offset-1">
			<div class="panel">

				<div class="panel-body">
					<div class="groupinfo">
						<span>FROM <a href="{{  url() }}/groups/{{ $post->group->slug }}">{{ getGroupName($post->group->id) }}</a></span>
						<span>Category: {{ $post->group->category }}</span>
					</div>
					<h1> {{ $post->title }}</h1>
					<div class="authorinfo">
						<span>By {{ getAuthorname($post->author) }}</span> <span><img src="{{ asset('img/calendar_icon.png') }}" width="16"> <?php $timestamp = strtotime($post->created_at); echo date('M j, Y', $timestamp); ?></span>
					</div>
					<?php $banners = explode(',', $post->banner); ?>
					<div class="postbanner">
					<div class="flexslider">
						<ul class="slides">
						@foreach ($banners as $banner)
							<li><img src="<?php echo url().'/'.$banner;?>" class="post-img"></li>
						@endforeach
						</ul>
					</div>
					</div>
					<p>{!!html_entity_decode($post->content)!!}</p>
					
					<div class="commentscount">
						<span class="c_holder">{{ $post->comments->count()}} Comments</span>
					</div>
					<hr>
					@if(Auth::check())
					<section>
						<h3 class="title">Leave a comment</h3>
						<form action="{{ URL::route('createComment', array('id' => $post->id)) }}" method="post">
							<input type="hidden" name="_token" value="{{ csrf_token() }}">
							<input type="hidden" name="author" value="{{ Auth::user()->id }}">
							<div class="form-group">
								<textarea name="content" class="form-control" placeholder="Write down your thoughts..." required></textarea>
							</div>
							<input type="submit" class="btn btn-logo">
						</form>
					</section> 
					@endif
					<section id="comments">
						@foreach ($post->comments as $comment)
							<div class="comment row">
								<div class="col-md-1">
									<?php 
										$user_profile = DB::table('user_meta')->where('user_id', $comment->author)->where('meta_key', 'profile')->get();
										if(count($user_profile) > 0):
									?>
										<div class="top-profile" style="background: url(<?php echo url()."/".$user_profile[0]->meta_value;?>) center center no-repeat; background-size: cover; border-radius: 50px"></div>
									<?php
										else:
									?>
										<div class="top-profile">{{ getFirstCharter(Auth::user()->name) }}</div>
									<?php endif;?>
								</div>
								<div class="col-md-11">
									<p class="commentauthor"><strong>{{ getAuthorname($comment->author) }}</strong>&nbsp;&nbsp;<span class="ago-bullet">•</span>&nbsp;&nbsp;{{ $comment->created_at->diffForHumans() }}</p> 
									<p>{{ $comment->content }}</p>
								</div>
							</div>
						@endforeach
					</section>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection
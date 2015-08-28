@extends('layouts.master')

@section('content')
<div class="container">
	<div class="row">
		<div class="col-md-10 col-md-offset-1">
			<div class="panel">

				<div class="panel-body">
					<h1> {{ $post->title }}</h1>
					<?php $banners = explode(',', $post->banner); ?>
					<p>
						@foreach ($banners as $banner)
							<img src="<?php echo url().'/'.$banner;?>" class="post-img">
						@endforeach
					</p>
					<p>{{ $post->content }}</p>
					<div class="commentscount">
						<span class="c_holder">{{ $post->comments->count()}} Comments</span>
					</div>
					<hr>
					@if(Auth::check())
					<section>
						<h3 class="title">Add a comment</h3>
						<form action="{{ URL::route('createComment', array('id' => $post->id)) }}" method="post">
							<input type="hidden" name="_token" value="{{ csrf_token() }}">
							<input type="hidden" name="author" value="{{ Auth::user()->id }}">
							<div class="form-group">
								<textarea name="content" class="form-control" placeholder="Write down your thoughts..."></textarea>
							</div>
							<input type="submit" class="btn btn-logo">
						</form>
					</section> 
					@endif
					<section id="comments">
						@foreach ($post->comments as $comment)
							<div class="comment">
								<p><a href="{{ url() }}/profiles/{{$comment->author}}">{{ getAuthorname($comment->author) }}</a></p>
								<p>{{ $comment->content }}</p>
							</div>
						@endforeach
					</section>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection
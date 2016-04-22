@extends('layouts.master')

@section('content')
	<div class="container admin">
		@if(Auth::id() == '1')
		<div class="row">
			<aside class="col-md-3">
				<ul>
					<li><a href="{{ url() }}/adminogp">Dashboard</a></li>
					<li><a href="{{ url() }}/adminogp/users">Users</a></li>
					<li><a href="{{ url() }}/adminogp/brands">Brands</a></li>
					<li><a href="{{ url() }}/adminogp/posts">Posts</a></li>
					<li><a href="{{ url() }}/adminogp/tickets">Tickets</a></li>
				</ul>
			</aside>
			<section class="col-md-9">
				<h2>Admin/Posts</h2>
				<table class="table table-striped">
					<tbody>
						<tr>
							<td><strong>Post Title</strong></td>
							<td><strong>Post Author</strong></td>
							<td class="center"><strong>Featured</strong></td>
						</tr>
						@foreach($posts as $post)
							<tr>
								<td>{{ $post->title }}</td>
								<td>{{ getAuthorname($post->author) }}</td>
								<td class="center">
									@if($post->featured == '1')
										<a href="" data-postid="{{ $post->id }}" class="brandfeatured postunf"><i class="fa fa-star"></i></a>
									@else
										<a href="" data-postid="{{ $post->id }}" class="brandfeatured postf"><i class="fa fa-star-o"></i></a>
									@endif
								</td>
							</tr>
						@endforeach
					</tbody>
				</table>
			</section>
		</div>
		<script type="text/javascript">
			$('body').on('click', '.postf', function(e){
				e.preventDefault();
				$.ajaxSetup({
				   headers: { 'X-CSRF-Token' : $('meta[name=_token]').attr('content') }
				});
				var that = $(this);
				var pid = $(this).data('postid');
				$.ajax({
					type: "POST",
					url: window.location.origin+"/post/feature",
					data: "pid="+pid
				}).done(function(response){
					that.removeClass('postf');
					that.addClass('postunf');
					that.html('<i class="fa fa-star">');
				})
			})
			$('body').on('click', '.postunf', function(e){
				e.preventDefault();
				$.ajaxSetup({
				   headers: { 'X-CSRF-Token' : $('meta[name=_token]').attr('content') }
				});
				var that = $(this);
				var pid = $(this).data('postid');
				$.ajax({
					type: "POST",
					url: window.location.origin+"/post/unfeature",
					data: "pid="+pid
				}).done(function(response){
					that.removeClass('postunf');
					that.addClass('postf');
					that.html('<i class="fa fa-star-o">');
				})
			})
		</script>
		@else
			<h4>You should not be here!</h4>
		@endif
	</div>
@endsection
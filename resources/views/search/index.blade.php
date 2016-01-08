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
						@foreach ($groups as $group)
							<div class="singlepost">
								<a href="{{ url() }}/brands/{{ $group['slug'] }}"><h4>{{ $group['name'] }}</h4></a>
								<p>{{ getExcerpt($group['description']) }}</p>
							</div>
						@endforeach
					@elseif (count($posts) > 0)
						<h3>Posts</h3>
						@foreach ($posts as $post)
							<div class="singlepost">
								<a href="{{ url() }}/posts/{{ $post['id'] }}"><h4>{{ $post['title'] }}</h4></a>
								<p>{{ getExcerpt($post['content']) }}</p>
							</div>
						@endforeach
					@elseif (count($events) > 0)
						<h3>Events</h3>
						@foreach ($events as $event)
							<div class="singlepost">
								<a href="{{ url() }}/events/{{ $event['id'] }}"><h4>{{ $event['title'] }}</h4></a>
								<p>{{ getExcerpt($event['content']) }}</p>
							</div>
						@endforeach
					@else
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
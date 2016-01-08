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
				<?php var_dump($posts);
				var_dump($groups);
				var_dump($events);?>
					@if (count($groups) > 0)
						<h2>Brands:</h2>
						@foreach ($groups as $group)
							<div class="singlepost">
								<h3>{{ $group->name }}</h3>
								<p>{{ getExcerpt($group->description) }}</p>
							</div>
						@endforeach
					@elseif (count($posts) > 0)
						<h2>Posts:</h2>
						@foreach ($posts as $post)
							<div class="singlepost">
								<h3>{{ $post->title }}</h3>
								<p>{{ getExcerpt($post->content) }}</p>
							</div>
						@endforeach
					@elseif (count($events) > 0)
						<h2>Events:</h2>
						@foreach ($events as $event)
							<div class="singlepost">
								<h3>{{ $event->title }}</h3>
								<p>{{ getExcerpt($event->content) }}</p>
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
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
				<?php echo "<pre>"; var_dump($groups);echo "</pre>";?>

						<h2>Brands:</h2>
						@foreach ($groups as $group)
							<div class="singlepost">
								<h3>{{ $group->name }}</h3>
								<p>{{ getExcerpt($group->description) }}</p>
							</div>
						@endforeach
	
						<h2>Posts:</h2>
						@foreach ($posts as $post)
							<div class="singlepost">
								<h3>{{ $post->title }}</h3>
								<p>{{ getExcerpt($post->content) }}</p>
							</div>
						@endforeach
	
						<h2>Events:</h2>
						@foreach ($events as $event)
							<div class="singlepost">
								<h3>{{ $event->title }}</h3>
								<p>{{ getExcerpt($event->content) }}</p>
							</div>
						@endforeach

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
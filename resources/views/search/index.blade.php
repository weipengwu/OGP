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
					@if (count($posts) > 0)
						@foreach ($posts as $post)
							<div class="singlepost">
								<h3>{{ $post->title }}</h3>
								<p>{{ getExcerpt($post->content) }}</p>
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
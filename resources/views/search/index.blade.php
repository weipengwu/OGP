@extends('layouts.master')

@section('content')
	
<div class="container eventindex">
	<div class="row">
		<div class="col-md-12">
			<div class="panel">
				<div class="panel-heading">
					<h1>Search Result</h1>
				</div>
				<div class="panel-body">
					@foreach ($posts as $post)
						<div class="singlepost">
							<h3>{{ $post->title }}</h3>
							<p>{{ getExcerpt($post->content) }}</p>
						</div>
					@endforeach
				</div>
			</div>
		</div>
	</div>
</div>

@endsection
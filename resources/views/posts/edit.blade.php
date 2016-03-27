@extends('layouts.master')

@section('content')
<div class="container">
	<div class="row">
		<div class="fixedarea">
			<div class="panel">
				<div class="panel-heading"><h3>{{ trans('posts.editpost') }}</h3></div>

				<div class="panel-body">
					@if (count($errors) > 0)
						<div class="alert alert-danger">
							{{ trans('messages.inputerror') }}<br><br>
							<ul>
								@foreach ($errors->all() as $error)
									<li>{{ $error }}</li>
								@endforeach
							</ul>
						</div>
					@endif
					<form action="{{ URL::route('editingPost') }}" method="post" id="createPost">
						<input type="hidden" name="_token" value="{{ csrf_token() }}">
						<input type="hidden" name="pid" value="{{ $post->id }}">
						<div class="form-group">
							<input type="text" name="title" class="form-control" placeholder="{{ trans('posts.posttitle') }}" maxlength="100" value="{{ $post->title }}" required>
						</div>
						<div class="form-group">
							<textarea name="content" class="form-control" id="posteditor" placeholder="{{ trans('posts.postcontent') }}" required>{{ strip_tags($post->content) }}</textarea>
						</div>
						<input type="submit" class="btn btn-logo" value="{{ trans('posts.submit') }}">
					</form>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection
@extends('layouts.master')

@section('content')
<div class="container">
	<div class="row">
		<div class="fixedarea">
			<div class="panel">
				<div class="panel-heading"><h3>{{ trans('posts.createanewpost') }}</h3></div>

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
					<form action="{{ URL::route('createPost') }}" method="post" enctype="multipart/form-data" id="createPost">
						<input type="hidden" name="_token" value="{{ csrf_token() }}">
						<input type="hidden" name="author" value="{{ Auth::user()->id }}">
						<input type="hidden" name="gid" value="<?php echo $gid;?>">
						<div class="form-group">
							<input type="text" name="title" class="form-control" placeholder="{{ trans('posts.posttitle') }}" maxlength="100" required>
						</div>
						<div class="form-group">
							<textarea name="content" class="form-control" id="posteditor" placeholder="{{ trans('posts.postcontent') }}" required></textarea>
						</div>
						<div class="form-group">
							<div>{{ trans('posts.postimages') }}</div>
						</div>
						<div class="imagezone">
							<div class="form-group form-img1">
								<input type="file" id="postimage1" name="postimage1" accept="image/*">
							</div>
							<div class="form-group form-img2">
								<input type="file" id="postimage2" name="postimage2" accept="image/*">
							</div>
							<div class="form-group form-img3">
								<input type="file" id="postimage3" name="postimage3" accept="image/*">
							</div>
							<div class="form-group form-img4">
								<input type="file" id="postimage4" name="postimage4" accept="image/*">
							</div>
							<div class="form-group form-img5">
								<input type="file" id="postimage5" name="postimage5" accept="image/*">
							</div>
							<div class="form-group form-img6">
								<input type="file" id="postimage6" name="postimage6" accept="image/*">
							</div>
						</div>
						<input type="submit" class="btn btn-logo" value="{{ trans('posts.submit') }}">
					</form>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection
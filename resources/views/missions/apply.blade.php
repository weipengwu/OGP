@extends('layouts.master')

@section('content')
<div class="container">
	<div class="row">
		<div class="col-md-8 col-md-offset-2">
			<div class="panel">
				<div class="panel-heading"><h3>Apply {{ $mission->title }}</h3></div>

				<div class="panel-body">
					@if (count($errors) > 0)
						<div class="alert alert-danger">
							<strong>Whoops!</strong> There were some problems with your input.<br><br>
							<ul>
								@foreach ($errors->all() as $error)
									<li>{{ $error }}</li>
								@endforeach
							</ul>
						</div>
					@endif

					<div id="applyswitch">
						<label>Link my resume</label> <input type="checkbox" name="applyswitch" />
						<input type="hidden" value="" name="resume">
					</div>
					<form id="linkresume" action="{{ URL::route('sendResume') }}" method="post" enctype="multipart/form-data">
						<input type="hidden" name="_token" value="{{ csrf_token() }}">
						<input type="hidden" name="author" value="{{ Auth::user()->id }}">
						<div class="form-group">
							<label>Upload Your Resume</label>
							<input type="file" id="resume-upload" name="resume-upload">
						</div>
		
						<div class="form-group">
							<input type="text" name="linkedin" class="form-control" placeholder="LinkedIn*">
						</div>
						<div class="form-group">
							<textarea name="content" class="form-control" placeholder="Descirbe Yourself..."></textarea>
						</div>
						<input type="submit" class="btn btn-logo">
					</form>
					<form id="noresume" action="{{ URL::route('sendResume') }}" method="post" enctype="multipart/form-data">
						<input type="hidden" name="_token" value="{{ csrf_token() }}">
						<input type="hidden" name="author" value="{{ Auth::user()->id }}">
		
						<div class="form-group">
							<input type="text" name="linkedin" class="form-control" placeholder="LinkedIn*">
						</div>
						<div class="form-group">
							<textarea name="content" class="form-control" placeholder="Descirbe Yourself..."></textarea>
						</div>
						<div class="form-group">
							<input type="text" name="interest" class="form-control" placeholder="What is your interest?*">
						</div>
						<div class="form-group">
							<input type="text" name="linkedin" class="form-control" placeholder="What is your Work experience?*">
						</div>
						<div class="form-group">
							<input type="text" name="linkedin" class="form-control" placeholder="Have you ever been a volunteer?*">
						</div>
						<input type="submit" class="btn btn-logo">
					</form>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection
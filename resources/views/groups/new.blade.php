@extends('layouts.master')

@section('content')
<div class="container">
	<div class="row">
		<div class="col-md-8 col-md-offset-2">
			<div class="panel">
				<div class="panel-heading"><h3>CREATE A NEW GROUP</h3></div>

				<div class="panel-body">
					<form action="{{ URL::route('createGroup') }}" method="post" enctype="multipart/form-data">
						<input type="hidden" name="_token" value="{{ csrf_token() }}">
						<input type="hidden" name="creator" value="{{ Auth::user()->id }}">
						<input type="hidden" name="owner" value="{{ Auth::user()->id }}">
						<h4>UPLOAD IMAGES FOR YOUR GROUP</h4>
						<hr>
						<div class="form-group">
							<label>Upload Your Group Profile Image</label>
							<input type="file" id="g-profile" name="g-profile" accept="image/*">
						</div>
						<div class="form-group">
							<label>Upload Your Group Banner Image</label>
							<input type="file" id="g-banner" name="g-banner" accept="image/*">
						</div>
						<h4>TELL US MORE ABOUT YOUR GROUP</h4>
						<hr>
						<div class="form-group">
							<input type="text" name="name" class="form-control" placeholder="Group Name">
						</div>
						<div class="form-group">
							<select name="category" class="form-control">
								<option value="">Group Category -- Select one</option>
								<option>Architecture</option>
								<option>Arts</option>
								<option>Automotive</option>
								<option>Business</option>
								<option>Charity</option>
								<option>Culture</option>
								<option>Design</option>
								<option>Educational</option>
								<option>Food</option>
								<option>Games</option>
								<option>Health</option>
								<option>Home</option>
								<option>Music</option>
								<option>News</option>
								<option>Photography</option>
								<option>Religion</option>
								<option>Sports</option>
								<option>Technology</option>
								<option>Travel</option>
							</select>
						</div>
						<div class="form-group">
							<input type="text" name="tag" class="form-control" placeholder="Group Tag">
						</div>
						<div class="form-group">
							<input type="text" name="website" class="form-control" placeholder="Group Website">
						</div>
						<div class="form-group">
							<select name="type" class="form-control">
								<option value="public">Public</option>
								<option value="private">Private</option>
							</select>
						</div>
						<div class="form-group">
							<label>Apply to Join</label> <input type="checkbox" name="applytojoin" />
						</div>
						<div class="form-group">
							<textarea name="description" class="form-control" placeholder="Group Description"></textarea>
						</div>
						<input type="submit" class="btn btn-logo">
					</form>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection
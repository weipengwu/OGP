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
								<option value="Arts & Design">Arts & Design</option>
								<option value="Auto">Auto</option>
								<option value="Business">Business</option>
								<option value="Education">Education</option>
								<option value="Fashion">Fashion</option>
								<option value="Food & Drink">Food & Drink</option>
								<option value="Games">Games</option>
								<option value="Health">Health</option>
								<option value="Home">Home</option>
								<option value="Music">Music</option>
								<option value="Sports">Sports</option>
								<option value="Technology">Technology</option>
								<option value="Travel">Travel</option>
								<option value="Other">Other</option>
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
							<textarea name="description" maxlength="300" class="form-control" placeholder="Group Description"></textarea>
						</div>
						<input type="submit" class="btn btn-logo" value="Submit">
					</form>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection
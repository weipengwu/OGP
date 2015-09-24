@extends('layouts.master')

@section('content')
<div class="container">
	<div class="row">
		<div class="col-md-8 col-md-offset-2">
			<div class="panel">
				<div class="panel-heading"><h3>CREATE YOUR BRAND</h3></div>

				<div class="panel-body">
					<form action="{{ URL::route('createGroup') }}" method="post" enctype="multipart/form-data">
						<input type="hidden" name="_token" value="{{ csrf_token() }}">
						<input type="hidden" name="creator" value="{{ Auth::user()->id }}">
						<input type="hidden" name="owner" value="{{ Auth::user()->id }}">
						<h4>UPLOAD IMAGES FOR YOUR BRAND</h4>
						<hr>
						<div class="form-group">
							<label>Upload Your Brand Logo</label>
							<input type="file" id="g-profile" name="g-profile" accept="image/*">
						</div>
						<div class="form-group">
							<label>Upload Your Brand Banner Image</label>
							<input type="file" id="g-banner" name="g-banner" accept="image/*">
						</div>
						<h4>TELL US MORE ABOUT YOUR BRAND</h4>
						<hr>
						<div class="form-group">
							<input type="text" name="name" class="form-control" placeholder="Brand Name" required>
						</div>
						<div class="form-group">
							<select name="category" class="form-control" required>
								<option value="">Brand Category -- Select one</option>
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
							<input type="text" name="tag" class="form-control" placeholder="Brand Tag">
						</div>
						<div class="form-group">
							<input type="text" name="website" class="form-control" placeholder="Brand Website">
						</div>
						<div class="form-group selectorigin">
							<select class="form-control" required>
								<option value="">Origin (Country)</option>
								<option value="Canada">Canada</option>
								<option value="China">China</option>
								<option value="United States">United States</option>
							</select>
							<select class="form-control" required>
								<option>Origin (Province)</option>
							</select>
						</div>
						<div class="form-group">
							<select name="target" class="form-control" required>
								<option value="">Target Market</option>
								<option value="North America">North America</option>
								<option value="Westen Europe">Westen Europe</option>
								<option value="China">China</option>
							</select>
						</div>
						<div class="form-group translation">
							<span>Do you need translation</span> <span class="radio"><input type="radio" name="translate" id="yestranslate" value="yes" /> <label for="yestranslate">Yes</label> </span><span class="radio"><input type="radio" name="translate" id="notranslate" value="no" /> <label for="notranslate">No</label></span>
						</div>
						<div class="form-group trlanguages">
							<select name="trlang" class="form-control">
								<option value="">Select Target Language</option>
								<option value="Chinese">Chinese</option>
								<option value="English">English</option>
								<option value="French">French</option>
								<option value="Spanish">Spanish</option>
							</select>
						</div>
						<div class="form-group">
							<select name="type" class="form-control">
								<option value="public">Public</option>
								<option value="private">Private</option>
							</select>
						</div>
						<div class="form-group allpytojoin">
							<span>Apply to Join</span> <span class="radio"><input type="radio" name="applytojoin" id="applyyes" value="yes" /> <label for="applyyes">Yes</label> </span><span class="radio"><input type="radio" name="applytojoin" id="applyno" value="no" /> <label for="applyno">No</label></span>
						</div>
						<div class="form-group">
							<textarea name="description" maxlength="300" class="form-control" placeholder="Brand Description" required></textarea>
						</div>
						<input type="submit" class="btn btn-logo" value="Submit">
					</form>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection
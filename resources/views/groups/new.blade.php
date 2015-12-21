@extends('layouts.master')

@section('content')
<div class="container">
	<div class="row">
		<div class="col-md-8 col-md-offset-2">
			<div class="panel">
				<div class="panel-heading"><h3>CREATE YOUR BRAND</h3></div>

				<div class="panel-body">
					@if (Session::has('message'))
					   <div class="alert alert-danger"><strong>Whoops!</strong> {{ Session::get('message') }}</div>
					@endif
					<form action="{{ URL::route('createGroup') }}" method="post" enctype="multipart/form-data" id="createBrand">
						<input type="hidden" name="_token" value="{{ csrf_token() }}">
						<input type="hidden" name="creator" value="{{ Auth::user()->id }}">
						<input type="hidden" name="owner" value="{{ Auth::user()->id }}">
						<h4>UPLOAD IMAGES FOR YOUR BRAND</h4>
						<hr>
						<div class="form-group">
							<label>Upload Your Brand Logo</label>
							<p>Recomended size: 200px X 200px. Images must be in .jpg, .bmp, .png, or .gif format, and not exceed 4 MB.</p>
							<input type="file" id="g-profile" name="g-profile" accept="image/*">
						</div>
						<div class="form-group">
							<label>Upload Your Brand Banner Image</label>
							<p>Recomended size: 1500px X 500px. Images must be in .jpg, .bmp, .png, or .gif format, and not exceed 4 MB.</p>
							<input type="file" id="g-banner" name="g-banner" accept="image/*">
						</div>
						<h4>TELL US MORE ABOUT YOUR BRAND</h4>
						<hr>
						<div class="form-group" style="position:relative">
							<input type="text" name="name" class="form-control" id="brandname" placeholder="Brand Name" required>
							<div class="checknamepass checkname"><i class="fa fa-check"></i></div>
							<div class="checknamefail checkname"><i class="fa fa-times"></i></div>
							<div class="help-block checknameerror">Brand name has been taken, please choose another one.</div>
						</div>
						<div class="form-group">
							<select name="category" class="form-control" required>
								<option value="">Brand Category -- Select one</option>
								<option value="Arts & Design">Arts & Design</option>
								<option value="Autos">Autos</option>
								<option value="Business">Business</option>
								<option value="Education">Education</option>
								<option value="Fashion">Fashion</option>
								<option value="Food & Drink">Food & Drink</option>
								<option value="Gaming">Gaming</option>
								<option value="Health">Health</option>
								<option value="Home">Home</option>
								<option value="Music & Performance">Music & Performance</option>
								<option value="Sports">Sports</option>
								<option value="Technology & Science">Technology & Science</option>
								<option value="Travel">Travel</option>
								<option value="Other">Other</option>
							</select>
						</div>
						<div class="form-group">
							<input type="text" name="tag" class="form-control" placeholder="Brand Tag">
						</div>
						<div class="form-group">
							<div class="input-group">
								<div class="input-group-addon">http://</div>
								<input type="text" name="website" class="form-control" placeholder="Brand Website">
							</div>
						</div>
						<!-- <div class="form-group selectorigin" data-ng-controller="CountryController">
							 <select class="form-control" name="originCountry" data-ng-model="country" data-ng-options="country.name for country in countries" data-ng-change="updateCountry()">
								<option value="">Origin (Country)</option>
							</select>
							<select class="form-control" name="originProvince" data-ng-model="state" data-ng-options="state.name for state in availableStates">
								<option value="">Origin (Province/State)</option>
							</select> 
						</div>-->
						<div class="form-group orginandtarget">
							<select class="form-control" name="originCountry">
								<option value="">Origin (Country)</option>
							</select>
							<select name="target" class="form-control" required>
								<option value="">Target Market</option>
								<option value="North America">North America</option>
								<option value="Westen Europe">Westen Europe</option>
								<option value="China">China</option>
							</select>
						</div>
						<!-- <div class="form-group translation">
							<span>Do you need translation</span> <span class="radio"><input type="radio" name="translate" id="yestranslate" value="yes" /> <label for="yestranslate">Yes</label> </span><span class="radio"><input type="radio" name="translate" id="notranslate" value="no" checked /> <label for="notranslate">No</label></span>
						</div>
						<div class="form-group trlanguages">
							<select name="trlang" class="form-control">
								<option value="">Select Target Language</option>
								<option value="Chinese">Chinese</option>
								<option value="English">English</option>
								<option value="French">French</option>
								<option value="Spanish">Spanish</option>
							</select>
						</div> -->
						<!--<div class="form-group">
							<select name="type" class="form-control">
								<option value="public">Public</option>
								<option value="private">Private</option>
							</select>
						</div>
						 <div class="form-group allpytojoin">
							<span>Apply to Join</span> <span class="radio"><input type="radio" name="applytojoin" id="applyyes" value="yes" /> <label for="applyyes">Yes</label> </span><span class="radio"><input type="radio" name="applytojoin" id="applyno" value="no" /> <label for="applyno">No</label></span>
						</div> -->
						<div class="form-group">
							<textarea name="description" maxlength="300" class="form-control" placeholder="Brief Introduction(Tips: Please use the language of target markets.)" required></textarea>
						</div>
						<p class="small">By continuing you pledge that the content filled in and the additional materials provided are true and authentic in every aspect.</p>
						<input type="submit" class="btn btn-logo submit" value="Submit">
					</form>
				</div>
			</div>
		</div>
	</div>
</div>

@endsection
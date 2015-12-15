@extends('layouts.master')

@section('content')
<div class="container">
	<div class="row">
		<div class="col-md-8 col-md-offset-2">
			<div class="panel">
				<div class="panel-heading"><h3>EDIT MY BRAND</h3></div>

				<div class="panel-body">
					<form action="{{ URL::route('editingGroup') }}" method="post" enctype="multipart/form-data" id="editBrand">
						<input type="hidden" name="_token" value="{{ csrf_token() }}">
						<input type="hidden" name="id" value="{{ $group->id }}">

						<h4>UPLOAD IMAGES FOR YOUR BRAND</h4>
						<hr>
						<div class="form-group">
							<label>Upload Your New Brand Logo</label>
							<input type="file" id="g-profile" name="g-profile" accept="image/*">
						</div>
						<div class="form-group">
							<label>Upload Your New Brand Banner Image</label>
							<input type="file" id="g-banner" name="g-banner" accept="image/*">
						</div>
						<h4>TELL US MORE ABOUT YOUR BRAND</h4>
						<hr>
						<div class="form-group" style="position:relative">
							<input type="text" name="name" class="form-control" id="brandname" placeholder="Brand Name" value="{{ $group->name }}" required>
							<div class="checknamepass checkname"><i class="fa fa-check"></i></div>
							<div class="checknamefail checkname"><i class="fa fa-times"></i></div>
							<div class="help-block checknameerror">Brand name has been taken, please choose another one.</div>
						</div>
						<div class="form-group">
							<select name="category" class="form-control">
								<option value="">Brand Category -- Select one</option>
								<option value="Arts & Design" <?php if($group->category == 'Arts & Design') echo "selected"; ?>>Arts & Design</option>
								<option value="Autos" <?php if($group->category == 'Autos') echo "selected"; ?>>Autos</option>
								<option value="Business" <?php if($group->category == 'Business') echo "selected"; ?>>Business</option>
								<option value="Education" <?php if($group->category == 'Education') echo "selected"; ?>>Education</option>
								<option value="Fashion" <?php if($group->category == 'Fashion') echo "selected"; ?>>Fashion</option>
								<option value="Food & Drink" <?php if($group->category == 'Food & Drink') echo "selected"; ?>>Food & Drink</option>
								<option value="Gaming" <?php if($group->category == 'Gaming') echo "selected"; ?>>Gaming</option>
								<option value="Health" <?php if($group->category == 'Health') echo "selected"; ?>>Health</option>
								<option value="Home" <?php if($group->category == 'Home') echo "selected"; ?>>Home</option>
								<option value="Music" <?php if($group->category == 'Music') echo "selected"; ?>>Music</option>
								<option value="Sports" <?php if($group->category == 'Sports') echo "selected"; ?>>Sports</option>
								<option value="Technology & Science" <?php if($group->category == 'Technology & Science') echo "selected"; ?>>Technology & Science</option>
								<option value="Travel" <?php if($group->category == 'Travel') echo "selected"; ?>>Travel</option>
								<option value="Other" <?php if($group->category == 'Other') echo "selected"; ?>>Other</option>
							</select>
						</div>
						<div class="form-group">
							<input type="text" name="tag" class="form-control" placeholder="Brand Tag" value="{{ $group->tag }}">
						</div>
						<div class="form-group">
							<div class="input-group">
								<div class="input-group-addon">http://</div>
								<input type="text" name="website" class="form-control" placeholder="Brand Website" value="{{ $group->website }}">
							</div>
						</div>
						<!-- <div class="originsection">
						<div class="currentOrigin">
							Current Origin: @if($group->originCountry == '') {{ 'N/A' }} @else {{ $group->originCountry }} {{ $group->originProvince }} @endif <a href="#" class="showSelect">Change</a> 
						</div>
						<div class="form-group selectorigin" data-ng-controller="CountryController" style="display: none;">
							<select class="form-control" name="originCountry" data-ng-model="country" data-ng-options="country.name for country in countries" data-ng-change="updateCountry()">
								<option value="">Origin (Country)</option>
							</select>
							<select class="form-control" name="originProvince" data-ng-model="state" data-ng-options="state.name for state in availableStates">
								<option value="">Origin (Province/State)</option>
							</select>
						</div>
						</div> -->
						<div class="form-group orginandtarget">
							<select class="form-control" name="originCountry">
								<option value="">Origin (Country)</option>
							</select>
							<select name="target" class="form-control" required>
								<option value="">Target Market</option>
								<option value="North America" <?php if($group->target == 'North America') echo "selected"; ?>>North America</option>
								<option value="Westen Europe" <?php if($group->target == 'Westen Europe') echo "selected"; ?>>Westen Europe</option>
								<option value="China" <?php if($group->target == 'China') echo "selected"; ?>>China</option>
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
						<div class="form-group">
							<textarea name="description" maxlength="300" placeholder="Brief Introduction ( Tips: Please use the language of target markets. )" class="form-control" required>{!! strip_tags($group->description) !!}</textarea>
						</div>
						<input type="submit" class="btn btn-logo" value="Submit">
					</form>
						<script type="text/javascript">
							$('#editBrand #brandname').on('blur', function(){
								$.ajaxSetup({
								   headers: { 'X-CSRF-Token' : $('meta[name=_token]').attr('content') }
								});
								var bname = $(this).val();
								if(bname !== '' && bname !== '{{ $group->name }}'){
									$.ajax({
										type: "POST",
										url: window.location.origin+"/groups/checkBrandname",
										data: "brandname="+bname
									}).done(function(response){
										if (response == 'duplicated') {
											$('.checknamefail').show();
											$('.checknamepass').hide();
										}
										else if(response == 'pass'){
											$('.checknamefail').hide();
											$('.checknamepass').show();
											$('.checknameerror').hide();
										}
									})
								}
							})

							$('#editBrand').validate({
								submitHandler: function(form) {
									if($('.checknamepass').is(':visible')){
										form.submit();
									}else{
										$('#editBrand #brandname').focus();
										$('.checknameerror').show();
									}
								}
							});
						</script>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection
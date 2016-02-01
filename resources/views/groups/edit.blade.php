@extends('layouts.master')

@section('content')
<div class="container">
	<div class="row">
		<div class="fixedarea">
			<div class="panel">
				<div class="panel-heading"><h3>{{ trans('brands.editmybrand') }}</h3></div>

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
					<form action="{{ URL::route('editingGroup') }}" method="post" enctype="multipart/form-data" id="editBrand">
						<input type="hidden" name="_token" value="{{ csrf_token() }}">
						<input type="hidden" name="id" value="{{ $group->id }}">

						<h4>{{ trans('brands.uploadimages') }}</h4>
						<hr>
						<div class="form-group">
							<label>{{ trans('brands.uploadlogo') }}</label>
							<p>{{ trans('brands.recommendedsize') }}</p>
							<input type="file" id="g-profile" name="g-profile" accept="image/*">
						</div>
						<div class="form-group">
							<label>{{ trans('brands.uploadbanner') }}</label>
							<p>{{ trans('brands.recommendedsizebig') }}</p>
							<input type="file" id="g-banner" name="g-banner" accept="image/*">
						</div>
						<h4>{{ trans('brands.tellusmore') }}</h4>
						<hr>
						<div class="form-group" style="position:relative">
							<input type="text" name="name" class="form-control" id="brandname" placeholder="{{ trans('brands.brandname') }}" maxlength="100" value="{{ $group->name }}" required>
							<div class="checknamepass checkname"><i class="fa fa-check"></i></div>
							<div class="checknamefail checkname"><i class="fa fa-times"></i></div>
							<div class="help-block checknameerror">{{ trans('messages.uniquebrandname') }}</div>
						</div>
						<div class="form-group">
							<select name="category" class="form-control">
								<option value="">{{ trans('brands.selectcategory') }}</option>
								<option value="Arts & Design" <?php if($group->category == 'Arts & Design') echo "selected"; ?>>{{ trans('brands.artsdesign') }}</option>
								<option value="Autos" <?php if($group->category == 'Autos') echo "selected"; ?>>{{ trans('brands.autos') }}</option>
								<option value="Business" <?php if($group->category == 'Business') echo "selected"; ?>>{{ trans('brands.business') }}</option>
								<option value="Education" <?php if($group->category == 'Education') echo "selected"; ?>>{{ trans('brands.education') }}</option>
								<option value="Fashion" <?php if($group->category == 'Fashion') echo "selected"; ?>>{{ trans('brands.fashion') }}</option>
								<option value="Food & Drink" <?php if($group->category == 'Food & Drink') echo "selected"; ?>>{{ trans('brands.fooddrink') }}</option>
								<option value="Gaming" <?php if($group->category == 'Gaming') echo "selected"; ?>>{{ trans('brands.gaming') }}</option>
								<option value="Health" <?php if($group->category == 'Health') echo "selected"; ?>>{{ trans('brands.health') }}</option>
								<option value="Home" <?php if($group->category == 'Home') echo "selected"; ?>>{{ trans('brands.home') }}</option>
								<option value="Music & Performance" <?php if($group->category == 'Music & Performance') echo "selected"; ?>>{{ trans('brands.musicperformances') }}</option>
								<option value="Sports" <?php if($group->category == 'Sports') echo "selected"; ?>>{{ trans('brands.sports') }}</option>
								<option value="Technology & Science" <?php if($group->category == 'Technology & Science') echo "selected"; ?>>{{ trans('brands.technologyscience') }}</option>
								<option value="Travel" <?php if($group->category == 'Travel') echo "selected"; ?>>{{ trans('brands.travel') }}</option>
								<option value="Other" <?php if($group->category == 'Other') echo "selected"; ?>>{{ trans('brands.other') }}</option>
							</select>
						</div>
						<div class="form-group">
							<input type="text" name="tag" class="form-control" placeholder="{{ trans('brands.tag') }}" value="{{ $group->tag }}">
						</div>
						<div class="form-group">
							<div class="input-group">
								<div class="input-group-addon">http://</div>
								<input type="text" name="website" class="form-control" placeholder="{{ trans('brands.website') }}" value="{{ $group->website }}">
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
								<option value="AU" @if($group->originCountry == 'AU') {{ 'selected' }} @endif>Australia</option>
								<option value="BR" @if($group->originCountry == 'BR') {{ 'selected' }} @endif>Brazil</option>
								<option value="CA" @if($group->originCountry == 'CA') {{ 'selected' }} @endif>Canada</option>
								<option value="CN" @if($group->originCountry == 'CN') {{ 'selected' }} @endif>China</option>
								<option value="CO" @if($group->originCountry == 'CO') {{ 'selected' }} @endif>Colombia</option>
								<option value="CU" @if($group->originCountry == 'CU') {{ 'selected' }} @endif>Cuba</option>
								<option value="DK" @if($group->originCountry == 'DK') {{ 'selected' }} @endif>Denmark</option>
								<option value="EG" @if($group->originCountry == 'EG') {{ 'selected' }} @endif>Egypt</option>
								<option value="FI" @if($group->originCountry == 'FI') {{ 'selected' }} @endif>Finland</option>
								<option value="FR" @if($group->originCountry == 'FR') {{ 'selected' }} @endif>France</option>
								<option value="DE" @if($group->originCountry == 'DE') {{ 'selected' }} @endif>Germany</option>
								<option value="GR" @if($group->originCountry == 'GR') {{ 'selected' }} @endif>Greece</option>
								<option value="HU" @if($group->originCountry == 'HU') {{ 'selected' }} @endif>Hungary</option>
								<option value="IS" @if($group->originCountry == 'IS') {{ 'selected' }} @endif>Iceland</option>
								<option value="IN" @if($group->originCountry == 'IN') {{ 'selected' }} @endif>India</option>
								<option value="ID" @if($group->originCountry == 'ID') {{ 'selected' }} @endif>Indonesia</option>
								<option value="IR" @if($group->originCountry == 'IR') {{ 'selected' }} @endif>Iran, Islamic Republic of</option>
								<option value="IE" @if($group->originCountry == 'IE') {{ 'selected' }} @endif>Ireland</option>
								<option value="IT" @if($group->originCountry == 'IT') {{ 'selected' }} @endif>Italy</option>
								<option value="JP" @if($group->originCountry == 'JP') {{ 'selected' }} @endif>Japan</option>
								<option value="KR" @if($group->originCountry == 'KR') {{ 'selected' }} @endif>Korea, Republic of</option>
								<option value="MY" @if($group->originCountry == 'MY') {{ 'selected' }} @endif>Malaysia</option>
								<option value="MX" @if($group->originCountry == 'MX') {{ 'selected' }} @endif>Mexico</option>
								<option value="MN" @if($group->originCountry == 'MN') {{ 'selected' }} @endif>Mongolia</option>
								<option value="NL" @if($group->originCountry == 'NL') {{ 'selected' }} @endif>Netherlands</option>
								<option value="NZ" @if($group->originCountry == 'NZ') {{ 'selected' }} @endif>New Zealand</option>
								<option value="NO" @if($group->originCountry == 'NO') {{ 'selected' }} @endif>Norway</option>
								<option value="PH" @if($group->originCountry == 'PH') {{ 'selected' }} @endif>Philippines</option>
								<option value="PL" @if($group->originCountry == 'PL') {{ 'selected' }} @endif>Poland</option>
								<option value="PT" @if($group->originCountry == 'PT') {{ 'selected' }} @endif>Portugal</option>
								<option value="RU" @if($group->originCountry == 'RU') {{ 'selected' }} @endif>Russian Federation</option>
								<option value="SA" @if($group->originCountry == 'SA') {{ 'selected' }} @endif>Saudi Arabia</option>
								<option value="SG" @if($group->originCountry == 'SG') {{ 'selected' }} @endif>Singapore</option>
								<option value="ZA" @if($group->originCountry == 'ZA') {{ 'selected' }} @endif>South Africa</option>
								<option value="ES" @if($group->originCountry == 'ES') {{ 'selected' }} @endif>Spain</option>
								<option value="SE" @if($group->originCountry == 'SE') {{ 'selected' }} @endif>Sweden</option>
								<option value="CH" @if($group->originCountry == 'CH') {{ 'selected' }} @endif>Switzerland</option>
								<option value="TW" @if($group->originCountry == 'TW') {{ 'selected' }} @endif>Taiwan, Province of China</option>
								<option value="TH" @if($group->originCountry == 'TH') {{ 'selected' }} @endif>Thailand</option>
								<option value="TR" @if($group->originCountry == 'TR') {{ 'selected' }} @endif>Turkey</option>
								<option value="UA" @if($group->originCountry == 'UA') {{ 'selected' }} @endif>Ukraine</option>
								<option value="AE" @if($group->originCountry == 'AE') {{ 'selected' }} @endif>United Arab Emirates</option>
								<option value="GB" @if($group->originCountry == 'GB') {{ 'selected' }} @endif>United Kingdom</option>
								<option value="US" @if($group->originCountry == 'US') {{ 'selected' }} @endif>United States</option>
								<option value="VN" @if($group->originCountry == 'VN') {{ 'selected' }} @endif>Viet Nam</option>
								<option value="OTHERS" @if($group->originCountry == 'OTHERS') {{ 'selected' }} @endif>Others</option>
							</select>
							<select name="target" class="form-control" required>
								<option value="">Target Market</option>
								<option value="Global" <?php if($group->target == 'Global') echo "selected"; ?>>Global</option>
								<option value="Africa" <?php if($group->target == 'Africa') echo "selected"; ?>>Africa</option>
								<option value="Asia" <?php if($group->target == 'Asia') echo "selected"; ?>>Asia</option>
								<option value="Europe" <?php if($group->target == 'Europe') echo "selected"; ?>>Europe</option>
								<option value="North America" <?php if($group->target == 'North America') echo "selected"; ?>>North America</option>
								<option value="Oceania" <?php if($group->target == 'Oceania') echo "selected"; ?>>Oceania</option>
								<option value="South America" <?php if($group->target == 'South America') echo "selected"; ?>>South America</option>
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
							<textarea name="description" maxlength="300" placeholder="{{ trans('brands.briefintroduction') }}" class="form-control" required>{!! strip_tags($group->description) !!}</textarea>
						</div>
						<p class="small">{{ trans('brands.pledge') }}</p>
						<input type="submit" class="btn btn-logo" value="{{ trans('brands.submit') }}">
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
										url: window.location.origin+"/brands/checkBrandname",
										data: "checkbrandname="+bname
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
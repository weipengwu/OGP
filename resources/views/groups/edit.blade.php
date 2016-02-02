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
							{{ trans('messages.inputerror') }}<br><br>
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
								<option value="">{{ trans('countries.origin') }}</option>
								<option value="AU" @if($group->originCountry == 'AU') {{ 'selected' }} @endif>{{ trans('countries.australia') }}</option>
								<option value="BR" @if($group->originCountry == 'BR') {{ 'selected' }} @endif>{{ trans('countries.brazil') }}</option>
								<option value="CA" @if($group->originCountry == 'CA') {{ 'selected' }} @endif>{{ trans('countries.canada') }}</option>
								<option value="CN" @if($group->originCountry == 'CN') {{ 'selected' }} @endif>{{ trans('countries.china') }}</option>
								<option value="CO" @if($group->originCountry == 'CO') {{ 'selected' }} @endif>{{ trans('countries.colombia') }}</option>
								<option value="CU" @if($group->originCountry == 'CU') {{ 'selected' }} @endif>{{ trans('countries.cuba') }}</option>
								<option value="DK" @if($group->originCountry == 'DK') {{ 'selected' }} @endif>{{ trans('countries.denmark') }}</option>
								<option value="EG" @if($group->originCountry == 'EG') {{ 'selected' }} @endif>{{ trans('countries.egypt') }}</option>
								<option value="FI" @if($group->originCountry == 'FI') {{ 'selected' }} @endif>{{ trans('countries.finland') }}</option>
								<option value="FR" @if($group->originCountry == 'FR') {{ 'selected' }} @endif>{{ trans('countries.france') }}</option>
								<option value="DE" @if($group->originCountry == 'DE') {{ 'selected' }} @endif>{{ trans('countries.germany') }}</option>
								<option value="GR" @if($group->originCountry == 'GR') {{ 'selected' }} @endif>{{ trans('countries.greece') }}</option>
								<option value="HU" @if($group->originCountry == 'HU') {{ 'selected' }} @endif>{{ trans('countries.hungary') }}</option>
								<option value="IS" @if($group->originCountry == 'IS') {{ 'selected' }} @endif>{{ trans('countries.iceland') }}</option>
								<option value="IN" @if($group->originCountry == 'IN') {{ 'selected' }} @endif>{{ trans('countries.india') }}</option>
								<option value="ID" @if($group->originCountry == 'ID') {{ 'selected' }} @endif>{{ trans('countries.indonesia') }}</option>
								<option value="IR" @if($group->originCountry == 'IR') {{ 'selected' }} @endif>{{ trans('countries.iran') }}</option>
								<option value="IE" @if($group->originCountry == 'IE') {{ 'selected' }} @endif>{{ trans('countries.ireland') }}</option>
								<option value="IT" @if($group->originCountry == 'IT') {{ 'selected' }} @endif>{{ trans('countries.italy') }}</option>
								<option value="JP" @if($group->originCountry == 'JP') {{ 'selected' }} @endif>{{ trans('countries.japan') }}</option>
								<option value="KR" @if($group->originCountry == 'KR') {{ 'selected' }} @endif>{{ trans('countries.korea') }}</option>
								<option value="MY" @if($group->originCountry == 'MY') {{ 'selected' }} @endif>{{ trans('countries.malaysia') }}</option>
								<option value="MX" @if($group->originCountry == 'MX') {{ 'selected' }} @endif>{{ trans('countries.mexico') }}</option>
								<option value="MN" @if($group->originCountry == 'MN') {{ 'selected' }} @endif>{{ trans('countries.mongolia') }}</option>
								<option value="NL" @if($group->originCountry == 'NL') {{ 'selected' }} @endif>{{ trans('countries.netherlands') }}</option>
								<option value="NZ" @if($group->originCountry == 'NZ') {{ 'selected' }} @endif>{{ trans('countries.newzealand') }}</option>
								<option value="NO" @if($group->originCountry == 'NO') {{ 'selected' }} @endif>{{ trans('countries.norway') }}</option>
								<option value="PH" @if($group->originCountry == 'PH') {{ 'selected' }} @endif>{{ trans('countries.philippines') }}</option>
								<option value="PL" @if($group->originCountry == 'PL') {{ 'selected' }} @endif>{{ trans('countries.poland') }}</option>
								<option value="PT" @if($group->originCountry == 'PT') {{ 'selected' }} @endif>{{ trans('countries.portugal') }}</option>
								<option value="RU" @if($group->originCountry == 'RU') {{ 'selected' }} @endif>{{ trans('countries.russian') }}</option>
								<option value="SA" @if($group->originCountry == 'SA') {{ 'selected' }} @endif>{{ trans('countries.saudiarabia') }}</option>
								<option value="SG" @if($group->originCountry == 'SG') {{ 'selected' }} @endif>{{ trans('countries.singapore') }}</option>
								<option value="ZA" @if($group->originCountry == 'ZA') {{ 'selected' }} @endif>{{ trans('countries.southafrica') }}</option>
								<option value="ES" @if($group->originCountry == 'ES') {{ 'selected' }} @endif>{{ trans('countries.spain') }}</option>
								<option value="SE" @if($group->originCountry == 'SE') {{ 'selected' }} @endif>{{ trans('countries.sweden') }}</option>
								<option value="CH" @if($group->originCountry == 'CH') {{ 'selected' }} @endif>{{ trans('countries.switzerland') }}</option>
								<option value="TW" @if($group->originCountry == 'TW') {{ 'selected' }} @endif>{{ trans('countries.taiwan') }}</option>
								<option value="TH" @if($group->originCountry == 'TH') {{ 'selected' }} @endif>{{ trans('countries.thailand') }}</option>
								<option value="TR" @if($group->originCountry == 'TR') {{ 'selected' }} @endif>{{ trans('countries.turkey') }}</option>
								<option value="UA" @if($group->originCountry == 'UA') {{ 'selected' }} @endif>{{ trans('countries.ukraine') }}</option>
								<option value="AE" @if($group->originCountry == 'AE') {{ 'selected' }} @endif>{{ trans('countries.unitedarabemirates') }}</option>
								<option value="GB" @if($group->originCountry == 'GB') {{ 'selected' }} @endif>{{ trans('countries.unitedkingdom') }}</option>
								<option value="US" @if($group->originCountry == 'US') {{ 'selected' }} @endif>{{ trans('countries.unitedstates') }}</option>
								<option value="VN" @if($group->originCountry == 'VN') {{ 'selected' }} @endif>{{ trans('countries.vietnam') }}</option>
								<option value="OTHERS" @if($group->originCountry == 'OTHERS') {{ 'selected' }} @endif>{{ trans('countries.others') }}</option>
							</select>
							<select name="target" class="form-control" required>
								<option value="">{{ trans('countries.targetmarket') }}</option>
								<option value="Global" <?php if($group->target == 'Global') echo "selected"; ?>>{{ trans('countries.global') }}</option>
								<option value="Africa" <?php if($group->target == 'Africa') echo "selected"; ?>>{{ trans('countries.africa') }}</option>
								<option value="Asia" <?php if($group->target == 'Asia') echo "selected"; ?>>{{ trans('countries.asia') }}</option>
								<option value="Europe" <?php if($group->target == 'Europe') echo "selected"; ?>>{{ trans('countries.europe') }}</option>
								<option value="North America" <?php if($group->target == 'North America') echo "selected"; ?>>{{ trans('countries.northamerica') }}</option>
								<option value="Oceania" <?php if($group->target == 'Oceania') echo "selected"; ?>>{{ trans('countries.oceania') }}</option>
								<option value="South America" <?php if($group->target == 'South America') echo "selected"; ?>>{{ trans('countries.southamerica') }}</option>
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
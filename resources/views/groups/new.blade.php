@extends('layouts.master')

@section('content')
<div class="container">
	<div class="row">
		<div class="fixedarea">
			<div class="panel">
				<div class="panel-heading"><h3>{{ trans('brands.createyourbrand') }}</h3></div>

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
					<form action="{{ URL::route('createGroup') }}" method="post" enctype="multipart/form-data" id="createBrand">
						<input type="hidden" name="_token" value="{{ csrf_token() }}">
						<input type="hidden" name="creator" value="{{ Auth::user()->id }}">
						<input type="hidden" name="owner" value="{{ Auth::user()->id }}">
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
							<input type="text" name="name" class="form-control" id="brandname" placeholder="{{ trans('brands.brandname') }}" maxlength="100" required>
							<div class="checknamepass checkname"><i class="fa fa-check"></i></div>
							<div class="checknamefail checkname"><i class="fa fa-times"></i></div>
							<div class="help-block checknameerror">{{ trans('messages.uniquebrandname') }}</div>
						</div>
						<div class="form-group">
							<select name="category" class="form-control" required>
								<option value="">{{ trans('brands.selectcategory') }}</option>
								<option value="Arts & Design">{{ trans('brands.artsdesign') }}</option>
								<option value="Autos">{{ trans('brands.autos') }}</option>
								<option value="Business">{{ trans('brands.business') }}</option>
								<option value="Education">{{ trans('brands.education') }}</option>
								<option value="Fashion">{{ trans('brands.fashion') }}</option>
								<option value="Food & Drink">{{ trans('brands.fooddrink') }}</option>
								<option value="Gaming">{{ trans('brands.gaming') }}</option>
								<option value="Health">{{ trans('brands.health') }}</option>
								<option value="Home">{{ trans('brands.home') }}</option>
								<option value="Music & Performance">{{ trans('brands.musicperformances') }}</option>
								<option value="Sports">{{ trans('brands.sports') }}</option>
								<option value="Technology & Science">{{ trans('brands.technologyscience') }}</option>
								<option value="Travel">{{ trans('brands.travel') }}</option>
								<option value="Other">{{ trans('brands.other') }}</option>
							</select>
						</div>
						<div class="form-group">
							<input type="text" name="tag" class="form-control" placeholder="{{ trans('brands.tag') }}">
						</div>
						<div class="form-group">
							<div class="input-group">
								<div class="input-group-addon">http://</div>
								<input type="text" name="website" class="form-control" placeholder="{{ trans('brands.website') }}">
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
								<option value="AU">Australia</option>
								<option value="BR">Brazil</option>
								<option value="CA">Canada</option>
								<option value="CN">China</option>
								<option value="CO">Colombia</option>
								<option value="CU">Cuba</option>
								<option value="DK">Denmark</option>
								<option value="EG">Egypt</option>
								<option value="FI">Finland</option>
								<option value="FR">France</option>
								<option value="DE">Germany</option>
								<option value="GR">Greece</option>
								<option value="HU">Hungary</option>
								<option value="IS">Iceland</option>
								<option value="IN">India</option>
								<option value="ID">Indonesia</option>
								<option value="IR">Iran, Islamic Republic of</option>
								<option value="IE">Ireland</option>
								<option value="IT">Italy</option>
								<option value="JP">Japan</option>
								<option value="KR">Korea, Republic of</option>
								<option value="MY">Malaysia</option>
								<option value="MX">Mexico</option>
								<option value="MN">Mongolia</option>
								<option value="NL">Netherlands</option>
								<option value="NZ">New Zealand</option>
								<option value="NO">Norway</option>
								<option value="PH">Philippines</option>
								<option value="PL">Poland</option>
								<option value="PT">Portugal</option>
								<option value="RU">Russian Federation</option>
								<option value="SA">Saudi Arabia</option>
								<option value="SG">Singapore</option>
								<option value="ZA">South Africa</option>
								<option value="ES">Spain</option>
								<option value="SE">Sweden</option>
								<option value="CH">Switzerland</option>
								<option value="TW">Taiwan, Province of China</option>
								<option value="TH">Thailand</option>
								<option value="TR">Turkey</option>
								<option value="UA">Ukraine</option>
								<option value="AE">United Arab Emirates</option>
								<option value="GB">United Kingdom</option>
								<option value="US">United States</option>
								<option value="VN">Viet Nam</option>
								<option value="OTHERS">Others</option>
							</select>
							<select name="target" class="form-control" required>
								<option value="">Target Market</option>
								<option value="Global">Global</option>
								<option value="Africa">Africa</option>
								<option value="Asia">Asia</option>
								<option value="Europe">Europe</option>
								<option value="North America">North America</option>
								<option value="Oceania">Oceania</option>
								<option value="South America">South America</option>
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
							<textarea name="description" maxlength="300" class="form-control" placeholder="{{ trans('brands.briefintroduction') }}" required></textarea>
						</div>
						<p class="small">{{ trans('brands.pledge') }}</p>
						<input type="submit" class="btn btn-logo submit" value="{{ trans('brands.submit') }}">
					</form>
				</div>
			</div>
		</div>
	</div>
</div>

@endsection
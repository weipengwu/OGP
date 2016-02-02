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
							{{ trans('messages.inputerror') }}<br><br>
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
								<option value="">{{ trans('countries.origin') }}</option>
								<option value="AU">{{ trans('countries.australia') }}</option>
								<option value="BR">{{ trans('countries.brazil') }}</option>
								<option value="CA">{{ trans('countries.canada') }}</option>
								<option value="CN">{{ trans('countries.china') }}</option>
								<option value="CO">{{ trans('countries.colombia') }}</option>
								<option value="CU">{{ trans('countries.cuba') }}</option>
								<option value="DK">{{ trans('countries.denmark') }}</option>
								<option value="EG">{{ trans('countries.egypt') }}</option>
								<option value="FI">{{ trans('countries.finland') }}</option>
								<option value="FR">{{ trans('countries.france') }}</option>
								<option value="DE">{{ trans('countries.germany') }}</option>
								<option value="GR">{{ trans('countries.greece') }}</option>
								<option value="HU">{{ trans('countries.hungary') }}</option>
								<option value="IS">{{ trans('countries.iceland') }}</option>
								<option value="IN">{{ trans('countries.india') }}</option>
								<option value="ID">{{ trans('countries.indonesia') }}</option>
								<option value="IR">{{ trans('countries.iran') }}</option>
								<option value="IE">{{ trans('countries.ireland') }}</option>
								<option value="IT">{{ trans('countries.italy') }}</option>
								<option value="JP">{{ trans('countries.japan') }}</option>
								<option value="KR">{{ trans('countries.korea') }}</option>
								<option value="MY">{{ trans('countries.malaysia') }}</option>
								<option value="MX">{{ trans('countries.mexico') }}</option>
								<option value="MN">{{ trans('countries.mongolia') }}</option>
								<option value="NL">{{ trans('countries.netherlands') }}</option>
								<option value="NZ">{{ trans('countries.newzealand') }}</option>
								<option value="NO">{{ trans('countries.norway') }}</option>
								<option value="PH">{{ trans('countries.philippines') }}</option>
								<option value="PL">{{ trans('countries.poland') }}</option>
								<option value="PT">{{ trans('countries.portugal') }}</option>
								<option value="RU">{{ trans('countries.russian') }}</option>
								<option value="SA">{{ trans('countries.saudiarabia') }}</option>
								<option value="SG">{{ trans('countries.singapore') }}</option>
								<option value="ZA">{{ trans('countries.southafrica') }}</option>
								<option value="ES">{{ trans('countries.spain') }}</option>
								<option value="SE">{{ trans('countries.sweden') }}</option>
								<option value="CH">{{ trans('countries.switzerland') }}</option>
								<option value="TW">{{ trans('countries.taiwan') }}</option>
								<option value="TH">{{ trans('countries.thailand') }}</option>
								<option value="TR">{{ trans('countries.turkey') }}</option>
								<option value="UA">{{ trans('countries.ukraine') }}</option>
								<option value="AE">{{ trans('countries.unitedarabemirates') }}</option>
								<option value="GB">{{ trans('countries.unitedkingdom') }}</option>
								<option value="US">{{ trans('countries.unitedstates') }}</option>
								<option value="VN">{{ trans('countries.vietnam') }}</option>
								<option value="OTHERS">{{ trans('countries.others') }}</option>
							</select>
							<select name="target" class="form-control" required>
								<option value="">{{ trans('countries.targetmarket') }}</option>
								<option value="Global">{{ trans('countries.global') }}</option>
								<option value="Africa">{{ trans('countries.africa') }}</option>
								<option value="Asia">{{ trans('countries.asia') }}</option>
								<option value="Europe">{{ trans('countries.europe') }}</option>
								<option value="North America">{{ trans('countries.northamerica') }}</option>
								<option value="Oceania">{{ trans('countries.oceania') }}</option>
								<option value="South America">{{ trans('countries.southamerica') }}</option>
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
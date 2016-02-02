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
								<option value="">{{ trans('countires.origin') }}</option>
								<option value="AU">{{ trans('countires.australia') }}</option>
								<option value="BR">{{ trans('countires.brazil') }}</option>
								<option value="CA">{{ trans('countires.canada') }}</option>
								<option value="CN">{{ trans('countires.china') }}</option>
								<option value="CO">{{ trans('countires.colombia') }}</option>
								<option value="CU">{{ trans('countires.cuba') }}</option>
								<option value="DK">{{ trans('countires.denmark') }}</option>
								<option value="EG">{{ trans('countires.egypt') }}</option>
								<option value="FI">{{ trans('countires.finland') }}</option>
								<option value="FR">{{ trans('countires.france') }}</option>
								<option value="DE">{{ trans('countires.germany') }}</option>
								<option value="GR">{{ trans('countires.greece') }}</option>
								<option value="HU">{{ trans('countires.hungary') }}</option>
								<option value="IS">{{ trans('countires.iceland') }}</option>
								<option value="IN">{{ trans('countires.india') }}</option>
								<option value="ID">{{ trans('countires.indonesia') }}</option>
								<option value="IR">{{ trans('countires.iran') }}</option>
								<option value="IE">{{ trans('countires.ireland') }}</option>
								<option value="IT">{{ trans('countires.italy') }}</option>
								<option value="JP">{{ trans('countires.japan') }}</option>
								<option value="KR">{{ trans('countires.korea') }}</option>
								<option value="MY">{{ trans('countires.malaysia') }}</option>
								<option value="MX">{{ trans('countires.mexico') }}</option>
								<option value="MN">{{ trans('countires.mongolia') }}</option>
								<option value="NL">{{ trans('countires.netherlands') }}</option>
								<option value="NZ">{{ trans('countires.newzealand') }}</option>
								<option value="NO">{{ trans('countires.norway') }}</option>
								<option value="PH">{{ trans('countires.philippines') }}</option>
								<option value="PL">{{ trans('countires.poland') }}</option>
								<option value="PT">{{ trans('countires.portugal') }}</option>
								<option value="RU">{{ trans('countires.russian') }}</option>
								<option value="SA">{{ trans('countires.saudiarabia') }}</option>
								<option value="SG">{{ trans('countires.singapore') }}</option>
								<option value="ZA">{{ trans('countires.southafrica') }}</option>
								<option value="ES">{{ trans('countires.spain') }}</option>
								<option value="SE">{{ trans('countires.sweden') }}</option>
								<option value="CH">{{ trans('countires.switzerland') }}</option>
								<option value="TW">{{ trans('countires.taiwan') }}</option>
								<option value="TH">{{ trans('countires.thailand') }}</option>
								<option value="TR">{{ trans('countires.turkey') }}</option>
								<option value="UA">{{ trans('countires.ukraine') }}</option>
								<option value="AE">{{ trans('countires.unitedarabemirates') }}</option>
								<option value="GB">{{ trans('countires.unitedkingdom') }}</option>
								<option value="US">{{ trans('countires.unitedstates') }}</option>
								<option value="VN">{{ trans('countires.vietnam') }}</option>
								<option value="OTHERS">{{ trans('countires.others') }}</option>
							</select>
							<select name="target" class="form-control" required>
								<option value="">{{ trans('countires.targetmarket') }}</option>
								<option value="Global">{{ trans('countires.global') }}</option>
								<option value="Africa">{{ trans('countires.africa') }}</option>
								<option value="Asia">{{ trans('countires.asia') }}</option>
								<option value="Europe">{{ trans('countires.europe') }}</option>
								<option value="North America">{{ trans('countires.northamerica') }}</option>
								<option value="Oceania">{{ trans('countires.oceania') }}</option>
								<option value="South America">{{ trans('countires.southamerica') }}</option>
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
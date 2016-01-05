@extends('layouts.master')

@section('content')
<div class="container">
	<div class="row">
		<div class="fixedarea">
			<div class="panel">
				<div class="panel-heading"><h3>CREATE YOUR BRAND</h3></div>

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
						<h4>UPLOAD IMAGES FOR YOUR BRAND</h4>
						<hr>
						<div class="form-group">
							<label>Upload Your Brand Logo</label>
							<p>Recomended size: 400px X 400px. Images must be in .jpg, .bmp, .png, or .gif format, and not exceed 4 MB.</p>
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
							<input type="text" name="name" class="form-control" id="brandname" placeholder="Brand Name" maxlength="50" required>
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
								<option value="AF">Afghanistan</option>
								<option value="AX">Åland Islands</option>
								<option value="AL">Albania</option>
								<option value="DZ">Algeria</option>
								<option value="AS">American Samoa</option>
								<option value="AD">Andorra</option>
								<option value="AO">Angola</option>
								<option value="AI">Anguilla</option>
								<option value="AQ">Antarctica</option>
								<option value="AG">Antigua and Barbuda</option>
								<option value="AR">Argentina</option>
								<option value="AM">Armenia</option>
								<option value="AW">Aruba</option>
								<option value="AU">Australia</option>
								<option value="AT">Austria</option>
								<option value="AZ">Azerbaijan</option>
								<option value="BS">Bahamas</option>
								<option value="BH">Bahrain</option>
								<option value="BD">Bangladesh</option>
								<option value="BB">Barbados</option>
								<option value="BY">Belarus</option>
								<option value="BE">Belgium</option>
								<option value="BZ">Belize</option>
								<option value="BJ">Benin</option>
								<option value="BM">Bermuda</option>
								<option value="BT">Bhutan</option>
								<option value="BO">Bolivia, Plurinational State of</option>
								<option value="BQ">Bonaire, Sint Eustatius and Saba</option>
								<option value="BA">Bosnia and Herzegovina</option>
								<option value="BW">Botswana</option>
								<option value="BV">Bouvet Island</option>
								<option value="BR">Brazil</option>
								<option value="IO">British Indian Ocean Territory</option>
								<option value="BN">Brunei Darussalam</option>
								<option value="BG">Bulgaria</option>
								<option value="BF">Burkina Faso</option>
								<option value="BI">Burundi</option>
								<option value="KH">Cambodia</option>
								<option value="CM">Cameroon</option>
								<option value="CA">Canada</option>
								<option value="CV">Cape Verde</option>
								<option value="KY">Cayman Islands</option>
								<option value="CF">Central African Republic</option>
								<option value="TD">Chad</option>
								<option value="CL">Chile</option>
								<option value="CN">China</option>
								<option value="CX">Christmas Island</option>
								<option value="CC">Cocos (Keeling) Islands</option>
								<option value="CO">Colombia</option>
								<option value="KM">Comoros</option>
								<option value="CG">Congo</option>
								<option value="CD">Congo, the Democratic Republic of the</option>
								<option value="CK">Cook Islands</option>
								<option value="CR">Costa Rica</option>
								<option value="CI">Côte d'Ivoire</option>
								<option value="HR">Croatia</option>
								<option value="CU">Cuba</option>
								<option value="CW">Curaçao</option>
								<option value="CY">Cyprus</option>
								<option value="CZ">Czech Republic</option>
								<option value="DK">Denmark</option>
								<option value="DJ">Djibouti</option>
								<option value="DM">Dominica</option>
								<option value="DO">Dominican Republic</option>
								<option value="EC">Ecuador</option>
								<option value="EG">Egypt</option>
								<option value="SV">El Salvador</option>
								<option value="GQ">Equatorial Guinea</option>
								<option value="ER">Eritrea</option>
								<option value="EE">Estonia</option>
								<option value="ET">Ethiopia</option>
								<option value="FK">Falkland Islands (Malvinas)</option>
								<option value="FO">Faroe Islands</option>
								<option value="FJ">Fiji</option>
								<option value="FI">Finland</option>
								<option value="FR">France</option>
								<option value="GF">French Guiana</option>
								<option value="PF">French Polynesia</option>
								<option value="TF">French Southern Territories</option>
								<option value="GA">Gabon</option>
								<option value="GM">Gambia</option>
								<option value="GE">Georgia</option>
								<option value="DE">Germany</option>
								<option value="GH">Ghana</option>
								<option value="GI">Gibraltar</option>
								<option value="GR">Greece</option>
								<option value="GL">Greenland</option>
								<option value="GD">Grenada</option>
								<option value="GP">Guadeloupe</option>
								<option value="GU">Guam</option>
								<option value="GT">Guatemala</option>
								<option value="GG">Guernsey</option>
								<option value="GN">Guinea</option>
								<option value="GW">Guinea-Bissau</option>
								<option value="GY">Guyana</option>
								<option value="HT">Haiti</option>
								<option value="HM">Heard Island and McDonald Islands</option>
								<option value="VA">Holy See (Vatican City State)</option>
								<option value="HN">Honduras</option>
								<option value="HK">Hong Kong</option>
								<option value="HU">Hungary</option>
								<option value="IS">Iceland</option>
								<option value="IN">India</option>
								<option value="ID">Indonesia</option>
								<option value="IR">Iran, Islamic Republic of</option>
								<option value="IQ">Iraq</option>
								<option value="IE">Ireland</option>
								<option value="IM">Isle of Man</option>
								<option value="IL">Israel</option>
								<option value="IT">Italy</option>
								<option value="JM">Jamaica</option>
								<option value="JP">Japan</option>
								<option value="JE">Jersey</option>
								<option value="JO">Jordan</option>
								<option value="KZ">Kazakhstan</option>
								<option value="KE">Kenya</option>
								<option value="KI">Kiribati</option>
								<option value="KP">Korea, Democratic People's Republic of</option>
								<option value="KR">Korea, Republic of</option>
								<option value="KW">Kuwait</option>
								<option value="KG">Kyrgyzstan</option>
								<option value="LA">Lao People's Democratic Republic</option>
								<option value="LV">Latvia</option>
								<option value="LB">Lebanon</option>
								<option value="LS">Lesotho</option>
								<option value="LR">Liberia</option>
								<option value="LY">Libya</option>
								<option value="LI">Liechtenstein</option>
								<option value="LT">Lithuania</option>
								<option value="LU">Luxembourg</option>
								<option value="MO">Macao</option>
								<option value="MK">Macedonia, the former Yugoslav Republic of</option>
								<option value="MG">Madagascar</option>
								<option value="MW">Malawi</option>
								<option value="MY">Malaysia</option>
								<option value="MV">Maldives</option>
								<option value="ML">Mali</option>
								<option value="MT">Malta</option>
								<option value="MH">Marshall Islands</option>
								<option value="MQ">Martinique</option>
								<option value="MR">Mauritania</option>
								<option value="MU">Mauritius</option>
								<option value="YT">Mayotte</option>
								<option value="MX">Mexico</option>
								<option value="FM">Micronesia, Federated States of</option>
								<option value="MD">Moldova, Republic of</option>
								<option value="MC">Monaco</option>
								<option value="MN">Mongolia</option>
								<option value="ME">Montenegro</option>
								<option value="MS">Montserrat</option>
								<option value="MA">Morocco</option>
								<option value="MZ">Mozambique</option>
								<option value="MM">Myanmar</option>
								<option value="NA">Namibia</option>
								<option value="NR">Nauru</option>
								<option value="NP">Nepal</option>
								<option value="NL">Netherlands</option>
								<option value="NC">New Caledonia</option>
								<option value="NZ">New Zealand</option>
								<option value="NI">Nicaragua</option>
								<option value="NE">Niger</option>
								<option value="NG">Nigeria</option>
								<option value="NU">Niue</option>
								<option value="NF">Norfolk Island</option>
								<option value="MP">Northern Mariana Islands</option>
								<option value="NO">Norway</option>
								<option value="OM">Oman</option>
								<option value="PK">Pakistan</option>
								<option value="PW">Palau</option>
								<option value="PS">Palestinian Territory, Occupied</option>
								<option value="PA">Panama</option>
								<option value="PG">Papua New Guinea</option>
								<option value="PY">Paraguay</option>
								<option value="PE">Peru</option>
								<option value="PH">Philippines</option>
								<option value="PN">Pitcairn</option>
								<option value="PL">Poland</option>
								<option value="PT">Portugal</option>
								<option value="PR">Puerto Rico</option>
								<option value="QA">Qatar</option>
								<option value="RE">Réunion</option>
								<option value="RO">Romania</option>
								<option value="RU">Russian Federation</option>
								<option value="RW">Rwanda</option>
								<option value="BL">Saint Barthélemy</option>
								<option value="SH">Saint Helena, Ascension and Tristan da Cunha</option>
								<option value="KN">Saint Kitts and Nevis</option>
								<option value="LC">Saint Lucia</option>
								<option value="MF">Saint Martin (French part)</option>
								<option value="PM">Saint Pierre and Miquelon</option>
								<option value="VC">Saint Vincent and the Grenadines</option>
								<option value="WS">Samoa</option>
								<option value="SM">San Marino</option>
								<option value="ST">Sao Tome and Principe</option>
								<option value="SA">Saudi Arabia</option>
								<option value="SN">Senegal</option>
								<option value="RS">Serbia</option>
								<option value="SC">Seychelles</option>
								<option value="SL">Sierra Leone</option>
								<option value="SG">Singapore</option>
								<option value="SX">Sint Maarten (Dutch part)</option>
								<option value="SK">Slovakia</option>
								<option value="SI">Slovenia</option>
								<option value="SB">Solomon Islands</option>
								<option value="SO">Somalia</option>
								<option value="ZA">South Africa</option>
								<option value="GS">South Georgia and the South Sandwich Islands</option>
								<option value="SS">South Sudan</option>
								<option value="ES">Spain</option>
								<option value="LK">Sri Lanka</option>
								<option value="SD">Sudan</option>
								<option value="SR">Suriname</option>
								<option value="SJ">Svalbard and Jan Mayen</option>
								<option value="SZ">Swaziland</option>
								<option value="SE">Sweden</option>
								<option value="CH">Switzerland</option>
								<option value="SY">Syrian Arab Republic</option>
								<option value="TW">Taiwan, Province of China</option>
								<option value="TJ">Tajikistan</option>
								<option value="TZ">Tanzania, United Republic of</option>
								<option value="TH">Thailand</option>
								<option value="TL">Timor-Leste</option>
								<option value="TG">Togo</option>
								<option value="TK">Tokelau</option>
								<option value="TO">Tonga</option>
								<option value="TT">Trinidad and Tobago</option>
								<option value="TN">Tunisia</option>
								<option value="TR">Turkey</option>
								<option value="TM">Turkmenistan</option>
								<option value="TC">Turks and Caicos Islands</option>
								<option value="TV">Tuvalu</option>
								<option value="UG">Uganda</option>
								<option value="UA">Ukraine</option>
								<option value="AE">United Arab Emirates</option>
								<option value="GB">United Kingdom</option>
								<option value="US">United States</option>
								<option value="UM">United States Minor Outlying Islands</option>
								<option value="UY">Uruguay</option>
								<option value="UZ">Uzbekistan</option>
								<option value="VU">Vanuatu</option>
								<option value="VE">Venezuela, Bolivarian Republic of</option>
								<option value="VN">Viet Nam</option>
								<option value="VG">Virgin Islands, British</option>
								<option value="VI">Virgin Islands, U.S.</option>
								<option value="WF">Wallis and Futuna</option>
								<option value="EH">Western Sahara</option>
								<option value="YE">Yemen</option>
								<option value="ZM">Zambia</option>
								<option value="ZW">Zimbabwe</option>
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
							<textarea name="description" maxlength="300" class="form-control" placeholder="Brief Introduction ( Tips: Please use the official language at the target markets.)" required></textarea>
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
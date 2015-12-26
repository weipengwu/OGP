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
							<p>Recomended size: 200px X 200px. Images must be in .jpg, .bmp, .png, or .gif format, and not exceed 4 MB.</p>
							<input type="file" id="g-profile" name="g-profile" accept="image/*">
						</div>
						<div class="form-group">
							<label>Upload Your New Brand Banner Image</label>
							<p>Recomended size: 1500px X 500px. Images must be in .jpg, .bmp, .png, or .gif format, and not exceed 4 MB.</p>
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
								<option value="Music & Performance" <?php if($group->category == 'Music & Performance') echo "selected"; ?>>Music & Performance</option>
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
								<option value="AF" @if($group->originCountry == 'AF') {{ 'selected' }} @endif>Afghanistan</option>
								<option value="AX" @if($group->originCountry == 'AX') {{ 'selected' }} @endif>Åland Islands</option>
								<option value="AL" @if($group->originCountry == 'AL') {{ 'selected' }} @endif>Albania</option>
								<option value="DZ" @if($group->originCountry == 'DZ') {{ 'selected' }} @endif>Algeria</option>
								<option value="AS" @if($group->originCountry == 'AS') {{ 'selected' }} @endif>American Samoa</option>
								<option value="AD" @if($group->originCountry == 'AD') {{ 'selected' }} @endif>Andorra</option>
								<option value="AO" @if($group->originCountry == 'AO') {{ 'selected' }} @endif>Angola</option>
								<option value="AI" @if($group->originCountry == 'AI') {{ 'selected' }} @endif>Anguilla</option>
								<option value="AQ" @if($group->originCountry == 'AQ') {{ 'selected' }} @endif>Antarctica</option>
								<option value="AG" @if($group->originCountry == 'AG') {{ 'selected' }} @endif>Antigua and Barbuda</option>
								<option value="AR" @if($group->originCountry == 'AQ') {{ 'selected' }} @endif>Argentina</option>
								<option value="AM" @if($group->originCountry == 'AR') {{ 'selected' }} @endif>Armenia</option>
								<option value="AW" @if($group->originCountry == 'AW') {{ 'selected' }} @endif>Aruba</option>
								<option value="AU" @if($group->originCountry == 'AU') {{ 'selected' }} @endif>Australia</option>
								<option value="AT" @if($group->originCountry == 'AT') {{ 'selected' }} @endif>Austria</option>
								<option value="AZ" @if($group->originCountry == 'AZ') {{ 'selected' }} @endif>Azerbaijan</option>
								<option value="BS" @if($group->originCountry == 'BS') {{ 'selected' }} @endif>Bahamas</option>
								<option value="BH" @if($group->originCountry == 'BH') {{ 'selected' }} @endif>Bahrain</option>
								<option value="BD" @if($group->originCountry == 'BD') {{ 'selected' }} @endif>Bangladesh</option>
								<option value="BB" @if($group->originCountry == 'BB') {{ 'selected' }} @endif>Barbados</option>
								<option value="BY" @if($group->originCountry == 'BY') {{ 'selected' }} @endif>Belarus</option>
								<option value="BE" @if($group->originCountry == 'BE') {{ 'selected' }} @endif>Belgium</option>
								<option value="BZ" @if($group->originCountry == 'BZ') {{ 'selected' }} @endif>Belize</option>
								<option value="BJ" @if($group->originCountry == 'BJ') {{ 'selected' }} @endif>Benin</option>
								<option value="BM" @if($group->originCountry == 'BM') {{ 'selected' }} @endif>Bermuda</option>
								<option value="BT" @if($group->originCountry == 'BT') {{ 'selected' }} @endif>Bhutan</option>
								<option value="BO" @if($group->originCountry == 'BO') {{ 'selected' }} @endif>Bolivia, Plurinational State of</option>
								<option value="BQ" @if($group->originCountry == 'BQ') {{ 'selected' }} @endif>Bonaire, Sint Eustatius and Saba</option>
								<option value="BA" @if($group->originCountry == 'BA') {{ 'selected' }} @endif>Bosnia and Herzegovina</option>
								<option value="BW" @if($group->originCountry == 'BW') {{ 'selected' }} @endif>Botswana</option>
								<option value="BV" @if($group->originCountry == 'BV') {{ 'selected' }} @endif>Bouvet Island</option>
								<option value="BR" @if($group->originCountry == 'BR') {{ 'selected' }} @endif>Brazil</option>
								<option value="IO" @if($group->originCountry == 'IO') {{ 'selected' }} @endif>British Indian Ocean Territory</option>
								<option value="BN" @if($group->originCountry == 'BN') {{ 'selected' }} @endif>Brunei Darussalam</option>
								<option value="BG" @if($group->originCountry == 'BG') {{ 'selected' }} @endif>Bulgaria</option>
								<option value="BF" @if($group->originCountry == 'BF') {{ 'selected' }} @endif>Burkina Faso</option>
								<option value="BI" @if($group->originCountry == 'BI') {{ 'selected' }} @endif>Burundi</option>
								<option value="KH" @if($group->originCountry == 'KH') {{ 'selected' }} @endif>Cambodia</option>
								<option value="CM" @if($group->originCountry == 'CM') {{ 'selected' }} @endif>Cameroon</option>
								<option value="CA" @if($group->originCountry == 'CA') {{ 'selected' }} @endif>Canada</option>
								<option value="CV" @if($group->originCountry == 'CV') {{ 'selected' }} @endif>Cape Verde</option>
								<option value="KY" @if($group->originCountry == 'KY') {{ 'selected' }} @endif>Cayman Islands</option>
								<option value="CF" @if($group->originCountry == 'CF') {{ 'selected' }} @endif>Central African Republic</option>
								<option value="TD" @if($group->originCountry == 'TD') {{ 'selected' }} @endif>Chad</option>
								<option value="CL" @if($group->originCountry == 'CL') {{ 'selected' }} @endif>Chile</option>
								<option value="CN" @if($group->originCountry == 'CN') {{ 'selected' }} @endif>China</option>
								<option value="CX" @if($group->originCountry == 'CX') {{ 'selected' }} @endif>Christmas Island</option>
								<option value="CC" @if($group->originCountry == 'CC') {{ 'selected' }} @endif>Cocos (Keeling) Islands</option>
								<option value="CO" @if($group->originCountry == 'CO') {{ 'selected' }} @endif>Colombia</option>
								<option value="KM" @if($group->originCountry == 'KM') {{ 'selected' }} @endif>Comoros</option>
								<option value="CG" @if($group->originCountry == 'CG') {{ 'selected' }} @endif>Congo</option>
								<option value="CD" @if($group->originCountry == 'CD') {{ 'selected' }} @endif>Congo, the Democratic Republic of the</option>
								<option value="CK" @if($group->originCountry == 'CK') {{ 'selected' }} @endif>Cook Islands</option>
								<option value="CR" @if($group->originCountry == 'CR') {{ 'selected' }} @endif>Costa Rica</option>
								<option value="CI" @if($group->originCountry == 'CI') {{ 'selected' }} @endif>Côte d'Ivoire</option>
								<option value="HR" @if($group->originCountry == 'HR') {{ 'selected' }} @endif>Croatia</option>
								<option value="CU" @if($group->originCountry == 'CU') {{ 'selected' }} @endif>Cuba</option>
								<option value="CW" @if($group->originCountry == 'CW') {{ 'selected' }} @endif>Curaçao</option>
								<option value="CY" @if($group->originCountry == 'CY') {{ 'selected' }} @endif>Cyprus</option>
								<option value="CZ" @if($group->originCountry == 'CZ') {{ 'selected' }} @endif>Czech Republic</option>
								<option value="DK" @if($group->originCountry == 'DK') {{ 'selected' }} @endif>Cyprus>Denmark</option>
								<option value="DJ" @if($group->originCountry == 'DJ') {{ 'selected' }} @endif>Cyprus>Djibouti</option>
								<option value="DM" @if($group->originCountry == 'DM') {{ 'selected' }} @endif>Cyprus>Dominica</option>
								<option value="DO" @if($group->originCountry == 'DO') {{ 'selected' }} @endif>Cyprus>Dominican Republic</option>
								<option value="EC" @if($group->originCountry == 'EC') {{ 'selected' }} @endif>Cyprus>Ecuador</option>
								<option value="EG" @if($group->originCountry == 'EG') {{ 'selected' }} @endif>Cyprus>Egypt</option>
								<option value="SV" @if($group->originCountry == 'SV') {{ 'selected' }} @endif>Cyprus>El Salvador</option>
								<option value="GQ" @if($group->originCountry == 'GQ') {{ 'selected' }} @endif>Cyprus>Equatorial Guinea</option>
								<option value="ER" @if($group->originCountry == 'ER') {{ 'selected' }} @endif>Cyprus>Eritrea</option>
								<option value="EE" @if($group->originCountry == 'EE') {{ 'selected' }} @endif>Cyprus>Estonia</option>
								<option value="ET" @if($group->originCountry == 'ET') {{ 'selected' }} @endif>Cyprus>Ethiopia</option>
								<option value="FK" @if($group->originCountry == 'FK') {{ 'selected' }} @endif>Cyprus>Falkland Islands (Malvinas)</option>
								<option value="FO" @if($group->originCountry == 'FO') {{ 'selected' }} @endif>Cyprus>Faroe Islands</option>
								<option value="FJ" @if($group->originCountry == 'FJ') {{ 'selected' }} @endif>Cyprus>Fiji</option>
								<option value="FI" @if($group->originCountry == 'FI') {{ 'selected' }} @endif>Cyprus>Finland</option>
								<option value="FR" @if($group->originCountry == 'FR') {{ 'selected' }} @endif>Cyprus>France</option>
								<option value="GF" @if($group->originCountry == 'GF') {{ 'selected' }} @endif>Cyprus>French Guiana</option>
								<option value="PF" @if($group->originCountry == 'PF') {{ 'selected' }} @endif>Cyprus>French Polynesia</option>
								<option value="TF" @if($group->originCountry == 'TF') {{ 'selected' }} @endif>Cyprus>French Southern Territories</option>
								<option value="GA" @if($group->originCountry == 'GA') {{ 'selected' }} @endif>Gabon</option>
								<option value="GM" @if($group->originCountry == 'GM') {{ 'selected' }} @endif>Gambia</option>
								<option value="GE" @if($group->originCountry == 'GE') {{ 'selected' }} @endif>Georgia</option>
								<option value="DE" @if($group->originCountry == 'DE') {{ 'selected' }} @endif>Germany</option>
								<option value="GH" @if($group->originCountry == 'GH') {{ 'selected' }} @endif>Ghana</option>
								<option value="GI" @if($group->originCountry == 'GI') {{ 'selected' }} @endif>Gibraltar</option>
								<option value="GR" @if($group->originCountry == 'GR') {{ 'selected' }} @endif>Greece</option>
								<option value="GL" @if($group->originCountry == 'GL') {{ 'selected' }} @endif>Greenland</option>
								<option value="GD" @if($group->originCountry == 'GD') {{ 'selected' }} @endif>Grenada</option>
								<option value="GP" @if($group->originCountry == 'GP') {{ 'selected' }} @endif>Guadeloupe</option>
								<option value="GU" @if($group->originCountry == 'GU') {{ 'selected' }} @endif>Guam</option>
								<option value="GT" @if($group->originCountry == 'GT') {{ 'selected' }} @endif>Guatemala</option>
								<option value="GG" @if($group->originCountry == 'GG') {{ 'selected' }} @endif>Guernsey</option>
								<option value="GN" @if($group->originCountry == 'GN') {{ 'selected' }} @endif>Guinea</option>
								<option value="GW" @if($group->originCountry == 'GW') {{ 'selected' }} @endif>Guinea-Bissau</option>
								<option value="GY" @if($group->originCountry == 'HT') {{ 'selected' }} @endif>Guyana</option>
								<option value="HT" @if($group->originCountry == 'HT') {{ 'selected' }} @endif>Haiti</option>
								<option value="HM" @if($group->originCountry == 'HM') {{ 'selected' }} @endif>Heard Island and McDonald Islands</option>
								<option value="VA" @if($group->originCountry == 'VA') {{ 'selected' }} @endif>Holy See (Vatican City State)</option>
								<option value="HN" @if($group->originCountry == 'HN') {{ 'selected' }} @endif>Honduras</option>
								<option value="HK" @if($group->originCountry == 'HK') {{ 'selected' }} @endif>Hong Kong</option>
								<option value="HU" @if($group->originCountry == 'HU') {{ 'selected' }} @endif>Hungary</option>
								<option value="IS" @if($group->originCountry == 'IS') {{ 'selected' }} @endif>Iceland</option>
								<option value="IN" @if($group->originCountry == 'IN') {{ 'selected' }} @endif>India</option>
								<option value="ID" @if($group->originCountry == 'ID') {{ 'selected' }} @endif>Indonesia</option>
								<option value="IR" @if($group->originCountry == 'IR') {{ 'selected' }} @endif>Iran, Islamic Republic of</option>
								<option value="IQ" @if($group->originCountry == 'IQ') {{ 'selected' }} @endif>Iraq</option>
								<option value="IE" @if($group->originCountry == 'IE') {{ 'selected' }} @endif>Ireland</option>
								<option value="IM" @if($group->originCountry == 'IM') {{ 'selected' }} @endif>Isle of Man</option>
								<option value="IL" @if($group->originCountry == 'IL') {{ 'selected' }} @endif>Israel</option>
								<option value="IT" @if($group->originCountry == 'IT') {{ 'selected' }} @endif>Italy</option>
								<option value="JM" @if($group->originCountry == 'JM') {{ 'selected' }} @endif>Jamaica</option>
								<option value="JP" @if($group->originCountry == 'JP') {{ 'selected' }} @endif>Japan</option>
								<option value="JE" @if($group->originCountry == 'JE') {{ 'selected' }} @endif>Jersey</option>
								<option value="JO" @if($group->originCountry == 'JO') {{ 'selected' }} @endif>Jordan</option>
								<option value="KZ" @if($group->originCountry == 'KZ') {{ 'selected' }} @endif>Kazakhstan</option>
								<option value="KE" @if($group->originCountry == 'KE') {{ 'selected' }} @endif>Kenya</option>
								<option value="KI" @if($group->originCountry == 'KI') {{ 'selected' }} @endif>Kiribati</option>
								<option value="KP" @if($group->originCountry == 'KP') {{ 'selected' }} @endif>Korea, Democratic People's Republic of</option>
								<option value="KR" @if($group->originCountry == 'KR') {{ 'selected' }} @endif>Korea, Republic of</option>
								<option value="KW" @if($group->originCountry == 'KW') {{ 'selected' }} @endif>Kuwait</option>
								<option value="KG" @if($group->originCountry == 'KG') {{ 'selected' }} @endif>Kyrgyzstan</option>
								<option value="LA" @if($group->originCountry == 'LA') {{ 'selected' }} @endif>Lao People's Democratic Republic</option>
								<option value="LV" @if($group->originCountry == 'LV') {{ 'selected' }} @endif>Latvia</option>
								<option value="LB" @if($group->originCountry == 'LB') {{ 'selected' }} @endif>Lebanon</option>
								<option value="LS" @if($group->originCountry == 'LS') {{ 'selected' }} @endif>Lesotho</option>
								<option value="LR" @if($group->originCountry == 'LR') {{ 'selected' }} @endif>Liberia</option>
								<option value="LY" @if($group->originCountry == 'LY') {{ 'selected' }} @endif>Libya</option>
								<option value="LI" @if($group->originCountry == 'LI') {{ 'selected' }} @endif>Liechtenstein</option>
								<option value="LT" @if($group->originCountry == 'LT') {{ 'selected' }} @endif>Lithuania</option>
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
								<option value="North America" <?php if($group->target == 'North America') echo "selected"; ?>>North America</option>
								<option value="Westen Europe" <?php if($group->target == 'Westen Europe') echo "selected"; ?>>Westen Europe</option>
								<option value="China" <?php if($group->target == 'China') echo "selected"; ?>>China</option>
							</select>
							<select name="target" class="form-control" required>
								<option value="">Target Market</option>
								<option value="Global" <?php if($group->target == 'Global') echo "selected"; ?>>Global</option>
								<option value="Asia" <?php if($group->target == 'Asia') echo "selected"; ?>>Asia</option>
								<option value="Europe" <?php if($group->target == 'Europe') echo "selected"; ?>>Europe</option>
								<option value="Mid East" <?php if($group->target == 'Mid East') echo "selected"; ?>>Mid East</option>
								<option value="North America" <?php if($group->target == 'North America') echo "selected"; ?>>North America</option>
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
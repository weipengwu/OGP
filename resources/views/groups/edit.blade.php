@extends('layouts.master')

@section('content')
<div class="container">
	<div class="row">
		<div class="fixedarea">
			<div class="panel">
				<div class="panel-heading"><h3>EDIT MY BRAND</h3></div>

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

						<h4>UPLOAD IMAGES FOR YOUR BRAND</h4>
						<hr>
						<div class="form-group">
							<label>Upload Your New Brand Logo</label>
							<p>Recomended size: 400px X 400px. Images must be in .jpg, .bmp, .png, or .gif format, and not exceed 4 MB.</p>
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
							<input type="text" name="name" class="form-control" id="brandname" placeholder="Brand Name" maxlength="100" value="{{ $group->name }}" required>
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
								<option value="LU" @if($group->originCountry == 'LU') {{ 'selected' }} @endif>Luxembourg</option>
								<option value="MO" @if($group->originCountry == 'MO') {{ 'selected' }} @endif>Macao</option>
								<option value="MK" @if($group->originCountry == 'MK') {{ 'selected' }} @endif>Macedonia, the former Yugoslav Republic of</option>
								<option value="MG" @if($group->originCountry == 'MG') {{ 'selected' }} @endif>Madagascar</option>
								<option value="MW" @if($group->originCountry == 'MW') {{ 'selected' }} @endif>Malawi</option>
								<option value="MY" @if($group->originCountry == 'MY') {{ 'selected' }} @endif>Malaysia</option>
								<option value="MV" @if($group->originCountry == 'MV') {{ 'selected' }} @endif>Maldives</option>
								<option value="ML" @if($group->originCountry == 'ML') {{ 'selected' }} @endif>Mali</option>
								<option value="MT" @if($group->originCountry == 'MT') {{ 'selected' }} @endif>Malta</option>
								<option value="MH" @if($group->originCountry == 'MH') {{ 'selected' }} @endif>Marshall Islands</option>
								<option value="MQ" @if($group->originCountry == 'MQ') {{ 'selected' }} @endif>Martinique</option>
								<option value="MR" @if($group->originCountry == 'MR') {{ 'selected' }} @endif>Mauritania</option>
								<option value="MU" @if($group->originCountry == 'MU') {{ 'selected' }} @endif>Mauritius</option>
								<option value="YT" @if($group->originCountry == 'YT') {{ 'selected' }} @endif>Mayotte</option>
								<option value="MX" @if($group->originCountry == 'MX') {{ 'selected' }} @endif>Mexico</option>
								<option value="FM" @if($group->originCountry == 'FM') {{ 'selected' }} @endif>Micronesia, Federated States of</option>
								<option value="MD" @if($group->originCountry == 'MD') {{ 'selected' }} @endif>Moldova, Republic of</option>
								<option value="MC" @if($group->originCountry == 'MC') {{ 'selected' }} @endif>Monaco</option>
								<option value="MN" @if($group->originCountry == 'MN') {{ 'selected' }} @endif>Mongolia</option>
								<option value="ME" @if($group->originCountry == 'ME') {{ 'selected' }} @endif>Montenegro</option>
								<option value="MS" @if($group->originCountry == 'MS') {{ 'selected' }} @endif>Montserrat</option>
								<option value="MA" @if($group->originCountry == 'MA') {{ 'selected' }} @endif>Morocco</option>
								<option value="MZ" @if($group->originCountry == 'MZ') {{ 'selected' }} @endif>Mozambique</option>
								<option value="MM" @if($group->originCountry == 'MM') {{ 'selected' }} @endif>Myanmar</option>
								<option value="NA" @if($group->originCountry == 'NA') {{ 'selected' }} @endif>Namibia</option>
								<option value="NR" @if($group->originCountry == 'NR') {{ 'selected' }} @endif>Nauru</option>
								<option value="NP" @if($group->originCountry == 'NP') {{ 'selected' }} @endif>Nepal</option>
								<option value="NL" @if($group->originCountry == 'NL') {{ 'selected' }} @endif>Netherlands</option>
								<option value="NC" @if($group->originCountry == 'NC') {{ 'selected' }} @endif>New Caledonia</option>
								<option value="NZ" @if($group->originCountry == 'NZ') {{ 'selected' }} @endif>New Zealand</option>
								<option value="NI" @if($group->originCountry == 'NI') {{ 'selected' }} @endif>Nicaragua</option>
								<option value="NE" @if($group->originCountry == 'NE') {{ 'selected' }} @endif>Niger</option>
								<option value="NG" @if($group->originCountry == 'NG') {{ 'selected' }} @endif>Nigeria</option>
								<option value="NU" @if($group->originCountry == 'NU') {{ 'selected' }} @endif>Niue</option>
								<option value="NF" @if($group->originCountry == 'NF') {{ 'selected' }} @endif>Norfolk Island</option>
								<option value="MP" @if($group->originCountry == 'MP') {{ 'selected' }} @endif>Northern Mariana Islands</option>
								<option value="NO" @if($group->originCountry == 'NO') {{ 'selected' }} @endif>Norway</option>
								<option value="OM" @if($group->originCountry == 'OM') {{ 'selected' }} @endif>Oman</option>
								<option value="PK" @if($group->originCountry == 'PK') {{ 'selected' }} @endif>Pakistan</option>
								<option value="PW" @if($group->originCountry == 'PW') {{ 'selected' }} @endif>Palau</option>
								<option value="PS" @if($group->originCountry == 'PS') {{ 'selected' }} @endif>Palestinian Territory, Occupied</option>
								<option value="PA" @if($group->originCountry == 'PA') {{ 'selected' }} @endif>Panama</option>
								<option value="PG" @if($group->originCountry == 'PG') {{ 'selected' }} @endif>Papua New Guinea</option>
								<option value="PY" @if($group->originCountry == 'PY') {{ 'selected' }} @endif>Paraguay</option>
								<option value="PE" @if($group->originCountry == 'PE') {{ 'selected' }} @endif>Peru</option>
								<option value="PH" @if($group->originCountry == 'PH') {{ 'selected' }} @endif>Philippines</option>
								<option value="PN" @if($group->originCountry == 'PN') {{ 'selected' }} @endif>Pitcairn</option>
								<option value="PL" @if($group->originCountry == 'PL') {{ 'selected' }} @endif>Poland</option>
								<option value="PT" @if($group->originCountry == 'PT') {{ 'selected' }} @endif>Portugal</option>
								<option value="PR" @if($group->originCountry == 'PR') {{ 'selected' }} @endif>Puerto Rico</option>
								<option value="QA" @if($group->originCountry == 'QA') {{ 'selected' }} @endif>Qatar</option>
								<option value="RE" @if($group->originCountry == 'RE') {{ 'selected' }} @endif>Réunion</option>
								<option value="RO" @if($group->originCountry == 'RO') {{ 'selected' }} @endif>Romania</option>
								<option value="RU" @if($group->originCountry == 'RU') {{ 'selected' }} @endif>Russian Federation</option>
								<option value="RW" @if($group->originCountry == 'RW') {{ 'selected' }} @endif>Rwanda</option>
								<option value="BL" @if($group->originCountry == 'BL') {{ 'selected' }} @endif>Saint Barthélemy</option>
								<option value="SH" @if($group->originCountry == 'SH') {{ 'selected' }} @endif>Saint Helena, Ascension and Tristan da Cunha</option>
								<option value="KN" @if($group->originCountry == 'KN') {{ 'selected' }} @endif>Saint Kitts and Nevis</option>
								<option value="LC" @if($group->originCountry == 'LC') {{ 'selected' }} @endif>Saint Lucia</option>
								<option value="MF" @if($group->originCountry == 'MF') {{ 'selected' }} @endif>Saint Martin (French part)</option>
								<option value="PM" @if($group->originCountry == 'PM') {{ 'selected' }} @endif>Saint Pierre and Miquelon</option>
								<option value="VC" @if($group->originCountry == 'VC') {{ 'selected' }} @endif>Saint Vincent and the Grenadines</option>
								<option value="WS" @if($group->originCountry == 'WS') {{ 'selected' }} @endif>Samoa</option>
								<option value="SM" @if($group->originCountry == 'SM') {{ 'selected' }} @endif>San Marino</option>
								<option value="ST" @if($group->originCountry == 'ST') {{ 'selected' }} @endif>Sao Tome and Principe</option>
								<option value="SA" @if($group->originCountry == 'SA') {{ 'selected' }} @endif>Saudi Arabia</option>
								<option value="SN" @if($group->originCountry == 'SN') {{ 'selected' }} @endif>Senegal</option>
								<option value="RS" @if($group->originCountry == 'RS') {{ 'selected' }} @endif>Serbia</option>
								<option value="SC" @if($group->originCountry == 'SC') {{ 'selected' }} @endif>Seychelles</option>
								<option value="SL" @if($group->originCountry == 'SL') {{ 'selected' }} @endif>Sierra Leone</option>
								<option value="SG" @if($group->originCountry == 'SG') {{ 'selected' }} @endif>Singapore</option>
								<option value="SX" @if($group->originCountry == 'SX') {{ 'selected' }} @endif>Sint Maarten (Dutch part)</option>
								<option value="SK" @if($group->originCountry == 'SK') {{ 'selected' }} @endif>Slovakia</option>
								<option value="SI" @if($group->originCountry == 'SI') {{ 'selected' }} @endif>Slovenia</option>
								<option value="SB" @if($group->originCountry == 'SB') {{ 'selected' }} @endif>Solomon Islands</option>
								<option value="SO" @if($group->originCountry == 'SO') {{ 'selected' }} @endif>Somalia</option>
								<option value="ZA" @if($group->originCountry == 'ZA') {{ 'selected' }} @endif>South Africa</option>
								<option value="GS" @if($group->originCountry == 'GS') {{ 'selected' }} @endif>South Georgia and the South Sandwich Islands</option>
								<option value="SS" @if($group->originCountry == 'SS') {{ 'selected' }} @endif>South Sudan</option>
								<option value="ES" @if($group->originCountry == 'ES') {{ 'selected' }} @endif>Spain</option>
								<option value="LK" @if($group->originCountry == 'LK') {{ 'selected' }} @endif>Sri Lanka</option>
								<option value="SD" @if($group->originCountry == 'SD') {{ 'selected' }} @endif>Sudan</option>
								<option value="SR" @if($group->originCountry == 'SR') {{ 'selected' }} @endif>Suriname</option>
								<option value="SJ" @if($group->originCountry == 'SJ') {{ 'selected' }} @endif>Svalbard and Jan Mayen</option>
								<option value="SZ" @if($group->originCountry == 'SZ') {{ 'selected' }} @endif>Swaziland</option>
								<option value="SE" @if($group->originCountry == 'SE') {{ 'selected' }} @endif>Sweden</option>
								<option value="CH" @if($group->originCountry == 'CH') {{ 'selected' }} @endif>Switzerland</option>
								<option value="SY" @if($group->originCountry == 'SY') {{ 'selected' }} @endif>Syrian Arab Republic</option>
								<option value="TW" @if($group->originCountry == 'TW') {{ 'selected' }} @endif>Taiwan, Province of China</option>
								<option value="TJ" @if($group->originCountry == 'TJ') {{ 'selected' }} @endif>Tajikistan</option>
								<option value="TZ" @if($group->originCountry == 'TZ') {{ 'selected' }} @endif>Tanzania, United Republic of</option>
								<option value="TH" @if($group->originCountry == 'TH') {{ 'selected' }} @endif>Thailand</option>
								<option value="TL" @if($group->originCountry == 'TL') {{ 'selected' }} @endif>Timor-Leste</option>
								<option value="TG" @if($group->originCountry == 'TG') {{ 'selected' }} @endif>Togo</option>
								<option value="TK" @if($group->originCountry == 'TK') {{ 'selected' }} @endif>Tokelau</option>
								<option value="TO" @if($group->originCountry == 'TO') {{ 'selected' }} @endif>Tonga</option>
								<option value="TT" @if($group->originCountry == 'TT') {{ 'selected' }} @endif>Trinidad and Tobago</option>
								<option value="TN" @if($group->originCountry == 'TN') {{ 'selected' }} @endif>Tunisia</option>
								<option value="TR" @if($group->originCountry == 'TR') {{ 'selected' }} @endif>Turkey</option>
								<option value="TM" @if($group->originCountry == 'TM') {{ 'selected' }} @endif>Turkmenistan</option>
								<option value="TC" @if($group->originCountry == 'TC') {{ 'selected' }} @endif>Turks and Caicos Islands</option>
								<option value="TV" @if($group->originCountry == 'TV') {{ 'selected' }} @endif>Tuvalu</option>
								<option value="UG" @if($group->originCountry == 'UG') {{ 'selected' }} @endif>Uganda</option>
								<option value="UA" @if($group->originCountry == 'UA') {{ 'selected' }} @endif>Ukraine</option>
								<option value="AE" @if($group->originCountry == 'AE') {{ 'selected' }} @endif>United Arab Emirates</option>
								<option value="GB" @if($group->originCountry == 'GB') {{ 'selected' }} @endif>United Kingdom</option>
								<option value="US" @if($group->originCountry == 'US') {{ 'selected' }} @endif>United States</option>
								<option value="UM" @if($group->originCountry == 'UM') {{ 'selected' }} @endif>United States Minor Outlying Islands</option>
								<option value="UY" @if($group->originCountry == 'UY') {{ 'selected' }} @endif>Uruguay</option>
								<option value="UZ" @if($group->originCountry == 'UZ') {{ 'selected' }} @endif>Uzbekistan</option>
								<option value="VU" @if($group->originCountry == 'VU') {{ 'selected' }} @endif>Vanuatu</option>
								<option value="VE" @if($group->originCountry == 'VE') {{ 'selected' }} @endif>Venezuela, Bolivarian Republic of</option>
								<option value="VN" @if($group->originCountry == 'VN') {{ 'selected' }} @endif>Viet Nam</option>
								<option value="VG" @if($group->originCountry == 'VG') {{ 'selected' }} @endif>Virgin Islands, British</option>
								<option value="VI" @if($group->originCountry == 'VI') {{ 'selected' }} @endif>Virgin Islands, U.S.</option>
								<option value="WF" @if($group->originCountry == 'WF') {{ 'selected' }} @endif>Wallis and Futuna</option>
								<option value="EH" @if($group->originCountry == 'EH') {{ 'selected' }} @endif>Western Sahara</option>
								<option value="YE" @if($group->originCountry == 'YE') {{ 'selected' }} @endif>Yemen</option>
								<option value="ZM" @if($group->originCountry == 'ZM') {{ 'selected' }} @endif>Zambia</option>
								<option value="ZW" @if($group->originCountry == 'ZW') {{ 'selected' }} @endif>Zimbabwe</option>
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
							<textarea name="description" maxlength="300" placeholder="Brief Introduction ( Tips: Please use the official language at the target markets. )" class="form-control" required>{!! strip_tags($group->description) !!}</textarea>
						</div>
						<p class="small">By continuing you pledge that the content filled in and the additional materials provided are true and authentic in every aspect.</p>
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
										url: window.location.origin+"/brands/checkBrandname",
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
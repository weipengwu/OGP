@extends('layouts.master')

@section('content')
<div class="container">
	<div class="row">
		<div class="fixedarea">
			<div class="panel">
				<div class="panel-heading"><h3>CREATE A NEW EVENT</h3></div>

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
					<form id="newevent" action="{{ URL::route('createEvent') }}" method="post" enctype="multipart/form-data">
						<input type="hidden" name="_token" value="{{ csrf_token() }}">
						<input type="hidden" name="author" value="{{ Auth::user()->id }}">
						<input type="hidden" name="gid" value="<?php echo $gid;?>">
						<div class="form-group">
							<label>Upload Your Banner Image.</label>
							<p>Recomended size: 1500px X 500px. Images must be in .jpg, .bmp, .png, or .gif format, and not exceed 4 MB.</p>
							<input type="file" name="banner" id="banner" accept="image/*">
						</div>
						<div class="form-group row">
							<div class="col-md-12">Select the type of your event</div>
							<div class="col-md-6 col-sm-6 col-xs-6">
							<span class="radio"><input type="radio" name="type" id="typepublic" value="public" checked/><label for="typepublic">Public(Anyone can see)</label> </span>
							</div>
							<div class="col-md-6 col-sm-6 col-xs-6">
							<span class="radio"><input type="radio" name="type" id="typeprivate" value="private" /> <label for="typeprivate">Private(Only followers can see)</label></span>
							</div>
						</div>	
						<div class="form-group">
							<input type="text" name="title" class="form-control" placeholder="Event Title" maxlength="50" required>
						</div>
						<div class="form-group" style="float:left; margin-right: 2%; width: 49%;">
			                <label for="dtp_input1" class="col-md-2 col-sm-2 col-xs-2 control-label">From: </label>
			                <div class="input-group date form_datetime col-md-10 col-sm-10 col-xs-10" data-date-format="yyyy-mm-dd HH:ii p" data-link-field="dtp_input1">
			                    <input class="form-control" name="fromtime" type="text" value="">
								<span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></span>
			                </div>
							<input type="hidden" id="dtp_input1" value="" />
			            </div>
			            <div class="form-group" style="float:left; width: 49%;">
			                <label for="dtp_input2" class="col-md-2 col-sm-2 col-xs-2 control-label" style="text-align: right">To: </label>
			                <div class="input-group date form_datetime col-md-10 col-sm-10 col-xs-10" data-date-format="yyyy-mm-dd HH:ii p" data-link-field="dtp_input2">
			                    <input class="form-control" name="totime" type="text" value="">
								<span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></span>
			                </div>
							<input type="hidden" id="dtp_input2" value="" />
			            </div>
			            <input type="hidden" name="timezone" id="timezone" value="" />
			            <div class="form-group" style="float:left; margin-right: 2%; width: 49%;">
							<label class="col-md-2 col-sm-2 col-xs-2">Price</label>
							<div class="col-md-10 col-sm-10 col-xs-10" style="padding: 0">
							<select name="selectprice" id="selectprice" class="form-control">
								<option value="Free">Free</option>
								<option value="Paid">Paid</option>
							</select>
							</div>
						</div>
						<div id="fee" class="form-group" style="float:left; width: 49%;">
							<div class="col-md-3 col-sm-3 col-xs-3"><select name="eventcurrency" class="form-control"><option value="cad">C$</option><option value="usd">$</option><option value="cny">¥</option><option value="eur">€</option></select></div> <div class="col-md-9 col-sm-9 col-xs-9" style="padding: 0"><input type="number" name="fee" class="form-control" placeholder="Event Fee"></div>
						</div>
						<!-- <div class="form-group">
							<input type="number" name="quantity" class="form-control" placeholder="Quantity" min="1" max="1000">
						</div> -->
						<div class="form-group">
							<input type="text" name="suitenum" class="form-control" placeholder="Suite No.">
						</div>
						<div class="form-group">
							<input type="text" name="address" id="address" class="form-control" placeholder="Address">
							<input type="hidden" name="city" id="city" class="form-control">
						</div>
						<div id="map">
						</div>
					
						<div class="form-group">
							<textarea name="content" class="form-control" placeholder="Event Description" required></textarea>
						</div>

						<div class="imagezone">
							<div class="form-group form-img1">
								<input type="file" id="postimage1" name="postimage1" accept="image/*">
							</div>
							<div class="form-group form-img2">
								<input type="file" id="postimage2" name="postimage2" accept="image/*">
							</div>
							<div class="form-group form-img3">
								<input type="file" id="postimage3" name="postimage3" accept="image/*">
							</div>
							<div class="form-group form-img4">
								<input type="file" id="postimage4" name="postimage4" accept="image/*">
							</div>
						</div>
						<input type="submit" class="btn btn-logo" value="Submit">
					</form>
				</div>
			</div>
		</div>
	</div>
</div>
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyANM_gBRmfXCbtGiN768aUL1div-Dd0TU4&libraries=places"></script>
<script>
var tz = jstz.determine();
$('#timezone').val(tz.name());
	function initialize() {
  var map = new google.maps.Map(document.getElementById('map'), {
    center: { lat: 43.6509618, lng: -79.3824327},
    zoom: 12,
    scrollwheel: false,
    styles: [{"featureType":"landscape","stylers":[{"hue":"#FFBB00"},{"saturation":43.400000000000006},{"lightness":37.599999999999994},{"gamma":1}]},{"featureType":"road.highway","stylers":[{"hue":"#FFC200"},{"saturation":-61.8},{"lightness":45.599999999999994},{"gamma":1}]},{"featureType":"road.arterial","stylers":[{"hue":"#FF0300"},{"saturation":-100},{"lightness":51.19999999999999},{"gamma":1}]},{"featureType":"road.local","stylers":[{"hue":"#FF0300"},{"saturation":-100},{"lightness":52},{"gamma":1}]},{"featureType":"water","stylers":[{"hue":"#0078FF"},{"saturation":-13.200000000000003},{"lightness":2.4000000000000057},{"gamma":1}]},{"featureType":"poi","stylers":[{"hue":"#00FF6A"},{"saturation":-1.0989010989011234},{"lightness":11.200000000000017},{"gamma":1}]}]
  });
  var input = /** @type {!HTMLInputElement} */(
      document.getElementById('address'));

  var autocomplete = new google.maps.places.Autocomplete(input);
  autocomplete.bindTo('bounds', map);

  // var infowindow = new google.maps.InfoWindow();
  var marker = new google.maps.Marker({
    map: map,
    anchorPoint: new google.maps.Point(0, -29)
  });

  autocomplete.addListener('place_changed', function() {
    marker.setVisible(false);
    var place = autocomplete.getPlace();
    if (!place.geometry) {
      window.alert("Autocomplete's returned place contains no geometry");
      return;
    }
    var components = place.address_components;
    $.each(components, function(i, val){
    	if(val.types[0] == 'locality'){
    		var city = val.long_name;
    		$('#city').val(city);
    	}
    })
    // If the place has a geometry, then present it on a map.
    if (place.geometry.viewport) {
      map.fitBounds(place.geometry.viewport);
    } else {
      map.setCenter(place.geometry.location);
      map.setZoom(15); 
    }
    marker.setIcon(/** @type {google.maps.Icon} */({
      url: place.icon,
      size: new google.maps.Size(71, 71),
      origin: new google.maps.Point(0, 0),
      anchor: new google.maps.Point(17, 34),
      scaledSize: new google.maps.Size(35, 35)
    }));
    marker.setPosition(place.geometry.location);
    marker.setVisible(true);

  });

}
google.maps.event.addDomListener(window, 'load', initialize);
</script>
@endsection
@extends('layouts.master')

@section('content')
<div class="container">
	<div class="row">
		<div class="fixedarea">
			<div class="panel">
				<div class="panel-heading"><h3>{{ trans('events.editevent') }}</h3></div>

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
					<form id="newevent" action="{{ URL::route('editingEvent') }}" method="post" enctype="multipart/form-data">
						<input type="hidden" name="_token" value="{{ csrf_token() }}">
						<input type="hidden" name="author" value="{{ Auth::user()->id }}">
						<input type="hidden" name="eid" value="{{ $event->id }}">
						<input type="hidden" name="gid" value="{{ $event->group_id }}">
						<div class="form-group">
							<label>{{ trans('events.bannerimage') }}</label>
							<p>{{ trans('events.recomendedsize') }}</p>
							<input type="file" name="banner" id="banner" accept="image/*">
						</div>
						<div class="form-group row">
							<div class="col-md-12">{{ trans('events.type') }}</div>
							<div class="col-md-6 col-sm-6 col-xs-6">
							<span class="radio"><input type="radio" name="type" id="typepublic" value="public" <?php if($event->type == 'public') echo "checked"; ?>/><label for="typepublic">{{ trans('events.publictype') }}</label> </span>
							</div>
							<div class="col-md-6 col-sm-6 col-xs-6">
							<span class="radio"><input type="radio" name="type" id="typeprivate" value="private" <?php if($event->type == 'private') echo "checked"; ?> /> <label for="typeprivate">{{ trans('events.privatetype') }}</label></span>
							</div>
						</div>	
						<div class="form-group">
							<input type="text" name="title" class="form-control" placeholder="{{ trans('events.eventtitle') }}" maxlength="150" value="{{ $event->title }}">
						</div>
						<div class="form-group" style="float:left; margin-right: 2%; width: 49%;">
			                <label for="dtp_input1" class="col-md-2 col-sm-2 col-xs-2 control-label">{{ trans('events.from') }}</label>
			                <div class="input-group date form_datetime col-md-10 col-sm-10 col-xs-10" data-date-format="yyyy-mm-dd HH:ii p" data-link-field="dtp_input1">
			                    <input class="form-control" name="fromtime" type="text" value="{{ gmdate('Y-m-d h:i a', $event->fromtime) }}">
								<span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></span>
			                </div>
							<input type="hidden" id="dtp_input1" value="" />
			            </div>
			            <div class="form-group" style="float:left; width: 49%;">
			                <label for="dtp_input2" class="col-md-2 col-sm-2 col-xs-2 control-label" style="text-align: right">{{ trans('events.to') }}</label>
			                <div class="input-group date form_datetime col-md-10 col-sm-10 col-xs-10" data-date-format="yyyy-mm-dd HH:ii p" data-link-field="dtp_input2">
			                    <input class="form-control" name="totime" type="text" value="{{ gmdate('Y-m-d h:i a', $event->totime) }}">
								<span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></span>
			                </div>
							<input type="hidden" id="dtp_input2" value="" />
			            </div>
			     
			            <div class="form-group" style="float:left; margin-right: 2%; width: 49%;">
							<label class="col-md-2 col-sm-2 col-xs-2">{{ trans('events.price') }}</label>
							<div class="col-md-10 col-sm-10 col-xs-10" style="padding: 0">
							<select name="selectprice" id="selectprice" class="form-control">
								<option value="Free">{{ trans('events.free') }}</option>
								<option value="Paid" <?php if ($event->fee !== 'Free') echo "selected";?>>{{ trans('events.paid') }}</option>
							</select>
							</div>
						</div>
						<div id="fee" class="form-group" style="float:left; width: 49%;">
							<div class="col-md-3 col-sm-3 col-xs-3">
								<select class="form-control" name="eventcurrency">
									<option value="cad" @if ($event->currency == 'cad') {{ 'selected' }} @endif >C$</option>
									<option value="usd" @if ($event->currency == 'usd') {{ 'selected' }} @endif >$</option>
									<option value="cny" @if ($event->currency == 'cny') {{ 'selected' }} @endif >¥</option>
									<option value="eur" @if ($event->currency == 'eur') {{ 'selected' }} @endif >€</option>
								</select>
							</div> <div class="col-md-9 col-sm-9 col-xs-9" style="padding: 0"><input type="number" name="fee" class="form-control" placeholder="{{ trans('events.eventfee') }}" <?php if ($event->fee !== 'Free') echo "value='".$event->fee."'";?>></div>
						</div>
						<!-- <div class="form-group">
							<input type="number" name="quantity" class="form-control" placeholder="Quantity" min="0" max="1000" value="{{ $event->quantity }}">
						</div> -->
						<div class="form-group">
							<input type="text" name="suitenum" class="form-control" placeholder="{{ trans('events.suiteno') }}" value="{{ $event->suitenum }}">
						</div>
						<div class="form-group">
							<input type="text" name="address" id="address" class="form-control" placeholder="{{ trans('events.address') }}" value="{{ $event->address }}">
							<input type="hidden" name="city" id="city" class="form-control" value="{{ $event->city }}">
						</div>
						<div id="map">
						</div>

						<div class="form-group">
							<textarea name="content" class="form-control" placeholder="{{ trans('events.eventdescription') }}">{{ strip_tags($event->content) }}</textarea>
						</div>
						<input type="submit" class="btn btn-logo" value="{{ trans('posts.submit') }}">
					</form>
				</div>
			</div>
		</div>
	</div>
</div>
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyANM_gBRmfXCbtGiN768aUL1div-Dd0TU4&libraries=places"></script>
<script>
	function initialize() {
  var event_address = "<?php echo $event->address;?>";
      	var mapOptions = {
		          center: { lat: 43.6509618, lng: -79.3824327 },
		          zoom: 15,
		          scrollwheel: false,
		          styles: [{"featureType":"landscape","stylers":[{"hue":"#FFBB00"},{"saturation":43.400000000000006},{"lightness":37.599999999999994},{"gamma":1}]},{"featureType":"road.highway","stylers":[{"hue":"#FFC200"},{"saturation":-61.8},{"lightness":45.599999999999994},{"gamma":1}]},{"featureType":"road.arterial","stylers":[{"hue":"#FF0300"},{"saturation":-100},{"lightness":51.19999999999999},{"gamma":1}]},{"featureType":"road.local","stylers":[{"hue":"#FF0300"},{"saturation":-100},{"lightness":52},{"gamma":1}]},{"featureType":"water","stylers":[{"hue":"#0078FF"},{"saturation":-13.200000000000003},{"lightness":2.4000000000000057},{"gamma":1}]},{"featureType":"poi","stylers":[{"hue":"#00FF6A"},{"saturation":-1.0989010989011234},{"lightness":11.200000000000017},{"gamma":1}]}]
		        };
		        var map = new google.maps.Map(document.getElementById('map'), mapOptions);
            var event_geocoder = new google.maps.Geocoder();
            event_geocoder.geocode( { 'address': event_address}, function(results, status) {
              if (status == google.maps.GeocoderStatus.OK) {
           
                map.setCenter(results[0].geometry.location);
			      var marker = new google.maps.Marker({
			        map: map,
			        position: results[0].geometry.location
			      });

              } else {
                alert("Geocode for Address was not successful for the following reason: " + status);
              }
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
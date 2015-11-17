@extends('layouts.master')

@section('content')
<div class="eventbanner" style="background: #ccc url('<?php echo url()."/".$event->banner;?>') center center no-repeat; background-size: cover;)">

</div>
<div class="statusbar">
			<div class="left">
				<span>{{ $event->likes->count()}} Interested</span> 
			</div>
		<div class="right">
			<div class="sharebox">
				<a href="" class="social_icons social_tw"><i class="fa fa-twitter"></i></a> <a href="" class="social_icons social_fb"><i class="fa fa-facebook"></i></a> <a href="" class="social_icons social_wc"><i class="fa fa-wechat"></i></a> <a href="" class="social_icons social_wb"><i class="fa fa-weibo"></i></a>
			</div>
			<div class="shareto">
				<a href="" class="share_btn"> <img src="{{ asset('img/share_icon.png') }}" width="16"> </a>
			</div>
			<div class="likebar">
			@if(Auth::check())
				@if(alreadyLikedEvent(Auth::user()->id,$event->id) > 0)
					<span><a href="" data-event-id="{{ $event->id }}" data-author-id="{{ Auth::user()->id }}" class="like_btn event_unlike"><img src="{{ asset('img/already_likes_icon.png') }}" width="16"></a></span>
				@else
					<span><a href="" data-event-id="{{ $event->id }}" data-author-id="{{ Auth::user()->id }}" class="like_btn event_like"><img src="{{ asset('img/likes_icon.png') }}" width="16"></a></span>
				@endif
					<span class="likenum">{{ $event->likes->count()}}</span>
			@endif
			</div>
		</div>
	</div>
<section class="eventdetails">
	<div class="container">
		<div class="row">
			<div class="col-md-8 col-md-offset-2">
				<h1>{{ $event->title }}</h1>
				<p>Category: {{ $event->group->category }}</p>
				<hr>
					<div class="eventinfo">
						<?php if(gmdate('M j',$event->fromtime) == gmdate('M j',$event->totime)) : ?>
							{{ gmdate('D, M j',$event->fromtime) }} @ {{ gmdate('g : i a',$event->fromtime) }} - {{ gmdate('g : i a' ,$event->totime) }}
						<?php else: ?>
							{{ gmdate('M j',$event->fromtime) }} - {{ gmdate('M j',$event->totime) }}

						<?php endif; ?>
					</div>
					<div class="eventinfo"> {{ $event->address }}</div>
					<div class="eventinfo eventfee">{{ $event->fee }}</div>
				</div>
				@if($event->fee == 'Free')

				@else
				<!-- <form action="{{ url('ogppay') }}" method="post" class="stripe-form">
				<script src="https://checkout.stripe.com/checkout.js"></script>
				<div class="purchaseholder">
				<button id="purchaseButton">Purchase</button>
				</div>
				<script>
				  var handler = StripeCheckout.configure({
				    key: 'pk_test_6pRNASCoBOKtIshFeQd4XMUh',
				    image: '<?php echo url()."/".getGroupProfile($event->group_id);?>',
				    locale: 'auto',
				    token: function(token) {
				      // Use the token to create the charge with a server-side script.
				      // You can access the token ID with `token.id`
				    }
				  });

				  $('#purchaseButton').on('click', function(e) {
				    // Open Checkout with further options
				    handler.open({
				      name: '{{ getGroupName($event->group_id) }}',
				      description: '{{ $event->title }}',
				      amount: {{ $event->fee * 100 }},
				      currency: 'cad'
				    });
				    e.preventDefault();
				  });

				  // Close Checkout on page navigation
				  $(window).on('popstate', function() {
				    handler.close();
				  });
				</script>
				</form> -->
				<form action="{{ URL::route('eventCharge') }}" method="post" class="stripe-form">
				  <input type="hidden" name="eid" value="{{ $event->id }}">
				  <script src="https://checkout.stripe.com/checkout.js" class="stripe-button"
				          data-key="{{Config::get('stripe.stripe.public')}}"
				          data-description="{{ $event->title }}"
				          data-amount="{{ $event->fee * 100 }}"
				          data-name="{{ getGroupName($event->group_id) }}"
				          data-image='<?php echo url()."/".getGroupProfile($event->group_id);?>'
				          data-currency='cad'
				          data-alipay="true"></script>
				</form>
				@endif
			</div>
	</div>
</section>
<section class="orgnizationsection greybg">
	<p class="title">Orgnized by</p>
	<div class="groupprofile" style="background: #666 url('<?php echo url()."/".getGroupProfile($event->group_id);?>') center center no-repeat; background-size: cover;"></div>
	<h2><a href="/groups/<?php echo getGroupSlug($event->group_id); ?>">{{ getGroupName($event->group_id) }}</a></h2>
</section>
<section class="contentsection">
	<div class="container">
		<div class="row">
			<div class="col-md-8 col-md-offset-2">
					<p>{!! html_entity_decode($event->content) !!}</p>	
			</div>
		</div>
	</div>
</section>
<section class="locationsection">
	<div class="locationbar">{{ $event->address }}</div>
	<div class="locationmap">
		<div class="downarrow"><div class="angle-down"></div></div>
		<div id="map-canvas"></div>
	</div>
</section>
<section class="peoplesection">
	<div class="container">
		<div class="row">
			<div class="col-md-8 col-md-offset-2">
			<h2>Interested</h2>
			<hr>
			<h2>Attentees</h2>
			</div>
		</div>
	</div>
</section>
<script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=AIzaSyANM_gBRmfXCbtGiN768aUL1div-Dd0TU4&libraries=places"></script>
    <script type="text/javascript">
      function initialize() {
      	var event_address = "<?php echo $event->address;?>";
      	
            var event_geocoder = new google.maps.Geocoder();
            event_geocoder.geocode( { 'address': event_address}, function(results, status) {
              if (status == google.maps.GeocoderStatus.OK) {
              	var mapOptions = {
		          center: { lat: 43.6509618, lng: -79.3824327 },
		          zoom: 15,
		          scrollwheel: false,
		          styles: [{"featureType":"landscape","stylers":[{"hue":"#FFBB00"},{"saturation":43.400000000000006},{"lightness":37.599999999999994},{"gamma":1}]},{"featureType":"road.highway","stylers":[{"hue":"#FFC200"},{"saturation":-61.8},{"lightness":45.599999999999994},{"gamma":1}]},{"featureType":"road.arterial","stylers":[{"hue":"#FF0300"},{"saturation":-100},{"lightness":51.19999999999999},{"gamma":1}]},{"featureType":"road.local","stylers":[{"hue":"#FF0300"},{"saturation":-100},{"lightness":52},{"gamma":1}]},{"featureType":"water","stylers":[{"hue":"#0078FF"},{"saturation":-13.200000000000003},{"lightness":2.4000000000000057},{"gamma":1}]},{"featureType":"poi","stylers":[{"hue":"#00FF6A"},{"saturation":-1.0989010989011234},{"lightness":11.200000000000017},{"gamma":1}]}]
		        };
		        var map = new google.maps.Map(document.getElementById('map-canvas'), mapOptions);
                map.setCenter(results[0].geometry.location);
			      var marker = new google.maps.Marker({
			        map: map,
			        position: results[0].geometry.location
			      });

              } else {
                alert("Geocode for Address was not successful for the following reason: " + status);
              }
            });
   
      }
      google.maps.event.addDomListener(window, 'load', initialize);
    </script>
@endsection
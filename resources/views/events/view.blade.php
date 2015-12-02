@extends('layouts.master')

@section('content')
<div class="eventbanner" style="background: #ccc url('<?php echo url()."/".$event->banner;?>') center center no-repeat; background-size: cover;)">

</div>
<div class="statusbar">
			<div class="left">
				<span class="leftlikenum">{{ $event->likes->count()}} Interested</span> 
			</div>
		<div class="right">
			<div class="sharebox">
				<a href="" class="social_icons social_tw"><i class="fa fa-twitter"></i></a> <a href="" class="social_icons social_fb"><i class="fa fa-facebook"></i></a> <a href="" class="social_icons social_wc"><i class="fa fa-wechat"></i></a> <a href="" class="social_icons social_wb"><i class="fa fa-weibo"></i></a>
			</div>
			<div class="shareto">
				<a href="" data-toggle="tooltip" title="Share" class="share_btn"> <img src="{{ asset('img/share_icon.png') }}" width="16"> </a>
			</div>
			<div class="likebar">
			@if(Auth::check())
				@if(alreadyLikedEvent(Auth::user()->id,$event->id) > 0)
					<span><a href="" data-toggle="tooltip" title="Not interested" data-event-id="{{ $event->id }}" data-author-id="{{ Auth::user()->id }}" class="like_btn event_unlike"><img src="{{ asset('img/already_likes_icon.png') }}" width="16"></a></span>
				@else
					<span><a href="" data-toggle="tooltip" title="Interested" data-event-id="{{ $event->id }}" data-author-id="{{ Auth::user()->id }}" class="like_btn event_like"><img src="{{ asset('img/likes_icon.png') }}" width="16"></a></span>
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
					<div class="eventinfo eventfee">
						@if($event->fee == 'Free') 
							{{ $event->fee }}
						@else
							C ${{ $event->fee }}
						@endif
					</div>
				</div>
				<!-- @if($event->fee == 'Free')

				@else

				<form action="{{ URL::route('eventCharge') }}" method="post" class="stripe-form">
				  <input type="hidden" name="eid" value="{{ $event->id }}">
				  <script src="https://checkout.stripe.com/checkout.js" class="stripe-button"
				          data-key="{{Config::get('stripe.stripe.public')}}"
				          data-description="{{ $event->title }}"
				          data-amount="{{ $event->fee * 100 }}"
				          data-label="Reserve"
				          data-name="{{ getGroupName($event->group_id) }}"
				          data-image='<?php echo url()."/".getGroupProfile($event->group_id);?>'
				          data-currency='cad'
				          data-alipay="true"></script>
				</form>
				@endif -->
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
			@if ($event->gallery !== '')
				<?php $galleries = explode(',', $event->gallery); ?>
					<div class="eventgallery">
					<div class="flexslider">
						<ul class="slides">
						@foreach ($galleries as $gallery)
							<li><img src="<?php echo url().'/'.$gallery;?>" class="post-img"></li>
						@endforeach
						</ul>
					</div>
					</div>
			@endif
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
			<div class="interestWrapper">
			<?php
				$alllikes = DB::table('eventlikes')->where('event_id', '=', $event->id)->take(10)->get();
				if(count($alllikes) > 0):
				foreach ($alllikes as $eventlike) :
					$uid = $eventlike->author_id;
					$user_profile = DB::table('user_meta')->where('user_id', $uid)->where('meta_key', 'profile')->get();
					if(count($user_profile) > 0):
			?>
						<div class="eventlikeprofile">
							<div class="top-profile" style="background: url(<?php echo url()."/".$user_profile[0]->meta_value;?>) center center no-repeat; background-size: cover; width: 50px; height: 50px; border-radius: 50px"></div>
						</div>
					<?php else: ?>
						<div class="eventlikeprofile">
							<div class="top-profile" style="width: 50px; height: 50px; line-height: 50px;">{{ getFirstCharter(Auth::user()->name) }}</div>
						</div>
			<?php endif; endforeach;endif;?>
			</div>
			<!-- <hr>
			<h2>Attentees</h2> -->
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
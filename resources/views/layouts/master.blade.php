<!DOCTYPE html>
<html lang="en" ng-app="ogpApp">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="_token" content="{{ csrf_token() }}"/>
	<title>OH GOOD PARTY</title>

	<link href="{{ asset('/css/app.css') }}" rel="stylesheet">

	<!-- Fonts -->
	<link href='http://fonts.googleapis.com/css?family=Righteous' rel='stylesheet' type='text/css'>

	<link href='http://fonts.googleapis.com/css?family=Lato:300,400,700' rel='stylesheet' type='text/css'>

	<link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css">

	<link href="{{ asset('/css/fileinput.css') }}" rel="stylesheet">

	<link href="{{ asset('/css/jquery.fancybox.css') }}" rel="stylesheet">

	<link href="{{ asset('/css/flexslider.css') }}" rel="stylesheet">

	<link href="{{ asset('/css/bootstrap-datetimepicker.min.css') }}" rel="stylesheet">

	<link href="{{ asset('/css/bootstrap-switch.min.css') }}" rel="stylesheet">

	<link href="{{ asset('/css/build.css') }}" rel="stylesheet">	

	<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>

	<!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
	<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
	<!--[if lt IE 9]>
		<script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
		<script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
	<![endif]-->
</head>
<body>
	<nav class="navbar navbar-default">
		<div class="container-fluid">
			<div class="navbar-header">
				<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
					<span class="sr-only">Toggle Navigation</span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
				</button>
				<ul class="nav navbar-nav navbar-right mobile quickmenu">
					@if (Auth::check())
					<?php
							$id = Auth::user()->id;
							$mygroup = myGroup($id);
						?>
					@if ( count(myGroup($id)) > 0 )
						<li class="dropdown">
							<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><img src="{{ asset('/img/edit_icon.png') }}" alt="English" width="22" /></a>
							<ul class="dropdown-menu" role="menu">
								<li><a href="<?php echo url(); ?>/groups/<?php echo $mygroup[0]->slug; ?>/posts/new">Quick Post</a></li>
								<li><a href="<?php echo url(); ?>/groups/<?php echo $mygroup[0]->slug; ?>/events/new">Quick Event</a></li>
							</ul>
						</li>
					@else
						<li class="dropdown">
						<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><img src="{{ asset('/img/create_brand_icon.png') }}" alt="Create Brand" width="24" /></a>
						<ul class="dropdown-menu" role="menu">
							<li><a href="<?php echo url(); ?>/groups/new">{{ trans('headermenu.createBrand') }}</a></li>
						</ul>
					</li>
					@endif
					<li class="dropdown">
							<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><img src="{{ asset('/img/search.png') }}" alt="Search Icon" width="22" /></a>
							<ul class="dropdown-menu search-dropdown" role="menu" style="right: -120px;">
								<li><form id="searchform" action="{{ URL::route('search') }}"><input type="text" name="q" placeholder="Search OGP"></form></li>
							</ul>
						</li>
					@endif
					<li class="dropdown">
							<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
							@if(App::getLocale() == 'en')
								<img src="{{ asset('/img/en_icon.png') }}" alt="English" width="22" />
							@else
								<img src="{{ asset('/img/en_icon.png') }}" alt="Chinese" width="22" />
							@endif
							</a>
							<ul class="dropdown-menu" role="menu">
								@if(App::getLocale() == 'en')
									<li><a href="{{  url() }}/lang/zh">中文</a></li>
								@else
									<li><a href="{{  url() }}/lang/en">English</a></li>
								@endif
							</ul>
						</li>
					@if (Auth::guest())
						<li><a href="{{ url('/auth/login') }}">{{ trans('headermenu.signin') }}</a></li>
						<li><a href="{{ url('/auth/register') }}">{{ trans('headermenu.signup') }}</a></li>
					@else
						<li class="dropdown">
							<?php $id = Auth::user()->id; $user_profile = DB::table('user_meta')->where('user_id', $id)->where('meta_key', 'profile')->get();?>
							<a href="#" class="dropdown-toggle profile-dropdown" data-toggle="dropdown" role="button" aria-expanded="false">
							<?php if(count($user_profile) > 0): ?>
								<div class="top-profile" style="background: url(<?php echo url()."/".$user_profile[0]->meta_value;?>) center center no-repeat; background-size: cover"></div>
							<?php else: ?>
								<div class="top-profile"><?php echo getFirstCharter(Auth::user()->name);?></div>
							<?php endif; ?>
							</a>
							<ul class="dropdown-menu" role="menu">
								<li><a href="{{ url('/dashboard') }}">Dashboard</a></li>
								<li><a href="#">Feedback</a></li>
								<li><a href="#">Notifications</a></li>
								<li><a href="{{ url('/auth/logout') }}">Logout</a></li>
							</ul>
						</li>
					@endif
				</ul>
				
				<a class="navbar-brand" href="{{ url('/') }}"><img src="{{ asset('/img/logo.png') }}" alt="Oh Good Party" width="30"></a>
			</div>

			<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
				<ul class="nav navbar-nav">
					@if (Auth::guest())
					<li><a href="{{ url('/') }}">OGP</a></li>
					@else
					<li><a href="{{ url('/home') }}">OGP</a></li>
					@endif
					<li><a href="{{ url('/groups') }}">{{ trans('headermenu.brands') }}</a></li>
					<li><a href="{{ url('/events') }}">{{ trans('headermenu.events') }}</a></li>
					<!-- <li><a href="{{ url('/missions') }}">MISSIONS</a></li> -->
				</ul>

				<ul class="nav navbar-nav navbar-right desktop quickmenu">
					@if (Auth::check())
					<?php
							$id = Auth::user()->id;
							$mygroup = myGroup($id);
						?>
					@if ( count(myGroup($id)) > 0 )
						<li class="dropdown">
							<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><img src="{{ asset('/img/edit_icon.png') }}" alt="English" width="22" /></a>
							<ul class="dropdown-menu" role="menu">
								<li><a href="<?php echo url(); ?>/groups/<?php echo $mygroup[0]->slug; ?>/posts/new">Quick Post</a></li>
								<li><a href="<?php echo url(); ?>/groups/<?php echo $mygroup[0]->slug; ?>/events/new">Quick Event</a></li>
							</ul>
						</li>
					@else
						<li class="dropdown">
						<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><img src="{{ asset('/img/create_brand_icon.png') }}" alt="Create Brand" width="24" /></a>
						<ul class="dropdown-menu" role="menu">
							<li><a href="<?php echo url(); ?>/groups/new">{{ trans('headermenu.createBrand') }}</a></li>
						</ul>
					</li>
					@endif
					<li class="dropdown">
							<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><img src="{{ asset('/img/search.png') }}" alt="Search Icon" width="22" /></a>
							<ul class="dropdown-menu search-dropdown" role="menu">
								<li><form id="searchform" action="{{ URL::route('search') }}"><input type="text" name="q" placeholder="Search OGP"></form></li>
							</ul>
						</li>
					@endif
					<li class="dropdown">
							<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
							@if(App::getLocale() == 'en')
								<img src="{{ asset('/img/en_icon.png') }}" alt="English" width="22" />
							@else
								<img src="{{ asset('/img/en_icon.png') }}" alt="Chinese" width="22" />
							@endif
							</a>
							<ul class="dropdown-menu" role="menu">
								@if(App::getLocale() == 'en')
									<li><a href="{{  url() }}/lang/zh">中文</a></li>
								@else
									<li><a href="{{  url() }}/lang/en">English</a></li>
								@endif
							</ul>
						</li>
					@if (Auth::guest())
						<li><a href="{{ url('/auth/login') }}">{{ trans('headermenu.signin') }}</a></li>
						<li><a href="{{ url('/auth/register') }}">{{ trans('headermenu.signup') }}</a></li>
					@else
						<li class="dropdown">
							<?php $id = Auth::user()->id; $user_profile = DB::table('user_meta')->where('user_id', $id)->where('meta_key', 'profile')->get();?>
							<a href="#" class="dropdown-toggle profile-dropdown" data-toggle="dropdown" role="button" aria-expanded="false">
							<?php if(count($user_profile) > 0): ?>
								<div class="top-profile" style="background: url(<?php echo url()."/".$user_profile[0]->meta_value;?>) center center no-repeat; background-size: cover"></div>
							<?php else: ?>
								<div class="top-profile"><?php echo getFirstCharter(Auth::user()->name);?></div>
							<?php endif; ?>
							</a>
							<ul class="dropdown-menu" role="menu">
								<li><a href="{{ url('/dashboard') }}">Dashboard</a></li>
								<li><a href="#">Feedback</a></li>
								<li><a href="#">Notifications</a></li>
								<li><a href="{{ url('/auth/logout') }}">Logout</a></li>
							</ul>
						</li>
					@endif
				</ul>
			</div>
		</div>
	</nav>
	<section class="site-container">
		@yield('content')
	</section>
	<!-- Scripts -->
	<script src="//cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.1/js/bootstrap.min.js"></script>
	<script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.4.5/angular.min.js"></script>
	<script src="{{ asset('/js/fileinput.min.js') }}"></script>
	<script src="{{ asset('/js/bootstrap-datetimepicker.min.js') }}"></script>
	<script src="{{ asset('/js/bootstrap-switch.min.js') }}"></script>
	<script src="{{ asset('/js/jquery.fancybox.pack.js') }}"></script>
	<script src="{{ asset('/js/jquery.flexslider-min.js') }}"></script>
	<!--<script src="{{ asset('/js/validator.min.js') }}"></script>-->
	<script src="http://ajax.aspnetcdn.com/ajax/jquery.validate/1.14.0/jquery.validate.min.js"></script>
	<script src="{{ asset('/js/main.js') }}"></script>
	<script type="text/javascript">
			$('.right a.facebook').on('click', function(e){
				e.preventDefault();
				window.open('https://www.facebook.com/dialog/feed?app_id=866884463391641&display=page&link='+encodeURIComponent('<?php echo url();?>')+'&caption=OhGoodParty&description='+encodeURIComponent('Share this article')+'&redirect_uri=https://www.facebook.com', "_blank", "width=800, height=600");
			})
	</script>
	<script type="text/javascript">
	//angular app
	var ogpApp = angular.module('ogpApp', []);
    ogpApp.controller('CountryController', function ($scope) {
        $scope.countries = [{
	        "name": "USA",
	        "id": 1
	      },{
	        "name": "Canada",
	        "id": 2
	    }];
	    $scope.states = [{
	        "name": "Alabama",
	        "id": 1,
	        "countryId": 1
	      }, {
	        "name": "Alaska",
	        "id": 2,
	        "countryId": 1
	      }, {
	        "name": "Arizona",
	        "id": 3,
	        "countryId": 1
	      }, {
	        "name": "Alberta",
	        "id": 4,
	        "countryId": 2
	      }, {
	        "name": "British columbia",
	        "id": 5,
	        "countryId": 2
	    }];
	    
	    $scope.updateCountry = function(){
	      $scope.availableStates = [];
	      
	      angular.forEach($scope.states, function(value){
	        if(value.countryId == $scope.country.id){
	          $scope.availableStates.push(value);
	        }
	      });
	    }
    })

</script>
</body>
</html>

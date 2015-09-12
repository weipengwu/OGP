<!DOCTYPE html>
<html lang="en">
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
				<a class="navbar-brand" href="{{ url('/') }}"><img src="{{ asset('/img/logo.png') }}" alt="Oh Good Party" width="30"></a>
			</div>

			<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
				<ul class="nav navbar-nav">
					@if (Auth::guest())
					<li><a href="{{ url('/') }}">OGP</a></li>
					@else
					<li><a href="{{ url('/home') }}">OGP</a></li>
					@endif
					<li><a href="{{ url('/groups') }}">BRAND</a></li>
					<li><a href="{{ url('/events') }}">EVENTS</a></li>
					<!-- <li><a href="{{ url('/missions') }}">MISSIONS</a></li> -->
				</ul>

				<ul class="nav navbar-nav navbar-right">
					@if (Auth::check())
					<li class="dropdown">
							<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><img src="{{ asset('/img/search.png') }}" alt="English" width="22" /></a>
							<ul class="dropdown-menu search-dropdown" role="menu">
								<li><form id="searchform" action="{{ URL::route('search') }}"><input type="text" name="q" placeholder="Search OGP"></form></li>
							</ul>
						</li>
					@endif
					<li class="dropdown">
							<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><img src="{{ asset('/img/en_icon.png') }}" alt="English" width="22" /></a>
							<ul class="dropdown-menu" role="menu">
								<li><a href="#">中文</a></li>
								<li><a href="#">Français</a></li>
								<li><a href="#">Español</a></li>
							</ul>
						</li>
					@if (Auth::guest())
						<li><a href="{{ url('/auth/login') }}">SIGN IN</a></li>
						<li><a href="{{ url('/auth/register') }}">SIGN UP</a></li>
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
	<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
	<script src="//cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.1/js/bootstrap.min.js"></script>
	<script src="{{ asset('/js/fileinput.min.js') }}"></script>
	<script src="{{ asset('/js/bootstrap-datetimepicker.min.js') }}"></script>
	<script src="{{ asset('/js/bootstrap-switch.min.js') }}"></script>
	<script src="{{ asset('/js/jquery.fancybox.pack.js') }}"></script>
	<script src="{{ asset('/js/jquery.flexslider-min.js') }}"></script>
	<script src="{{ asset('/js/main.js') }}"></script>
	<script type="text/javascript">
			$('.right a.facebook').on('click', function(e){
				e.preventDefault();
				window.open('https://www.facebook.com/dialog/feed?app_id=866884463391641&display=page&link='+encodeURIComponent('<?php echo url();?>')+'&caption=OhGoodParty&description='+encodeURIComponent('Share this article')+'&redirect_uri=https://www.facebook.com', "_blank", "width=800, height=600");
			})
	</script>
</body>
</html>

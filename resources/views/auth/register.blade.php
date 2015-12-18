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

	<link href="{{ asset('/css/bootstrap-datetimepicker.min.css') }}" rel="stylesheet">

	<link href="{{ asset('/css/bootstrap-switch.min.css') }}" rel="stylesheet">

	<!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
	<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
	<!--[if lt IE 9]>
		<script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
		<script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
	<![endif]-->
</head>
<body class="login-body" style="background: url(<?php echo url();?>/img/cover<?php echo rand(1,3);?>.jpg) no-repeat center center fixed; background-size: cover;">
	<nav class="navbar navbar-default" style="background: transparent; border: 0; position: relative">
		<div class="container-fluid">
			<div class="navbar-header">

			</div>

			<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">


				<ul class="nav navbar-nav navbar-right">
					@if(App::getLocale() == 'en')
						<li><a href="{{  url() }}/lang/zh" class="login-lang">中文</a></li>
					@else
						<li><a href="{{  url() }}/lang/en" class="login-lang">English</a></li>
					@endif
					<li><a href="/" class="login-explore"><i class="fa fa-compass"></i> Explore OGP</a></li>
					<li><a href="{{ url('/auth/login') }}" id="login-in">{{ trans('headermenu.signin') }}</a></li>
					<li><a href="{{ url('/auth/register') }}" id="login-up">{{ trans('headermenu.signup') }}</a></li>	
				</ul>
			</div>
		</div>
	</nav>
	<section class="site-container">
<div class="container-fluid login" style="margin: 0">
	<div class="row">
		<div class="col-md-4 col-md-offset-4">
			<div class="panel" style="background: transparent">
				<div class="panel-heading">
					<div class="logoslogan">
						<img src="{{ asset('img/logo_transparent.png') }}" width="70">
						<h1>OH GOOD PARTY</h1>
						<h2>Brand Strategy & Innovation Community</h2>
					</div>
					<!-- <h3>SIGN UP TO OH GOOD PARTY</h3> -->
					<!-- <p class="gotosignin">Already have an account? <a href="url('/auth/login') ">Sign in</a></p> -->
				</div>
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

					<form class="form-horizontal" role="form" method="POST" id="loginpageform" action="{{ url('/auth/register') }}">
						<input type="hidden" name="_token" value="{{ csrf_token() }}">

						<div class="form-group">
							<input type="text" class="form-control" name="name" value="{{ old('name') }}" placeholder="Username">
						</div>

						<div class="form-group">
							<input type="email" class="form-control" name="email" value="{{ old('email') }}" placeholder="Email Address">
						</div>

						<div class="form-group">
							<input type="password" class="form-control" name="password" placeholder="Password">
						</div>

						<div class="form-group">
							<input type="password" class="form-control" name="password_confirmation" placeholder="Confirm Password">
						</div>

						<!-- <div class="othersocials">
							<p>Sign up faster by connecting your social network</p>
							<a href="" class="social_icons social_tw"><i class="fa fa-twitter"></i></a> <a href="" class="social_icons social_fb"><i class="fa fa-facebook"></i></a> <a href="" class="social_icons social_wc"><i class="fa fa-wechat"></i></a> <a href="" class="social_icons social_wb"><i class="fa fa-weibo"></i></a>
						</div> -->

						<div class="form-group">
								<button type="submit" class="btn btn-logo">
									{{ trans('headermenu.signup') }}
								</button>
						</div>
						<div class="privacy">
						By continue you agree to OH GOOD PARTY's <a href="">Terms of Use</a>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
</div>
</section>
	<!-- Scripts -->
	<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
	<script src="//cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.1/js/bootstrap.min.js"></script>
	<script src="{{ asset('/js/fileinput.min.js') }}"></script>
	<script src="{{ asset('/js/bootstrap-datetimepicker.min.js') }}"></script>
	<script src="{{ asset('/js/bootstrap-switch.min.js') }}"></script>
	<script src="{{ asset('/js/tinymce/tinymce.min.js') }}"></script>
	<script src="{{ asset('/js/main.js') }}"></script>
</body>
</html>

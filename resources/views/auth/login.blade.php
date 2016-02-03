<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="_token" content="{{ csrf_token() }}"/>
	<title>OH GOOD PARTY</title>
	<!-- Favicon -->
	<link rel="apple-touch-icon" sizes="57x57" href="/apple-icon-57x57.png">
	<link rel="apple-touch-icon" sizes="60x60" href="/apple-icon-60x60.png">
	<link rel="apple-touch-icon" sizes="72x72" href="/apple-icon-72x72.png">
	<link rel="apple-touch-icon" sizes="76x76" href="/apple-icon-76x76.png">
	<link rel="apple-touch-icon" sizes="114x114" href="/apple-icon-114x114.png">
	<link rel="apple-touch-icon" sizes="120x120" href="/apple-icon-120x120.png">
	<link rel="apple-touch-icon" sizes="144x144" href="/apple-icon-144x144.png">
	<link rel="apple-touch-icon" sizes="152x152" href="/apple-icon-152x152.png">
	<link rel="apple-touch-icon" sizes="180x180" href="/apple-icon-180x180.png">
	<link rel="icon" type="image/png" sizes="192x192"  href="/android-icon-192x192.png">
	<link rel="icon" type="image/png" sizes="32x32" href="/favicon-32x32.png">
	<link rel="icon" type="image/png" sizes="96x96" href="/favicon-96x96.png">
	<link rel="icon" type="image/png" sizes="16x16" href="/favicon-16x16.png">
	<link rel="manifest" href="/manifest.json">
	<meta name="msapplication-TileColor" content="#ffffff">
	<meta name="msapplication-TileImage" content="/ms-icon-144x144.png">
	<meta name="theme-color" content="#ffffff">

	<link href="{{ asset('/css/app.css') }}" rel="stylesheet">

	<!-- Fonts -->
	<link href='http://fonts.googleapis.com/css?family=Righteous' rel='stylesheet' type='text/css'>

	<link href='http://fonts.googleapis.com/css?family=Lato:300,400,700' rel='stylesheet' type='text/css'>

	<link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css">

	<link href="{{ asset('/css/fileinput.css') }}" rel="stylesheet">

	<link href="{{ asset('/css/bootstrap-datetimepicker.min.css') }}" rel="stylesheet">

	<!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
	<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
	<!--[if lt IE 9]>
		<script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
		<script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
	<![endif]-->
</head>
<body class="login-body" style="background: #666 url(<?php echo url();?>/img/cover-<?php echo rand(1,10);?>.jpg) no-repeat center center fixed; background-size: cover;">
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
					<li><a href="/" class="login-explore"><i class="fa fa-compass"></i> {{ trans('auth.exploreogp') }}</a></li>
					<li><a href="{{ url('/auth/login') }}" id="login-in">{{ trans('headermenu.signin') }}</a></li>
					<li><a href="{{ url('/auth/register') }}" id="login-up">{{ trans('headermenu.signup') }}</a></li>	
				</ul>
			</div>
		</div>
	</nav>
	<section class="site-container">
		<div class="container-fluid login">
	<div class="row">
		<div class="col-md-4 col-md-offset-4">
			<div class="panel" style="background: transparent">
				<div class="panel-heading">
					<div class="logoslogan">
						<img src="{{ asset('img/logo_transparent.png') }}" width="70">
						<h1>{{ trans('auth.ohgoodparty') }}</h1>
						<h2>{{ trans('auth.brandstrategy') }}</h2>
					</div>
					<!-- <h3>SIGN IN TO OH GOOD PARTY</h3> -->
				</div>
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

					<form class="form-horizontal" role="form" method="POST" id="loginpageform" action="{{ url('/auth/login') }}">
						<input type="hidden" name="_token" value="{{ csrf_token() }}">

						<div class="form-group">
							<input type="email" class="form-control" name="email" value="{{ old('email') }}" placeholder="{{ trans('auth.email') }}">
						</div>

						<div class="form-group">
							<input type="password" class="form-control" name="password" placeholder="{{ trans('auth.password') }}">
						</div>

						<div class="form-group">
							<button type="submit" class="btn btn-logo">{{ trans('headermenu.signin') }}</button>
						</div>
						<div class="form-group">
							<a class="forget" href="{{ url('/password/email') }}">{{ trans('auth.forgotyourpassword') }}</a>

						</div>
						<div class="privacy">
						@if(App::getLocale() == 'en')
							By continue you agree to OH GOOD PARTY\'s <a href="http://about.ohgoodparty.com/terms.html">Terms of Use</a>
						@else
							继续代表您同意遵守奥格派的<a href="http://about.ohgoodparty.com/terms-cn.html">使⽤条款</a>
						@endif
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
	<script src="{{ asset('/js/jstz.min.js') }}"></script>
	<script src="{{ asset('/js/main.js') }}"></script>
</body>
</html>


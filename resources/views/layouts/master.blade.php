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

	<link href="{{ asset('/css/jquery.fancybox.css') }}" rel="stylesheet">

	<link href="{{ asset('/css/bootstrap-datetimepicker.min.css') }}" rel="stylesheet">

	<link href="{{ asset('/css/build.css') }}" rel="stylesheet">

	<link href="{{ asset('/css/jquery.bxslider.css') }}" rel="stylesheet">	

	<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>

	<script src="{{ asset('/js/jstz.min.js') }}"></script>

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
								<li><a href="<?php echo url(); ?>/brands/<?php echo $mygroup[0]->slug; ?>/posts/new">{{ trans('headermenu.quickpost') }}</a></li>
								<li><a href="<?php echo url(); ?>/brands/<?php echo $mygroup[0]->slug; ?>/events/new">{{ trans('headermenu.quickevent') }}</a></li>
							</ul>
						</li>
					@else
						<li class="dropdown">
						<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><img src="{{ asset('/img/create_brand_big_icon.png') }}" alt="Create Brand" width="24" /></a>
						<ul class="dropdown-menu" role="menu">
							<li><a href="<?php echo url(); ?>/brands/new">{{ trans('headermenu.createBrand') }}</a></li>
						</ul>
					</li>
					@endif
					<li class="dropdown">
							<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><img src="{{ asset('/img/search.png') }}" alt="Search Icon" width="22" /></a>
							<ul class="dropdown-menu search-dropdown" role="menu" style="right: -150px;">
								<li><form id="searchform" action="{{ URL::route('search') }}"><input type="text" name="q" placeholder="{{ trans('headermenu.searchogp') }}"></form></li>
							</ul>
						</li>
					@endif
					<li class="dropdown">
							<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
							@if(App::getLocale() == 'en')
								<img src="{{ asset('/img/en_icon.png') }}" alt="English" width="22" />
							@else
								<img src="{{ asset('/img/zh_icon.png') }}" alt="Chinese" width="22" />
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
								<div class="top-profile" style="background: url(<?php echo url()."/uploads/Small_".$user_profile[0]->meta_value;?>) center center no-repeat; background-size: cover"></div>
							<?php else: ?>
								<div class="top-profile"><?php echo getFirstCharter(Auth::user()->name);?></div>
							<?php endif; ?>
							</a>
							<ul class="dropdown-menu" role="menu">
								<li><a href="{{ url('/dashboard') }}">{{ trans('headermenu.dashboard') }}</a></li>
								<li><a href="http://about.ohgoodparty.com#contacts" target="_blank">{{ trans('headermenu.feedback') }}</a></li>
								@if(App::getLocale() == 'en')
									<li><a href="http://about.ohgoodparty.com/tutorials.html">Tutorial</a></li>
								@else
									<li><a href="http://about.ohgoodparty.com/tutorials-cn.html">指引</a></li>
								@endif
								<!-- <li><a href="#">Notifications</a></li> -->
								<li><a href="{{ url('/auth/logout') }}">{{ trans('headermenu.logout') }}</a></li>
							</ul>
						</li>
					@endif
				</ul>
				
				<a class="navbar-brand" href="{{ url('/') }}"><img src="{{ asset('/img/logo.png') }}" alt="Oh Good Party" width="30"></a>
			</div>

			<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
				<ul class="nav navbar-nav">
					@if (Auth::guest())
					<li><a href="{{ url('/') }}">{{ trans('headermenu.ogp') }}</a></li>
					@else
					<li><a href="{{ url('/home') }}">{{ trans('headermenu.ogp') }}</a></li>
					@endif
					<li><a href="{{ url('/brands') }}">{{ trans('headermenu.explorebrands') }}</a></li>
					<li><a href="{{ url('/events') }}">{{ trans('headermenu.discoverevents') }}</a></li>
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
								<li><a href="<?php echo url(); ?>/brands/<?php echo $mygroup[0]->slug; ?>/posts/new">{{ trans('headermenu.quickpost') }}</a></li>
								<li><a href="<?php echo url(); ?>/brands/<?php echo $mygroup[0]->slug; ?>/events/new">{{ trans('headermenu.quickevent') }}</a></li>
							</ul>
						</li>
					@else
						<li class="dropdown">
						<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><img src="{{ asset('/img/create_brand_big_icon.png') }}" alt="Create Brand" width="24" /></a>
						<ul class="dropdown-menu" role="menu">
							<li><a href="<?php echo url(); ?>/brands/new">{{ trans('headermenu.createBrand') }}</a></li>
						</ul>
					</li>
					@endif
					<li class="dropdown">
							<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><img src="{{ asset('/img/search.png') }}" alt="Search Icon" width="22" /></a>
							<ul class="dropdown-menu search-dropdown" role="menu">
								<li><form id="searchform" action="{{ URL::route('search') }}"><input type="text" name="q" placeholder="{{ trans('headermenu.searchogp') }}"></form></li>
							</ul>
						</li>
					@endif
					<li class="dropdown">
							<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
							@if(App::getLocale() == 'en')
								<img src="{{ asset('/img/en_icon.png') }}" alt="English" width="22" />
							@else
								<img src="{{ asset('/img/zh_icon.png') }}" alt="Chinese" width="22" />
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
								<div class="top-profile" style="background: url(<?php echo url()."/uploads/Small_".$user_profile[0]->meta_value;?>) center center no-repeat; background-size: cover"></div>
							<?php else: ?>
								<div class="top-profile"><?php echo getFirstCharter(Auth::user()->name);?></div>
							<?php endif; ?>
							</a>
							<ul class="dropdown-menu" role="menu">
								<li><a href="{{ url('/dashboard') }}">{{ trans('headermenu.dashboard') }}</a></li>
								<li><a href="http://about.ohgoodparty.com#contacts" target="_blank">{{ trans('headermenu.feedback') }}</a></li>
								@if(App::getLocale() == 'en')
									<li><a href="http://about.ohgoodparty.com/tutorials.html">Tutorial</a></li>
								@else
									<li><a href="http://about.ohgoodparty.com/tutorials-cn.html">指引</a></li>
								@endif
								<!-- <li><a href="#">Notifications</a></li> -->
								<li><a href="{{ url('/auth/logout') }}">{{ trans('headermenu.logout') }}</a></li>
							</ul>
						</li>
					@endif
				</ul>
				@if (Auth::check())
					<div class="hint">
						<div class="hintbody">
						<div class="hinttop">
						Tip 1 of 2
						</div>
						Use this menu to manage your brand, explore the site, and share your experience.
						</div>
						<div class="hintbottom">
							<a class="hintnext" href="">Next</a>
						</div>
					</div>
					<div class="hint2">
						<div class="hintbody">
						<div class="hinttop">
						Tip 2 of 2
						</div>
						Use this button to personalize your experience.
						</div>
						<div class="hintbottom">
							<a class="hintnext" href="http://about.ohgoodparty.com/tutorials.html" target="_blank">Learn More</a>
						</div>
					</div>
				@endif
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
	<script src="{{ asset('/js/jquery.fancybox.pack.js') }}"></script>
	<script src="{{ asset('/js/jquery.bxslider.min.js') }}"></script>
	<script src="http://ajax.aspnetcdn.com/ajax/jquery.validate/1.14.0/jquery.validate.min.js"></script>
	@if(Config::get('app.locale') == 'zh')
	<script src="{{ asset('/js/messages_zh.js') }}"></script>
	@endif

	<script src="{{ asset('/js/main.js') }}"></script>
	<script type="text/javascript">
		$(document).ready(function(){
			$('body').on('click', '.event_like', function(e){
				e.preventDefault();
				$.ajaxSetup({
				   headers: { 'X-CSRF-Token' : $('meta[name=_token]').attr('content') }
				});
				var that = $(this);
				var eid = $(this).data('event-id');
				var uid = $(this).data('author-id');
				$.ajax({
					type: "POST",
					url: window.location.origin+"/event/like",
					data: "event-id="+eid+'&author-id='+uid
				}).done(function(response){
					that.removeClass('event_like');
					that.addClass('event_unlike');
					that.html('<img src="../img/already_likes_icon.png" width="16">');
					$('.leftlikenum').html(response+' {{ trans("events.interested") }}');
					that.parent().next().html(response);
				})
			})
			$('body').on('click', '.event_unlike', function(e){
				e.preventDefault();
				$.ajaxSetup({
				   headers: { 'X-CSRF-Token' : $('meta[name=_token]').attr('content') }
				});
				var that = $(this);
				var eid = $(this).data('event-id');
				var uid = $(this).data('author-id');
				$.ajax({
					type: "POST",
					url: window.location.origin+"/event/unlike",
					data: "event-id="+eid+'&author-id='+uid
				}).done(function(response){
					that.removeClass('event_unlike');
					that.addClass('event_like');
					that.html('<img src="../img/likes_icon.png" width="16">');
					$('.leftlikenum').html(response+' {{ trans("events.interested") }}');
					that.parent().next().html(response);
				})
			})
			$('body').on('click', '.follow_group', function(e){
				e.preventDefault();
				$.ajaxSetup({
				   headers: { 'X-CSRF-Token' : $('meta[name=_token]').attr('content') }
				});
				var userid = $(this).data('user-id');
				var groupid = $(this).data('group-id');
				$.ajax({
					type: "POST",
					url: window.location.origin+"/brands/follow",
					data: "uid="+userid+'&gid='+groupid
				}).done(function(response){
				
						$('.follow_btn').removeClass('follow_group');
						$('.follow_btn').addClass('unfollow_group');
						$('.follow_btn').html('{{ trans("brands.following") }}');
						$('.groupfollow span a').removeClass('follow_group');
						$('.groupfollow span a').addClass('unfollow_group');
						$('.groupfollow span a').html('<img src="../img/unfollow_big_icon.png" width="20">');
						if(response > 1){
							$('.followerNumber').html(response+' {{ trans("brands.followers") }}');
						}else{
							$('.followerNumber').html(response+' {{ trans("brands.follower") }}');
						}
					
				})
			})
			$('body').on('click', '.unfollow_group', function(e){
				e.preventDefault();
				$.ajaxSetup({
				   headers: { 'X-CSRF-Token' : $('meta[name=_token]').attr('content') }
				});
				var userid = $(this).data('user-id');
				var groupid = $(this).data('group-id');
				$.ajax({
					type: "POST",
					url: window.location.origin+"/brands/unfollow",
					data: "uid="+userid+'&gid='+groupid
				}).done(function(response){
					
						$('.follow_btn').removeClass('unfollow_group');
						$('.follow_btn').addClass('follow_group');
						$('.follow_btn').html('{{ trans("brands.follow") }}');
						$('.groupfollow span a').removeClass('unfollow_group');
						$('.groupfollow span a').addClass('follow_group');
						$('.groupfollow span a').html('<img src="../img/follow_big_icon.png" width="20">');
						if(response > 1){
							$('.followerNumber').html(response+' {{ trans("brands.followers") }}');
						}else{
							$('.followerNumber').html(response+' {{ trans("brands.follower") }}');
						}
					
				})
			})
			$('.showall a').on('click', function(e){
				e.preventDefault();
				if($('.joinedgroups .groupsrow').hasClass('collapsed')){
					$('.joinedgroups .groupsrow').removeClass('collapsed');
					$('.joinedgroups .groupsrow').addClass('expanded');
					$(this).html('{{ trans("general.collapseall") }}');
				}else{
					$('.joinedgroups .groupsrow').removeClass('expanded');
					$('.joinedgroups .groupsrow').addClass('collapsed');
					$(this).html('{{ trans("brands.showall") }}');
				}
			})

			$('.brandsshowall a').on('click', function(e){
				e.preventDefault();
				if($(this).parent().prev().hasClass('collapsed')){
					$(this).parent().prev().removeClass('collapsed');
					$(this).parent().prev().addClass('expanded');
					$(this).html('{{ trans("general.collapseall") }}');
				}else{
					$(this).parent().prev().removeClass('expanded');
					$(this).parent().prev().addClass('collapsed');
					$(this).html('{{ trans("brands.showall") }}');
				}
			})
			$('#g-profile').fileinput({
				previewFileType: "image",
				browseClass: "btn btn-success",
				browseLabel: "{{ trans('events.pickimage') }}",
				browseIcon: '<i class="glyphicon glyphicon-picture"></i>',
				removeClass: "btn btn-danger",
				removeLabel: "Delete",
				removeIcon: '<i class="glyphicon glyphicon-trash"></i>',
				showUpload: false,
			});
			$('#u-profile').fileinput({
				previewFileType: "image",
				browseClass: "btn btn-success",
				browseLabel: "{{ trans('events.pickimage') }}",
				browseIcon: '<i class="glyphicon glyphicon-picture"></i>',
				removeClass: "btn btn-danger",
				removeLabel: "Delete",
				removeIcon: '<i class="glyphicon glyphicon-trash"></i>',
				showUpload: false,
			});
			$('#banner').fileinput({
				previewFileType: "image",
				browseClass: "btn btn-success",
				browseLabel: "{{ trans('events.pickimage') }}",
				browseIcon: '<i class="glyphicon glyphicon-picture"></i>',
				removeClass: "btn btn-danger",
				removeLabel: "Delete",
				removeIcon: '<i class="glyphicon glyphicon-trash"></i>',
				showUpload: false,
			});
			$('#g-banner').fileinput({
				previewFileType: "image",
				browseClass: "btn btn-success",
				browseLabel: "{{ trans('events.pickimage') }}",
				browseIcon: '<i class="glyphicon glyphicon-picture"></i>',
				removeClass: "btn btn-danger",
				removeLabel: "Delete",
				removeIcon: '<i class="glyphicon glyphicon-trash"></i>',
				showUpload: false,
			});

		})

	</script>
<script>
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

  ga('create', 'UA-75615748-1', 'auto');
  ga('send', 'pageview');

</script>
</body>
</html>

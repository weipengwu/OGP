@extends('layouts.master')

@section('content')
	<div class="container admin">
		@if(Auth::id() == '1' || Auth::id() == '4')
		<div class="row">
			<aside class="col-md-3">
				<ul>
					<li><a href="{{ url() }}/adminogp">Dashboard</a></li>
					<li><a href="{{ url() }}/adminogp/users">Users</a></li>
					<li><a href="{{ url() }}/adminogp/brands">Brands</a></li>
					<li><a href="{{ url() }}/adminogp/posts">Posts</a></li>
					<li><a href="{{ url() }}/adminogp/tickets">Tickets</a></li>
				</ul>
			</aside>
			<section class="col-md-9">
				<h2>Admin Dashboard</h2>
				<?php
					$users = DB::table('users')->count();
					$active = DB::table('groups')->where('verified', '1')->count();
					$pending = DB::table('groups')->where('verified', '!=','1')->count();
				?>
				<p>Current User: {{ $users }}</p>
				<p>Active Brands: {{ $active }}</p>
				<p>Pending Brands: {{ $pending }}</p>
				<!-- <p>Sold Tickets: </p> -->
			</section>
		</div>
		@else
			<h4>You should not be here!</h4>
		@endif
	</div>

@endsection
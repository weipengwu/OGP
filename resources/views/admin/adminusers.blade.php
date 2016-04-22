@extends('layouts.master')

@section('content')
	<div class="container admin">
		@if(Auth::id() == '1' || Auth::id() == '20' || Auth::id() == '74')
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
				<h2>Admin/Users</h2>
				<table class="table table-striped">
					<tbody>
						<tr>
							<td><strong>ID</strong></td>
							<td><strong>Name</strong></td>
							<td><strong>Email</strong></td>
						</tr>
						@foreach($users as $user)
							<tr>
								<td>{{ $user->id }}</td>
								<td>{{ $user->name }}</td>
								<td>{{ $user->email }}</td>
							</tr>
						@endforeach
					</tbody>
				</table>
			</section>
		</div>
		@else
			<h4>You should not be here!</h4>
		@endif
	</div>

@endsection
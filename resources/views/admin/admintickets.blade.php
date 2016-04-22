@extends('layouts.master')

@section('content')
	<div class="container admin">
		@if(Auth::id() == '1')
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
				<h2>Admin/Tickets</h2>
				<table class="table table-striped">
					<tbody>
						<tr>
							<td><strong>Event</strong></td>
							<td><strong>Customer</strong></td>
							<td><strong>Ticket Number</strong></td>
							<td><strong>Status</strong></td>
						</tr>
						@foreach($tickets as $ticket)
							<tr>
								<td>{{ getEventTitle($ticket->event_id) }}</td>
								<td>{{ getAuthorname($ticket->user_id) }}</td>
								<td>{{ $ticket->ticket_number }}</td>
								<td>{{ $ticket->status }}</td>
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
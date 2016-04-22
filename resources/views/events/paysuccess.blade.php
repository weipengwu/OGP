@extends('layouts.master')

@section('content')

	<div class="container center" id="paymessege">
		<h2>Thank you!</h2>
		<h3>A confirmation email has been sent to {{ Auth::user()->email }}</h3>

		@if (Auth::guest())
			<a href="/" class="btn btn-logo">{{ trans('general.backhome') }}</a>
		@else
			<a href="/home" class="btn btn-logo">{{ trans('general.backhome') }}</a>
		@endif
	</div>

@endsection
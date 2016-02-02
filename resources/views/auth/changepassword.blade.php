@extends('layouts.master')

@section('content')
<div class="container-fluid">
	<div class="row">
		<div class="col-md-8 col-md-offset-2">
			<div class="panel panel-default" style="margin-top: 50px">
				<div class="panel-heading">Change Password</div>
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
					@if (Session::has('message'))
					   <div class="alert alert-success">{{ Session::get('message') }}</div>
					@endif

					<form action="{{ URL::route('changePassword') }}" method="post">
						<input type="hidden" name="_token" value="{{ csrf_token() }}">
						<input type="hidden" name="user" value="{{ Auth::user()->id }}">
						<div class="form-group">
							<input type="password" class="form-control" name="currentPwd" placeholder="Current Password">
						</div>
						<div class="form-group">
							<input type="password" class="form-control" name="password" placeholder="New Password">
						</div>
						<div class="form-group">
							<input type="password" class="form-control" name="password_confirmation" placeholder="Confirm Password">
						</div>
						<input type="submit" class="btn btn-logo" value="Submit">
					</form>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection

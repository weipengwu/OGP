@extends('layouts.master')

@section('content')
<div class="container dashboard">
	<div class="row">
		<div class="col-md-8">
			<div class="panel">

				<div class="panel-body">
						<?php
							$id = Auth::user()->id;
						?>
						
				</div>
			</div>
		</div>
		<div class="col-md-4">
			<div id="update-profile">
				<h4>Edit Profile Info</h4>
				<form action="{{ URL::route('createProfile') }}" method="post" enctype="multipart/form-data">
					<input type="hidden" name="_token" value="{{ csrf_token() }}">
					<input type="hidden" name="user" value="{{ Auth::user()->id }}">
					<div class="form-group">
						<label>Upload Your Profile Image</label>
						<input type="file" name="u-profile" id="u-profile" accept="image/*">
					</div>
					<div class="form-group">
						<input type="text" class="form-control" value="{{ getAuthorname($id) }}" disabled>
					</div>
					<div class="form-group">
						<textarea name="desc" class="form-control" placeholder="Bio"></textarea>
					</div>
					<input type="submit" class="btn btn-logo">
				</form>
			</div>
		</div>
	</div>
</div>
@endsection
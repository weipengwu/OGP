@extends('layouts.master')

@section('content')
<div class="container">
	<div class="row">
		<div class="col-md-8 col-md-offset-2">
			<div class="panel">
				<div class="panel-heading"><h3>CREATE A NEW EVENT</h3></div>

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
					<form id="newevent" action="{{ URL::route('createEvent') }}" method="post" enctype="multipart/form-data">
						<input type="hidden" name="_token" value="{{ csrf_token() }}">
						<input type="hidden" name="author" value="{{ Auth::user()->id }}">
						<input type="hidden" name="gid" value="<?php echo $gid;?>">
						<div class="form-group">
							<label>Upload Your Banner Image</label>
							<input type="file" name="banner" id="banner" accept="image/*">
						</div>
						<div class="form-group">
							<input type="text" name="title" class="form-control" placeholder="Event Title">
						</div>
						<div class="form-group" style="float:left; margin-right: 2%; width: 49%;">
			                <label for="dtp_input1" class="col-md-2 control-label">From: </label>
			                <div class="input-group date form_datetime col-md-10" data-date-format="yyyy-mm-dd HH:ii p" data-link-field="dtp_input1">
			                    <input class="form-control" name="fromtime" type="text" value="">
								<span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></span>
			                </div>
							<input type="hidden" id="dtp_input1" value="" />
			            </div>
			            <div class="form-group" style="float:left; width: 49%;">
			                <label for="dtp_input2" class="col-md-2 control-label" style="text-align: right">To: </label>
			                <div class="input-group date form_datetime col-md-10" data-date-format="yyyy-mm-dd HH:ii p" data-link-field="dtp_input2">
			                    <input class="form-control" name="totime" type="text" value="">
								<span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></span>
			                </div>
							<input type="hidden" id="dtp_input2" value="" />
			            </div>
			            <div class="form-group" style="float:left; margin-right: 2%; width: 49%;">
							<label class="col-md-2">Price</label>
							<div class="col-md-10" style="padding: 0">
							<select name="selectprice" id="selectprice" class="form-control">
								<option value="Free">Free</option>
								<option value="Paid">Paid</option>
							</select>
							</div>
						</div>
						<div id="fee" class="form-group" style="float:left; width: 49%;">
							<label class="col-md-2" style="text-align: right">C$</label> <div class="col-md-10" style="padding: 0"><input type="text" name="fee" class="form-control" placeholder="Event Fee"></div>
						</div>
						<div class="form-group">
							<input type="text" name="city" class="form-control" placeholder="City">
						</div>
						<div class="form-group">
							<input type="text" name="address" class="form-control" placeholder="Address">
						</div>
						
						<div class="form-group">
							<textarea name="content" class="form-control" placeholder="Event Description"></textarea>
						</div>
						<input type="submit" class="btn btn-logo" value="Submit">
					</form>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection
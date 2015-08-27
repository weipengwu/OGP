@extends('layouts.master')

@section('content')
<div class="container">
	<div class="row">
		<div class="col-md-8 col-md-offset-2">
			<div class="panel">
				<div class="panel-heading"><h3>CREATE A NEW MISSION</h3></div>

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
					<form id="newmission" action="{{ URL::route('createMission') }}" method="post">
						<input type="hidden" name="_token" value="{{ csrf_token() }}">
						<input type="hidden" name="author" value="{{ Auth::user()->id }}">
						<input type="hidden" name="gid" value="<?php echo $gid;?>">
						<div class="form-group">
							<input type="text" name="title" class="form-control" placeholder="Mission Title">
						</div>
						<div class="form-group" style="float:left; margin-right: 2%; width: 49%;">
			                <label for="dtp_input1" class="col-md-2 control-label">From: </label>
			                <div class="input-group date form_datetime col-md-10" data-date-format="dd MM yyyy - HH:ii p" data-link-field="dtp_input1">
			                    <input class="form-control" name="fromtime" type="text" value="">
								<span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></span>
			                </div>
							<input type="hidden" id="dtp_input1" value="" />
			            </div>
			            <div class="form-group" style="float:left; width: 49%;">
			                <label for="dtp_input2" class="col-md-2 control-label" style="text-align: right">To: </label>
			                <div class="input-group date form_datetime col-md-10" data-date-format="dd MM yyyy - HH:ii p" data-link-field="dtp_input2">
			                    <input class="form-control" name="totime" type="text" value="">
								<span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></span>
			                </div>
							<input type="hidden" id="dtp_input2" value="" />
			            </div>
						<div class="form-group">
							<input type="text" name="city" class="form-control" placeholder="City">
						</div>
						<div class="form-group">
							<input type="text" name="address" class="form-control" placeholder="Address">
						</div>
						<div class="form-group">
							<input type="text" name="bounty" class="form-control" placeholder="Bounty">
						</div>
						<div class="form-group">
							<textarea name="content" class="form-control" placeholder="Mission Description"></textarea>
						</div>
						<input type="submit" class="btn btn-logo">
					</form>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection
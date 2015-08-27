@extends('layouts.master')

@section('content')
<div class="container">
	<div class="row">
		<div class="col-md-9">
			<div class="panel">
				<div class="panel-heading"><h2>All Missions</h2></div>

				<div class="panel-body">
					@foreach ($missions as $mission)
						<div class="missiongroup">
							
						</div>
					@endforeach
				</div>
			</div>
		</div>
		<div class="col-md-3">
			<h3>Today</h3>
		</div>
	</div>
</div>
@endsection
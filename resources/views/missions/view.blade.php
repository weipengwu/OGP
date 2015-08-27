@extends('layouts.master')

@section('content')
<div class="missionheader">
	<h1>{{ $mission->title }}</h1>
	<a href="<?php echo url();?>/missions/<?php echo $mission->id?>/apply" class="apply">Apply</a>
</div>
<section class="datesection">
	<div class="container">
		<div class="row">
			<div class="col-md-10 col-md-offset-1">
					<div class="date">
						<h2>Date & Time</h2>
						<p>{{ $mission->fromtime }} - {{ $mission->totime }}</p>
					</div>
					
			</div>
		</div>
	</div>
</section>
<section class="locationsection greybg">
	<div class="container">
		<div class="row">
			<div class="col-md-10 col-md-offset-1">
					<div class="date">
						<h2>Location</h2>
						<p>{{ $mission->city }}</p>
					</div>
					
			</div>
		</div>
	</div>
</section>
@endsection
@extends('layouts.master')

@section('content')
	
<div class="container search">
	<div class="row">
		<div class="col-md-12">
			<div class="panel">
				<div class="panel-heading">
					<h1>SEACH RESULTS</h1>
				</div>
				<div class="panel-body">
					@if (count($groups) > 0)
						<h3>Brands</h3>
						<div class="groupsrow collapsed">
						<?php $i = 1;?>
						@foreach ($groups as $group)
							<div class="grouplist<?php if(is_int($i/4)) echo " last";?>">
								<a href="brands/{{ $group->slug }}">
									<div class="bannerholder" style="background: url('<?php echo url()."/uploads/Medium_".$group->profile;?>');background-size:cover"></div>
									
									<div class="caption">
										<h3>{{ $group->name }}</h3>
										<p><span class="followcount"><img src="{{ asset('img/follow_icon_white.png') }}" width="20"> {{ count(groupFollowers($group->id)) }}</span></p>
									</div>
									</a>
								</div>
							<?php $i++;?>
						@endforeach
						</div>
						@if (count($groups) > 4 )
						<div class="brandsshowall"><a href="">SHOW ALL</a></div>
						@endif
					@endif
					
					@if (count($groups) == 0 && count($events) == 0 && count($events) == 0 )
						<div>
							No results found.
						</div>
					@endif
				</div>
			</div>
		</div>
	</div>
</div>

@endsection
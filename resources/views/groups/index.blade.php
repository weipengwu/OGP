@extends('layouts.master')

@section('content')
<div class="container groupindex">
	<div class="row">
		<div class="panel">
			<div class="panel-heading"><h1>EXPLORE</h1></div>
			<?php 
				$popular = DB::table('following')->select(DB::raw('followed_id, COUNT(followed_id) as count'))->groupBy('followed_id')->orderBy('count', 'desc')->take(4)->get();
				
			?>
			<div class="panel-body">
				<h2 class="sectiontitle">TRENDING</h2>
				<div class="row">
					<?php $i = 1;?>
					@foreach ($groups as $group)
						<?php if($i > 4) break;?>
						<div class="grouplist<?php if(is_int($i/4)) echo " last";?>">
						<a href="brands/{{ $group->slug }}">
							<div class="bannerholder" style="background: url('<?php echo url()."/uploads/Medium_".$group->profile;?>');background-size:cover"></div>
							
							<div class="caption">
								<h3>{{ $group->name }}</h3>
								<p><!-- <span class="membercount"><img src="{{ asset('img/member_icon_white.png') }}" width="14"> {{ memberCount($group->id) }}</span> --><span class="followcount"><img src="{{ asset('img/follow_icon_white.png') }}" width="20"> {{ count(groupFollowers($group->id)) }}</span></p>
							</div>
							</a>
						</div>
						<?php $i++;?>
					@endforeach
				</div>
				<div class="divider"></div>
				<h2 class="sectiontitle">MOST POPULAR</h2>
				<div class="row">
					<?php $i = 1; ?>
					@foreach ($popular as $pop)
						<?php $popgroup = DB::table('groups')->where('id', $pop->followed_id)->get(); ?>
						<div class="grouplist<?php if(is_int($i/4)) echo " last";?>">
							<a href="brands/{{ $popgroup[0]->slug }}">
							<div class="bannerholder" style="background: url('<?php echo url()."/uploads/Medium_".$popgroup[0]->profile;?>');background-size:cover"></div>
							<div class="caption">
								<h3>{{ $popgroup[0]->name }}</h3>
								<p><!-- <span class="membercount"><img src="{{ asset('img/member_icon_white.png') }}" width="14"> {{ memberCount($popgroup[0]->id) }}</span> --><span class="followcount"><img src="{{ asset('img/follow_icon_white.png') }}" width="20"> {{ count(groupFollowers($popgroup[0]->id)) }}</span></p>
							</div>
							</a>
						</div>
						<?php $i++;?>
					@endforeach
				</div>
				<div class="divider"></div>
				<h2 class="sectiontitle">ARTS & DESIGN</h2>
				<div class="row">
					<?php $i = 1;?>
					@foreach ($artsgroups as $group)
						<?php if($i > 4) break;?>
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
				<div class="divider"></div>
				@if (count($autogroups) > 0)
				<h2 class="sectiontitle">AUTOS</h2>
				<div class="row">
					<?php $i = 1;?>
					@foreach ($autogroups as $group)
						<?php if($i > 4) break;?>
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
				<div class="divider"></div>
				@endif

				@if (count($businessgroups) > 0)
				<h2 class="sectiontitle">BUSINESS</h2>
				<div class="row">
					<?php $i = 1;?>
					@foreach ($businessgroups as $group)
						<?php if($i > 4) break;?>
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
				<div class="divider"></div>
				@endif

				@if (count($educationgroups) > 0)
				<h2 class="sectiontitle">EDUCATION</h2>
				<div class="row">
					<?php $i = 1;?>
					@foreach ($educationgroups as $group)
						<?php if($i > 4) break;?>
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
				<div class="divider"></div>
				@endif

				@if (count($fashiongroups) > 0)
				<h2 class="sectiontitle">FASHION</h2>
				<div class="row">
					<?php $i = 1;?>
					@foreach ($fashiongroups as $group)
						<?php if($i > 4) break;?>
						<div class="grouplist<?php if(is_int($i/4)) echo " last";?>">
							<a href="brands/{{ $group->slug }}">
							<div class="bannerholder" style="background: url('<?php echo url()."/uploads/Medium_".$group->profile;?>');background-size:cover"></div>
							<div class="caption">
								<h3>{{ $group->name }}</h3>
								<p><!-- <span class="membercount"><img src="{{ asset('img/member_icon_white.png') }}" width="14"> {{ memberCount($group->id) }}</span> --><span class="followcount"><img src="{{ asset('img/follow_icon_white.png') }}" width="20"> {{ count(groupFollowers($group->id)) }}</span></p>
							</div>
							</a>
						</div>
						<?php $i++;?>
					@endforeach
				</div>
				<div class="divider"></div>
				@endif

				@if (count($foodgroups) > 0)
				<h2 class="sectiontitle">FOOD & DRINK</h2>
				<div class="row">
					<?php $i = 1;?>
					@foreach ($foodgroups as $group)
						<?php if($i > 4) break;?>
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
				<div class="divider"></div>
				@endif

				@if (count($gamesgroups) > 0)
				<h2 class="sectiontitle">GAMING</h2>
				<div class="row">
					<?php $i = 1;?>
					@foreach ($gamesgroups as $group)
						<?php if($i > 4) break;?>
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
				<div class="divider"></div>
				@endif

				@if (count($healthgroups) > 0)
				<h2 class="sectiontitle">HEALTH</h2>
				<div class="row">
					<?php $i = 1;?>
					@foreach ($healthgroups as $group)
						<?php if($i > 4) break;?>
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
				<div class="divider"></div>
				@endif

				@if (count($homegroups) > 0)
				<h2 class="sectiontitle">HOME</h2>
				<div class="row">
					<?php $i = 1;?>
					@foreach ($homegroups as $group)
						<?php if($i > 4) break;?>
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
				<div class="divider"></div>
				@endif

				@if (count($musicgroups) > 0)
				<h2 class="sectiontitle">MUSIC & PERFORMANCE</h2>
				<div class="row">
					<?php $i = 1;?>
					@foreach ($musicgroups as $group)
						<?php if($i > 4) break;?>
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
				<div class="divider"></div>
				@endif

				@if (count($sportsgroups) > 0)
				<h2 class="sectiontitle">SPORTS</h2>
				<div class="row">
					<?php $i = 1;?>
					@foreach ($sportsgroups as $group)
						<?php if($i > 4) break;?>
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
				<div class="divider"></div>
				@endif

				@if (count($technologygroups) > 0)
				<h2 class="sectiontitle">TECHNOLOGY & SCIENCE</h2>
				<div class="row">
					<?php $i = 1;?>
					@foreach ($technologygroups as $group)
						<?php if($i > 4) break;?>
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
				<div class="divider"></div>
				@endif

				@if (count($travelgroups) > 0)
				<h2 class="sectiontitle">TRAVEL</h2>
				<div class="row">
					<?php $i = 1;?>
					@foreach ($travelgroups as $group)
						<?php if($i > 4) break;?>
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
				<div class="divider"></div>
				@endif

				@if (count($othergroups) > 0)
				<h2 class="sectiontitle">OTHER</h2>
				<div class="row">
					<?php $i = 1;?>
					@foreach ($othergroups as $group)
						<?php if($i > 4) break;?>
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
				<div class="divider"></div>
				@endif
			</div>
		</div>
	</div>
</div>
@endsection
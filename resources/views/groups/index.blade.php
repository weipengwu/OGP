@extends('layouts.master')

@section('content')
<div class="container groupindex">
	<div class="row">
		<div class="panel">
			<div class="panel-heading"><h1>EXPLORE</h1></div>

			<div class="panel-body">
				<h2 class="sectiontitle">TRENDING</h2>
				<div class="row">
					<?php $i = 1;?>
					@foreach ($groups as $group)
						<?php if($i > 4) break;?>
						<div class="grouplist<?php if(is_int($i/4)) echo " last";?>">
						<a href="groups/<?= $group->slug;?>">
							<div class="bannerholder" style="background: url('{{$group->profile}}');background-size:cover"></div>
							
							<div class="caption">
								<h3>{{ $group->name }}</h3>
								<p><span class="membercount"><img src="{{ asset('img/member_icon_white.png') }}" width="14"> {{ memberCount($group->id) }}</span><span class="followcount"><img src="{{ asset('img/follow_icon_white.png') }}" width="20"> {{ count(groupFollowers($group->id)) }}</span></p>
							</div>
							</a>
						</div>
						<?php $i++;?>
					@endforeach
				</div>
				<div class="divider"></div>
				<h2 class="sectiontitle">HOT NEW RELEASES</h2>
				<div class="row">
					<?php $i = 1;?>
					@foreach ($groups as $group)
						<?php if($i > 4) break;?>
						<div class="grouplist<?php if(is_int($i/4)) echo " last";?>">
							<a href="groups/<?= $group->slug;?>">
							<div class="bannerholder" style="background: url('{{$group->profile}}');background-size:cover"></div>
							<div class="caption">
								<h3>{{ $group->name }}</h3>
								<!-- <p>{{ memberCount($group->id) }} Members</p> -->
							</div>
							</a>
						</div>
						<?php $i++;?>
					@endforeach
				</div>
				<div class="divider"></div>
				<h2 class="sectiontitle">MOST POPULAR</h2>
				<div class="row">
					<?php $i = 1;?>
					@foreach ($groups as $group)
						<?php if($i > 4) break;?>
						<div class="grouplist<?php if(is_int($i/4)) echo " last";?>">
							<a href="groups/<?= $group->slug;?>">
							<div class="bannerholder" style="background: url('{{$group->profile}}');background-size:cover"></div>
							<div class="caption">
								<h3>{{ $group->name }}</h3>
								<!-- <p>{{ memberCount($group->id) }} Members</p> -->
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
					@foreach ($groups as $group)
						<?php if($i > 4) break;?>
						<div class="grouplist<?php if(is_int($i/4)) echo " last";?>">
							<a href="groups/<?= $group->slug;?>">
							<div class="bannerholder" style="background: url('{{$group->profile}}');background-size:cover"></div>
							<div class="caption">
								<h3>{{ $group->name }}</h3>
								<!-- <p>{{ memberCount($group->id) }} Members</p> -->
							</div>
							</a>
						</div>
						<?php $i++;?>
					@endforeach
				</div>
			</div>
		</div>
	</div>
</div>
@endsection
@extends('layouts.master')

@section('content')
<div class="container profile">
	<div class="row">
		<div class="col-md-8">
			<div class="panel">

				<div class="panel-body">
					<div class="topwrapper">
						<div class="top">
							<?php
								$user_profile = userProfile($user->id);
								$user_desc = userDesc($user->id);
								if(count($user_profile) > 0):
							?>

							<?php
								else:
							?>
							<div class="profileholder">
								<img src="{{ asset('/img/defaultprofile.png') }}" id="d-profile">
							</div>
							<?php endif;?>
							<h3>{{ getAuthorname($user->id) }}</h3>
						</div>
						<div class="tabs">
							<ul>
								<li><a href="" class="active tab_btn" data-index="details">Details</a></li>
								<li><a href="" class="tab_btn" data-index="posts">Posts</a></li>
								<li><a href="" class="tab_btn" data-index="events">Events</a></li>
								<li><a href="" class="tab_btn" data-index="conn">Connection</a></li>
							</ul>
						</div>
					</div>
					<div class="middle">
						<div class="tab-content active" id="details">
							<h3>Bio</h3>
							@if (count($user_desc) > 0)
							{{ $user_desc[0]->meta_value }}
							@else
							Nothing here yet
							@endif
						</div>
						<div class="tab-content" id="posts">
							<h3>Posts</h3>
		
						</div>
						<div class="tab-content" id="events">
							<?php $eventLikes = DB::table('eventlikes')->where('author_id', $user->id)->get(); ?>
							<h3>Interested Events</h3>
							@if (count($eventLikes) > 0)
							<?php foreach ($eventLikes as $eventLike):
								$event = DB::table('events')->where('id', $eventLike->event_id)->get();
							?>
								<div class="eventgroup">
									<div class="eventgroup-list">
										<div class="row">
											<div class="col-md-3">
												<div class="imgholder">
													<a href="events/<?= $event[0]->id;?>"><img src=<?php echo url()."/".$event[0]->banner;?> alt="banner"/></a>
												</div>
											</div>
											<div class="col-md-9">
												<p class="location">{{ $event[0]->location }}</p>
												<h3><a href="events/<?= $event[0]->id;?>">{{ $event[0]->title }}</a></h3>
												
												<div class="event-details"><span><i class="fa fa-calendar"></i> {{ $event[0]->time }}</span><span><i class="fa fa-ticket"></i> {{ $event[0]->fee }}</span></div>
											</div>
										</div>
									</div>
								</div>
							<?php  endforeach;?>
							@endif
						</div>
						<div class="tab-content" id="conn">
							<h3>Joined Groups</h3>
							@if(joinedGroupCount($user->id) > 0)
								<?php $i = 1;?>
								@foreach(joinedGroup($user->id) as $group)
									<div class="grouplist<?php if(is_int($i/4)) echo " last";?>" style="background: url('<?php echo url()."/".$group->profile;?>');background-size:auto 150px;">
										<a href="groups/<?= $group->slug;?>">
										<div class="caption">
											<h3>{{ $group->name }}</h3>
											<p>{{ memberCount($group->id) }} Members</p>
										</div>
										</a>
									</div>
									<?php $i++;?>
								@endforeach
							@endif
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="col-md-4">
			@if(Auth::check())
				<div class="sidebar-top">
					@if(isFollowing(Auth::user()->id, $user->id))
						<a href="" class="follow_btn unfollow_user" data-my-id="{{ Auth::user()->id }}" data-to-id="{{ $user->id }}">Following</a>
					@else
						<a href="" class="follow_btn follow_user" data-my-id="{{ Auth::user()->id }}" data-to-id="{{ $user->id }}">Follow</a>
					@endif
				</div>
			@endif
		</div>
	</div>
</div>
@endsection
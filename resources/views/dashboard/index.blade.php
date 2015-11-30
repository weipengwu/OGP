@extends('layouts.master')

@section('content')
<div class="container dashboard">
	<div class="row">
		<div class="col-md-4">

			<?php
				$id = Auth::user()->id;
			?>
				<div class="dash-side-top">
					<?php 
						$user_profile = DB::table('user_meta')->where('user_id', $id)->where('meta_key', 'profile')->get();
						$user_desc = DB::table('user_meta')->where('user_id', $id)->where('meta_key', 'description')->get();
						if(count($user_profile) > 0):
					?>
							<div class="col-md-6">
								<div class="top-profile" style="background: url(<?php echo url()."/".$user_profile[0]->meta_value;?>) center center no-repeat; background-size: cover; width: 100px; height: 100px; border-radius: 50px"></div>
							</div>
					<?php
						else:
					?>
							<div class="col-md-6">
								<div class="top-profile">{{ getFirstCharter(Auth::user()->name) }}</div>
							</div>
					<?php endif;?>
					<div class="col-md-6">
						{{ Auth::user()->name }}
					</div>
				</div>
				<div class="dash-side-bottom">
					<div class="d-row">
						<a href="" id="edit_btn">Edit Profile</a>
					</div>
					<div class="d-row">
						<a href="">My Group</a>
					</div>
					<div class="d-row">
						<a href="">Followed Groups</a>
					</div>
					<div class="d-row">
						<a href="">Joined Groups</a>
					</div>
					@if(count(myGroup($id)) > 0)
					<div class="d-row">
						<a href="">Manage Events</a>
					</div>
					@endif
				</div>

		</div>
		<div class="col-md-7 col-md-push-1">
			<div class="dash-main" id="update-profile">
				<h4>Edit Profile Info</h4>
				<form action="{{ URL::route('createProfile') }}" method="post" enctype="multipart/form-data">
					<input type="hidden" name="_token" value="{{ csrf_token() }}">
					<input type="hidden" name="user" value="{{ Auth::user()->id }}">
					<div class="form-group">
						<label>Upload Your Profile Image</label>
						<input type="file" name="u-profile" id="u-profile" accept="image/*">
					</div>
					<div class="form-group">
						<input type="text" class="form-control" value="{{ getAuthorname($id) }}">
					</div>
					<div class="form-group">
						<textarea name="desc" class="form-control" placeholder="Bio"></textarea>
					</div>
					<input type="submit" class="btn btn-logo">
				</form>
			</div>
			<div class="dash-main" id="mybrand">
				@if(count(myGroup($id)) > 0)
					<div class="row">
					@foreach ( myGroup($id) as $group)
						<div class="col-md-3">
						<a href="groups/<?= $group->slug;?>">
							<div class="bannerholder" style="background: url('{{$group->profile}}');background-size:cover"></div>
							</a>
						</div>
						<div class="col-md-7">
							<h3>{{ $group->name }}</h3>
							<p><span class="followcount"><img src="{{ asset('img/follow_icon.png') }}" width="20"> {{ count(groupFollowers($group->id)) }}</span></p>
						</div>
						<div class="col-md-2">
							<a href="groups/<?= $group->slug;?>/edit">Edit my brand</a>
						</div>
					@endforeach
					</div>
				@else
					<div class="row no-border">
						<h3>You haven't created your brand yet.</h3>
						<a href="/groups/new" class="createbrand">Create your brand</a>
					</div>
				@endif
			</div>
		<!-- 	<div class="dash-main" id="joinedbrand">
				@if(joinedGroupCount($id) > 0)
					<div class="row">
					<?php $i = 1;?>
					@foreach (joinedGroup($id) as $group)
						<div class="grouplist<?php if(is_int($i/3)) echo " last";?>">
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
				@endif
			</div> -->
			<div class="dash-main" id="followedbrand">
				@if(count(followedGroup($id)) > 0)
					<div class="row">
					<?php $i = 1;?>
					@foreach (followedGroup($id) as $group)
						<div class="grouplist<?php if(is_int($i/3)) echo " last";?>">
						<a href="groups/<?= $group->slug;?>">
							<div class="bannerholder" style="background: url('{{$group->profile}}');background-size:cover"></div>
							
							<div class="caption">
								<h3>{{ $group->name }}</h3>
								<p><span class="followcount"><img src="{{ asset('img/follow_icon_white.png') }}" width="20"> {{ count(groupFollowers($group->id)) }}</span></p>
							</div>
							</a>
						</div>
						<?php $i++;?>
					@endforeach
					</div>
				@endif
			</div>
			<div class="dash-main" id="manageEvents">
				@if(count(getMyevents($id)) > 0)
				@foreach (getMyevents($id) as $event)
				<div class="row">
					<div class="col-md-3 col-sm-3 col-xs-3">
						<a href="events/{{ $event->id }}">
							<div class="imgholder" style="background: url('<?php echo url()."/".$event->banner;?>') center center; background-size: cover;"></div>
						</a>
					</div>
					<div class="col-md-7 col-sm-7 col-xs-7">
					<h3><a href="events/{{ $event->id }}">{{ $event->title }}</a></h3>
					<div class="event-details">
						<p class="event-info">
							<img src="{{ asset('img/calendar_icon.png') }}" width="16" class="edicons"> 
							<?php 
								if(gmdate('M j',$event->fromtime) == gmdate('M j',$event->totime)) : 
							?>
								{{ gmdate('D, M j',$event->fromtime) }} @ {{ gmdate('g : i a',$event->fromtime) }} - {{ gmdate('g : i a' ,$event->totime) }}
							<?php else: ?>
								{{ gmdate('M j',$event->fromtime) }} - {{ gmdate('M j',$event->totime) }}

							<?php endif; ?>
						</p>
						<p class="event-info"><img src="{{ asset('img/address_icon.png') }}" width="15" class="edicons"> {{ $event->address }}</p>
						<p class="event-info"><img src="{{ asset('img/ticket_icon.png') }}" height="12" class="edicons">
						@if($event->fee == 'Free') 
							{{ $event->fee }}
						@else
							C ${{ $event->fee }}
						@endif
						</p>
					</div>		
					</div>
					<div class="col-md-2 col-sm-2 col-xs-2">
						<a href="/events/{{ $event->id }}/edit">Edit Event</a>
					</div>
				</div>
				@endforeach
				@endif
			</div>
		</div>
	</div>
</div>
@endsection
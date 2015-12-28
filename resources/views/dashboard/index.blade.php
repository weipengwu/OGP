@extends('layouts.master')

@section('content')
<div class="container dashboard">
	<div class="row">
		<div class="col-md-4 col-sm-4">

			<?php
				$id = Auth::user()->id;
			?>
				<div class="dash-side-top">
					<?php 
						$user_profile = DB::table('user_meta')->where('user_id', $id)->where('meta_key', 'profile')->get();
						$user_desc = DB::table('user_meta')->where('user_id', $id)->where('meta_key', 'description')->get();
						if(count($user_profile) > 0):
					?>
							<div class="col-md-5 col-sm-5 col-xs-5">
								<div class="top-profile" style="background: url(<?php echo url()."/".$user_profile[0]->meta_value;?>) center center no-repeat; background-size: cover; width: 100px; height: 100px; border-radius: 50px"></div>
							</div>
					<?php
						else:
					?>
							<div class="col-md-5 col-sm-5 col-xs-5">
								<div class="top-profile" style="width: 100px; height: 100px; border-radius: 50px; font-size:50px; line-height: 100px;">{{ getFirstCharter(Auth::user()->name) }}</div>
							</div>
					<?php endif;?>
					<div class="col-md-7 col-sm-7 col-xs-7">
						<p><strong>{{ Auth::user()->name }}</strong></p>
						<?php if(count($user_desc) > 0): ?>
						<p>{{ $user_desc[0]->meta_value }}</p>
						<?php endif; ?>
					</div>
				</div>
				<div class="dash-side-bottom">
					<div class="d-row">
						<a href="" class="dash-btn" data-id="overview">Overview</a>
					</div>
					<div class="d-row">
						<a href="" class="dash-btn" data-id="updateprofile">Edit Profile</a>
					</div>
					<div class="d-row">
						<a href="" class="dash-btn" data-id="changepwd">Change Password</a>
					</div>
					<div class="d-row">
						<a href="" class="dash-btn" data-id="mybrand">My Brand</a>
					</div>
					<div class="d-row">
						<a href="" class="dash-btn" data-id="followedbrand">Following</a>
					</div>
<!-- 					<div class="d-row">
						<a href="">Joined Groups</a>
					</div> -->
					@if(count(myGroup($id)) > 0)
					<div class="d-row">
						<a href="" class="dash-btn" data-id="manageEvents">Manage Events</a>
					</div>
					@endif
				</div>

		</div>
		<div class="col-md-7 col-md-push-1 col-sm-7 col-sm-push-1">
			<div class="dash-main dash-init" id="overview">
				<h3>Dashboard</h3>
					<div class="dash-row">
						@if(count(myGroup($id)) > 0)
							<a href="" class="dash-btn" data-id="mybrand">
								<div class="dash-box">
									<div class="img-wrapper">
									<img src="{{ asset('img/create_brand_icon.png') }}" width="30">
									</div>
									<p>Edit Brand</p>
								</div>
							</a>
						@else
							<a href="/groups/new">
								<div class="dash-box">
									<div class="img-wrapper">
									<img src="{{ asset('img/create_brand_icon.png') }}" width="30">
									</div>
									<p>Create Brand</p>
								</div>
							</a>
						@endif
							<a href="" class="dash-btn" data-id="followedbrand">
								<div class="dash-box">
									<div class="img-wrapper">
									<img src="{{ asset('img/follow_icon.png') }}" width="30">
									</div>
									<p>Following</p>
								</div>
							</a>
					</div>
					@if(count(myGroup($id)) > 0)
						<?php $mygroup = myGroup($id);?>
						<div class="dash-row">
						<a href="<?php echo url(); ?>/groups/<?php echo $mygroup[0]->slug; ?>/posts/new">
							<div class="dash-box">
								<div class="img-wrapper">
									<img src="{{ asset('img/createpost_icon.png') }}" width="30">
								</div>
								<p>Create Post</p>
							</div>
						</a>
						<a href="<?php echo url(); ?>/groups/<?php echo $mygroup[0]->slug; ?>/events/new">
							<div class="dash-box">
								<div class="img-wrapper">
									<img src="{{ asset('img/ticket_icon.png') }}" width="30">
								</div>
								<p>Create Event</p>
							</div>
						</a>
						</div>
					@endif
					<div class="dash-row">
							<a href="" class="dash-btn" data-id="updateprofile">
								<div class="dash-box">
									<div class="img-wrapper">
									<img src="{{ asset('img/edit_icon.png') }}" width="30">
									</div>
									<p>Edit Profile</p>
								</div>
							</a>
							@if(count(myGroup($id)) > 0)
							<a href="" class="dash-btn" data-id="manageEvents">
								<div class="dash-box">
									<div class="img-wrapper">
									<img src="{{ asset('img/edit_event_icon.png') }}" width="30">
									</div>
									<p>Manage Events</p>
								</div>
							</a>
							@endif
					</div>


			</div>
			<div class="dash-main" id="updateprofile">
				<h4>Edit Profile Info</h4>
				<form action="{{ URL::route('updateProfile') }}" method="post" enctype="multipart/form-data">
					<input type="hidden" name="_token" value="{{ csrf_token() }}">
					<input type="hidden" name="user" value="{{ Auth::user()->id }}">
					<div class="form-group">
						<label>Upload Your Profile Image</label>
						<input type="file" name="u-profile" id="u-profile" accept="image/*">
					</div>
					<div class="form-group">
						<input type="text" class="form-control" name="username" value="{{ getAuthorname($id) }}" placeholder="Username">
					</div>
					<div class="form-group">
						<input type="text" class="form-control" name="useremail" value="{{ getAuthoremail($id) }}" placeholder="Email">
					</div>
					<div class="form-group">
						<textarea name="desc" class="form-control" placeholder="Bio">@if(count($user_desc) > 0) {!! strip_tags(userDesc(Auth::user()->id)[0]->meta_value) !!} @endif</textarea>
					</div>
					<input type="submit" class="btn btn-logo" value="Submit">
				</form>
			</div>
			<div class="dash-main" id="changepwd">
				<h4>Change Password</h4>
				<form action="{{ URL::route('changePassword') }}" method="post">
					<input type="hidden" name="_token" value="{{ csrf_token() }}">
					<input type="hidden" name="user" value="{{ Auth::user()->id }}">
					<div class="form-group">
						<input type="text" class="form-control" name="currentPwd" placeholder="Current Password">
					</div>
					<div class="form-group">
						<input type="text" class="form-control" name="newPwd" placeholder="New Password">
					</div>
					<div class="form-group">
						<input type="text" class="form-control" name="newPwd_confirmation" placeholder="Confirm Password">
					</div>
					<input type="submit" class="btn btn-logo" value="Submit">
				</form>
			</div>
			<div class="dash-main" id="mybrand">
				@if(count(myGroup($id)) > 0)
					<div class="row">
					@foreach ( myGroup($id) as $group)
						<div class="col-md-3 col-sm-3 col-xs-3">
						<a href="groups/<?= $group->slug;?>">
							<div class="bannerholder" style="background: #666 url('<?php echo url()."/uploads/Small_".$group->profile;?>');background-size:cover"></div>
							</a>
						</div>
						<div class="col-md-6 col-sm-6 col-xs-6">
							<h3>{{ $group->name }}</h3>
							<p><span class="followcount"><img src="{{ asset('img/follow_icon.png') }}" width="20"> {{ count(groupFollowers($group->id)) }}</span></p>
						</div>
						<div class="col-md-3 col-sm-3 col-xs-3">
							<a href="groups/<?= $group->slug;?>/edit" class="btn btn-logo">Edit brand</a>
						</div>
					@endforeach
					</div>
				@else
					<div class="row no-border">
						<h3 style="margin-top:0;">You haven't created your brand yet.</h3>
						<!-- <a href="/groups/new" class="createbrand">Create your brand</a> -->
						<a href="/groups/new">
								<div class="dash-box">
									<img src="{{ asset('img/create_brand_icon.png') }}" width="30">
									<p>Create Brand</p>
								</div>
							</a>
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
							<div class="bannerholder" style="background: #666 url('<?php echo url()."/uploads/Small_".$group->profile;?>');background-size:cover"></div>
							
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
							<div class="imgholder" style="background: #666 url('<?php echo url()."/uploads/Medium_".$event->banner;?>') center center; background-size: cover;"></div>
						</a>
					</div>
					<div class="col-md-6 col-sm-6 col-xs-6">
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
					<div class="col-md-3 col-sm-3 col-xs-3">
						<a href="/events/{{ $event->id }}/edit" class="btn btn-logo" style="margin-bottom: 10px">Edit Event</a>
						<a class="various btn btn-danger" href="#confirmdelete<?php echo $event->id; ?>">Delete Event</a>
						<div id="confirmdelete<?php echo $event->id; ?>" class="confirmdelete">
							<h3>Are you sure to delete this event?</h3>
							<a href="{{ url() }}/events/<?php echo $event->id; ?>/delete" class="btn btn-danger">Delete</a> <a href="" class="btn btn-logo close_btn">Cancel</a>
						</div>
					</div>
				</div>
				@endforeach
				@endif
			</div>
		</div>
	</div>
</div>
@endsection
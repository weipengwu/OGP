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
								<div class="top-profile" style="background: url(<?php echo url()."/".$user_profile[0]->meta_value;?>) center center no-repeat; background-size: cover; width: 100px; height: 100px"></div>
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
						<a href="">Joined Groups</a>
					</div>
					<div class="d-row">
						<a href="">Manage Events</a>
					</div>
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
						<input type="text" class="form-control" value="{{ getAuthorname($id) }}" disabled>
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
					<?php $i = 1;?>
					@foreach ( myGroup($id) as $group)
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
				@else
					<div class="row">
						<h3>You haven't created your brand yet.</h3>
						<a href="/groups/new" class="createbrand">Create your brand</a>
					</div>
				@endif
			</div>
			<div class="dash-main" id="joinedbrand">
				@if(joinedGroupCount($id) > 0)
					<div class="row">
					<?php $i = 1;?>
					@foreach (joinedGroup($id) as $group)
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
				@endif
			</div>
		</div>
	</div>
</div>
@endsection
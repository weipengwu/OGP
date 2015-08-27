@extends('layouts.master')

@section('content')
<div class="container dashboard">
	<div class="row">
		<div class="col-md-8">
			<div class="panel">

				<div class="panel-body">
						<?php
							$id = Auth::user()->id;
						?>
						<div>
							<?php 
								$user_profile = DB::table('user_meta')->where('user_id', $id)->where('meta_key', 'profile')->get();
								$user_desc = DB::table('user_meta')->where('user_id', $id)->where('meta_key', 'description')->get();
								if(count($user_profile) > 0):
							?>
							<div class="col-md-2">
								<div class="top-profile" style="background: url(<?php echo url()."/".$user_profile[0]->meta_value;?>) center center no-repeat; background-size: cover"></div>
							</div>
							<?php
								else:
							?>
							<div class="col-md-2">
								<div class="top-profile"><?php echo getFirstCharter(Auth::user()->name);?></div>
							</div>
							<?php endif;?>
							<div class="col-md-9">
								<h3 class="heading-name">{{ getAuthorname($id) }}</h3> <a href="" id="edit_btn">Edit Profile</a>
								<p class="description">
									@if(count($user_desc) > 0)
										{{ $user_desc[0]->meta_value }}
									@endif
								</p>
							</div>
							<div class="d-row">
								<p>My Group</p>
								@if(count(myGroup($id)) > 0)
									@foreach(myGroup($id) as $mgroup)
										<div class="grouplist" style="background: url('{{$mgroup->profile}}');background-size:auto 220px;">
											<a href="groups/<?= $mgroup->slug;?>">
											<div class="caption">
												<h3>{{ $mgroup->name }}</h3>
											</div>
											</a>
										</div>
									@endforeach
								@else
									<a href="/groups/new">Create your own group</a>
								@endif
							</div>
							<div class="d-row">
							<p>Joined Groups</p>
							@if(joinedGroupCount($id) > 0)
								@foreach(joinedGroup($id) as $group)
									<p>{{ $group->name }}</p>
								@endforeach
							@endif
							</div>
						</div>

				</div>
			</div>
		</div>
		<div class="col-md-4">
			<div id="update-profile">
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
		</div>
	</div>
</div>
@endsection
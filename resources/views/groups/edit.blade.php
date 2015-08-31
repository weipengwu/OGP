@extends('layouts.master')

@section('content')
<div class="container">
	<div class="row">
		<div class="col-md-8 col-md-offset-2">
			<div class="panel">
				<div class="panel-heading"><h3>EDIT GROUP</h3></div>

				<div class="panel-body">
					<form action="{{ URL::route('editingGroup') }}" method="post" enctype="multipart/form-data">
						<input type="hidden" name="_token" value="{{ csrf_token() }}">
						<input type="hidden" name="id" value="{{ $group->id }}">
						<div class="form-group">
							<label>Upload Your New Group Profile</label>
							<input type="file" id="g-profile" name="g-profile" accept="image/*">
						</div>
						<div class="form-group">
							<label>Upload Your New Group Banner Image</label>
							<input type="file" id="g-banner" name="g-banner" accept="image/*">
						</div>
						<div class="form-group">
							<input type="text" name="name" class="form-control" value="{{ $group->name }}" disabled>
						</div>
						<div class="form-group">
							<select name="category" class="form-control">
								<option value="">Group Category -- Select one</option>
								<option value="Arts & Design" <?php if($group->category == 'Arts & Design') echo "selected"; ?>>Arts & Design</option>
								<option value="Auto" <?php if($group->category == 'Auto') echo "selected"; ?>>Auto</option>
								<option value="Business" <?php if($group->category == 'Business') echo "selected"; ?>>Business</option>
								<option value="Education" <?php if($group->category == 'Education') echo "selected"; ?>>Education</option>
								<option value="Food" <?php if($group->category == 'Food') echo "selected"; ?>>Food</option>
								<option value="Games" <?php if($group->category == 'Games') echo "selected"; ?>>Games</option>
								<option value="Health" <?php if($group->category == 'Health') echo "selected"; ?>>Health</option>
								<option value="Home" <?php if($group->category == 'Home') echo "selected"; ?>>Home</option>
								<option value="Music" <?php if($group->category == 'Music') echo "selected"; ?>>Music</option>
								<option value="Sports" <?php if($group->category == 'Sports') echo "selected"; ?>>Sports</option>
								<option value="Fashion" <?php if($group->category == 'Fashion') echo "selected"; ?>>Fashion</option>
								<option value="Technology" <?php if($group->category == 'Technology') echo "selected"; ?>>Technology</option>
								<option value="Travel" <?php if($group->category == 'Travel') echo "selected"; ?>>Travel</option>
							</select>
						</div>
						<div class="form-group">
							<input type="text" name="tag" class="form-control" value="{{ $group->tag }}">
						</div>
						<div class="form-group">
							<input type="text" name="website" class="form-control" value="{{ $group->website }}">
						</div>
						<div class="form-group">
							<select name="type" class="form-control">
								<option value="public" <?php if($group->type == 'public') echo "selected"; ?>>Public</option>
								<option value="private" <?php if($group->type == 'private') echo "selected"; ?>>Private</option>
							</select>
						</div>
						<div class="form-group">
							<label>Apply to Join</label> <input type="checkbox" name="applytojoin" />
						</div>
						<div class="form-group">
							<textarea name="description" class="form-control">{{ $group->description }}</textarea>
						</div>
						<input type="submit" class="btn btn-logo">
					</form>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection
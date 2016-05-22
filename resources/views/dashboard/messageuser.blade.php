@extends('layouts.master')

@section('content')
<div class="container-fluid">
	<div class="row">
		<div class="col-md-8 col-md-offset-2">
			<div class="panel panel-default" style="margin-top: 50px">
				<div class="panel-heading">{{ getAuthorname($sentto) }} <a href="{{ url() }}/dashboard/messages" class="messageback">Back</a></div>
				<div class="panel-body">
				<div class="allmessages">
				@if($messages)
					@foreach($messages as $message)
						@if($message->sentby == Auth::user()->id)
							<div class="singlemessage outbox"><span>{!! html_entity_decode($message->message) !!}</span></div>
						@else
							<div class="singlemessage inbox">
								<?php $id = $message->sentby; $user_profile = DB::table('user_meta')->where('user_id', $id)->where('meta_key', 'profile')->get();?>
								<?php if(count($user_profile) > 0): ?>
									<div class="top-profile" style="background: url(<?php echo url()."/uploads/Small_".$user_profile[0]->meta_value;?>) center center no-repeat; background-size: cover"></div>
								<?php else: ?>
									<div class="top-profile"><?php echo getFirstCharter(getAuthorname($id));?></div>
								<?php endif; ?>
								<span>{!! html_entity_decode($message->message) !!}</span>
							</div>
						@endif
						<div class="clear"></div>
					@endforeach
				@endif
				</div>
				<form method="post" action="{{ url('dashboard/sendmessage') }}" id="messageform">
					<input type="hidden" name="_token" value="{{ csrf_token() }}">
					<input type="hidden" name="sentby" value="{{ Auth::user()->id }}">
					<input type="hidden" name="sentto" value="{{ $sentto }}">
					<div class="form-group">
						<textarea class="form-control" name="message" placeholder="{{ trans('dashboard.reply') }}"></textarea>
					</div>
					<div class="form-group">
						<input type="submit" class="btn btn-logo" value="{{ trans('dashboard.send') }}">
					</div>
				</form>
	
				</div>
			</div>
		</div>
	</div>
</div>
@endsection
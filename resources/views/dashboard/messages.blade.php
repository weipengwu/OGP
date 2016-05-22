@extends('layouts.master')

@section('content')
<div class="container-fluid">
	<div class="row">
		<div class="col-md-8 col-md-offset-2">
			<div class="panel panel-default" style="margin-top: 50px">
				<div class="panel-heading">{{ trans('brands.messages') }}</div>
				<div class="panel-body">
					@if( !empty($messages[0]) )
					<?php $author = array();?>
					@foreach($messages as $message)
						@if(!in_array($message->sentby, $author))
							@if($message->unread == '1')
								<div class="listmessage"><div class="unreaddot"></div><strong><a href="{{ url() }}/dashboard/message/user/{{ $message->sentby }}">{{ getAuthorname($message->sentby) }}</a></strong></div>
							@else
								<div class="listmessage"><a href="{{ url() }}/dashboard/message/user/{{ $message->sentby }}">{{ getAuthorname($message->sentby) }}</a></div>
							@endif
							<?php array_push($author, $message->sentby); ?>
						@endif
					@endforeach
					@else
						<p>You don't have any messages.</p>
					@endif
				</div>
			</div>
		</div>
	</div>
</div>
@endsection
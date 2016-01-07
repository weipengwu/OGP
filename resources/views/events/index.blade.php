@extends('layouts.master')

@section('content')
<div class="container eventindex">
	<div class="row">
		<div class="col-md-12">
			<div class="panel">
				<div class="heading"><h2>Browse Events</h2>
				<?php if(isset($_GET['category'])){
						$cat = $_GET['category'];
						var_dump($cat);
					}?>
					<form>
						<select id="category" class="form-control">
								<option value="">All Categories</option>
								<option value="{{ urlencode('Arts &amp; Design') }}" <?php if(isset($_GET['category']) && $cat == 'Arts & Design') echo "selected";?>>Arts &amp; Design</option>
								<option value="Autos" <?php if(isset($_GET['category']) && $cat == 'Autos') echo "selected";?>>Autos</option>
								<option value="Business" <?php if(isset($_GET['category']) && $cat == 'Business') echo "selected";?>>Business</option>
								<option value="Education" <?php if(isset($_GET['category']) && $cat == 'Education') echo "selected";?>>Education</option>
								<option value="Fashion" <?php if(isset($_GET['category']) && $cat == 'Fashion') echo "selected";?>>Fashion</option>
								<option value="Food &amp; Drink" <?php if(isset($_GET['category']) && $cat == 'Food & Drink') echo "selected";?>>Food &amp; Drink</option>
								<option value="Gaming" <?php if(isset($_GET['category']) && $cat == 'Gaming') echo "selected";?>>Gaming</option>
								<option value="Health" <?php if(isset($_GET['category']) && $cat == 'Health') echo "selected";?>>Health</option>
								<option value="Home" <?php if(isset($_GET['category']) && $cat == 'Home') echo "selected";?>>Home</option>
								<option value="Music &amp; Performance" <?php if(isset($_GET['category']) && $cat == 'Music & Performance') echo "selected";?>>Music &amp; Performance</option>
								<option value="Sports" <?php if(isset($_GET['category']) && $cat == 'Sports') echo "selected";?>>Sports</option>
								<option value="Technology &amp; Science" <?php if(isset($_GET['category']) && $cat == 'Technology & Science') echo "selected";?>>Technology &amp; Science</option>
								<option value="Travel" <?php if(isset($_GET['category']) && $cat == 'Travel') echo "selected";?>>Travel</option>
								<option value="Other" <?php if(isset($_GET['category']) && $cat == 'Other') echo "selected";?>>Other</option>
						</select>
						<?php if(isset($_GET['time'])){
							$time = $_GET['time'];
						}?>
						<select id="eventtime" class="form-control">
							<option value="">All time</option>
							<option value="thisweek" <?php if(isset($_GET['time']) && $time == 'thisweek') echo "selected";?>>This week</option>
							<option value="nextweek" <?php if(isset($_GET['time']) && $time == 'nextweek') echo "selected";?>>Next week</option>
						</select>
					</form>
				</div>

				<div class="event-body">
					<?php $i = 1; $length = count($events);?>
					@foreach ($events as $event)
						<?php
							if(Auth::check()){
								if ( $event->type == 'private' && (isFollowing(Auth::user()->id, $event->group_id ) == 0 && $event->author !== Auth::user()->id) ){
									continue;
								}
							}else{
								if($event->type == 'private'){
									continue;
								}
							}
						?>
						<div class="eventgroup<?php if(is_int($i/3)) { echo " last"; }?>">
							<div class="eventgroup-list">
										<a href="events/{{ $event->id }}">
										<div class="imgholder" style="background: #666 url('<?php echo url()."/uploads/Medium_".$event->banner;?>') center center; background-size: cover;">
										</div>
										</a>
										<!-- <div style="clear:both; height:4px; background-color: #fc6c25"></div> -->
										
										<p class="location">{{ $event->city }}</p>
										<h3><a href="events/{{ $event->id }}">{{ $event->title }}</a></h3>
										
										<div class="event-details">
											<p class="event-info">
												<img src="{{ asset('img/calendar_icon.png') }}" width="16" class="edicons"> 
												<?php 
													if(date('M j',$event->fromtime) == date('M j',$event->totime)) : 
												?>
												{{ date('D, M j',$event->fromtime) }} @ {{ date('g : i a',$event->fromtime) }} - {{ date('g : i a' ,$event->totime) }}
												<?php else: ?>
												{{ date('M j',$event->fromtime) }} - {{ date('M j',$event->totime) }}

												<?php endif; ?>
											</p>
											<p class="event-info"><img src="{{ asset('img/address_icon.png') }}" width="15" class="edicons"> {{ $event->address }}</p>
											<p class="event-info"><img src="{{ asset('img/ticket_icon.png') }}" height="12" class="edicons">
											@if($event->fee == 'Free') 
												{{ $event->fee }}
											@else
												@if($event->currency == 'cad'){{ 'C$' }}@elseif($event->currency == 'usd'){{ '$' }}@elseif($event->currency == 'cny'){{ '¥' }}@elseif($event->currency == 'eur'){{ '€' }}@endif{{ $event->fee }}
											@endif
											</p>
										</div>

										<div class="interested">
											<div class="interestcount"><img src="{{ asset('img/likes_icon.png') }}" width="15"> {{ $event->likes->count() }}</div>
										</div>
										<div class="postfrom">
											From: <a href="/brands/{{ ($event->group->slug) }}">{{ ($event->group->name) }}</a>
										</div>
							</div>
						</div>
						<?php $i++;?>
					@endforeach
				</div>
			</div>
		</div>
	</div>
</div>
@endsection
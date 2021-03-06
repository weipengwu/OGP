@extends('layouts.master')

@section('content')
<div class="container eventindex">
	<div class="row">
		<div class="col-md-12">
			<div class="panel">
				<div class="heading"><h1>{{ trans('events.browseevents') }}</h1>
				<?php if(isset($_GET['category'])){
						$cat = $_GET['category'];
					}?>
					<form>
						<select id="category" class="form-control">
								<option value="">{{ trans('events.allcategories') }}</option>
								<option value="{{ urlencode('Arts & Design') }}" <?php if(isset($_GET['category']) && $cat == 'Arts & Design') echo "selected";?>>{{ trans('brands.artsdesign') }}</option>
								<option value="Autos" <?php if(isset($_GET['category']) && $cat == 'Autos') echo "selected";?>>{{ trans('brands.autos') }}</option>
								<option value="Business" <?php if(isset($_GET['category']) && $cat == 'Business') echo "selected";?>>{{ trans('brands.business') }}</option>
								<option value="Education" <?php if(isset($_GET['category']) && $cat == 'Education') echo "selected";?>>{{ trans('brands.education') }}</option>
								<option value="Fashion" <?php if(isset($_GET['category']) && $cat == 'Fashion') echo "selected";?>>{{ trans('brands.fashion') }}</option>
								<option value="{{ urlencode('Food & Drink') }}" <?php if(isset($_GET['category']) && $cat == 'Food & Drink') echo "selected";?>>{{ trans('brands.fooddrink') }}</option>
								<option value="Gaming" <?php if(isset($_GET['category']) && $cat == 'Gaming') echo "selected";?>>{{ trans('brands.gaming') }}</option>
								<option value="Health" <?php if(isset($_GET['category']) && $cat == 'Health') echo "selected";?>>{{ trans('brands.health') }}</option>
								<option value="Home" <?php if(isset($_GET['category']) && $cat == 'Home') echo "selected";?>>{{ trans('brands.home') }}</option>
								<option value="{{ urlencode('Music & Performance') }}" <?php if(isset($_GET['category']) && $cat == 'Music & Performance') echo "selected";?>>{{ trans('brands.musicperformances') }}</option>
								<option value="Sports" <?php if(isset($_GET['category']) && $cat == 'Sports') echo "selected";?>>{{ trans('brands.sports') }}</option>
								<option value="{{ urlencode('Technology & Science') }}" <?php if(isset($_GET['category']) && $cat == 'Technology & Science') echo "selected";?>>{{ trans('brands.technologyscience') }}</option>
								<option value="Travel" <?php if(isset($_GET['category']) && $cat == 'Travel') echo "selected";?>>{{ trans('brands.travel') }}</option>
								<option value="Other" <?php if(isset($_GET['category']) && $cat == 'Other') echo "selected";?>>{{ trans('brands.other') }}</option>
						</select>
						<?php if(isset($_GET['time'])){
							$time = $_GET['time'];
						}?>
						<select id="eventtime" class="form-control">
							<option value="">{{ trans('events.alltimes') }}</option>
							<option value="thisweek" <?php if(isset($_GET['time']) && $time == 'thisweek') echo "selected";?>>{{ trans('events.thisweek') }}</option>
							<option value="nextweek" <?php if(isset($_GET['time']) && $time == 'nextweek') echo "selected";?>>{{ trans('events.nextweek') }}</option>
						</select>
					</form>
				</div>
				<div class="event-body">
					<?php $i = 1; ?>
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
												date_default_timezone_set($event->timezone);
													if(date('M j',$event->fromtime) == date('M j',$event->totime)) : 
														if(Config::get('app.locale') == 'en'):
												?>
															{{ date('D, M j',$event->fromtime) }} @ {{ date('g : i a',$event->fromtime) }} - {{ date('g : i a' ,$event->totime) }}
														<?php else: ?>
															{{ zhweekday(date('D',$event->fromtime)) }} {{ date('n',$event->fromtime) }}月{{ date('j',$event->fromtime) }}日 {{ date('g : i a',$event->fromtime) }} - {{ date('g : i a',$event->totime) }}
														<?php endif;?>
												<?php else: ?>
													<?php if(Config::get('app.locale') == 'en'):?>
														{{ date('M j',$event->fromtime) }} - {{ date('M j',$event->totime) }}
													<?php else: ?>
														{{ date('n',$event->fromtime) }}月{{ date('j',$event->fromtime) }}日 - {{ date('n',$event->totime) }}月{{ date('j',$event->totime) }}日
													<?php endif;?>
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
											@if(Auth::check())
												<div class="interestcount">
												@if(alreadyLikedEvent(Auth::user()->id,$event->id) > 0)
													<span><a href="" data-toggle="tooltip" title="{{ trans('events.notinterested') }}" data-event-id="{{ $event->id }}" data-author-id="{{ Auth::user()->id }}" class="like_btn event_unlike"><img src="{{ asset('img/already_likes_icon.png') }}" width="16"></a></span>
												@else
													<span><a href="" data-toggle="tooltip" title="{{ trans('events.interested') }}" data-event-id="{{ $event->id }}" data-author-id="{{ Auth::user()->id }}" class="like_btn event_like"><img src="{{ asset('img/likes_icon.png') }}" width="16"></a></span>
												@endif
													<span class="likenum">{{ $event->likes->count()}}</span></div>
											@else
											<div class="interestcount"><img src="{{ asset('img/likes_icon.png') }}" width="16"> {{ $event->likes->count() }}</div>
											@endif
										</div>
										<div class="postfrom">
											{{ trans('posts.from') }} <a href="/brands/{{ ($event->group->slug) }}">{{ ($event->group->name) }}</a>
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
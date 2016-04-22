@extends('layouts.master')

@section('content')
	<div class="container admin">
		@if(Auth::id() == '1' || Auth::id() == '4')
		<div class="row">
			<aside class="col-md-3">
				<ul>
					<li><a href="{{ url() }}/adminogp">Dashboard</a></li>
					<li><a href="{{ url() }}/adminogp/users">Users</a></li>
					<li><a href="{{ url() }}/adminogp/brands">Brands</a></li>
					<li><a href="{{ url() }}/adminogp/posts">Posts</a></li>
					<li><a href="{{ url() }}/adminogp/tickets">Tickets</a></li>
				</ul>
			</aside>
			<section class="col-md-9">
				<h2>Admin/Brands</h2>
				<table class="table table-striped">
					<tbody>
						<tr>
							<td><strong>Brand Name</strong></td>
							<td><strong>Category</strong></td>
							<td class="center"><strong>Featured</strong></td>
							<td class="center"><strong>Status</strong></td>
							<td class="center"><strong>Actions</strong></td>
						</tr>
						@foreach($brands as $brand)
							<tr>
								<td>{{ $brand->name }}</td>
								<td>{{ $brand->category }}</td>
								<td class="center">
									@if($brand->featured == '1')
										<a href="" class="brandfeatured brandunf"><i class="fa fa-star"></i></a>
									@else
										<a href="" class="brandfeatured brandf"><i class="fa fa-star-o"></i></a>
									@endif
								</td>
								<td class="center status">{{ $brand->verified ? 'Active' : 'Pending' }}</td>
								<td class="center">
									@if($brand->verified == '1')
										<a href="" data-brand="{{ $brand->id }}" class="brandaction branddis"><i class="fa fa-times-circle-o"></i></a>
									@else
										<a href="" data-brand="{{ $brand->id }}" class="brandaction brandappr"><i class="fa fa-check-square-o"></i></a>
									@endif
								</td>
							</tr>
						@endforeach
					</tbody>
				</table>
			</section>
		</div>
		<script type="text/javascript">
			$('body').on('click', '.brandappr', function(e){
				e.preventDefault();
				$.ajaxSetup({
				   headers: { 'X-CSRF-Token' : $('meta[name=_token]').attr('content') }
				});
				var that = $(this);
				var bid = $(this).data('brand');
				$.ajax({
					type: "POST",
					url: window.location.origin+"/brand/approve",
					data: "brand="+bid
				}).done(function(response){
					that.removeClass('brandappr');
					that.addClass('branddis');
					that.html('<i class="fa fa-times-circle-o">');
					that.parent().prev().html(response);
				})
			})
			$('body').on('click', '.branddis', function(e){
				e.preventDefault();
				$.ajaxSetup({
				   headers: { 'X-CSRF-Token' : $('meta[name=_token]').attr('content') }
				});
				var that = $(this);
				var bid = $(this).data('brand');
				$.ajax({
					type: "POST",
					url: window.location.origin+"/brand/disapprove",
					data: "brand="+bid
				}).done(function(response){
					that.removeClass('branddis');
					that.addClass('brandappr');
					that.html('<i class="fa fa-check-square-o">');
					that.parent().prev().html(response);
				})
			})
		</script>
		@else
			<h4>You should not be here!</h4>
		@endif
	</div>
@endsection
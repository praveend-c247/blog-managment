@extends('front-layout.app')
@section('content')
	<!-- pricing table  -->
		<section id="pricing" class="pricing-content section-padding">
			<div class="container">					
				<div class="section-title text-center">
					<h2>Subscriptions</h2>
					<p>It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout.</p>
				</div>				
				<div class="card-group row">
					@foreach($subscriptionList as $key => $value)		
						<div class="card">
							@if(count($value['getUser']) > 0)
								@if( $value->id == $value['getUser'][0]->subscription_plan_id )
									<p class="category-tag popular">Active</p>
								@endif
							@endif
							<div class="card-body" style="margin: 0rem !important;">
								@if($key == 1)
									<div class="" style="text-align: end;padding: 0px!important;">
										<span style="background-color: #3df29d;">Recommended</span>
									</div>
								@endif
								<div class="single-pricing  text-center">
									<div class="price-head">		
										<h1>{{$value->plan_name}}</h1>
										<h2>{{$value->amount}}</h2>
									</div>
									<ul>
										<li><b>{{$value->blog_count}}</b> Blogs</li>
									</ul>
									<div class="pricing-price">
										
									</div>
									@if(count($value['getUser']) <= 0)
										<a href="{{ route('user.checkout',$value->id)}}" class="price_btn order_now_btn" data-id="">Order Now</a>
									@endif
									
								</div>
							</div>
						</div><!--- END COL -->
					@endforeach
				</div><!--- END ROW -->
			</div><!--- END CONTAINER -->
		</section>
	<!-- end priceing table -->
@endsection
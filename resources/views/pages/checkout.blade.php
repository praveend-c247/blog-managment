@extends('front-layout.app')
@section('content')
    <div class="text-center">        
        <h2>Checkout</h2>
    </div>
    <div class="row">
        <div class="col-md-4 order-md-2 mb-4">
            <h4 class="d-flex justify-content-between align-items-center mb-3">
                <span class="text-muted">Your cart</span>
            </h4>
            <ul class="list-group mb-3 sticky-top">
                <li class="list-group-item d-flex justify-content-between lh-condensed">
                    <div>
                        <h6 class="my-0">{{$subscriptionPlan->plan_name}}</h6>
                        <small class="text-muted"><b>{{$subscriptionPlan->blog_count}}</b> Blogs</small>
                    </div>
                    <span class="text-muted">{{$subscriptionPlan->amount}}</span>
                </li>
                
                <li class="list-group-item d-flex justify-content-between">
                    <span>Total</span>
                    <strong>{{$subscriptionPlan->amount}}</strong>
                </li>
            </ul>
        </div>
        <div class="col-md-8 order-md-1">
            <h4 class="mb-3">Billing</h4>
            <form method="POST" action="{{ route('user.buynow') }}" id="formValidate">
                @csrf
                <div class="row">
                    <input type="hidden" name="id" value="{{$userInfo->id}}">
                    <input type="hidden" name="subscription_plan_id" value="{{$subscriptionPlan->id}}">
                    <div class="col-md-6 mb-3">
                        <label for="firstName">Name</label>
                        <input type="text" class="form-control" id="firstName" placeholder="" name="name" value="{{$userInfo->name}}" data-rule-required="true"data-msg-required="{{__('validationMessage.name')}}" readonly>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="email">Email </label>
                    <input type="email" class="form-control" id="email" name="email" placeholder="you@example.com" value="{{$userInfo->email}}" data-rule-required="true" data-msg-required="{{__('validationMessage.email')}}" readonly>
                    </div>
                </div>
                <div class="mb-3">
                    <label for="address">Contact No</label>
                    <input type="text" class="form-control" id="contact_no" name="contact_no" value="{{$userInfo->contact_no}}" data-rule-required="true"data-msg-required="{{__('validationMessage.contact_no')}}">
                </div>
                <div class="mb-3">
                    <label for="address">Address</label>
                    <input type="text" class="form-control" id="address" name="address" value="{{$userInfo->address}}" data-rule-required="true"data-msg-required="{{__('validationMessage.address')}}">
                </div>
                <!-- <div class="mb-3">
                    <label for="address2">Address 2 <span class="text-muted">(Optional)</span></label>
                    <input type="text" class="form-control" id="address2" placeholder="Apartment or suite">
                </div> -->
                <button class="btn btn-primary btn-lg btn-block" type="submit">Buy Now</button>
            </form>
        </div>
    </div>
@endsection
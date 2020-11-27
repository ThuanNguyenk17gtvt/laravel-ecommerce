@extends('fontend.master')
@section('title','Thanh toán trực tuyến')
@section('main')
<div class="col-md-9 col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">	
	<div class="container">
		<div class="row">
		    <ul style="list-style: none;">
		        <li><a href="{{asset('paypal/pay/ec-checkout')}}">Express Checkout</a></li>
		        <li><a href="{{asset('paypal/pay/ec-checkout?mode=recurring')}}">Create Recurring Payments Profile</a></li> 
		    </ul>
		</div>
	</div>
</div>	
@stop
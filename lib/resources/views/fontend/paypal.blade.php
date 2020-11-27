@extends('fontend.master')
@section('title','Thanh toán')
@section('main')
<link rel="stylesheet" href="css/paypal.css"> 
	<section id="body">
		<div class="container">
			<div class="row">
				<div class="title">
					<h3>Chào mừng bạn đến cổng thanh toán của Shop</h3>
				</div>
				<div class="main">
					<h4>Bạn hãy chọn hình thức thanh toán cho đơn hàng</h4>
					<ul>
						<li>Mã đơn hàng: {{$order->id}} </li>
						<li>Người mua: {{Auth::user()->name}}</li>
						<li>Tổng tiền: {{number_format($order->total,'0','.',',')}} VNĐ</li>
						<li>SĐT: {{$order->phone}}</li>
						<li>Địa chỉ: {!!$order->address!!}</li>
					</ul>
					<form action="{{url('paypal/'.$order->id)}}" method="post">
						<ul>
							<li>
								<input type="radio" value="1" name="pay_pal" >Thanh toán bằng paypal
							</li>
							<li>
								<input type="radio" checked value="0" name="pay_pal"> Tiền mặt
							</li>
						</ul>
						{{csrf_field()}}
						<button class="btn btn-default action"  type="submit">Thực hiện</button>
					</form>
				</div>
			</div>
		</div>
	</section>
@stop

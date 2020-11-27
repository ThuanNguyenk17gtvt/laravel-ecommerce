@extends('fontend.master')
@section('title','Thông tin')
@section('main')
<link rel="stylesheet" href="css/information.css">
	<style>
		#footer{
			top: 100%;
		}
	</style>
	<section id="body" >
		<div class="container main" style="height: 460px;">
			<div class="row">
				<div class="col-md-12">
                    <ul class="bill">
		                <table class="table table-bordered " >
		                	 <thead >
		                        <tr class="bg-infor">
		                            <th >STT</th>
		                            <th >Tên sản phẩm</th>
		                            <th >Ảnh sản phẩm</th>
		                            <th >Số lượng</th>
		                            <th>Khuyến mãi</th>
		                            <th >Giá sản phẩm</th>
		                            <th>Thành tiền</th>
		                        </tr>
		                    </thead>
		                    <tbody>
		                    	@foreach($items as $item)
		                        <tr>
		                            <td>{{ $loop->index }}</td>
		                            <td>{{$item->prod_name}}</td>
		                            <td><img src="{{asset('lib/storage/app/avatar/'.$item->prod_img)}}" alt=""></td>
		                            <td>{{$item->amount}}</td>
		                            <td>{{$item->prod_promotion}} %</td>
		                            <td>{{number_format($item->price,'0',',','.')}}  VNĐ</td>
		                            <td>{{ number_format($item->amount*($item->price-($item->price*$item->prod_promotion/100)),'0',',','.')}} VNĐ</td>
		                        </tr>
		                        @endforeach
		                    </tbody>
		                </table>
		                <li>Tổng tiền của đơn hàng này là:  {{number_format($orders->total,'0',',','.')}} VNĐ</li>
		                <li><a href="{{asset('information/'.Auth::user()->name_id)}}">Quay lại</a></li>
                    </ul>
				</div>
			</div>
		</div>
	</section>
@stop

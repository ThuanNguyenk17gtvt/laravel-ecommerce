@extends('admin.master')
@section('title','Quản lý đơn hàng')
@section('main')
<div class="col-md-9 col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">	
    
	<table class="table table-bordered " id="cart" >
        <thead >
            <tr class="bg-infor">
            	<th>STT</th>
                <th>Tên sản phẩm</th>
                <th>Hình ảnh</th>
                <th>Số lượng</th>
                <th>Giá tiền</th>
                <th>Khuyến mãi</th>
                <th>Bào hành</th>
                <th>Phụ kiện</th>
                <th>Thành tiền</th>
            </tr>
        </thead>
        <tbody>
        	@foreach($items as $item)
            <tr>
            	<td>{{ $loop->index }}</td>
                <td>{{$item->prod_name}}</td>
                <td><img style="height: 100px; width: 80px;" src="{{asset('lib/storage/app/avatar/'.$item->prod_img)}}" alt=""></td>
                <td>{{$item->amount}}</td>
                <td>{{number_format($item->price,'0',',','.')}} VNĐ</td>
                <td>{{$item->prod_promotion}} %</td>
                <td>{{$item->prod_warranty}} tháng</td>
                <td>@if($item->prod_acccessories==null) Không có @else {{$item->prod_acccessories}} @endif</td>
                <td>{{number_format($item->amount*($item->price-($item->price*$item->prod_promotion/100)),'0',',','.')}} VNĐ</td>
            </tr>
            @endforeach
        </tbody>
    </table>
    <p>Khách hàng: {{$order->name}}</p>
    <p>SĐT: {{$order->phone}}</p>
    <p>Tổng tiền của đơn hàng này là: {{number_format($order->total,'0',',','.')}} VNĐ</p>
    <a href="{{asset('admin/cart')}}">Quay lại</a>
</div>	
@stop
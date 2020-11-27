@extends('admin.master')
@section('title','Quản lý đơn hàng')
@section('main')
 <meta http-equiv="refresh" content="10; URL=http://localhost:8080/cnpm/admin/cart">
<link rel="stylesheet" href="css/cart.css">
<div class="col-md-9 col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">	 
    <div class="spinner">
      <div class="blob blob-0"></div>
    </div>
    @if ( Session::has('success') )
        <div class="alert alert-success alert-dismissible" role="alert">
            <strong>{{ Session::get('success') }}</strong>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                <span class="sr-only">Close</span>
            </button>
        </div>
    @endif	
    @include('sweetalert::alert')
    {{-- <form action="{{asset('admin/cart/search/')}}" method="get"  name="cart" onsubmit =" return search()">
        <input type="text" style=" margin-bottom: 20px;" placeholder="Nhập mã đơn hàng" name="id" >
        <button style="cursor: pointer;" id="btn-gui">Tìm kiếm</button>
    </form> --}}
	<table class="table table-bordered " id="cart" >
        <thead >
            <tr class="bg-infor">
            	<th>STT</th>
                <th>Mã</th>
                <th>Khách hàng</th>
                <th>Địa chỉ</th>
                <th>SĐT</th>
                <th>Tổng tiền</th>
                <th>Trạng thái</th>
                <th>Đóng gói</th>
                <th>Ngày mua</th>
                <th>Cập nhật</th>
            </tr>
        </thead>
        <tbody>
        	@foreach($items as $item)
            <tr>
            	<td>{{ $loop->index }}</td>
                <td>{{$item->id}}</td>
                <td>{{$item->name}}</td>
                <td>{!!$item->address!!}</td>
                <td>{{$item->phone}}</td>
                <td>{{number_format($item->total,'0',',','.')}} VNĐ</td>
                <td>@if($item->status == 0) Chưa hoàn thành @else hoàn thành @endif</td>
                <td> @if($item->ready == 0) Chưa xong @else xong @endif </td>
                <td>{{$item->created_at}}</td>
                <td><a href="{{asset('admin/cart/infor/'.$item->id)}}" class ="btn btn-default" style="background: #FF9600;">Xem</a>
                    @if($item->status==0)<a href="{{asset('admin/cart/edit/'.$item->id)}}" class=" btn-default btn" style="background: #FF9600;">Giao</a>@endif
                    @if($item->ready==0)<a href="{{asset('admin/cart/ready/'.$item->id)}}" class=" btn-default btn" style="background: #FF9600;">Xong</a>@endif
                    @if($item->status==0)<a href="{{asset('admin/cart/delete/'.$item->id)}}" class="btn btn-default" style="background: #FF9600;" onclick="return confirm('Bạn có chắc muốn xóa đơn hàng này không?')" >Xóa</a>@endif
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    <p style="color: #eb336e ">Chú ý:</p>
    <p style="color: #eb336e ">Nút Xem : Để xem thông tin chi tiết đơn hàng</p> 
    <p style="color:#eb336e  " >Nút Giao: Cập nhật đơn hàng giao thành công</p>
    <p style="color: #eb336e ">Nút Xong: Cập nhật đơn hàng đóng gói thành công</p>
</div>	
<script type="text/javascript">
    function search(){
        var noidung=document.cart.id.value;
        if(noidung==""){
            alert("Bạn chưa nhập gì vào ô tìm kiếm");
            return false;
        }
    }
    $(window).on("load",function(){
        $(".spinner").fadeOut("slow");
    });
</script>
@stop
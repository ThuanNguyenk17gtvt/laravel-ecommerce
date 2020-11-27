@extends('admin.master')
@section('title','Quản lý')
@section('main')
<div class="col-md-9 col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main main1">
	<h2>Chào mừng đến với trang quản trị của shop</h2>	
	<div class="row">
		<div class="col-md-3 sp">
			<div class="title"><h4>Loại sản phẩm</h4></div>
			<ul>
				<li>Có tất cả: {{count($cates)}} loại sản phẩm </li>
				@foreach($cates as $cate)
				<li>{{$cate->cate_name}}</li>
				@endforeach
			</ul>
		</div>
		<div class="col-md-3 sp">
			<div class="title"><h4>Người dùng</h4></div>
			<ul>
				<li>Có tất cả: {{count($users)}} người dùng</li>
				<li>Super admin: {{count($sp)}}  người</li>
				<li>Admin: {{count($admin)}} người</li>
				<li>Member: {{count($u)}} người</li>
			</ul>
		</div>
		<div class="col-md-3 sp">
			<div class="title"><h4>Sản phẩm</h4></div>
			<ul>
				<li>Có tất cả: {{count($products)}} sản phẩm</li>
				<li>Nổi bật: {{count($featured)}} sản phẩm</li>
				<li>Hàng mới: {{count($moi)}} sản phẩm </li>
				<li>Hàng cũ: {{count($cu)}} sản phẩm</li>
			</ul>
		</div>
	</div>	
	<div class="row">
		<div class="col-md-3 sp">
			<div class="title"><h4>Đơn hàng</h4></div>
			<ul>
				<li>Có tất cả: {{count($orders)}} đơn hàng</li>
				<li>Giao:{{count($ok)}} đơn hàng</li>
				<li>Chưa giao:{{count($notok)}} đơn hàng</li>
			</ul>
		</div>
		<div class="col-md-3 sp">
			<div class="title"><h4>Bình luận</h4></div>
			<ul>
				<li>Có tất cả: {{count($comment)}} bình luận</li>
			</ul>	
		</div>
		<div class="col-md-3 sp">
			<div class="title"><h4>Đánh giá</h4></div>
			<ul>
				<li>Có tất cả: {{count($rating)}} đánh giá</li>
			</ul>
		</div>
	</div>
</div>	

@stop

	

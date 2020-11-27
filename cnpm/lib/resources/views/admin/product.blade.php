@extends('admin.master')
@section('title','Sản phẩm')
@section('main')
	<script type="text/javascript" src="js/jquery-1.12.0.min.js"></script>
	<div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main " style="top: -40px;">
		<div class="row">
			<div class="col-lg-12">
				<h1 class="page-header"><i class="fas fa-mobile-alt"></i>Sản phẩm</h1>
				{{-- <form action="{{asset('admin/product/search/'.$cate->cate_id)}}" method="get" name="sr" id="form-search" onsubmit =" return search()">
					<input type="text" style=" margin-bottom: 20px;" placeholder="Nhập tên sản phẩm" name="name">
					<button style="cursor: pointer;" id="btn-gui" >Tìm kiếm</button>
				</form> --}}
			</div>
		</div><!--/.row-->
		
		<div class="row">
			<div class="col-xs-12 col-md-12 col-lg-12">
				@if ( Session::has('success') )
					<div class="alert alert-success alert-dismissible" role="alert">
						<strong>{{ Session::get('success') }}</strong>
						<button type="button" class="close" data-dismiss="alert" aria-label="Close">
							<span aria-hidden="true">&times;</span>
							<span class="sr-only">Close</span>
						</button>
					</div>
				@endif
				<div class="panel panel-primary">
					<div class="panel-heading">Danh sách sản phẩm</div>
					<div class="panel-body">
						<div class="bootstrap-table">
							<div class="table-responsive">
								<a href="{{asset('admin/product/add/'.$cate->cate_id)}}" class="btn btn-primary" style="margin: 5px 0px 0px 5px;">Thêm sản phẩm</a>
								<a href="{{asset('admin/category')}}" class="btn btn-primary" style="margin:5px 0px 0px 10px;">Quay lại</a>
								<p style="float: right;  margin:15px 800px 0px 0px;">Tổng số mặt hàng là : {{$count}}</p>
								<div style="overflow-x:scroll;">
									<table class="table table-bordered" style="margin-top:20px; " id="table"> 				
										<thead>
											<tr class="bg-primary">
												<th>STT</th>
												<th>ID</th>
												<th width="10%">Tên Sản phẩm</th>
												<th width="15%">Ảnh sản phẩm</th>
												<th>Giá sản phẩm</th>
												<th width="10%">Khuyến mãi</th>
												<th width="10%">Phụ kiện</th>
												<th width="10%">Bảo hành</th>
												<th width="10%">Danh mục</th>
												<th width="10%">Số lượng</th>
												<th width="15%">Miêu tả</th>
												<th width="10%">Hàng nổi bật</th>
												<th width="10%">Tùy chọn</th>
											</tr>
										</thead>
										<tbody>
											@foreach($products as $product)
											<tr>
												<td>{{$loop->index}}</td>
												<td>{{$product->prod_id}}</td>
												<td>{{$product->prod_name}}</td>
												<td>
													<img width="150px" height="170px" src="{{asset('lib/storage/app/avatar/'.$product->prod_img)}}" class="thumbnail">
												</td>
												<td>{{ number_format($product->prod_price,0,',','.').'VNĐ'}}</td>
												<td>{{$product->prod_promotion}}%</td>
												<td>@if($product->prod_acccessories==null) Không có @else {{$product->prod_acccessories}} @endif</td>
												<td>{{$product->prod_warranty}} tháng</td>
												<td>{{$cate->cate_name}}</td>
												<td>{{$product->prod_amount}}</td>
												<td>{!!$product->prod_description!!}</td>
												<td>@if($product->prod_featured ==1) Nổi bật @else Không nổ bật @endif</td>
												<td>
													<a href="{{asset('admin/product/edit/'.$product->prod_id)}}" class="btn btn-warning"><i class="fa fa-pencil" aria-hidden="true"></i> Sửa</a>
													<a href="{{asset('admin/product/delete/'.$product->prod_id)}}" class="btn btn-danger" onclick="return confirm('Bạn có chắc muốn xóa sản phẩm này không?')" ><i class="fa fa-trash" aria-hidden="true"></i> Xóa</a>
												</td>
											</tr>
											@endforeach
										</tbody>
									</table>	
								</div>
							</div>
						</div>
						<div class="clearfix"></div>
					</div>
				</div>
			</div>
		</div><!--/.row-->
	</div>	<!--/.main-->
	<script type="text/javascript">
		function search(){
			var noidung=document.sr.name.value;
			if(noidung==""){
				alert("Bạn chưa nhập gì vào ô tìm kiếm");
				return false;
			}
		}
	</script>
@stop	

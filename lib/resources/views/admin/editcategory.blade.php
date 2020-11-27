@extends('admin.master')
@section('title','Sửa loại sản phẩm')
@section('main')
<meta name="csrf-token" content="{{ csrf_token() }}">
<script src="js/jquery-2.2.3.min.js"></script>
	<div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main" style="top: -40px;">
		<div class="row">
			<div class="col-lg-12">
				<h1 class="page-header">Danh mục sản phẩm</h1>
			</div>
		</div><!--/.row-->
		@if ( Session::has('error') )
			<div class="alert alert-danger alert-dismissible" role="alert">
				<strong>{{ Session::get('error') }}</strong>
				<button type="button" class="close" data-dismiss="alert" aria-label="Close">
					<span aria-hidden="true">&times;</span>
					<span class="sr-only">Close</span>
				</button>
			</div>
		@endif
		<div class="row">
			<div class="col-xs-12 col-md-5 col-lg-5">
					<div class="panel panel-primary">
						<div class="panel-heading">
							Sửa danh mục
						</div>
						<form method="post" >
							<div class="panel-body">
								<div class="form-group">
									<div id="id">{{$cate->cate_id}}</div>
									<label>Tên danh mục:</label>
	    							<input type="text" name="name" class="form-control" placeholder="Tên danh mục..." value="{{$cate->cate_name}}" id="name">
	    							<div id="name_error" style="color: red;"></div>
								</div>
								<div class="form-group">
	    							<input type="submit" name="submit" class="form-control btn btn-primary" value="Sửa" style="margin-left: 150px; width: 200px;" return="confirm('Bạn có chắc muốn sửa không')">
								</div>
								<div class="form-group">
	    							<a href="{{asset('admin/category')}}"  class="form-control btn btn-primary huybo" style="margin-left: 150px; width:200px; ">Hủy bỏ</a>
								</div>
							</div>
							{{csrf_field()}}
						</form>
						
					</div>
			</div>
		</div><!--/.row-->
	</div>	<!--/.main-->
	<script type="text/javascript" >
		document.getElementById("id").style.display="none";
		$.ajaxSetup({
		  headers: {
		    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
		  }
		});
		$("#name").keyup(function(e){
			var id=document.getElementById("id").value;
			var cate_name = $(this).val();
			$.post('{{asset('admin/category/edit/check')}}',{'name':product_name,'cate_id':id},function(data){
				$("#name_error").html(data);
			});
		});

	</script>
@stop
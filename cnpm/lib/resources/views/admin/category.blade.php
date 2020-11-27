@extends('admin.master')
@section('title','Loại sản phẩm')
@section('main')
<link href="css/category.css" rel="stylesheet">
<script type="text/javascript" src="js/jquery-1.12.0.min.js"></script>
<script src="js/jquery-2.2.3.min.js"></script>
<meta name="csrf-token" content="{{ csrf_token() }}">
	<div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main  main1"> 
		<div class="row">
			<div class="col-lg-12">
				<h1 class="page-header">Loại sản phẩm</h1>
			</div>
		</div><!--/.row-->
		
		<div class="row">
			<div class="col-xs-12 col-md-5 col-lg-5">
					<div class="panel panel-primary">
						<div class="panel-heading">
							Thêm danh mục
						</div>
						<div class="panel-body">
							<form role="form" method="post" id="form-category" name="category" onsubmit="return submit()" action="{{url('admin/category')}}">
								<div class="form-group">
								<label>Tên danh mục:</label>
								<input  type="text" name="name" class="form-control" placeholder="Tên danh mục..." onkeyup="check()" id="name" >
								<div id="name_error" style="color: #d95629; "></div>
								<div id="name_error1" style="color: #d95629; "></div>
								 @if ($errors->has('name'))
                                    <span class="help-block">
                                        <strong style="color: red;">{{ $errors->first('name') }}</strong>
                                    </span>
                                 @endif
								</div>
								<div class="form-group">
									<input type="submit" name="submit" class=" form-control btn btn-primary " placeholder="Tên danh muc..." value="Thêm mới" style="width:100px; margin-left: 200px;" id="btn-gui">
								</div>
								{{csrf_field()}}
							</form>
						</div>
					</div>
			</div>
			<div class="col-xs-12 col-md-7 col-lg-7">
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
					<div class="panel-heading">Danh sách danh mục</div>
					<div class="panel-body">
						<div class="bootstrap-table">
							<table class="table table-bordered">
				              	<thead>
					                <tr class="bg-primary">
					                  <th>Tên danh mục</th>
					                  <th style="width:40%">Tùy chọn</th>
					                </tr>
				              	</thead>
				              	<tbody>
				              		@foreach($cate as $cates)
								<tr>
									<td>{{$cates->cate_name}}</td>
									<td>
										<a href="{{asset('admin/product/'.$cates->cate_id)}}" class="btn btn-primary"><i class="fas fa-eye"></i>Xem</a>
			                    		<a href="{{asset('admin/category/edit/'.$cates->cate_id)}}" class="btn btn-warning"><i class="far fa-edit"></i> Sửa</a>
			                    		<a href="{{asset('admin/category/delete/'.$cates->cate_id)}}" onclick="return confirm('Bạn có chắc chắn muốn xóa?')" class="btn btn-danger"><i class="far fa-trash-alt"></i> Xóa</a>
			                  		</td>
			                  	</tr>
			                  	@endforeach
				                </tbody>
				            </table>
						</div>
						<div class="clearfix"></div>
					</div>
				</div>
			</div>
		</div><!--/.row-->
	</div>	<!--/.main-->
	{{-- <script type="text/javascript">
        $(document).ready(function()
        {   
            $("#btn-gui").click(function(e) 
            {
                e.preventDefault();
                var noidung= document.category.name.value;
                if (noidung == '') {
                    alert("Bạn chưa nhập nhập tên loại sản phẩm");
                    return false;
                     // location.reload();
                }
                 
                var data = $('form#form-category').serialize();
                $.ajax({
                type : 'POST', //kiểu post
                url  : '{{asset('admin/category')}}', 
                data : data,
                success :  function(data)
                       {                       
                        // $('#comment-list').html(data);
                        location.reload();
                       }
                });
                return false;
            });
            
        });
    </script> --}}
    <script type="text/javascript">
    	$.ajaxSetup({
		  headers: {
		    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
		  }
		});
     	function check(){
     		var noidung= document.getElementById('name').value;
     		var k=0;
     		if (noidung=="") {
     			document.getElementById('name_error').innerHTML="Bạn chưa nhập tên loại sản phẩm";
     		}
     		else{
     			document.getElementById('name_error').innerHTML="";
     		}
     	}
     	function submit(){
     		var error= document.getElementById('name_error1').value;
     		var error1=document.getElementById('name_error').value;
     		if (!error || !error1) {
     			return false;
     		}
     	}
     	$("#name").keyup(function(e){
     		var cate_name = $(this).val();
			$.post('{{asset('admin/category/check')}}',{'name':cate_name},function(data){
				$("#name_error1").html(data);
			});
     	});
    </script>
@stop	
@extends('admin.master')
@section('title',' Thêm sản phẩm')
@section('main')
	<script src="js/jquery.validate.min.js" ></script>
	<meta name="csrf-token" content="{{ csrf_token() }}">
	<script src="js/jquery-1.11.3.min.js" ></script>
	<link rel="stylesheet" href="css/addproduct.css">
	<div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main" style="top: -45px;">
		<div class="row">
			<div class="col-lg-12">
				<h1 class="page-header"><i class="fas fa-mobile-alt"></i>Sản phẩm của &nbsp; {{$cate->cate_name}}</h1>
			</div>
		</div><!--/.row-->
		<div class="row">
			<div class="col-xs-12 col-md-12 col-lg-12">  
				<div class="panel panel-primary">
					<div class="panel-heading"><p>Thêm sản phẩm của &nbsp; {{$cate->cate_name}}</p></div>
					<div id="cate_name">{{$cate->cate_name}}</div>
					<div class="panel-body">
						@if ( Session::has('error') )
							<div class="alert alert-danger alert-dismissible" role="alert">
								<strong>{{ Session::get('error') }}</strong>
								<button type="button" class="close" data-dismiss="alert" aria-label="Close">
									<span aria-hidden="true">&times;</span>
									<span class="sr-only">Close</span>
								</button>
							</div>
						@endif
						<form role="form" method="post" enctype="multipart/form-data" name ="vform" onsubmit=" return check()" action="{{url('admin/product/add/'.$cate->cate_id)}}">
							<div class="row" style="margin-bottom:40px">
								<div class="col-xs-8">
									<div class="form-group" >
										 <label>Mã sản phẩm <label class="note"> * (Bắt buộc)</label></label> 
										<input   type="text" id="product_id" name="product_id" class="form-control" value="{{old('product_id')}}"  onkeyup="check()" onkeydown="checkerror()" placeholder="Bạn phải nhập mã sản phẩm bắt đầu bằng chữ cái đầu tiên của loại sản phẩm VD: L01 của loại sản phẩm LG" onkeypress="error()">
										<div id="id_error" style="color: #bf2910;"></div>
										<div id="id_error1" style="color: #bf2910;"></div>
										<div id="id"></div>
										@if ($errors->has('product_id'))
                                    		<span class="help-block" id="hb-id">
                                        		<strong style="color: #bf2910;">{{ $errors->first('product_id') }}</strong>
                                    		</span>
                                		@endif
									</div>
									<div class="form-group" >
										<label>Tên sản phẩm <label class="note"> * (Bắt buộc)</label></label> 
										<input  type="text" name="name" id="name" class="form-control" value="{{old('name')}}"  onkeyup="check()" onkeydown="checkerror()" placeholder="Tên sản phẩm không được để trống">
										<div id="name_error2" style="color: #bf2910;"></div>
										<div id="name_error" style="color: #bf2910;"></div>
										 @if ($errors->has('name'))
	                                    <span class="help-block" id="hb-name">
	                                        <strong style="color: #bf2910;">{{ $errors->first('name') }}</strong>
	                                    </span>
	                                    @endif
									</div>
									<div class="form-group" >
										<label>Giá sản phẩm <label class="note"> * (Bắt buộc) </label></label>
										<input  type="number" name="price"  id="price" class="form-control" value="{{old('price')}}"  onkeyup="check()" onkeydown="checkerror()" placeholder="Giá sản phẩm phải lớn 0">
										<div id="price_error" style="color:#bf2910;"></div>
										 @if ($errors->has('price'))
	                                    <span class="help-block" id="hb-price">
	                                        <strong style="color:#bf2910;">{{ $errors->first('price') }}</strong>
	                                    </span>
	                                    @endif
									</div>
									<div class="form-group" >
										<label>Ảnh sản phẩm <label class="note"> * (Bắt buộc) </label></label>
										<img id="avatar" class="thumbnail" width="300px" src="img/pointer-icon.png" >
										<input  id="img" type="file" name="img" class="form-control hidden" onchange="changeImg(this)" value="{{old('img')}}">
					                    <div id="img_error" style="color:#bf2910;"></div>
					                    <div id="img_error1" style="color:#bf2910;"></div>
					                     @if ($errors->has('img'))
	                                    <span class="help-block" id="hb-img">
	                                        <strong style="color: #bf2910;">{{ $errors->first('img') }}</strong>
	                                    </span>
	                                    @endif
									</div>
									<div class="form-group" >
										<label>Phụ kiện </label>
										<input  id="accessories" type="text" name="accessories" class="form-control" value="{{old('accessories')}}" placeholder="Phụ kiện không phải là trường bắt buộc">
									</div>
									<div class="form-group" >
										<label>Bảo hành <label class="note"> * (Bắt buộc) </label></label>
										<input id = "warranty"  type="number" name="warranty" class="form-control" value="{{old('warranty')}}"  onkeyup="check()" onkeydown="checkerror()" placeholder="Bào hành phải lớn hơn hoặc bằng 0">
										<div id="warranty_error" style="color:#bf2910;"></div>
										 @if ($errors->has('warranty'))
	                                    <span class="help-block" id="hb-warranty">
	                                        <strong style="color: #bf2910;">{{ $errors->first('warranty') }}</strong>
	                                    </span>
	                                    @endif
									</div>
									<div class="form-group" >
										<label>Khuyến mãi <label class="note"> * (Bắt buộc) </label></label>
										<input id="promotion" type="number" name="promotion" class="form-control" value="{{old('promotion')}}"  onkeyup="check()" onkeydown="checkerror()" placeholder="Khuyến mãi phải lớn hơn hoặc bằng 0">
										<div id="promotion_error" style="color:#bf2910;"></div>
										 @if ($errors->has('promotion'))
	                                    <span class="help-block" id="hb-promotion">
	                                        <strong style="color: #bf2910;">{{ $errors->first('promotion') }}</strong>
	                                    </span>
	                                    @endif
									</div>
									<div class="form-group" >
										<label>Tình trạng <label class="note"> * (Bắt buộc) </label></label><br>
										Hàng mới: <input type="radio" checked name="condition" value="1">
										Hàng cũ: <input type="radio"  name="condition" value="0"> 
										<div id="condition_error" style="color:#bf2910;"></div>
										 @if ($errors->has('condition'))
	                                    <span class="help-block" id="hb-condition">
	                                        <strong style="color: #bf2910;">{{ $errors->first('condition') }}</strong>
	                                    </span>
	                                    @endif
									</div>
									<div class="form-group" >
										<label>Miêu tả <label class="note"> * (Bắt buộc) </label></label>
										<textarea id="description" name="description"> {{old('description')}}
										</textarea>
										<script type="text/javascript">
											var editor = CKEDITOR.replace('description',{
												language:'vi',
												filebrowserImageBrowseUrl: '../../editor/ckfinder/ckfinder.html?Type=Images',
												filebrowserFlashBrowseUrl: '../../editor/ckfinder/ckfinder.html?Type=Flash',
												filebrowserImageUploadUrl: '../../editor/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Images',
												filebrowserFlashUploadUrl: '../../public/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Flash',
											});
											editor.on("instanceReady", function(){
												this.document.on("keyup", check);
											});
										</script>
										<div id="description_error" style="color:#bf2910;"></div>
										 @if ($errors->has('description'))
	                                    <span class="help-block" id="hb-description">
	                                        <strong style="color: #bf2910;">{{ $errors->first('description') }}</strong>
	                                    </span>
	                                    @endif
									</div>
									<div class="form-group" >
										<label>Sản phẩm nổi bật</label><br>
										Có: <input type="radio" id="featured" checked name="featured" value="1">
										Không: <input type="radio"  id="featured"  name="featured" value="0">
										<div id="featured_error" style="color:#bf2910;"></div>
										 @if ($errors->has('featured'))
	                                    <span class="help-block" id="hb-featured">
	                                        <strong style="color: #bf2910;">{{ $errors->first('featured') }}</strong>
	                                    </span>
	                                    @endif
									</div>
									<div class="form-group" >
										<label> Số lượng sản phẩm thêm vào <label class="note"> * (Bắt buộc)</label></label><br>
										<input id="number" type="number" name="number" value="{{old('number')}}"  onkeyup="check()" onkeydown="checkerror()" placeholder="Số lượng phải lớn 0">
										<div id="number_error" style="color:#bf2910;"></div>
										 @if ($errors->has('number'))
	                                    <span class="help-block" id="hb-number">
	                                        <strong style="color: #bf2910;">{{ $errors->first('number') }}</strong>
	                                    </span>
	                                    @endif
									</div>
									<div class="form-group">
										<input type="submit" name="submit" value="Thêm" class="btn btn-primary">
										<a href="{{asset('admin/product/'.$cate->cate_id)}}" class="btn btn-danger">Hủy bỏ</a>
									</div>
								</div>
							</div>
							{{csrf_field()}}
						</form>
						<div class="clearfix"></div>
					</div>
				</div>
			</div>
		</div><!--/.row-->
	</div>	<!--/.main-->
	{{-- <script type="text/javascript" src="js/product.js"></script> --}}
	{{-- <script src="js/jquery-1.11.1.min.js"></script> --}}
	<script src="js/jquery-2.2.3.min.js"></script>
	<script src="js/bootstrap.min.js"></script>
	<script src="js/chart.min.js"></script>
	<script src="js/chart-data.js"></script>
	<script src="js/easypiechart.js"></script>
	<script src="js/easypiechart-data.js"></script>
	<script src="js/bootstrap-datepicker.js"></script>
	<script>
		$('#calendar').datepicker({
		});
		!function ($) {
		    $(document).on("click","ul.nav li.parent > a > span.icon", function(){          
		        $(this).find('em:first').toggleClass("glyphicon-minus");      
		    }); 
		    $(".sidebar span.icon").find('em:first').addClass("glyphicon-plus");
		}(window.jQuery);
		$(window).on('resize', function () {
		  if ($(window).width() > 768) $('#sidebar-collapse').collapse('show')
		})
		$(window).on('resize', function () {
		  if ($(window).width() <= 767) $('#sidebar-collapse').collapse('hide')
		});
		function changeImg(input){if(input.files && input.files[0]){
		        var reader = new FileReader();
		        //Sự kiện file đã được load vào website
		        reader.onload = function(e){
		            //Thay đổi đường dẫn ảnh
		            $('#avatar').attr('src',e.target.result);
					check();
					var hinh = document.getElementById('img').value;
					var anh=hinh.lastIndexOf("\\");
					$.post('{{asset('admin/product/check_img')}}',{'img_check':hinh.slice(anh+1)},function(data){
						$("#img_error1").html(data);
					});
		        }
		        reader.readAsDataURL(input.files[0]);
		    }
		    //Nếu như tồn thuộc tính file, đồng nghĩa người dùng đã chọn file mới 
		    
		}
		$(document).ready(function() {
		    $('#avatar').click(function(){
		        $('#img').click();
		    });
		});
	</script>	
	<script type="text/javascript">
		var product_id=document.sanpham.product_id.value;
		var product_id-error=document.getElementById("id_error");
		product_id.addEventListener("blur",idVerify,true);
		function validate(){
			if (product_id=='') {
				product_id.style.border="1px solid red";
				product_id-error.textContent="Mã sản phẩm không được để rỗng";
				product_id.focus();
				return false;
			}
		}
		function idVerify(){
			if (true) {}
		}
	</script>
	<script type="text/javascript">
	document.getElementById('cate_name').style.display="none";
	function error(){
		var cate_name=document.getElementById('cate_name').innerHTML;
		var id=document.getElementById('product_id').value;
        if (id.substr(0,1)!= cate_name.substr(0,1)) {
        	document.getElementById('id').innerHTML="Bạn chưa nhập mã loại sản phẩm đúng định dạng";
        	return false;
        }else{
        	document.getElementById('id').innerHTML="";
        	return true;
        }
	}
	// $.("#product_id").keypress(function(e){
	// 	 var cate_name=document.getElementById('cate_name').innerHTML;
	// 	 var id=document.getElementById('product_id').value;
	//         if (id.substr(0,1)!= cate_name.substr(0,1)) {
	//         	document.getElementById('id').innerHTML="Bạn chưa nhập mã loại sản phẩm đúng định dạng";
	//         	return false;
	//         }
	// });
	$.ajaxSetup({
	  headers: {
	    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
	  }
	});
	function check() {
		    var data = new Array();
		    data[0] = document.getElementById('product_id').value;
		    data[1] = document.getElementById('name').value;
		    data[2] = document.getElementById('price').value;
		    data[3] = document.getElementById('warranty').value;
		    data[4] = document.getElementById('promotion').value;
		    data[5] = document.getElementById('number').value;
			data[6] = CKEDITOR.instances.description.getData();
			data[7] = document.getElementById('img').value;
		    var myerror = new Array();
		    myerror[0] = "<span >Bạn chưa nhập mã sản phẩm</span>";
		    myerror[1] = "<span >Bạn chưa nhập tên sản phẩm</span>";
		    myerror[2] = "<span >Bạn chưa nhập giá sản phẩm</span>";
		    myerror[3] = "<span >Bạn chưa nhập số tháng bảo hành</span>";
		    myerror[4] = "<span >Bạn chưa nhập số phần trăm khuyến mãi</span>";
		    myerror[5] = "<span >Bạn chưa nhập số lượng muốn thêm vào kho</span>";
			myerror[6] = "<span >Bạn chưa nhập mô tả</span>";
			myerror[7] = "<span >Bạn cần nhập hình</span>";
			var dinhDangChuan = new Array(".png",".jpg",".jpeg",".gif");
			var li = data[7].lastIndexOf(".");
			var l = 0;
			for (i in dinhDangChuan) {
				if(data[7].slice(li)==dinhDangChuan[i]){
					l++;
				}
			}
		    var nearby = new Array("id_error","name_error2", "price_error","warranty_error","promotion_error","number_error","description_error","img_error");
		    var k=0;
		    for (i in data) {
		        var error = myerror[i];
		        var div = nearby[i];
		        if (data[i]=="") {
		            document.getElementById(div).innerHTML = error;
		            k++;
		        } else {	
		            document.getElementById(div).innerHTML = "";
		        }
		    }
			if(l==0){
				document.getElementById("img_error").innerHTML = "Bạn cần nhập hình đúng định dạng";
				k++;
			}
		    if (k>0) {
		    	return false;
		    }
		   
		}
		function checkerror(){
			var data = new Array();
		    data[0] = document.getElementById('product_id').value;
		    data[1] = document.getElementById('name').value;
		    data[2] = document.getElementById('price').value;
		    data[3] = document.getElementById('warranty').value;
		    data[4] = document.getElementById('promotion').value;
		    data[5] = document.getElementById('number').value;
		    var nearby= new Array("hb-id","hb-name","hb-price","hb-img","hb-warranty","hb-promotion","hb-condition","hb-description","hb-featured","hb-number");
		    for (i in data) {
		    	var div = nearby[i];
		    	if (data[i]=="") {
		    	}
		    	else{
		    		 document.getElementById(div).style.display="none";
		    	}
		    }
		}
		$("#product_id").keyup(function(e){
			var id = $(this).val();
			$.post('{{asset('admin/product/check_id')}}',{'id_check':id},function(data){
				$("#id_error1").html(data);
			});
		});
		$("#name").keyup(function(e){
			var product_name = $(this).val();
			$.post('{{asset('admin/product/check_name')}}',{'name':product_name},function(data){
				$("#name_error").html(data);
			});
		});
	</script>
@stop
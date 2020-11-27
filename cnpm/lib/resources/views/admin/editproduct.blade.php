@extends('admin.master')
@section('title',"Sửa sản phẩm")
@section('main')
<link href="css/editproduct.css" rel="stylesheet">
{{-- <script type="text/javascript" src="js/editproduct.js"></script> --}}
{{-- <script src="js/jquery-1.11.1.min.js"></script> --}}
<script src="js/jquery-2.2.3.min.js"></script>
<meta name="csrf-token" content="{{ csrf_token() }}">
	<div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main" style="top: -45px;">
		<div class="row">
			<div class="col-lg-12">
				<h1 class="page-header"><i class="fas fa-mobile-alt"></i>Sản phẩm</h1>
			</div>
		</div><!--/.row-->
		<div class="row">
			<div class="col-xs-12 col-md-12 col-lg-12">
				<div class="panel panel-primary">
					<div class="panel-heading"><p> Sửa sản phẩm {{$product->prod_name}}</p></div>
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
						<form role="form" method="post" enctype="multipart/form-data"  onsubmit="return check()" action="{{url('admin/product/edit/'.$product->prod_id)}}">
							<div class="row" style="margin-bottom:40px">
								<div class="col-xs-8">
									<div class="form-group" >
										<label>Tên sản phẩm<label class="note"> * (Bắt buộc)</label></label>
										<input id="name"  type="text" name="name" class="form-control" value="{{$product->prod_name}}" onkeyup="check()" placeholder="Bạn phải  nhập tên sản phẩm">
										<div id="name2_error" style="color:red"></div>
										<div id="name_error" style="color:red"></div>
										@if ($errors->has('name'))
                                    		<span class="help-block">
                                        		<strong style="color: red;">{{ $errors->first('name') }}</strong>
											</span>
										@endif
									</div>
									<div class="form-group" >
										<label>Giá sản phẩm<label class="note"> * (Bắt buộc)</label></label>
										<input id="price" type="number" name="price" class="form-control" value="{{$product->prod_price}}" onkeyup="check()" placeholder="Giá sản phẩm phải lớn 0">
										<div id="price_error" style="color:red"></div>
										@if ($errors->has('price'))	
                                    		<span class="help-block">
                                        		<strong style="color: red;">{{ $errors->first('price') }}</strong>
											</span>
                                		@endif
									</div>
									<div class="form-group" >
										<label>Ảnh sản phẩm<label class="note"> * (Bắt buộc)</label></label>
										<input id="img" type="file" name="img" class="form-control hidden" onchange="changeImg(this)">
					                    <img id="avatar" class="thumbnail" width="300px" src="{{asset('lib/storage/app/avatar/'.$product->prod_img)}}">
					                    <div id="img_error" style="color:red"></div>
					                    <div id="img_error1" style="color:red"></div>
										@if ($errors->has('img'))
                                    		<span class="help-block">
                                        		<strong style="color: red;">{{ $errors->first('img') }}</strong>
                                    		</span>
                                		@endif
									</div>
									<div class="form-group" >
										<label>Phụ kiện</label>
										<input id="accessories" type="text" name="accessories" class="form-control" value="{{$product->prod_acccessories}}" placeholder="Phụ kiện không phải trường bắt buộc">
									</div>
									<div class="form-group" >
										<label>Bảo hành<label class="note"> * (Bắt buộc)</label></label>
										<input id="warranty" type="number" name="warranty" class="form-control" value="{{$product->prod_warranty}}" onkeyup="check()" placeholder="Bảo hành phải nhập số lớn hơn hoặc bằng 0">
										<div id="warranty_error" style="color:red"></div>
										@if ($errors->has('warranty'))
                                    		<span class="help-block">
                                        		<strong style="color: red;">{{ $errors->first('warranty') }}</strong>
											</span>
                                		@endif
									</div>
									<div class="form-group" >
										<label>Khuyến mãi<label class="note"> * (Bắt buộc)</label></label>
										<input id="promotion" type="number" name="promotion" class="form-control" value="{{$product->prod_promotion}}" onkeyup="check()" placeholder="Khuyến mãi phải nhập số lớn hơn hoặc bằng 0">
										<div id="promotion_error" style="color:red"></div>
										@if ($errors->has('promotion'))
                                    		<span class="help-block">
                                        		<strong style="color: red;">{{ $errors->first('promotion') }}</strong>
											</span>
                                		@endif
									</div>
									<div class="form-group" >
										<label>Tình trạng <label class="note"> * (Bắt buộc)</label></label><br>
										Hàng mới: <input type="radio"  name="condition" value="1"  @if($product->prod_condition== 1)checked @endif>
										Hàng cũ: <input type="radio"  name="condition" value="0" @if($product->prod_condition== 0)checked @endif> 
										<div id="condition_error" style="color:#bf2910;"></div>
										 @if ($errors->has('condition'))
	                                    <span class="help-block">
	                                        <strong style="color: #bf2910;">{{ $errors->first('condition') }}</strong>
	                                    </span>
	                                    @endif
									</div>
									<div class="form-group" >
										<label>Miêu tả<label class="note"> * (Bắt buộc)</label></label>
										<textarea id="description" name="description" >{{$product->prod_description}}</textarea>
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
										<div id="description_error" style="color: red"></div>
										 @if ($errors->has('description'))
	                                    <span class="help-block">
	                                        <strong style="color: red;">{{ $errors->first('description') }}</strong>
	                                    </span>
	                                    @endif
									</div>
									<div class="form-group" >
										<label>Sản phẩm nổi bật<label class="note"> * (Bắt buộc)</label></label><br>
										Có: <input id="featured" type="radio"   name="featured" value="1" @if($product->prod_featured== 1)checked @endif>
										Không: <input id="featured" type="radio"  name="featured" value="0" @if($product->prod_featured == 0) checked @endif>
										<div id="featured_error" style="color:red"></div>
										@if ($errors->has('featured'))
                                    		<span class="help-block">
                                        		<strong style="color: red;">{{ $errors->first('featured') }}</strong>
                                    		</span>
                                		@endif
									</div>
									<div class="form-group" >
										<label> Số lượng sản phẩm</label><label class="note"> * (Bắt buộc)</label><br>
										<input  id="number" type="number" name="number" value="{{$product->prod_amount}}" onkeyup="check()"  placeholder="Số lượng phải lớn 0">
										<div id="number_error" style="color:red"></div>
										 @if ($errors->has('number'))
	                                    <span class="help-block">
	                                        <strong style="color: red;">{{ $errors->first('number') }}</strong>
										</span>
										@endif
										@if($errors->has('description'))
											<?php echo "<script type=\"text/javascript\">document.getElementById(\"description\").scrollIntoView({block: 'start' ,behavior: 'smooth' }); description.textContent='';</script>";?>
										@endif
									</div>
									<div class="bt">
										<input type="submit" name="submit" value="Sửa" class="btn btn-primary">
										<a href="{{asset('admin/product/'.$product->prod_cate)}}" class="btn btn-danger">Hủy bỏ</a>
									</div>
								</div>
							</div>
							{{csrf_field()}}
						</form>
						<div class="clearfix"></div>
						<div id="id">{{$product->prod_id}}</div>
					</div>
				</div>
			</div>
		</div><!--/.row-->
	</div>	<!--/.main-->
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
		function changeImg(input){
		    //Nếu như tồn thuộc tính file, đồng nghĩa người dùng đã chọn file mới
		    if(input.files && input.files[0]){
		        var reader = new FileReader();
		        //Sự kiện file đã được load vào website
		        reader.onload = function(e){
		            //Thay đổi đường dẫn ảnh
		            $('#avatar').attr('src',e.target.result);
					check();
					// var product_id=document.getElementById("id").innerHTML;
					// var hinh = $(this).val();
					// var anh=hinh.lastIndexOf("\\");
					// $.post('{{asset('admin/product/edit/check_img')}}',{'id':product_id,'img_check':hinh.slice(anh+1)},function(data){
					// 	$("#img_error1").html(data);
					// });
					$("#img_error1").html("");
					var check_hinh = document.getElementById('img').value;
					var lc = check_hinh.lastIndexOf("\\");
					$.post('{{asset('admin/product/check_edit_img')}}',{'img_check':check_hinh.slice(lc+1),'id':document.getElementById("id").innerHTML},function(data){
						$("#img_error1").html(data);
					});
					
		        }
		        reader.readAsDataURL(input.files[0]);
		    }
		}
		$(document).ready(function() {
		    $('#avatar').click(function(){
		        $('#img').click();
		    });
		});
	</script>	
	<script type="text/javascript">
		document.getElementById("id").style.display="none";
	$.ajaxSetup({
	  headers: {
	    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
	  }
	});
	function check() {
		    var data = new Array();
		    data[0] = document.getElementById('name').value;
		    data[1] = document.getElementById('price').value;
		    data[2] = document.getElementById('warranty').value;
		    data[3] = document.getElementById('promotion').value;
		    data[4] = document.getElementById('number').value;
			data[5] = CKEDITOR.instances.description.getData();
			var hinh = document.getElementById('img').value;
		    var myerror = new Array();
		    myerror[0] = "<span >Bạn chưa nhập tên sản phẩm</span>";
		    myerror[1] = "<span >Bạn chưa nhập giá sản phẩm</span>";
		    myerror[2] = "<span >Bạn chưa nhập số tháng bảo hành</span>";
		    myerror[3] = "<span >Bạn chưa nhập số phần trăm khuyến mãi</span>";
		    myerror[4] = "<span >Bạn chưa nhập số lượng muốn thêm vào kho</span>";
			myerror[5] = "<span >Bạn chưa nhập mô tả</span>";
			var dinhDangChuan = new Array(".png",".jpg",".jpeg",".gif");
			var li = hinh.lastIndexOf(".");
			var l = 0;
			for (i in dinhDangChuan) {
				if(hinh.slice(li)==dinhDangChuan[i]){
					l++;
				}
			}
		    var nearby = new Array("name2_error", "price_error","warranty_error","promotion_error","number_error","description_error");
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
			if(l==0&&hinh!=""){
				document.getElementById("img_error").innerHTML = "Bạn cần nhập hình đúng định dạng";
				k++;
			}else{
				document.getElementById("img_error").innerHTML = "";
			}
		    if (k>0) {
		    	return false;
		    }
		}
		$("#name").keyup(function(e){
			var product_id=document.getElementById("id").innerHTML;
			var product_name = $(this).val();
			$.post('{{asset('admin/product/check')}}',{'id':product_id,'name':product_name},function(data){
				$("#name_error").html(data);
			});
		});
	</script>
@stop
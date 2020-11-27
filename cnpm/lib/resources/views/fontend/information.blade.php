@extends('fontend.master')
@section('title','Thông tin')
@section('main')
<link rel="stylesheet" href="css/information.css"> 
<meta name="csrf-token" content="{{ csrf_token() }}">
<script type="text/javascript" src="js/jquery-1.12.0.min.js"></script>  
<script src="js/jquery-2.2.3.min.js"></script>
	@include('sweetalert::alert')
	<section id="body" >
		<div class="container main">
			<div class="row">
				<div class="col-md-3">
					<nav id="menu"> 
						<ul>
							<li onclick="openform1()"><i class="fas fa-edit"></i>Thay đổi mật khẩu</li>
							<li onclick="openform2()"><i class="fas fa-edit"></i>Sửa thông tin</li>
							<li onclick="openform()"><i class="fas fa-history"></i>Lịch sử mua hàng</li>
						</ul>
					</nav>
				</div>
				<div class="col-md-9">
					<table class="table table-bordered " >
                        <thead >
                            <tr class="bg-infor">
                                <th width="50%">Họ và tên</th>
                                <th width="50%">Email</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>{{$user->name}}</td>
                                <td>{{$user->email}}</td>
                            </tr>
                        </tbody>
                    </table>
					@if ( Session::has('success') )
					<div class="alert alert-success alert-dismissible" role="alert">
						<strong>{{ Session::get('success') }}</strong>
						<button type="button" class="close" data-dismiss="alert" aria-label="Close">
							<span aria-hidden="true">&times;</span>
							<span class="sr-only">Close</span>
						</button>
					</div>
					@endif
					@if ( Session::has('error') )
						<div class="alert alert-danger alert-dismissible" role="alert">
							<strong>{{ Session::get('error') }}</strong>
							<button type="button" class="close" data-dismiss="alert" aria-label="Close">
								<span aria-hidden="true">&times;</span>
								<span class="sr-only">Close</span>
							</button>
						</div>
					@endif
					@if ($errors->any())
						<div class="alert alert-danger alert-dismissible" role="alert">
							<ul>
					            @foreach ($errors->all() as $error)
					                <li>{{ $error }}</li>
					            @endforeach
					        </ul>
							<button type="button" class="close" data-dismiss="alert" aria-label="Close">
								<span aria-hidden="true">&times;</span>
								<span class="sr-only">Close</span>
							</button>
						</div>
					@endif
                    <form action="{{url('information/password/'.Auth::user()->name_id)}}" id="form1" method="post" onsubmit=" return check()" name="f1">

					    <div class="form-group">
							<p>Mật khẩu cũ</p>
							<input class="form-control" placeholder="Mật khẩu cũ" name="old_password" type="password" autofocus=""  onkeyup="check()" id="old_password" onkeydown="displaypassword_error()">
							<div id="old_password-error" style="color: red;"></div>
							 @if ($errors->has('old_password'))
                                <span class="help-block" id="hb-oldpassword">
                                    <strong style="color: red;">{{ $errors->first('old_password') }}</strong>
                                </span>
                            @endif
					    </div>
					    <div class="form-group">
							<p>Mật khẩu mới</p>
							<input class="form-control" placeholder="Mật khẩu mới" name="password" type="password" autofocus="" onkeyup="check()" id="password" onkeydown="displaypassword_error()">
							<div id="password-error" style="color: red;"></div>
							@if ($errors->has('password'))
                                <span class="help-block" id="hb-password">
                                    <strong style="color: red;">{{ $errors->first('password') }}</strong>
                                </span>
                            @endif
					    </div>
					    <div class="form-group">
							<p>Nhập lại mật khẩu mới</p>
							<input class="form-control" placeholder="Nhập lại mật khẩu mới" name="password_confirmation" type="password" autofocus="" onkeyup="check()" id="password_confirmation" onkeydown="displaypassword_error()">
							<div id="password-confirmation-error" style="color: red;"></div>
							@if ($errors->has('password'))
                                <span class="help-block" id="hb-pasword-confirmation">
                                    <strong style="color: red;">{{ $errors->first('password') }}</strong>
                                </span>
                            @endif
					    </div>
					    <button type="submit" class="btn btn-default sua">Sửa thông tin</button>
					    {{csrf_field()}}
                    </form>
                    <form action="{{url('information/'.Auth::user()->name_id)}}" id="form3" method="post" onsubmit=" return checkinfo()" name="f1">

                    	<div class="form-group">
							<p>Họ và tên</p>
							<input class="form-control" placeholder="name" name="name" type="text" autofocus=""   value="{{$user->name}}" onkeyup="checkinfo()" id="name">
							<div id="name-error" style="color: red;"></div>
							 @if ($errors->has('name'))
                                <span class="help-block" id="help-block-name">
                                    <strong style="color: red;">{{ $errors->first('name') }}</strong>
                                </span>
                            @endif
					    </div>
					    <div class="form-group">
							<p>Email</p>
							<input class="form-control" placeholder="Nhập email vào" name="email" type="text" autofocus=""   value="{{$user->email}}" onkeyup="checkemail()" id="email">
							<div id="email-error" style="color: red;"></div>
							<div id="email-error1" style="color: red;"></div>
							 @if ($errors->has('email'))
                                <span class="help-block" id="help-block-email">
                                    <strong style="color: red;">{{ $errors->first('email') }}</strong>
                                </span>
                            @endif
					    </div>
					    <button type="submit" class="btn btn-default sua" id="btn-info">Sửa thông tin</button>
					    {{csrf_field()}}
                    </form>

                    <ul id="form2" class="bill">
                    	<h4>Thông tin đơn hàng của bạn</h4>
                    	@if($count>=1)
                		<table class="table table-bordered " >
		                    <thead >
		                        <tr class="bg-infor">
		                            <th >STT</th>
		                            <th>MDH</th>
		                            <th >Tên người nhận</th>
		                            <th >SĐT </th>
		                            <th >Địa chỉ</th>
		                            <th >Trạng thái</th>
		                            <th>Đóng gói</th>
		                            <th >Ngày mua</th>
		                            <th >Hành động</th>
		                        </tr>
		                    </thead>
		                    <tbody>
		                    	@foreach($orders as $order)
		                        <tr>
		                            <td>{{ $loop->index }}</td>
		                            <th>{{$order->id}}</th>
		                            <td>{{$order->name}}</td>
		                            <td>{{$order->phone}}</td>
		                            <td>{!!$order->address!!}</td>
		                            <td>@if($order->status==0)Chưa hoàn thành @else Hoàn thành @endif</td>
		                            <th>@if($order->ready==0)Chưa xong @else Xong @endif</th>
		                            <td>{{$order->created_at}}</td>
		                            <td><a href="{{asset('information/cart/'.$order->id)}}" class="hd btn-success btn"> Xem</a>
		                            	@if($order->ready==0)
		                            	<a href="{{asset('information/cart/delete/'.$order->id)}}" onclick="return confirm('Bạn có chắc muốn hủy đơn hàng này không?')" class=" hd btn-success btn">Hủy</a>@endif</td>
		                        </tr>
		                        @endforeach
		                    </tbody>
		                </table>
		                <p style="color: red; font-size: 15px;">Bạn không thể hủy đơn hàng khi đã đóng gói xong</p>
                		@else
                		<h5>Bạn chưa có đơn hàng nào</h5>
                		@endif
                    </ul>
				</div>
			</div>
		</div>
	</section>
	<script>
		document.getElementById('form1').style.display="none";
		document.getElementById("form3").style.display = "none";
		function openform(){
			 document.getElementById("form1").style.display = "none";
			 document.getElementById("form2").style.display = "block";
			 document.getElementById("form3").style.display = "none";
		}
		function openform1(){
			 document.getElementById("form1").style.display = "block";
			 document.getElementById("form2").style.display = "none";
			 document.getElementById("form3").style.display = "none";
		}
		function openform2(){
			document.getElementById("form3").style.display = "block";
			document.getElementById("form2").style.display = "none";
			document.getElementById("form1").style.display = "none";
		}
		
	</script>
	<script>
		$.ajaxSetup({
		  headers: {
		    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
		  }
		});
		
		function displayinfo_error(){
			var nearby= new Array("help-block-name","help-block-email");
			for (i in nearby) {
				var div=nearby[i];
				document.getElementById(div).innerHTML="";
			}
		}
		
		function displaypassword_error(){
			var data = new Array();
			data[0]=document.getElementById('old_password').value;
			data[1]=document.getElementById('password').value;
			data[2]=document.getElementById('password_confirmation').value;
			var nearby= new Array("hb-oldpassword","hb-password","hb-pasword-confirmation");
			for (i in data) {
				var div=nearby[i];
				if (data[i]!="") {
					document.getElementById(div).style.display="none";
				}
			}
		}
		
		function checkinfo(){
			 var data = new Array();
		    data[0] = document.getElementById('name').value;
		    data[1] = document.getElementById('email').value;
		 
		    var myerror = new Array();
		    myerror[0] = "<span >Bạn chưa nhập họ tên của bạn</span>";
		    myerror[1] = "<span >Bạn chưa nhập email của bạn</span>";
		 
		    var nearby = new Array("name-error","email-error");
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
		    if (k>0) {
		    	return false;
		    }
		    else{
		    	var email = document.getElementById('email');
		        var filter = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
	        	if (!filter.test(email.value)) {
	            document.getElementById('email-error').innerHTML="email chưa hợp lệ";
	            email.focus;
	            return false;
		        }
		        else
		        {
		            document.getElementById('email-error').innerHTML="";
		        }
		    }
		}
		function checkemail(){
			var email = document.getElementById('email');
	        var filter = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
        	if (!filter.test(email.value)) {
            document.getElementById('email-error').innerHTML="email chưa hợp lệ";
            email.focus;
            return false;
	        }
	        else
	        {
	            document.getElementById('email-error').innerHTML="";
	        }
		}

		function check(){
	        var data = new Array;
	        data[0]=document.getElementById('old_password').value;
	        data[1]=document.getElementById('password').value;
	        data[2]=document.getElementById('password_confirmation').value;
	        var myerror = new Array();
	        myerror[0] = "<span >Bạn chưa nhập mật khẩu cũ</span>";
	        myerror[1] = "<span >Bạn chưa nhập mật khẩu</span>";
	        myerror[2] = "<span >Bạn chưa nhập lại mật khẩu</span>";

	        var nearby = new Array("old_password-error","password-error", "password-confirmation-error");
	       
	        var k=0;
	        for(i in data){
	            var error = myerror[i];
	            var div = nearby[i];
	            if (data[i]=="") {
	                document.getElementById(div).innerHTML = error;
	                k++;
	            }else{
	                 if (data[i].length<=8 || data[i].length>15) {
	                   document.getElementById(div).innerHTML = "Mật khẩu lớn hơn 8  ký tự";
	                   k++;
	                }
	                else{
                		document.getElementById(div).innerHTML = "";
                    	// k--;
	                }
	            }
	        }
	        if (k>0) {
	            return false;
	        }
	        else{
	        	if (data[1]!=data[2]) {
	        		document.getElementById('password-confirmation-error').innerHTML="Mật khẩu không trùng nhau";
	        		return false;
	        	}
	        }
	    }
	    $("#email").keyup(function(e){
			var email = $(this).val();
			$.post('{{asset('information/check_email')}}',{'email_check':email},function(data){
				$("#email-error1").html(data);
			});
		});
		</script>

@stop


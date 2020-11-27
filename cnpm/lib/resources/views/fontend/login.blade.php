<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Đăng nhập</title>
<base href="{{asset('public/layout/fontend')}}/">
<script src="js/sweetalert.js"></script>
<link href="css/bootstrap.min.css" rel="stylesheet">
<!-- <link href="css/datepicker3.css" rel="stylesheet"> --> 
<link href="css/dangnhap.css" rel="stylesheet">
</head>

<body>
	<header>
		
	</header>
	
	<div class="row">
		<div class="col-xs-10 col-xs-offset-1 col-sm-8 col-sm-offset-2 col-md-8 ">
			{{-- <div class="spinner">
	          <div class="blob blob-0"></div>
	        </div> --}}
			<div class="login-panel panel panel-default">
				@include('sweetalert::alert')
				 {{-- @if (session('dm'))
			        <div class="alert alert-info">{{session('dm')}}</div>
			    @endif --}}
				@if ( Session::has('success') )
					<div class="alert alert-success alert-dismissible" role="alert">
						<strong>{{ Session::get('success') }}</strong>
						<button type="button" class="close" data-dismiss="alert" aria-label="Close">
							<span aria-hidden="true">&times;</span>
							<span class="sr-only">Close</span>
						</button>
					</div>
				@endif
				@if ( Session::has('error')  && Session::has('error') )
					<div class="alert alert-danger alert-dismissible" role="alert">
						<strong >{{ Session::get('error') }}</strong><br>
						<strong >{{ Session::get('error1') }}</strong>
						<button type="button" class="close" data-dismiss="alert" aria-label="Close">
							<span aria-hidden="true">&times;</span>
							<span class="sr-only">Close</span>
						</button>
					</div>
				@endif
				
				{{-- @if ($errors->any())
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
				@endif --}}
				{{-- @include('errors.note') --}}
				<div class="panel-heading">Đăng nhập</div>
				<div class="panel-body">
					<form role="form" method="post" action="{{url('login')}}" name="login" onsubmit="return check()" >
						<fieldset class="khung"> 
							<div class="form-group">
								<p>Tên đăng nhập <span class="note">*</span></p>
								<input class="form-control" placeholder="Tên đăng nhập" name="name_id" type="text" {{-- autofocus="" --}}  value="{{old('name_id')}}" onkeyup="check()" id="name_id" onkeydown="checkerror()">
								<div id="id_error" style="color: white; margin-left: 100px;"></div>
								 @if ($errors->has('name_id'))
                                    <span class="help-block" style="margin-left: 100px;" id="hb_nameid">
                                        <strong style="color: white;">{{ $errors->first('name_id') }}</strong>
                                    </span>
                                @endif
						    </div>
							<div class="form-group">
								<p>Mật khẩu <span class="note">*</span></p>
								<input class="form-control" placeholder="Mật khẩu" name="password" type="password" value=""  onkeyup="checkpassword()" id="password" onkeydown="checkerror()">
								<div id="password_error" style="color: white; margin-left: 100px;"></div>
								 @if ($errors->has('password'))
                                    <span class="help-block" style="margin-left: 100px;" id="hb_password">
                                        <strong style="color: white;">{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
							</div>
							<div class="checkbox">
								{{-- <label>
									<input name="remember" type="checkbox" value="Remember Me">Remember Me
								</label> --}}
								<a href="{{asset('lay_lai_mat_khau')}}">Quên mật khẩu ?</a>
							</div>
							<button type="submit" name="submit" class="btn btn-primary" onclick="xacnhan()">Đăng nhập</button>
							<p class="note"> * (Bắt buộc)</p>
							<p class="note">Bạn chưa có tài khoản?<a href="{{asset('registration')}}">(Đăng ký)</a></p>
							<a class="home" href="{{asset('/')}}">Quay lại trang chủ</a> 
						</fieldset>
						{{csrf_field()}}
					</form>
				</div>
			</div>
		</div><!-- /.col-->
	</div><!-- /.row -->	
	
		
	

	<script src="js/jquery-1.11.1.min.js"></script>
	<script src="js/bootstrap.min.js"></script>
	<script src="js/chart.min.js"></script>
	<script src="js/chart-data.js"></script>
	<script src="js/easypiechart.js"></script>
	<script src="js/easypiechart-data.js"></script>
	<script src="js/bootstrap-datepicker.js"></script>
	<script>
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
		})
	</script>	
	
    <script type="text/javascript">
    	function xacnhan(){
    		var name_id = document.getElementById('name_id').value;
    		if (name_id=="" || $_SESSION['dem']>=3) {
    			alert('Bạn cần nhập tên đăng nhập vào');
    			return false;
    		}
    	}
      	function check(){
      		var data = new Array();
		    data[0] = document.getElementById('name_id').value;
		    data[1] = document.getElementById('password').value;
		 
		    var myerror = new Array();
		    myerror[0] = "<span >Bạn chưa nhập tên đăng nhập</span>";
		    myerror[1] = "<span >Bạn chưa nhập mật khẩu</span>";
		   
		    var nearby = new Array("id_error","password_error");
		   	var k=0;
		    for (i in data) {
		        var error = myerror[i];
		        var div = nearby[i];
		        if (data[i]=="") {
		            document.getElementById(div).innerHTML = error;
		            k++;
		        } else {
		            document.getElementById(div).innerHTML = "";
		            // k--;
		        }
		    }
		 	if (k>0) {
		 		return false;
		 	}
      	}
        function checkpassword(){
        	var noidung= document.login.password.value;
        	var count_password= noidung.length;
	        if (count_password<=8 ) {
	        	document.getElementById('password_error').innerHTML = "Mật khẩu lớn hơn 8 ký tự ";
	        }
	        else{
	        	document.getElementById('password_error').innerHTML="";
	        }
        }
        function checkerror(){
        	var data=new Array();
        	data[0]=document.getElementById('name_id').value;
        	data[1]=document.getElementById('password').value;
        	var nearby= new Array("hb_nameid","hb_password");
        	for(i in data){
        		var div = nearby[i];
        		if (data[i]!="") {
        			document.getElementById(div).style.display="none";
        		}
        	}
        }
        //  $(window).on("load",function(){
        //     $(".spinner").fadeOut("slow");
        // });
    </script>
</body>

</html>

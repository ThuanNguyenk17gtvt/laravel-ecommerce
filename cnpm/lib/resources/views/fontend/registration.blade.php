<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta name="csrf-token" content="{{ csrf_token() }}">
<base href="{{asset('public/layout/fontend')}}/">
<title>Đăng ký</title>
<link href="css/bootstrap.min.css" rel="stylesheet">
<!-- <link href="css/datepicker3.css" rel="stylesheet"> -->
<link href="css/registration.css" rel="stylesheet">
{{--  <script src="https://kit.fontawesome.com/2703c57f79.js" crossorigin="anonymous"></script> --}}
<script type="text/javascript" src="js/jquery-1.12.0.min.js"></script>
</head>

<body>
	<header>
		
	</header>
	
	<div class="row">
		<div class="col-xs-10 col-xs-offset-1 col-sm-8 col-sm-offset-2 col-md-8 ">
			<div class="login-panel panel panel-default">
				<div class="panel-heading">Đăng ký thành viên</div>
				<div class="panel-body">
					<form role="form" method="post" action="{{url('registration')}}" name="registration" onsubmit="return check()">
						@include('errors.note')
						<fieldset class="khung">
							<div class="form-group">
								<p>Tên đăng nhập <span class="note">*</span></p>
								<input class="form-control" placeholder="Tên đăng nhập" name="name_id" type="text" {{-- autofocus="" --}} value="{{old('name_id')}}"  onkeyup="check()"  id="name_id"  onkeydown="checkerror()" {{-- onblur="checkName_id(this.value)" --}} >
								<div id="z-name_id" style="margin-left: 100px; color: white;"></div>
								<div id="id" style="margin-left: 100px; color: red;"></div>
								 @if ($errors->has('name_id'))
                                    <span class="help-block" style="margin-left: 100px;" id="hb-name_id">
                                        <strong style="color: red;">{{ $errors->first('name_id') }}</strong>
                                    </span>
                                @endif
						    </div>
							<div class="form-group"> 
								<p>Họ và tên  <span class="note">*</span></p>
								<input class="form-control" placeholder="Họ và tên" name="name" type="text" {{-- autofocus="" --}} value="{{old('name')}}"  onkeyup="check()" id="name">
								<div id="z-name" style="margin-left: 100px; color: white;"></div>
								 @if ($errors->has('name'))
                                    <span class="help-block" style="margin-left: 100px;" id="hb-name">
                                        <strong style="color: red;">{{ $errors->first('name') }}</strong>
                                    </span>
                                @endif
						    </div>
							<div class="form-group">
								<p>Email  <span class="note">*</span></p>
								<input class="form-control" placeholder="E-mail" name="email" type="email" {{-- autofocus="" --}} value="{{old('email')}}"  onkeyup="checkEmail()" id="email">
								<div id="z-email" style="margin-left: 100px; color: white;"></div>
								<div id="email-error1" style="margin-left: 100px; color: red;"></div>
								<div id="email-error"></div>
								 @if ($errors->has('email'))
                                    <span class="help-block" style="margin-left: 100px;" id="hb-email">
                                        <strong style="color: red;">{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
							</div>
							<div class="form-group">
								<p>Mật khẩu  <span class="note">*</span></p>
								<input class="form-control" placeholder="Mật khẩu" name="password" type="password" value=""  onkeyup="checkpassword()" id="password" onkeydown="checkerror()" >
								<div id="z-password" style="margin-left: 100px; color: white;"></div>
								@if ($errors->has('password'))
                                    <span class="help-block" style="margin-left: 100px;" id="hb-password">
                                        <strong style="color: red;">{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
							</div>
							<div class="form-group">
								<p>Nhập lại mật khẩu  <span class="note">*</span></p>
								<input class="form-control" placeholder="Nhập lại mật khẩu" name="password_confirmation" type="password" value=""  onkeyup="kiemtramkl()" id="password_confirmation"  onkeydown="checkerror()">
								<div id="z-password_confirmation" style="margin-left: 100px; color: white;"></div>
								@if ($errors->has('password'))
                                    <span class="help-block" style="margin-left: 100px;" id="hb-pasword-confirmation">
                                        <strong style="color: red;">{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
							</div>
							<div class="form-group">
								<p>Captcha  <span class="note">*</span></p>
								<div class="captcha" style="margin-left: 100px; margin-bottom: 10px;">
									<span>{!!captcha_img()!!}</span>
									<button class=" btn btn-success btn-refresh" type="button" style="margin-left: 40px;">Làm mới</button>
								</div>
								<input type="text" name="captcha" id="captcha" placeholder="Nhập mã captcha " class="form-control">
								<div id="z-captcha" style="margin-left: 100px; color: white;"></div>
								@if ($errors->has('captcha'))
                                    <span class="help-block" style="margin-left: 100px;" >
                                        <strong style="color: red;">{{ $errors->first('captcha') }}</strong>
                                    </span>
                                @endif
							</div>
							<button class="btn btn-primary " type="submit" value="Đăng ký" onclick="dk()" id="start"> Đăng ký</button>
						</fieldset>
						{{csrf_field()}}
					</form>
					<p class="note" style="margin-left: 95px;"> * (Bắt buộc)</p>
					<p class="note" style=" margin-left: 95px;">Bạn đã có tài khoản <a href="{{asset('login')}}" style="text-decoration: none;"> (Đăng nhập)</a></p>
				</div>
			</div>
		</div><!-- /.col-->
	</div><!-- /.row -->	
	
		

	{{-- <script src="js/jquery-1.11.1.min.js"></script> --}}
	<script src="js/jquery-2.2.3.min.js"></script>
	<script src="js/bootstrap.min.js"></script>
	{{-- <script src="js/chart.min.js"></script>
	<script src="js/chart-data.js"></script>
	<script src="js/easypiechart.js"></script>
	<script src="js/easypiechart-data.js"></script>
	<script src="js/bootstrap-datepicker.js"></script> --}}
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
		$.ajaxSetup({
		  headers: {
		    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
		  }
		});

		$(".btn-refresh").click(function(){
			$.ajax({
				type:'GET',
				url:'{{asset('refresh-captcha')}}',
				success:function(data){
					$(".captcha span").html(data.captcha);
				}
			});
		});

        // setTimeout(displayhb,4000);
        function displayhb(){
        	var nearby= new Array("hb-name_id","hb-name","hb-email","hb-password","hb-pasword-confirmation");
			for (i in nearby) {
				var div=nearby[i];
				// document.getElementById(div).style.display="none";
				document.getElementById(div).innerHTML="";
			}
        }
       	function checkpassword(){
	       	var password=document.getElementById('password').value;
	       	var count_password= password.length;
	        if (count_password<=8 ) {
	        	document.getElementById('z-password').innerHTML = "Mật khẩu lớn hơn 8 ký tự";
	        }
	        else{
	        	document.getElementById('z-password').innerHTML="";
	        	// document.getElementById('hb-password').style.display="none";
	        }
       	}
        function kiemtramkl(){
        	var noidung= document.registration.password_confirmation.value;
        	var noidung1= document.registration.password.value;
                if (noidung1!=noidung) {
                	document.getElementById('z-password_confirmation').innerHTML="Mật khẩu không trùng với nhau";
                }
                else{
                	document.getElementById('z-password_confirmation').innerHTML="";
                	document.getElementById('hb-pasword-confirmation').style.display="none";
                }
        }
        function check() {
		    var data = new Array();
		    data[0] = document.getElementById('name_id').value;
		    data[1] = document.getElementById('name').value;
		    data[2] = document.getElementById('email').value;
		    data[3] = document.getElementById('password').value;
		    data[4] = document.getElementById('password_confirmation').value;
		    data[5] = document.getElementById('captcha').value;
		 
		    var myerror = new Array();
		    myerror[0] = "<span >Bạn chưa nhập tên đăng nhập</span>";
		    myerror[1] = "<span >Bạn chưa nhập tên</span>";
		    myerror[2] = "<span >Bạn chưa nhập email</span>";
		    myerror[3] = "<span >Bạn chưa nhập mật khẩu</span>";
		    myerror[4] = "<span >Bạn chưa nhập lại mật khẩu</span>";
		 	myerror[5] = "<span >Bạn chưa nhập mã captcha</span>";

		    var nearby = new Array("z-name_id","z-name", "z-email", "z-password","z-password_confirmation","z-captcha");
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
		 		kt=false;
		 		return false;
		 	}
		 	else{
		 		kt=true;
		 	}
	 	    
		}

		function dk(){
			if(kt){
                var x = document.getElementById("start");
                if(x.textContent == "Vui long cho trong giay lat..."){
                    x.style.opacity = 0.5;
                    x.style.cursor = "no-drop";
                    return false;
                }
                x.style.opacity = 0.5;
                x.style.cursor = "no-drop";
                x.innerHTML="Vui long cho trong giay lat...";
            }
		}
		function checkerror(){
			var nd=document.getElementById('name_id').value;
			var nd1=document.getElementById('password_confirmation').value;
			var nd2=document.getElementById('password').value;
			if (nd!="" || nd1!="" || nd2!="") {
				document.getElementById('hb-name_id').style.display="none";
				document.getElementById('hb-pasword-confirmation').style.display="none";
				document.getElementById('hb-password').style.display="none";
			}
			
		}
		function checkEmail(){
			var email = document.getElementById('email');
	        var filter = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
        	if (!filter.test(email.value)) {
            document.getElementById('z-email').innerHTML="email chưa hợp lệ";
            email.focus;
            return false;
	        }
	        else
	        {
	            document.getElementById('z-email').innerHTML="";
	            document.getElementById('hb-email').style.display="none";
	        }
		}
		$("#name_id").keyup(function (e) { //user types username on inputfiled
		   var username = $(this).val(); //get the string typed by user
		   $.post('{{asset('check_nameid')}}', {'user_name':username}, function(data) { //make ajax call to check_username.php
		   $("#id").html(data); //dump the data received from PHP page
		   });
		});
		$("#email").keyup(function(e){
			var email = $(this).val();
			$.post('{{asset('check_email')}}',{'email_check':email},function(data){
				$("#email-error1").html(data);
			});
		});

    </script>
</body>

</html>

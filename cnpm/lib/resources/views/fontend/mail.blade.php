<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0"> 
    <title> Đăng nhập sai nhiều lần?</title>
    <base href="{{asset('public/layout/fontend')}}/">
    <link href="css/bootstrap.min.css" rel="stylesheet">
    {{-- <link href="css/home.css" rel="stylesheet">     --}}
    <link href="css/mail.css" rel="stylesheet">  
    <script type="text/javascript" src="js/jquery-1.12.0.min.js"></script>
</head>
<body>
    <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
        <div class="container-fluid">
            <div class="navbar-header">
				<a class="navbar-brand" href="{{asset('login')}}">TTN Shop</a> 
        </div>
    </nav>
    <div class="row">
		<div class="col-xs-6 col-xs-offset-1 col-sm-5 col-sm-offset-3 col-md-5 form-quen-mat-khau">
            @if ( Session::has('error') )
                <div class="alert alert-danger alert-dismissible" role="alert" id="error">
                    <strong>{{ Session::get('error') }}</strong>
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        <span class="sr-only">Close</span>
                    </button>
                </div>
            @endif  
            @if ( Session::has('alert') ) 
                <script>alert("{{Session::get('alert')}}")</script>
            @endif
            {{-- <form action="{{url('nhapma')}}" method = "post" name="mail" id="form-mail" >
                <div class="form-group" style="border-bottom: 1px solid #000;">
                    <h3 style="color: black">Kiểm tra tài khoản của bạn</h3>
                </div>
                <div class="form-group" style="padding: 2px">
                    <p style="color:black">Nhập email của bạn để chúng tôi biết có phải là bạn không?</p>
                    <input type="email" name = "email" class="form-control" id="email" placeholder="Nhập email của bạn..." onkeyup="checkEmail()" >
                    <div id="z-email" style="color: red;"></div>
                    <div id="mail-error" style="color: red;"></div>
                    <div id="myProgress">
                        <div id="myBar"></div>
                    </div>
                </div>
                <div class="form-group">
                    <button type="submit" class="btn btn-success form-control" id="btn-kt">Kiểm tra</button>
                </div>
                {{csrf_field()}}
            </form> --}}
            @if(!isset($error))
             <form action="{{url('code')}}" method = "post" id="form-code" name="form_code">
                <div class="form-group" style="border-bottom: 1px solid #000;">
                    <h3 style="color: black">Nhập mã xác nhận</h3>
                    {{-- <span>Thời gian tồn tại mã xác nhận:</span><span id="time"></span> --}}
                </div>
                <div class="form-group" style="padding: 2px">
                    <p style="color:black">Nhập mã trong mail của bạn</p>
                    <input type="text" name = "code" class="form-control" id="code" placeholder="Nhập mã...">
                </div>
                <div class="form-group">
                    <button type="submit" class="btn btn-success form-control" id="btn-ktcode" >Kiểm tra</button>
                </div>
                {{csrf_field()}}
            </form>
            @else <a href="{{asset('login')}}">Quay lại</a>
            @endif
        </div>
    </div>
</body>
<script type="text/javascript">

   // function start()
   //  {
   //      var time=60;
   //      function demnguoc(){
   //          time--;
   //          if (time!=0) {
   //              document.getElementById('time').innerHTML=time +"s";
   //              setTimeout(demnguoc,1000);
   //          }
   //          else{
   //              location.reload();
   //              // document.getElementById('error').innerHTML="Thời gian tồn tại mã xác nhận đã hết hạn, nó chỉ tồn tại trong 1 phút";
   //          }
   //      }
   //      demnguoc();
   //  }
   //  document.getElementById('form-code').style.display="none";
   //  document.getElementById('myProgress').style.display="none";
   //  var i=0;
   //      $(document).ready(function()
   //      {   
   //          $("#btn-kt").click(function(e) 
   //          {
   //              e.preventDefault();
   //              var noidung= document.mail.email.value;
   //              if (noidung == '') {
   //                  alert("Bạn chưa nhập email");
   //                  return false;
   //              }
   //              document.getElementById('myProgress').style.display="block";
   //              var data = $('form#form-mail').serialize();
   //              if (i==0) {
   //                  i=1;
   //                  var elem = document.getElementById("myBar");
   //                  var width = 1;
   //                  var id = setInterval(frame, 25);
   //                  function frame() {
   //                    if (width >= 100) {
   //                      clearInterval(id);
   //                      i = 0;
   //                    } else {
   //                      width++;
   //                      elem.style.width = width + "%";
   //                    }
   //                  }
   //                  $.ajax({
   //                  type : 'POST', //kiểu post
   //                  url  : '{{asset('nhapma')}}', 
   //                  data : data,
   //                  success :  function(data)
   //                         {                       
   //                          if (data=="thanhcong") {
   //                              document.getElementById('form-code').style.display="block";
   //                              document.getElementById('form-mail').style.display="none";
   //                              start();
   //                              }
   //                          if (data=="loi") {
   //                              document.getElementById('mail-error').innerHTML="Email không đúng với với tài khoản bạn đã thử đăng nhập";
   //                              document.getElementById('myProgress').style.display="none";
   //                          }
   //                         }
   //                  });
   //                  return false; 
   //              }
                
   //          });
            
   //      });
   //      function checkEmail(){
   //          var email = document.getElementById('email');
   //          var filter = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
   //          if (!filter.test(email.value)) {
   //          document.getElementById('z-email').innerHTML="email chưa hợp lệ";
   //          document.getElementById('mail-error').style.display="none";
   //          email.focus;
   //          return false;
   //          }
   //          else
   //          {
   //              document.getElementById('z-email').innerHTML="";
   //          }
   //      }
       
    </script>
</html>
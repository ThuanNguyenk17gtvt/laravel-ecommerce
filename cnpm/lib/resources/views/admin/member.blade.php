@extends('admin.master')
@section('title','Quản lý thành viên')
@section('main')
<script src="js/sweetalert.js"></script>
<script src="js/jquery-2.2.3.min.js"></script>
<meta name="csrf-token" content="{{ csrf_token() }}">
<link rel="stylesheet" href="css/member.css">
	<div class="col-md-9 col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main" style="top: -10px;" >
    	<div class="alert alert-success">Danh sách thành viên của shop  </div>
        <div class="menu"> 
            <button class=" btn btn-default" onclick="openform()"> Add Admin</button>
            <button class=" btn btn-default" onclick="openform1()">Xem danh sách</button>
        </div>
       
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
         @include('sweetalert::alert')
    	<table class="table table-striped" id="form1">
        	<tr id="tbl-first-row">
            	<td width="5%">#</td>
                <td width="30%">Fullname</td>
                <td width="15%">Username</td>
                <td width="10%">Thành viên</td>
                <td width="25%">Email</td>
                <td width="5%">Edit</td>
                <td width="5%">Delete</td>
            </tr>
            @foreach($members as $member)
            <tr>
            	<td>{{ $loop->index }}</td>
                <td>{{$member->name}}</td>
                <td>{{$member->name_id}}</td>
                <td>@if($member->level == 1) super admin @elseif($member->level == 2) admin @else user @endif</td>
                <td>{{$member->email}}</td>
                <td><a href="{{asset('admin/member/edit/'.$member->name_id)}}" {{-- onclick="edit({{$member->name_id}})" --}}><i class="far fa-edit"></i></a></td>
                <td><a href="{{asset('admin/member/delete/'.$member->name_id)}}" onclick="return  confirm('Bạn có chắc muốn xóa thành viên này hay không ?')" ><i class="far fa-trash-alt"></i></a></td>
            </tr>
            @endforeach
		</table>
        <div class="col-md-6">
            <form action="{{url('admin/member/add')}}" method="post" id="form2" name="registration" onsubmit="return check()">
                <fieldset>
                    <div class="form-group">
                        <p>Tên đăng nhập <span class="note">* (Bắt buộc)</span></p>
                        <input class="form-control" placeholder="Tên đăng nhập" name="name_id" id="name_id" type="text" autofocus=""  value="{{old('name_id')}}" onkeyup="check()" onkeydown="checkerror()" >
                        <div id="name_error" style="color: red;"></div>
                        <div id="z-name_id" style="color: red;"></div>
                         @if ($errors->has('name_id'))
                            <span class="help-block" id="hb_nameid">
                                <strong style="color: red;">{{ $errors->first('name_id') }}</strong>
                            </span>
                        @endif
                    </div>
                    <div class="form-group">
                        <p>Họ và tên  <span class="note">* (Bắt buộc)</span></p>
                        <input class="form-control" placeholder="Họ và tên" name="name" type="text" autofocus=""  value="{{old('name')}}" onkeyup="check()" id="name" onkeydown="checkerror()">
                        <div id="z-name" style="color: red;"></div>
                         @if ($errors->has('name'))
                            <span class="help-block" id="hb_name">
                                <strong style="color: red;">{{ $errors->first('name') }}</strong>
                            </span>
                        @endif
                    </div>
                    <div class="form-group">
                        <p>Email  <span class="note">* (Bắt buộc)</span></p>
                        <input class="form-control" placeholder="E-mail" name="email" type="email" autofocus=""  value="{{old('email')}}" id="email" onkeyup="checkEmail()" onkeydown="checkerror()" >
                        <div id="email-error" style="color: red;"></div>
                        <div id="z-email" style="color: red;"></div>
                         @if ($errors->has('email'))
                            <span class="help-block" id="hb_email">
                                <strong style="color: red;">{{ $errors->first('email') }}</strong>
                            </span>
                        @endif
                    </div>
                    <div class="form-group">
                        <p>Mật khẩu  <span class="note">* (Bắt buộc)</span></p>
                        <input class="form-control" placeholder="Mật khẩu" name="password" type="password" value=""  onkeyup="checkpassword()" id="password"  onkeydown="checkerror()">
                        <div id="z-password" style="color: red;"></div>
                        @if ($errors->has('password'))
                            <span class="help-block" id="hb_password">
                                <strong style="color: red;">{{ $errors->first('password') }}</strong>
                            </span>
                        @endif
                    </div>
                    <div class="form-group">
                        <p>Nhập lại mật khẩu  <span class="note">* (Bắt buộc)</span></p>
                        <input class="form-control" placeholder="Nhập lại mật khẩu" name="password_confirmation" type="password" value=""  onkeyup="kiemtramkl()" id="password_confirmation" onkeydown="checkerror()" >
                        <div id="z-password_confirmation" style="color: red;"></div>
                        @if ($errors->has('password'))
                            <span class="help-block" id="hb_password_confirmation">
                                <strong style="color: red;">{{ $errors->first('password') }}</strong>
                            </span>
                        @endif
                    </div>
                    <button class="btn btn-primary " type="submit" value="Đăng ký"> Thêm</button>
                </fieldset>
                 {{csrf_field()}}
            </form>
        </div>
        
       
    </div>
    <script>
         document.getElementById("form1").style.display = "none";
        function openform(){
           document.getElementById("form1").style.display = "none";
           document.getElementById("form2").style.display = "block";
        }
        function openform1(){
           document.getElementById("form2").style.display = "none";
           document.getElementById("form1").style.display = "block";
        }
    </script>
  
    <script type="text/javascript">
          $.ajaxSetup({
          headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          }
        }); 
       
        $("#name_id").keyup(function (e) { 
           var username = $(this).val(); 
           $.post('{{asset('admin/member/check_nameid')}}', {'id':username}, function(data) { 
           $("#name_error").html(data); 
           });
        });
        $("#email").keyup(function(e){
            var email = $(this).val();
            $.post('{{asset('admin/member/check_email')}}',{'email_check':email},function(data){
                $("#email-error").html(data);
            });
        });
         function check() {
            var data = new Array();
            data[0] = document.getElementById('name_id').value;
            data[1] = document.getElementById('name').value;
            data[2] = document.getElementById('email').value;
            data[3] = document.getElementById('password').value;
            data[4] = document.getElementById('password_confirmation').value;
            
         
            var myerror = new Array();
            myerror[0] = "<span >Bạn chưa nhập tên đăng nhập</span>";
            myerror[1] = "<span >Bạn chưa nhập tên</span>";
            myerror[2] = "<span >Bạn chưa nhập email</span>";
            myerror[3] = "<span >Bạn chưa nhập mật khẩu</span>";
            myerror[4] = "<span >Bạn chưa nhập lại mật khẩu</span>";
         
            var nearby = new Array("z-name_id","z-name", "z-email", "z-password","z-password_confirmation");
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
                document.getElementById('z-email').innerHTML="email chưa hợp lệ";
                email.focus;
                return false;
                }
                else
                {
                    document.getElementById('z-email').innerHTML="";
                    // document.getElementById('hb-email').style.display="none";
                }
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
                document.getElementById('hb_email').style.display="none";
            }
        }

        function checkpassword(){
            var password=document.getElementById('password').value;
            var count_password= password.length;
            if (count_password<=8 || count_password>15) {
                document.getElementById('z-password').innerHTML = "Mật khẩu lớn hơn 8 và nhỏ hơn 16 ký tự";
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
                // document.getElementById('hb-pasword-confirmation').style.display="none";
            }
        }

        function checkerror(){
            var nd = document.getElementById('name_id').value;
            var nd1 = document.getElementById('password_confirmation').value;
            var nd2 = document.getElementById('password').value;
            if (nd!="" || nd1!="" ||nd2!="") {
                document.getElementById('hb_nameid').style.display="none";
                document.getElementById('hb_password_confirmation').style.display="none";
                document.getElementById('hb_password').style.display="none";
            }
        }
    </script>
@stop

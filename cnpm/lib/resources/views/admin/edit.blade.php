@extends('admin.master')
@section('title','Quản lý thành viên')
@section('main')
<link rel="stylesheet" href="css/edit.css" /> 
<script type="text/javascript" src="js/jquery-1.12.0.min.js"></script>
<script src="js/jquery-2.2.3.min.js"></script>
<meta name="csrf-token" content="{{ csrf_token() }}">
<div class="container" style="margin-left: 20%;">
    {{-- @include('errors.note') --}}
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
    <div class="row"> 
    	<div class="col-sm-6">
        	<div class="alert alert-success">Cập nhật thành viên</div>
           {{--  @foreach($members as $member) --}}
            <div id="id">{{$members->name_id}}</div>
        	<form method="post" action="{{url('admin/member/edit/'.$members->name_id)}}" onsubmit="return checkinfo()">
            	<div class="form-group">
                	<label>Fullname</label>
                    <input type="text" name="name" class="form-control" placeholder="Fullname" value="{{$members->name}}" onkeyup="checkinfo()"  id="name">
                    <div id="name-error" style="color: red;"></div>
                     @if ($errors->has('name'))
                        <span class="help-block">
                            <strong style="color: red;">{{ $errors->first('name') }}</strong>
                        </span>
                    @endif
                </div>
                <div class="form-group"> 
                	<label>Email</label>
                    <input type="text" name="email" class="form-control" placeholder="Email"  value="{{$members->email}}" onkeyup="checkEmail()" id="email">
                    <div id="email-error" style="color: red;"></div>
                    <div id="email-error1" style="color: red;"></div>
                     @if ($errors->has('email'))
                        <span class="help-block">
                            <strong style="color: red;">{{ $errors->first('email') }}</strong>
                        </span>
                    @endif
                </div>
                <div class="form-group">
                    <label>Level</label>
                    <select name="level" class="form-control">
                        @if(Auth::user()->level==1)
                        <option value="1" @if($members->level==1) selected @endif >Superadmin</option>
                        @endif
                        <option value="2" @if($members->level==2) selected @endif >Admin</option>
                        <option value="3" @if($members->level==3) selected @endif >User</option>
                    </select>
                </div>
                <input type="submit" name="submit" value="Sửa" class="btn btn-primary" />
                <a href="{{asset('admin/member')}}" class="btn btn-primary">Hủy bỏ</a>
                {{csrf_field()}}
            </form>
           {{--  @endforeach --}}
        </div>
        @if(Auth::user()->name_id==$members->name_id)
        <div class="col-sm-6">
            <div class="alert alert-success">Cập nhật mật khẩu</div>
           
            <form action="{{url('admin/member/edit/password/'.$members->name_id)}}" method="post" onsubmit="return check()">
                <div class="form-group">
                <label>Mật khẩu cũ</label>
                    <input type="password" name="old_password" class="form-control" placeholder="Mật khẩu cũ"  value="" onkeyup="check()" id="old_password">
                    <div id="old_password_error" style="color: red;"></div>
                     @if ($errors->has('old_password'))
                        <span class="help-block">
                            <strong style="color: red;">{{ $errors->first('old_password') }}</strong>
                        </span>
                    @endif
                </div>
                <div class="form-group">
                    <label>Mật khẩu mới</label>
                    <input type="password" name="password" class="form-control" placeholder="Mật khẩu mới"  value=""onkeyup="check()" id="password">
                    <div id="password_error" style="color: red;"></div>
                    @if ($errors->has('password'))
                        <span class="help-block">
                            <strong style="color: red;">{{ $errors->first('password') }}</strong>
                        </span>
                    @endif
                </div>
                <div class="form-group">
                    <label>Nhập lại mật khẩu</label>
                    <input type="password" name="password_confirmation" class="form-control" placeholder="Nhập lại mật khẩu"  value="" onkeyup="kiemtramkl()" id="password_confirmation">
                    <div id="password_confirmation_error" style="color: red;"></div>
                    @if ($errors->has('password_confirmation'))
                        <span class="help-block">
                            <strong style="color: red;">{{ $errors->first('password_confirmation') }}</strong>
                        </span>
                    @endif
                </div>
                <input type="submit" name="submit" value="Sửa" class="btn btn-primary" />
                <a href="{{asset('admin/member')}}" class="btn btn-primary">Hủy bỏ</a>
                {{csrf_field()}}
            </form>
        </div>
        @endif
    </div>
</div>

<script type="text/javascript">
    $.ajaxSetup({
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      }
    });

     document.getElementById('id').style.display="none";
      
    function check(){
        var data = new Array;
        data[0]=document.getElementById('old_password').value;
        data[1]=document.getElementById('password').value;
        data[2]=document.getElementById('password_confirmation').value;
        var myerror = new Array();
        myerror[0] = "<span >Bạn chưa nhập mật khẩu cũ</span>";
        myerror[1] = "<span >Bạn chưa nhập mật khẩu</span>";
        myerror[2] = "<span >Bạn chưa nhập lại mật khẩu</span>";

        var nearby = new Array("old_password_error","password_error", "password_confirmation_error");
        var k=0;
        for(i in data){
            var error = myerror[i];
            var div = nearby[i];
            if (data[i]=="") {
                document.getElementById(div).innerHTML = error;
                k++;
            }else{
                 if (data[i].length<=8 || data[i].length>15) {
                   document.getElementById(div).innerHTML = "Mật khẩu lớn hơn 8 và nhỏ hơn 16 ký tự";
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
    }
    function kiemtramkl(){
        var noidung= document.getElementById('password').value;
        var noidung1= document.getElementById('password_confirmation').value;
            if (noidung1!=noidung) {
                document.getElementById('password_confirmation_error').innerHTML="Mật khẩu không trùng với nhau";
            }
            else{
                document.getElementById('password_confirmation_error').innerHTML="";
            }
    }
     function checkinfo(){
        var data = new Array;
        data[0]=document.getElementById('name').value;
        data[1]=document.getElementById('email').value;
        var myerror = new Array();
        myerror[0] = "<span >Bạn chưa nhập họ tên của bạn</span>";
        myerror[1] = "<span >Bạn chưa nhập email </span>";

        var nearby = new Array("name-error","email-error");
        var k=0;
        for(i in data){
            var error = myerror[i];
            var div = nearby[i];
            if (data[i]=="") {
                document.getElementById(div).innerHTML = error;
                k++;
            }else{
                document.getElementById(div).innerHTML = "";
                // k--;
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

    function checkEmail(){
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
  
   
    $("#email").keyup(function(e){
        var id= document.getElementById('id').innerHTML; 
        var email = $(this).val();
        $.post('{{asset('admin/member/edit/checkemail')}}',{'id':id,'email':email},function(data){
            $("#email-error1").html(data);
        });
    });
</script>
@stop


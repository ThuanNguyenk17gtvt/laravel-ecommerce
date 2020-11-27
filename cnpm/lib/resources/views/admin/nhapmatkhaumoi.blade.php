<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nhập mật khẩu mới | Reset password</title>
    <base href="{{asset('public/layout/admin')}}/">
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/index.css" rel="stylesheet">    
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
             @if ($errors->has('password'))
                <span class="help-block">
                    <strong style="color: red;">{{ $errors->first('password') }}</strong>
                </span>
            @endif
            @if ( Session::has('error') )
                    <div class="alert alert-danger alert-dismissible" role="alert">
                        <strong >{{ Session::get('error') }}</strong><br>
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                            <span class="sr-only">Close</span>
                        </button>
                    </div>
                @endif
            <form action="{{asset('nhap_mat_khau_moi')}}" method = "post">
                <div class="form-group" style="border-bottom: 1px solid #000;">
                    <h3 style="color: black">Nhập mật khẩu mới</h3>
                </div>
                <div class="form-group" style="padding: 2px">
                    <p style="color:black">Nhập mật khẩu mới:</p>
                    <input type="password" name = "password" class="form-control" id="password" placeholder="Nhập mật khẩu mới...">
                </div>
                <div class="form-group" style="padding: 2px">
                    <p style="color:black">Nhập lại mật khẩu mới:</p>
                    <input type="password" name = "password_confirmation" class="form-control" id="password_confirmation" placeholder="Nhập lại mật khẩu mới...">
                </div>
                <div class="form-group">
                    <button type="submit" class="btn btn-success form-control" >Xác nhận</button>
                </div>
                {!!csrf_field()!!}
            </form>
        </div>
    </div>
</body>
</html>
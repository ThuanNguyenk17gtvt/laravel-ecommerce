<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mã xác nhận</title>
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
            @if ( Session::has('error') )
                <div class="alert alert-danger alert-dismissible" role="alert">
                    <strong>{{ Session::get('error') }}</strong>
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        <span class="sr-only">Close</span>
                    </button>
                </div>
            @endif  
            <form action="{{asset('nhap_ma_xac_nhan')}}" method = "post">
                <div class="form-group" style="border-bottom: 1px solid #000;">
                    <h3 style="color: black">Nhập mã xác nhận</h3>
                </div>
                <div class="form-group" style="padding: 2px">
                    <p style="color:black">Nhập mã trong mail của bạn</p>
                    <input type="text" name = "code" class="form-control" id="code" placeholder="Nhập mã...">
                </div>
                <div class="form-group">
                    <button type="submit" class="btn btn-success form-control" >Kiểm tra</button>
                </div>
                {!!csrf_field()!!}
            </form>
        </div>
    </div>
</body>
</html>
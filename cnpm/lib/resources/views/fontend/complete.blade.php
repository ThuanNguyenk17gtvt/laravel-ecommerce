@extends('fontend.master')
@section('title','Hoàn thành')
@section('main')
    <link rel="stylesheet" href="css/complete.css">
    <section  id="body">
        <div class="container">
            <div class="row">
                <div class="col-md-3">
                    <nav id="menu">
                        <ul>
                            <li class="menu-item">danh mục sản phẩm</li>
                            @foreach($cates as $cate)
                            <li class="menu-item"><i style="" class="fas fa-mobile-alt "></i><a href="{{asset('/category/'.$cate->cate_id)}}" >{{$cate->cate_name}}</a></li>
                            @endforeach                       
                        </ul>
                    </nav>
                </div>

                <div  id="main" class="col-md-9">
                   <!-- main -->
                    <!-- phan slide la cac hieu ung chuyen dong su dung jquey -->
                    <div id="slider">
                        <div id="demo" class="carousel slide" data-ride="carousel">

                            <!-- Indicators -->
                            <ul class="carousel-indicators">
                                <li data-target="#demo" data-slide-to="0" class="active"></li>
                                <li data-target="#demo" data-slide-to="1"></li>
                                <li data-target="#demo" data-slide-to="2"></li>
                            </ul>

                            <!-- The slideshow -->
                            <div class="carousel-inner">
                                <div class="carousel-item active">
                                    <img src="img/home/slide-1.png" alt="Los Angeles" >
                                </div>
                                <div class="carousel-item">
                                    <img src="img/home/slide-2.png" alt="Chicago">
                                </div>
                                <div class="carousel-item">
                                    <img src="img/home/slide-3.png" alt="New York" >
                                </div>
                            </div>

                            <!-- Left and right controls -->
                            <a class="carousel-control-prev" href="#demo" data-slide="prev">
                                <span class="carousel-control-prev-icon"></span>
                            </a>
                            <a class="carousel-control-next" href="#demo" data-slide="next">
                                <span class="carousel-control-next-icon"></span>
                            </a>
                        </div>
                    </div>

                  <div id="wrap-inner">
                        <div id="complete">
                            <p class="info">Quý khách đã đặt hàng thành công!</p>
                            <p>• Hóa đơn mua hàng của Quý khách đã được chuyển đến Địa chỉ Email của quý khách</p>
                            <p>• Sản phẩm của Quý khách sẽ được chuyển đến Địa có trong phần Thông tin Khách hàng của chúng Tôi sau thời gian 2 đến 3 ngày, tính từ thời điểm này.</p>
                            <p>• Nhân viên giao hàng sẽ liên hệ với Quý khách qua Số Điện thoại trước khi giao hàng 24 tiếng</p>
                            <p>Cám ơn Quý khách đã sử dụng Sản phẩm của Công ty chúng Tôi!</p>
                            <a href="{{asset('information/'.Auth::user()->name_id)}}">Xem trạng thái đơn hàng</a>
                        </div>
                        <p class="text-right return"><a href="{{asset('/')}}">Quay lại trang chủ</a></p>
                    </div>  

                    
                    <!-- end main -->
                   
                </div>
            </div>
        </div>
    </section>

   @stop
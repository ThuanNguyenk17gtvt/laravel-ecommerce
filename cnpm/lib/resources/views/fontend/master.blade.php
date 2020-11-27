<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">   
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <title>TTN Shop - @yield('title')</title>
    <base href="{{asset('public/layout/fontend')}}/">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/home.css">
    <script type="text/javascript" src="js/jquery-3.2.1.min.js"></script>
   <!--  thu vien cho silde -->
   {{--  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.6/umd/popper.min.js"></script> --}}
    <script type="text/javascript" src="js/popper.min.js"></script>
    <script type="text/javascript" src="js/bootstrap.min.js"></script>
    <script type="text/javascript" src="js/sweetalert.js"></script>
    {{-- <script type="text/javascript" src="js/fontawesome.js"></script> --}}
    <!-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css"> -->
    <script src="https://kit.fontawesome.com/2703c57f79.js" crossorigin="anonymous"></script>
    <script src="js/sweetalert.js"></script>
    <script type="text/javascript">
        $(function() {
            var pull        = $('#pull');
            menu        = $('nav ul');
            menuHeight  = menu.height();

            $(pull).on('click', function(e) {
                e.preventDefault();
                menu.slideToggle();
            });
        });

        $(window).resize(function(){
            var w = $(window).width();
            if(w > 320 && menu.is(':hidden')) {
                menu.removeAttr('style');
            }
        });
    </script>
</head>
<body>
    @include('sweetalert::alert')
    <header id="header">
        <div class="container">
            <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-2 ">
                    <a href="{{asset('/')}}"><p><i class="fas fa-home" style="margin-right: 10px;"></i>TTN-SHOP</p></a>
                </div>
                 <div  class="submit" class="col-xs-12 col-sm-12 col-md-4 ">
                    <form class="navbar-form pull-right" method="get" action="{{asset('search/')}}" onsubmit="return search()" id="content">
                        <input type="text" style="width: 200px;" placeholder="Tìm kiếm tên sản phẩm" name="result" id="result" @if(isset($keyword)) value="{{$keyword}}" @endif >
                        <button class="btn"  type="submit" class="btn btn-default" style="border-radius: 3px; cursor: pointer;" onclick="tk()" id="search-btn">Search</button>
                    </form>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-4 ">
                    <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
                        <div class="container-fluid">
                            @if(Auth::check())
                            <div class="navbar-header">
                                <ul class="user-menu">
                                    <li class="dropdown pull-right">
                                        <a href="#" class="dropdown-toggle" data-toggle="dropdown"><svg class="glyph stroked male-user"><use xlink:href="#stroked-male-user"></use></svg> 
                                            @if(Auth::check())
                                                {{Auth::user()->name }}
                                            @endif
                                            <span class="caret"></span></a>
                                        <ul class="dropdown-menu menu" role="menu">
                                             @if(Auth::check())
                                            <li><a style="margin-left: 15px;" href="{{asset('logout')}}"><i class="fas fa-sign-out-alt"></i> Logout</a></li>
                                            <li><a  style="margin-left: 15px;" href="{{asset('information/'.Auth::user()->name_id)}}"><i class="fas fa-info"></i>Thông tin</a></li>
                                            @else
                                                {{-- <a style="margin-left: 20px;" href="{{asset('registration')}}" class="navbar-link " id="dk" ><i class="fas fa-user">Đăng ký</i></a>
                                             <a  style="margin-left: 20px;" href="{{asset('login')}}" class="navbar-link"><i class="fas fa-user">Đăng nhập</i></a> --}}
                                              {{-- <a style="margin-left: 35px;" href="{{asset('login/facebook')}}"> Login bằng <i class="fa fa-facebook-official" aria-hidden="true" style="color: blue;"></i></a> --}}
                                            @endif
                                        </ul>
                                    </li>
                                </ul>
                            </div>
                                 @else
                                 <a style="margin-left: 40px; padding-top: 5px;" href="{{asset('registration')}}" class="navbar-link " id="dk" ><i class="fas fa-user">Đăng ký</i></a>
                                <a  style="margin-right: 20px; padding-top: 5px;" href="{{asset('login')}}" class="navbar-link"><i class="fas fa-user">Đăng nhập</i></a>
                                @endif             
                        </div><!-- /.container-fluid -->
                    </nav>
                </div>
                <div id="cart" class="col-xs-12 col-sm-12 col-md-2 ">
                    <p>Giỏ hàng</p>
                   <a href="{{asset('cart/show')}} "><img src="img/home/giohang.png"></a>
                   <a href="{{asset('cart/show')}}">{{Cart::getContent()->count()}}</a>    
                </div>
            </div>
        </div>
    </header>
    
    @yield('main')
    

    <footer id="footer">  
    <div class="row footer1">
        <div class="container">
            <div class="row info">
                <div class="col-md-4">
                    <div class="logo">
                          <h4> <i class="fas fa-home"></i>Logo trang chủ</h4>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="diachi">
                        <h5>Địa chỉ</h5>
                        <p>Tô ký-Quận 12-Thành phố Hồ Chí Minh</p>
                        {{-- <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3918.3811845685423!2d106.61603801474965!3d10.858584692265799!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x31752a224eba9f39%3A0x841df21c13c4c6b4!2zMjYgVMO0IEvDvSwgVMOibiBDaMOhbmggSGnhu4dwLCBRdeG6rW4gMTIsIEjhu5MgQ2jDrSBNaW5oLCBWaeG7h3QgTmFt!5e0!3m2!1svi!2s!4v1591432982886!5m2!1svi!2s" width="600" height="450" frameborder="0" style="border:0; height: 150px; width: 150px;" {{-- allowfullscreen="" aria-hidden="false" tabindex="0"></iframe> --}}
                    </div>
                </div>
                <div  class="col-md-4">
                    <div class="hotline">
                        <h5>Hotline</h5>
                        <p>0987653728</p>
                    </div>
                </div> 
            </div>
        </div>
       
        {{-- <div id="scroll">
             <a href="#"><img src="img/home/scroll.png"></a>
         </div>  --}} 
    </div>          
    </footer>
    <!-- endfooter -->
</body>
</html>
<script>
    // document.getElementById('result').style.display="block";
    // $('#result').attr('disabled',true);
    function search(){
        var noidung= document.getElementById('result').value;
        if (noidung=="") {
            alert("Bạn chưa nhập gì vào ô tìm kiếm");
            return false;
        }
        else{
            return true;
        }
    }
    // function tk(){
    //     $('#result').attr('disabled',false);
    // }
   
</script>

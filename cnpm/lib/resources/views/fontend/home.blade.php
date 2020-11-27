@extends('fontend.master')
@section('title','Trang chủ')
@section('main')
      <body>
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
                            <!-- <a href="#" id="pull">Danh mục</a> -->
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
                   
                </div>
                
                <div id="main" class="col-md-12">
                    <div id="banner-l" class="text-center">
                        <div class="banner-l-item">
                            <a href="#" target="_blank"><img src="img/home/banner-l-1.png" alt="" class="img-thumbnail"></a>
                             <a href="#" target="_blank"><img src="img/home/banner-l-6.png" alt="" class="img-thumbnail"></a>
                            <a href="#" target="_blank"><img src="img/home/banner-l-4.png" alt="" class="img-thumbnail"></a>
                        </div>
                    </div>
                    <div id="wrap-inner">
                        <div class="products">
                            <h3>sản phẩm nổi bật,xem nhiều</h3>
                            <div class="product-list row">
                                @foreach($products as $product)
                                <div class="product-item col-md-2 col-sm-6 col-xs-12">
                                     <span class="sale">{{$product->prod_promotion}}</span>
                                     <a style="cursor: pointer;" onclick="addcart('{{$product->prod_id}}')"><i class="fas fa-cart-plus giohang"></i></a>
                                     <a href="{{asset('detail/'.$product->prod_id)}}"><img src="{{asset('lib/storage/app/avatar/'.$product->prod_img)}}" class="img-thumbnail"></a>
                                    <p><a href="{{asset('detail/'.$product->prod_id)}}">{{$product->prod_name}}</a></p>
                                    <p class="price">{{ number_format($product->prod_price,'0',',','.')}} VNĐ</p>   
                                </div>
                                @endforeach
                            </div>                                      
                        </div>
                        <div id="banner-l" class="text-center">
                            <div class="banner-l-item" >
                                <a href="#" target="_blank"><img src="img/home/banner-l-5.png" alt="" class="img-thumbnail"></a>
                                <a href="#" target="_blank"><img src="img/home/banner-l-2.png" alt="" class="img-thumbnail"></a>
                                <a href="#" target="_blank"><img src="img/home/banner-l-3.png" alt="" class="img-thumbnail"></a>
                            </div>
                        </div>

                        <div class="products">
                            <h3>sản phẩm bán chạy</h3>
                            <div class="product-list row">
                                @foreach($news as $new)
                                <div class="product-item col-md-2 col-sm-6 col-xs-12">
                                      <span class="sale">{{$new->prod_promotion}}</span>
                                      <a style="cursor: pointer;" onclick="addcart('{{$new->prod_id}}')"><i class="fas fa-cart-plus giohang"></i></a>
                                    <a href="{{asset('detail/'.$new->prod_id)}}"><img src="{{asset('lib/storage/app/avatar/'.$new->prod_img)}}" class="img-thumbnail"></a>
                                    <p><a href="{{asset('detail/'.$new->prod_id)}}">{{$new->prod_name}}</a></p>
                                    <p class="price">{{ number_format($new->prod_price,'0',',','.')}} VNĐ</p>   
                                </div>
                                @endforeach
                            </div>    
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </section> 
      </body>
    <script>
        function addcart(id){
             $.get(
                '{{asset('cart/add')}}', 
                {id},
                function(data){
                    // alert("Sản phẩm được thêm vào giỏ hàng thành công");
                     location.reload();
                }
            );
        }
    </script>
    
  @stop  
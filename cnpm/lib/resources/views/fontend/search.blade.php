@extends('fontend.master')
@section('title','Tìm kiếm')
@section('main')
    <link rel="stylesheet" href="css/search.css">
    

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

                    <div id="wrap-inner">
                        <div class="products">
                            <h3>Tìm kiếm với từ khóa: <span>{{$keyword}}</span></h3>
                            @if(count($products)<1)
                                <h4 style="margin-left: 22px;">Không có sản phẩm phù hợp</h4>
                            @endif
                            <div class="product-list row">
                                @foreach($products as $item)
                                    <div class="product-item col-md-3 col-sm-6 col-xs-12">
                                         <span class="sale">{{$item->prod_promotion}}</span>
                                         <a style="cursor: pointer;" onclick="addcart('{{$item->prod_id}}')"><i class="fas fa-cart-plus giohang"></i></a>
                                        <a href="{{asset('detail/'.$item->prod_id)}}"><img src="{{asset('lib/storage/app/avatar/'.$item->prod_img)}}" class="img-thumbnail"> </a>
                                        <p><a href="{{asset('detail/'.$item->prod_id)}}">{{$item->prod_name}}</a></p>
                                        <p class="price">{{ number_format($item->prod_price,'0',',','.')}} VNĐ</p>   
                                    </div>
                                @endforeach()
                            </div>                                      
                        </div>

                        {{-- <div id="pagination">
                            <ul class="pagination pagination-lg justify-content-center">
                                 {{$products->links()}} 
                            </ul>
                        </div> --}}
                    </div>
                </div>
            </div>
        </div>
    </section>
    <script>
        function addcart(id){
             $.get(
                '{{asset('cart/add')}}', 
                {id},
                function(){
                    // alert("Sản phẩm được thêm vào giỏ hàng thành công");
                    location.reload();
                }
            );
        }
    </script>
@stop
@extends('fontend.master')
@section('title','Loại sản phẩm')
@section('main')
    <link rel="stylesheet" href="css/category.css">
    <script type="text/javascript" src="js/jquery-1.12.0.min.js"></script>
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
                    <div class="sort">
                    	<form action="{{url('category/'.$catename->cate_id)}}" method="post" id="form-sort">
                    		<label for="conditons" id="c">Tình trạng</label>
                    		<select name="prod_condition" id="conditons">
                    			<option value="1" @if(isset($condition)) @if($condition==1)selected @endif @endif>Mới</option>
                    			<option value="0" @if(isset($condition)) @if($condition==0)selected @endif @endif>Cũ</option>
                    		</select>
                    		<label for="money" id="m">Giá tiền</label>
                    		<select name="prod_price" id="money">
                    			<option value="1"@if(isset($price)) @if($price==1)selected @endif @endif>Giảm dần</option>
                    			<option value="0"@if(isset($price)) @if($price==0)selected @endif @endif>Tăng dần</option>
                    		</select>
                    		<label for="featured" id="f">Đặc tính</label>
                    		<select name="prod_featured" id="featured">
                    			<option value="1" @if(isset($featured)) @if($featured==1)selected @endif @endif>Nổi bật</option>
                    			<option value="0" @if(isset($featured)) @if($featured==0)selected @endif @endif>Không nổi bật</option>
                    		</select>
                    		<button type="submit" id="btn-sort"> Sắp xếp</button>
                    		{{csrf_field()}}
                    	</form>
                    </div>
                   <div id="wrap-inner">
                        <div class="products">
                            <h3>{{$catename->cate_name}}</h3>
                            @if(count($items)<1)
                                <h5 style="margin-left: 22px;">Không có sản phẩm nào phù hợp với các tiêu chí bạn chọn, cảm ơn</h5>
                            @endif
                            <div class="product-list row">
                                @foreach($items as $item)
                                     <div class="product-item col-md-3 col-sm-6 col-xs-12">
                                    <span class="sale">{{$item->prod_promotion}}</span>
                                    <a style="cursor: pointer;" onclick="addcart('{{$item->prod_id}}')"><i class="fas fa-cart-plus giohang"></i></a>
                                    <a href="{{asset('detail/'.$item->prod_id)}}"><img src="{{asset('lib/storage/app/avatar/'.$item->prod_img)}}" class="img-thumbnail"></a>
                                    <p><a href="{{asset('detail/'.$item->prod_id)}}">{{$item->prod_name}}</a></p>
                                    <p class="price">{{ number_format($item->prod_price,'0',',','.')}} VNĐ</p>  
                                    </div>
                               @endforeach
                            </div>                                      
                        </div>

                        <div id="pagination">
                            <ul class="pagination pagination-lg justify-content-center">
                               {{$items->links()}}
                            </ul>
                        </div>
                    </div>

                    
                    <!-- end main -->
                   
                </div>
            </div>
        </div>
    </section>
     {{-- <script type="text/javascript">
        $(document).ready(function()
        {   
            $("#btn-sort").click(function(e) 
            {
                e.preventDefault();
                var data = $('form#form-sort').serialize();
                $.ajax({
                type : 'POST', //kiểu post
                url  : '{{asset('category/'.$catename->cate_id)}}', 
                data : data,
                success :  function(data)
                       {                       
                        // $('#wrap-inner').html(data);
                        location.reload();
                       }
                });
                return false; 
            });
            
        });
    </script> --}}
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
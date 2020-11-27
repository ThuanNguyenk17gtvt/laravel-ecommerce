@extends('fontend.master')
@section('title','Chi tiết')
@section('main')
    <link rel="stylesheet" href="css/detail.css"/>
    <link rel="stylesheet" href="css/easyzoom.css" />
    <script type="text/javascript" src="../../editor/ckeditor/ckeditor.js"></script>
    <script  src="js/easyzoom.js"></script>
    <script type="text/javascript" src="js/jquery-1.11.3.min.js"></script> 
     <script type="text/javascript" src="js/jquery-3.1.1.min.js"></script>
     <script type="text/javascript" src="js/jquery-1.12.0.min.js"></script>
    <script src="https://code.jquery.com/jquery-latest.js"></script>
<link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">

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
                                {{-- <span class="carousel-control-next-icon"></span> --}}
                            </a>
                        </div>
                    </div>

                </div>
                <div id="main" class="col-md-12">
                    @include('sweetalert::alert')
                    <div id="wrap-inner">
                        <div id="product-info">
                            <div class="clearfix"></div>
                            <h3>{{$product->prod_name}}</h3>
                            <div class="row">
                                <div id="product-img" class="col-xs-12 col-sm-12 col-md-3 text-center ">
                                   {{--  <figure class="zoom" style="background:url({{asset('lib/storage/app/avatar/'.$product->prod_img)}});" onmousemove="zoom(event)" ontouchmove="zoom(event)"> --}}
                                        <span class="sale">{{$product->prod_promotion}}</span>
                                        <a href="{{asset('lib/storage/app/avatar/'.$product->prod_img)}}">
                                            <img src="{{asset('lib/storage/app/avatar/'.$product->prod_img)}}" >
                                        </a>
                                    {{-- </figure> --}}
                                </div>
                                <div id="product-details" class="col-xs-12 col-sm-12 col-md-6">
                                    <p>Giá: <span class="price">{{ number_format($product->prod_price,'0',',','.')}}</span> VNĐ</p>
                                    {{-- <p>Mã SP: {{$product->prod_id}}</p> --}}
                                    <p>Bảo hành: {{$product->prod_warranty}} tháng</p> 
                                    <p>Phụ kiện:@if($product->prod_acccessories==null) Không có @else {{$product->prod_acccessories}} @endif</p>
                                    <p>Tình trạng:@if($product->prod_condition==1) Hàng mới @else Hàng cũ @endif</p>
                                    <p>Khuyến mại: {{$product->prod_promotion}} %</p>
                                    <p style="color: red;">@if($product->prod_amount<1) Xin lỗi quý khách hiện tại mặt hàng này đã hết  @endif</p>
                                    <p class="add-cart text-center"><a onclick="addcart('{{$product->prod_id}}')" style="cursor: pointer;"><i class="fas fa-shopping-cart"></i>Đặt hàng online</a></p>
                                </div>
                            </div>
                                                   
                        </div>
                        
                         <div id="product-detail" class="col-md-6" style="float: right;">
                            <ul>
                                <h3 style="margin-left: 15px;">Chi tiết sản phẩm</h3>
                                <ul> <li class="title">Mã sản phẩm</li> 
                                    <li class="detail" >{{$product->prod_id}}</li>
                                </ul>
                                <ul> <li class="title">Tên sản phẩm</li> 
                                    <li class="detail" >{{$product->prod_name}}</li>
                                </ul>
                                <ul>  <li class="title">Giá sản phẩm</li> 
                                    <li class="detail" > {{number_format($product->prod_price,'0',',','.')}} VNĐ  </li>
                                </ul>
                                <ul>  <li class="title">Bảo hành sản phẩm</li> 
                                    <li class="detail" >{{$product->prod_warranty}} tháng</li>
                                </ul>
                                <ul>  <li class="title">Phụ kiện</li>  
                                    <li class="detail" >@if($product->prod_acccessories==null) Không có @else {{$product->prod_acccessories}} @endif  </li>
                                </ul>
                                <ul>  <li class="title">Tình trạng </li> 
                                    <li class="detail" >@if($product->prod_condition==1) Hàng mới @else Hàng cũ @endif </li>
                                </ul>
                                <ul>  <li class="title">Khuyến mãi</li> 
                                    <li class="detail" > {{$product->prod_promotion}} % </li>
                                </ul>
                                <ul>  <li class="title">Miêu tả </li> 
                                    <li class="detail1" >{!!$product->prod_description!!}  </li>
                                </ul>
                                <ul> <li class="title">Số lượng </li> 
                                    <li class="detail" > {{$product->prod_amount}}  </li>
                                </ul>
                            </ul>
                        </div>
                        <form  method="post" action="{{url('rating/'.$product->prod_id)}}"  id="form-rating" name="st">
                            <button class="btn btn-default star-submit" type="submit" id="btn-star"> Gửi</button>
                            <div class="rating ">
                            <input type="radio" name="star" id="star1" value="5"><label for="star1"></label>
                            <input type="radio" name="star" id="star2" value="4"><label for="star2"></label>
                            <input type="radio" name="star" id="star3" value="3"><label for="star3"></label>
                            <input type="radio" name="star" id="star4" value="2"><label for="star4"></label>
                            <input type="radio" name="star" id="star5" value="1"><label for="star5"></label>
                            </div> 
                            {{csrf_field()}}
                        </form>
                        <div class="danhgia col-md-6" id="danhgia">
                            <div class="sao">
                                <h1> @if($count>0) {{round(floatval($sum/$count),1)}} @else 0 @endif <i class="fas fa-star fas1"></i></h1>
                                <h5><i class="fas fa-user"></i>{{$count}} Votes</h5>
                            </div>
                            <div class="chitiet">
                                <ul>
                                    <li><i class="fas fa-star"></i>&nbsp; 5
                                        <div class="progress">
                                            <div class="progress-bar progress-bar-success" role="progressbar" aria-valuenow="70" aria-valuemin="0" aria-valuemax="100" style="width: @if($count>0){{($r5*100)/$count}}% @else 0% @endif">
                                            </div>
                                          </div>
                                    </li>
                                    <li><i class="fas fa-star"></i>&nbsp; 4
                                        <div class="progress">
                                            <div class="progress-bar" role="progressbar" aria-valuenow="70" aria-valuemin="0" aria-valuemax="100" style="width: @if($count>0) {{($r4*100)/$count }}% @else 0% @endif">
                                            </div>
                                          </div>
                                    </li>
                                    <li><i class="fas fa-star"></i>&nbsp; 3
                                        <div class="progress">
                                            <div class="progress-bar" role="progressbar" aria-valuenow="70" aria-valuemin="0" aria-valuemax="100" style="width: @if($count>0) {{($r3*100)/$count }}% @else 0% @endif">
                                            </div>
                                          </div>
                                    </li>
                                    <li><i class="fas fa-star"></i>&nbsp; 2
                                            <div class="progress">
                                            <div class="progress-bar" role="progressbar" aria-valuenow="70" aria-valuemin="0" aria-valuemax="100" style="width: @if($count>0) {{($r2*100)/$count }}% @else 0% @endif">
                                            </div>
                                          </div>
                                    </li>
                                    <li><i class="fas fa-star"></i>&nbsp; 1
                                            <div class="progress">
                                            <div class="progress-bar" role="progressbar" aria-valuenow="70" aria-valuemin="0" aria-valuemax="100" style="width: @if($count>0) {{($r1*100)/$count }}% @else 0% @endif">
                                            </div>
                                          </div>
                                    </li>
                                </ul>
                            </div>
                        </div>
                       
                        <div id="comment" > 
                            <h3>Bình luận</h3>
                            <div class="col-md-6 comment">
                                <form method="post"  name="cmt" id="form-comment">
                                    <div class="form-group">
                                        <label for="cm">Bình luận:</label>
                                        <textarea  rows="10" id="cm" class="form-control" name="content"></textarea>
                                    </div>
                                    <div class="form-group text-right">
                                        <button id="btn-gui" type="submit" class="btn btn-default gui">Gửi</button>
                                    </div>
                                   {{csrf_field()}}
                                </form>
                            </div>
                        </div>
                        <div id="comment-list" class="col-md-6">
                            @foreach($comments as $comment)
                            <ul>
                                <li class="com-title">
                                    {{$comment->com_name}}
                                     @if(Auth::check())
                                     @if($comment->com_email == Auth::user()->email)
                                        <a class=" xoa"  onclick="deletecomment('{{$comment->com_id}}')" >Xóa</a>
                                    @endif
                                    @endif
                                    <br>
                                    <span>{{$comment->created_at}}</span>    
                                </li>
                                <li class="com-details">
                                    {{$comment->com_content}}
                                </li>
                            </ul>
                            @endforeach()
                        </div>
                    </div>                  
                    <!-- end main -->
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
    <script type="text/javascript">
        $(document).ready(function()
        {   
            $("#btn-star").click(function(e) 
            {
                @if (Auth::check()) {
                    e.preventDefault();
                    var noidung= document.st.star.value;
                    if (noidung == '') {
                        alert("Bạn chưa chọn số sao cần đánh giá");
                        return false;
                    }
                    var data = $('form#form-rating').serialize(); 
                    $.ajax({
                    type : 'POST', //kiểu post
                    url  : '{{asset('rating/'.$product->prod_id)}}', 
                    data : data,
                    success :  function(data)
                           {                       
                            // $('#comment-list').html(data);
                             location.reload();
                            // if (data=="thanhcong") {
                            //     alert("Cảm ơn bạn đã đánh giá sản phẩm của chúng tôi");
                            // }
                           }
                    });
                    return false; 
                }@else{
                    alert("Bạn cần đăng nhập để có thể đánh giá sản phẩm, cảm ơn");
                    return false;
                }
                @endif
            });
            
        });
    </script>
    <script>
        function deletecomment(id){
            var result =confirm("Bạn có chắc muốn xóa bình luận này không");
            if (result) {
                 $.get(
                    '{{asset('comment')}}', 
                    {id},
                    function(){
                        location.reload();
                    }
                );
             }else{
                return false;
             }
        }
    </script>
    <script>
          function zoom(e) {
            var zoomer = e.currentTarget;
            e.offsetX ? offsetX = e.offsetX : offsetX = e.touches[0].pageX
            e.offsetY ? offsetY = e.offsetY : offsetX = e.touches[0].pageX
            x = (offsetX / zoomer.offsetWidth) * 100
            y = (offsetY / zoomer.offsetHeight) * 100
            zoomer.style.backgroundPosition = x + "% " + y + "%";
          }
    </script>
    <script type="text/javascript">
        $(document).ready(function()
        {   
            $("#btn-gui").click(function(e) 
            {
                @if (Auth::check()) {
                    e.preventDefault();
                    var noidung= document.cmt.content.value;
                    if (noidung == '') {
                        alert("Bạn chưa nhập gì vào bình luận");
                        return false;
                         // location.reload();
                    }
                     
                    var data = $('form#form-comment').serialize();
                    $.ajax({
                    type : 'POST', //kiểu post
                    url  : '{{asset('detail/'.$product->prod_id)}}', 
                    data : data,
                    success :  function(data)
                           {                       
                            // $('#comment-list').html(data);
                            location.reload();
                           }
                    });
                    return false;
                }@else{
                    alert("Bạn cần đăng nhập để có thể đánh giá sản phẩm, cảm ơn");
                    return false;
                }
                @endif
            });
            
        });
    </script>

    

    @stop
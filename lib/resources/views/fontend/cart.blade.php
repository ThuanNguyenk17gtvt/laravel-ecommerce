@extends('fontend.master')
@section('title','Giỏ hàng')
@section('main')
    <script type="text/javascript" src="../../editor/ckeditor/ckeditor.js"></script>
    <script src="js/sweetalert.js"></script>
    <link rel="stylesheet" href="css/cart.css">
    <link rel="stylesheet" href="css/ldbtn.min.css">
    <script type="text/javascript" src="js/jquery-3.1.1.min.js" ></script>
    <script type="text/javascript" src="js/jquery-latest.js" ></script>
    <script type="text/javascript" src="js/jquery.min.js" ></script>
    <script type="text/javascript" src="js/jquery-1.12.0.min.js"></script>
    <script type="text/javascript">
        
        function updateCart(qty,id){
            $.get(
                '{{asset('cart/update')}}', 
                {qty:qty,id:id},
                function(){
                    location.reload();
                }
            );
        }
    </script>
    <section  id="body">
        <div class="container">
            <div class="spinner">
              <div class="blob blob-0"></div>
            </div>
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
                   <div id="wrap-inner" class="chinh">
                     @include('sweetalert::alert')
                        <div id="list-cart">
                            <h3  >Giỏ hàng</h3>
                            @if(Cart::getContent()->count()>=1)
                            <form>
                                <table class="table table-bordered .table-responsive text-center">
                                    <tr class="active">
                                        <td width="10%">Mã sản phẩm</td>
                                        <td width="11.111%">Ảnh mô tả</td>
                                        <td width="12.222%">Tên sản phẩm</td>
                                        <td width="12.222%">Số lượng</td>
                                        <td width="8%">KM</td>
                                        <td width="16.6665%">Đơn giá</td>
                                        <td width="16.6665%">Thành tiền</td>
                                        <td width="11.112%">Xóa</td>
                                    </tr>
                                    @foreach($items as $item)
                                    <tr>
                                        <td><span>{{$item->id}}</span></td>
                                        <td><img  style="height: 150px; width: 110px; " class="img-responsive" src="{{asset('lib/storage/app/avatar/'.$item->attributes->color)}}"></td>
                                        <td>{{$item->name}}</td>
                                        <td>
                                            <div class="form-group">
                                                <input class="form-control" type="number" name="quantity" value="{{$item->quantity}}" onblur="updateCart(this.value,'{{$item->id}}')" >
                                            </div>
                                        </td>
                                        <td>{{$item->attributes->promotion}} %</td>
                                        <td><span class="price">{{ number_format($item->price,'0',',','.')}} VNĐ</span></td>
                                        <td><span class="price">{{ number_format($item->quantity*($item->price-($item->price*$item->attributes->promotion/100)),'0',',','.')}} VNĐ</span></td>
                                        <td><a onclick="deletecart('{{$item->id}}')" style="cursor: pointer;">Xóa</a></td>
                                    </tr>
                                    @endforeach()
                                </table>
                                <div class="row" id="total-price">
                                    <div class="col-md-6 col-sm-12 col-xs-12" > 
                                        <div class="total" style="margin-left: 12px;">
                                        Tổng thanh toán: <span class="total-price">{{ number_format($total,'0',',','.')}} VNĐ</span>
                                        </div>                                    
                                        @include('errors.note') 
                                        <p style="margin-left: 12px;" >Thanh toán khi nhận hàng cảm ơn</p>
                                        @if(Cart::getContent()->count()>=2) 
                                        <i>Bạn được miễn phí giao hàng do bạn mua hàng từ 2 món trở lên</i> @endif 
                                    </div>
                                     <div class="col-md-6 col-sm-12 col-xs-12" >
                                     <a  class="btn-success btn" style="float: right; margin-right: 92px; cursor: pointer; color: white;" onclick="kiemtra()" id="dt">Đặt hàng</a> 
                                        <a  class="btn-success btn" style="float: right; margin-right: 92px; cursor: pointer; color: white;" onclick="deletecartall('all')">Xóa giỏ hàng</a>
                                    </div>
                                </div>
                            </form>    
                              @else  <h2 style="margin-left: 12px;" >Giỏ hàng rỗng!</h2> 
                            @endif                                 
                        </div>
                        <div id="xac-nhan" class="col-md-8">
                            @include('errors.note')
                            <h3>Xác nhận mua hàng</h3>
                            <span style="color: red;">Bạn cần xác nhận email đã chính xác chưa trước khi đặt hàng</span>
                            <form method="post" action="{{url('cart/complete')}}" onsubmit="return check()" name="form_complete">
                                <div class="form-group ">
                                    <label for="phone">Số điện thoại:</label>
                                    <input  type="number" class="form-control" id="phone" name="phone" style="border-radius: 3px; " placeholder="SĐT" value="{{old('phone')}}"  onkeyup="check()" >
                                    <div id="phone-error" style="color: red;"></div>
                                    @if ($errors->has('phone'))
                                        <span class="help-block">
                                            <strong style="color: red;">{{ $errors->first('phone') }}</strong>
                                        </span>
                                    @endif
                                </div>
                                <div class="form-group ">
                                    <label for="add">Địa chỉ:</label>
                                    <textarea id="add" name="address"  style="width: 100%;" onkeyup="check()">{{old('address')}}
                                        </textarea>
                                        <script type="text/javascript">
                                            var editor = CKEDITOR.replace('add',{
                                                language:'vi',
                                                filebrowserImageBrowseUrl: '../../editor/ckfinder/ckfinder.html?Type=Images',
                                                filebrowserFlashBrowseUrl: '../../editor/ckfinder/ckfinder.html?Type=Flash',
                                                filebrowserImageUploadUrl: '../../editor/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Images',
                                                filebrowserFlashUploadUrl: '../../public/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Flash',
                                            });
                                        </script>
                                    {{-- <input  type="text" class="form-control" id="add" name="address" style="border-radius: 3px; " placeholder="Địa chỉ nhà bạn" value="{{old('address')}}"  onkeyup="check()"> --}}
                                    <div id="address-error" style="color: red;"></div>
                                    @if ($errors->has('address'))
                                        <span class="help-block">
                                            <strong style="color: red;">{{ $errors->first('address') }}</strong>
                                        </span>
                                    @endif
                                </div>
                                <div class="form-group text-right">
                                    <button  type="submit" class="btn btn-default" onclick="dathang() " id="start" >Hoàn thành đơn hàng</button>
                                </div>
                                {{csrf_field()}}
                            </form>
                        </div>

                    </div>
                    <!-- end main -->
                   
                </div>
            </div>
        </div>
    </section>
    <script>
        document.getElementById('xac-nhan').style.display="none"; 
        function kiemtra(){
            @if (Auth::check()) {
                document.getElementById('xac-nhan').style.display="block";
                document.getElementById('dt').style.display="none";
            }
            @else{
                alert("Bạn cần đăng nhập để mua hàng cảm ơn");
                return false;
            }
            @endif
        }

        function check() {
            var data = new Array();
            data[0] = document.getElementById('phone').value;
            data[1] =CKEDITOR.instances.add.getData();
             // data[1] =document.getElementById('add').value;
            
            var myerror = new Array();
            myerror[0] = "<span >Bạn chưa nhập số điện thoại</span>";
            myerror[1] = "<span >Bạn chưa nhập địa chỉ giao hàng</span>";
         
            var nearby = new Array("phone-error","address-error",);
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
                var count_phone= data[0].length;
                if (count_phone<10 || count_phone>11) {
                    document.getElementById(nearby[0]).innerHTML = "Số điện thoại tối thiểu 10 số và nhỏ hơn 12 số";
                    k++;
                }else{
                    document.getElementById(nearby[0]).innerHTML = "";
                    k--;
                }
            }
            if (k>0) {
                kt = false;
                return false;
            }else{
                kt = true;
            }
         
        }
        
        function dathang (){
            if(kt){
                var x = document.getElementById("start");
                if(x.textContent == "Vui long cho trong giay lat..."){
                    x.style.opacity = 0.5;
                    x.style.cursor = "no-drop";
                    return false;
                }
                x.style.opacity = 0.5;
                x.style.cursor = "no-drop";
                x.innerHTML="Vui long cho trong giay lat...";
            }
        }
       
    </script>
     <script>
        function deletecart(id){
            var result= confirm("Bạn có chắc muốn xóa sản phẩm này khỏi giỏ hàng hay không");
            if (result) {
                @if(Cart::getContent()->count()>=1)
                $.get(
                    '{{asset('cart/delete')}}', 
                    {id},
                    function(){
                        location.reload();
                    }
                );
                @endif
            }
            else{
               return false; 
            }
        }
        function deletecartall(id){ 
            var result= confirm("Bạn có chắc muốn xóa tất cả các sản phẩm khỏi giỏ hàng hay không");
            if (result) {
                @if(Cart::getContent()->count()>=1)
                $.get(
                    '{{asset('cart/delete')}}', 
                    {id},
                    function(){
                        location.reload();
                    }
                );
                @endif
            }
            else{
               return false; 
            }
        }
        $(window).on("load",function(){
            $(".spinner").fadeOut("slow");
        });

        // $("#start").on("click", function() {
        //      $(window).on("load",function(){
        //          $(".spinner").fadeOut("slow");
        //     });
        //   requestAnimationFrame(repeatOften);
        // });
       
        // function repeatOften(){
        //       $(window).on("load",function(){
        //          $(".spinner").fadeOut("slow");
        //     });
        //   requestAnimationFrame(repeatOften);
        // }
        //  requestAnimationFrame(repeatOften);
    </script>
@stop
    
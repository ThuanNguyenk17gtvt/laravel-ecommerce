<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1"> 
<title>@yield('title')| TTN shop</title>
<base href="{{asset('public/layout/admin')}}/">
<link href="css/bootstrap.min.css" rel="stylesheet">
<link href="css/datepicker3.css" rel="stylesheet">
<script type="text/javascript" src="js/jquery-1.12.0.min.js"></script>
<!-- <link href="css/styles.css" rel="stylesheet"> -->
<link href="css/index.css" rel="stylesheet">
<script type="text/javascript" src="../../editor/ckeditor/ckeditor.js"></script>
<script src="js/lumino.glyphs.js"></script>
<script src="https://kit.fontawesome.com/2703c57f79.js" crossorigin="anonymous"></script>
<script src="js/sweetalert.js"></script>
</head>
<body>
	<nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
		<div class="container-fluid">
			<div class="navbar-header">
				<a class="navbar-brand" href="{{asset('admin')}}">TTN Admin</a>
				<ul class="user-menu">
					<li class="dropdown pull-right">
						<a href="#" class="dropdown-toggle" data-toggle="dropdown"><svg class="glyph stroked male-user"><use xlink:href="#stroked-male-user"></use></svg> 
                            {{Auth::user()->name}}
                            <span class="caret"></span></a>
						<ul class="dropdown-menu" role="menu">
							<li><a href="{{asset('logout')}}"><svg class="glyph stroked cancel"><use xlink:href="#stroked-cancel"></use></svg> Logout</a></li>
						</ul>
					</li>
				</ul>
			</div>
							
		</div><!-- /.container-fluid -->
	</nav>

	<div id="sidebar-collapse" class="col-md-3 col-sm-3 col-lg-2 sidebar">
		<div class="panel-group" id="accordion">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h4 class="panel-title">
                            <a href="{{asset('admin')}}"> <i class="fas fa-home"></i> Trang chủ</a>
                        </h4>
                    </div>
                </div>
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h4 class="panel-title">
                            {{-- <a data-toggle="collapse" data-parent="#accordion" href="#collapseTwo"><i class="fas fa-mobile-alt"></i>Loại Sản phẩm</a> --}}
                             <a href="{{asset('admin/category')}}"> <i class="fas fa-mobile-alt"></i> Loại Sản phẩm</a>
                        </h4>
                    </div>
                    {{-- <div id="collapseTwo" class="panel-collapse collapse">
                        <div class="panel-body">
                            <table class="table">
                                <tr>
                                    <td>
                                       <a href="{{asset('admin/category')}}"><i class="fas fa-eye"></i>Xem</a>
                                    </td>
                                </tr>
                            </table>
                        </div>
                    </div> --}}
                </div>
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h4 class="panel-title">
                            {{-- <a data-toggle="collapse" data-parent="#accordion" href="#collapseFour"><i class="fas fa-user"></i>Thành viên</a> --}}
                             <a href="{{asset('admin/member')}}"><i class="fas fa-user"></i>Thành viên</a>
                        </h4>
                    </div>
                    {{-- <div id="collapseFour" class="panel-collapse collapse">
                        <div class="panel-body">
                            <table class="table">
                                <tr>
                                    <td>
                                        <a href="{{asset('admin/member')}}"><i class="fas fa-eye"></i>Xem</a>
                                    </td>
                                </tr>
                            </table>
                        </div>
                    </div> --}}
	            </div>
	              <div class="panel panel-default">
                    <div class="panel-heading">
                        <h4 class="panel-title">
                            {{-- <a data-toggle="collapse" data-parent="#accordion" href="#collapseThree"><i class="fas fa-user"></i>Giỏ hàng</a> --}}
                            <a href="{{asset('admin/cart')}}"><i class="fas fa-shopping-cart"></i>Đơn hàng</a>
                        </h4>
                    </div>
                    {{-- <div id="collapseThree" class="panel-collapse collapse">
                        <div class="panel-body">
                            <table class="table">
                                <tr>
                                    <td>
                                        <a href="{{asset('admin/cart')}}"><i class="fas fa-eye"></i>Xem</a>
                                    </td>
                                </tr>
                            </table>
                        </div>
                    </div> --}}
                </div>
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h4 class="panel-title">
                            <a href="{{asset('admin/sales')}}"><i class="fas fa-info"></i>Doanh số</a>
                        </h4>
                    </div>
                </div>
	    </div>
	</div>

	
	@yield('main')
	

	{{-- <script src="js/jquery-1.11.1.min.js"></script> --}}
    {{-- <script type="text/javascript" src="js/jquery-3.2.1.min.js"></script> --}}
	<script src="js/bootstrap.min.js"></script>
	<script src="js/chart.min.js"></script>
	{{-- <script src="js/chart-data.js"></script> --}}
	<script src="js/easypiechart.js"></script>
	{{-- <script src="js/easypiechart-data.js"></script> --}}
	<script src="js/bootstrap-datepicker.js"></script>
	<script>
		$('#calendar').datepicker({
		});

		!function ($) {
		    $(document).on("click","ul.nav li.parent > a > span.icon", function(){          
		        $(this).find('em:first').toggleClass("glyphicon-minus");      
		    }); 
		    $(".sidebar span.icon").find('em:first').addClass("glyphicon-plus");
		}(window.jQuery);

		$(window).on('resize', function () {
		  if ($(window).width() > 768) $('#sidebar-collapse').collapse('show')
		})
		$(window).on('resize', function () {
		  if ($(window).width() <= 767) $('#sidebar-collapse').collapse('hide')
		})
	</script>	
	
</body>

</html>
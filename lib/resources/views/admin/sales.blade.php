@extends('admin.master')
@section('title','Loại sản phẩm')
@section('main')
 <script type="text/javascript" src="js/jquery-1.12.0.min.js"></script>
 <script type="text/javascript" src="js/chart.min.js"></script>
	<div class="col-sm-3" style="margin-left: 300px;">
	<h4>Chọn thông tin cần thống kê</h4>
	<label for="">Ngày</label>
	<form action="{{url('admin/sales/date')}}" method="get" name="form_day"  onsubmit="return check_day()">
		<input type="date" name="day" @if(isset($day)) value="{{$day}}" @endif>
		<button type="submit" id="btn-sale" style="cursor: pointer;">Thống kê</button> 
	</form>
	<label for="">Tháng</label>
	<form action="{{url('admin/sales')}}" method="post" name="sale" id="form-month" onsubmit="return check()">
		<input type="month" name="monthyear" @if(isset($my)) value="{{$my}}" @endif>
		<button type="submit" id="btn-sale" style="cursor: pointer;">Thống kê</button> 
	{{csrf_field()}}
	</form>
	<label for="">Năm</label>
	<form action="{{url('admin/sales/year')}}" name="form_year" onsubmit="return check_year()" method="get">
		<input type="number" min="1900" max="2099" step="1" @if(isset($year)) value="{{$year}}" @else value="2020"  @endif  name="year" />
		<button type="submit" style="cursor: pointer;" >Thống kê</button>
	</form>
	</div>
	<div class="col-sm-6" id="list">
		<table class="table table-bordered " >
			<thead>
				<tr class="bg-infor">
					<th width="10%">STT</th>
					<th width="20%">Mã đơn hàng</th>
					<th width="20%">Tổng tiền</th>
				</tr>
			</thead>
			<tbody>
				@if(isset($infor))
				@foreach($infor as $info)
				<tr>
					<td>{{$loop->index}}</td>
					<td>{{$info->id}}</td>
					<td>{{number_format($info->total,'0',',','.')}} VNĐ</td>
				</tr>
				@endforeach
				@endif
			</tbody>
		</table>
		@if(isset($sum)  && isset($my))
		Tổng doanh thu  của tháng  {{$my}} là: {{number_format($sum,'0',',','.')}}VNĐ
		@endif
		@if(isset($sum_date))
		Tổng doanh thu ngày hôm nay là: {{number_format($sum_date,'0',',','.')}}VNĐ
		@endif
		@if(isset($sum_year) && isset($year))
		Tổng doanh thu của năm {{$year}} là: {{number_format($sum_year,'0',',','.')}}VNĐ
		@endif
		@if(isset($sum_day) && isset($day))
		Tổng doanh thu của ngày {{$day}} là: {{number_format($sum_day,'0',',','.')}}VNĐ
		@endif
		@if(isset($sum_year) && isset($year))
		<div id="piechart" style="margin-top: 20px;"></div>
		@endif
	</div>
	<script>
		function check(){
			var noidung= document.sale.monthyear.value;
            if (noidung == '') {
                alert("Bạn chưa chọn tháng năm cần thống kê");
                return false;
            }
		}
		function check_day(){
			var noidung= document.form_day.day.value;
            if (noidung == '') {
                alert("Bạn chưa chọn ngày cần thống kê");
                return false;
            }
		}
		function check_year(){
			var noidung= document.form_year.year.value;
            if (noidung == '') {
                alert("Bạn chưa chọn ngày cần thống kê");
                return false;
            }
		}
		
	</script>
	<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>

	<script type="text/javascript">
		// Load google charts
		google.charts.load('current', {'packages':['corechart']});
		google.charts.setOnLoadCallback(drawChart);

		// Draw the chart and set the chart values
		function drawChart() {
		  var data = google.visualization.arrayToDataTable([
		  ['Task', 'Hours per Day'],
		  ['Một', @if (isset($mot)){{$mot}} @else 0 @endif],
		  ['Hai', @if (isset($hai)){{$hai}} @else 0 @endif],
		  ['Ba', @if (isset($ba)){{$ba}} @else 0 @endif],
		  ['Bốn', @if (isset($bon)){{$bon}} @else 0 @endif],
		  ['Năm', @if (isset($nam)){{$nam}} @else 0 @endif],
		  ['Sáu', @if (isset($sau)){{$sau}} @else 0 @endif],
		  ['Bảy', @if (isset($bay)){{$bay}} @else 0 @endif],
		  ['Tám', @if (isset($tam)){{$tam}} @else 0 @endif],
		  ['Chín', @if (isset($chin)){{$chin}} @else 0 @endif],
		  ['Mười', @if (isset($muoi)){{$muoi}} @else 0 @endif],
		  ['Mười một', @if (isset($muoimot)){{$muoimot}} @else 0 @endif],
		  ['Mười hai', @if (isset($muoihai)){{$muoihai}} @else 0 @endif]
		]);

		  // Optional; add a title and set the width and height of the chart
		  var options = {'title':'Biểu đồ thống kê doanh số theo tháng ', 'width':550, 'height':400};

		  // Display the chart inside the <div> element with id="piechart"
		  var chart = new google.visualization.PieChart(document.getElementById('piechart'));
		  chart.draw(data, options);
		}
	</script>

@stop
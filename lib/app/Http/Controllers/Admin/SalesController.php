<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\order;
use DB;

class SalesController extends Controller
{
    public function getsales(){
        $date=getdate();
        $data['infor']=order::whereDay('created_at',$date['mday'])->whereMonth('created_at',$date['mon'])->whereYear('created_at',$date['year'])->where('status',1)->get();
        $data['sum_date']=order::whereDay('created_at',$date['mday'])->whereMonth('created_at',$date['mon'])->whereYear('created_at',$date['year'])->where('status',1)->sum('total');
    	return view('admin.sales',$data);
    }

    public function postsales(Request $request){
    	$time=explode('-', $request->monthyear);
    	$data['infor']=DB::table('order')->whereMonth('created_at',$time[1])->whereYear('created_at',$time[0])->where('status',1)->get();
    	$data['sum']=DB::table('order')->whereMonth('created_at',$time[1])->whereYear('created_at',$time[0])->where('status',1)->sum('total');
    	$data['my']=$request->monthyear; 
    	return view('admin.sales',$data);
    }

    public function postsalesyear(Request $request){
        $data['infor']=order::whereYear('created_at',$request->year)->where('status',1)->get();
        $data['sum_year']=DB::table('order')->whereYear('created_at',$request->year)->where('status',1)->sum('total');
        $data['year']=$request->year;
        $data['mot']=DB::table('order')->whereYear('created_at',$request->year)->whereMonth('created_at',1)->where('status',1)->sum('total');
        $data['hai']=DB::table('order')->whereYear('created_at',$request->year)->whereMonth('created_at',2)->where('status',1)->sum('total');
        $data['ba']=DB::table('order')->whereYear('created_at',$request->year)->whereMonth('created_at',3)->where('status',1)->sum('total');
        $data['bon']=DB::table('order')->whereYear('created_at',$request->year)->whereMonth('created_at',4)->where('status',1)->sum('total');
        $data['nam']=DB::table('order')->whereYear('created_at',$request->year)->whereMonth('created_at',5)->where('status',1)->sum('total');
        $data['sau']=DB::table('order')->whereYear('created_at',$request->year)->whereMonth('created_at',6)->where('status',1)->sum('total');
        $data['bay']=DB::table('order')->whereYear('created_at',$request->year)->whereMonth('created_at',7)->where('status',1)->sum('total');
        $data['tam']=DB::table('order')->whereYear('created_at',$request->year)->whereMonth('created_at',8)->where('status',1)->sum('total');
        $data['chin']=DB::table('order')->whereYear('created_at',$request->year)->whereMonth('created_at',9)->where('status',1)->sum('total');
        $data['muoi']=DB::table('order')->whereYear('created_at',$request->year)->whereMonth('created_at',10)->where('status',1)->sum('total');
        $data['muoimot']=DB::table('order')->whereYear('created_at',$request->year)->whereMonth('created_at',11)->where('status',1)->sum('total');
        $data['muoihai']=DB::table('order')->whereYear('created_at',$request->year)->whereMonth('created_at',12)->where('status',1)->sum('total');
        return view('admin.sales',$data);
    }

    public function postsalesday(Request $request){
        $data['infor']=order::whereDate('created_at',$request->day)->where('status',1)->get();
        $data['sum_day']=DB::table('order')->whereDate('created_at',$request->day)->where('status',1)->sum('total');
        $data['day']=$request->day;
        return view('admin.sales',$data);
    }
}

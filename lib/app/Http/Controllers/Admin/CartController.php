<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use  App\Models\order;
use  App\Models\order_item;
use  App\Models\product;
use Cart;
use DB;
use Session;
use Alert;

class CartController extends Controller
{
    public function getcart(){
    	$data['items']=DB::table('user')->join('order','user.name_id','=','order.name_id')->orderBy('id','desc')->get();
        $count=DB::table('order')->count();
        if ($count<1) {
            alert()->info('Đơn hàng','Không có');
        }
    	return view('admin.cart',$data); 
    }
    public function getsearchcart(Request $request){
        $data['items']=DB::table('user')->join('order','user.name_id','=','order.name_id')->where('order.id','=',$request->id)->get();
         $count=DB::table('order')->count();
        if ($count<1) {
            alert()->info('Đơn hàng','Không có');
        }
        return view('admin.cart',$data); 
    }

    public function getinforcart($id){
        $data['order']=DB::table('order')->join('user','user.name_id','=','order.name_id')->find($id);
        $data['items']=DB::table('order_item')->join('product','order_item.prod_id','=','product.prod_id')->where('order_item.id_order',$id)->get();
        return view('admin.cart-infor',$data);
    }

    public function geteditcart($id){
        $od=order::where('id',$id)->select('ready')->get();
        foreach ($od as $value) {
            if($value->ready==0){
                alert()->warning('Đơn hàng','Chưa hoàn thành thì giao cái gì');
                return back();
            }
        }
        $order= new order;
        $arr['status']=1;
        $order::where('order.id',$id)->update($arr);
        Session::flash('success', 'Mã đơn hàng '. $id .' đã giao thành công');
        return redirect()->intended('admin/cart');
    }

    public function getreadycart($id){
        $od=order::where('id',$id)->select('status')->get();
        foreach ($od as $value) {
            if($value->status==1){
                alert()->warning('Đơn hàng','Đã giao rồi còn đóng gói xong là sao bạn có nhầm không đấy');
                return back();
            }
        }
        $order=new order;
        $arr['ready']=1;
        $order::where('order.id',$id)->update($arr);
        Session::flash('success', 'Mã đơn hàng '. $id .' đã đóng gói xong đang trong quá trình vạn chuyển');
        return redirect()->intended('admin/cart');
    }
    public function getdeletecart($id){
        $list=order_item::where('id_order',$id)->get();
        foreach ($list as $value) {
            $product=product::where('prod_id',$value->prod_id)->get();
            foreach ($product as $value1) {
                $prod= new product;
                $arr['prod_amount']=$value1->prod_amount+$value->amount;
                $prod::where('prod_id',$value1->prod_id)->update($arr);
            }
        }
        order::destroy($id);
        alert()->success('Đơn hàng','Đã được xóa thành công');
        return redirect()->intended('admin/cart');
    }


}

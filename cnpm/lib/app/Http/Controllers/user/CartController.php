<?php

namespace App\Http\Controllers\user;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use  App\Models\Category;
use  App\Models\product;
use  App\Models\order;
use  App\Models\order_item;
use Cart;
use Auth;
use Mail;
use Session;
use  DB;
use Alert;
use Illuminate\Support\Facades\Validator;

class CartController extends Controller
{
    public function getaddcart(Request $request){
		$product=product::find($request->id);
            if ($product->prod_amount>=1) {
                Cart::add(array(
                    array(
                            'id' => $request->id,
                            'name' => $product->prod_name,
                            'price' => $product->prod_price,
                            'quantity' => 1,
                            'attributes' => array(
                            'promotion'=>$product->prod_promotion,
                            'color' => $product->prod_img
                            )
                        ),
                    ));
                $prod=new product;
                $products=product::where('prod_id',$request->id)->get();
                foreach ($products as $value) {
                    $arr['prod_amount']=$value->prod_amount-1;
                    $prod::where('prod_id',$request->id)->update($arr);
                }
                alert()->success('Sản phẩm',' Được thêm vào giỏ hàng thành công')->autoclose(3000);
                // return back();
            }
            else{
                alert()->info('Sản phẩm','Không còn hàng')->autoclose(3000);
                // return redirect('detail/'.$id);
            }
            
	}
	public function getshowcart(){
        $data['items']= Cart::getContent();
        $money=0;
        foreach ($data['items'] as $value) {
            $money+=$value->quantity*$value->attributes->promotion*$value->price/100;
            $data['amount']=DB::table('product')->where('prod_id',$value->id)->select('prod_amount')->get();
            $data['total']=Cart::getTotal()-$money;
        }
    	return view('fontend.cart',$data);
	}

	public function getDeleteCart(Request $request){
        if($request->id=='all'){
            foreach (Cart::getContent() as $value) {
                $pd=product::where('prod_id',$value->id)->get();
                foreach ($pd as $value1) {
                    $prod=new product;
                    $arr['prod_amount']=$value1->prod_amount+$value->quantity;
                    $prod::where('prod_id',$value->id)->update($arr);
                }
            }
            Cart::clear();
            // return back();
        }
        else{
            $prod=new product;
            $products=product::where('prod_id',$request->id)->get();
            foreach ($products as $value) {
                foreach (Cart::getContent($request->id) as $value1) {
                    $arr['prod_amount']=$value->prod_amount+$value1->quantity;
                    $prod::where('prod_id',$request->id)->update($arr);
                }
            }
            Cart::remove($request->id); 
            // return back();
        }
        
    }

    public function getUpdateCart(Request $request){
        $product=product::find($request->id);
        foreach (Cart::getContent($request->id) as $value) {
           if($value->quantity+$request->qty>$product->prod_amount){
                alert()->info('Sản phẩm','Hiện tại trong kho không đủ hàng ,cảm ơn');
                $request->qty=0;
                 Cart::update($request->id, array(
                'quantity' =>$request->qty,
                ));
            }
        }
        $prod=new product;
        $products=product::where('prod_id',$request->id)->get();
        foreach ($products as $value) {
            $arr['prod_amount']=$value->prod_amount-$request->qty;
            $prod::where('prod_id',$request->id)->update($arr);
        }
        Cart::update($request->id, array(
            'quantity' =>$request->qty,
            ));
    }

    public function postcomplete(Request $request){
       $rules=[
            'phone' =>'required|min:10|max:11',
            'address' =>'required'
       ];
       $messages=[
            'phone.required'=>'SĐT là trường bắt buộc',
            'phone.min'=>'SĐT lớn hơn 10 số',
            'phone.max'=>'SĐT nhỏ hơn 12 số',
            'address.required'=>'Địa chỉ là trường bắt buộc'
        ];
        $validator = Validator::make($request->all(), $rules, $messages);
        if ($validator->fails()) {
            return redirect('cart/show')->withErrors($validator)->withInput();
        }
        else {
            if (Cart::getContent()->count()>=1) {
                $this->updateproduct();
                $order= new order;
                $order->name_id=Auth::user()->name_id;
                $data['items']= Cart::getContent();
                $money=0;
                foreach ($data['items'] as $value) {
                    $money+=$value->quantity*$value->attributes->promotion*$value->price/100;
                    $order->total=Cart::getTotal()-$money;
                }
                $order->phone=$request->phone;
                $order->address=$request->address;
                $order->status=0;
                $order->ready=0;
                $order->paying=0;
                $order->save();
                $items=Cart::getContent();
                foreach ($items as $value) {
                    $order_item= new order_item;
                    $order_item->prod_id=$value->id;
                    $order_item->price=$value->price;
                    $order_item->amount=$value->quantity;
                    $order_item->id_order=$order->id;
                    $order_item->save();
                }
                $data['order']=$order->id;
                $data['info']=$request->all();
                $data['items']= Cart::getContent();
                $money=0;
                foreach ($data['items'] as $value) {
                    $money+=$value->quantity*$value->attributes->promotion*$value->price/100;
                }
                $data['total']=Cart::getTotal()-$money;
                Mail::send('fontend.email', $data, function ($message) {
                    $message->from('thuannguyen12b@gmail.com', 'TTN-shop');
                
                    $message->to(Auth::user()->email);
                
                    $message->cc('thuannguyenk17gtvt@gmail.com', 'Thuan dep trai');
                    
                    $message->subject('Xác nhận mua hàng của TTN shop');
                
                });
                Cart::clear();
                return redirect('paypal/'.$order->id);
            }
            else {
                Session::flash('error','Thực hiện đặt hàng không thành công do đơn hàng của bạn đang rỗng');
                return redirect()->intended('cart/show');
            }
        }
    }

    private function updateproduct(){
        foreach (Cart::getContent() as $value) {
            $product= new product;
            $download=DB::table('product')->where('prod_id',$value->id)->select('download')->get();
            foreach ($download as $value1) {
               $arr['download']= $value1->download+1 ;
               $product::where('prod_id',$value->id)->update($arr);
            }
            // $amount=DB::table('product')->where('prod_id',$value->id)->select('prod_amount')->get();
            // foreach ($amount as $value2) {
            //     $arr['prod_amount']=$value2->prod_amount - $value->quantity;
            //     $product::where('prod_id',$value->id)->update($arr);
            // }
        }
    }

   
    public function getcomplete(){
    	 $data['cates']=Category::all();
    	return view('fontend.complete',$data);
    }
}

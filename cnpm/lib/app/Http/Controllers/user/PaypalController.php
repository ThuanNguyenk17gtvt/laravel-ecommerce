<?php

namespace App\Http\Controllers\user;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use  App\Models\order;
use Srmklive\PayPal\Services\ExpressCheckout;
use Srmklive\PayPal\Services\AdaptivePayments;

class PaypalController extends Controller
{
    public function getPaypal($id){
    	$data['order']=order::where('order.id',$id)->first();
    	return view('fontend.paypal',$data);
    }

    public function postPaypal(Request $request , $id){
    	$order=new order;
    	$arr['paying']=$request->pay_pal;
    	$order::where('id',$id)->update($arr);
    	if ($request->pay_pal==1) {
    		return redirect('paypal/pay/'.$id);
    	}else{
    		return redirect()->intended('cart/complete');
    	}
    }

    public function getPay($id){
    	$order=order::find($id);
    	$provider = new ExpressCheckout; 
    	$data = [];
		$data['items'] = [
		    // [
		    // 	'name' =>$order->name_id,
		    //     'id' => $order->id,
		    //     'price' => $order->total
		    // ],
		    [
		        'name' => 'Product 1',
		        'price' => 9.99,
		        'desc'  => 'Description for product 1',
		        'qty' => 1
		    ],
		];

		$data['invoice_id'] = uniqid();
		$data['invoice_description'] = " test invoice";
		$data['return_url'] = url('/payment/success');
		$data['cancel_url'] = url('/cart/complete');

		$total = 0;
		foreach($data['items'] as $item) {
		    $total += $item['price'];
		}

		$data['total'] = $total;
		$response = $provider->setExpressCheckout($data);
		return redirect($response['paypal_link']);
		
    }

}
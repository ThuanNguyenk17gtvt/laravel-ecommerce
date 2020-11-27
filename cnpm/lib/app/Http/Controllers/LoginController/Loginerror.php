<?php

namespace App\Http\Controllers\LoginController;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Session;
use App\User;
use Sentinal;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator; 
session_start();
class Loginerror extends Controller
{
    public function getnhapmail(){
        $checkUser = User::where('name_id', $_SESSION['name_id'])->first();
        if (isset($checkUser)) {
             $name=$checkUser->name;
            $_SESSION['email'] = $checkUser->email;
            $_SESSION['code'] = mt_rand(10000000, 99999999);
            $code = $_SESSION['code'];
            // $_SESSION['time']=time();
            $data = [
                'name'=>$name,
                'code'=> $code
             ];
             Mail::send('mail', $data, function($message){
                $message->from('thuannguyen12b@gmail.com', 'TTN Shop');
                $message->to($_SESSION['email'], $_SESSION['email']); 
                $message->subject('Kiểm tra tài khoản'); 
             });
            return view('fontend.mail');
        }
        else{
            Session::flash('error','Không tồn tại người dùng này trong hệ thống');
            $error['error']='loi';
            return view('fontend.mail',$error);
        }
       
    }
    public function postnhanma(Request $request){
    	 if ($request->email==null) {
            return back()->withInput()->with('error', 'Bạn chưa nhập email!'); 
        }
        else {
            $email = $request->email;
            $checkUser = User::where('email', $email)->first();
            if($checkUser->name_id!=$_SESSION['name_id']){
                // return back()->withInput()->with('error', 'Email khong ton tai!');
                echo 'loi';
            }else{
                $name=$checkUser->name;
                $_SESSION['email'] = $email;
                $_SESSION['code'] = mt_rand(10000000, 99999999);
                $code = $_SESSION['code'];
                // $_SESSION['time']=time();
                $data = [
                    'name'=>$name,
                    'code'=> $code
                 ];
                 Mail::send('mail', $data, function($message){
                    $message->from('thuannguyen12b@gmail.com', 'TTN Shop');
                    $message->to($_SESSION['email'], $_SESSION['email']); 
                    $message->subject('Kiểm tra tài khoản');
                 });
                 // return redirect()->intended('nhap_ma_xac_nhan');
                 echo 'thanhcong';
            }
        }
    }
    public function postcode(Request $request){
    	if ($request->code==null) {
            return back()->withInput()->with('error', 'Bạn chưa nhập mã xác nhận!');
        }
        else{
        	// if (isset($_SESSION['time']) && time()-$_SESSION['time']<=60) {
    			if($request->code == $_SESSION['code']){
	            	session_destroy();
	                return redirect()->intended('login');
	            }else{
                    unset($_SESSION['code']);
                    // unset($_SESSION['time']);
	                return back()->withInput()->with('error', 'Mã xác nhận không đúng!');
	            }
        	// }
        	// else {
        	// 	unset($_SESSION['code']);
         //        unset($_SESSION['time']);
        	// 	return redirect('nhapmail');
        	// }
        }
    }
}

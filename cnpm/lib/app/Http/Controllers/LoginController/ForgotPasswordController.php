<?php

namespace App\Http\Controllers\LoginController; 

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\User;
use Sentinal;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator; 
use Session;
use Hash;

session_start();

class ForgotPasswordController extends Controller
{
    public function getFormResetPassword(){
        return view('admin.forgot');
    }
    public function sendCodeRequestPassword(Request $request){
        if ($request->email==null) {
            return back()->withInput()->with('error', 'Bạn chưa nhập email!');
        }
        else {
            $email = $request->email;
            $checkUser = User::where('email', $email)->first();
            if(!$checkUser){
                return back()->withInput()->with('error', 'Email khong ton tai!');
            }else{
                $name=$checkUser->name;
                $_SESSION['email'] = $email;
                $_SESSION['code'] = mt_rand(10000000, 99999999);
                $code = $_SESSION['code'];
                $data = [
                    'name'=>$name,
                    'code'=> $code
                 ];
                 Mail::send('mail', $data, function($message){
                    $message->from('thuannguyen12b@gmail.com', 'Mobile Shop');
                    $message->to($_SESSION['email'], $_SESSION['email']);
                    $message->subject('Đặt lại mật khẩu!');
                 });
                 return redirect()->intended('nhap_ma_xac_nhan');
            }
        }
    }
    public function getNhapMaXacNhan(){
        return view('admin.nhapmaxacnhan');
    }
    public function sendMaXacNhan(Request $request){
        if ($request->code==null) {
            return back()->withInput()->with('error', 'Bạn chưa nhập mã xác nhận!');
        }
        else{
            if($request->code == $_SESSION['code']){
                return redirect()->intended('nhap_mat_khau_moi');
            }else{
                return back()->withInput()->with('error', 'Mã xác nhận không đúng!');
            }
        }
    }
    public function getNhapMatKhauMoi(){
        return view('admin.nhapmatkhaumoi');
    }
    public function sendMatKhauMoi(Request $request){
        $old_password=User::where('email', $_SESSION['email'])->select('password')->first();
        $_SESSION['old_password'] = $old_password->password;
        $rules = [
            'password' => 'required|min:8|confirmed',
        ];
        $messages = [
            'password.required' => "Mật khẩu là trường bắt buộc!",
            'password.min' => "Mật khẩu phải có ít nhất 8 kí tự!",
            'password.confirmed' => "Mật khẩu không khớp với nhau"
        ];
        $validator = Validator::make($request->all(), $rules, $messages);
        if ($validator->fails()) {
            return redirect('nhap_mat_khau_moi')->withErrors($validator)->withInput(); 
        }else{
            if (Hash::check($request->password,$_SESSION['old_password'])) {
                Session::flash('error', 'Nhập mật khẩu mơi đi, đây là mật khẩu cũ rồi mới không nhớ nhờn với tui à , nhớ rồi thì quay lại đăng nhập đi!');
                return back();
            }
            else{
                $arr['password'] = bcrypt($request->password);
                $user = new User;
                $user::where('email', $_SESSION['email'])->update($arr);
                return redirect('login')->withInput()->with('success', 'Đổi mật khẩu thành công!');
            }
           
        }
    }
}

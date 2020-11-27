<?php

namespace App\Http\Controllers\LoginController;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\URL;
use Session;
use App\User;
use Illuminate\Support\Str;
use Crypt;
use Socialite;

class LoginController extends Controller
{
    public function redirectToProvider()
    {
        return Socialite::driver('facebook')->redirect();
    }

    /**
     * Obtain the user information from GitHub.
     *
     * @return \Illuminate\Http\Response
     */
    public function handleProviderCallback()
    {
        $userSocial = Socialite::driver('facebook')->user();

        $findUser=User::where('email',$userSocial->email)->first();
        if ($findUser) {
            Auth::login($findUser);
            return redirect('');
        }
        else{
            $user= new User;
            $user->name_id=$userSocial->id;
            $user->name=$userSocial->name;
            $user->email=$userSocial->email;
            $user->password=bcrypt(123456); 
            $user->level=3;
            $user->save();
            Auth::login($user);
            return redirect()->intended('/');  
        }
        
    }

    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name_id'=> ['bail', 'string','min:5' ,'max:15','unique:user,name_id'],
            'name' => [ 'bail','string', 'max:255'],
            'email' => [ 'bail','string', 'email', 'max:255','unique:user,email'],
            'password' => ['bail', 'string', 'min:8','confirmed'],
            'captcha'=>'required|captcha',
        ],
        [
            'name_id.required' => 'Tên đăng nhập là trường bắt buộc',
            'name_id.max' => 'Tên đăng nhập không quá 15 ký tự',
            'name_id.min' => 'Tên đăng nhập lớn hơn 5 ký tự',
            'name_id.unique' => 'Tên đăng nhập đã tồn tại',
            'name.required' => 'Họ và tên là trường bắt buộc',
            'name.max' => 'Họ và tên không quá 255 ký tự',
            'email.required' => 'Email là trường bắt buộc',
            'email.email' => 'Email không đúng định dạng',
            'email.max' => 'Email không quá 255 ký tự',
            'email.unique' => 'Email đã tồn tại',
            'password.required' => 'Mật khẩu là trường bắt buộc',
            'password.min' => 'Mật khẩu phải chứa ít nhất 8 ký tự',
            'password.confirmed' => 'Xác nhận mật khẩu không trùng',
            'captcha.required' => 'Captcha là trường bắt buộc',
            'captcha.captcha' => 'Captcha không đúng',
        ]
        );
    }
    protected function create(array $data)
    {
        return User::create([
            'name_id'=>$data['name_id'],
            'name' => $data['name'],
            'email' => $data['email'],
            'password' =>bcrypt($data['password']),
            'level' => '1',
            'captcha'=>'required|captcha',
        ]);
    }

    public function getRegistration(){
    	return view('fontend.registration');
    }

    public function postRegistration(Request $request){
    	$allRequest  = $request->all(); 
        $validator = $this->validator($allRequest);
     
        if ($validator->fails()) {
            return redirect('registration')->withErrors($validator)->withInput();
        } else {   
            if( $this->create($allRequest)) {
                Session::flash('success', 'Đăng ký thành viên thành công!');
                return redirect('login');
            } else {
                 Session::flash('error', 'Đăng ký thành viên không thành công!');
               return redirect()->back()->withInput();
            }
        }
    }

    public function refreshCaptcha(){
        return response()->json(['captcha'=>captcha_img()]);
    }

    public function postname_id(Request $request){
        if (User::where('name_id',$request->user_name)->exists()) {
            echo 'Tên đăng nhập đã tồn tại';
        }
        else {
            echo '';
        }
    }
    public function postemail(Request $request){
         if (User::where('email',$request->email_check)->exists()) {
            echo 'Email đã tồn tại';
        }
        else {
            echo '';
        }
    }
    public function getLogin(){
        return view('fontend.login');
    }
    public function postLogin(Request $request){
        session_start();
        $rules = [
        'name_id' =>'required',
        'password' => 'required|min:8'
        ];
        $messages = [
            'name_id.required' => 'Tên đăng nhập là trường bắt buộc',
            'password.required' => 'Mật khẩu là trường bắt buộc',
            'password.min' => 'Mật khẩu phải chứa ít nhất 8 ký tự',
        ];
        $validator = Validator::make($request->all(), $rules, $messages);
        if ($validator->fails()) {
            if(!isset($_SESSION['dem'])){
                $_SESSION['dem'] = 0;
            }
            $_SESSION['dem'] += 1;
            if($_SESSION['dem']<3){
                // Session::flash('dm','Đăng nhập sai lần'.$_SESSION['dem']);
                // return redirect('login')->withErrors($validator)->withInput();
                return redirect()->back()->withInput();
            }else{
                // return view('admin.forgot');
                 return redirect('nhapmail');
            }
        }
        else {
            $arr=['name_id'=> $request ->name_id,'password'=>$request ->password];
            if($request->remember =='Remember Me'){
                $remember=true;
            }else{
                $remember=false; 
            }
            if (Auth::attempt($arr,$remember)) {
                 if (Auth::user()->level==2 || Auth::user()->level==1) {
                    session_destroy();
                    return redirect()->intended('admin');
                }
                else if (Auth::user()->level==3) 
                {
                    session_destroy();
                    return redirect()->intended('/');
                }
            }
            else{
                if(!isset($_SESSION['dem'])){
                    $_SESSION['dem'] = 0;
                }
                $_SESSION['dem'] += 1;
                if($_SESSION['dem']<3){
                    Session::flash('error1','(Lưu ý sai 3 lần bạn phải nhập mã xác minh bằng Email)');
                    return redirect('login')->withInput()->with('error','Tài khoản hoặc mật khẩu chưa đúng lần '.$_SESSION['dem']);
                }else{
                    $_SESSION['name_id']=$request->name_id;
                    return redirect('nhapmail')->with('alert','Bạn đã nhập sai quá nhiều');
                    // return redirect('nhapmail');  
                }
                // Session::flash('error', 'Tài khản hoặc mật khẩu chưa đúng!');
                // return back();
            }
        }
    }
    
}

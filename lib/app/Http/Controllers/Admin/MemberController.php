<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\user;
use Auth;
use Session;
use Alert;
use Hash;


class MemberController extends Controller 
{
    public function getMember(){
    	$data['members']=user::all();
    	return view('admin.member',$data);
    }
    public function geteditMember($id){
    	if (Auth::user()->level==1|| Auth::user()->name_id==$id) {
            $data['members']=user::find($id);
    		return view('admin.edit',$data);
    	}
    	else{
             Session::flash('error','Bạn không đủ quyền thực hiện hành động này');
    		return redirect()->intended('admin/member');
    	}
    }

    public function posteditMember(Request $request,$id){
        $users=user::where('name_id',$id)->first();
        $data['users']=user::where('name_id','<>',$id)->get();
         $rules = [
         'name' => [ 'bail','string', 'max:255'],
         'email' => [ 'bail','string', 'email', 'max:255'],
        ];
        $messages = [
            'name_id.max' => 'Name_id không quá 15 ký tự',
            'name_id.min' => 'Name_id lớn hơn 5 ký tự',
            'name.max' => 'Họ và tên không quá 255 ký tự',
            'email.email' => 'Email không đúng định dạng',
            'email.max' => 'Email không quá 255 ký tự', 
        ];
        if (Auth::user()->level==1 || Auth::user()->name_id==$id) {
            $validator = Validator::make($request->all(), $rules, $messages);
            if ($validator->fails()) {
                return redirect('admin/member/edit/'.$id)->withErrors($validator)->withInput();
            }else {
                if ($request->email==$users->email) {
                    $user= new user;
                    $arr['name']=$request->name;
                    $arr['email']=$request->email;
                    $arr['level']=$request->level;
                    $user::where('name_id',$id)->update($arr);
                    if ($request->level==3 && Auth::user()->level!=1 ) {
                        Auth::logout();
                        return redirect()->intended('');
                    }
                    else {
                         Session::flash('success','Bạn đã thay đổi thông tin thành công');
                        return redirect()->intended('admin/member');
                    }
                }
                else {
                    foreach ($data['users'] as $value) {
                        if($value->email == $request->email){
                            Session::flash('error','Cập nhật thành viên không thành công do email trùng với thành viên khác');
                            return redirect('admin/member/edit/'.$id);
                        }
                    }
                    $user= new user;
                    $arr['name']=$request->name;
                    $arr['email']=$request->email;
                    $arr['level']=$request->level;
                    $user::where('name_id',$id)->update($arr);
                    if ($request->level==3 && Auth::user()->level!=1) {
                        Auth::logout();
                        return redirect()->intended('home');
                    }
                    else {
                         Session::flash('success','Bạn đã thay đổi thông tin thành công');
                        return redirect()->intended('admin/member');
                    }
                }
            }
        }
        
    }

    public function posteditpasswordmember(Request $request, $id){
        $rules = [
        'password' => 'required|min:8|confirmed|max:15',
        'old_password'=> 'required|min:8'
        ];
        $messages = [
            'password.required' => 'Mật khẩu là trường bắt buộc',
            'password.min' => 'Mật khẩu phải chứa ít nhất 8 ký tự',
            'password.confirmed' =>"Mật khẩu không trùng nhau",
            'password.max' => 'Mật khẩu nhiểu nhất chỉ được 15 ký tự',
            'old_password.required' => 'Mật khẩu cũ là trường bắt buộc',
            'old_password.min' => 'Mật khẩu cũ phải chứa ít nhất 8 ký tự',
        ];
        $validator = Validator::make($request->all(), $rules, $messages);
        if ($validator->fails()) {
            Session::flash('error','Bạn đã thay đổi mật khẩu thất bại');
            return redirect('admin/member/edit/'.$id)->withErrors($validator)->withInput();
        }
        else {
            if (Hash::check($request->old_password,Auth::user()->password)) {
                $user= new user;
                $arr['password']=bcrypt($request->password);
                $user::where('name_id',$id)->update($arr);
                Session::flash('success','Bạn đã thay đổi mật khẩu thành công');
                return redirect('admin/member');
            }
            else {
                 Session::flash('error', 'Cập nhật thất bại , mật khẩu cũ không đúng');
                return redirect('admin/member/edit/'.$id);
            }
            
        }
    }

    public function getdeleteMember($id){
    	if (Auth::user()->level==1) {
    		user::destroy($id);
    		Session::flash('success','Bạn đã xóa thành công thành viên '. $id );
    		return back();
    	}
    	else{
            alert()->warning('Bạn','Không có quyền thực hiện hành động này');
    		return redirect()->intended('admin/member');
    	}
    }

    public function postaddmember(Request $request){
    	 $rules = [
         'name_id'=> ['required', 'bail', 'string','min:5' ,'max:15','unique:user,name_id'],
         'name' => ['required', 'bail','string', 'max:255'],
         'email' => ['required', 'bail','string', 'email', 'max:255','unique:user,email'],
         'password' => ['required','bail', 'string', 'min:8','confirmed'],
        ];
        $messages = [
            'name_id.required' => 'Name_id là trường bắt buộc',
            'name_id.max' => 'Name_id không quá 15 ký tự',
            'name_id.min' => 'Name_id lớn hơn 5 ký tự',
            'name_id.unique' => 'Name_id đã tồn tại',
            'name.required' => 'Họ và tên là trường bắt buộc',
            'name.max' => 'Họ và tên không quá 255 ký tự',
            'email.required' => 'Email là trường bắt buộc',
            'email.email' => 'Email không đúng định dạng',
            'email.max' => 'Email không quá 255 ký tự',
            'email.unique' => 'Email đã tồn tại',
            'password.required' => 'Mật khẩu là trường bắt buộc',
            'password.min' => 'Mật khẩu phải chứa ít nhất 8 ký tự',
            'password.confirmed' => 'Xác nhận mật khẩu không trùng', 
        ];

		if (Auth::user()->level==1) {
			$validator = Validator::make($request->all(), $rules, $messages);
	        if ($validator->fails()) {
	            return redirect('admin/member')->withErrors($validator)->withInput();
	        }
	        else {
	        	$user= new user;
	        	$user->name_id=$request->name_id;
	        	$user->name=$request->name;
	        	$user->email=$request->email;
	        	$user->password=bcrypt($request->password);
                $user->level=2;
	        	$user->save();
	        	Session::flash('success','Thêm thành viên thành công');
	        	return redirect()->intended('admin/member');
	        }
    	}
    	else{
            alert()->error('Cảnh báo','Bạn không được thêm người dùng khác vào');
            // Session::flash('error','Bạn không được thêm người dùng khác vào');
    		return redirect()->intended('admin/member');
    	}
    }

    public function postname_id(Request $request){
        if (user::where('name_id',$request->id)->exists()) {
            echo '<span>Tên đăng nhập đã tồn tại</span>';
        }
        else {
            echo '<span></span>';
        }
        
    }

    public function postemail(Request $request){
         if (user::where('email',$request->email_check)->exists()) {
            echo '<span>Email đã tồn tại</span>';
        }
        else {
            echo '<span></span>';
        }
    }

    public function postcheckemail(Request $request){
        $user=user::where('name_id',$request->id)->first();
        if ($user->email==$request->email) {
            echo '<span></span>';
        }
        else {
            if (user::where('email',$request->email)->exists()) {
                echo '<span>Email đã tồn tại</span>';
            }
            else {
                echo '';
            }
        }
    }
}

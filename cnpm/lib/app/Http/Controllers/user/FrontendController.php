<?php

namespace App\Http\Controllers\user;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use  App\Models\Category;
use  App\Models\product;
use  App\Models\user;
use  App\Models\Comment;
use  App\Models\rating;
use  App\Models\order;
use  App\Models\order_item;
use Illuminate\Support\Facades\Validator;
use DB;
use Auth;
use Session;
use Hash;

class FrontendController extends Controller
{
    public function gethome(){
    	$data['products']=product::where('prod_featured',1)->orderBy('view','desc')->take(10)->get();
        $data['news']=product::orderBy('download','desc')->take(10)->get();
    	return view('fontend.home',$data);
    }
    public function getcategory($id){
    	$data['catename']=Category::find($id);
    	$data['items']=product::where('prod_cate',$id)->paginate(9);

    	return view('fontend.category',$data);
    }

    public function postcategory(Request $request,$id){
        $data['catename']=Category::find($id);
        $data['condition']=$request->prod_condition;
        $data['featured']=$request->prod_featured;
        $data['price']=$request->prod_price;
        if ($request->prod_price==1) {
             $data['items']=product::where([['prod_condition','=',$request->prod_condition],['prod_featured','=',$request->prod_featured],['prod_cate','=',$id]])->orderBy('prod_price','desc')->paginate(9);
             // dd($data['items']);
        }
        else {
           $data['items']=product::where([['prod_condition','=',$request->prod_condition],['prod_featured','=',$request->prod_featured],['prod_cate','=',$id]])->orderBy('prod_price','asc')->paginate(9); 
           // dd($data['items']);
        }
        return view('fontend.category',$data);
    }

    public function getdetail($id){
        $data['r1']=rating::where([['prod_id','=',$id],['star','=','1.00']])->select('star')->count();
        $data['r2']=rating::where([['prod_id','=',$id],['star','=','2.00']])->select('star')->count();
        $data['r3']=rating::where([['prod_id','=',$id],['star','=','3.00']])->select('star')->count();
        $data['r4']=rating::where([['prod_id','=',$id],['star','=','4.00']])->select('star')->count();
        $data['r5']=rating::where([['prod_id','=',$id],['star','=','5.00']])->select('star')->count();
        $data['count']=rating::where('prod_id',$id)->count();
        $data['sum']=rating::where('prod_id',$id)->select('star')->sum('star');
    	$data['comments']=Comment::where('com_product',$id)->get();
    	$data['product']=product::find($id);
        $product =new product;
        $value=DB::table('product')->where('prod_id',$id)->select('view')->get();
        $d['vi']=$value;
        foreach ($d['vi'] as $value) {
           $arr['view']= $value->view+1 ;
        }
        $product::where('prod_id',$id)->update($arr);
    	return view('fontend.detail',$data);
    }

    public function postcomment(Request $request,$id){
        if (Auth::check()) {
            if ($request->content=='') {
            return back();
            }
            $comment= new Comment;
            $comment->com_email=Auth::user()->email;
            $comment->com_name=Auth::user()->name;
            $comment->com_content=$request->content;
            $comment->com_product=$id;
            $comment->save();
            return back();
        }
        else{
            alert()->warning('Bạn cần đăng nhập để có thể bình luận')->autoclose(3000);
            return back();
        }
        
    }
    public function getdeletecomment(Request $request){
        Comment::destroy($request->id);
        return back();
    }

    public function poststar(Request $request,$id){

        // if (Auth::check()) {
             // if ($request->star=='') {
             //        alert()->info('Bạn' ,'chưa đánh giá cảm ơn');
             //        // return back();
             //    }
            if (rating::where('name_id',Auth::user()->name_id)->exists() && rating::where('prod_id',$id)->exists()) {
                $rating = new rating;
                $arr['star']=$request->star;
                $rating::where([['prod_id','=',$id],['name_id','=',Auth::user()->name_id]])->update($arr);
                alert()->success('Cảm ơn', 'Bạn đã đánh giá sản phẩm của chúng tôi')->autoclose(3000);
                // echo 'thanhcong'; 
                // return back();
            }
            else {
                $star= new rating;
                $star->star=$request->star;
                $star->prod_id=$id;
                $star->name_id=Auth::user()->name_id;
                $star->save();
                alert()->success('Cảm ơn', 'Bạn đã đánh giá sản phẩm của chúng tôi')->autoclose(3000);
                // echo 'thanhcong';
                // return back();
            }
        // }
        // else
        // {
        //     alert()->info('Bạn','Cần đăng nhập để đánh giá');
        //     // return back();
        // }
       
    }

    public function getsearch(Request $request){
    	$result= $request->result;
    	$data['keyword']=$result;
    	// $result= str_replace('%', ' ', $result);
        $kt='/[\'\/~`\!@#\$%\^&\*\(\)_\-\+=\{\}\[\]\|;:"\<\>,\.\?\\\]/';
        if (!preg_match($kt, $result)) {
            $data['products']=product::where('prod_name','like','%'.$result.'%')->get();
            return view('fontend.search',$data);
        }
        else {
            $data['products']=product::where('prod_name','='," ")->get();;
            return view('fontend.search',$data);
        }
        // if ($result!=" ") {
        //     $data['products']=product::where('prod_name','like','%'.$result.'%')->get();
        //     return view('fontend.search',$data);
        // }
        // else{
        //     $data['products']=product::where('prod_name','='," ")->get();;
        //     return view('fontend.search',$data);
        // }
    	
    }

    
    public function getinformation($id){
    	$data['user']=user::find($id);
        $data['count']=DB::table('order')->where('order.name_id',Auth::user()->name_id)->count();
        $data['orders']=DB::table('user')->join('order','user.name_id','=','order.name_id')->where('user.name_id',Auth::user()->name_id)->orderBy('id','desc')->get();
        return view('fontend.information',$data);
    }
    public function getinformationcart($id){
        $data['orders']=order::find($id);
        $data['items']=DB::table('order_item')->join('product','product.prod_id','=','order_item.prod_id')->where('order_item.id_order',$id)->get();
        return view('fontend.see_cart',$data);
    }

    public function postinformation(Request $request,$id ){
        // $users=user::where('name_id',$id)->first();
        $rules = [
        'name' =>'required',
        'email' =>'required|email',
        ];
        $messages = [
            'name.required' => 'Tên là trường bắt buộc',
            'email.required' => 'Email là trường bắt buộc',
        ];
        $validator = Validator::make($request->all(), $rules, $messages);
        if ($validator->fails()) {
            alert()->error('Cập nhật', 'Thất bại')->autoclose(3000);
            return redirect('information/'.$id)->withErrors($validator)->withInput();
        }
        else {
            if ($request->email == Auth::user()->email) {
                if ($request->name ==Auth::user()->name) {
                    // alert()->info('Thông tin','Không thay đổi gì hết ');
                    Session::flash('success', 'Thông tin không thay đổi gì!');
                    return redirect('information/'.$request->id);
                }
                $user= new user;
                $arr['name']=$request->name;
                $arr['email']=$request->email;
                $user::where('name_id',$id)->update($arr);
                Session::flash('success', 'Cập nhật thông tin thành công!');
                return redirect('information/'.$request->id);
                
            }
            else {
                $data['users']=user::where('name_id','<>',$id)->get(); 
                foreach ($data['users'] as $value) {
                    if($value->email ==$request->email ){
                         Session::flash('error','Cập nhật thất bại email đã tồn tại');
                         return redirect('information/'.$request->id);
                    }
                }
                $user= new user;
                $arr['name']=$request->name;
                $arr['email']=$request->email;
                $user::where('name_id',$id)->update($arr);
                Session::flash('success', 'Cập nhật thông tin thành công!');
                return redirect('information/'.$request->id);
            }
        }
    }
    
    public function postpassword(Request $request ,$id){
        $rules = [
        'password' => 'min:8|confirmed',
        'old_password'=> 'min:8',
        ];
        $messages = [
            'password.min' => 'Mật khẩu phải chứa ít nhất 8 ký tự',
            'password.confirmed' =>"Mật khẩu không trùng nhau",
            'old_password.min' => 'Mật khẩu cũ phải chứa ít nhất 8 ký tự',
        ];
        $validator = Validator::make($request->all(), $rules, $messages);
        if ($validator->fails()) {
             Session::flash('error', 'Cập nhật thất bại ');
            return redirect('information/'.$id)->withErrors($validator)->withInput();
        }
        else {
            if (Hash::check($request->old_password,Auth::user()->password)) {
                $user= new user;
                $arr['password']=bcrypt($request->password);
                $user::where('name_id',$id)->update($arr);
                alert()->success('Cập nhật','mật khẩu thành công!')->autoclose(3000);
                return redirect('information/'.$id);
            }
            else {
                 Session::flash('error', 'Cập nhật thất bại , mật khẩu cũ không đúng');
                return redirect('information/'.$id);
            }
            
        }
    }


    public function getdeleteorder($id){
        // $order=order::where('id',$id)->first();
        $data['list-item']=order_item::where('id_order',$id)->get();
        foreach ($data['list-item'] as $value) {
            $amount=product::where('prod_id',$value->prod_id)->get();
            foreach ($amount as $value1) {
                $product=new product;
                $arr['prod_amount']=$value->amount+$value1->prod_amount;
                $product::where('prod_id',$value->prod_id)->update($arr);
            }
        }
        order::destroy($id);
        alert()->success('Xóa đơn hàng','Thành công')->autoclose(3000);
        return back();
    }

    public function postcheck(Request $request){
        // $user=user::where('name_id',$request->id)->first();
        if ($request->email==Auth::user()->email) {
            echo '';
        }
        else {
            if (user::where('email',$request->email)->exists() ) {
                echo '<span>Email  đã tồn tại</span>';
            }
            else {
                echo '';
            }
        }
    }

    public function getLogout(){
        Auth::logout();
        return redirect('');
    }
}

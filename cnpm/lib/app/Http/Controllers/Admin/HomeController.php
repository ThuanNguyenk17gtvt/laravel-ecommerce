<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\user;
use Auth;
use App\Models\Category;
use App\Models\product;
use App\Models\order;
use App\Models\Comment;
use App\Models\rating;

class HomeController extends Controller 
{
    public function gethome(){
    	$data['users']=user::all();
    	$data['sp']=user::where('level','1')->get();
    	$data['admin']=user::where('level','2')->get();
    	$data['u']=user::where('level','3')->get();
    	$data['cates']=Category::all();
    	$data['products']=product::all();
    	$data['featured']=product::where('prod_featured','1')->get();
    	$data['moi']=product::where('prod_condition','1')->get();
    	$data['cu']=product::where('prod_condition','0')->get();
    	$data['orders']=order::all();
    	$data['ok']=order::where('status','1')->get();
    	$data['notok']=order::where('status','0')->get();
    	$data['comment']=Comment::all();
    	$data['rating']=rating::all();
    	return view('admin.index',$data);
    }
    // public function getLogout(){
    // 	Auth::logout();
    // 	return redirect('');
    // }
}

<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator; 
use App\Models\Category;
use App\Http\Requests\AddCateRequest;
use App\Http\Requests\EditCateRequest;
use Session;

class CategoryController extends Controller
{
    public function getCategory(){
    	$data['cate']=Category::all();
    	return view('admin.category',$data);
    }

    public function postCategory(AddCateRequest $request){
		$category=new Category;
	    $category->cate_name= $request->name;
	    $category->save();
        Session::flash('success', 'Bạn đã thêm thành công '.$request->name.'vào database');
	    return back();
    	
    }
    public function getEditCategory($id){
    	$data['cate']=Category::find($id);
    	return view('admin.editcategory',$data);
    }

    public function postEditCategory(Request $request, $id){
        $data['category']=Category::where('cate_id','<>',$id)->get();
        $category=Category::find($id);
        if ($category->cate_name== strtoupper($request->name)) {
            $category->cate_name= strtoupper($request->name);
            $category->save();
             Session::flash('success', 'Bạn đã không sửa gì hết!');
            return redirect()->intended('admin/category');
        }
        else{
            foreach ($data['category'] as $value) {
                if ($value->cate_name==strtoupper($request->name)) {
                     Session::flash('error', 'Tên loại sản phẩm đã bị trùng vui lòng chọn tên khác!'); 
                     return redirect()->intended('admin/category/edit/'.$id);
                }
            }
            $category->cate_name= strtoupper($request->name);
            $category->save();
            Session::flash('success', 'Sửa thành công!');
            return redirect()->intended('admin/category');
        }
    }

    public function getDeleteCategory($id){
    	Category::destroy($id);
        Session::flash('success', 'Bạn đã xóa thành công!');
    	return back();
    }

    public function postcheckname(Request $request){
        if (Category::where('cate_name',$request->name)->exists()) {
            echo '<span>Tên loại sản phẩm đã bị trùng</span>';
        }
        else {
            echo '<span></span>';
        }
    }

    public function postcheckedit(Request $request){
        $cate=Category::where('cate_id',$request->cate_id)->first();
        if ($cate->cate_name=$request->name) {
            echo '';
        }
        else {
            if (Category::where('cate_name',$request->name)->exists()) {
                echo 'Tên loại sản phẩm đã bị trùng';
            }else{
                echo '';
            }
        }
    }
}

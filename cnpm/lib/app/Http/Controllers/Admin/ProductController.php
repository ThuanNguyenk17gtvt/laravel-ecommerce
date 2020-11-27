<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\product;
use App\Models\Product_img;
use Illuminate\Support\Facades\Validator;
use Session;
use App\Http\Requests\AddProductRequest;
use DB;
use Illuminate\Support\Facades\Input; 

class ProductController extends Controller
{
    public function getProduct($id){
    	$data['cate']=Category::find($id);
        $data['products']=DB::table('product')->where('product.prod_cate','=',$id)->get();
        $data['count']=product::where('product.prod_cate','=',$id)->count();
    	return view('admin.product',$data);
    }

    public function getsearchProduct(Request $request,$id){ 
         $data['cate']=Category::find($id);
        $data['products']=DB::table('product')->where([['prod_cate','=',$id],['prod_name','like','%'.$request->name.'%']])->get();
        $data['count']=product::where('product.prod_cate','=',$id)->count();
        return view('admin.product',$data);
    }
    public function getAddProduct($id){
    	$data['cate']=Category::find($id);
    	return view('admin.addproduct',$data);
    }
    public function postAddProduct(Request $request, $id){
        $cate=Category::where('cate_id',$id)->select('cate_name')->first();
        $pd=product::all();
        $string=$cate->cate_name;
        $rules = [
        'product_id' =>['unique:product,prod_id'],
        'name' => 'unique:product,prod_name',
        'price' =>'gt:0',
        'img' => 'required|image',
        'warranty' => 'gte:0',
        'promotion' =>'gte:0',
        'condition' => 'required',
        'description' =>'required',
        'featured' => 'required',
        'number' => 'gt:0'
        ];
        $messages = [
            'product_id.unique' => 'Mã sản phẩm bị trùng!',
            'name.unique' => 'Tên sản phẩm đã bị trùng',
            'price.gt' => 'Giá sản phẩm phải lớn hơn 0!',
            'img.required' => 'Bạn phải thêm hình!',
            'img.image' =>'Đây không phải la hình ảnh',
            'warranty.gte' =>'Bảo hành phải lớn hơn 0',
            'promotion.gte'=>'Khuyến mãi phải lớn hơn 0',
            'condition.required' => 'Tình trạng là trường bắt buộc!',
            'description.required' => 'Mô tả là trường bắt buộc!',
            'featured.required' => 'Nổi bật là trường bắt buộc!',
            'number.gt'=>'Số lượng phải lớn hơn 0!'
        ];
        $validator = Validator::make($request->all(), $rules, $messages);
        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }else{
            if ($string[0]!=$request->product_id[0]) {
                 Session::flash('error', 'Mã sản phẩm phải bắt đầu bằng chữ cái đầu tiên của loại sản phẩm');
                 return back()->withInput();
            }
            foreach ($pd as $value) {
                 if ($value->prod_img==$request->img->getClientOriginalName()) {
                     Session::flash('error', 'Ảnh đã bị trùng vui lòng chọn ảnh khác');
                    return back()->withInput();
                }
            }
            $filename= $request->img->getClientOriginalName();
            $product= new product;
            $product->prod_id=$request->product_id;
            $product->prod_name=$request->name;
            $product->prod_img=$filename;
            $product->prod_acccessories=$request->accessories;
            $product->prod_price=$request->price;
            $product->prod_warranty=$request->warranty;
            $product->prod_promotion=$request->promotion;
            $product->prod_condition=$request->condition;
            $product->prod_description=$request->description;
            $product->prod_cate=$id;
            $product->prod_featured=$request->featured;
            $product->prod_amount=$request->number;
            $product->save();
            $request->img->storeAs('avatar',$filename);
            Session::flash('success', 'Bạn đã thêm sản phẩm thành công');
            return redirect()->intended('admin/product/'.$id);
        }
    }

    public function getEditProduct($id){
         
        $data['product']=product::find($id);
        return view('admin.editproduct',$data);
    }


    public function postEditProduct( Request $request , $id){
        $rules = [
        'price' =>'gt:0',
        'img' => 'image',
        'warranty' => 'gte:0',
        'promotion' =>'gte:0',
        'condition' => 'required',
        'description' =>'required',
        'featured' => 'required',
        'number' => 'gt:0'
        ];
        $messages = [
            'price.gt' =>'Giá sản phẩm phải lớn hơn 0',
            'img.image' =>'Đây không phải là định dạng của hình ảnh',
            'warranty.gte' =>'Bảo hành phải lớn hơn 0',
            'promotion.gte'=>'Khuyến mãi phải lớn hơn 0',
            'condition.required' => 'Tình trạng là trường bắt buộc!',
            'description.required' => 'Mô tả là trường bắt buộc!',
            'featured.required' => 'Nổi bật là trường bắt buộc!',
            'number.gt'=>'Số lượng phải lớn hơn 0!'
        ];
        $validator = Validator::make($request->all(), $rules, $messages);
        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }else{
            $pd=product::where('prod_id','<>',$id)->get();
            $pr = Product::find($id);
            $product =new Product;
            if ($pr->prod_name==$request->name) {
                if ($request->hasFile('img')) {
                    foreach ($pd as $value) {
                        if ($value->prod_img==$request->img->getClientOriginalName()) {
                             Session::flash('error', 'Bạn cập nhật  không thành công sản phẩm do ảnh sản phẩm đã bị trùng');
                            return redirect('admin/product/edit/'.$id);
                        }
                    }
                    $img=$request->img->getClientOriginalName();
                    $arr['prod_img']=$img;
                    $request->img->storeAs('avatar',$img);
                }
                $arr['prod_name']=$request->name;
                $arr['prod_acccessories']=$request->accessories;
                $arr['prod_price']=$request->price;
                $arr['prod_warranty']=$request->warranty;
                $arr['prod_promotion']=$request->promotion;
                $arr['prod_condition']=$request->condition;
                $arr['prod_description']=$request->description;
                $arr['prod_featured']=$request->featured;
                $arr['prod_amount']=$request->number;
                $product::where('prod_id',$id)->update($arr);
                 Session::flash('success', 'Bạn cập nhật  thành công sản phẩm '.$id);
                return redirect('admin/product/'.$pr->prod_cate); 
            }
            else {
                $all=product::where('prod_id','<>',$id)->get();
                foreach ($all as $value) {
                    if ($value->prod_name==$request->name) {
                        Session::flash('error', 'Bạn cập nhật  không thành công sản phẩm do tên sảm phẩm đã bị trùng');
                        return redirect('admin/product/edit/'.$id);
                    }
                }
                $product =new Product;
                if ($request->hasFile('img')) {
                    foreach ($all as $value) {
                        if ($value->prod_img==$request->img->getClientOriginalName()) {
                         Session::flash('error', 'Bạn cập nhật  không thành công sản phẩm do ảnh sản phẩm đã bị trùng');
                        return redirect('admin/product/edit/'.$id);
                        } 
                    }
                    $img=$request->img->getClientOriginalName();
                    $arr['prod_img']=$img;
                    $request->img->storeAs('avatar',$img);
                }
                $arr['prod_name']=$request->name;
                $arr['prod_acccessories']=$request->accessories;
                $arr['prod_price']=$request->price;
                $arr['prod_warranty']=$request->warranty;
                $arr['prod_promotion']=$request->promotion;
                $arr['prod_condition']=$request->condition;
                $arr['prod_description']=$request->description;
                $arr['prod_featured']=$request->featured;
                $arr['prod_amount']=$request->number;
                $product::where('prod_id',$id)->update($arr);
                 Session::flash('success', 'Bạn cập nhật  thành công sản phẩm '.$id);
                return redirect('admin/product/'.$pr->prod_cate);
            }
        }
    }
    public function getDeleteProduct($id){
        product::destroy($id);
        Session::flash('success', 'Bạn đã xóa sản phẩm thành công!'.$id);
        return back();
    }

    public function postcheckid(Request $request){
        if (product::where('prod_id',$request->id_check)->exists()) {
            echo '<span>Mã sản phẩm đã tồn tại</span>';
        }
        else{
            echo ''; 
        }
    }
    public function postcheckname(Request $request){
        if (product::where('prod_name',$request->name)->exists()) {
            echo '<span>Tên sản phẩm đã tồn tại</span>';
        }
        else{
            echo '';
        }
    }
    public function postcheckimg(Request $request){
         if (product::where('prod_img',$request->img_check)->exists()) {
            echo '<span>Ảnh sản phẩm đã tồn tại</span>';
        }
        else{
            echo '';
        }
    }
    
    public function posteditCheck_name(Request $request){
        $pd=product::where('prod_id',$request->id)->first();
        if ($pd->prod_name==$request->name) {
            echo '';
        }else {
            if (product::where('prod_name',$request->name)->exists()){
                echo '<span>Tên sản phẩm đã tồn tại</span>';
            }
            else {
                echo '';
            }
             
        }
    }

    public function posteditcheckimg(Request $request){
        if (product::where([
                ['prod_img', '=',$request->img_check],
                ['prod_id', '!=',$request->id],
            ])->exists()) {
            echo 'Ảnh đã bị trùng';
        }
        else{
            echo ''; 
        }
    }

}

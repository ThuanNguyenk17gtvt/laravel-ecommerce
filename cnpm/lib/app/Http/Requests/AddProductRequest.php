<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Validator;

class AddProductRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
           'product_id' =>'required|min:2|max7|unique:product,prod_id',
            'name' => 'required|min:5',
            'price' => 'required|numeric',
            'img' => 'image',
            'accessories'=>'required',
            'warranty'=>'required',
            'promotion'=>'required',
            'condition'=>'required',
            // 'status'=>'required',
            'description'=>'required',
            // 'featured'=>'required',
            // 'number'=>'required',
        ];
    }
    public function messages()
    {
        return [
            // 'product_id.required' => 'Mã sản phẩm là trường bắt buộc',
            // 'product_id.min' => 'Số ký tự của mã sản phẩm lớn hơn hai ký tự',
            // 'product_id.max' => 'Số ký tự mã sản phẩm nhỏ hơn tám ký tự',
            // 'name.required' =>'Tên sản phẩm là trường bắt buộc',
            // 'name.min' => 'Số ký tự của sản phẩm phải lớn hơn năm ký tụ',
            // 'price.required' => 'Giá là trường bắt buộc',
            // 'price.numeric' => 'Giá cả nhập phải là số',
            // 'img.image' =>'Banh phải chọn file là ảnh',
            // 'accessories.required' => 'Phụ kiện là trường bắt buộc',
            // 'warranty.required' => 'Bảo hành là trường bắt buộc',
            // 'promotion.required' => 'Khuyến mãi là trường bắt buộc',
            // 'condition.required' => 'Tình trạng là trường bắt buộc',
            // 'description.required' => 'Miêu tả là trường bắt buộc',
        ];
    }
}

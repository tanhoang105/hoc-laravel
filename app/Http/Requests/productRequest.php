<?php

namespace App\Http\Requests;

use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Foundation\Http\FormRequest;

class productRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */

    public function authorize()
    // đây là phương thức cho phép người dùng thực hiện request hau không 
    {
        return false;
        // false là ko cho thực hiện request    
        // true là cho phép người dùng thực hiện request
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    // đây là phương thức chứa các rules cần validate
    {
        return [
            'product-name' => 'required | min:6 '
        ];
    }

    public function messages()

    // đây là phương thức giúp định nghĩa thông báo 
    {
        return [
            'product-name.required' => ':attribute bắt buộc phải nhập',
            'product-name.min' => ':attribute không được nhỏ hơn :min ký tự ',
        ];
    }

    public function attributes()
    {
        // đây là phương thức giúp thay đổi thuộc tính 
        // những :attribute trong method messages() sẽ được thay đổi với tên mới
        return [
            'product-name' => 'tên sản phẩm'
        ];
    }

    protected function withValidator($validator)
    // đây là method sau khi validate xong 
    {
        
        $validator->after(function ($validator) {
            // if ($this->somethingElseIsInvalid()) {
                // $validator->errors()->add('msg', 'Đã có lỗi xảy ra');
            // }



            // đây là sau khi validate thì làm những công vc gì
            // vd ở đây là chúng ta hiển thị ra lỗi sau khi validate xong
            if($validator->errors()->count() > 0){
                
                $validator->errors()->add('msg' , 'errors, vui lòng kiểm tra lại');
            }
        });

     
    }


    protected function prepareForValidation()
    // đây là hàm trước khi validate 
    // nghĩa làm hàm này sẽ được thực thi trước hàm withValiddator
    {
        $this->merge([
           'create_at' =>   date('Y-m-d'),

        ]);
    }

    protected  function failedAuthorization()
    {
        throw new AuthorizationException('bạn ko có quyền truy cập');
    }


}

<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        // return false;
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $uniqueEmail =  'unique:users';
        if(session('id')){
            $id = session('id');
            $uniqueEmail = 'unique:users,email,'. $id;
        }
        return 
            //
            [
                'fullname' => ['required' , 'min:5'],
                'email' => ['required' , 'email' , $uniqueEmail],
                'group_id' => ['required', 'integer', function($attribute , $value , $fail){
                    if($value == 0){
                        $fail('Tên nhóm bắt buộc phải được chọn');
                    }
                }],
                'status' => ['required' , 'integer']
            ];     
    }


    public function messages()
    {
        return [
            'fullname.required' => 'fullname bắt buộc phải nhập',
                'fullname.min' => 'fullname ít nhất phải 5 ký tự',
                'email.required' => 'email bắt buộc phải nhập',
                'email.email'=> 'email bắt buộc là email',
                'email.unique' => 'email đã tồn tại ',
                'group_id.required' => 'group_id bắt buộc phải chọn',
                'group_id.integer' => 'group_id bắt buộc là số',
                'status.required' => 'Trạn thái bắt buộc phải được chọn',
                'status.integer'=> 'Trạng thái phảo là số '

        ];
    }
}

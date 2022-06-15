<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class UpperCase implements Rule
{
    // tạo ra thuộc tính attribute = null 
    private $attribute = null ;
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        // nếu method này trả về true thì rule đó sẽ được pass và ngược lại 
        // dd($attribute , $value);
        // var_dump($value);
        
        // gán thuộc tính attribute bằng tham số attribute 
        $this->attribute = $attribute ;
        if($value == mb_strtoupper($value,'UTF-8')){

            return true;
        }

        return false;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        // sẽ trả về thông báo nếu như rule này không pass 
        // return 'Trường :attribute không hợp lệ ';

        
        $customMessage = 'validation.custom.'.($this->attribute).'.uppercase';
        // dd($customMessage);
        if(trans($customMessage) != $customMessage){

            return trans($customMessage);
        }
        return trans('validation.uppercase');
    }
}

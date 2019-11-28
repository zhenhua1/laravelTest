<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AuthRequest extends FormRequest
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
            'email'=>'required|email',
            'password'=>'required|string',
        ];
    }

    public function messages()
    {
        return [
            'email.required'=>'邮箱不能为空',
            'email.email'=>'邮箱格式有误',
            'password.required'=>'密码不能为空',
            'password.string'=>'密码格式有误',
        ];
    }
}

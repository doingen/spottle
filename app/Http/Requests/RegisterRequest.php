<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RegisterRequest extends FormRequest
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
            'name' => 'required|string|max:50',
            'email' => 'required|email|unique:users|string|max:191',
            'tel' => 'required|unique:users|numeric|digits_between:10,11',
            'password' => 'required|min:8|max:191|regex:/^[a-zA-Z0-9]+$/'
        ];
    }

    public function messages()
    {
        return[
            'required' => ':attributeを入力してください',
            'name.max' => ':max文字以内で入力してください',
            'email' => 'メールアドレス形式で入力してくだい',
            'unique' => 'この:attributeはすでに利用されています',
            'email.max' => ':max文字以内で入力してください',
            'numeric' => 'ハイフンなしの半角数字で入力してください',
            'digits_between' => '半角数字10文字から11文字以内で入力してください',
            'regex' => '半角英数字8文字以上で入力してください',
            'password.min' => '半角英数字:min文字以上で入力してください',
            'password.max' => '半角英数字:max文字以内で入力してください'
        ];

    }

    public function attributes()
    {
        return [
            'name' => '名前',
            'email' => 'メールアドレス',
            'tel' => '電話番号',
            'password' => 'パスワード'
        ];
    }
}

<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules;

class AdminRegisterRequest extends FormRequest
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
            'email' => ['required', 'string', 'email', 'max:191', 'unique:admins'],
            'password' => ['required', 'confirmed', Rules\Password::min(8),'max:191'],
        ];
    }

    public function messages()
    {
        return[
            'required' => ':attributeを入力してください',
            'email' => 'メールアドレス形式で入力してくだい',
            'unique' => 'この:attributeはすでに利用されています',
            'password.min' => '半角英数字:min文字以上で入力してください',
            'password.max' => '半角英数字:max文字以内で入力してください',
            'confirmed' => 'パスワードが一致しません'
        ];
    }

    public function attributes()
    {
        return [
            'email' => 'メールアドレス',
            'password' => 'パスワード'
        ];
    }
}

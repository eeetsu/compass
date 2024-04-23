<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RegisterFormRequest extends FormRequest
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
            'over_name' => 'required|string|max:10',
            'under_name' => 'required|string|max:10',
            'over_name_kana' => 'required|string|regex:/^[ァ-ヶー ]+$/u|max:30',
            'under_name_kana' => 'required|string|regex:/^[ァ-ヶー ]+$/u|max:30',
            'mail_address' => 'required|email|unique:users,mail_address|max:100',
            'sex' => 'required|in:男性,女性,その他',
            'old_year' => 'required|date|before_or_equal:today|after_or_equal:2001-01-01',
            'role' => 'required|in:講師(国語),講師(数学),講師(英語),生徒',
            'password' => 'required|string|confirmed|min:8|max:30',
            'password_confirmation' => 'required|alpha_num|min:8|max:30|same:password',
        ];
    }
     public function messages(){
        return [
            'over_name.required' => '姓は必須です。',
            'under_name.required' => '名は必須です。',
            'over_name_kana.required' => 'セイは必須です。',
            'under_name_kana.required' => 'メイは必須です。',
            'mail_address.required' => 'メールアドレスは必須です。',
            'sex' => '性別は必須です。',
            'old_year' => '生年月日は必須です。',
            'role' => '役職は必須です。',
            'password' => 'パスワードは必須です。',
            'password_confirmation' => '確認用パスワードは必須です。',
        ];
    }
}

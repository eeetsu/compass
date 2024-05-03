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

     /**
     *  rules()の前に実行される
     *       $this->merge(['key' => $value])を実行すると、
     *       フォームで送信された(key, value)の他に任意の(key, value)の組み合わせをrules()に渡せる
     */
    public function getValidatorInstance()
    {
        $this->merge([
            'birth_day' => $this->input('old_year') . '-' . $this->input('old_month') . '-' . $this->input('old_day'),
        ]);

        return parent::getValidatorInstance();
    }




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
            'sex' => 'required',
            'birth_day' => 'required|date_format:Y-m-d',
            'role' => 'required',
            'password' => 'required|string|confirmed|min:8|max:30',
        ];
    }
     public function messages(){
        return [
            'over_name.required' => '姓は必須です。',
            'under_name.required' => '名は必須です。',
            'over_name_kana.required' => 'セイは必須です。',
            'under_name_kana.required' => 'メイは必須です。',
            'mail_address.required' => 'メールアドレスは必須です。',
            'sex.required' => '性別は必須です。',
            'birth_day.required' => '生年月日は必須です。',
            'role.required' => '役職は必須です。',
            'password.required' => 'パスワードは必須です。',
            // 'password_confirmation' => '確認用パスワードは必須です。',
        ];
    }

    // protected function prepareForValidation()
    // {
        // $data = [];
        // $this->merge($data);
    // }
}

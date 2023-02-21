<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RegisterRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\Rule|array|string>
     */
    public function rules(): array
    {
        return [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|min:6|confirmed',
            'password_confirmation' => 'required|min:6'
        ];
    }


    public function messages(): array
    {
        return [
            'name.required' => '* Укажите имя',
            'name.max' => '* Максимальная длина имени 255 символов',
            'email.required' => '* Укажите почту',
            'email.email' => '* Некорректная почта',
            'email.unique' => '* Данная почта уже сущетсвует в системе',
            'email.max' => '* Максимальная длина почты 255 символов',
            'password.min' => '* Минимальная длина пароля 6 символов',
            'password.required' => '* Укажите пароль',
            'password.confirmed' => '* Пароли не совпадают',
            'password_confirmation.min' => '* Минимальная длина пароля 6 символов',
            'password_confirmation.required' => '* Повторите пароль'
        ];
    }
}

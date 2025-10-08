<?php

namespace App\Http\Requests\Auth;

use App\Models\User;
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => 'bail|required|string|max:150',
            'phone' => 'bail|required|string|max:20|unique:' . User::tableName() . ',phone',
            'email' => 'bail|required|email|max:150|unique:' . User::tableName() . ',email',
            'password' => 'bail|required|string|min:6|confirmed',
        ];
    }

    /**
     * Apply custom validation after the rules are checked.
     *
     * @param \Illuminate\Validation\Validator $validator
     * @return void
     */
    public function withValidator($validator): void
    {
        $validator->after(function ($v) {
            if (! $this->boolean('terms_accepted')) {
                $v->errors()->add('terms_accepted', __('app/auth/register.request.must_accept_terms'));
            }
        });
    }

    /**
     * Get attribute name.
     *
     * @return array
     */
    public function attributes()
    {
        return [
            'name' => __('app/auth/register.request.name'),
            'phone' => __('app/auth/register.request.phone'),
            'email' => __('app/auth/register.request.email'),
            'password' => __('app/auth/register.request.password'),
            'password_confirmation' => __('app/auth/register.request.password_confirmation'),
        ];
    }
}

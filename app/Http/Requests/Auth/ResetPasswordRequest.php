<?php

namespace App\Http\Requests\Auth;

use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;

class ResetPasswordRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(): array
    {
        return [
            'email' => 'bail|required|email',
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
        if ($validator->fails()) {
            return;
        }

        $validator->after(function ($validator) {
            $user = User::where('email', $this->input('email'))->first();

            if (!$user) {
                $validator->errors()->add('email', __('app/auth/common.invalid_credentials'));
                return;
            }

            if (!$user->status) {
                $validator->errors()->add('email', __('app/auth/common.account_disabled'));
                return;
            }

            if ($user->google_id && $user->signup_method === 'google') {
                $validator->errors()->add('email', __('app/auth/common.goole.reset_not_allowed'));
                return;
            }
        });
    }


    /**
     * Get attribute names for translations.
     *
     * @return array
     */
    public function attributes(): array
    {
        return [
            'email' => __('app/auth/reset_password.request.email'),
            'password' => __('app/auth/reset_password.request.password'),
        ];
    }
}

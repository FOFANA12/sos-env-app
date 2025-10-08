<?php

namespace App\Http\Requests\Auth;

use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;

class ForgetPasswordRequest extends FormRequest
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
                $validator->errors()->add('email', __('app/auth/common.email_not_found'));
                return;
            }

            if (!$user->status) {
                $validator->errors()->add('email', __('app/auth/common.inactive'));
                return;
            }

            if ($user->google_id) {
                $validator->errors()->add('email', __('app/auth/common.reset_not_allowed_google'));
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
            'email' => __('app/auth/forget_password.request.email'),
        ];
    }
}

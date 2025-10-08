<?php

namespace App\Http\Requests;

use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class ProfileRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return Auth::check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        $user = Auth::user();

        $rules = [
            'name' => 'bail|required|max:100',
            'phone' => 'bail|required|string|max:20|unique:' . User::tableName() . ',phone,' . $user->id,
            'avatar' => 'bail|nullable|max:5120|mimes:jpeg,png,jpg',
            'password' => 'bail|nullable|min:6|confirmed',
        ];

        if (is_null($user->google_id)) {
            $rules += [
                'email' => 'bail|required|email|max:150|unique:' . User::tableName() . ',email,' . $user->id,
            ];
        }

        return $rules;
    }

    /**
     * Get attribute name.
     *
     * @return array
     */
    public function attributes()
    {
        return [
            'name' => __('app/profile.request.name'),
            'phone' => __('app/profile.request.phone'),
            'avatar' => __('app/profile.request.avatar'),
            'email' => __('app/profile.request.email'),
            'password' => __('app/profile.request.password'),
        ];
    }
}

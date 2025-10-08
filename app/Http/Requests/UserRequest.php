<?php

namespace App\Http\Requests;

use App\Models\User;
use App\Support\Role;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UserRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    protected function prepareForValidation(): void
    {
        $this->merge([
            'status' => filter_var($this->status, FILTER_VALIDATE_BOOLEAN),
        ]);
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        $rules = [
            'name' => 'bail|required|string|max:100',
            'avatar' => 'bail|nullable|mimes:jpeg,png,jpg|max:5120',
        ];

        $rules['role'] = ['bail', 'required', Rule::in(Role::codes())];

        if ($this->isMethod('put')) {
            $user = $this->route('user');
            $rules += [
                'email' => 'bail|required|email|max:150|unique:' . User::tableName() . ',email,' . $user->id,
                'phone' => 'bail|required|string|max:20|unique:' . User::tableName() . ',phone,' . $user->id,
                'password' => 'bail|nullable|min:6|confirmed',
            ];
        } else {
            $rules += [
                'email' => 'bail|required|email|max:150|unique:' . User::tableName() . ',email',
                'phone' => 'bail|required|string|max:20|unique:' . User::tableName() . ',phone',
                'password' => 'bail|required|min:6|confirmed',
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
            'name' => __('app/user.request.name'),
            'avatar' => __('app/user.request.avatar'),
            'email' => __('app/user.request.email'),
            'phone' => __('app/user.request.phone'),
            'password' => __('app/user.request.password'),
        ];
    }
}

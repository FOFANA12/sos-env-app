<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ContactRequest extends FormRequest
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
            'full_name' => 'required|string|max:150',
            'email' => 'required|email|max:255',
            'phone' => 'nullable|string|max:50',
            'subject' => 'required|string|max:150',
            'message' => 'required|string|max:2000',
        ];
    }

    public function attributes(): array
    {
        return [
            'full_name' => __('app/contact.request.full_name'),
            'email' => __('app/contact.request.email'),
            'phone' => __('app/contact.request.phone'),
            'subject' => __('app/contact.request.subject'),
            'message' => __('app/contact.request.message'),
        ];
    }
}

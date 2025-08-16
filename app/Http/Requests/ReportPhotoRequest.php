<?php

namespace App\Http\Requests;

use App\Models\Report;
use Illuminate\Foundation\Http\FormRequest;

class ReportPhotoRequest extends FormRequest
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
            'caption' => 'bail|nullable|string|max:150',
            'report' => 'bail|required|exists:' . Report::tableName() . ',uuid',

        ]; 
    }

    public function attributes(): array
    {
        return [
            'caption' => __('app/report_photo.request.caption'),
            'region' => __('app/report_photo.request.region'),
        ];
    } 
}

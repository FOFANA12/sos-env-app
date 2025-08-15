<?php

namespace App\Http\Requests;

use App\Models\User;
use App\Models\Region;
use App\Models\Department;
use App\Models\Neighborhood;
use App\Support\ReportStatus;
use App\Models\ReportCategory;
use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class ReportRequest extends FormRequest
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
            'category' => 'bail|nullable|exists:' . ReportCategory::tableName() . ',uuid',
            'region' => 'bail|nullable|exists:' . Region::tableName() . ',uuid',
            'department' => 'bail|nullable|exists:' . Department::tableName() . ',uuid',
            'neighborhood' => 'bail|nullable|exists:' . Neighborhood::tableName() . ',uuid',
            'title' => 'bail|required|string|max:150',
            'description' => 'bail|nullable|string|max:1000',
            'latitude' => 'bail|nullable|numeric',
            'longitude' => 'bail|nullable|numeric',
            'address' => 'bail|nullable|string|max:255',
            'status' => ['bail', 'required', 'string', 'max:20', Rule::in(ReportStatus::codes())],
        ];
    }

    public function attributes(): array
    {
        return [
            'category' => __('app/report.request.category'),
            'region' => __('app/report.request.region'),
            'department' => __('app/report.request.department'),
            'neighborhood' => __('app/report.request.neighborhood'),
            'title' => __('app/report.request.title'),
            'description' => __('app/report.request.description'),
            'latitude' => __('app/report.request.latitude'),
            'longitude' => __('app/report.request.longitude'),
            'address' => __('app/report.request.address'),
        ];
    }
}

<?php

namespace App\Http\Requests;

use App\Models\ReportCategory;
use Illuminate\Foundation\Http\FormRequest;

class ReportCategoryRequest extends FormRequest
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
        $rules = [
            'name'  => 'bail|required|string|max:100|unique:' . ReportCategory::tableName() . ',name',
        ];

        if ($this->isMethod('put')) {
            $reportCategory = $this->route('report_category');

            $rules['name']  = 'bail|required|string|max:100|unique:' . ReportCategory::tableName() . ',name,' . $reportCategory->id;
        }

        return $rules;
    }

    public function attributes(): array
    {
        return [
            'name' => __('app/report_category.request.name'),
        ];
    }
}

<?php

namespace App\Http\Requests;

use App\Models\Region;
use App\Models\Department;
use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class DepartmentRequest extends FormRequest
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
            'name' => [
                'bail',
                'required',
                'string',
                'max:100',
                Rule::unique(Department::tableName(), 'name')
                    ->where('region_uuid', $this->region)
            ],
            'region' => 'bail|required|exists:' . Region::tableName() . ',uuid',
        ];

        if ($this->isMethod('put')) {
            $department = $this->route('department');

            $rules['name'] = [
                'bail',
                'required',
                'string',
                'max:100',
                Rule::unique(Department::tableName(), 'name')
                    ->where('region_uuid', $this->region)
                    ->ignore($department->id)
            ];
        }

        return $rules;
    }

    public function attributes(): array
    {
        return [
            'name' => __('app/department.request.name'),
            'region' => __('app/department.request.region'),
        ];
    }
}

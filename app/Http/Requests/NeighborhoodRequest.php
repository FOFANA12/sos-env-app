<?php

namespace App\Http\Requests;

use App\Models\Department;
use App\Models\Neighborhood;
use App\Models\Region;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class NeighborhoodRequest extends FormRequest
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
                Rule::unique(Neighborhood::tableName(), 'name')
                    ->where('department_uuid', $this->department)
            ],
            'region' => 'bail|required|exists:' . Region::tableName() . ',uuid',
            'department' => 'bail|required|exists:' . Department::tableName() . ',uuid',
        ];

        if ($this->isMethod('put')) {
            $neighborhood = $this->route('neighborhood');

            $rules['name'] = [
                'bail',
                'required',
                'string',
                'max:100',
                Rule::unique(Neighborhood::tableName(), 'name')
                    ->where('department_uuid', $this->department)
                    ->ignore($neighborhood->id)
            ];
        }

        return $rules;
    }

    public function attributes(): array
    {
        return [
            'name' => __('app/neighborhood.request.name'),
            'department' => __('app/neighborhood.request.department'),
            'region' => __('app/neighborhood.request.region'),
        ];
    }
}


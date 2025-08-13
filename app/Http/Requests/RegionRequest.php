<?php

namespace App\Http\Requests;

use App\Models\Region;
use Illuminate\Foundation\Http\FormRequest;

class RegionRequest extends FormRequest
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
            'name'  => 'bail|required|string|max:100|unique:' . Region::tableName() . ',name',
        ];

        if ($this->isMethod('put')) {
            $region = $this->route('region');

            $rules['name']  = 'bail|required|string|max:100|unique:' . Region::tableName() . ',name,' . $region->id;
        }

        return $rules;
    }

    public function attributes(): array
    {
        return [
            'name' => __('app/region.request.name'),
        ];
    }
}

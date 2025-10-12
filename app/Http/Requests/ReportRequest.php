<?php

namespace App\Http\Requests;

use App\Models\Region;
use App\Models\Department;
use App\Models\Neighborhood;
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
            'region' => 'bail|required|exists:' . Region::tableName() . ',uuid',
            'department' => 'bail|required|exists:' . Department::tableName() . ',uuid',
            'neighborhood' => 'bail|required|exists:' . Neighborhood::tableName() . ',uuid',
            'title' => 'bail|required|string|max:150',
            'description' => 'bail|required|string|max:1000',

            'image' => 'bail|required|image|mimes:jpeg,png,jpg|max:10240',

            'photos' => 'bail|nullable|array|max:3',
            'photos.*' => 'bail|file|image|mimes:jpeg,png,jpg|max:10240',
        ];
    }

    public function messages(): array
    {
        return [
            'photos.max' => __('app/report.request.photos_max'),
            'photos.*.file' => __('app/report.request.photos_file'),
            'photos.*.image' => __('app/report.request.photos_image'),
            'photos.*.mimes' => __('app/report.request.photos_mimes'),
            'photos.*.max' => __('app/report.request.photos_max_size'),
        ];
    }

    public function attributes(): array
    {
        $attributes = [
            'region' => __('app/report.request.region'),
            'department' => __('app/report.request.department'),
            'neighborhood' => __('app/report.request.neighborhood'),
            'title' => __('app/report.request.title'),
            'description' => __('app/report.request.description'),
            'image' => __('app/report.request.image'),
            'photos' => __('app/report.request.photos'),
        ];
        
        if (is_array($this->photos)) {
            foreach (array_keys($this->photos) as $i) {
                $n = $i + 1;
                $attributes["photos.$i"] = __('app/report.request.photo_item', ['number' => $n]);
            }
        }

        return $attributes;
    }
}

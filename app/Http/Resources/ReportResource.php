<?php

namespace App\Http\Resources;

use App\Support\ReportStatus;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ReportResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return match ($request->mode) {
            'list' => $this->forList(),
            'edit' => $this->forEdit(),
            default => $this->forView(),
        };
    }

    protected function forList(): array
    {
        $currentLang = app()->getLocale();
        return [
            'id' => $this->id,
            'uuid' => $this->uuid,
            'title' => $this->title,
            'description' => $this->description,
            'latitude' => $this->latitude,
            'longitude' => $this->longitude,
            'address' => $this->address,
            'status' => ReportStatus::get($this->status_code, $currentLang),
            'region' => $this->region,
            'report_category' => $this->category,
            'department' => $this->department,
            'neighborhood' => $this->neighborhood,
        ];
    }

    protected function forEdit(): array
    {
        $currentLang = app()->getLocale();
        return [
            'id' => $this->id,
            'uuid' => $this->uuid,
            'title' => $this->title,
            'description' => $this->description,
            'latitude' => $this->latitude,
            'longitude' => $this->longitude,
            'address' => $this->address,
            'status' => ReportStatus::get($this->status, $currentLang),
            'region' => $this->region_uuid,
            'report_category' => $this->category_uuid,
            'department' => $this->department_uuid,
            'neighborhood' => $this->neighborhood_uuid,
        ];
    }
    protected function forView(): array
    {
        $currentLang = app()->getLocale();
        return [
            'id' => $this->id,
            'uuid' => $this->uuid,
            'title' => $this->title,
            'description' => $this->description,
            'latitude' => $this->latitude,
            'longitude' => $this->longitude,
            'address' => $this->address,
            'status' => ReportStatus::get($this->status, $currentLang),
            'region' => $this->region ? $this->region->name : null,
            'report_category' => $this->category? $this->category->name : null,
            'department' => $this->department? $this->department->name : null,
            'neighborhood' => $this->neighborhood? $this->neighborhood->name : null,
        ];
    }
}
